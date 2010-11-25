<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <title><?php if(has_slot('pagetitle')) echo get_slot('pagetitle')." − "; ?>Plateforme de réservation du XVème Gala de l'INSA de Lyon</title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <div class="allwrap">
      <div class="logowrap">
        <h1>Gala XV de l'INSA de Lyon</h1>
        <h2>Plateforme de réservation<?php if(has_slot('pagetitle')) echo ' ⋅ '.get_slot('pagetitle'); ?></h2>
      </div>
      <div class="mainwrap">
        <?php echo $sf_content ?>
      </div>
    </div>
  </body>
</html>
