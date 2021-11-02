var tr = $("#statutUtil tr");

$(function () {
    tr.hide();
})

$('#listeStatut').change(function () {
    var select = tr.filter($('tr#' + $(this).val())).show();
    tr.not(select).hide();
});
