<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model {

    public $table = 'medias';

    //////////// RELATIONSHIPS ////////////

    public function mediatype() {
        return $this->belongsTo('App\Models\MediaType');
    }

    public function articles() {
        return $this->belongsToMany('App\Models\Article', 'integration');
    }

    public function editions() {
        return $this->belongsToMany('App\Models\Edition', 'usage');
    }

<<<<<<< HEAD
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
=======
    //////////// CLASS METHODS ////////////

    /**
     * Formats the media to display. 
     * @param type $laravel_medias the medias as laravel displays it (with foreign keys)
     * @return array formatted medias
     */
    public static function getMediasFormatted($laravel_medias) {
        $medias = array();
        foreach ($laravel_medias as $media) {
            $id = $media->id;
            $created_at = $media->created_at;
            $updated_at = $media->updated_at;
            $url = $media->url;
            $title = $media->title;
            $legend = $media->legend;
            $media_formatted = array();
            $media_formatted['id'] = $id;
            $media_formatted['created_at'] = $created_at;
            $media_formatted['updated_at'] = $updated_at;
            $media_formatted['url'] = $url;
            $media_formatted['title'] = $title;
            $media_formatted['legend'] = $legend;


            //get media type
            $mediatype_name = MediaType::find($media->mediatype_id)->name;
            $media_formatted['mediatype_name'] = $mediatype_name;
            array_push($medias, $media_formatted);
        }
        return $medias;
    }

>>>>>>> 8087fe02f4a9cd9cd1e609726b6ca2a0d5ca3f29
}
