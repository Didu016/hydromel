<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Edition;
use App\Models\Media;

class AccueilCtrl extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('backoffice/accueil');
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
        dd('methode store');
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
    public function update(Request $request) { // IL FAUT REMETTRE LE $id QUAND ON AURA ACCES AU FORMULAIRE (ou pas, peut-être)

        $editionActuelle = Edition::getCurrentEdition();
        $idEditionActuelle = $editionActuelle->id;

        // RECUPERATIONS DES DONNEES RECUES
        $dataEdition['description'] = $request->description;
        $dataEdition['place'] = $request->place;
        $dataEdition['beginningDate'] = $request->beginningDate;
        $dataEdition['finishingDate'] = $request->finishingDate;
        $dataMedia[0] = $request->files->get('media1');
        $dataMedia[1] = $request->files->get('media2');

        // Validations des champs de l'édition
        $validDescription = Edition::isValidForUpdate($dataEdition); // true si valid, false si non

        // Validations des médias
        $validMedia = false;
        $target_dir = "files/";
        $mediaMaxSize = 2000000;
        $uploadOk = true;
        $allowedTypes = array('gif', 'jpeg', 'jpg', 'mp4', 'png'); // Types de fichiers autorisés
        for ($i = 0; $i < count($dataMedia); $i++) { // On va creer chacuns des médias
            $uploadOk = Media::isValid($dataMedia[$i], $allowedTypes, $mediaMaxSize);
        }

        // Fin des validations
        // UPLOAD - UPDATES
        if ($validDescription != false && $uploadOk != false) { // Si les donnees sont valides, on fait les mises a jour
            DB::transaction(function () use ($idEditionActuelle, $dataMedia, $dataEdition, $allowedTypes) {

                $edition = Edition::find($idEditionActuelle);
                $edition->description = $dataEdition['description'];
                $edition->place = $dataEdition['place'];
                if (($dataEdition['beginningDate'] != null) && ($dataEdition['finishingDate'] != null)) {
                    $edition->start_date = $dataEdition['beginningDate'];
                    $edition->end_date = $dataEdition['finishingDate'];
                }
                $edition->save();

                // Upload les médias dans le dossier aux bons endroits
                $destination = 'img';
                $fileExists = false;
                $backgroundA = $dataMedia[0];
                $backgroundB = $dataMedia[1];
                if ($backgroundA != null) {
                    for ($i = 0; $i < count($allowedTypes); $i++) {
                        if (file_exists('../public/img/backgroundA.' . $allowedTypes[$i])) {
                            unlink('../public/img/backgroundA.' . $allowedTypes[$i]); // Supprimer la photo
                        }
                    }
                    $backgroundA->move($destination, 'backgroundA' . '.' . $backgroundA->getClientOriginalExtension()); // On met la photo dans le dossier
                }
                if ($backgroundB != null) {
                    for ($i = 0; $i < count($allowedTypes); $i++) {
                        if (file_exists('../public/img/backgroundB' . '.' . $allowedTypes[$i])) {
                            unlink('../public/img/backgroundB' . '.' . $allowedTypes[$i]); // Supprimer la photo
                        }
                    }
                    $backgroundB->move($destination, 'backgroundB' . '.' . $backgroundB->getClientOriginalExtension());
                }
            }); // Fin de la transaction
        } else {
            // gérer l'erreur
            dd('passe pas frere');
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
