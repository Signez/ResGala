<?php

/**
 * Reservation form base class.
 *
 * @method Reservation getObject() Returns the current form's model object
 *
 * @package    resgala
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseReservationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'nom'           => new sfWidgetFormInputText(),
      'prenom'        => new sfWidgetFormInputText(),
      'login'         => new sfWidgetFormInputText(),
      'repas_with'    => new sfWidgetFormTextarea(),
      'paye_with'     => new sfWidgetFormChoice(array('choices' => array('especes' => 'especes', 'cheque' => 'cheque'))),
      'banque_nom'    => new sfWidgetFormInputText(),
      'validated_at'  => new sfWidgetFormDateTime(),
      'payed_at'      => new sfWidgetFormDateTime(),
      'produits_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Produit')),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nom'           => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'prenom'        => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'login'         => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'repas_with'    => new sfValidatorString(array('max_length' => 256, 'required' => false)),
      'paye_with'     => new sfValidatorChoice(array('choices' => array(0 => 'especes', 1 => 'cheque'), 'required' => false)),
      'banque_nom'    => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'validated_at'  => new sfValidatorDateTime(array('required' => false)),
      'payed_at'      => new sfValidatorDateTime(array('required' => false)),
      'produits_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Produit', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Reservation', 'column' => array('login')))
    );

    $this->widgetSchema->setNameFormat('reservation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Reservation';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['produits_list']))
    {
      $this->setDefault('produits_list', $this->object->Produits->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveProduitsList($con);

    parent::doSave($con);
  }

  public function saveProduitsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['produits_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Produits->getPrimaryKeys();
    $values = $this->getValue('produits_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Produits', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Produits', array_values($link));
    }
  }

}
