/**
 * Created by Carla on 08.06.17.
 */

var SERVER = "http://localhost:8000";

$(function () {
    switchPage($(".section_default").attr("id"));
    $(".mdl-navigation__link, .bouton_table, bouton_validerE").on("click", function () {
        switchPage($(this).attr("id").substr(4));
    });
    $(".btn_delete").on("click", deleteLine);
    $("#btn_delete_membre").on("click", deleteMember);

    $('.bouton_table').on('click', function () {
        var id = $(this).parent().prev().prev().prev('#sponsor_actif_nom').text();
        console.log(id);
    });
});


function switchPage(pageId) {
    $(".aCacher").hide();
    $("#" + pageId).show();
}


function deleteLine() {
    var id = $(this).attr("data-id");
    $("#membre_" + id).hide();
}

function deleteMember() {
    var id = $(this).attr("data-id");
    var token = $(this).attr("token");
    $.ajax({
        url: SERVER + "/auth/member/" + id,
        type: 'DELETE',
        data: {_token: token},
        success: function (success) {
            alert('Membre supprimé!');
        },
        error: function (error) {
            alert(error.responseText);
        }
    });
}



