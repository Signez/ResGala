<?php

/**
 * LigneCommande form base class.
 *
 * @method LigneCommande getObject() Returns the current form's model object
 *
 * @package    resgala
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLigneCommandeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'reservation_id' => new sfWidgetFormInputHidden(),
      'produit_id'     => new sfWidgetFormInputHidden(),
      'quantite'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'reservation_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('reservation_id')), 'empty_value' => $this->getObject()->get('reservation_id'), 'required' => false)),
      'produit_id'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('produit_id')), 'empty_value' => $this->getObject()->get('produit_id'), 'required' => false)),
      'quantite'       => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ligne_commande[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LigneCommande';
  }

}
