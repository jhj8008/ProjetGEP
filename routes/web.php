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
    Route::get('espace_employe/espace_enseignant/notes_et_remarques/{id}/liste_notes_élève/', 'GestionNotesController@getListeNotesELève')->name('liste_notes_élève');
    Route::get('espace_employe/espace_enseignant/notes_et_remarques/{id}/page_note/{note_id}', 'GestionNotesController@getPageNote')->name('page_note_élève');
    Route::post('espace_employe/espace_enseignant/notes_et_remarques/{id}/liste_notes_élève/{note_id}/modifier_note', 'GestionNotesController@modifierNote')->name('modifier_note');

    // Gestion des bulletins des élèves
    Route::get('espace_employe/espace_enseignant/bulletins', 'GestionBulletinsController@index')->name('bulletins');
    Route::get('espace_employe/espace_enseignant/bulletins/liste_classe/{id}', 'GestionBulletinsController@getListeClasse')->name('liste_classe');
    //Route::get('espace_employe/espace_enseignant/bulletins/liste_classe/{classe_id}/page_bulletin_élève/{id}', 'GestionBulletinsController@getBulletinElève')->name('page_bulletin_élève');
    //Route::get('bulletin/{classe_id}/page_bulletin_élève/{elève_id}/générer_pdf/{nbr_retard}/{nbr_absence}/{nbr_élève}/{sum_coef}/{sum_coef_note}/{moyenne}/{date}/', 'GestionBulletinsController@generatePDF')->name('bulletin.genererBulletin');
    Route::get('bulletins/{classe_id}/page_bulletin_élève/{id}/générer_pdf/', 'GestionBulletinsController@generatePDF')->name('page_bulletin_élève');

    // Gestion des cahiers de texte
    Route::get('espace_employe/espace_enseignant/cahiers_texte', 'GestionCahierTexteController@index')->name('cahiers_texte');
    Route::get('espace_employe/espace_enseignant/cahiers_texte/{id}', 'GestionCahierTexteController@getListeClasses')->name('liste_classes_cahier');
    Route::get('espace_employe/espace_enseignant/cahiers_texte/{matId}/cahier_de_texte/{id}/', 'GestionCahierTexteController@getCahierTexte')->name('page_cahier_de_texte');
    Route::get('espace_employe/espace_enseignant/cahiers_texte/{matId}/cahier_de_texte/{classe_id}/supprimer_tache/{id}', 'GestionCahierTexteController@supprimerTache')->name('supprimer_tache_cahier');
    Route::get('espace_employe/espace_enseignant/cahiers_texte/{matId}/cahier_de_texte/{classe_id}/modifier_tache/{id}', 'GestionCahierTexteController@ouvrirTache')->name('ouvrir_tache_cahier');
    Route::post('espace_employe/espace_enseignant/cahiers_texte/{matId}/cahier_de_texte/{classe_id}/modifier_tache/{tache_id}', 'GestionCahierTexteController@modifierTache')->name('modifier_tache');
    Route::get('espace_employe/espace_enseignant/cahiers_texte/{matId}/cahier_de_texte/{classe_id}/créer_tache/', 'GestionCahierTexteController@ouvrirFormTache')->name('créer_tache_cahier');
    Route::post('espace_employe/espace_enseignant/cahiers_texte/{matId}/cahier_de_texte/{classe_id}/créer_tache/', 'GestionCahierTexteController@ajouterTache')->name('ajouter_ligne');
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
    Route::get('espace_employe/espace_personnel', 'EspacePersonnelController@index')->name('espace_personnel');
    Route::get('espace_employe/espace_personnel/liste_élèves', 'GestionInfoElèveController@index')->name('liste_élèves');
    Route::get('espace_employe/espace_personnel/liste_élèves/profile_élève/{id}', 'GestionInfoElèveController@getProfileElève')->name('profile_élève');
    Route::get('espace_employe/espace_personnel/liste_élèves/profile_élève/{id}/supprimer_profile', 'GestionInfoElèveController@supprimerProfileElève')->name('supprimer_profile');
    Route::get('espace_employe/espace_personnel/liste_élèves/profile_élève/{id}/modifier_profile_form', 'GestionInfoElèveController@getFormModification')->name('form_modification_profile');
    Route::post('espace_employe/espace_personnel/liste_élèves/profile_élève/{id}/modifier_profile_form/modifier_profile/{parent_id}', 'GestionInfoElèveController@modifierProfile')->name('modifier_profile');

    Route::get('espace_employe/espace_personnel/classes_matières', 'GestionClassesMatièresController@index')->name('classes_matières');
    Route::get('espace_employe/espace_personnel/classes_matières/gestion_classes', 'GestionClassesMatièresController@pageGestionClasses')->name('gestion_classes');
    Route::get('espace_employe/espace_personnel/classes_matières/gestion_matières', 'GestionClassesMatièresController@pageGestionMatières')->name('gestion_matières');
    Route::get('espace_employe/espace_personnel/classes_matières/gestion_classes/supprimer_classe/{id}', 'GestionClassesMatièresController@supprimerClasse')->name('supprimer_classe');
    Route::get('espace_employe/espace_personnel/classes_matières/gestion_classes/form_modifier_classe/{id}', 'GestionClassesMatièresController@pageModifierClasse')->name('form_modifier_classe');
    Route::get('espace_employe/espace_personnel/classes_matières/gestion_classes/form_ajouter_classe', 'GestionClassesMatièresController@pageAjouterClasse')->name('form_ajouter_classe');
    Route::post('espace_employe/espace_personnel/classes_matières/gestion_classes/form_modifier_classe/{id}/modifier_classe', 'GestionClassesMatièresController@modifierClasse')->name('modifier_classe');
    Route::post('espace_employe/espace_personnel/classes_matières/gestion_classes/form_ajouter_classe/ajouter_classe', 'GestionClassesMatièresController@ajouterClasse')->name('ajouter_classe');

    Route::get('espace_employe/espace_personnel/classes_matières/gestion_matières/supprimer_matière/{id}', 'GestionClassesMatièresController@supprimerMatière')->name('supprimer_matière');
    Route::get('espace_employe/espace_personnel/classes_matières/gestion_matières/form_modifier_matière/{id}', 'GestionClassesMatièresController@pageModifierMatière')->name('form_modifier_matière');
    Route::get('espace_employe/espace_personnel/classes_matières/gestion_matières/form_ajouter_matière', 'GestionClassesMatièresController@pageAjouterMatière')->name('form_ajouter_matière');
    Route::post('espace_employe/espace_personnel/classes_matières/gestion_matières/form_modifier_matière/{id}/modifier_matière', 'GestionClassesMatièresController@modifierMatière')->name('modifier_matière');
    Route::post('espace_employe/espace_personnel/classes_matières/gestion_matières/form_ajouter_matière/ajouter_matière', 'GestionClassesMatièresController@ajouterMatière')->name('ajouter_matière');

    Route::get('espace_employe/espace_personnel/fiches_personnelles', 'GestionFichesPersonnellesController@index')->name('fiches_personnelles');
    Route::get('espace_employe/espace_personnel/fiches_personnelles/voir_fiche_personnelle/{id}', 'GestionFichesPersonnellesController@getFichePersonnelle')->name('voir_fiche_personnelle');
});

