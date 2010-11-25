<?php

/**
 * Produit form base class.
 *
 * @method Produit getObject() Returns the current form's model object
 *
 * @package    resgala
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProduitForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'intitule'         => new sfWidgetFormInputText(),
      'description'      => new sfWidgetFormInputText(),
      'prix'             => new sfWidgetFormInputText(),
      'reservation_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Reservation')),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'intitule'         => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'description'      => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'prix'             => new sfValidatorNumber(array('required' => false)),
      'reservation_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Reservation', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('produit[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Produit';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['reservation_list']))
    {
      $this->setDefault('reservation_list', $this->object->Reservation->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveReservationList($con);

    parent::doSave($con);
  }

  public function saveReservationList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['reservation_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Reservation->getPrimaryKeys();
    $values = $this->getValue('reservation_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Reservation', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Reservation', array_values($link));
    }
  }

}
