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

