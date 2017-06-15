@include('backoffice/header')
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header mdl-layout__header--scroll mdl-color--teal-500">
        <div class="mdl-layout--large-screen-only mdl-layout__header-row">
        </div>
        <div class="mdl-layout  mdl-layout__header-row">
            <h3 class="titrePage">Actualités</h3>
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
                            <header class="mdl-layout__header  mdl-color--teal-500">
                                <div class="demo-navigation mdl-layout--large-screen-only mini_header mdl-layout__header-row">
                                    <a class="mdl-navigation__link" href="#" id="lnk_news"><h4>Article News</h4></a>
                                    <a class="mdl-navigation__link" href="#" id="lnk_presse"><h4>Article Presse</h4></a>
                                    <a class="mdl-navigation__link" href="#" id="lnk_media"><h4>Médias</h4></a>
                                </div>
                            </header>
                            <section class="aCacher section_default" id="news">
                                <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                                    <h5>Article News</h5>
                                    <table class="mdl-data-table">
                                        <tr class="titres_table">
                                            <th>ID</th>
                                            <th>Titre</th>
                                            <th class="large">Resumé</th>
                                            <th>Image / Vidéo</th>
                                            <th> Mod</th>
                                            <th>Suppr</th>
                                        </tr>

                                        @foreach($articles as $article)
                                            @if ($article['articletype_name'] == 'news')
                                                <tr id="article_">
                                                    <td id="id">{{$article['id']}}</td>
                                                    <td class="article_news_titre">
                                                        {{$article['title']}}
                                                    </td>
                                                    <td class="article_news_resume">{{substr($article['description'],0,5)}}
                                                        ...
                                                    </td>
                                                    <td class="article_news_image">
                                                        @if(empty($article['medias']))
                                                            -
                                                        @else
                                                            @foreach($article['medias'] as $media)
                                                                <img src="{{ url($media['url']) }}" height="50"
                                                                     width="50">
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button id="btn_modifier_news" class="bouton_table"><i
                                                                    class="mdl-color-text--blue-grey-400 material-icons"
                                                                    role="button">create</i></button>
                                                    </td>
                                                    <td>

                                                        <button data-id="" id="btn_delete_news" class="bouton_table"><i
                                                                    class="mdl-color-text--blue-grey-400 material-icons"
                                                                    role="presentation">delete</i></button>

                                                    </td>
                                                    <input type="hidden" name="id" value="">
                                                </tr>
                                            @endif
                                        @endforeach
                                    </table>
                                    <button id="btn_ajout_news" class="bouton_ajout bouton_table"><i

                                                class="bouton_table mdl-color-text--blue-grey-400 material-icons"
                                                role="presentation">add_circle</i></button>


                                </div>
                            </section>
                            <section class="aCacher" id="ajout_news">
                                <h5>Ajouter un article news</h5>
                                <<<<<<< HEAD
                                <form method="POST" action="" enctype="">
                                    <p>Titre <input id="article_news_nouveau_nom" type="text"></p>
                                    Description <textarea id="article_news_nouveau_description"></textarea>
                                    <p>Audiovisuel <input id="article_news_nouveau_media" type="file" accept="image"
                                                          accept="video" file="media"></p>
                                    <input type="hidden" name="type" value="news">
                                    <input type="submit" name="type" value="Valider" id="btn_ajout_sponsor"
                                           class="mdl-button bouton_valider mdl-color--accent mdl-color-text--accent-contrast">
                                    =======
                                    <form method="POST" action="{{url('/auth/article')}}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <p>Titre <input id="article_news_nouveau_nom" name="title" type="text"></p>
                                        Description <textarea id="article_news_nouveau_description"
                                                              name="description"></textarea>
                                        <p>Audiovisuel <input id="article_news_nouveau_media" type="file" name="media"
                                                              accept="image"
                                                              accept="video" file="media">
                                        </p>
                                        <input type="hidden" name="type" value="news">
                                        <input type="hidden" name="link" value=null>
                                        <input type="submit" name="btn" value="Valider" id="btn_ajout_sponsor"
                                               class="mdl-button bouton_valider mdl-color--accent mdl-color-text--accent-contrast">
                                        >>>>>>> a53e995b4bcd56791afb607c1bca9d59f42ffbed
                                    </form>
                            </section>
                            <section class="aCacher" id="ajout_presse">
                                <h5>Ajouter un article presse</h5>
                                <<<<<<< HEAD
                                <form method="POST" action="" enctype="">
                                    <p>Titre <input name="title" type="text"></p>
                                    Description <textarea name="description"></textarea>
                                    <p>Lien <input name="link" type="url"></p>
                                    <input type="hidden" name="type" value="presse">
                                    <input type="submit" name="type" value="Valider" id="btn_ajout_sponsor"
                                           class="mdl-button bouton_valider mdl-color--accent mdl-color-text--accent-contrast">
                                    =======
                                    <form method="POST" action="{{url('/auth/article')}}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <p>Titre <input name="title" type="text"></p>
                                        Description <textarea name="description"></textarea>
                                        <p>Lien <input name="link" type="url"></p>
                                        <input type="hidden" name="type" value="presse">
                                        <input type="submit" name="btn" value="Valider" id="btn_ajout_sponsor"
                                               class="mdl-button bouton_valider mdl-color--accent mdl-color-text--accent-contrast">
                                        >>>>>>> a53e995b4bcd56791afb607c1bca9d59f42ffbed
                                    </form>
                            </section>

                            <section class="aCacher" id="presse">
                                <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                                    <h5>Article Presse</h5>
                                    <table class="mdl-data-table">
                                        <tr>
                                            <th>Titre</th>
                                            <th class="large">Lien</th>
                                            <th> Mod</th>
                                            <th>Suppr</th>
                                        </tr>
                                        @foreach($articles as $article)
                                            @if ($article['articletype_name'] == 'presse')
                                                <tr id="article_">
                                                    <td id="article_presse_titre">{{$article['title']}}</td>
                                                    <td id="article_presse_lien"><a href="{{$article['link']}}"
                                                                                    target="_blank">lien</a></td>
                                                    <td>
                                                        <button id="btn_modifier_presse" class="bouton_table"><i
                                                                    class="mdl-color-text--blue-grey-400 material-icons"
                                                                    role="button">create</i></button>
                                                    </td>
                                                    <td>

                                                        <button data-id="" id="btn_delete_presse" class="bouton_table">
                                                            <i
                                                                    class="mdl-color-text--blue-grey-400 material-icons"
                                                                    role="presentation">delete</i></button>

                                                    </td>
                                                    <input type="hidden" name="id" value="">
                                                </tr>
                                            @endif
                                        @endforeach
                                    </table>
                                    <button id="btn_ajout_presse" class="bouton_ajout bouton_table"><i

                                                class="bouton_table mdl-color-text--blue-grey-400 material-icons"
                                                role="presentation">add_circle</i></button>


                                </div>
                            </section>
                            <section class="aCacher" id="modifier_news">
                                <h5>Modifier un article news</h5>
                                <form method="POST" action="" enctype="">
                                    <input type="hidden" name="id" value="">
                                    <p>Titre <input id="article_news_modifier_nom" type="text" name="title"></p>
                                    Description <textarea id="article_news_modifier_description"
                                                          name="description"></textarea>
                                    <p>Audiovisuel <input id="article_news_modifier_media" type="file" accept="image"
                                                          accept="video" name="media"></p>
                                    <input type="hidden" name="id" value="">
                                    <input type="hidden" name="article_url" value="">
                                    <input type="submit" name="type" value="Valider" id="btn_ajout_sponsor"
                                           class="mdl-button bouton_valider mdl-color--accent mdl-color-text--accent-contrast">
                                </form>
                            </section>
                            <section class="aCacher" id="modifier_presse">
                                <h5>Modifier un article de presse</h5>
                                <form method="POST" action="" enctype="">
                                    <p>Titre <input id="article_presse_modifier_nom" type="text"></p>
                                    Description <textarea id="article_presse_modifier_description"></textarea>
                                    <p>Lien <input type="url" id="article_url"></p>
                                    <input type="hidden" name="id" value="">
                                    <input type="hidden" name="article_media" value="">
                                    <input type="submit" name="type" value="Valider" id="btn_ajout_sponsor"
                                           class="mdl-button bouton_valider mdl-color--accent mdl-color-text--accent-contrast">
                                </form>
                            </section>
                            <section class="aCacher" id="media">
                                <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                                    <h5>Médias</h5>
                                    <table class="mdl-data-table">
                                        <tr>
                                            <th>Titre</th>
                                            <th class="large">Description</th>
                                            <th>Image / Vidéo</th>
                                            <th> Mod</th>
                                            <th>Suppr</th>
                                        </tr>
                                        @foreach ($medias as $media)
                                            <tr id="media_">
                                                <td id="media_titre">{{$media['title']}}</td>
                                                <td id="media_description">
                                                    @if ($media['legend']!= null)
                                                        {{ substr($media['legend']) }}...
                                                    @else
                                                        -
                                                    @endif</td>
                                                <td id="media_image"><img src="{{ url($media['url']) }}" height="50"
                                                                          width="50"></td>
                                                <td>
                                                    <button id="btn_modifier_media" class="bouton_table"><i
                                                                class="mdl-color-text--blue-grey-400 material-icons"
                                                                role="button">create</i></button>
                                                </td>
                                                <td>

                                                    <button id="btn_delete_media" class="bouton_table"><i
                                                                class="mdl-color-text--blue-grey-400 material-icons"
                                                                role="presentation">delete</i></button>

                                                </td>
                                                <input type="hidden" name="id" value="">
                                            </tr>
                                        @endforeach
                                    </table>
                                    <button id="btn_ajout_media" class="bouton_ajout bouton_table"><i

                                                class="bouton_table mdl-color-text--blue-grey-400 material-icons"
                                                role="presentation">add_circle</i></button>

                                </div>
                            </section>
                            <section class="aCacher" id="ajout_media">
                                <h5>Ajouter un media</h5>
                                <form method="POST" action="{{url('/auth/media')}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <p>Titre <input id="media_nouveau_titre" name="title" type="text"></p>
                                    Legend <textarea id="media_nouveau_description" name="legend"></textarea>
                                    <p>Audiovisuel <input id="media_nouveau_image" type="file" accept="image"
                                                          accept="video" name="media"></p>
                                    <input type="submit" name="type" value="Valider" id="btn_ajout_sponsor"
                                           class="mdl-button bouton_valider mdl-color--accent mdl-color-text--accent-contrast">
                                </form>
                            </section>
                            <section class="aCacher" id="modifier_media">
                                <h5>Modifier un media</h5>
                                <form method="POST" action="" enctype="">
                                    <p>Titre <input id="media_modifier_titre" name="title" type="text"></p>
                                    Legend <textarea id="media_modifier_description" name="legend"></textarea>
                                    <p>Audiovisuel <input id="media_modifier_image" type="file" accept="image"
                                                          accept="video" name="media"></p>
                                    <input type="submit" name="type" value="Valider" id="btn_ajout_sponsor"
                                           class="mdl-button bouton_valider mdl-color--accent mdl-color-text--accent-contrast">
                                </form>
                            </section>

                        </div>
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

</main>
</div>
@include('backoffice/footer')
