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

    public static function isValid($data) {
        // CHECK CONTRAINTES INTEGRITES
        // un membre peut avoir plusieurs médias si pas même édition
        // Pas besoin de tester car on va, si la personne veut changer, changer le file ou changer le url, donc pas de rajout
        $erreur = false;

        // REGLES DE VALIDATION
        if ($erreur != true) { // Si les contraintes d'integrites sont respectees
            return Validator::make($data, [
                        'firstname' => 'string|between:1,50|required', // on vérifie pas les chiffres et autres caractères
                        'name' => 'string|between:1,50|required', // on vérifie pas les chiffres et autres caractères
                        'email' => 'email|between:1,50|required',
                    ])->passes();
        } else { // Si les contraintes n'ont pas etee respectees
            return !$erreur;
        }
    }

    public static function exists($data) {
        $name = $data['name'];
        $firstname = $data['firstname'];
        $email = $data['email'];

        $someone = self::where([
                    ['firstname', '=', $firstname], ['name', '=', $name], ['email', '=', $email]
                ])->get();

        if ($someone->isEmpty()) {
            return false; // personne n'existe encore avec ces infos
        } else {
            return true; // qqun existe deja avec les memes infos
        }
    }

    public static function createMember($dataMember, $dataResponsibility, $dataMedia) {
        // Valider les champs du membre
        $alreadyExistingMember = Member::exists($dataMember);
        $validDataMember = Member::isValid($dataMember); // true si valid, false si non
        // Valider la responsability
        $validResponsibility = false;
        $validDataResponsibility = Responsibility::isValid($dataResponsibility);

        // Valider le média
        $validMedia = false;
        $mediaMaxSize = 2000000;
        $allowedTypes = array('gif', 'jpeg', 'jpg', 'mp4', 'png', 'webm'); // Types de fichiers acceptes
        $validMedia = Media::isValid($dataMedia, $allowedTypes, $mediaMaxSize);

        // Changer les data
        // Changer la responsibility
        // Changer le media

        if ($validDataMember != false && $validDataResponsibility != false && $validMedia != false && $alreadyExistingMember != true) {
            DB::transaction(function () use ($dataMedia, $dataMember, $dataResponsibility) {

                // Creer le membre
                $member = new Member();
                $member->firstname = $dataMember['firstname'];
                $member->name = $dataMember['name'];
                $member->email = $dataMember['email'];
                $member->save();

                // Creer le media
                $mediaDestination = "../../img/membersMedias";
                $media = new Media();
                $media->title = 'Photo' . $dataMember['firstname'];
                $media->url = $mediaDestination . '/' . $dataMedia->getClientOriginalName();
                $videoTypes = array('mp4', 'webm'); // Par la suite nous pourrions faire d'autre check pour des fichiers audios etc etc (en fonction de nos types de MediaTypes
                if (in_array($dataMedia->getClientOriginalExtension(), $videoTypes)) { // Si le média reçu est une vidéo
                    $media->mediatype_id = 1; // Alors on set que c'est une photo
                } else { // Si le média reçu est une photo
                    $media->mediatype_id = 2; // Alors on set que c'est une photo
                }
                $media->save();
                $dataMedia->move($mediaDestination, $dataMedia->getClientOriginalName()); // Déplace la photo dans le dossier voulu
                // Ajouter ce membre a l'edition
                $actualEdition = Edition::all()->sortByDesc("year")->first();
                $responsibilities = Responsibility::all();
                $responsibilityId = 0;

                for ($i = 1; $i < count($responsibilities) + 1; $i ++) {
                    $oneResponsibility = Responsibility::find($i);
                    if ($oneResponsibility['name'] == $dataResponsibility) {
                        $responsibilityId = $oneResponsibility->id;
                    }
                }

                $actualEdition->medias()->save($media); // PK ON FAIT CA

                $participation = new Participation();
                $participation->member_id = $member->id;
                $participation->edition_id = $actualEdition->id;
                $participation->responsibility_id = $responsibilityId;
                $participation->media_id = $media->id;
                $participation->save();
            }); // Fin de la transaction
            // REUSSITE
        } else { // SINON ERREUUUUUUUUUUUUUUR --------------------------------------------------------------------------
            dd('un des champs est pas bon ou alors le type existe déjà');
        }
    }

}
