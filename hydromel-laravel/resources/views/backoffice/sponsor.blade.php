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
                                        <th>ID</th>
                                        <th class="large">Nom sponsor</th>
                                        <th>Categorie</th>
                                        <th>Logo</th>
                                        <th>Mod</th>
                                        <th>Suppr</th>
                                    </tr>
                                    @foreach ($sponsors as $sponsor)
                                        <tr id="sponsor_">
                                            <td id="id">{{$sponsor['id']}}</td>
                                            <td id="sponsor_actif_nom">{{ $sponsor['society'] }}</td>
                                            <td id="sponsor_actif_rank">
                                                @if ($sponsor['rank_name']!= null)
                                                    {{ $sponsor['rank_name'] }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td id="sponsor_actif_logo">
                                                @if ($sponsor['logo_url']!= null)
                                                    <img src="{{ url($sponsor['logo_url']) }}" height="50" width="50">
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                <button data-id="{{$sponsor['id']}}" id="btn_modifier_sponsor"
                                                        class="bouton_table"><i
                                                            class="mdl-color-text--blue-grey-400 material-icons"
                                                            role="button">create</i></button>
                                            </td>
                                            <td>
                                                <button id="btn_delete_sponsor" class="bouton_table"><i
                                                            class="mdl-color-text--blue-grey-400 material-icons"
                                                            role="presentation">delete</i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                <button id="btn_ajout_sponsor" class="bouton_ajout bouton_table"><i
                                            id="btn_ajout_membre"
                                            class="bouton_table mdl-color-text--blue-grey-400 material-icons"
                                            role="presentation">add_circle</i></button>

                            </div>

                        </section>
                        <section class="aCacher" id="ajout_sponsor">
                            <h5>Ajouter un nouveau sponsor</h5>
                            <form method="POST" action="{{url('/auth/sponsors')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <p>Entreprise <input id="sponsor_nouveau_nom" type="text" name="society"></p>

                                <p>Rang
                                    <select id="sponsor_nouveau_categorie" name="rank">
                                        @foreach ($ranks as $rank)
                                            <option value="{{$rank->name}}">{{$rank->name}}</option>;
                                        @endforeach
                                    </select>
                                </p>
                                <p>Mail de contact:<input id="sponsor_nouveau_mail" type="text" name="mail_contact"></p>
                                <p>Quantité monétaire (justes les chiffres) (en chf):<input id="sponsor_nouveau_amount"
                                                                                            type="text" name="amount">
                                </p>
                                <p>Lien du site web:<input id="sponsor_nouveau_link" type="text" name="link"></p>
                                <p>Logo <input id="sponsor_nouveau_img" type="file" accept="image/png" name="logo_url">
                                </p>
                                <p><input type="submit" name="type" value="Valider" id="btn_ajout_sponsor"
                                          class="mdl-button bouton_valider mdl-color--accent mdl-color-text--accent-contrast">
                                </p>
                            </form>

                        </section>
                        <section class="aCacher" id="modifier_sponsor">
                            <h5>Modifier un sponsor</h5>
                            <form method="POST" action="" enctype="">
                                <p>Entreprise <input id="sponsor_modifier_nom" type="text" name="society"></p>
                                <p>Catégorie</p><select id="sponsor_modifier_categorie">
                                    <select id="sponsor_nouveau_categorie" name="rank">

                                    </select>
                                    <p>Logo <input id="sponsor_modifier_img" type="file" accept="image/png"></p>

                                    <p><input type="submit" name="type" value="Valider" id="btn_ajout_sponsor"
                                              class="mdl-button bouton_valider mdl-color--accent mdl-color-text--accent-contrast">
                                    </p>
                            </form>

                            </select>
                        </section>
                        <section class="aCacher" id="categorie">
                            <form method="POST" action="{{url('/auth/rank')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                                    <h5>Ajouter une catégorie</h5>
                                    <p>Créer une catégorie <input id="nouvelle_categorie" name="category">
                                        <input type="submit" name="valider"
                                               class="mdl-button bouton_valider mdl-color--accent mdl-color-text--accent-contrast">
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