<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PreviousEditionCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_current = Edition::getCurrentEdition()->id;
        $editionsP = Edition::getPreviousEditionsSimplified();
        $rewards = Reward::all()->whereNotIn('edition_id', $id_current)->sortByDesc("year")->toArray();
        return view("backoffice/editionP", [
            'editionsP' => $editionsP,
            'rewards' => $rewards
        ]);
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
        //
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
    public function update(Request $request, $id)
    {
        // On va update le champ description de l'édition avec l'id reçu
        $idEdition = $id;

        $newDescription = $request->editionP_description;

        // Valider l'existence de l'édition
        $uneEdition = Edition::find($idEdition);
        if($uneEdition != null){ // Si l'edition demandee existe
            $place = $uneEdition->place; // On récupère le lieu pour réutiliser un fonction de validation déjà présente
            $dataToValid = array('description' => $newDescription,
                                 'place'       => $place,
                                 'beginningDate' => null,
                                 'finishingDate' => null); // Création du tableau de data
            $validDescription = Edition::isValidForUpdate($dataToValid); // Validation des champs

            if($validDescription != false){
                // Débuter la transaction
                DB::transaction(function () use ($uneEdition, $newDescription){
                    $uneEdition->description = $newDescription;
                    $uneEdition->save();
                });
                return redirect()->back();
            /* ----------------------------------- REUSSITE ---------------------------*/
            } else {
                dd('problème dans les données reçues');
            }
        } else { // L'edition demandee n'existe pas
            /* ----------------------------------- ECHEC ------------------------------*/
            dd('l\'édition demandée n\'existe pas. Mauvais ID reçu.');
        }


        // Valider le texte (que c'est pas du html etc etc etc etc

        // Update la description de l'édition



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
