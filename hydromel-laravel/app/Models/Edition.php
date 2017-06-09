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
        return $this->belongsToMany('App\Models\Member', 'participation', 'edition_id', 'member_id')
                        ->withPivot('responsibility_id', 'media_id');
    }

    public function articles() {
        return $this->hasMany('App\Models\Article');
    }

    public static function exists($id) {
        // Commande à une clé simple, donc find() peut être utilisé
        return self::find($id) !== null;
    }

    public static function getCurrentEdition() {
        $current_edition = self::all()->sortByDesc("year")->first();
        $current_edition_members = $current_edition->members()->get();
        $json = ['edition' => $current_edition, "members" => $current_edition_members];
        return $json;
    }

    public static function getPreviousEditions() {
        $id_current = self::all()->sortByDesc("year")->first()->id;
        return self::all()->whereNotIn('id', $id_current)->sortByDesc("year");
    }

}
