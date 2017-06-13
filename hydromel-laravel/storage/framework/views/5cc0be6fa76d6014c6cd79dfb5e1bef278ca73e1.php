<?php echo $__env->make('backoffice/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                    <div>
                        <p> Choisir une année</p> <select>
                            <option id="liste_editions"></option>
                        </select>

                        <p>Description </p>
                        <textarea id="editionP_description"></textarea>
                    </div>

                    </div>
                    <input type="submit" name="valider" class="mdl-button bouton_valider mdl-color--accent mdl-color-text--accent-contrast">

                </div>

                <div class="btn_footer mdl-cell mdl-cell--10-col-desktop mdl-cell---col-tablet mdl-cell--4-col-phone">
                    <a href="/auth/home" class="mdl-button  mdl-color--accent mdl-color-text--accent-contrast">Accueil</a>
                </div>
                <div>

                </div>


            </section>


        </div>
    </div>

    </main>
</div>
<?php echo $__env->make('backoffice/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>