<h3>Réservation (1/3) ⋅ Votre identité</h3>
<?php if($form->hasErrors()): ?>
  <div class="formerror">
    <p><strong>Oups ! Une erreur s'est glissée dans les informations que vous avez renseignées.</strong></p>
    <?php echo $form->renderGlobalErrors(); ?>
  </div>
<?php endif; ?>
<form action="<?php echo url_for("identity_save"); ?>" method="POST">
  <fieldset>
    <legend>Qui êtes-vous ?</legend>
    <p>La réservation est nominative, et bien que vous puissiez réserver plusieurs places à l'étape suivante,
      il est nécessaire que nous ayons connaissances de votre identité pour que vous puissiez retirer votre réservation.</p>
    <?php echo $form["login"]->renderRow(array("placeholder" => "pdupont")); ?>
    <?php echo $form["nom"]->renderRow(array("placeholder" => "Dupont")); ?>
    <?php echo $form["prenom"]->renderRow(array("placeholder" => "Paul")); ?>
  </fieldset>
  <p class="wrapnext"><?php echo $form->renderHiddenFields(); ?><input value="Étape suivante →" type="submit" /></p>
</form>
