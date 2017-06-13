<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Member extends Model {

    public $timestamps = false;

    public function editions() {
        return $this->belongsToMany('App\Models\Edition', 'participation', 'member_id', 'edition_id')
                        ->withPivot('responsibility_id', 'media_id');
    }

    public static function isValid($data){
        // CHECK CONTRAINTES INTEGRITES
            // un membre peut avoir plusieurs médias si pas même édition
            // Pas besoin de tester car on va, si la personne veut changer, changer le file ou changer le url, donc pas de rajout
        $erreur = false;

        // REGLES DE VALIDATION
        if($erreur != true) { // Si les contraintes d'integrites sont respectees
            return Validator::make($data, [
                'firstname' => 'string|between:1,50|required', // on vérifie pas les chiffres et autres caractères
                'name' => 'string|between:1,50|required', // on vérifie pas les chiffres et autres caractères
                'email' => 'email|between:1,50|required',
            ])->passes();
        }else{ // Si les contraintes n'ont pas etee respectees
            return !$erreur;
        }
    }

    public static function exists($data){
        $name = $data['name'];
        $firstname = $data['firstname'];
        $email = $data['email'];

        $someone = self::where([
                ['firstname', '=', $firstname],['name', '=', $name],['email', '=', $email]
        ])->get();

        if ($someone->isEmpty()){
            return false; // personne n'existe encore avec ces infos
        } else {
            return true; // qqun existe deja avec les memes infos
        }
    }

}