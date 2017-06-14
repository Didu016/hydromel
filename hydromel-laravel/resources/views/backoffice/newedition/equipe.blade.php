<!doctype html>

<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Admin hydrocontest HEIG-VD">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Hydrocontest HEIG-VD</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="{{url('img/backoffice/android-desktop.png')}}">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Admin HEIG-VD">
    <link rel="apple-touch-icon-precomposed" href="{{url('img/backoffice/ios-desktop.png')}}">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="{{url('img/backoffice/favicon.png')}}">


    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/style/material.min.css')}}">
    <link rel="stylesheet" href="{{url('css/style/styles.css')}}">
    <script src="{{url('js/jquery.js')}}"></script>
    <script src="{{url('js/main.js')}}" type="text/javascript"></script>

</head>
<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header mdl-layout__header--scroll mdl-color--teal-400">
        <div class="mdl-layout--large-screen-only mdl-layout__header-row">
        </div>
        <div class="mdl-layout  mdl-layout__header-row">
            <h3 class="titrePage">L'équipe</h3>
        </div>
        <div class="mdl-layout--large-screen-only mdl-layout__header-row">
        </div>

    </header>

    <div class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-layout__tab-panel is-active" id="overview">
            <section class=" mdl-grid ">
                <div class="pages_blocs mdl-card mdl-shadow--2dp mdl-cell mdl-cell--10-col-desktop mdl-cell---col-tablet mdl-cell--4-col-phone">
                    <div class="mdl-card__supporting-text mdl-cell--12-col-desktop ">
                        <div class="mdl-card__supporting-text mdl-grid mdl-grid--no-spacing">
                            <header class="mdl-layout__header  mdl-color--teal-400">
                                <div class="demo-navigation mdl-layout--large-screen-only mini_header mdl-layout__header-row">
                                    <a class="mdl-navigation__link" href="#" id="lnk_description"><h4>Description</h4></a>
                                    <a class="mdl-navigation__link" href="#" id="lnk_membres"><h4>Membres</h4></a>

                                </div>
                            </header>
                            <section class="aCacher section_default" id="description">
                                <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                                    <h5>Ecrivez votre description</h5>
                                    <textarea id="equipe_description" rows="8"></textarea>
                                </div>
                            </section>
                            <section class="aCacher" id="membres">
                                <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                                    <table class="mdl-data-table">
                                        <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th class="large">Membres</th>
                                            <th class="large"> Mail</th>
                                            <th>Responsabilité</th>
                                            <th> Mod</th>
                                            <th>Suppr</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr id="membre_2">
                                            <td class="membre_actif_image">image</td>
                                            <td class="membre_actif_nom">Le nom long d'un Membre</td>
                                            <td class="membre_actif_mail">mailAT.com</td>
                                            <td class ="membre_actif_respo">La responsabilité</td>
                                            <td><button id="btn_modifier_membre" class="bouton_table"><i class="mdl-color-text--blue-grey-400 material-icons" role="button">create</i></button></td>
                                            <td><button data-id="2" id="btn_delete_membre" class="bouton_table"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">delete</i></button></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <button id="btn_ajout_membre" class="bouton_ajout bouton_table"><i class="bouton_table mdl-color-text--blue-grey-400 material-icons" role="presentation">add_circle</i></button>
                                </div>
                            </section>
                            <section class="aCacher" id="ajout_membre">
                                <h5>Ajouter un nouveau membre</h5>
                                <p>Nom <input id="membre_nouveau_nom" type="text"></p>
                                <p>Prenom <input id="membre_nouveau_prenom" type="text"></p>
                                <p>Mail <input id="membre_nouveau_mail" type="email"></p>
                                <input id="membre_nouveau_image" type="file" accept="image">
                                <div>
                                    Responsabilité <select id="membre_nouveau_resp">
                                        <option class="liste_resp">les differentes options ici</option>
                                    </select>
                                </div>

                            </section>
                            <section class="aCacher" id="modifier_membre">
                                <h5>Modifier un membre</h5>
                                <input type="hidden" name="id" value="">
                                <p>Nom <input id="membre_modifier_nom" type="text"></p>
                                <p>Prenom <input id="membre_modifier_prenom" type="text"></p>
                                <p>Mail <input id="membre_modifier_mail" type="email"></p>
                                <input id="membre_modifier_image" type="file" accept="image">
                                <div>
                                    Responsabilité <select id="membre_modifier_resp">
                                        <option class="liste_resp">les differentes options ici</option>
                                    </select>
                                </div>

                            </section>

                        </div>
                    </div>
                </div>

                <div class="btn_footer mdl-cell mdl-cell--10-col-desktop mdl-cell---col-tablet mdl-cell--4-col-phone">
                    <input type="submit" name="valider" class="mdl-button bouton_valider mdl-color--accent mdl-color-text--accent-contrast">
                </div>



            </section>


        </div>
    </div>

    </main>
