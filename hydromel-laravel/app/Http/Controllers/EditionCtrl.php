<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Edition;
use App\Lib\Message;
use App\Models\Member;

class EditionCtrl extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('backoffice/test');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $year = $request->team;
        $team = $request->year;
        $description = $request->description;
        $place = $request->place;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $team_description = $request->team_description;
        $supervisor_name = $request->supervisor_name;
        $supervisor_firstname = $request->supervisor_firstname;
        $supervisor_email = $request->supervisor_email;

        $current_edition_members = Member::getMembersFormatted(Edition::getCurrentEdition()->members()->get());
        dd($current_edition_members);
        $supervisor_responsibility = $supervisor_media = $request->files->get('membre_modifier_image');
    }

    /**
     * Display the specified edition.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $edition = Edition::getEdition($id);
        if ($edition == null) {
            return self::jsend(Message::error('edition.missing'), Message::$ERROR_KEY);
        }
        return self::jsend($edition);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    /**
     * Get all the datas from the current edition.
     * @return json Json containing all the datas from the current edition and 
     * only basics infos from previous editions
     */
    public static function getDataFromCurrentEdition() {
        $currentEditionJson = Edition::getCurrentEditionJson();
        if ($currentEditionJson == null) {
            return self::jsend(Message::error('edition.current.missing'), Message::$ERROR_KEY);
        }
        $previousEditionsJson = Edition::getPreviousEditionsSimplified();
        if ($previousEditionsJson == null) {
            return self::jsend(Message::error('edition.previous.missing'), Message::$ERROR_KEY);
        }
        return self::jsend(['current_edition' => $currentEditionJson, 'previous_editions' => $previousEditionsJson]);
    }

}
