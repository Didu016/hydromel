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