Route::get('my_page', function(){
    /*\App\Cahier_texte::create([
        'date_publication' => date('Y-m-d'),
        'a_faire' => 'Exo 10 et 11 page 30 du manuel',
        'fait' => 'Chapitre 7',
        'cours' => 'Participe présent',
        'niveau_scolaire' => 'CP1',
        'employe_id' => 3,
        'classe_id' => 3,
        'matière_id' => 1,
    ]);*/
    \App\Fiche_personnelle::create([
        'nationalité' => 'Marocaine',
        'num_carte_sejour' => '147855369', 
        'num_carte_travail' => '874599321', 
        'situation_familiale' => 'Marié', 
        'num_sécurité_sociale' => '661250250', 
        'code_postale' => '40000', 
        'ville' => 'Marrakech', 
        'qualification' => 'Diplôme master en liérature française', 
        'contrat' => 'CDD', 
        'durée' => '4 mois', 
        'salaire_mensuel' => '7800', 
        'date_entrée' => date('Y-m-d',strtotime('2016-09-02')), 
        'date_sortie' => date('Y-m-d',strtotime('2021-08-22')), 
        'situation_avant_enbauche' => 'Étudiant', 
        'employe_id' => 3,
    ]);

    echo '<h2>Fiche personnelle ajouté avec succès 2</h2>';
});

/*


achraf -> 8
ali -> 9
maria -> 18 
Sara -> 12
youssef -> 13
*/

/*Route::get('my_page', function(){
    $enseignant = \App\Employe::find(3);
    //$enseignant->matières()->attach(3);
    //echo '<h2>Matière Attachement succeeded 3</h2>';
    echo '<h1>Les matières prises par prof. ' . $enseignant->nom . ' sont: </h1>';
    foreach($enseignant->matières as $m){
        echo '<h2>' . $m->nom . '</h2>';
    }
});*/
