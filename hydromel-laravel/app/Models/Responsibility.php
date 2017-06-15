<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Responsibility extends Model {

    public $timestamps = false;
    protected $table = "responsibilities";

    public static function isValid($dataResponsibility) {
        $responsibilities = self::all();
        foreach ($responsibilities as $responsibility) {
            if ($responsibility->name == $dataResponsibility) {
                return true;
            }
        }
        return false;
    }

    public static function isValidForCreation($data) {
        $dataArray['reponsibility'] = $data;
        return Validator::make($dataArray, [
                    'reponsibility' => 'string|between:1,50|required', // on vérifie pas les chiffres et autres caractères
                ])->passes();
    }

}
