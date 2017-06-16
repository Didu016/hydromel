<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sponsor;
use App\Models\Rank;
use App\Models\Media;
use App\Models\Edition;
use App\Models\Sponsoring;
use Illuminate\Support\Facades\DB;

class SponsorCtrl extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    public function index() {
        $sponsors = Sponsor::getSponsorsFormatted(Edition::getCurrentEdition()->sponsors()->get());
        $ranks = Rank::all();
        //dd($sponsors);
        return view('backoffice/sponsor', [
            'sponsors' => $sponsors,
            'ranks' => $ranks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        /*---- RECUPERATIONS DES DONNEES RECUES ----*/
        $dataSponsor['society'] = $request->society;
        $dataSponsor['mail_contact'] = $request->mail_contact;
        $dataSponsor['amount'] = $request->amount;
        $dataSponsor['link'] = $request->link;
        $rank = $request->rank;
        $dataMedia = $request->files->get('logo_url');

        /*---- VALIDATIONS ----*/
        $validMedia = true; // Par defaut la validation du media est a true, pour si jamais il n'y a pas de media
        if($dataMedia != null) { // Si il y a un media
            $mediaMaxSize = 20000000;
            $allowedTypes = array('gif', 'jpeg', 'jpg', 'mp4', 'png', 'webm'); // Types de fichiers acceptes
            $validMedia = Media::isValid($dataMedia, $allowedTypes, $mediaMaxSize);
        }
        $validSponsor = Sponsor::isValid($dataSponsor);
        $validRank = Rank::exists($rank);

        /*---- CREATION ----*/
        if($validMedia != false && $validMedia != false && $validSponsor != false && $validRank != false){
            DB::transaction(function () use ($dataSponsor, $dataMedia, $rank) {

                // Creation d'un nouveau sponsor
                $sponsor = new Sponsor();
                $sponsor->society = $dataSponsor['society'];
                $sponsor->amount = $dataSponsor['amount'];
                $sponsor->mail_contact = $dataSponsor['mail_contact'];
                $sponsor->link = $dataSponsor['link'];

                // Creer le media (s'il y en a un)
                if($dataMedia != null){
                    $mediaDestination = "../public/img/sponsorsMedias";
                    $mediaDestinationShortened = "img/sponsorsMedias";
                    $media = new Media();
                    $media->title = 'logo_' . $dataSponsor['society'];
                    $media->url = $mediaDestinationShortened . '/' . 'logo_' . $dataSponsor['society'] . '.' . $dataMedia->getClientOriginalExtension();
                    $videoTypes = array('mp4', 'webm'); // Par la suite nous pourrions faire d'autre check pour des fichiers audios etc etc (en fonction de nos types de MediaTypes
                    if (in_array($dataMedia->getClientOriginalExtension(), $videoTypes)) { // Si le média reçu est une vidéo
                        $media->mediatype_id = 1; // Alors on set que c'est une photo
                    } else { // Si le média reçu est une photo
                        $media->mediatype_id = 2; // Alors on set que c'est une photo
                    }
                    $media->save(); // Sauvegarde du media
                    $dataMedia->move($mediaDestination, 'logo_' . $dataSponsor['society'] . '.' . $dataMedia->getClientOriginalExtension()); // Déplace la photo dans le dossier voulu

                    $sponsor->logo_url =  $mediaDestinationShortened . '/' . 'logo_' . $dataSponsor['society'] . '.' . $dataMedia->getClientOriginalExtension();

                } else {
                    $sponsor->logo_url = null; // Pas de media specifie, alors null
                }

                $sponsor->save(); // Sauvegarde du sponsor

                // Recuperation du rank id
                $rankId = Rank::where([
                    ['name', '=', $rank]
                ])->get()->first()->id;

                // Choppe l'edition courante et ses informations pour retrouver le sponsoring correspondant
                $currentEdition = Edition::getCurrentEdition();
                $currentEditionId = $currentEdition->id; // Recuperation de l'id de l'edition courrante
                $sponsorId = $sponsor->id; // Récupération de l'id du sponsor

                $sponsoring = new Sponsoring();
                $sponsoring->edition_id = $currentEditionId;
                $sponsoring->sponsor_id = $sponsorId;
                $sponsoring->rank_id = $rankId;
                $sponsoring->save();
            });
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  
    public function show($id) {
        //
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

    public function update(Request $request, $id)
    {
        /*---- RECUPERATIONS DES DONNEES RECUES ----*/
        $idSponsor = $id;
        $dataSponsor['society'] = $request->sponsor_nom;
        $dataSponsor['mail_contact'] = $request->sponsor_mail;
        $dataSponsor['amount'] = $request->sponsor_amount;
        $dataSponsor['link'] = $request->sponsor_link;
        $rank = $request->sponsor_categorie;
        $dataMedia = $request->files->get('sponsor_logo');
        $idOldMedia = $request->oldMedia_id;

        /*---- VALIDATIONS ----*/
        $validMedia = true; // Par defaut la validation du media est a true, pour si jamais il n'y a pas de media
        if ($dataMedia != null) { // Si il y a un media
            $mediaMaxSize = 20000000;
            $allowedTypes = array('gif', 'jpeg', 'jpg', 'mp4', 'png', 'webm'); // Types de fichiers acceptes
            $validMedia = Media::isValid($dataMedia, $allowedTypes, $mediaMaxSize);
        }
        $validSponsor = Sponsor::isValid($dataSponsor);
        $validRank = Rank::exists($rank);
        // Valider l'existence de ce sponsor
        $sponsor = Sponsor::find($idSponsor);
        // Valider l'existence de ce media
        if ($idOldMedia != null) {
            $existingMedia = Media::find($idOldMedia);
        } else {
            $existingMedia = null;
        }

        /*---- MODIFICATION ----*/
        if ($validMedia != false && $validMedia != false && $validSponsor != false && $validRank != false) {
            DB::transaction(function () use ($dataSponsor, $dataMedia, $rank, $sponsor, $existingMedia) {

                // Modification du sponsor
                $sponsor->society = $dataSponsor['society'];
                $sponsor->amount = $dataSponsor['amount'];
                $sponsor->mail_contact = $dataSponsor['mail_contact'];
                $sponsor->link = $dataSponsor['link'];


                // Modifier le media

                // Modifier le media
                if ($dataMedia != null) {
                    $mediaDestination = "../public/img/sponsorsMedias";
                    $mediaDestinationShortened = "img/sponsorsMedias";
                    $existingMedia->title = 'logo_' . $dataSponsor['society'];
                    $existingMedia->url = $mediaDestinationShortened . '/' . 'logo_' . $dataSponsor['society'] . '.' . $dataMedia->getClientOriginalExtension();
                    $videoTypes = array('mp4', 'webm'); // Par la suite nous pourrions faire d'autre check pour des fichiers audios etc etc (en fonction de nos types de MediaTypes
                    if (in_array($dataMedia->getClientOriginalExtension(), $videoTypes)) { // Si le média reçu est une vidéo
                        $existingMedia->mediatype_id = 1; // Alors on set que c'est une photo
                    } else { // Si le média reçu est une photo
                        $existingMedia->mediatype_id = 2; // Alors on set que c'est une photo
                    }
                    $existingMedia->save(); // Sauvegarde du media
                    $dataMedia->move($mediaDestination, 'logo_' . $dataSponsor['society'] . '.' . $dataMedia->getClientOriginalExtension()); // Déplace la photo dans le dossier voulu
                    $sponsor->logo_url = $mediaDestinationShortened . '/' . 'logo_' . $dataSponsor['society'] . '.' . $dataMedia->getClientOriginalExtension();
                } else { // Alors y'a pas de media
                    $sponsor->logo_url = null; // Pas de media specifie, alors null
                }
                $sponsor->save(); // Sauvegarde du sponsor

                // Recuperation du rank id
                $rankId = Rank::where([
                    ['name', '=', $rank]
                ])->get()->first()->id;

                // Choppe l'edition courante et ses informations pour retrouver le sponsoring correspondant
                $currentEdition = Edition::getCurrentEdition();
                $currentEditionId = $currentEdition->id; // Recuperation de l'id de l'edition courrante
                $sponsorId = $sponsor->id; // Récupération de l'id du sponsor

                //recuperer et modifier le sponsoring
                DB::table('sponsoring')
                    ->where('edition_id', $currentEditionId)
                    ->where('sponsor_id', $sponsorId)
                    ->update(array('rank_id' => $rankId));
                /* ceci ci-dessous ne fonctionne pas, nous n'avons pas trouvé pourquoi
                                $sponsoring = Sponsoring::where([
                                    ['edition_id', '=', $currentEditionId],['sponsor_id', '=', $sponsorId],['rank_id', '=', 1]
                                ])->get()->first();
                                dd($sponsoring->getKeyName());
                                $sponsoring->rank_id = 0;
                                $sponsoring->save();
                */
            });
            return redirect()->back();
        } else {
            echo 'gerer le message d erreur ici';
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id) {
        //
    }
}
