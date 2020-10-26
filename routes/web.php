<?php

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

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

Route::get('send-notification', 'NotificationController@sendOfferNotification')->name('send_notif');

// Welcome page controllers
Route::name('parents.')->group(function(){
    Route::get('forum', 'Auth\ForumController@index')->name('forum');
    Route::get('forum/get_posts/', 'Auth\ForumController@getPosts')->name('getPosts');
    Route::get('forum/post_thread/{id}', 'Auth\ForumController@getPostThread')->name('post_thread');
    Route::post('forum/post_thread/{id}/ajouter_commentaire', 'Auth\ForumController@ajouterCommentaire')->name('ajouter_commentaire');
    Route::get('forum/form_ajouter_post', 'Auth\ForumController@pageAjouterPost')->name('form_ajouter_post');
    Route::post('forum/ajouter_post', 'Auth\ForumController@ajouterPost')->name('ajouter_post');
    Route::get('espace_élève', 'Auth\Espace_élèveController@index')->name('espace_élève');    
    Route::get('absences_retards', 'Auth\Absences_retardsController@index')->name('absences_retards');
    Route::get('absence_retards/liste_negligences/{id}', 'Auth\Absences_retardsController@getNegligences')->name('get_negligences');
    Route::get('notes', 'Auth\NotesController@index')->name('notes');
    Route::get('notes/get_notes/{id}', 'Auth\NotesController@getNotes')->name('get_notes');
    /*Route::get('notifications', 'Auth\NotificationsController@index')->name('notifications');*/
    Route::get('espace_élève/cahiers_de_texte', 'Auth\CahiersTexteController@index')->name('cahiers_de_texte');
    Route::get('espace_élève/cahiers_de_texte/matières_élève/{id}/cahier_texte/', 'Auth\CahiersTexteController@getCahierTexte')->name('cahier_texte');
    Route::get('espace_élève/emplois_du_temps', 'Auth\EmploiTempsController@index')->name('emplois_du_temps');
    Route::get('espace_élève/emplois_du_temps/{id}', 'Auth\EmploiTempsController@getEmploiTemps')->name('emploi_temps');
    Route::get('espace_élève/emplois_du_temps/{id}/séances_jour/{jour}', 'Auth\EmploiTempsController@getSéances')->name('séances');
    Route::get('espace_élève/liste_élèves', 'ListeElèveController@index')->name('liste_élèves');
    Route::get('espace_élève/inscription', 'Auth\InscriptionController@index')->name('inscription');
    Route::post('espace_élève/inscription', 'Auth\InscriptionController@inscrire');
});

