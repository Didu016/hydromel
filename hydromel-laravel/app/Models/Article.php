<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Article extends Model {

    public function medias() {
        return $this->belongsToMany('App\Models\Media', 'integration');
    }

    public function articletype() {
        return $this->belongsTo('App\Models\ArticleType');
    }

    public function edition() {
        return $this->belongsTo('App\Models\Edition', 'edition_id');
    }


    public static function isValid($data){
        // REGLES DE VALIDATION
        return Validator::make($data, [
            'title' => 'string|between:1,100|required', // on vérifie pas les chiffres et autres caractères
            'description' => 'string|between:1,20000|nullable', // on vérifie pas les chiffres et autres caractères
            'link' => 'URL|between:1,101|nullable',
        ])->passes();
    }

}
