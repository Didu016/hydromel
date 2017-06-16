<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Media;
use App\Models\Edition;
use App\Models\Participation;
use App\Models\Responsibility;
use Illuminate\Http\Request;
use App\Models\Member;

class MembreCtrl extends Controller {

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        // RECUPERATIONS DES DONNEES RECUES
        $dataMember['firstname'] = $request->membre_prenom;
        $dataMember['name'] = $request->membre_nom;
        $dataMember['email'] = $request->membre_mail;
        $dataResponsibility = $request->membre_responsibility;
        $dataMedia = $request->files->get('membre_image');

        Member::createMember($dataMember, $dataResponsibility, $dataMedia);
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
    public function update(Request $request,  $id) {
        // $memberId = $id; // nous avons pas implémenter le formulaire de la sorte
        $memberId = $request->id_member; // l'id du membre est passé en hidden dans la formulaire

        // RECUPERATION DU MEMBRE
        $member = Member::find($memberId);

        // RECUPERATIONS DES DONNEES RECUES
        $dataMember['firstname'] = $request->membre_prenom;
        $dataMember['name'] = $request->membre_nom;
        $dataMember['email'] = $request->membre_mail;
        $dataResponsability = $request->membre_resp;
        $dataMedia = $request->files->get('membre_image');

        // Valider la description
        $validDataMember = Member::isValid($dataMember); // true si valid, false si non
        // Valider la responsability
        $validResponsibility = false;
        $validDataResponsibility = Responsibility::isValid($dataResponsability);

        // Valider le média
        $validMedia = false;
        $mediaMaxSize = 2000000;
        $allowedTypes = array('gif', 'jpeg', 'jpg', 'mp4', 'png', 'webm'); // Types de fichiers acceptes
        $validMedia = Media::isValid($dataMedia, $allowedTypes, $mediaMaxSize);



        // Changer les data
        // Changer la responsibility
        // Changer le media

        if ($validDataMember != false && $validDataResponsibility != false && $validMedia != false) {
            DB::transaction(function () use ($dataMedia, $dataMember, $member, $memberId) {

                // Update le membre
                $member->firstname = $dataMember['firstname'];
                $member->name = $dataMember['name'];
                $member->email = $dataMember['email'];
                
                //$actualEdition = EditionCtrl::getDataFromCurrentEdition()->content()->current_edition; // Récupération de la totalité des informations des éditions
                $actualEdition = Edition::getCurrentEditionJson();
                $actualEditionYear = $actualEdition['edition']->year;
                $actualEditionMembers = $actualEdition['members'];

                //dd($actualEditionMembers);

                // il faut supprimer le media deja existant dans le dossier - quand le temps le permettera

                /*
                $mediaDestination = "../public/img/membersMedias";
                $mediaDestinationShortened = "img/membersMedias";
                for ($i = 0; $i < count($actualEditionMembers); $i ++) {
                    if ($actualEditionMembers[$i]['id'] == $memberId) {
                        $hisMedia = Media::find($actualEditionMembers[$i]->pivot->media_id); // Recuperation de son media
                        // On pourrait changer le nom du média aisément (reprendre le mail par exemple, comme ça il reste unique
                        $dataMedia->move($mediaDestination, ('media_' . $dataMember['name'] . '.' . $dataMedia->getClientOriginalExtension())); // Déplace la photo dans le dossier voulu
                        $hisMedia->url = $mediaDestinationShortened . '/media_' . $dataMember['name'] . '.' . $dataMedia->getClientOriginalExtension(); // Sauvegarde du nouveau chemin
                        // Regarde le lien avec MediaTypes
                        $videoTypes = array('mp4', 'webm'); // Par la suite nous pourrions faire d'autre check pour des fichiers audios etc etc (en fonction de nos types de MediaTypes
                        if (in_array($dataMedia->getClientOriginalExtension(), $videoTypes)) { // Si le média reçu est une vidéo
                            if ($hisMedia->mediatype_id != 1) { // Si le média original n'est pas une vidéo
                                $hisMedia->mediatype_id = 1; // Alors on set que c'est une photo
                            }
                        } else { // Si le média reçu est une photo
                            if ($hisMedia->mediatype_id != 2) { // Si le média orignal n'est pas une photo
                                $hisMedia->mediatype_id = 2; // Alors on set que c'est une photo
                            }
                        }
                    }
                }
                */
                $member->save();
               // $hisMedia->save(); // Update du media
                echo 'ça a marché';
            }); // Fin de la transaction
            // REUSSITE
        } else { // SINON ERREUUUUUUUUUUUUUUR --------------------------------------------------------------------------
            dd('un des champs est pas bon');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Participation::where('member_id', $id)->delete();
        Member::destroy($id);
    }

}
