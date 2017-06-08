<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

}
