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

// 
Route::get('/getCurrentEdition', 'EditionCtrl@getDataFromCurrentEdition');

//Equipe
Route::resource('equipe', 'EquipeCtrl');
//Actualités
Route::resource('actualites', 'ActualiteCtrl');
//Sponsors
Route::resource('sponsors', 'SponsorCtrl');
//Edition précédente
Route::resource('editionprecedente', 'EditionPrecedenteCtrl');

//Authentification
Route::get('/admin', 'AuthController@login');
Route::post('/auth/check', 'AuthController@check');
Route::get('/logout', 'AuthController@login');