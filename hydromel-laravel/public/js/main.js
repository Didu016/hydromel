/**
 * Created by Carla on 08.06.17.
 */

$(function(){
    switchPage($(".section_default").attr("id"));
    $(".mdl-navigation__link, .bouton_table, bouton_validerE").on("click", function(){
        switchPage($(this).attr("id").substr(4));
    });
    $(".btn_delete").on("click", deleteLine);

    $('.bouton_table').on('click', function(){
        var id =$(this).parent().prev().prev().prev('#sponsor_actif_nom').text();
        console.log(id);
    });
});


function switchPage(pageId){
    $(".aCacher").hide();
    $("#" + pageId).show();
}


function deleteLine(){
    var id =$(this).attr("data-id");
    $("#membre_" + id).hide();
}



