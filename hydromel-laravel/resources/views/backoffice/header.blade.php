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
        <link rel="icon" sizes="192x192" href="{{ url('img/backoffice/android-desktop.png') }}">

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
        <link rel="stylesheet" href="{{ url('css/style/material.min.css') }}">
        <link rel="stylesheet" href="{{ url('css/style/styles.css') }}">
        <script src="{{url('js/jquery.js')}}"></script>
        <script src="{{url('js/main.js')}}" type="text/javascript"></script>

    </head>
    <body>
        <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">

            @if (session('error') == 'invalid_edition_input')
            <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
                <div class="mdl-layout__header-row" id="error">
                    <span class="mdl-layout-title">L'édition n'a pas été créée, veuillez renseigner tous les champs obligatoires (nom d'équipe, année et description de l'équipe)</span>
                </div>
            </header>
            @elseif (session('error') == 'invalid_supervisor_input')
            <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
                <div class="mdl-layout__header-row" id="error">
                    <span class="mdl-layout-title">L'édition n'a pas été créée, veuillez renseigner tous les champs du superviseur</span>
                </div>
            </header>
            @elseif (session('error') == 'edition_exists')
            <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
                <div class="mdl-layout__header-row" id="error"> 
                    <span class="mdl-layout-title">L'édition n'a pas été créée car elle existe déjà.</span>
                </div>
            </header>

            @elseif (session('error') == 'member_not_created')
            <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
                <div class="mdl-layout__header-row" id="error">
                    <span class="mdl-layout-title">L'édition n'a pas pu être créé car le superviseur n'a pas pu être créé.</span>
                </div>
            </header>

            @elseif (session('error') == 'no_media_found')
            <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
                <div class="mdl-layout__header-row" id="error">
                    <span class="mdl-layout-title">L'édition n'a pas pu être créé car vous n'avez sélectionner aucune photo pour le superviseur</span>
                </div>
            </header>

            @elseif (session('success') == 'edition_created')
            <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
                <div class="mdl-layout__header-row" id="success">
                    <span class="mdl-layout-title">L'édition a bien été créée !</span>
                </div>  
            </header>
            @else
            @endif

            <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
                <header class="demo-drawer-header"><a href="{{url('/auth/home')}}">
                        <img src="{{url('img/backoffice/user.jpg')}}" class="demo-avatar"></a>
                    <span>Team HEIG-VD</span>

                </header>
                <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
                    <a id="changerEdition" class="mdl-navigation__link"
                       href="changeedition"><i
                            class="mdl-color-text--blue-grey-400 material-icons" role="presentation">compare_arrows</i>Changer
                        Edition</a>
                    <a id="changerMdp" class="mdl-navigation__link" href="changepassword"><i
                            class="mdl-color-text--blue-grey-400 material-icons" role="presentation">build</i>Changer mot de
                        passe</a>
                    <div class="mdl-layout-spacer"></div>
                    <a id="deconnexion" class="mdl-navigation__link" href="logout"><i
                            class="mdl-color-text--blue-grey-400 material-icons"	Le rank
                            role="presentation">delete</i>Deconnexion</a>
                </nav>

            </div>
            <main class="mdl-layout__content mdl-color--grey-100">
                <div id="accueil" class="mdl-grid demo-content">