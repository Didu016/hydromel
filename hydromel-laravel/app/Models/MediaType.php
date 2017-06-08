<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaType extends Model {

    public $timestamps = false;
    protected $table = 'mediatypes';

    public function medias() {
        return $this->hasMany('App\Models\Media', 'mediatype_id');
    }

}
