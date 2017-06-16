@include('backoffice/header')
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header mdl-layout__header--scroll mdl-color--teal-700">
        <div class=" mdl-layout__header-row">
        </div>
        <div class="mdl-layout">
            <h3 class="titrePage">Accueil</h3>
        </div>
        <div class="mdl-layout--large-screen-only mdl-layout__header-row">
        </div>

    </header>

    <div class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-layout__tab-panel is-active" id="overview">
            <section class=" mdl-grid ">
                <div class="pages_blocs mdl-card mdl-shadow--2dp mdl-cell mdl-cell--10-col-desktop mdl-cell---col-tablet mdl-cell--4-col-phone">
                    <div class="mdl-card__supporting-text mdl-cell--12-col-desktop ">
                        <form method="POST" action="{{url('/auth/accueil/1')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="mdl-card__supporting-text mdl-cell--6-col-desktop description">

                                <h4>Description</h4>
                                <textarea required id="accueil_description" name="description" rows="10">{{$editions['attributes']['description']}}</textarea>

                                <div class="espacement">
                                    <p class="p-normal">Image ou vidéo 1 </p>
                                    <input type="file" accept="video/" accept="image" name="media1" id="accueil_media1">
                                </div>
                                <p class="p-normal">Image ou vidéo 2 </p>
                                <input type="file" accept="video/" accept="image" name="media2" id="accueil_media2">
                            </div>

                            <div class="mdl-card__supporting-text mdl-cell--6-col-desktop description1">
                                <div class="espacement">
                                    <p class="p-normal">Lieu</p>
                                    <input type="text" name="place" id="accueil_lieu" value="{{$editions['attributes']['place']}}">
                                </div>
                                <div>
                                    <p class="p-normal" id="date_debut">Date de début</p>
                                    <input type="date" name="beginningDate"  value="{{$editions['attributes']['start_date']}}">
                                </div>
                                <div>
                                    <p class="p-normal" id="date_fin">Date de fin</p>
                                    <input type="date" name="finishingDate" value="{{$editions['attributes']['end_date']}}">
                                </div>
                            </div>
                            <input type="hidden" name="_method" value="PUT">
                            <input type="submit" name="valider" class="mdl-button bouton_valider mdl-color--accent mdl-color-text--accent-contrast">
                        </form>
                    </div>
                </div>
            </section>

        </div>

        <div class="btn_footer mdl-cell mdl-cell--10-col-desktop mdl-cell---col-tablet mdl-cell--4-col-phone">
            <a href="/auth/home" class="mdl-button  mdl-color--accent mdl-color-text--accent-contrast">Accueil</a>
        </div>

    </div>





</div>

@include('backoffice/footer')