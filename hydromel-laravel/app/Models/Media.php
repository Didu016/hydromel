<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model {

    protected $table = 'medias';

    public function mediatype() {
        return $this->belongsTo('App\Models\MediaType');
    }

    public function articles() {
        return $this->belongsToMany('App\Models\Article', 'integration');
    }

    public function editions() {
        return $this->belongsToMany('App\Models\Edition', 'usage');
    }

}
