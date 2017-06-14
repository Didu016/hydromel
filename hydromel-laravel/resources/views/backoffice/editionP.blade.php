@include('backoffice/header')
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header mdl-layout__header--scroll mdl-color--teal-700">
        <div class="mdl-layout--large-screen-only mdl-layout__header-row">
        </div>
        <div class="mdl-layout  mdl-layout__header-row">
            <h3 class="titrePage">Edition precedente</h3>
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
                                <a class="mdl-navigation__link" href="#" id="lnk_description"><h4>Description</h4></a>
                                <a class="mdl-navigation__link" href="#" id="lnk_prix"><h4>Prix</h4></a>
                            </div>
                        </header>
                        <section class="aCacher section_default" id="description">
                            <form method="POST" action="" enctype="">
                                <p> Choisir une année</p>
                                <select>
                                    <option id="liste_editions"></option>
                                </select>

                                <p>Description </p>
                                <textarea name="editionP_description"></textarea>
                            </form>
                            <input type="submit" name="valider" class="mdl-button bouton_valider mdl-color--accent mdl-color-text--accent-contrast">

                        </section>

                    <section class="aCacher" id="prix">
                        <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                            <table class="mdl-data-table">
                                <thead>
                                <tr>
                                    <th>Distinction</th>
                                    <th >Position</th>
                                    <th class="large"> Description</th>
                                    <th>Value</th>
                                    <th> Mod</th>
                                    <th>Suppr</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr id="prix_">
                                    <td class="prix_distinction">distinction</td>
                                    <td class="prix_position">position</td>
                                    <td class="prix_description">description</td>
                                    <td class ="prix_value">value prix</td>
                                    <td><button id="btn_modifier_prix" class="bouton_table"><i class="mdl-color-text--blue-grey-400 material-icons" role="button">create</i></button></td>
                                    <td><button data-id="" id="btn_delete_prix" class="bouton_table"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">delete</i></button></td>
                                </tr>
                                </tbody>
                            </table>
                            <button id="btn_ajout_prix" class="bouton_ajout bouton_table"><i class="bouton_table mdl-color-text--blue-grey-400 material-icons" role="presentation">add_circle</i></button>
                        </div>


                    </section>
                    <section class="aCacher" id="ajout_prix">
                        <h5>Ajouter un prix</h5>
                        <form method="POST" action="" enctype="">
                            <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                                <p>Distinction <input id="prix_distinction" type="text" required name="prix_distinction">
                                <p>Position <input id="prix_position" type="number" required name="prix_position" ></p>
                                <p>Description <textarea required id="prix_description"></textarea></p>
                                <p>Value <input id="prix_value" type="text"></p>
                                <input type="submit" name="valider" class="mdl-button bouton_valider mdl-color--accent mdl-color-text--accent-contrast">

                            </div>
                        </form>
                    </section>
                    <section class="aCacher" id="modifier_prix">
                        <h5>Modifier un prix</h5>
                        <form method="POST" action="" enctype="">
                            <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                                <p>Distinction <input id="prix_distinction" type="text" required name="prix_distinction">
                                <p>Position <input id="prix_position" type="number" required name="prix_position" ></p>
                                <p>Description <textarea required id="prix_description"></textarea></p>
                                <p>Value <input id="prix_value" type="text"></p>

                                <input type="submit" name="valider" class="mdl-button bouton_valider mdl-color--accent mdl-color-text--accent-contrast">

                            </div>
                        </form>
                    </section>

                </div>


                </div>

            </section>

            <div class="btn_footer mdl-cell mdl-cell--10-col-desktop mdl-cell---col-tablet mdl-cell--4-col-phone">
                <a href="/auth/home" class="mdl-button  mdl-color--accent mdl-color-text--accent-contrast">Accueil</a>
            </div>
        </div>
    </div>


@include('backoffice/footer')