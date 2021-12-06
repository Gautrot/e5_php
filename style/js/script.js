var tr = $("#statutUtil tr");

$(function () {
    tr.hide();
})

$('#listeStatut').change(function () {
    var select = tr.filter($('tr#' + $(this).val())).show();
    tr.not(select).hide();
});

$('.idInvite').select2();
$('.idEleve').select2();
$('.idPriseRDV').select2();
$('.organisateur').select2();