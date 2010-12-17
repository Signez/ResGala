<td>
  <ul class="sf_admin_td_actions">
    <?php echo $helper->linkToEdit($reservation, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <li class="sf_admin_action_paye">
      <?php echo link_to(__('Payée !', array(), 'messages'), 'resmanager/ListPaye?id='.$reservation->getId(), array()) ?>
    </li>
  </ul>
</td>
