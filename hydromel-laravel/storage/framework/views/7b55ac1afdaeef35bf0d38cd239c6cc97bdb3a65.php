<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <title>Hydrocontest HEIG-VD</title>
    <script src="js/jquery-3.2.1.js" type="text/javascript"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="js/script.js" type="text/javascript"></script>
    <script src="js/jquery.vide.js" type="text/javascript"></script>
    <script src="js/slick.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
<div class="loader"></div>
<?php echo $__env->make("menu", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <section class="sectionPage" id="page_accueil">
        <section class="sectionAccueil">
            <div style="width: 100%; height: auto;"
                data-vide-bg="mp4: vid/videoAcceuil2, poster: img/HydroHEIGBateau2016.jpg"
                data-vide-options="posterType: jpg, loop: true, muted: false, position: 0% 0%">
            </div>
            <div class="blocDescription">
                <h1><span>Accueil</span></h1>
                <p></p>
            <div class="link-slideright">
                <p>Vivamus massa magna, venenatis id commodo at, ultricies sit amet tortor. Praesent semper urna tincidunt, sodales tellus nec, finibus nunc. Proin rutrum porta tortor, efficitur maximus tellus porttitor pellentesque. Sed blandit posuere ultricies. Proin tempus augue nunc, luctus vehicula tellus porttitor pellentesque. Etiam lacinia vulputate sem, quis tincidunt orci porta id.</p>
            </div>
            </div>
        </section>
        <section class="sectionLieuDate">
                <div class="blockLieuDate">
                    <!-- On aura ici, soit  un message d'e remplacement "lieu et date pas encore définit" soit le contenu-->
                    <p><h2>Lieu</h2></p>
                    <p><h2>Date début et date fin</h2></p>
                </div>
        </section>
        <section class="sectionArticle">
            <article class="article articleNews">
                <div class="imageArticle"></div>
                <div class="blocArticleNewsTexte">
                    <h2>Titre</h2>
                    <p>Praesent semper urna tincidunt, sodales tellus nec, finibus nunc. Proin rutrum porta tortor, efficitur maximus tellus porttitor pellentesque. Sed blandit posuere ultricies. Proin tempus augue nunc, luctus vehicula tellus porttitor pellentesque. Etiam lacinia vulputate sem, quis tincidunt orci porta id.</p>
                    <button><a href="#">Lire plus</a></button>
                </div>
            </article>
            <article class="article articleNews">
                <div class="imageArticle"></div>
                <div class="blocArticleNewsTexte">
                    <h2>Titre</h2>
                    <p>Vivamus massa magna, venenatis id commodo at, ultricies sit amet tortor. Praesent semper urna tincidunt, sodales tellus nec, finibus nunc. Proin rutrum porta tortor, efficitur maximus tellus porttitor pellentesque. Sed blandit posuere ultricies. Proin tempus augue nunc, luctus vehicula tellus porttitor pellentesque. Etiam lacinia vulputate sem, quis tincidunt orci porta id.</p>
                    <button><a href="#">Lire plus</a></button>
                </div>
            </article>
            <article class="article articlePresse">
                <div class="blocArticlePresseTexte">
                    <h2>Titre</h2>
                    <p>LLorem ipsum dolor sit amet, conseLorem ipsum dolor sit amet, conseLorem ipsum dolor sit amet, conseLorem ipsum dolor sit amet, conseLorem ipsum dolor sit amet, conseLorem ipsum dolor sit amet, conseorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus massa magna, venenatis id commodo at, ultricies sit amet tortor. </p>
                    <button><a href="#">Lire plus</a></button>
                </div>
            </article>
        </section>
        <section class="sectionPreviewSponsor">
            <p><h1>Sponsor</h1></p>
            <div class="blocSponsor">
                <article>
                    <img src="img/logoHydro.png">
                </article>
                <article>
                    <img src="img/logoHydro.png">
                </article>
                <article>
                    <img src="img/logoHydro.png">
                </article>
                <article>
                    <img src="img/logoHydro.png">
                </article>
            </div>
        </section>
    </section>
    <!--PAGE L?EQUIPE-->
    <section class="sectionPage" id="page_equipe">
        <header id="headerEquipe"></header>
        <section class="titrePage"><h1>L'équipe</h1></section>
        <section class="sectionDescription">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus massa magna, venenatis id commodo at, ultricies sit amet tortor. Praesent semper urna tincidunt, sodales tellus nec, finibus nunc. Proin rutrum porta tortor, efficitur maximus tellus porttitor pellentesque. Sed blandit posuere ultricies. Proin tempus augue nunc, luctus vehicula tellus porttitor pellentesque. Etiam lacinia vulputate sem, quis tincidunt orci porta id.</p>
        </section>
        <section class="sectionMembre">
            <article>
                <img src="img/johnaesch.jpg">
                <p>Philippe Spat</p><p>Responsabilité</p>
            </article>
            <article>
                <img src="img/joncoel.jpg">
                <p>Philippe Spat</p><p>Responsabilité</p>
            </article>
            <article>
            <img src="img/mathfa.jpg">
                <p>Philippe Spat</p><p>Responsabilité</p>
            </article>
            <article>
                <img src="img/johnaesch.jpg">
                <p>Philippe Spat</p><p>Responsabilité</p>
            </article>
            <article>
                <img src="img/joncoel.jpg">
                <p>Philippe Spat</p><p>Responsabilité</p>
            </article>
            <article>
            <img src="img/mathfa.jpg">
                <p>Philippe Spat</p><p>Responsabilité</p>
            </article>
        </section>
    </section>
    <!--PAGE ACTUALITE-->
    <section class="sectionPage" id="page_actualite">
        <header id="headerActualite"></header>
        <section class="titrePage"><h1>Actualités</h1></section>
        <section class="sectionArticle">
            <article class="article articleNews">
                <div class="imageArticle"></div>
                <div class="blocArticleNewsTexte">
                    <h2>Titre</h2>
                    <p>Praesent semper urna tincidunt, sodales tellus nec, finibus nunc. Proin rutrum porta tortor, efficitur maximus tellus porttitor pellentesque. Sed blandit posuere ultricies. Proin tempus augue nunc, luctus vehicula tellus porttitor pellentesque. Etiam lacinia vulputate sem, quis tincidunt orci porta id.</p>
                    <button><a href="#">Lire plus</a></button>
                </div>
            </article>
            <article class="article articleNews">
                <div class="imageArticle"></div>
                <div class="blocArticleNewsTexte">
                    <h2>Titre</h2>
                    <p>Vivamus massa magna, venenatis id commodo at, ultricies sit amet tortor. Praesent semper urna tincidunt, sodales tellus nec, finibus nunc. Proin rutrum porta tortor, efficitur maximus tellus porttitor pellentesque. Sed blandit posuere ultricies. Proin tempus augue nunc, luctus vehicula tellus porttitor pellentesque. Etiam lacinia vulputate sem, quis tincidunt orci porta id.</p>
                    <button><a href="#">Lire plus</a></button>
                </div>
            </article>
            <article class="article articlePresse">
                <div class="blocArticlePresseTexte">
                    <h2>Titre</h2>

                    <p>Lorem ipsum dolor sit amet,
                      consectetur adipiscing elit. $
                      Vivamus massa magna, venenatis id commodo at,
                       ultricies sit amet tortor. </p>
                    <button><a href="#">Lire plus</a></button>
                </div>
            </article>
            <section id="navArticle">
              <ul class="center">
                  <li><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
              </ul>
            </section>
        </section>
        <section class="sectionMedia">
          <section class="titrePage"><h1>Médias</h1></section>
          <div class="sliderImage">
            <div>
              <img src="img/HydroHEIGBateau2016.jpg">
            </div>
            <div>
              <img src="img/stTropez.jpg">
            </div>
            <div>
              <img src="img/joncoel.jpg">
            </div>
            <div>
              <img src="img/HydroHEIGBateau2016.jpg">
            </div>
          </div>
        </section>
    </section>
    <!--PAGE SPONSORS-->
    <section class="sectionPage" id="page_sponsor">
        <header id="headerSponsor"></header>
        <section class="titrePage"><h1>SPONSORS</h1></section>
        <section class="sectionSponsor">
            <article>
                <img src="img/johnaesch.jpg">
                <p>Philippe Spat</p>
            </article>
            <article>
                <img src="img/joncoel.jpg">
                <p>Philippe Spat</p>
            </article>
            <article>
            <img src="img/mathfa.jpg">
                <p>Philippe Spat</p>
            </article>
            <article>
                <img src="img/johnaesch.jpg">
                <p>Philippe Spat</p>
            </article>
            <article>
                <img src="img/joncoel.jpg">
                <p>Philippe Spat</p>
            </article>
            <article>
            <img src="img/mathfa.jpg">
                <p>Philippe Spat</p>
            </article>
        </section>
        <section class="sectionDescription">
            <p>Comment devenir sponsor ? <button><a href="#">Informations</a></button></p>

        </section>
    </section>
    <!--PAGE EDITION PRECEDENTE-->
    <section class="sectionPage" id="page_edition">
        <header id="headerEdition"></header>
        <section class="titrePage"><h1>SPONSORS</h1></section>
        <section class="sectionEdition">
            <select name="yearpicker" id="yearpicker"></select>
        </section>
        <section class="sectionDescription">
            <p>Comment devenir sponsor ? <button><a href="#">Informations</a></button></p>

        </section>
    </section>
</body>
</html>
