<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Edition;
use App\Lib\Message;
use App\Models\Member;
use App\Models\Responsibility;
use Illuminate\Support\Facades\DB;

class EditionCtrl extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return 'ok';
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
        $year = $request->year;
        $team = $request->team;
        $description = $request->description;
        $place = $request->place;
        $start_date;
        if ($request->start_date == null) {
            $start_date = null;
        } else {
            $start_date = \Carbon\Carbon::parse($request->start_date);
        }
        $end_date;
        if ($request->end_date == null) {
            $end_date = null;
        } else {
            $end_date = \Carbon\Carbon::parse($request->end_date);
        }
        $team_description = $request->team_description;
        $supervisor['firstname'] = $request->supervisor_firstname;
        $supervisor['name'] = $request->supervisor_name;
        $supervisor['email'] = $request->supervisor_email;
        $supervisor_dataMedia = $request->files->get('supervisor_media');
        if ($supervisor_dataMedia == null) {
            return redirect('/auth/home')->with('error', 'no_media_found');
        }
        if ($year != null && $team != null && $description != null) {
            if ($supervisor['firstname'] != null && $supervisor['name'] != null && $supervisor['email'] != null) {
                if (!Edition::existsByAttributes($year, $team)) {
                    DB::beginTransaction();
                    $edition = new Edition();
                    $edition->team = $team;
                    $edition->year = $year;
                    $edition->description = $description;
                    $edition->team_description = $team_description;
                    $edition->start_date = $start_date;
                    $edition->end_date = $end_date;
                    $edition->place = $place;
                    $edition->save();
                    // create a supervisor if the old one is not used (not used means that inputs have been changed by the user)
                    // by default, the supervisor of the last edition is shown for the user. 
                    $current_edition_supervisor = Member::createMember($supervisor, 'Chercheur-Superviseur', $supervisor_dataMedia, $edition);
                    //$current_edition_supervisor = Member::getSupervisorFromEdition(Edition::getCurrentEdition());
                    DB::commit();
                    if ($current_edition_supervisor == null) {
                        DB::rollBack();
                        return redirect('/auth/home')->with('error', 'member_not_created');
                    }

                    return redirect('/auth/team')->with('success', 'edition_created');
                } else {
                    return redirect('/auth/home')->with('error', 'edition_exists');
                }
            } else {
                return redirect('/auth/home')->with('error', 'invalid_edition_input');
            }
        } else {
            return redirect('/auth/home')->with('error', 'invalid_supervisor_input');
        }
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
