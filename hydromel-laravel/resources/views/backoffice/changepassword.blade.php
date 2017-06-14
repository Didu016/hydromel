@include('backoffice/header')
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
                    <h4>Changer votre password</h4>
                    @if (session('error'))
                        <div> ERREUR: mauvais mot de passe ou nom blablabla </div>
                    @endif
                    <form method="POST" action="{{ action('AuthController@check') }}">
                        {{ csrf_field() }}
                        <input type="text" placeholder="username" name="username">
                        Ancien mot de passe <input type="password" placeholder="mot de passe" name="password">
                        Nouveau mot de passe <input type="password" placeholder="mot de passe" name="password">
                        Confirmez votre nouveau mot de passe <input type="password" placeholder="mot de passe" name="password">
                        <input type="submit" value="login">
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