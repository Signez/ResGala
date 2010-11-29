<h4>Réservation effectuée avec succès !</h4>
<p>Votre réservation a été effectuée avec succès.</p>
<p>N'oubliez pas de venir la régler auprès du Bureau des Élèves avant le 
  <b class="rememberthisdate"><?php echo date('d/m/y', $reservation->getValidatedAt() + 15*24*3200); ?></b> ! Après cette date, elle sera
automatiquement annulée.</p>
<p style="text-align: center;"><a href="http://gala.insa-lyon.fr/">← Retour au site officiel</a></p>
<?php include_partial("infocheques"); ?>