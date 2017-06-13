var DEFAULT_PAGE = 'accueil';

$(function(){
  console.log("hello");
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
  /*$(".blocDescription").animate({
      left: '50%',
      opacity: '1',
  });*/
  menuHandler();

  //black de la page d'accueil

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
}
