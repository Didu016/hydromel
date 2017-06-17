<?php

namespace App\Http\Controllers;

use App\Models\ArticleType;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Media;
use App\Models\Edition;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Models\Integration;

class ArticleCtrl extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        /* ---- RECUPERATIONS DES DONNEES RECUES ---- */
        $dataArticle['title'] = $request->title;
        $dataArticle['description'] = $request->description;
        $dataArticle['link'] = $request->link;
        $articleType = $request->type;
        if ($dataArticle['link'] == 'null') { // si le champ est hidden, on recoit null en string
            $dataArticle['link'] = null; // alors on set ici a la valeur null
        }
        $dataMedia = $request->files->get('media');

        $error = false; // Set l'erreur à false

        /* ---- CHAMPS OBLIGATOIRES (non testés par un validateur) ---- */
        if ($articleType == null) {
            $error = true; // L'article doit de toute façon posséder un type
        }

        /* ---- CONTRAINTES D'INTEGRITES ---- */
        if ($articleType == 'presse') { // Si c'est un article de presse
            if ($dataArticle['link'] == null) { // Si cet article n'a pas de lien
                $error = true; // RETURN
            }
        }
        if ($dataArticle['description'] == null && $dataArticle['link'] == null) { // Si l'article n'a pas de titre n'y de corps
            $error = true; // Il faut au moins un des
        }

        /* ---- VALIDATIONS ---- */
        $validArticle = Article::isValid($dataArticle); // Validation du contenu de l'article
        $validArticleType = ArticleType::exists($articleType); // Validation du type de l'article
        $validMedia = true; // Par defaut la validation du media est a true, pour si jamais il n'y a pas de media
        if ($dataMedia != null) { // Si il y a un media
            $mediaMaxSize = 20000000;
            $allowedTypes = array('gif', 'jpeg', 'jpg', 'mp4', 'png', 'webm'); // Types de fichiers acceptes
            $validMedia = Media::isValid($dataMedia, $allowedTypes, $mediaMaxSize);
        }
        // Est-ce que la description d'un article presse doit revoir sa taille de caractère vérifiée ?????

        /* ---- UPDATES ---- */
        /* soit on check les medias soit on crée un nouveau un duplicata */
        if ($validArticle != false && $validArticleType != false && $validMedia != false && $error != true) {
            DB::transaction(function () use ($dataArticle, $articleType, $dataMedia) {
                // création de l'article
                $article = new Article();
                $article->title = $dataArticle['title'];
                $article->description = $dataArticle['description'];
                $article->link = $dataArticle['link'];
                if ($articleType == 'presse') {
                    $article->articletype_id = 1;
                } elseif ($articleType == 'news') {
                    $article->articletype_id = 2;
                }
                $currentEdition = Edition::all()->sortByDesc("year")->first();
                $currentEditionId = $currentEdition->id;
                $article->edition_id = $currentEditionId;
                // On ne change pas l'année de l'article, parce qu'un article ne change pas de date
                $article->save();

                // Creer le media
                if ($dataMedia != null) {
                    $mediaDestination = "../public/img/articlesMedias";
                    $mediaDestinationShortened = "img/articlesMedias";
                    $media = new Media();
                    $media->title = $articleType . '_media_' . $dataArticle['title']; // on pourrait faire en sorte de supprimer les espaces ou de les remplacer avec des tirets etc etc oui. Sera fait si le temps le permet, l'idee est la meme
                    $media->url = $mediaDestinationShortened . '/' . $articleType . '_media_' . $dataArticle['title'] . '.' . $dataMedia->getClientOriginalExtension();
                    $videoTypes = array('mp4', 'webm'); // Par la suite nous pourrions faire d'autre check pour des fichiers audios etc etc (en fonction de nos types de MediaTypes
                    if (in_array($dataMedia->getClientOriginalExtension(), $videoTypes)) { // Si le média reçu est une vidéo
                        $media->mediatype_id = 1; // Alors on set que c'est une photo
                    } else { // Si le média reçu est une photo
                        $media->mediatype_id = 2; // Alors on set que c'est une photo
                    }
                    $media->save();
                    $dataMedia->move($mediaDestination, $articleType . '_media_' . $dataArticle['title'] . '.' . $dataMedia->getClientOriginalExtension()); // Déplace la photo dans le dossier voulu
                    $article->medias()->save($media);
                }

                $currentEdition->articles()->save($article);


                // IL FAUT RECUPERER LE MEDIA
                // réupérer le média puis change le file de ce medias
                // du coup faut réupérer l'actuel, le supprimer du repertoire
                // mettre le nouveau dans le repertoire
                // mettre le nouvel url dans le media
                // sauvegarder le media
                //dd('apparently done');
            });

            return redirect()->back();// Fin de la transaction
        } else {
            dd('erreur dans un des champs');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id ) {
        // Ici on va update un article avec un id reçu
        $idArticle = $id;

        $article = Article::find($idArticle);

        $articleTypeId = $article->articletype_id;
        $articleType = ArticleType::find($articleTypeId);
        $nameArticleType = $articleType->name;
        dd($nameArticleType);

        /* ---- RECUPERATIONS DES DONNEES RECUES ---- */
        $dataArticle['title'] = $request->title;
        $dataArticle['description'] = $request->description;
        $dataArticle['link'] = $request->link;
        $articleType = $request->articleType;
        $dataMedia = $request->files->get('media');

        $error = false; // Set l'erreur à false

        /* ---- CHAMPS OBLIGATOIRES (non testés par un validateur) ---- */
        if ($articleType == null) {
            $error = true; // L'article doit de toute façon posséder un type
        }

        /* ---- CONTRAINTES D'INTEGRITES ---- */
        if ($articleType == 'presse') { // Si c'est un article de presse
            if ($dataArticle['link'] == null) { // Si cet article n'a pas de lien
                $error = true; // RETURN
            }
        }
        if ($dataArticle['description'] == null && $dataArticle['link'] == null) { // Si l'article n'a pas de titre n'y de corps
            $error = true; // Il faut au moins un des
        }

        /* ---- VALIDATIONS ---- */
        $validArticle = Article::isValid($dataArticle); // Validation du contenu de l'article
        $validArticleType = ArticleType::exists($articleType); // Validation du type de l'article
        $validMedia = true; // Par defaut la validation du media est a true, pour si jamais il n'y a pas de media
        if ($dataMedia != null) { // Si il y a un media
            $mediaMaxSize = 20000000;
            $allowedTypes = array('gif', 'jpeg', 'jpg', 'mp4', 'png', 'webm'); // Types de fichiers acceptes
            $validMedia = Media::isValid($dataMedia, $allowedTypes, $mediaMaxSize);
        }
        // Est-ce que la description d'un article presse doit revoir sa taille de caractère vérifiée ?????

        dd($articleType);

        /* ---- UPDATES ---- */
        /* soit on check les medias soit on crée un nouveau un duplicata */
        if ($validArticle != false && $validArticleType != false && $validMedia != false && $error != true) {
            DB::transaction(function () use ($dataArticle, $articleType, $article, $dataMedia) {
                // Faire la transaction patati patata

                $article->title = $dataArticle['title'];
                $article->description = $dataArticle['description'];
                $article->link = $dataArticle['link'];
                if ($articleType == 'presse') {
                    $article->articletype_id = 1;
                } elseif ($articleType == 'news') {
                    $article->articletype_id = 2;
                }
                // On ne change pas l'année de l'article, parce qu'un article ne change pas de date
                $article->save();

                dd($article->media());

                // IL FAUT RECUPERER LE MEDIA (si le temps le permet)
                // réupérer le média puis change le file de ce medias
                // du coup faut réupérer l'actuel, le supprimer du repertoire
                // mettre le nouveau dans le repertoire
                // mettre le nouvel url dans le media
                // sauvegarder le media
                //dd('apparently done');
            }); // Fin de la transaction
        } else {
            dd('erreur dans un des champs');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Integration::where('article_id', $id)->delete();
        Article::destroy($id);
    }

}
