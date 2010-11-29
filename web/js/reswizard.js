$(document).ready(function(){
  $(".plhowojs").remove();
  function updatecommandeprice(){
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
  if($(".wrapcommande").length > 0)
    updatecommandeprice();
  $(".wrapfield input").change(updatecommandeprice);
});