<?php

/**
 * Project filter form base class.
 *
 * @package    resgala
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterBaseTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class BaseFormFilterDoctrine extends sfFormFilterDoctrine
{
	protected $booleanFieldChoices = array('' => 'yes or no', 1 => 'yes', 0 => 'no');
 
	/**
	 * @see sfForm
	 */
	public function __construct($defaults = array(), $options = array(), $CSRFSecret = null)
	{
		parent::__construct($defaults, $options, $CSRFSecret);

	}
 
	/**
	 * @see sfForm
	 */
	public function setup()
	{
	}
	
	public function configure() {
	  parent::configure();
		$this->fixI18N();
	}
 
	protected function fixI18N()
	{
		foreach ($this->widgetSchema->getFields() as $field)
		{
			if ($field instanceof sfWidgetFormFilterInput)
			{
				$this->fixIsEmpty($field);
			}
			elseif ($field instanceof sfWidgetFormChoice
			and $field->getOption('choices') == $this->booleanFieldChoices)
			{
				$field->setOption('choices', array_map(
					array($this->widgetSchema->getFormFormatter(), 'translate'),
					$field->getOption('choices')
				));
			}
			elseif ($field instanceof sfWidgetFormFilterDate)
			{
				$this->fixIsEmpty($field);
 
				$field->setOption(
					'template',
					$this->widgetSchema->getFormFormatter()->translate(
						$field->getOption('template')
					)
				);
			}
		}
	}
 
	protected function fixIsEmpty(sfWidgetForm $field)
	{
		$field->setOption(
			'empty_label',
			$this->widgetSchema->getFormFormatter()->translate(
				$field->getOption('empty_label')
			)
		);
	}
}
