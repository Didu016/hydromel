<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model {

    public $timestamps = false;
    protected $fillable = [
        'responsibility_id', 'media_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'responsibility_id', 'media_id'
    ];

    public function editions() {
        return $this->belongsToMany('App\Models\Edition', 'participation', 'member_id', 'edition_id')
                        ->withPivot('responsibility_id', 'media_id');
    }

}
