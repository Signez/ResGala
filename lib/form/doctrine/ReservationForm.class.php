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
    
    $this->useFields(array("nom", "prenom", "login", "num_insa", "paye_with", "banque_nom"));
    $this->widgetSchema->setLabels(array(
                      "nom" => "Votre nom :",
                      "prenom" => "Votre prénom :",
                      "login" => "Votre login INSA :",
                      "num_insa" => "Votre numéro d'étudiant INSA :",
                      "banque_nom" => "Le nom de la banque inscrit sur le chèque (le cas échéant) :"
                     ));
    $this->widgetSchema->setHelps(array(
                      "nom" => "Ce nom vous sera notamment demandé lors du paiement ou du retrait de votre réservation.",
                      "login" => "Cet identifiant vous sera demandé lors du paiement ou du retrait de votre réservation.",
                      "num_insa" => "Ce numéro à sept chiffres se trouve sur votre
                                    Carte d'Étudiant Multi-Service, situé juste sous votre INE.",
                      "banque_nom" => "Si vous réglez par chèque, indiquez ci-dessus le nom de la banque
                                       émettrice du chèque."
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
    $this->useFields(array("nom", "prenom", "login", "num_insa"));
    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(
        array(
          'model' => 'Reservation',
          'column' => array('login'),
          'throw_global_error' => false
        ),
        array(
          'invalid' => "Quelqu'un s'est déjà inscrit avec ce login. Nous vous invitons à annuler votre réservation et à en recréer une."
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
    $this->useFields(array("paye_with", "banque_nom"));
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

