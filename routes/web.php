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

    // Gestion des absences et retards des élèves
    Route::get('espace_employe/espace_enseignant/absences_retards', 'AbsencesRetardsElèveController@index')->name('absences_retards');
    Route::get('espace_employe/espace_enseignant/absences_retards/liste_absence/{classe_id}', 'AbsencesRetardsElèveController@getList')->name('liste_absence');
    Route::get('espace_employe/espace_enseignant/absences_retards/liste_absence/{classe_id}/profile_absence/{id}', 'AbsencesRetardsElèveController@getProfile')->name('profile_absence');
    Route::get('espace_employe/espace_enseignant/absences_retards/liste_absence/{classe_id}/profile_absence/{élève_id}/ouvrir_negligence/{id}', 'AbsencesRetardsElèveController@ouvrirNegligence')->name('ouvrir_negligence');
    Route::post('espace_employe/espace_enseignant/absences_retards/liste_absence/{classe_id}/profile_absence/{élève_id}/ouvrir_negligence/modifier_negligence/{id}', 'AbsencesRetardsElèveController@modifierNegligence')->name('modifier_negligence');
    Route::get('espace_employe/espace_enseignant/absences_retards/liste_absence/{classe_id}/profile_absence/{élève_id}/ouvrir_negligence/supprimer_negligence/{id}', 'AbsencesRetardsElèveController@supprimerNegligence')->name('supprimer_negligence');
    Route::get('espace_employe/espace_enseignant/absences_retards/liste_absence/{classe_id}/profile_absence/{id}/formulaire_negligence/', 'AbsencesRetardsElèveController@PageAjouterNegligence')->name('ajouter_negligence');
    Route::post('espace_employe/espace_enseignant/absences_retards/liste_absence/{classe_id}/profile_absence/{élève_id}/formulaire_negligence/ajouter_negligence/', 'AbsencesRetardsElèveController@ajouterNegligence')->name('créer_negligence');

    // Gestion des notes des élèves
    Route::get('espace_employe/espace_enseignant/notes_et_remarques', 'GestionNotesController@index')->name('notes_et_remarques');

    // Gestion des bulletins des élèves
    Route::get('espace_employe/espace_enseignant/bulletins', 'GestionBulletinsController@index')->name('bulletins');

    // Gestion des cahiers de texte
    Route::get('espace_employe/espace_enseignant/cahiers_texte', 'GestionCahierDeTexteController@index')->name('cahiers_texte');
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

Route::get('my_page', function(){
    echo '<h1>Variable needed: ' . url()->full() . '</h1>';
    //echo '<h1>Lien de la page: ' . url()->previous() . '</h1>';
});

/*


achraf -> 8
ali -> 9
maria -> 18 
Sara -> 12
youssef -> 13

Route::get('my_page', function(){
    \App\Negligence::create([
        'date' => date('Y-m-d',strtotime('2012-09-23')),
        'durée' => '00:15',
        'raison' => 'Inconnu',
        'période' => 'matin',
        'type' => 'Retard',
        'employe_id' => 3,
        'elève_id' => 13,
        'matière_id' => 1,
    ]);

    echo "<h1>Retard ajouté avec succès 2</h1>";
});*/

/*Route::get('my_page', function(){
    $enseignant = \App\Employe::find(3);
    //$enseignant->classes()->attach(4);
    //echo '<h2>Attachement succeeded 4</h2>';
    echo '<h1>Les classes prises par prof. ' . $enseignant->nom . ' sont: </h1>';
    foreach($enseignant->classes as $c){
        echo '<h2>' . $c->nom_classe . '</h2>';
    }
});*/
