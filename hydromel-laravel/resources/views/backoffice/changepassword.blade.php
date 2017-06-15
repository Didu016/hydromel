@include('backoffice/header')
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header mdl-layout__header--scroll mdl-color--teal-700">
        <div class="mdl-layout--large-screen-only mdl-layout__header-row">
        </div>
        <div class="mdl-layout titrePage">
            <h3>Login</h3>
        </div>
        <div class="mdl-layout--large-screen-only mdl-layout__header-row">
        </div>

    </header>

    <div class="mdl-layout__tab-panel is-active" id="overview">
        <section class="pages_blocs mdl-grid ">
            <div class="mdl-card mdl-shadow--2dp mdl-cell mdl-cell--9-col-desktop mdl-cell--6-col-tablet mdl-cell--4-col-phone">
                <div class="mdl-card__supporting-text">
                    <h4>Changer votre mot de passe</h4>
                    <form method="POST" action="{{ action('AuthController@check') }}">
                        {{ csrf_field() }}
                               <p>Ancien mot de passe <input type="password" placeholder="mot de passe" name="password"></p>
                                <p>Nouveau mot de passe <input type="password" placeholder="mot de passe" name="password">
                                <p>Confirmez votre nouveau mot de passe <input type="password" placeholder="mot de passe" name="password">
                        <input type="submit" class="mdl-button bouton_valider mdl-color--accent mdl-color-text--accent-contrast" value="Valider">
                    </form>
                </div>
            </div>
        </section>
        <section class="section--center mdl-grid mdl-shadow--2dp">

        </section>

    </div>


</div>
<script src="{{url('css/style/material.min.js')}}"></script>
</body>
</html>