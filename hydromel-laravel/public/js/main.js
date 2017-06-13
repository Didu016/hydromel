/**
 * Created by Carla on 08.06.17.
 */

$(function(){
    switchPage($(".section_default").attr("id"));
    $(".mdl-navigation__link, .bouton_table").on("click", function(){
        switchPage($(this).attr("id").substr(4));
    });
    $(".btn_delete").on("click", deleteLine);
});


function switchPage(pageId){
    $(".aCacher").hide();
    $("#" + pageId).show();
}


function deleteLine(){
    var id =$(this).attr("data-id");
    $("#membre_" + id).hide();
}

