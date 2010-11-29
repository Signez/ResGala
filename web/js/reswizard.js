$(document).ready(function(){
  $(".plhowojs").remove();
  function updatecommandeprice(){
    var total = 0;
    $(".wrapfield input").each(function(){
      if($(this).val())
        total += parseInt($(this).val()) * parseFloat($(this).parent().attr('price'));
    });
    $(".soustotal strong").text(String(total.toFixed(2)) + " \u20ac");
  }
  if($(".wrapcommande").length > 0)
    updatecommandeprice();
  $(".wrapfield input").change(updatecommandeprice);
});