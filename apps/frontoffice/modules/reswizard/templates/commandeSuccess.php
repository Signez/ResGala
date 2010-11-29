<h3>Réservation (2/3) ⋅ Votre commande</h3>
<?php if(isset($errors) and count($errors)): ?>
  <div class="formerror">
    <p><strong>Oups ! Une erreur s'est glissée dans les informations que vous avez renseignées.</strong></p>
    <ul>
      <?php foreach($errors as $erreur): ?>
      <li><?php echo $erreur; ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>
<form action="<?php echo url_for("commande_save"); ?>" method="POST">
  <fieldset>
    <legend>Que souhaitez-vous réserver ?</legend>
    <p>Vous pouvez sélectionner ci-dessous les éléments que vous souhaitez réserver pour ce XV<sup>ème</sup> Gala.</p>
    <div class="wrapcommande">
      <?php foreach($produits as $produit): ?>
        <div class="wrapfield" price="<?php echo sprintf('%.2f', $produit->getPrix()); ?>">
          <p class="wraplabel"><?php echo $produit->getIntitule(); ?></p>
          <p class="wraphelp"><?php echo $produit->getDescription(); ?></p>
          <p class="wrapprix"><?php echo sprintf('%.2f', $produit->getPrix()); ?> €</p>
          <input type="text" name="commande[<?php echo $produit->getId(); ?>]"
                 value="<?php echo (isset($commande[intval($produit->getId())]))
                                   ? $commande[intval($produit->getId())]
                                   : $this->getParameter("commande[".$produit->getId().']') ?>"
                 placeholder="0" class="inqt <?php if(isset($errors['nan'.$produit->getId()])) echo " erroredfield"; ?>" />
        </div>
      <?php endforeach; ?>
    </div>
    <div class="soustotal">
      <p class="plhowojs">(Activez Javascript sur votre navigateur pour obtenir un sous-total)</p>
      <p>Sous-total : <strong>??.?? €</strong></p>
    </div>
  </fieldset>
  <p class="wrapnext">
    <a href="<?php echo url_for("start_reserv"); ?>">← Étape précédente</a>
    <input value="Étape suivante →" type="submit" />
  </p>
</form>