</div>


<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" style="position: fixed; left: -1000px; height: -1000px;">
    <defs>
        <mask id="piemask" maskContentUnits="objectBoundingBox">
            <circle cx=0.5 cy=0.5 r=0.49 fill="white">
                <circle cx=0.5 cy=0.5 r=0.40 fill="black">
        </mask>
        <g id="piechart">
            <circle cx=0.5 cy=0.5 r=0.5>
                <path d="M 0.5 0.5 0.5 0 A 0.5 0.5 0 0 1 0.95 0.28 z" stroke="none" fill="rgba(255, 255, 255, 0.75)">
        </g>
    </defs>
</svg>
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 500 250" style="position: fixed; left: -1000px; height: -1000px;">
    <defs>
        <g id="chart">
            <g id="Gridlines">
                <line fill="#888888" stroke="#888888" stroke-miterlimit="10" x1="0" y1="27.3" x2="468.3" y2="27.3">
                    <line fill="#888888" stroke="#888888" stroke-miterlimit="10" x1="0" y1="66.7" x2="468.3" y2="66.7">
                        <line fill="#888888" stroke="#888888" stroke-miterlimit="10" x1="0" y1="105.3" x2="468.3" y2="105.3">
                            <line fill="#888888" stroke="#888888" stroke-miterlimit="10" x1="0" y1="144.7" x2="468.3" y2="144.7">
                                <line fill="#888888" stroke="#888888" stroke-miterlimit="10" x1="0" y1="184.3" x2="468.3" y2="184.3">
            </g>
            <g id="Numbers">
                <text transform="matrix(1 0 0 1 485 29.3333)" fill="#888888" font-family="'Roboto'" font-size="9">500</text>
                <text transform="matrix(1 0 0 1 485 69)" fill="#888888" font-family="'Roboto'" font-size="9">400</text>
                <text transform="matrix(1 0 0 1 485 109.3333)" fill="#888888" font-family="'Roboto'" font-size="9">300</text>
                <text transform="matrix(1 0 0 1 485 149)" fill="#888888" font-family="'Roboto'" font-size="9">200</text>
                <text transform="matrix(1 0 0 1 485 188.3333)" fill="#888888" font-family="'Roboto'" font-size="9">100</text>
                <text transform="matrix(1 0 0 1 0 249.0003)" fill="#888888" font-family="'Roboto'" font-size="9">1</text>
                <text transform="matrix(1 0 0 1 78 249.0003)" fill="#888888" font-family="'Roboto'" font-size="9">2</text>
                <text transform="matrix(1 0 0 1 154.6667 249.0003)" fill="#888888" font-family="'Roboto'" font-size="9">3</text>
                <text transform="matrix(1 0 0 1 232.1667 249.0003)" fill="#888888" font-family="'Roboto'" font-size="9">4</text>
                <text transform="matrix(1 0 0 1 309 249.0003)" fill="#888888" font-family="'Roboto'" font-size="9">5</text>
                <text transform="matrix(1 0 0 1 386.6667 249.0003)" fill="#888888" font-family="'Roboto'" font-size="9">6</text>
                <text transform="matrix(1 0 0 1 464.3333 249.0003)" fill="#888888" font-family="'Roboto'" font-size="9">7</text>
            </g>
            <g id="Layer_5">
                <polygon opacity="0.36" stroke-miterlimit="10" points="0,223.3 48,138.5 154.7,169 211,88.5
              294.5,80.5 380,165.2 437,75.5 469.5,223.3 	">
            </g>
            <g id="Layer_4">
                <polygon stroke-miterlimit="10" points="469.3,222.7 1,222.7 48.7,166.7 155.7,188.3 212,132.7
              296.7,128 380.7,184.3 436.7,125 	">
            </g>
        </g>
    </defs>
</svg>
<script src="{{url('css/style/material.min.js')}}"></script>
</body>
</html>