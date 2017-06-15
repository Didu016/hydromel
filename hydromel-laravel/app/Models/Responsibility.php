<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Responsibility extends Model
{
    public $timestamps = false;
    protected $table = "responsibilities";

    public static function isValid($dataResponsibility){
        for($i = 1 ; $i < 900000 ; $i ++ )
        {
            $responsibility = Self::find($i);
            if($responsibility == null){
                $i = 1000000;
            }
            if($responsibility['name'] == $dataResponsibility) {
                return true; // Elle apparait au moins une fois
                $i = 1000000; // On sort quand on a trouvé une correspondance
            }
        }
        return false;
    }

    public static function isValidForCreation($data){
        $dataArray['reponsibility'] = $data;
        return Validator::make($dataArray, [
            'reponsibility' => 'string|between:1,50|required', // on vérifie pas les chiffres et autres caractères
        ])->passes();
    }
}
