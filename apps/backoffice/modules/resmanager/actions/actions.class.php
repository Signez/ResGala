<?php

require_once dirname(__FILE__).'/../lib/resmanagerGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/resmanagerGeneratorHelper.class.php';

/**
 * resmanager actions.
 *
 * @package    resgala
 * @subpackage resmanager
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class resmanagerActions extends autoResmanagerActions
{
  public function executeListPaye(sfWebRequest $request) {
    $reservation = $this->getRoute()->getObject();
    $reservation->paye(true);
    
    $this->getUser()->setFlash('notice', 'Les réservations sélectionnées ont été marquées comme payées.');
    
    $this->redirect('reservation_collection');
  }
}
