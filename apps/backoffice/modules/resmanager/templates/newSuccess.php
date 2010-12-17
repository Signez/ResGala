<?php use_helper('I18N', 'Date') ?>
<?php include_partial('resmanager/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('New Resmanager', array(), 'messages') ?></h1>

  <?php include_partial('resmanager/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('resmanager/form_header', array('reservation' => $reservation, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('resmanager/form', array('reservation' => $reservation, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('resmanager/form_footer', array('reservation' => $reservation, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
