<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\Edition;
use Illuminate\Support\Facades\DB;

class MediaCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*---- RECUPERATIONS DES DONNEES RECUES ----*/
        $dataMedia['title']= $request->title;
        $dataMedia['legend'] = $request->legend;
        $theMedia = $request->files->get('media');

        /*---- VALIDATIONS ----*/
        $validMediaData = Media::isDataValid($dataMedia);
        $mediaMaxSize = 2000000;
        $allowedTypes = array('gif', 'jpeg', 'jpg', 'mp4', 'png', 'webm'); // Types de fichiers acceptes
        $validMedia = Media::isValid($theMedia, $allowedTypes, $mediaMaxSize);

        if($theMedia != null && $validMediaData != false && $validMedia != false){
            DB::transaction(function () use ($dataMedia, $theMedia) {
                // Creer le media
                $mediaDestination = "../public/img/generalMedias";
                $media = new Media();
                $media->title = $dataMedia['title'];
                $media->legend = $dataMedia['legend'];
                $media->url = $mediaDestination . '/' . $theMedia->getClientOriginalName();
                $videoTypes = array('mp4', 'webm'); // Par la suite nous pourrions faire d'autre check pour des fichiers audios etc etc (en fonction de nos types de MediaTypes)
                if (in_array($theMedia->getClientOriginalExtension(), $videoTypes)) { // Si le media reçu est une vidéo
                    $media->mediatype_id = 1; // Alors on set que c est une photo
                } else { // Si le media recu est une photo
                    $media->mediatype_id = 2; // Alors on set que c est une photo
                }
                $media->save();
                $theMedia->move($mediaDestination, $theMedia->getClientOriginalName()); // Déplace la photo dans le dossier voulu

                // Sauvegarde du média dans l'édition actuelle
                $currentEdition = Edition::all()->sortByDesc("year")->first();
                $currentEdition->medias()->save($media);
            }); // Fin de la transaction
        } else {
            // PROBLEMMEEEEEEEE
            dd('léger soucis là couz1');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request /*, $id*/)
    {

        /*---- RECUPERATIONS DES DONNEES RECUES ----*/
        $dataMedia['title']= $request->title;
        $dataMedia['legend'] = $request->legend;
        $theNewMedia = $request->files->get('media');
        $idMedia = $request->id;

        /*---- VALIDATIONS ----*/
        $validMediaData = Media::isDataValid($dataMedia);
        $mediaMaxSize = 2000000;
        $allowedTypes = array('gif', 'jpeg', 'jpg', 'mp4', 'png', 'webm'); // Types de fichiers acceptes
        $validMedia = Media::isValid($theNewMedia, $allowedTypes, $mediaMaxSize);
        $oldMedia = Media::find($idMedia);
        if($oldMedia != null){
            $existsMedia = true;
        } else {
            $existsMedia = false;
        }


        if($theNewMedia != null && $validMediaData != false && $validMedia != false && $existsMedia != false){
            DB::transaction(function () use ($dataMedia, $theNewMedia, $idMedia, $oldMedia) {
                // Supprimer l'ancien media
                if (file_exists($oldMedia->url)){
                    unlink($oldMedia->url); // Supprimer la photo
                }

                // modification du media
                $mediaDestination = "../public/img/generalMedias";
                $media = Media::find($idMedia);
                $media->title = $dataMedia['title'];
                $media->legend = $dataMedia['legend'];
                $media->url = $mediaDestination . '/' . $theNewMedia->getClientOriginalName();
                $videoTypes = array('mp4', 'webm'); // Par la suite nous pourrions faire d'autre check pour des fichiers audios etc etc (en fonction de nos types de MediaTypes
                if (in_array($theNewMedia->getClientOriginalExtension(), $videoTypes)) { // Si le média reçu est une vidéo
                    $media->mediatype_id = 1; // Alors on set que c'est une photo
                } else { // Si le média reçu est une photo
                    $media->mediatype_id = 2; // Alors on set que c'est une photo
                }
                $media->save();
                $theNewMedia->move($mediaDestination, $theNewMedia->getClientOriginalName()); // Déplace la photo dans le dossier voulu
            }); // Fin de la transaction
        } else {
            // PROBLEMMEEEEEEEE
            dd('léger soucis là couz1');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
