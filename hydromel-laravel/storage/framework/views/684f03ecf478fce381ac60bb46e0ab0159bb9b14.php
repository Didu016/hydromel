<?php echo $__env->make('backoffice/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <header class="mdl-layout__header mdl-layout__header--scroll mdl-color--teal-400">
            <div class="mdl-layout--large-screen-only mdl-layout__header-row">
            </div>
            <div class="mdl-layout">
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
                                    <a class="mdl-navigation__link" href="#" id="lnk_respo"><h4>Responsabilités</h4></a>
                                    <a class="mdl-navigation__link" href="#" id="lnk_prix"><h4>Prix</h4></a>
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
                            <section class="aCacher" id="respo">
                            <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                                <h5>Ajouter une responsabilité</h5>
                            <p>Créer une responsabilité <input id="nouvelle_resp" name="responsabilite">
                                <input type="submit" value="Ajouter" name="ajouter" class="btn_ajout mdl-button mdl-color--teal-400 mdl-color-text--accent-contrast">

                            </div>
                            </section>
                            <section class="aCacher" id="prix">
                                <h5>Ajouter un prix</h5>
                                <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                                    <p>Distinction <input id="prix_distinction" type="text" required name="prix_distinction">
                                    <p>Position <input id="prix_position" type="number" required name="prix_position" ></p>
                                    <p>Description <textarea required id="prix_description"></textarea></p>
                                    <p>Value <input id="prix_value" type="text"></p>


                                </div>
                            </section>
                        </div>
                    </div>
                    <input type="submit" name="valider" class="mdl-button bouton_valider mdl-color--accent mdl-color-text--accent-contrast">
                </div>

                <div class="btn_footer mdl-cell mdl-cell--10-col-desktop mdl-cell---col-tablet mdl-cell--4-col-phone">
                    <a href="/auth/home" class="mdl-button  mdl-color--accent mdl-color-text--accent-contrast">Accueil</a>
                </div>



        </section>


    </div>
</div>

</main>
</div>
<?php echo $__env->make('backoffice/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>