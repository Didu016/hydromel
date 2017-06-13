<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model {

    public $table = 'medias';

    public function mediatype() {
        return $this->belongsTo('App\Models\MediaType');
    }

    public function articles() {
        return $this->belongsToMany('App\Models\Article', 'integration');
    }

    public function editions() {
        return $this->belongsToMany('App\Models\Edition', 'usage');
    }

    public static function isValid($data, $allowedTypes, $maxSize){
        if($data != null) {
            $typeMedia = $data->getClientOriginalExtension();
            for ($i = 0; $i < count($allowedTypes); $i++) {
                if (in_array($typeMedia, $allowedTypes)) { // Si le media est de bon type
                    if ($data->getClientSize() < $maxSize) {
                        return true;
                    } else {
                        return false; // Media trop grand
                    }
                } else {
                    return false; // Type du média non accepté
                }
            }
        } else {
            return false; // Pas de média reçu
        }
    }
}
