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
  <fieldset class="recapcommande">
    <legend>Êtes-vous sûr du contenu de votre réservation ?</legend>
    <p>Voici un petit récapitulatif de ce que vous avez renseigné sur cette plateforme.</p>
    <p>Réservation (non validée) de <strong><?php echo $identity["prenom"].' '.$identity["nom"]; ?></strong>
       <?php if(isset($identity["num_insa"]) && $identity["num_insa"]) 
          echo " ⋅ Étudiant ou diplômé INSA n°<strong>".$identity["num_insa"]."</strong>";
        if(isset($identity["login"]) && $identity["login"])
          echo " ⋅ Login INSA : <strong>".$identity["login"]."</strong>"; ?>
    <?php 
      $total = 0; // Calculer le montant total ici est contraire à la convention de Genève, je sais.
      foreach($produits as $produit):
        if(isset($commande[$produit->getId()])):
           $total += $produit->getPrix()*$commande[$produit->getId()]; ?>
      <div class="wrapfield">
        <p class="wraplabel"><?php echo $produit->getIntitule(); ?></p>
        <p class="wraphelp"><?php echo $produit->getDescription(); ?></p>
        <p class="wrapprix"><?php echo sprintf('%.2f', $produit->getPrix())." € × ".$commande[$produit->getId()]." = "
                                        .sprintf('%.2f', $produit->getPrix()*$commande[$produit->getId()]); ?> €</p>
        <p class="rappelintq"><?php echo $commande[$produit->getId()]; ?></p>
      </div>
    <?php
        endif;
      endforeach; ?>
    <p class="soustotal">Sous-total : <strong><?php echo sprintf('%.2f', $total); ?> €</strong></p>
    <p>Ce montant sera à régler avant le <strong><?php echo date('d/m/y', time() + 15*24*3200); ?></strong>, sans quoi la réservation sera
    annulée.</p>
    <?php include_partial("infocheques"); ?>
  </fieldset>
  <p class="wrapnext">
    <?php echo $form->renderHiddenFields(); ?>
    <a href="<?php echo url_for("commande"); ?>">← Étape précédente</a>
    <input value="Valider la réservation →" type="submit" />
  </p>
</form>