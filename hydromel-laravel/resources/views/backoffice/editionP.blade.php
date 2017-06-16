@include('backoffice/header')
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header mdl-layout__header--scroll mdl-color--teal-700">
        <div class="mdl-layout--large-screen-only mdl-layout__header-row">
        </div>
        <div class="mdl-layout ">
            <h3 class="titrePage">Editions precedentes</h3>
        </div>
        <div class="mdl-layout--large-screen-only mdl-layout__header-row">
        </div>

    </header>

    <div class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-layout__tab-panel is-active" id="overview">
            <section class=" mdl-grid ">
                <div class="pages_blocs mdl-card mdl-shadow--2dp mdl-cell mdl-cell--10-col-desktop mdl-cell---col-tablet mdl-cell--4-col-phone">
                    <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                        @if(sizeof($editionsP) > 0)
                        <header class="mdl-layout__header  mdl-color--teal-400">
                            <div class="demo-navigation mdl-layout--large-screen-only mini_header mdl-layout__header-row">
                                @foreach(array_reverse($editionsP, TRUE) as $editionP)
                                <a class="mdl-navigation__link" href="#" id="lnk_{{$editionP['year']}}">
                                    <h4>{{$editionP['year']}}</h4></a>
                                @endforeach
                            </div>
                        </header>

                        @foreach(array_reverse($editionsP, TRUE) as $pos=>$editionP)
                        <section class="aCacher @if($pos == sizeof($editionsP) - 1)section_default @endif"
                                 id="{{$editionP['year']}}">
                            <h3 class="team">Team {{$editionP['team']}}</h3>
                            <h5 class="descr">Description</h5>
                            <textarea rows="6" class="descr"
                                      name="editionP_description">{{$editionP['description']}}</textarea>
                            <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                                <h5>Prix</h5>
                                <table class="mdl-data-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Distinction</th>
                                            <th>Position</th>
                                            <th class="large"> Description</th>
                                            <th>Value</th>
                                            <th> Mod</th>
                                            <th>Suppr</th>
                                        </tr>
                                    </thead>
                                    @foreach($rewards as $reward)
                                    @if($reward['edition_id'] == $editionP['id'])
                                    <tbody>
                                        <tr id="prix_">
                                            <td id="id">{{$reward['id']}}</td>
                                            <td class="prix_distinction">{{$reward['distinction']}}</td>
                                            <td class="prix_position">{{$reward['position']}}
                                                @if($reward['position'] == 1)
                                                er
                                                @else
                                                ème
                                                @endif
                                            </td>
                                            <td class="prix_description">{{substr($reward['description'],0,5)}}...</td>
                                            <td class="prix_value">
                                                @if(empty($reward['value']))
                                                -
                                                @else
                                                {{$reward['value']}}
                                                @endif
                                            </td>
                                            <td>
                                                <button id="btn_modifier_prix" class="bouton_table"><i
                                                        class="mdl-color-text--blue-grey-400 material-icons"
                                                        role="button">create</i></button>
                                            </td>
                                            <td>
                                                <button data-id="" id="btn_delete_prix" class="bouton_table"><i
                                                        class="mdl-color-text--blue-grey-400 material-icons"
                                                        role="presentation">delete</i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endif
                                    @endforeach
                                </table>
                                <button id="btn_ajout_prix" class="bouton_ajout bouton_table"><i
                                        class="bouton_table mdl-color-text--blue-grey-400 material-icons"
                                        role="presentation">add_circle</i></button>
                            </div>
                            <input type="submit" name="valider"
                                   class="mdl-button bouton_valider mdl-color--accent mdl-color-text--accent-contrast">

                        </section>
                        @endforeach
                        <section class="aCacher" id="ajout_prix">
                            <h5>Ajouter un prix</h5>
                            <form method="POST" action="" enctype="">
                                <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                                    <p>Distinction <input id="prix_distinction" type="text" required
                                                          name="prix_distinction">
                                    <p>Position <input id="prix_position" type="number" required
                                                       name="prix_position">
                                    </p>
                                    <p>Description <textarea required id="prix_description"></textarea></p>
                                    <p>Value <input id="prix_value" type="text"></p>
                                    <input type="submit" name="valider"
                                           class="mdl-button bouton_valider mdl-color--accent mdl-color-text--accent-contrast">

                                </div>
                            </form>
                        </section>
                        <section class="aCacher" id="modifier_prix">
                            <h5>Modifier un prix</h5>
                            <form method="POST" action="" enctype="">
                                <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                                    <p>Distinction <input id="prix_distinction" type="text" required
                                                          name="prix_distinction">
                                    <p>Position <input id="prix_position" type="number" required
                                                       name="prix_position">
                                    </p>
                                    <p>Description <textarea required id="prix_description"></textarea></p>
                                    <p>Value <input id="prix_value" type="text"></p>

                                    <input type="submit" name="valider"
                                           class="mdl-button bouton_valider mdl-color--accent mdl-color-text--accent-contrast">

                                </div>
                            </form>
                        </section>
                        @else
                        <header class="mdl-layout__header  mdl-color--teal-400">
                            <div class="demo-navigation mdl-layout--large-screen-only mini_header mdl-layout__header-row">
                                <a class="mdl-navigation__link" href="#" id="rien"><h4>Pas d'éditions
                                        précèdentes</h4></a>
                            </div>
                        </header>)

                        @endif
                    </div>


                </div>

            </section>

            <div class="btn_footer mdl-cell mdl-cell--10-col-desktop mdl-cell---col-tablet mdl-cell--4-col-phone">
                <a href="/auth/home" class="mdl-button  mdl-color--accent mdl-color-text--accent-contrast">Accueil</a>
            </div>
        </div>
    </div>
    @include('backoffice/footer')