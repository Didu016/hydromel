<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
<<<<<<< HEAD
     * Formats the members to display. 
=======
     * Formats the members to display.
>>>>>>> 792c8c4c38a097dc028dd64e12ae05ff1368c028
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

<<<<<<< HEAD
=======
    public static function isValid($data) {
        // CHECK CONTRAINTES INTEGRITES
        // un membre peut avoir plusieurs médias si pas même édition
        // Pas besoin de tester car on va, si la personne veut changer, changer le file ou changer le url, donc pas de rajout
        // REGLES DE VALIDATION
        return Validator::make($data, [
                    'firstname' => 'string|between:1,50|required', // on vérifie pas les chiffres et autres caractères
                    'name' => 'string|between:1,50|required', // on vérifie pas les chiffres et autres caractères
                    'email' => 'email|between:1,50|required',
                ])->passes();
    }

    public static function exists($data) {

        return self::where([
                    ['firstname', '=', $data['firstname']],
                    ['name', '=', $data['name']],
                    ['email', '=', $data['email']]
                ])->first() != null;
    }

    public static function findFromAttributes($data) {

        return self::where([
                    ['firstname', '=', $data['firstname']],
                    ['name', '=', $data['name']],
                    ['email', '=', $data['email']]
                ])->first();
    }

    public static function createMember($dataMember, $dataResponsibility, $dataMedia, $edition = null) {

        // Valider les champs du membre
        if (!Member::isValid($dataMember)) {
            return null;
        }

        $alreadyExistingMember = Member::exists($dataMember);
        //
        // Valider la responsability
        if (!Responsibility::isValid($dataResponsibility)) {
            return null;
        }

        // Valider le media
        // 12 Mo max size
        $mediaMaxSize = 12000000;
        $allowedTypes = array('gif', 'jpeg', 'jpg', 'mp4', 'png', 'webm'); // Types de fichiers acceptes
        if (!Media::isValid($dataMedia, $allowedTypes, $mediaMaxSize)) {
            return null;
        }
        return DB::transaction(function () use ($dataMedia, $dataMember, $dataResponsibility, $edition, $alreadyExistingMember) {

                    $member = null;
                    if ($alreadyExistingMember) {
                        $member = self::findFromAttributes($dataMember);
                    } else {
                        $member = new Member();
                        $member->firstname = $dataMember['firstname'];
                        $member->name = $dataMember['name'];
                        $member->email = $dataMember['email'];
                        $member->save();
                    }

                    if ($member == null) {
                        return null;
                    }

                    // Creer le media
                    $mediaDestination = "../public/img/membersMedias";
                    $mediaDestinationShortened = "img/membersMedias";
                    $media = new Media();
                    $media->title = 'media_' . $dataMember['name'];
                    $media->url = $mediaDestinationShortened . '/media_' . $dataMember['name'] . '.' . $dataMedia->getClientOriginalExtension();
                    $videoTypes = array('mp4', 'webm'); // Par la suite nous pourrions faire d'autre check pour des fichiers audios etc etc (en fonction de nos types de MediaTypes
                    if (in_array($dataMedia->getClientOriginalExtension(), $videoTypes)) { // Si le média reçu est une vidéo
                        $media->mediatype_id = 1; // Alors on set que c'est une photo
                    } else { // Si le média reçu est une photo
                        $media->mediatype_id = 2; // Alors on set que c'est une photo
                    }
                    $media->save();
                    $dataMedia->move($mediaDestination, ('media_' . $dataMember['name'] . '.' . $dataMedia->getClientOriginalExtension())); // Déplace la photo dans le dossier voulu
                    // Ajouter ce membre a l'edition
                    if ($edition == null) {
                        $edition = Edition::getCurrentEdition();
                    }
                    $responsibilities = Responsibility::all();
                    $responsibilityId = 0;

                    for ($i = 1; $i < count($responsibilities) + 1; $i++) {
                        $oneResponsibility = Responsibility::find($i);
                        if ($oneResponsibility['name'] == $dataResponsibility) {
                            $responsibilityId = $oneResponsibility->id;
                        }
                    }

                    $edition->medias()->save($media); // PK ON FAIT CA
                    $participation = new Participation();
                    $participation->member_id = $member->id;
                    $participation->edition_id = $edition->id;
                    $participation->responsibility_id = $responsibilityId;
                    $participation->media_id = $media->id;
                    $participation->save();
                    return $member;
                }); // Fin de la transaction
    }

    public static function getSupervisorFromEdition($edition) {
        $current_edition_members = Member::getMembersFormatted($edition->members()->get());
        foreach ($current_edition_members as $member) {
            if ($member['responsibility_name'] == 'Chercheur-Superviseur') {
                return $member;
            }
        }
        return null;
    }
>>>>>>> 792c8c4c38a097dc028dd64e12ae05ff1368c028
}
