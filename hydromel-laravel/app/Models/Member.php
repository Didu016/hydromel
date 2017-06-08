<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model {

    public $timestamps = false;

    public function editions() {
        return $this->belongsToMany('App\Models\Edition', 'participation', 'edition_id', 'member_id')
                        ->withPivot('responsibility_id', 'media_id');
    }

}
