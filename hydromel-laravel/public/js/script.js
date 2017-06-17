var DEFAULT_PAGE = 'accueil';
<<<<<<< HEAD

$(function(){
  /*$(".blocDescription").animate({
      left: '50%',
      opacity: '1',
  });*/
  menuHandler();
  
  //black de la page d'accueil

=======
var CURRENT_EDITION = "http://pingouin.heig-vd.ch/hydromel/getCurrentEdition";
var PREVIOUS_EDITION = "http://pingouin.heig-vd.ch/hydromel/editions/";
var template;
var template2;
var template3;
var template4;
var template5;
var template6;
var template7;
var template8;
var template9;

$(function(){

  template = $("#articleNews").clone();
  template2 = $("#articlePresse").clone();
  template3 = $("#articlePreviewSponsor").clone();
  template4 = $("#articleMembre").clone();
  template5 = $(".navArticleBoutton").clone();
  template6 = $("#sliderImageActualite div").clone();
  template7 = $("#articleSponsor").clone();
  template8 = $("#choixEditionEdition button").clone();
  template9 = $("#rewardEdition").clone();
  $("#articlesAccueil").empty();
  $("#sponsorsAccueil").empty();
  $("#membresEquipe").empty();
  $("#articlesActualite").empty();
  $("#navArticle ul").empty();
  $("#sliderImageActualite").empty();
  $("#sponsorSponsor").empty();
  $("#choixEditionEdition").empty();
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
      var medias = json.data.current_edition.medias;
      var previousEditions=json.data.previous_editions;
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
          if(article.description.length>=150){
            $('p', templateClone).text(article.description.substring(0, 150)+"...");
          }
          else{
              $('p', templateClone).text(article.description);
          }
          $('date', templateClone).text(article.created_at.date.substring(0, 10));
          if(article.medias[0]==null){
            $(".imageArticle", templateClone).css('background-image','url(http://hydro.heig-vd.ch/wp-content/uploads/2017/03/cropped-DSC_0173.jpg)');
          }
          else{
            var media = article.medias[0];
            var url= media.url;
            $(".imageArticle", templateClone).css('background-image','url('+url+')');
          }
          $('a', templateClone).attr('data', article.id);
          $("#articlesAccueil").append(templateClone);
        }
        else {
          var template2Clone = template2.clone();
          $('h2', template2Clone).text(article.title);
          $('p', template2Clone).text(article.description);
          $('date', template2Clone).text(article.created_at.date.substring(0, 10));
          $('a', template2Clone).attr('data', article.id);
          $("#articlesAccueil").append(template2Clone);
        }
      });
      $.each(sponsors, function(i, sponsor) {
        if(i>=16){return}
          var template3Clone = template3.clone();
          $('img', template3Clone).attr('src', sponsor.logo_url);
          $('a', template3Clone).attr('href', sponsor.link);
          $("#sponsorsAccueil").append(template3Clone);
      });
      //PAGE MEMBRE
      if(descriptionTeam.length!==null){
        $("#descriptionTeam p").text(descriptionTeam);
      }
      else{
        $("#descriptionTeam p").addClass(displayNone);
      }

      $.each(members, function(i, member) {
          if(i>=50){return}
          var template4Clone = template4.clone();
          $('img', template4Clone).attr('src', member.media_url);
          var prenomNom = member.firstname + ' ' + member.name;
          $('.prenomNomMembre', template4Clone).text(member.name);
          $('.reponsabiliteMembre', template4Clone).text(member.responsibility_name);
          $("#membresEquipe").append(template4Clone);
      });
      //Page actualité
      var numPage = 0;
      $.each(articles, function(i, article) {
      if(i % 3 ==0){
          numPage++;
          $("<section></section>").attr('id','articlesActualitePage'+ numPage ).addClass("articlesActualitePage").appendTo('#articlesActualite');
          var template5Clone = template5.clone();
          $('li', template5Clone);
          $('a', template5Clone).attr('data','#articlesActualitePage'+ numPage).text(numPage);
          $('#navArticle ul').append(template5Clone);
          if(article.articletype_name == "news"){
              var templateClone = template.clone();
              $('h2', templateClone).text(article.title);
              if(article.description.length>=150){
                $('p', templateClone).text(article.description.substring(0, 150)+"...");
              }
              else{
                  $('p', templateClone).text(article.description);
              }
              $('date', template2Clone).text(article.created_at.date.substring(0, 10));
              if(article.medias[0]==null){
                $(".imageArticle", templateClone).css('background-image','url(http://hydro.heig-vd.ch/wp-content/uploads/2017/03/cropped-DSC_0173.jpg)');
              }
              else{
                var media = article.medias[0];
                var url= media.url;
                $(".imageArticle", templateClone).css('background-image','url('+url+')');
              }
              $('a', templateClone).attr('data', article.id);
              $("#articlesActualitePage"+ numPage).append(templateClone);
          }
          else {
              var template2Clone = template2.clone();
              $('h2', template2Clone).text(article.title);
              $('p', template2Clone).text(article.description);
              $('date', template2Clone).text(article.created_at.date.substring(0, 10));
              $("#articlesActualitePage"+ numPage).append(template2Clone);
          }
      }
      else{
          if(article.articletype_name == "news"){
              var templateClone = template.clone();
              $('h2', templateClone).text(article.title);
              if(article.description.length>=150){
                $('p', templateClone).text(article.description.substring(0, 150)+"...");
              }
              else{
                  $('p', templateClone).text(article.description);
              }
              $('date', templateClone).text(article.created_at.date.substring(0, 10));
              if(article.medias[0]==null){
                $(".imageArticle", templateClone).css('background-image','url(http://hydro.heig-vd.ch/wp-content/uploads/2017/03/cropped-DSC_0173.jpg)');
              }
              else{
                var media = article.medias[0];
                var url= media.url;
                $(".imageArticle", templateClone).css('background-image','url('+url+')');
              }
              $('a', templateClone).attr('data', article.id);
              $("#articlesActualitePage"+ numPage).append(templateClone);
          }
          else {
              var template2Clone = template2.clone();
              $('h2', template2Clone).text(article.title);
              $('p', template2Clone).text(article.description);
              $('date', template2Clone).text(article.created_at.date.substring(0, 10));
              $("#articlesActualitePage"+ numPage).append(template2Clone);
          }
      }
      });
      navArticle()
      $.each(medias, function(i, media) {
        if(i>=100){return}
          var template6Clone = template6.clone();
          $('img', template6Clone).attr('src', media.url);
          $("#sliderImageActualite").append(template6Clone);
      });
    sliderSetting();
    var boutton = $(".navArticleBoutton:first-child")
    $('a', boutton).attr('selected','selected');
    $(".navArticleBoutton").on("click", function (){
        $('body').animate({
            scrollTop: $("#titrePageActualite").offset().top
        }, 1000);
        $(".navArticleBoutton a").removeAttr("selected");
        $(".articlesActualitePage").hide();
        var attr=$('a', this).attr("data");
        $('a', this).attr('selected','selected');
        navArticleShow(attr);
    });
    //Page SPONSORS
    $.each(sponsors, function(i, sponsor) {
      if(i>=50){return}
        var template7Clone = template7.clone();
        $('img', template7Clone).attr('src', sponsor.logo_url);
        $('p', template7Clone).text(sponsor.society);
        $("#sponsorSponsor").append(template7Clone);
        console.log(sponsor.logo_url);
    });
    //PAGE EDITION

    $.each(previousEditions, function(i, edition) {
      if(i>=50){return}
      var template8Clone = template8.clone();
      $('button', template8Clone);
      $('a', template8Clone).attr('data', edition.id).text(edition.year);
      $('#choixEditionEdition').append(template8Clone);
    });

    $(".navChoixEdition").on("click", function (){
      console.log("hello3");
        $("#sliderImageEdition").empty();
        $("#articlesEdition").empty();
        $("#rewardsEdition").empty();
        var id_edition = $('a', this).attr("data");
        $.getJSON(PREVIOUS_EDITION+id_edition, function (json) {
          var descriptionEdition = json.data.edition.description;
          var articlesEdition = json.data.articles;
          var members = json.data.members;
          var rewards = json.data.rewards;
          if(descriptionEdition.length!==null){
            $("#descriptionEdition p").text(descriptionEdition);
          }
          else{
            $("#descriptionEdition p").addClass(displayNone);
          }
          $.each(rewards, function(i, reward) {
            if(i>=6){return}
            var template11Clone = template9.clone();
            $('.positionEdition', template11Clone).text(reward.position);
            $('.distinctionEdition', template11Clone).text(reward.distinction);
            $('.descriptionDistinctionEdition', template11Clone).text(reward.description);
            console.log(template11Clone);
            $("#rewardsEdition").append(template11Clone);
          });
          $.each(articlesEdition, function(i, article) {
            if(i>=3){return}
            if(article.articletype_name == "news"){
              var templateClone = template.clone();
              $('h2', templateClone).text(article.title);
              if(article.description.length>=150){
                $('p', templateClone).text(article.description.substring(0, 150)+"...");
              }
              else{
                  $('p', templateClone).text(article.description);
              }
              $('date', templateClone).text(article.created_at.date.substring(0, 10));
              $('a', templateClone).attr('data', article.id);
              if(article.medias[0]==null){
                $(".imageArticle", templateClone).css('background-image','url(http://hydro.heig-vd.ch/wp-content/uploads/2017/03/cropped-DSC_0173.jpg)');
              }
              else{
                var media = article.medias[0];
                var url= media.url;
                $(".imageArticle", templateClone).css('background-image','url('+url+')');
              }
              $("#articlesEdition").append(templateClone);
            }
            else {
              var template9Clone = template2.clone();
              $('h2', template9Clone).text(article.title);
              $('p', template9Clone).text(article.description);
              $('date', template9Clone).text(article.created_at.date.substring(0, 10));

              $("#articlesEdition").append(template9Clone);
            }
          });
          $.each(members, function(i, member) {
            if(i>=50){return}
            var template4Clone = template4.clone();
            $('img', template4Clone).attr('src', member.media_url);
            var prenomNom = member.firstname + ' ' + member.name;
            $('.prenomNomMembre', template4Clone).text(prenomNom);
            $('.reponsabiliteMembre', template4Clone).text(member.responsibility_name);
            $("#sliderImageEdition").append(template4Clone);
          });
          });
        $(".navChoixEdition a").removeAttr("selected");
        $(".articlesActualitePage").hide();
        var attr=$('a', this).attr("data");
        $('a', this).attr('selected','selected');
    });
    $(".navChoixEdition:last-child").trigger("click");
    $(".navArticleBoutton:first-child").trigger("click");
    //PAGE ARTICLE
    $(".blocArticleNewsTexte button").on("click", function (){
      console.log("teste");
      switchPageWithHistory("article");
      var  id=$('a', this).attr("data");
      $.each(articles, function(i, article) {
        if(article.id==id){
          $("#titrePageArticle h1").text(article.title);
          if(article.medias[0]==null){
            $(".imageArticleComplet").css('background-image','url(http://hydro.heig-vd.ch/wp-content/uploads/2017/03/cropped-DSC_0173.jpg)');
          }
          else{
            var media = article.medias[0];
            var url= media.url;
            $(".imageArticleComplet").css('background-image','url('+url+')');
          }
          $("#sectionDescriptionArticle").text(article.description);
        }
      });
    });
  });
  /*var fixmeTop = $('.sectionChoixEdition').offset().top;
  $(window).scroll(function() {                  // assign scroll event listener
    var currentScroll = $(window).scrollTop(); // get current position
    if (currentScroll >= fixmeTop) {           // apply position: fixed if you
        $('.sectionChoixEdition').css({                      // scroll to that element or below it
            position: 'fixed',
            top: '100',
            width:'90%',
            float:'left',
            background:'#f9f9f9'
        });
    } else {                                   // apply position: static
        $('.sectionChoixEdition').css({                      // if you scroll above it
            position: 'static',
            width:'100%',
            background:'#fff',
            border:'0'
        });
    }
  });*/
>>>>>>> 792c8c4c38a097dc028dd64e12ae05ff1368c028
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
<<<<<<< HEAD
=======

>>>>>>> 792c8c4c38a097dc028dd64e12ae05ff1368c028
        }
        switchPage(idPage);
    });
    $(window).trigger("popstate");
<<<<<<< HEAD
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
=======
>>>>>>> 792c8c4c38a097dc028dd64e12ae05ff1368c028
}

function switchPageWithHistory(pageId) {
    history.pushState(null, null, '#' + pageId);
    $(window).trigger('popstate');
}

function switchPage(pageId) {
    $(".sectionPage").hide();
    $("#page_" + pageId).show();
<<<<<<< HEAD
=======
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
function sliderMembreSetting() {
  $('.sliderMembre').slick({
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

function navArticle() {
  console.log("helo");
    $(".articlesActualitePage").hide();
    $("#articlesActualitePage1").show();
}
function navArticleShow(pageShow) {
    $(pageShow).show();
>>>>>>> 792c8c4c38a097dc028dd64e12ae05ff1368c028
}
