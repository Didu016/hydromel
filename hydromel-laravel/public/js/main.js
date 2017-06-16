/**
 * Created by Carla on 08.06.17.
 */

$(function(){
    switchPage($(".section_default").attr("id"));
    $(".mdl-navigation__link, .bouton_table, bouton_validerE").on("click", function(){
        switchPage($(this).attr("id").substr(4));
    });
    $(".btn_delete").on("click", deleteLine);

    $('#btn_modifier_sponsor').on('click', function(){
        var sponsor_id =$(this).parent().prev().prev().prev().prev('#id').text();
        var sponsor_nom =$(this).parent().prev().prev().prev('#sponsor_actif_nom').text();
        var sponsor_rank =$(this).parent().prev().prev('#sponsor_actif_rank').text();
        console.log(sponsor_id, sponsor_nom, sponsor_rank);
    });

    $('body').on('click', '#btn_modifier_membre',function(){
        var membre_id =$(this).parent().prev().prev().prev().prev().prev('#id').text();
        //Obliger diviser!!!!
        var membre_nom =$(this).parent().prev().prev().prev('.membre_nom').text();
        var membre_mail =$(this).parent().prev().prev('.membre_mail').text();
        var membre_respo =$(this).parent().prev('.membre_respo').text();

        $('#id_member').attr("value", membre_id);
        console.log(membre_id);
    });

    $('#btn_modifier_news').on('click', function () {
        var article_news_id = $(this).parent().prev().prev().prev().prev('#id').text();
        //Obliger diviser!!!!
        var article_news_titre = $(this).parent().prev().prev().prev('.article_news_titre').text();
        var article_news_resume = $(this).parent().prev().prev('.article_news_resume').text();
        console.log(article_news_id, article_news_titre, article_news_resume);
    });

    $('#btn_modifier_presse').on('click', function () {
        var article_presse_id = $(this).parent().prev().prev().prev('#id').text();
        //Obliger diviser!!!!
        var article_presse_titre = $(this).parent().prev().prev('#article_presse_titre').text();
        var article_presse_lien = $(this).parent().prev('#article_presse_lien').text();
        console.log(article_presse_id, article_presse_titre, article_presse_lien);
    });

    $('#btn_modifier_media').on('click', function () {
        var media_id = $(this).parent().prev().prev().prev().prev('#id').text();
        //Obliger diviser!!!!
        var media_titre = $(this).parent().prev().prev().prev('#media_titre').text();
        var media_description = $(this).parent().prev('#media_description').text();
        console.log(media_id, media_titre, media_description);
    });

    $('#btn_modifier_prix').on('click', function () {
        var prix_id = $(this).parent().prev().prev().prev().prev().prev().prev('#id').text();
        //Obliger diviser!!!!
        var prix_distinction = $(this).parent().prev().prev().prev().prev().prev('.prix_distinction').text();
        var prix_position = $(this).parent().prev().prev().prev('.prix_distinction').text();
        var prix_description = $(this).parent().prev().prev('.prix_description').text();
        var prix_value = $(this).parent().prev('.prix_value').text();

        $('#reward_id').attr("value", prix_id);
        console.log(prix_id, prix_distinction, prix_position, prix_description,prix_value);
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

function modifMembre() {
    var membre_id =$(this).parent().prev().prev().prev().prev().prev('#id').text();
    //Obliger diviser!!!!
    var membre_nom =$(this).parent().prev().prev().prev('.membre_nom').text();
    var membre_mail =$(this).parent().prev().prev('.membre_mail').text();
    var membre_respo =$(this).parent().prev('.membre_respo').text();
    console.log(membre_id,membre_nom);

}



