<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */
<<<<<<< HEAD
=======

use App\Models\Edition;
use App\Models\Member;
>>>>>>> 792c8c4c38a097dc028dd64e12ae05ff1368c028

Route::get('/', function () {
    return view("index");
});

// Webservice returning JSON data of the editions
// Used by frontend client to display datas
Route::get('/getCurrentEdition', 'EditionCtrl@getDataFromCurrentEdition');
<<<<<<< HEAD
Route::get('/getPreviousEditions', 'EditionCtrl@getDataFromPreviousEditions');

//Equipe
Route::resource('equipe', 'EquipeCtrl');

//Actualités
Route::resource('actualites', 'ActualiteCtrl');
//Sponsors
Route::resource('sponsors', 'SponsorCtrl');
//Edition précédente
Route::resource('editions', 'EditionCtrl');

Route::get('/login', 'AuthController@login');

Route::post('/auth/check', 'AuthController@check');

Route::group(['middleware' => 'MyAuth'], function () {
    Route::get('/auth/logout', 'AuthController@logout');

    Route::group(['middleware' => 'Root'], function () {
        Route::get('/admin', function () {
            return "I'm root !";
        });
    });

});

=======
Route::get('/editions/{id}', 'EditionCtrl@show');
Route::get('/hydromeladminpanel', 'AuthController@login');
Route::post('/auth/check', 'AuthController@check');

Route::group(['middleware' => ['auth']], function () {

    //Redirect
    Route::get('/auth', function () {
        return redirect('/auth/home');
    });

    //Accueil
    Route::resource('/auth/accueil', 'AccueilCtrl');

    //Edition
    Route::resource('/auth/editions', 'EditionCtrl');
    //Rank
    Route::resource('/auth/rank', 'RankCtrl');

    // Responsibility
    Route::resource('/auth/responsibility', 'ResponsibilityCtrl');

    //Equipe
    Route::resource('/auth/team', 'EquipeCtrl');

    //Member
    Route::resource('/auth/member', 'MembreCtrl');

    // Article
    Route::resource('/auth/article', 'ArticleCtrl');

    // Media
    Route::resource('/auth/media', 'MediaCtrl');

    // Reward
    Route::resource('/auth/reward', 'RewardCtrl');

    //Actualités
    Route::resource('/auth/news', 'ActualiteCtrl');

    //Sponsors
    Route::resource('/auth/sponsors', 'SponsorCtrl');

    //Editions précdènte
    Route::resource('/auth/previousedition', 'PreviousEditionCtrl');

    //Changer Edition
    Route::get('/auth/changeedition', function () {
        $edition = Edition::getCurrentEdition();
        $current_supervisor = Member::getSupervisorFromEdition($edition);
        return view("backoffice/changeedition", [
            'current_edition' => $edition,
            'current_supervisor' => $current_supervisor
        ]);
    });

    //Changer mot de passe
    Route::get('/auth/changepassword', function () {
        return view("backoffice/changepassword");
    });

    //Authentification
    Route::get('/auth/logout', 'AuthController@logout');
    Route::get('/auth/home', function() {
        return view('backoffice/hydromelpanel');
    });
}
);
>>>>>>> 792c8c4c38a097dc028dd64e12ae05ff1368c028
