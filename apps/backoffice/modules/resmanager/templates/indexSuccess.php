<?php use_helper('I18N', 'Date') ?>
<?php include_partial('resmanager/assets') ?>
<?php slot("pagetitle"); ?>Liste des réservations<?php end_slot(); ?>

<div id="sf_admin_container">
  <?php include_partial('resmanager/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('resmanager/list_header', array('pager' => $pager)) ?>
  </div>

  <div id="sf_admin_bar">
    <?php include_partial('resmanager/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <form action="<?php echo url_for('reservation_collection', array('action' => 'batch')) ?>" method="post">
    <?php include_partial('resmanager/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    <ul class="sf_admin_actions">
      <?php include_partial('resmanager/list_batch_actions', array('helper' => $helper)) ?>
      <?php include_partial('resmanager/list_actions', array('helper' => $helper)) ?>
    </ul>
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('resmanager/list_footer', array('pager' => $pager)) ?>
  </div>
</div>
