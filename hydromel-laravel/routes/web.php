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
    return 'welcome';
});

<<<<<<< HEAD
Route::get('adminhydromelpanel', function () {
    return view("backoffice/hydromelpanel");
});

Route::get('adminhydromelpanel/accueil', function () {
    return view("backoffice/accueil");
});

Route::get('adminhydromelpanel/equipe', function () {
    return view("backoffice/equipe");
});

Route::get('adminhydromelpanel/actualite', function () {
    return view("backoffice/actualite");
});

Route::get('adminhydromelpanel/sponsor', function () {
    return view("backoffice/sponsor");
});

Route::get('adminhydromelpanel/previousedition', function () {
    return view("backoffice/editionP");
});

Route::get('adminhydromelpanel/changeedition', function () {
    return view("backoffice/newedition/accueil");
});

//AJOUTER MIDDLEWARE
=======
// Webservice returning JSON data of the editions
// Used by frontend client to display datas
Route::get('/getCurrentEdition', 'EditionCtrl@getDataFromCurrentEdition');
Route::get('/editions/{id}', 'EditionCtrl@show');
Route::get('/hydromeladminpanel', 'AuthController@login');
Route::post('/auth/check', 'AuthController@check');

Route::group(['middleware' => ['auth']], function () {

    //Equipe
    Route::resource('/auth/equipes', 'EquipeCtrl');

    //Actualités
    Route::resource('/auth/actualites', 'ActualiteCtrl');

    //Sponsors
    Route::resource('/auth/sponsors', 'SponsorCtrl');

    //Editions
    Route::resource('/auth/editions', 'EditionCtrl');

    //Authentification
    Route::get('/auth/logout', 'AuthController@logout');
    Route::get('/auth/home', function() {
        return "home";
    });

    // Backoffice routes
    Route::get('/auth/news', function() {
        return "news";
    });

    Route::get('/auth/sponsors', function() {
        return "sponsors";
    });

    Route::get('/auth/previouseditions', function() {
        return "previouseditions";
    });
}
);






>>>>>>> Back
