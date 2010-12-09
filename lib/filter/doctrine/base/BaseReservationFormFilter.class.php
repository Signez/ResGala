<?php

/**
 * Reservation filter form base class.
 *
 * @package    resgala
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseReservationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nom'           => new sfWidgetFormFilterInput(),
      'prenom'        => new sfWidgetFormFilterInput(),
      'login'         => new sfWidgetFormFilterInput(),
      'repas_with'    => new sfWidgetFormFilterInput(),
      'paye_with'     => new sfWidgetFormChoice(array('choices' => array('' => '', 'especes' => 'especes', 'cheque' => 'cheque'))),
      'banque_nom'    => new sfWidgetFormFilterInput(),
      'validated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'payed_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'produits_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Produit')),
    ));

    $this->setValidators(array(
      'nom'           => new sfValidatorPass(array('required' => false)),
      'prenom'        => new sfValidatorPass(array('required' => false)),
      'login'         => new sfValidatorPass(array('required' => false)),
      'repas_with'    => new sfValidatorPass(array('required' => false)),
      'paye_with'     => new sfValidatorChoice(array('required' => false, 'choices' => array('especes' => 'especes', 'cheque' => 'cheque'))),
      'banque_nom'    => new sfValidatorPass(array('required' => false)),
      'validated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'payed_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'produits_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Produit', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('reservation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addProduitsListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('LigneCommande.produit_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Reservation';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'nom'           => 'Text',
      'prenom'        => 'Text',
      'login'         => 'Text',
      'repas_with'    => 'Text',
      'paye_with'     => 'Enum',
      'banque_nom'    => 'Text',
      'validated_at'  => 'Date',
      'payed_at'      => 'Date',
      'produits_list' => 'ManyKey',
    );
  }
}
