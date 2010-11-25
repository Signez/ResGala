<?php

/**
 * reswizard actions.
 *
 * @package    resgala
 * @subpackage reswizard
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class reswizardActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeStart(sfWebRequest $request)
  {
    $this->form = new IdentityReservationForm();
    if($this->getUser()->hasAttribute("currentIdentity")){
      $this->form->setDefaults($this->getUser()->getAttribute("currentIdentity"));
    }
  }
  
  public function executeSaveStart(sfWebRequest $request)
  {
    $this->form = new IdentityReservationForm();

    if($request->isMethod('post')){
      $this->form->bind($request->getParameter('reservation'));
      if($this->form->isValid()){
        $this->getUser()->setAttribute("currentIdentity", $this->form->getValues());
        $this->redirect('commande');
      }
    }

    $this->setTemplate('start');
  }

  public function executeCommande(sfWebRequest $request)
  {
    if(!isset($this->errors))
       $this->errors = array();

    if(!isset($this->commande))
      $this->commande = $this->getUser()->getAttribute("currentCommande", array());

    $this->produits = Doctrine::getTable('Produit')->findAll();
  }

  public function executeSaveCommande(sfWebRequest $request)
  {
    $this->errors = array();
    if(!count($request->getParameter("commande", array())))
      $this->errors["nothing"] = "Rien n'est disponible pour être affiché.";
    else {
      $this->commande = array();
      foreach($request->getParameter("commande") as $produit_id => $qte){
        if(is_integer($produit_id) and ($qte == '' or ctype_digit($qte)) and intval($qte) < 20 and intval($qte) >= 0){
          if($qte != 0)
            $this->commande[$produit_id] = $qte;
        }else
          $this->errors["nan".intval($produit_id)] = "Seules des quantités comprises entre 0 et 20 peuvent être commandées.";
      }
    }

    if(!count($this->errors)){
      $this->getUser()->setAttribute("currentCommande", $this->commande);
      $this->redirect('validate');
    }

    $this->executeCommande($request);
    $this->setTemplate('commande');
  }

  public function executeValidate(sfWebRequest $request)
  {
    $this->form = new ValidateReservationForm();

    if($this->getUser()->hasAttribute("currentValidation")){
      $this->form->setDefaults($this->getUser()->getAttribute("currentValidation"));
    }
  }

  public function executeSaveValidate(sfWebRequest $request)
  {
    $this->form = new ValidateReservationForm();

    if($request->isMethod('post')){
      $this->form->bind($request->getParameter('reservation'));
      if($this->form->isValid()){
        $this->getUser()->setAttribute("currentValidation", $this->form->getValues());
        $this->redirect('resa_done');
      }
    }

    $this->setTemplate('validate');
  }

  public function executeDone(sfWebRequest $request){
    if(!$this->getUser()->hasAttribute("currentIdentity")
       or !$this->getUser()->hasAttribute("currentCommande")
       or !$this->getUser()->hasAttribute("currentValidation"))
       $this->forward404();
    
    $reservation = new Reservation();
    $reservation->setArray($this->getUser()->getAttribute("currentIdentity") + $this->getUser()->getAttribute("currentValidation"));
    $reservation->save();
  }
}
