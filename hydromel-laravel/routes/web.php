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

Route::get('/', function () {
    return view("index");
});

// Webservice returning JSON data of the editions
// Used by frontend client to display datas
Route::get('/getCurrentEdition', 'EditionCtrl@getDataFromCurrentEdition');
Route::get('/editions/{id}', 'EditionCtrl@show');
Route::get('/hydromeladminpanel', 'AuthController@login');
Route::post('/auth/check', 'AuthController@check');
Route::resource('/auth/editions', 'EditionCtrl');

Route::group(['middleware' => ['auth']], function () {

    //Redirect
    Route::get('/auth', function () {
        return redirect('/auth/home');
    });

    //Accueil
    Route::resource('/auth/accueil', 'AccueilCtrl');
    
    //Edition
    
    
    //Equipe
    Route::resource('/auth/team', 'EquipeCtrl');

    Route::resource('/auth/member', 'MembreCtrl');

    Route::resource('/auth/article', 'ArticleCtrl');

    //Actualités
    Route::resource('/auth/news', 'ActualiteCtrl');

    //Sponsors
    Route::resource('/auth/sponsors', 'SponsorCtrl');

    //Editions précdènte
    Route::get('/auth/previousedition', function () {
        return view("backoffice/editionP");
    });

    //Changer Edition
    Route::get('/auth/changeedition', function () {
        return view("backoffice/changeedition");
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
