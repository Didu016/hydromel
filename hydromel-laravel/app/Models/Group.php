<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {
    
    public $timestamps = false;

    public function users() {
        return $this->belongsToMany('App\Models\User', 'membership');
    }
    
    public function resources() {
        return $this->belongsToMany('App\Models\Resource', 'access');
    }

}
