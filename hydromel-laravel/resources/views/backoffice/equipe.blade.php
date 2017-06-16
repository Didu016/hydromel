@include('backoffice/header')
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header mdl-layout__header--scroll mdl-color--teal-700">
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
                                    <a class="mdl-navigation__link" href="#" id="lnk_description"><h4>Description</h4>
                                    </a>
                                    <a class="mdl-navigation__link" href="#" id="lnk_membres"><h4>Membres</h4></a>
                                    <a class="mdl-navigation__link" href="#" id="lnk_respo"><h4>Responsabilités</h4></a>
                                    <a class="mdl-navigation__link" href="#" id="lnk_prix"><h4>Prix</h4></a>
                                </div>
                            </header>
                            <section class="aCacher section_default mdl-cell--10-col-desktop" id="description">

                                <h5>Ecrivez votre description</h5>
                                <form method="POST" action="" enctype="">
                                    <textarea id="equipe_description" rows="8">{{$editions['attributes']['team_description']}}re</textarea>
                                    <input type="submit" name="valider"
                                           class="mdl-button bouton_valider mdl-color--accent mdl-color-text--accent-contrast">
                                </form>

                            </section>

                            <section class="aCacher" id="membres">
                                <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                                    <table class="mdl-data-table">
                                        <tr>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th class="large">Membres</th>
                                            <th class="large"> Mail</th>
                                            <th>Responsabilité</th>
                                            <th> Mod</th>
                                            <th>Suppr</th>
                                        </tr>
                                        @foreach($members as $member)
                                            <tr id="membre_">
                                                <td id="id">{{$member['id']}}</td>
                                                <td class="membre_image">
                                                    @if ($member['media_url']!= null)
                                                        <img src="{{ url($member['media_url']) }}" height="50"
                                                             width="50">
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td class="membre_nom">{{$member['firstname']}} {{$member['name']}}</td>
                                                <td class="membre_mail">{{substr($member['email'],0,17)}}...</td>
                                                <td class="membre_respo">{{$member['responsibility_name']}}</td>
                                                <td>
                                                    <button id="btn_modifier_membre" class="bouton_table"><i
                                                                class="mdl-color-text--blue-grey-400 material-icons"
                                                                role="button">create</i></button>
                                                </td>
                                                <td>
                                                    <button data-id="" id="btn_delete_membre" class="bouton_table"><i
                                                                class="mdl-color-text--blue-grey-400 material-icons"
                                                                role="presentation">delete</i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                    <button id="btn_ajout_membre" class="bouton_ajout bouton_table"><i
                                                class="bouton_table mdl-color-text--blue-grey-400 material-icons"
                                                role="presentation">add_circle</i></button>
                                </div>
                            </section>
                            <section class="aCacher" id="ajout_membre">
                                <h5>Ajouter un nouveau membre</h5>
                                <form method="POST" action="{{url('/auth/member')}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" value="">
                                    <p>Nom <input name="membre_nom" type="text"></p>
                                    <p>Prenom <input name="membre_prenom" type="text"></p>
                                    <p>Mail <input name="membre_mail" type="email"></p>
                                    <input name="membre_image" type="file" accept="image">
                                    <div>
                                        Responsabilité<select id="membre_nouveau_resp" name="membre_responsibility">
                                            @foreach($responsability as $resp)
                                                <option>{{($resp['attributes']['name'])}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="submit" name="valider"
                                           class="mdl-button bouton_valider mdl-color--accent mdl-color-text--accent-contrast">
                                </form>
                            </section>
                            <section class="aCacher" id="modifier_membre">
                                <h5>Modifier un membre</h5>
                                <form method="POST" action="{{}}" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="">
                                    <p>Nom <input name="membre_nom" type="text"></p>
                                    <p>Prenom <input name="membre_prenom" type="text"></p>
                                    <p>Mail <input name="membre_mail" type="email"></p>
                                    <input name="membre_image" type="file" accept="image">
                                    <div>
                                        Responsabilité <select id="membre_resp">
                                            <option class="liste_resp">les differentes options ici</option>
                                        </select>
                                    </div>
                                    <input type="submit" name="valider"
                                           class="mdl-button bouton_valider mdl-color--accent mdl-color-text--accent-contrast">
                                </form>
                            </section>
                            <section class="aCacher" id="respo">
                                <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                                    <h5>Ajouter une responsabilité</h5>
                                    <form method="POST" action="{{url('/auth/responsibility')}}"
                                          enctype="multipart/form-data">
                                        <p>Créer une responsabilité <input id="nouvelle_resp" name="responsabilite"></p>
                                        {{ csrf_field() }}
                                        <input type="submit" name="valider" value="Ajouter"
                                               class="mdl-button bouton_valider mdl-color--accent mdl-color-text--accent-contrast">
                                    </form>
                                </div>
                            </section>
                            <section class="aCacher" id="prix">
                                <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                                    <table class="mdl-data-table">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>ID edition</th>
                                            <th>Distinction</th>
                                            <th>Position</th>
                                            <th class="large"> Description</th>
                                            <th>Value</th>
                                            <th> Mod</th>
                                            <th>Suppr</th>
                                        </tr>
                                        </thead>
                                        @foreach($rewards as $reward)
                                            <tbody>
                                            <tr id="prix_">
                                                <td id="ID">{{$reward['attributes']['id']}}</td>
                                                <td id="ID">{{$reward['attributes']['edition_id']}}</td>
                                                <td class="prix_distinction">{{$reward['attributes']['distinction']}}</td>
                                                <td class="prix_position">{{$reward['attributes']['position']}}</td>
                                                <td class="prix_description">{{substr($reward['attributes']['description'],0,5)}}
                                                    ...
                                                </td>
                                                <td class="prix_value">{{$reward['attributes']['value']}}</td>
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
                                        @endforeach
                                    </table>
                                    <button id="btn_ajout_prix" class="bouton_ajout bouton_table"><i
                                                class="bouton_table mdl-color-text--blue-grey-400 material-icons"
                                                role="presentation">add_circle</i></button>
                                </div>
                            </section>
                            <section class="aCacher" id="ajout_prix">
                                <h5>Ajouter un prix</h5>
                                <form method="POST" action="{{url('/auth/reward')}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                                    <p>Distinction <input id="prix_distinction" type="text" required name="prix_distinction">
                                    <p>Position <input id="prix_position" type="number" required name="prix_position" ></p>
                                    <p>Description <textarea required id="prix_description" name="prix_description"></textarea></p>
                                    <p>Value <input id="prix_value" type="text" name="prix_value"></p>
                                    <input type="submit" name="valider" class="mdl-button bouton_valider mdl-color--accent mdl-color-text--accent-contrast">

                                    </div>
                                </form>
                            </section>
                            <section class="aCacher" id="modifier_prix">
                                <h5>Modifier un prix</h5>
                                <form method="POST" action="{{url('/auth/reward')}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">

                                        <p>Distinction <input id="prix_distinction" type="text" required name="prix_distinction">
                                        <p>Position <input id="prix_position" type="number" required name="prix_position" ></p>
                                        <p>Description <textarea required id="prix_description" name="prix_description">></textarea></p>
                                        <p>Value <input id="prix_value" type="text" name="prix_value"></p>

                                        <input type="submit" name="valider"
                                               class="mdl-button bouton_valider mdl-color--accent mdl-color-text--accent-contrast">

                                    </div>
                                </form>
                            </section>
                        </div>
                    </div>

                </div>

                <div class="btn_footer mdl-cell mdl-cell--10-col-desktop mdl-cell---col-tablet mdl-cell--4-col-phone">
                    <a href="/auth/home"
                       class="mdl-button  mdl-color--accent mdl-color-text--accent-contrast">Accueil</a>
                </div>


            </section>


        </div>
    </div>
</div>

@include('backoffice/footer')