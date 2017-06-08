<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Edition extends Model {

    public $timestamps = false;

    public function medias() {
        return $this->belongsToMany('App\Models\Media', 'usage');
    }

    public function rewards() {
        return $this->hasMany('App\Models\Reward');
    }

    public function sponsors() {
        return $this->belongsToMany('App\Models\Sponsor', 'sponsoring');
    }

    public function members() {
        return $this->belongsToMany('App\Models\Member ', 'participation', 'edition_id', 'member_id')
                        ->withPivot('responsibility_id', 'media_id');
    }

    public function articles() {
        return $this->hasMany('App\Models\Article');
    }

}
