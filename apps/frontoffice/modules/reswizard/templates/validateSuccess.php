<h3>Réservation (3/3) ⋅ Votre moyen de paiement et validation</h3>
<?php if($form->hasErrors()): ?>
  <div class="formerror">
    <p><strong>Oups ! Une erreur s'est glissée dans les informations que vous avez renseignées.</strong></p>
    <?php echo $form->renderGlobalErrors(); ?>
  </div>
<?php endif; ?>
<form action="<?php echo url_for("validate_save"); ?>" method="POST">
  <fieldset>
    <legend>Comment comptez-vous régler votre réservation ?</legend>
    <p>Si cette plateforme ne comprends pas de zone de paiement, il est préférable, pour que l'on puisse s'organiser
      convenablement, que vous nous indiquez ci-dessous le moyen de paiement que vous comptez utiliser.</p>
    <div class="wrapfield">
      <p class="wraplabel">Votre moyen de paiement au Bureau des Élèves :</p>
      <ul class="wrapchoices">
        <li><input type="radio" name="<?php echo $form["paye_with"]->renderName(); ?>" value="especes" id="paywitesp"
               <?php echo ($_POST['reservation']['paye_with'] == "especes") ? 'checked="checked"' : ''; ?> />
            <label for="paywitesp">En espèces</label></li>
        <li><input type="radio" name="<?php echo $form["paye_with"]->renderName(); ?>" value="cheque" id="paywitchk"
              <?php echo ($_POST['reservation']['paye_with'] == "cheque") ? 'checked="checked"' : ''; ?> />
            <label for="paywitchk">Par chèque</label></li>
      </ul>
      <?php echo $form["paye_with"]->renderError(); ?>
    </div>
    <?php echo $form["banque_nom"]->renderRow(array("placeholder" => "Banque Géniale")); ?>
    <p><strong>Attention :</strong> Vous disposez de <em>quinze jours</em> pour valider votre réservation en la réglant
      au Bureau des Élèves. Elle sera automatiquement annulée après cette date.</p>
  </fieldset>
  <p class="wrapnext">
    <?php echo $form->renderHiddenFields(); ?>
    <a href="<?php echo url_for("commande"); ?>">← Étape précédente</a>
    <input value="Valider la réservation →" type="submit" />
  </p>
</form>