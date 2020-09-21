<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin', function(){
    echo 'You are an Admin';
})->middleware('admin');

// Welcome page controllers
Route::name('parents.')->group(function(){
    Route::get('forum', 'Auth\ForumController@index')->name('forum');
    Route::get('espace_élève', 'Auth\Espace_élèveController@index')->name('espace_élève');    
    Route::get('absences_retards', 'Auth\Absences_retardsController@index')->name('absences_retards');
    Route::get('notes', 'Auth\NotesController@index')->name('notes');
    Route::get('notifications', 'Auth\NotificationsController@index')->name('notifications');
    Route::get('espace_élève/bulletins', function(){
        return view('bulletins');
    })->name('bulletins');
    Route::get('espace_élève/cahiers_de_texte', function(){
        return view('cahiers_de_texte');
    })->name('cahiers_de_texte');
    Route::get('espace_élève/emplois_du_temps', function(){
        return view('emplois_du_temps');
    })->name('emplois_du_temps');
    Route::get('espace_élève/liste_élèves', 'ListeElèveController@index')->name('liste_élèves');
    Route::get('espace_élève/inscription', 'Auth\InscriptionController@index')->name('inscription');
    Route::post('espace_élève/inscription', 'Auth\InscriptionController@inscrire');
});

Route::name('clients.')->group(function(){
    Route::get('actualités', 'ActualitésController@index')->name('actualités');
    Route::get('activités', 'ActivitésController@index')->name('activités');
    Route::get('à_propos', 'À_proposController@index')->name('à_propos');
    Route::get('contact', 'ContactController@index')->name('contact');
    Route::post('contacter', 'ContactController@envoyerMessage')->name('contacter');
});

Route::name('enseignants.')->group(function(){
    Route::get('espace_employe/espace_enseignant', 'EspaceEnseignantController@index')->name('espace_enseignant');
});

Route::name('admins.')->group(function(){
    Route::get('espace_employe/espace_admin', 'EspaceAdminController@index')->name('espace_admin');
});

Route::name('employés.')->group(function(){
    //Route::get('espace_personnel', 'Espace_personnelController@index')->name('espace_personnel')->middleware('employe');
    Route::get('espace_employe', 'EspaceEmployeController@index')->name('espace_employe');
    Route::get('loginEmploye', 'Auth\LoginEmployeController@index')->name('loginEmploye');
    Route::post('login_employe', 'Auth\LoginEmployeController@login')->name('login_employe');
});

Route::name('personnels.')->group(function(){
    Route::get('espace_personnel', 'Espace_personnelController@index')->name('espace_personnel')->middleware('employe');
});
