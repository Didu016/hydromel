<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Edition;
use App\Lib\Message;

class EditionCtrl extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
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
        //
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

<<<<<<< HEAD
=======
    /**
     * Get all the datas from the current edition.
     * @return json Json containing all the datas from the current edition and 
     * only basics infos from previous editions
     */
>>>>>>> 8087fe02f4a9cd9cd1e609726b6ca2a0d5ca3f29
    public static function getDataFromCurrentEdition() {
        $currentEditionJson = Edition::getCurrentEdition();
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
