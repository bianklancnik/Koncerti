"use strict";

function clicked() {
    var potrdi = confirm('Želite rezervirati karte?')
    if (potrdi) {
        return true;
    } 
    else {
        return false;
    }
}

function izbrisi() {
    var potrdi = confirm('Želite izbrisati dogodek?')
    if (potrdi) {
        return true;
    } 
    else {
        return false;
    }
}

function izbrisiRez() {
    var potrdi = confirm('Želite preklicati rezervacijo?')
    if (potrdi) {
        return true;
    } 
    else {
        return false;
    }
}

$(document).ready(function(){
    $("#search").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $(".koncertOkno").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });

$(document).ready(function(){
    $("#order").on('change', function(){
        const vrednost = $(this).val();
        $.ajax({
            url:"order.php",
            type: "POST",
            data:{vrednost:vrednost},
            success:function(data){
                $('#koncerti').html(data);
            }
        })
    });
});