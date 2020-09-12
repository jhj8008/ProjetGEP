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

Route::get('create_paypal_plan', 'PaypalController@create_plan');

// Welcome page controllers
Route::get('forum', 'Auth\ForumController@index')->name('forum');
Route::get('espace_élève', 'Auth\Espace_élèveController@index')->name('espace_élève');
Route::get('actualités', 'ActualitésController@index')->name('actualités');
Route::get('absences_retards', 'Auth\Absences_retardsController@index')->name('absences_retards');
Route::get('notes', 'Auth\NotesController@index')->name('notes');
Route::get('activités', 'ActivitésController@index')->name('activités');
Route::get('notifications', 'Auth\NotificationsController@index')->name('notifications');
Route::get('espace_personnel', 'Espace_personnelController@index')->name('espace_personnel');
Route::get('à_propos', 'À_proposController@index')->name('à_propos');

Route::get('contact', 'ContactController@index')->name('contact');
Route::post('contacter', 'ContactController@envoyerMessage')->name('contacter');

Route::get('elèves', function(){
    $elèves = \App\Elève::all();
    foreach($elèves as $elève){
        echo '<p>' . $elève->nom . ' fils de ' . $elève->elèveparent->nom_père.'</p>';
    }
});

// route or pages in espace_élève
Route::get('espace_élève/inscription', 'Auth\InscriptionController@index')->name('inscription');
Route::post('espace_élève/inscription', 'Auth\InscriptionController@inscrire');

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

