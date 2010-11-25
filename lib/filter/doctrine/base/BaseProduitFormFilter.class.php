<?php

/**
 * Produit filter form base class.
 *
 * @package    resgala
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProduitFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'intitule'         => new sfWidgetFormFilterInput(),
      'description'      => new sfWidgetFormFilterInput(),
      'prix'             => new sfWidgetFormFilterInput(),
      'reservation_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Reservation')),
    ));

    $this->setValidators(array(
      'intitule'         => new sfValidatorPass(array('required' => false)),
      'description'      => new sfValidatorPass(array('required' => false)),
      'prix'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'reservation_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Reservation', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('produit_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addReservationListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.LigneCommande LigneCommande')
      ->andWhereIn('LigneCommande.reservation_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Produit';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'intitule'         => 'Text',
      'description'      => 'Text',
      'prix'             => 'Number',
      'reservation_list' => 'ManyKey',
    );
  }
}
