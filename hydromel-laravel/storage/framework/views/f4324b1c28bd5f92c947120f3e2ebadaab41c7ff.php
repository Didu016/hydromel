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
    <link rel="icon" sizes="192x192" href="<?php echo e(url('img/backoffice/android-desktop.png')); ?>">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Admin HEIG-VD">
    <link rel="apple-touch-icon-precomposed" href="<?php echo e(url('img/backoffice/ios-desktop.png')); ?>">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="img/backoffice/favicon.png">


    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(url('css/style/material.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('css/style/styles.css')); ?>">
    <!--<script src="js/main.js" type="text/javascript"></script>-->

</head>
<body>
<div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
    <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
            <span class="mdl-layout-title">ADMIN</span>
        </div>
    </header>

    <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">
            <img src="<?php echo e(url('img/backoffice/user.jpg')); ?>" class="demo-avatar">
            <span>Team HEIG-VD</span>
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
            <a id="changerEdition" class="mdl-navigation__link"
               href="changeedition/home"><i
                        class="mdl-color-text--blue-grey-400 material-icons" role="presentation">compare_arrows</i>Changer
                Edition</a>
            <a id="changerMdp" class="mdl-navigation__link" href="adminhydromelpanel/changepassword"><i
                        class="mdl-color-text--blue-grey-400 material-icons" role="presentation">build</i>Changer mot de
                passe</a>
            <div class="mdl-layout-spacer"></div>
            <a id="deconnexion" class="mdl-navigation__link" href="logout"><i
                        class="mdl-color-text--blue-grey-400 material-icons"	Le rank
                        role="presentation">delete</i>Deconnexion</a>
        </nav>
    </div>

    <!-- CONTENU -->
    <main class="mdl-layout__content mdl-color--grey-100">
        <div id="accueil" class="mdl-grid demo-content">
            <div class="demo-charts mdl-color--teal-300 mdl-shadow--2dp mdl-cell mdl-cell--6-col mdl-grid">
                <a href="accueil" class="titres">Accueil</a>
            </div>
            <div class="demo-charts mdl-color--teal-400 mdl-shadow--2dp mdl-cell mdl-cell--6-col mdl-grid">
                <a href="team" class="titres">L'équipe</a>
            </div>
            <div class="demo-charts mdl-color--teal-500 mdl-shadow--2dp mdl-cell mdl-cell--6-col mdl-grid">
                <a href="news" class="titres">Actualités</a>
            </div>
            <div class="demo-charts mdl-color--teal-600 mdl-shadow--2dp mdl-cell mdl-cell--6-col mdl-grid">
                <a href="sponsors" class="titres">Sponsors</a>
            </div>
            <div class="demo-charts mdl-color--teal-700 mdl-shadow--2dp mdl-cell mdl-cell--6-col mdl-grid">
                <a href="previousedition" class="edition">Editions precedentes</a>
            </div>

        </div>
    </main>

</div>
    <script src="<?php echo e(url('css/style/material.min.js')); ?>"></script>
</body>
</html>