Route::name('clients.')->group(function(){
    Route::get('actualités', 'ActualitésController@index')->name('actualités');
    Route::get('actualités/{type}', 'ActualitésController@getAllArticles')->name('liste_actualités');
    Route::get('actualités/{type}/article/{id}', 'ActualitésController@getArticleDetails')->name('actualité_details');
    Route::get('activités', 'ActivitésController@index')->name('activités');
    Route::get('activités/{type}', 'ActivitésController@getAllArticles')->name('liste_activités');
    Route::get('activités/{type}/activité/{id}', 'ActivitésController@getArticleDetails')->name('activité_details');
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
    Route::post('ajouter_negligence/{classe_id}/profile_absence/{id}/', 'AbsencesRetardsElèveController@ajouterNegligence')->name('créer_negligence');

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
    Route::get('espace_employe/gestion_personnel', 'GestionComptePersonnelController@index')->name('gestion_personnel');
    Route::get('espace_employe/boite_reception', 'BoiteReceptionController@index')->name('boite_reception');
    Route::get('espace_employe/boite_reception/voir_message/{id}', 'BoiteReceptionController@getMessage')->name('voir_message');
    Route::get('espace_employe/boite_reception/supprimer_message/{id}', 'BoiteReceptionController@supprimerMessage')->name('supprimer_message');
    Route::post('espace_employe/boite_reception/envoyer_message', 'BoiteReceptionController@mail')->name('envoyer_email');
    Route::get('espace_employe/boite_reception/nouveau_email', 'BoiteReceptionController@getPageNouveauEmail')->name('nouveau_email');
    Route::get('espace_employe/gestion_personnel/comptes_personnels', 'GestionComptePersonnelController@getListePersonnels')->name('comptes_personnels');
    Route::get('espace_employe/gestion_personnel/comptes_personnels/form_ajouter_personnel', 'GestionComptePersonnelController@pageFormAjouterPersonnel')->name('form_ajouter_personnel');
    Route::get('espace_employe/gestion_personnel/comptes_personnels/form_modifier_personnel/{id}/', 'GestionComptePersonnelController@pageFormModifierPersonnel')->name('form_modifier_personnel');
    Route::post('espace_employe/gestion_personnel/comptes_personnels/form_ajouter_personnel/ajouter_personnel', 'GestionComptePersonnelController@ajouterPersonnel')->name('ajouter_personnel');
    Route::get('espace_employe/gestion_personnel/comptes_personnels/supprimer_personnel/{id}', 'GestionComptePersonnelController@supprimerPersonnel')->name('supprimer_personnel');
    Route::post('espace_employe/gestion_personnel/comptes_personnels/form_modifier_personnel/modifier_personnel/{id}', 'GestionComptePersonnelController@modifierPersonnel')->name('modifier_personnel');

    Route::get('espace_employe/gestion_personnel/gestion_fiches_personnelles', 'GestionFichePersonnelleController@index')->name('gestion_fiches_personnelles');
    Route::get('espace_employe/gestion_personnel/gestion_fiches_personnelles/fiche_personnelle/{id}', 'GestionFichePersonnelleController@getFichePersonnelle')->name('voir_fiche_personnelle');
    Route::get('espace_employe/gestion_personnel/gestion_fiches_personnelles/fiche_personnelle/{id}/form_modifier_fiche/', 'GestionFichePersonnelleController@getFormModifierFiche')->name('form_modifier_fiche');
    Route::post('espace_employe/gestion_personnel/gestion_fiches_personnelles/fiche_personnelle/{id}/form_modifier_fiche/modifier_fiche', 'GestionFichePersonnelleController@modifierFiche')->name('modifier_fiche');

    Route::get('espace_employe/espace_admin/gestion_admin', 'GestionCompteAdminController@index')->name('gestion_admin');
    Route::get('espace_employe/espace_admin/gestion_admin/comptes_admins', 'GestionCompteAdminController@getListeAdmins')->name('comptes_admins');
    Route::get('espace_employe/espace_admin/gestion_admin/gestion_fiches_admins', 'GestionCompteAdminController@getFichesAdmins')->name('gestion_fiches_admins');
    Route::get('espace_employe/espace_admin/gestion_admin/form_ajouter_admin', 'GestionCompteAdminController@getPageAjouterAdmin')->name('form_ajouter_admin');
    Route::get('espace_employe/espace_admin/gestion_admin/form_modifier_admin/{id}', 'GestionCompteAdminController@getPageModifierAdmin')->name('form_modifier_admin');
    Route::post('espace_employe/espace_admin/gestion_admin/form_ajouter_admin/ajouter_admin', 'GestionCompteAdminController@ajouterAdmin')->name('ajouter_admin');
    Route::post('espace_employe/espace_admin/gestion_admin/form_modifier_admin/{id}/modifier_admin', 'GestionCompteAdminController@modifierAdmin')->name('modifier_admin');
    Route::get('espace_employe/espace_admin/gestion_admin/supprimer_admin/{id}', 'GestionCompteAdminController@supprimerAdmin')->name('supprimer_admin');

    Route::get('espace_employe/espace_admin/gestion_fiches_admins', 'GestionCompteAdminController@getFichesAdmin')->name('gestion_fiches_admins');
    Route::get('espace_employe/espace_admin/gestion_fiches_admins/voir_fiche_admin/{id}', 'GestionCompteAdminController@getFichePersonnelle')->name('voir_fiche_admin');
    Route::get('espace_employe/espace_admin/gestion_fiches_admins/voir_fiche_admin/{id}/form_modifier_fiche_admin/', 'GestionCompteAdminController@pageModifierFicheAdmin')->name('form_modifier_fiche_admin');
    Route::post('espace_employe/espace_admin/gestion_fiches_admins/voir_fiche_admin/{id}/form_modifier_fiche_admin/modifier_fiche_admin', 'GestionCompteAdminController@modifier_fiche')->name('modifier_fiche_admin');
});

