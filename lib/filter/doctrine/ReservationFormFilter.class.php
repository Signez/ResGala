<?php

/**
 * Reservation filter form.
 *
 * @package    resgala
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ReservationFormFilter extends BaseReservationFormFilter
{
  public function configure()
  {
    foreach ($this->widgetSchema->getFields() as $field)
		{
			if ($field instanceof sfWidgetFormFilterInput)
			{
				$field->setOption('empty_label', 'vide');
				$field->setOption('template', '%input%');
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
				$field->setOption('empty_label', 'vide');
				$field->setOption(
					'template',
					'du %from_date% au %to_date%'
				);
			}
		}
  }
}
