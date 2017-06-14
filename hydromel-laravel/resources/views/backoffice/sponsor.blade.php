@include('backoffice/header')
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header mdl-layout__header--scroll mdl-color--teal-600">
        <div class="mdl-layout--large-screen-only mdl-layout__header-row">
        </div>
        <div class="mdl-layout  mdl-layout__header-row">
            <h3 class="titrePage">Sponsors</h3>
        </div>
        <div class="mdl-layout--large-screen-only mdl-layout__header-row">
        </div>

    </header>

    <div class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-layout__tab-panel is-active" id="overview">
            <section class=" mdl-grid ">
                <div class="pages_blocs mdl-card mdl-shadow--2dp mdl-cell mdl-cell--10-col-desktop mdl-cell---col-tablet mdl-cell--4-col-phone">
                    <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                    <header class="mdl-layout__header  mdl-color--teal-400">
                        <div class="demo-navigation mdl-layout--large-screen-only mini_header mdl-layout__header-row">
                            <a class="mdl-navigation__link" href="#" id="lnk_sponsor"><h4>Sponsors</h4></a>
                            <a class="mdl-navigation__link" href="#" id="lnk_categorie"><h4>Catégories</h4></a>
                        </div>
                    </header>
                    <section class="aCacher section_default" id="sponsor">

                    <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                        <table class="mdl-data-table">
                            <tr>
                                <th class="large">Nom sponsor</th>
                                <th>Categorie</th>
                                <th>Logo</th>
                                <th>Mail</th>
                                <th>Amount</th>
                                <th>Lien</th>
                                <th> Mod</th>
                                <th>Suppr</th>
                            </tr>
                            <tr id="sponsor_">
                                <td class="sponsor_nom">Le nom du sponsor</td>
                                <td class="sponsor_rank">Le rank</td>
                                <td class="sponsor_logo"></td>
                                <td class="sponsor_mail">Le mail</td>
                                <td class="sponsor_amount">30'000</td>
                                <td class="sponsor_lien">le url</td>
                                <td><button data-id="" id="btn_modifier_sponsor" class="bouton_table"><i class="mdl-color-text--blue-grey-400 material-icons" role="button">create</i></button></td>
                                <td><button id="btn_delete_sponsor" class="bouton_table"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">delete</i></button></td>
                            </tr>
                        </table>
                        <button id="btn_ajout_sponsor" class="bouton_ajout bouton_table"><i id="btn_ajout_membre" class="bouton_table mdl-color-text--blue-grey-400 material-icons" role="presentation">add_circle</i></button>

                    </div>


                    </section>
                    <section class="aCacher" id="ajout_sponsor">
                        <h5>Ajouter un nouveau sponsor</h5>
                        <form method="POST" action="{{url('/auth/sponsors')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <p>Entreprise <input name="sponsor_nom"type="text" name="society"></p>

                            <p>Rang
                                <select name="sponsor_categorie" name="rank">

                                </select>
                            </p>
                            <p>Logo <input name="sponsor_logo" type="file" accept="image/png" name="logo_url"></p>
                            <p>Mail <input type="email" name="sponsor_mail"></p>
                            <p>Amount <input type="text" name="sponsor_amount"></p>
                            <p>Lien <input type="url" name="sponsor_link"></p>
                            <p><input type="submit" name="type" value="Valider" id="btn_ajout_sponsor" class="mdl-button bouton_valider mdl-color--accent mdl-color-text--accent-contrast"></p>
                        </form>

                    </section>
                    <section class="aCacher" id="modifier_sponsor">
                        <h5>Modifier un sponsor</h5>
                        <form method="POST" action="" enctype="">
                            <p>Entreprise <input type="text" name="society"></p>
                            <p>Catégorie</p><select class="sponsor_categorie">
                                <select name="rank">

                                </select>
                                <p>Logo <input name="sponsor_logo" type="file" accept="image/png"></p>
                                <p>Mail <input type="email" name="sponsor_mail"></p>
                                <p>Amount <input type="text" name="sponsor_amount"></p>
                                <p>Lien <input type="url" name="sponsor_link"></p>
                                <p><input type="submit" name="type" value="Valider" id="btn_ajout_sponsor" class="mdl-button bouton_valider mdl-color--accent mdl-color-text--accent-contrast"></p>
                        </form>

                        </select>
                    </section>
                    <section class="aCacher" id="categorie">
                        <form method="POST" action="" enctype="">
                        <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                            <h5>Ajouter une catégorie</h5>
                            <p>Créer une catégorie <input id="nouvelle_categorie" name="category">
                                <input type="submit" name="valider" class="mdl-button bouton_valider mdl-color--accent mdl-color-text--accent-contrast">
                        </div>
                        </form>
                    </section>
                    </div>



        </section>
            <div class="btn_footer mdl-cell mdl-cell--10-col-desktop mdl-cell---col-tablet mdl-cell--4-col-phone">
                <a href="/auth/home" class="mdl-button  mdl-color--accent mdl-color-text--accent-contrast">Accueil</a>


            </div>

        </div>
    </div>

</main>
</div>
@include('backoffice/footer')