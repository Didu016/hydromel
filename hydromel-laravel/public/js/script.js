var DEFAULT_PAGE = 'accueil';
var CURRENT_EDITION = "http://pingouin.heig-vd.ch/hydromel/getCurrentEdition";
var template;
var template2;
var template3;
var template4;
$(function(){
  template = $("#articleNews").clone();
  template2 = $("#articlePresse").clone();
  template3 = $("#articlePreviewSponsor").clone();
  template4 = $("#articleMembre").clone();
  $("#articlesAccueil").empty();
  $("#sponsorsAccueil").empty();
  $("#membresEquipe").empty();
  sliderSetting();
  menuHandler();
  $.getJSON(CURRENT_EDITION, function (json) {
      console.log(json);
      var descriptionHome = json.data.current_edition.edition.description;
      var place = json.data.current_edition.edition.place;
      var year = json.data.current_edition.edition.year;
      var start_date = json.data.current_edition.edition.start_date;
      var end_date = json.data.current_edition.edition.end_date;
      var articles = json.data.current_edition.articles;
      var sponsors =json.data.current_edition.sponsors;
      var descriptionTeam=json.data.current_edition.edition.team_description;
      var members = json.data.current_edition.members;
      $("#descriptionAccueil p").text(descriptionHome);
      if(place.length!==null){
        $("#lieuAccueil h2").text(place);
      }
      else {
        $("#lieuAccueil h2").text("Lieu encore non définit");
      }
      if(start_date.length!==null && end_date.length!==null ){
        $("#dateAccueil h2").text("Du "+start_date+ " au " + end_date);
      }
      else {
        $("#dateAccueil h2").text("Date encore non définit");
      }
      $.each(articles, function(i, article) {
        if(i>=3){return}
        if(article.articletype_name == "news"){
          var templateClone = template.clone();
          $('h2', templateClone).text(article.title);
          $('p', templateClone).text(article.description);
          var media = article.medias[0];
          var url= media.url;
          $(".imageArticle", templateClone).css('background-image','url('+url+')');
          $("#articlesAccueil").append(templateClone);
        }
        else {
          var template2Clone = template2.clone();
          $('h2', template2Clone).text(article.title);
          $('p', template2Clone).text(article.description);
          $("#articlesAccueil").append(template2Clone);
        }
      });
      $.each(sponsors, function(i, sponsor) {
        if(i>=16){return}
          var template3Clone = template3.clone();
          $('img', template3Clone).attr('src', sponsor.logo_url)
          $("#sponsorsAccueil").append(template3Clone);
      });
      $("#descriptionTeam p").addClass("displayNone");
      /*if(descriptionTeam.length!==null){
        $("#descriptionTeam p").text(descriptionTeam);
      }
      else{
        $("#descriptionTeam p").addClass(displayNone);
      }*/
      $.each(members, function(i, member) {
          if(i>=50){return}
          var template4Clone = template4.clone();
          $('img', template4Clone).attr('src', member.media_url);
          var prenomNom = member.firstname + ' ' + member.name;
          $('.prenomNomMembre', template4Clone).text(member.name);
          $('.reponsabiliteMembre', template4Clone).text(member.responsibility_name);
          $("#membresEquipe").append(template4Clone);
      });

  });
});
function menuHandler() {
    // History manipulation
    $(window).on("popstate", function(e) {
        var idPage = location.hash;
        idPage = idPage.substring(1);
        // test l'inexistance d'un élément
        if ($("#page_" + idPage).length == 0) {
            idPage = DEFAULT_PAGE;
            window.location = "#" + idPage;
        }
        switchPage(idPage);
    });
    $(window).trigger("popstate");
    // Responsive !
    /*$(window).on("resize", function () {
        if (Modernizr.mq(MQ_SMARTPHONE)) {
            $(".container > nav").off("click");
            $(".container > nav").on("click", function () {
                $(".container > nav ul").toggle();
            })
        } else {
            $(".container > nav").off("click");
            $(".container > nav ul").show();
        }
    })

    $(window).trigger("resize");*/
}

function switchPageWithHistory(pageId) {
    history.pushState(null, null, '#' + pageId);
    $(window).trigger('popstate');
}

function switchPage(pageId) {
    $(".sectionPage").hide();
    $("#page_" + pageId).show();
    if(pageId=="accueil") {
      $("video").resize()
    }
}
function sliderSetting() {
  $('.sliderImage').slick({
    centerMode: true,
    arrows: true,
    centerPadding: '60px',
    slidesToShow: 3,
    dots: true,
    infinite: true,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3000,
    variableWidth: true
  });
}
