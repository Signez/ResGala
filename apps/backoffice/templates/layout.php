<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <title>Administration des réservations</title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body id="backoffice">
    <div class="allwrap">
      <div class="logowrap">
        <h1>Interface d'administration</h1>
        <h2><?php if(has_slot('pagetitle')) echo get_slot('pagetitle'); ?></h2>
      </div>
      <div class="mainwrap">
        <?php echo $sf_content ?>
      </div>
    </div>
  </body>
</html>
