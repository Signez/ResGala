<?php

/**
 * LigneCommande filter form base class.
 *
 * @package    resgala
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLigneCommandeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'quantite'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'quantite'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('ligne_commande_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LigneCommande';
  }

  public function getFields()
  {
    return array(
      'reservation_id' => 'Number',
      'produit_id'     => 'Number',
      'quantite'       => 'Number',
    );
  }
}
