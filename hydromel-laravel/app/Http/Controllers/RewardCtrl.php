<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Edition;
use App\Models\Reward;
use Illuminate\Support\Facades\DB;


class RewardCtrl extends Controller
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
        // Récupération de l'édition
        //$editionId = $request->edtionId;
        $editionId = 3; // set pendant les tests
        $edition = Edition::find($editionId);

        // Récupération des données
        $dataReward['distinction'] = $request->prix_distinction;
        $dataReward['position'] = $request->prix_position;
        $dataReward['description'] = $request->prix_description;
        $dataReward['value'] = $request->prix_value;

        $dataRewardValid = Reward::isValid($dataReward);

        // Si les datas sont valides alors on va upload tout ça
        if($dataRewardValid != false && $edition != null){
            DB::transaction(function () use ($dataReward, $edition, $editionId) {

                $reward = new Reward();
                $reward->edition_id = $editionId;
                $reward->distinction = $dataReward['distinction'];
                $reward->position = $dataReward['position'];
                $reward->description = $dataReward['description'];
                $reward->value = $dataReward['value'];
                $reward->save();

                // Sauvegarde du reward
                $edition->rewards()->save($reward);
            });
        } else {
            echo 'problème mon gars, et il faut faire un message ici'; /*----- RENVOYER UN MESSAGE ICI -----*/
        }

        return redirect()->back();
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
        // Récupération du reward à modifier
        //$rewardId = $id; // Pas fait de la sorte
        $rewardId = $request->reward_id; // l'id est passé en hidden dans le formulaire
        $reward = Reward::find($rewardId);
        // Récupération de l'édition
        $editionId = $reward->edition_id;
        $edition = Edition::find($editionId);


        // Récupération des données
        $dataReward['distinction'] = $request->prix_distinction;
        $dataReward['position'] = $request->prix_position;
        $dataReward['description'] = $request->prix_description;
        $dataReward['value'] = $request->prix_value;

        $dataRewardValid = Reward::isValid($dataReward);

        if($dataRewardValid != false && $edition != null && $reward != null) {
            DB::transaction(function () use ($reward, $dataReward, $edition, $editionId) {

                $reward->edition_id = $editionId;
                $reward->distinction = $dataReward['distinction'];
                $reward->position = $dataReward['position'];
                $reward->description = $dataReward['description'];
                $reward->value = $dataReward['value'];
                $reward->save();

                // Sauvegarde du reward
                $edition->rewards()->save($reward);
                echo 'ça a reussi il faut mettre un message ici';
            });
        } else {
            echo 'probleme ici il faut gérer le message d erreur';
        }

        return redirect()->back();
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
