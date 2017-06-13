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
    
});

// Webservice returning JSON data of the editions
// Used by frontend client to display datas
Route::get('/getCurrentEdition', 'EditionCtrl@getDataFromCurrentEdition');
Route::get('/msg', function() {
    return App\Http\Controllers\Controller::jsend(\App\Lib\Message::error('article.missing'), 'error');
});

//Equipe
Route::resource('equipe', 'EquipeCtrl');

//Actualités
Route::resource('actualites', 'ActualiteCtrl');
//Sponsors
Route::resource('sponsors', 'SponsorCtrl');

//Editions
Route::resource('editions', 'EditionCtrl');

//Authentification
Route::get('/hydromeladminpanel', 'AuthController@login');
Route::post('/auth/check', 'AuthController@check');
Route::get('/logout', 'AuthController@login');
