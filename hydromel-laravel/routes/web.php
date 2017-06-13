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
<<<<<<< HEAD
Route::get('/logout', 'AuthController@login');

//BackOffice
    //Accueil
   /* Route::get('/admin/backoffice', function(){
        return view("backoffice");
    });*/
    //Modification de l'accueil du site
Route::post('/admin/accueil', 'AccueilCtrl@update');
Route::get('/admin/accueil', function(){
   return view("formulaireAccueil");
});

Route::post('/admin/ModifierMembre', 'MembreCtrl@store');
Route::get('/admin/ModifierMembre', function(){
    return view("formulaireModifierMembreTest");
});

Route::post('/admin/ModifierPreviousEdition', 'PreviousEditionCtrl@update');
Route::get('/admin/ModifierPreviousEdition', function(){
    return view("formulaireModifierPreviousEdition");
});

Route::post('/admin/ModifierArticle', 'ArticleCtrl@update');
Route::get('/admin/ModifierArticle', function(){
    return view("formulaireModifierArticleTest");
});

   /* //Modification de la page équipe du site
    Route::post('/admin/equipe', 'ctrl@qqch');
    //Modification de la page sponsors du site
    Route::post('/admin/sponsors', 'ctrl@qqch');
    //Modification des pages éditions précédentes du site
    Route::post('/admin/editionPrecedente', 'ctrl@qqch');*/

=======

Route::group(['middleware' => ['auth']], function () {

    //Redirect
    Route::get('/auth', function () {
        return redirect('/auth/home');
    });

    //Accueil
    Route::resource('/auth/accueil', 'EditionCtrl');

    //Equipe
    Route::resource('/auth/team', 'EquipeCtrl');

    //Actualités
    Route::resource('/auth/news', 'ActualiteCtrl');

    //Sponsors
    Route::resource('/auth/sponsors', 'SponsorCtrl');

    //Editions précdènte
    Route::get('/auth/previousedition', function () {
        return view("backoffice/editionP");
    });

    //Changer Edition
    Route::get('/auth/changeedition/home', function () {
        return view("backoffice/newedition/accueil");
    });

    //Changer Edition
    Route::get('/auth/changeedition/team', function () {
        return view("backoffice/newedition/equipe");
    });

    //Authentification
    Route::get('/auth/logout', 'AuthController@logout');
    Route::get('/auth/home', function() {
        return view('backoffice/hydromelpanel');
    });
}
);
>>>>>>> 8087fe02f4a9cd9cd1e609726b6ca2a0d5ca3f29
