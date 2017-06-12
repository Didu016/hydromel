<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model {

    public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = array("pivot");

    //////////// RELATIONSHIPS ////////////

    public function editions() {
        return $this->belongsToMany('App\Models\Edition', 'participation', 'member_id', 'edition_id')
                        ->withPivot('responsibility_id', 'media_id');
    }

    //////////// CLASS METHODS ////////////

    /**
     * Formats the members to display. 
     * @param type $laravel_members the members as laravel displays it (with foreign keys)
     * @return array formatted members
     */
    public static function getMembersFormatted($laravel_members) {
        $members = array();
        for ($i = 0; $i < $laravel_members->count(); $i++) {
            $member = $laravel_members->get($i);
            $id = $member->id;
            $firstname = $member->firstname;
            $name = $member->name;
            $email = $member->email;
            $member_formatted = array();
            $member_formatted['id'] = $id;
            $member_formatted['firstname'] = $firstname;
            $member_formatted['name'] = $name;
            $member_formatted['email'] = $email;

            // get responsibility and picture of the member
            $responsibility_id = $member->pivot->responsibility_id;
            $media_id = $member->pivot->media_id;
            $responsibility = Responsibility::find($responsibility_id);
            $media = Media::find($media_id);
            $responsibility_name = $responsibility->name;
            $media_url = $media->url;
            $media_file = $media->file;
            $member_formatted['responsibility_name'] = $responsibility_name;
            $member_formatted['media_url'] = $media_url;
            $member_formatted['media_file'] = $media_file;
            array_push($members, $member_formatted);
        }
        return $members;
    }

}
