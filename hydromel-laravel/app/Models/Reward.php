<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Reward extends Model {

    public $timestamps = false;
    protected $hidden = array('pivot');

    public function edition() {
        return $this->belongsTo('App\Models\Edition');
    }

    public static function isValid($data){
        return Validator::make($data, [
            'distinction' => 'string|between:1,30|required', // on vérifie pas les chiffres et autres caractères
            'position' => 'numeric|between:1,200|required', // on vérifie pas les chiffres et autres caractères
            'description' => 'string|between:1,400|required',
            'value' => 'numeric|between:1,1000000000|nullable',
        ])->passes();
    }

}
