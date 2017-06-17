<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Responsibility;
use App\Models\Reward;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Edition;

class EquipeCtrl extends Controller {

<<<<<<< HEAD
class EquipeCtrl extends Controller {

=======
>>>>>>> 792c8c4c38a097dc028dd64e12ae05ff1368c028
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
<<<<<<< HEAD
        return view('equipe');
=======
        $members = Member::getMembersFormatted(Edition::getCurrentEdition()->members()->get());
        $rewards = Edition::getCurrentEdition()->rewards()->get();
        $editions = Edition::getCurrentEdition();
        $responsability = Responsibility::all();
        return view('backoffice/equipe', [
            'members' => $members,
            'rewards' => $rewards,
            'responsability' => $responsability,
            'editions' => $editions,
        ]);
>>>>>>> 792c8c4c38a097dc028dd64e12ae05ff1368c028
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
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

}
