$(document).ready(function(){
  // =====================================================
  // Étape 2 - Ajout des produits
  // =====================================================

  $(".plhowojs").remove();
  function updateCommandePrice(){
    var total = 0;

    // On boucle sur tous les inputs
    $(".wrapfield input").each(function(){
      if($(this).val())
        total += parseInt($(this).val()) * parseFloat($(this).parent().attr('price'));
    });

    // On affiche le sous-total informatif
    $(".soustotal strong").text(String(total.toFixed(2)) + " \u20ac");

    // Si le total est nul, on ne peut continuer l'assitant (hey oh, quand même)
    if(total == 0)
      $(".wrapnext input").attr("disabled", "disabled");
    else
      $(".wrapnext input").attr("disabled", "");
  }

  if($(".wrapcommande").length > 0){
    updateCommandePrice();
    $(".wrapcommande .wrapfield input").change(updateCommandePrice);
  }

  // =====================================================
  // Étape 3 - Paiement et récaptiulatif
  // =====================================================

  function updateAfficheNomBanque(){
    if(!$("#paywitesp").is(":checked") && !$("#paywitchk").is(":checked"))
      $(".wrapnext input").attr("disabled", "disabled");
    else
      $(".wrapnext input").attr("disabled", "");

    if($("#paywitchk").is(":checked")){
      $(".wrapfield:has(#reservation_banque_nom)").stop(true, true)
        .animate({height: "show", opacity: "show", marginTop: "1em", marginBottom: "1em"});
    }else{
      $(".wrapfield:has(#reservation_banque_nom)").stop(true, true)
        .animate({height: "hide", opacity: "hide", marginTop: 0, marginBottom: 0});
    }
  }

  if($("#paywitchk").length > 0){
    if(!$("#paywitchk").is(":checked")){
      $(".wrapfield:has(#reservation_banque_nom)").hide();
    }
    updateAfficheNomBanque();
    $(".wrapchoices input").change(updateAfficheNomBanque);
  }
});