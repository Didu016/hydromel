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

    <link rel="shortcut icon" href="<?php echo e(url('img/backoffice/favicon.png')); ?>">


    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(url('css/style/material.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('css/style/styles.css')); ?>">
    <!--<script src="js/main.js" type="text/javascript"></script>-->

</head>
<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header mdl-layout__header--scroll mdl-color--teal-300">
        <div class="mdl-layout--large-screen-only mdl-layout__header-row">
        </div>
        <div class="mdl-layout titrePage mdl-layout__header-row">
            <h3>Login</h3>
        </div>
        <div class="mdl-layout--large-screen-only mdl-layout__header-row">
        </div>

    </header>

    <div class="mdl-layout__tab-panel is-active" id="overview">
        <section class="pages_blocs mdl-grid ">
            <div class="mdl-card mdl-shadow--2dp mdl-cell mdl-cell--9-col-desktop mdl-cell--6-col-tablet mdl-cell--4-col-phone">
                <div class="mdl-card__supporting-text">
                    <h4>Entrez vos informations</h4>
                    <?php if(session('error')): ?>
                        <div> ERREUR: mauvais mot de passe ou nom blablabla </div>
                    <?php endif; ?>
                    <form method="POST" action="<?php echo e(action('AuthController@check')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <input type="text" placeholder="username" name="username">
                        <input type="password" placeholder="mot de passe" name="password">
                        <input type="submit" value="login">
                    </form>
                </div>
            </div>
        </section>
        <section class="section--center mdl-grid mdl-shadow--2dp">

        </section>

    </div>


</div>
<script src="<?php echo e(url('css/style/material.min.js')); ?>"></script>
</body>
</html>