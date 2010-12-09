<?php

/**
 * Reservation form.
 *
 * @package    resgala
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ReservationForm extends BaseReservationForm
{
  public function configure()
  {
    $custom_decorator = new galaFormSchemaFormatter($this->getWidgetSchema());
    $this->getWidgetSchema()->addFormFormatter('deflist', $custom_decorator);
    $this->getWidgetSchema()->setFormFormatterName('deflist');
    
    $this->useFields(array("nom", "prenom", "login", "paye_with", "banque_nom", "repas_with"));
    $this->widgetSchema->setLabels(array(
                      "nom" => "Votre nom :",
                      "prenom" => "Votre prénom :",
                      "login" => "Votre login INSA :",
                      "banque_nom" => "Le nom de la banque inscrit sur le chèque (le cas échéant) :",
                      "repas_with" => "Les noms et prénoms des autres étudiants et diplômés avec qui vous souhaitez manger :"
                     ));
    $this->widgetSchema->setHelps(array(
                      "nom" => "Ce nom vous sera notamment demandé lors du paiement ou du retrait de votre réservation.",
                      "login" => "Cet identifiant vous sera demandé lors du paiement ou du retrait de votre réservation.",
                      "banque_nom" => "Si vous réglez par chèque, indiquez ci-dessus le nom de la banque
                                       émettrice du chèque.",
                      "repas_with" => "Ce champ optionnel vous permet d'indiquer avec quels autres étudiants et diplômés
                                       vous souhaitez manger (en dehors de cette réservation). L'équipe d'organisation
                                       tentera de respecter ces souhaits, sans pouvoir vous le garantir."
                     ));
    $this->validatorSchema["nom"]->setOption("required", true);
    $this->validatorSchema["prenom"]->setOption("required", true);
    $this->validatorSchema["paye_with"]->setOption("required", true);
  }
}

class IdentityReservationForm extends ReservationForm
{
  public function configure()
  {
    parent::configure();
    $this->useFields(array("nom", "prenom", "login"));
    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(
        array(
          'model' => 'Reservation',
          'column' => array('login'),
          'throw_global_error' => false
        ),
        array(
          'invalid' => "Quelqu'un s'est déjà inscrit avec ce login. "
                      ."Nous vous invitons à annuler votre réservation auprès du BdE et à en recréer une."
        )
      )
    );
  }
}

class ValidateReservationForm extends ReservationForm
{
  public function configure()
  {
    parent::configure();
    $this->useFields(array("paye_with", "banque_nom", "repas_with"));
    $this->validatorSchema->setPreValidator(
            new sfValidatorOr(array(
                new sfValidatorSchemaFilter('paye_with', new sfValidatorChoice(array('choices' => array('especes')))),
                new sfValidatorSchemaFilter('banque_nom', new sfValidatorString(array('min_length' => 1, 'required' => true)))
              ),
              array(),
              array('invalid' => 'Le nom de la banque est obligatoire si vous choisissez le payement par chèque.')
            )
          );
  }
}

