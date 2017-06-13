<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Edition extends Model {

    public $timestamps = false;

    public function medias() {
        return $this->belongsToMany('App\Models\Media', 'usage');
    }

    public function rewards() {
        return $this->hasMany('App\Models\Reward');
    }

    public function sponsors() {
        return $this->belongsToMany('App\Models\Sponsor', 'sponsoring');
    }

    public function members() {
        return $this->belongsToMany('App\Models\Member', 'participation', 'edition_id', 'member_id')
                        ->withPivot('responsibility_id', 'media_id');
    }

    public function articles() {
        return $this->hasMany('App\Models\Article');
    }

    public static function exists($id) {
        // Commande à une clé simple, donc find() peut être utilisé
        return self::find($id) !== null;
    }

    public static function getCurrentEdition() {
        $current_edition = self::all()->sortByDesc("year")->first();
        $current_edition_members = $current_edition->members()->get();
        $json = ['edition' => $current_edition, "members" => $current_edition_members];
        return $json;
    }

    public static function getPreviousEditions() {
        $id_current = self::all()->sortByDesc("year")->first()->id;
        return self::all()->whereNotIn('id', $id_current)->sortByDesc("year");
    }

    public static function isValidForUpdate($data)
    {
        $erreur = false;
        // CHECK CONTRAINTES INTEGRITES
        if (($data['beginningDate'] != null) && ($data['finishingDate'] != null)) { // Si les deux champs sont remplis
            $year = mb_substr($data['beginningDate'], 0, 4); // on choppe juste l'annee
            $yearEdition = self::getCurrentEdition()['edition']->original['year']; // on choppe l'annee de l'edition en cours
            if ($data['beginningDate'] != $yearEdition) { // L'année de début de l'édition doit être dans la même année que l'édition
                $erreur = true;
            }
            if (!($data['beginningDate'] <= $data['finishingDate'])) { // La date de début doit être postérieure à la date de fin d'une édition
                $erreur = true;
            }
        } elseif( ($data['beginningDate'] != null) || ($data['finishingDate'] != null) ) { // Si un des deux champs est rempli
            $erreur = true;
        }

        // REGLES DE VALIDATION
        if($erreur != true) { // Si les contraintes d'integrites sont respectees
            return Validator::make($data, [
                'description' => 'string|between:1,20000|required',
                'place' => 'string|between:1,50|required',
                'beginningDate' => 'nullable|date',
                'finishingDate' => 'nullable|date',
            ])->passes();
        }else{ // Si les contraintes n'ont pas etee respectees
            return !$erreur;
        }
    }

    public static function isValid($parameters){
        // validation here
        return Validator::make($parameters, [
            'id'      => 'exists:news|sometimes|required',
            'title'   => 'string|between:1,200|sometimes|required',
            'body'    => 'string|between:1,10000|sometimes|required',
            'user_id' => 'exists:users,id|sometimes|required',
        ])->passes();
    }

}