Route::name('employés.')->group(function(){
    //Route::get('espace_personnel', 'Espace_personnelController@index')->name('espace_personnel')->middleware('employe');
    Route::get('espace_employe', 'EspaceEmployeController@index')->name('espace_employe');
    Route::get('loginEmploye', 'Auth\LoginEmployeController@index')->name('loginEmploye');
    Route::post('login_employe', 'Auth\LoginEmployeController@login')->name('login_employe');
    Route::get('fiche_personnelle', 'EspaceEmployeController@getFichePersonnelle')->name('get_fiche_personnelle');
    Route::get('espace_employe/forum_employe', 'EspaceEmployeController@getPageForum')->name('forum_employe');
    Route::get('get_posts/', 'PostController@getPosts')->name('get_posts');

    Route::get('forum_thread/{id}', 'PostController@getPostThread')->name('forum_thread');
    Route::post('forum_thread/{id}/ajouter_commentaire/', 'PostController@ajouterCommentEmploye')->name('ajouter_commentaire');

    Route::get('liste_sondages', 'VoteController@index')->name('liste_sondages');

    Route::get('/polls/{id}', 'VoteController@candidates')->name('polls');
    Route::post('/candidates/{candidate}', 'VoteController@incrementVotes')->name('inscrement_vote');

    Route::get('forum/liste_sondages/form_ajouter_sondage', 'VoteController@pageFormAjouterSondage')->name('form_ajouter_sondage');
    Route::post('forum/liste_sondages/form_ajouter_sondage/ajouter_sondage', 'VoteController@ajouterSondage')->name('ajouter_sondage');

    Route::get('espace_employe/forum/page_ajouter_post/', 'PostController@pageAjouterPost')->name('page_ajouter_post');
    Route::post('post/ajouter_post', 'PostController@ajouterPost')->name('ajouter_post');
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
    Route::get('espace_employe/espace_personnel/fiches_personnelles/voir_fiche_personnelle/{id}/form_modifier_fiche', 'GestionFichesPersonnellesController@pageFormModifierFiche')->name('form_modifier_fiche');
    Route::get('espace_employe/espace_personnel/fiches_personnelles/voir_fiche_personnelle/{id}/supprimer_fiche', 'GestionFichesPersonnellesController@supprimerFiche')->name('supprimer_fiche');
    Route::post('espace_employe/espace_personnel/fiches_personnelles/voir_fiche_personnelle/{id}/form_modifier_fiche/modifier_fiche', 'GestionFichesPersonnellesController@modifierFiche')->name('modifier_fiche');

    Route::get('espace_employe/espace_personnel/gestion_emplois_du_temps', 'GestionEmploisDuTempsController@index')->name('gestion_emplois_du_temps');
    Route::get('espace_employe/espace_personnel/gestion_emplois_du_temps/{id}/jours', 'GestionEmploisDuTempsController@getEmploiDuTemp')->name('emploi_du_temps');
    Route::get('espace_employe/espace_personnel/gestion_emplois_du_temps/{id}/jours/{jour}/séances_jour', 'GestionEmploisDuTempsController@getSéanceJour')->name('séances_jour');
    Route::get('espace_employe/espace_personnel/gestion_emplois_du_temps/{edt_id}/jours/{jour}/supprimer_séance/{id}', 'GestionEmploisDuTempsController@supprimerSéance')->name('supprimer_séance');
    Route::get('espace_employe/espace_personnel/gestion_emplois_du_temps/{edt_id}/jours/{jour}/form_modifier_séance/{id}', 'GestionEmploisDuTempsController@pageModifierSéance')->name('form_modifier_séance');
    Route::get('espace_employe/espace_personnel/gestion_emplois_du_temps/{id}/jours/{jour}/form_ajouter_séance', 'GestionEmploisDuTempsController@pageAjouterSéance')->name('form_ajouter_séance');

    Route::post('espace_employe/espace_personnel/gestion_emplois_du_temps/{edt_id}/jours/{jour}/modifier_séance/{id}', 'GestionEmploisDuTempsController@modifierSéance')->name('modifier_séance');
    Route::post('espace_employe/espace_personnel/gestion_emplois_du_temps/{id}/jours/{jour}/ajouter_séance', 'GestionEmploisDuTempsController@ajouterSéance')->name('ajouter_séance');
    Route::post('get_matières/', 'GestionEmploisDuTempsController@getMatières')->name('get_matières');

    // gestion des actualités et activités
    Route::get('espace_employe/espace_personnel/gestion_actualités_activités', 'GestionActualitésActivitésController@index')->name('gestion_actualités_activités');
    Route::get('espace_employe/espace_personnel/gestion_actualités_activités/form_créer_article', 'GestionActualitésActivitésController@pageCréerArticle')->name('form_créer_article');
    Route::post('espace_employe/espace_personnel/gestion_actualités_activités/form_créer_article/créer_article', 'GestionActualitésActivitésController@créerArticle')->name('créer_article');
    Route::get('espace_employe/espace_personnel/gestion_actualités_activités/supprimer_article/{id}', 'GestionActualitésActivitésController@supprimerArticle')->name('supprimer_article');
    Route::get('espace_employe/espace_personnel/gestion_actualités_activités/page_article/{id}', 'GestionActualitésActivitésController@getArticle')->name('page_article');

    Route::get('espace_employe/espace_personnel/gestion_actualités_activités/form_modifier_article/{id}', 'GestionActualitésActivitésController@pageModifierArticle')->name('form_modifier_article');
    Route::post('espace_employe/espace_personnel/gestion_actualités_activités/form_modifier_article/{id}/modifier_article', 'GestionActualitésActivitésController@modifierArticle')->name('modifier_article');

    // gestion des compts enseignants
    Route::get('espace_employe/espace_personnel/gestion_enseignants', 'GestionEnseignantsController@index')->name('gestion_enseignants');
    Route::get('espace_employe/espace_personnel/gestion_enseignants/comptes_enseignants', 'GestionEnseignantsController@getEnseignants')->name('comptes_enseignants');
    Route::get('espace_employe/espace_personnel/gestion_enseignants/comptes_enseignants/form_créer_enseignant', 'GestionEnseignantsController@pageFormAjouterEnseignant')->name('form_ajouter_enseignant');
    Route::get('espace_employe/espace_personnel/gestion_enseignants/comptes_enseignants/supprimer_enseignant/{id}/', 'GestionEnseignantsController@supprimerEnseignant')->name('supprimer_enseignant');
    Route::get('espace_employe/espace_personnel/gestion_enseignants/comptes_enseignants/form_modifier_enseignant/{id}/', 'GestionEnseignantsController@pageFormModifierEnseignant')->name('form_modifier_enseignant');
    Route::post('espace_employe/espace_personnel/gestion_enseignants/comptes_enseignants/form_créer_enseignant/créer_enseignant', 'GestionEnseignantsController@créerEnseignant')->name('créer_enseignant');
    Route::post('espace_employe/espace_personnel/gestion_enseignants/comptes_enseignants/form_modifier_enseignant/{id}/modifier_enseignant', 'GestionEnseignantsController@modifierEnseignant')->name('modifier_enseignant');

    // affectation des classes aux enseignants
    Route::get('espace_employe/espace_personnel/gestion_enseignants/affectation_des_classes/', 'GestionEnseignantsController@pageAffectationClasses')->name('page_affectation_classes');
    Route::get('espace_employe/espace_personnel/gestion_enseignants/affectation_des_classes/liste_classes_affecter/{id}', 'GestionEnseignantsController@getListeClasses')->name('liste_classes_affecter');
    Route::get('espace_employe/espace_personnel/gestion_enseignants/affectation_des_classes/liste_classes_affecter/{ensg_id}/supprimer_classe/{id}', 'GestionEnseignantsController@supprimerClasse')->name('supprimer_classe_enseignant');
    Route::post('espace_employe/espace_personnel/gestion_enseignants/affectation_des_classes/liste_classes_affecter/{ensg_id}/ajouter_classe/', 'GestionEnseignantsController@ajouterClasseEnseignant')->name('ajouter_classe');
    
    // affectation des matières aux enseignants
    Route::get('espace_employe/espace_personnel/gestion_enseignants/affectation_des_matières/', 'GestionEnseignantsController@pageAffectationMatières')->name('page_affectation_matières');
    Route::get('espace_employe/espace_personnel/gestion_enseignants/affectation_des_matières/liste_matières_affecter/{id}', 'GestionEnseignantsController@getListeMatières')->name('liste_matières_affecter');
    Route::get('espace_employe/espace_personnel/gestion_enseignants/affectation_des_matières/liste_matières_affecter/{ensg_id}/supprimer_matière/{id}', 'GestionEnseignantsController@supprimerMatière')->name('supprimer_matière_enseignant');
    Route::post('espace_employe/espace_personnel/gestion_enseignants/affectation_des_matières/liste_matières_affecter/{ensg_id}/ajouter_matière/', 'GestionEnseignantsController@ajouterMatièreEnseignant')->name('ajouter_matière');

    Route::get('espace_employe/espace_personnel/gestion_enseignants/gestion_negligences_enseignant', 'NegligencesEmployeController@getListeEnseignants')->name('gestion_negligences_enseignant');
    Route::get('espace_employe/espace_personnel/gestion_enseignants/gestion_negligences_enseignant/liste_negligences/{id}', 'NegligencesEmployeController@getListeNegligencesEnseignant')->name('liste_negligences');
    Route::get('espace_employe/espace_personnel/gestion_enseignants/gestion_negligences_enseignant/liste_negligences/{ensg_id}/form_modifier_negligence/{id}', 'NegligencesEmployeController@pageFormModifierNegligence')->name('form_modifier_negligence');
    Route::post('espace_employe/espace_personnel/gestion_enseignants/gestion_negligences_enseignant/liste_negligences/{ensg_id}/form_modifier_negligence/{id}/modifier_negligence', 'NegligencesEmployeController@modifierNegligence')->name('modifier_negligence');
    Route::get('espace_employe/espace_personnel/gestion_enseignants/gestion_negligences_enseignant/liste_negligences/{ensg_id}/supprimer_negligence/{id}', 'NegligencesEmployeController@supprimerNegligence')->name('supprimer_negligence');
    Route::get('espace_employe/espace_personnel/gestion_enseignants/gestion_negligences_enseignant/liste_negligences/{ensg_id}/form_ajouter_negligence', 'NegligencesEmployeController@pageFormAjouterNegligence')->name('form_ajouter_negligence');
    Route::post('espace_employe/espace_personnel/gestion_enseignants/gestion_negligences_enseignant/liste_negligences/{ensg_id}/form_ajouter_negligence/ajouter_negligence', 'NegligencesEmployeController@ajouterNegligence')->name('ajouter_negligence');
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
    /*\App\Fiche_personnelle::create([
        'nationalité' => 'Marocaine',
        'num_carte_sejour' => '207855369', 
        'num_carte_travail' => '874599318', 
        'situation_familiale' => 'Marié', 
        'num_sécurité_sociale' => '661250244', 
        'code_postale' => '40410', 
        'ville' => 'Marrakech', 
        'qualification' => 'Diplôme master en science pédagogiques', 
        'contrat' => 'CDD', 
        'durée' => '5 mois', 
        'salaire_mensuel' => '9800', 
        'date_entrée' => date('Y-m-d',strtotime('2015-09-02')), 
        'date_sortie' => date('Y-m-d',strtotime('2020-09-02')), 
        'situation_avant_enbauche' => 'Étudiant', 
        'employe_id' => 1,
    ]);*/

    /*\App\Comment::create([
        'description' => "Je pense que c'est lundi prochain, inchallah",
        'post_id' => 1,
        'employe_id' => 2,
        'elèveparent_id' => 0, 
    ]);

    echo '<h1>Comment created 1</h1>';*/
    echo '<h2>espace employé link:</h2><p>' . url('/absences_retards') . '</p>';
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
