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

Route::get('/tableau-de-bord',[
    'as'=>'home',
    'uses'=>'BasesController@index',
]);

Route::get('/gestion-planning/pdf/{id}','BasesController@pdf')->name('planning.vaccation.pdf');

Route::get('/gestion-planning/vacation/{status}',[
    'as'=>'vacation-info',
    'uses'=>'BasesController@vacation',
]);
Route::get('/','Auth\LoginController@showLoginForm');

//jour fériés
Route::get('/tableau-de-bord/jour-feries/', 'JourFerieController@index')->name('jour-feries');
Route::get('/test-code/heures-minutes/', 'TestCodeController@index')->name('testcode.heure');
Route::resource('jourferies', 'JourFerieController');

//gestion agent
Route::get('gestion-des-agents/liste-des-plannings', 'GestionAgentController@index')->name('liste-planning-agent');
Route::get('gestion-des-sites/liste-des-agents', 'GestionSiteController@index')->name('liste-site-agent');
Route::resource('gestionagent', 'GestionAgentController');

//gestion site
Route::resource('gestionsite', 'GestionSiteController');
Route::get('gestion-des-sites/liste-des-agents/pdfs{id}', 'GestionSiteController@pdf')->name('agents.pdf.test');

//planning provisoire
//Route::get('gestion-des-plannings/planning-provisoire', 'PlanningprovisoireController@index')->name('planning-provisoire');
Route::get('planification-des-agents/plannings-provisoire/',[
    'as'=>'planning-provisoire',
    'uses'=>'PlanningprovisoireController@plaTest',
]);
Route::get('gestion-des-plannings/planning-provisoire/excels/{type}', 'PlanningprovisoireController@excels')->name('planning.provisoire.excel');
Route::get('gestion-des-plannings/planning-provisoire/psfs/{type}', 'PlanningprovisoireController@pdfs')->name('planning.provisoire.pdf');

Route::get('gestion-des-plannings/planning-provisoire/excel/{id}', 'PlanningprovisoireController@excel')->name('planning.provisoire.vaccation.excel');
Route::get('gestion-des-plannings/planning-provisoire/psf/{id}', 'PlanningprovisoireController@pdf')->name('planning.provisoire.vaccation.pdf');

Route::get('gestion-des-plannings/planning-definitif/excel/{id}', 'PlanningdefinitifController@excel')->name('planning.definitif.vaccation.excel');
Route::get('gestion-des-plannings/planning-definitif/psf/{id}', 'PlanningdefinitifController@pdf')->name('planning.definitif.vaccation.pdf');


Route::resource('provisoire', 'PlanningprovisoireController');
Route::get('donnees-planning-provisoire', 'PlanningprovisoireController@dataplanning')->name('provisoire.dataplanning');
Route::put('valider-tout-les-plannings-provisoires', 'PlanningprovisoireController@dataofcrea')->name('provisoire.dataofcrea');

//vacation provisoire
Route::resource('vacationprov', 'VacationProvisoireController');
Route::put('valider-toutes-les-vacations', 'VacationProvisoireController@crea')->name('vacationprov.crea');
Route::get('vacations/{id}', 'VacationProvisoireController@show')->name('vacationprov.get');

//planning definitif
Route::get('gestion-des-plannings/planning-definitif', 'PlanningdefinitifController@index')->name('planning-definitif');
Route::resource('definitif', 'PlanningdefinitifController');
Route::get('getdata', 'PlanningdefinitifController@getdata')->name('definitif.getdata');
Route::put('valider-tout-les-plannings-definitifs', 'PlanningdefinitifController@crea')->name('definitif.crea');
//
//Route::get('gestion-des-plannings/planning-definitif/excel/{id}', 'PlanningdefinitifController@excel')->name('definitif.excel');
//Route::get('gestion-des-plannings/planning-definitif/psf/{id}', 'PlanningdefinitifController@pdf')->name('definitif.pdf');

Route::get('gestion-des-plannings/planning-definitif/excels/{type}', 'PlanningprovisoireController@excels')->name('planning.definitif.excel');
Route::get('gestion-des-plannings/planning-definitif/psfs/{type}', 'PlanningprovisoireController@pdfs')->name('planning.definitif.pdf');


Route::get('gestion-des-plannings/planning-achived/excels/{type}', 'PlanningarchivesController@excels')->name('planning.archived.excels');
Route::get('gestion-des-plannings/planning-achived/psfs/{type}', 'PlanningarchivesController@pdfs')->name('planning.archived.pdfs');

Route::get('gestion-des-plannings/planning-archived/excel/{id}', 'PlanningarchivesController@excel')->name('planning.archived.vaccation.excel');
Route::get('gestion-des-plannings/planning-archived/psf/{id}', 'PlanningarchivesController@pdf')->name('planning.archived.vaccation.pdf');


//vacation definitif
Route::resource('vacationdef', 'VacationDefinitifController');
Route::put('valider-toutes-les-vacations-definitives', 'VacationProvisoireController@dataofcrea')->name('vacationdef.dataofcrea');
//Route::get('vacations/{id}', 'VacationProvisoireController@show')->name('vacationprov.get');

//planning archives
Route::get('gestion-des-plannings/plannings-archives', 'PlanningarchivesController@index')->name('plannings-archives');
Route::resource('archives', 'PlanningarchivesController');
Route::get('donnees-planning-archives', 'PlanningarchivesController@dataofarchives')->name('archives.dataofarchives');
//Route::put('valider-tout-les-plannings-archives', 'PlanningarchivesController@archivescrea')->name('archives.archivescrea');

//vacation archives
Route::resource('vacationarch', 'VacationsArchivesController');
//Route::put('valider-toutes-les-vacations-archives', 'VacationArchivesController@datacreaarchives')->name('vacationarch.datacreaarchives');
//Route::get('vacations/{id}', 'VacationProvisoireController@show')->name('vacationprov.get');

Route::resource('actionprovisoire', 'ProvisoireController');
Route::resource('actiondefinitif', 'DefinitifController');
Route::resource('actionarchive', 'ArchiveController');

Route::middleware('auth')->group(function(){

    Route::get('gestion-des-agents/registre-unique-du-personnel',[
        'as'=>'agent.index',
        'uses'=>'AgentsController@index',
    ]);
    //Ajouter Par etape savefile
    //
    Route::match(['get', 'post'],'gestion-des-agents/ajouter-un-agent',[
        'as'=>'ajout.agent',
        'uses'=>'AgentController@ajoutAgent',
    ]);
    Route::match(['get', 'post'],'gestion-des-agents/ajouter-un-agent/file/{id}',[
        'as'=>'ajout.savefile',
        'uses'=>'AgentController@SaveFilePost',
    ]);
    Route::post('gestion-des-agents/ajouter-un-agent/ajouter',[
        'as'=>'agent.addVerification',
        'uses'=>'AgentController@addAgent',
    ]);
    Route::get('gestion-des-agents/modifier-un-agent/{id}',[
        'as'=>'agent.edit',
        'uses'=>'AgentsController@edit',
    ]);
    Route::patch('gestion-des-agents/modifier-un-agent/{id}',[
        'as'=>'agent.update',
        'uses'=>'AgentController@update',
    ]);
    Route::delete('gestion-des-agents/supprimer-un-agent/{id}',[
        'as'=>'agent.destroy',
        'uses'=>'AgentsController@destroy',
    ]);
    /*-------------------------------*\
    | Routes Site
    \*-------------------------------*/
    Route::get('sites-de-deploiements/excel/{id}',[
        'as'=>'site.excel',
        'uses'=>'SitesController@excel',
    ]);
    Route::get('sites-de-deploiements/excels/',[
        'as'=>'excel.site',
        'uses'=>'SitesController@excelAllSite',
    ]);
    // excelAllSite
    Route::get('sites-de-deploiements/pdf/{id}',[
        'as'=>'site.pdf',
        'uses'=>'SitesController@pdf',
    ]);
    Route::get('sites-de-deploiements',[
        'as'=>'site.index',
        'uses'=>'SitesController@index',
    ]);

    Route::get('sites-de-deploiements/ajouter-un-site',[
        'as'=>'site.create',
        'uses'=>'SitesController@create',
    ]);

    Route::post('sites-de-deploiements/ajouter-un-site/ajouter',[
        'as'=>'site.store',
        'uses'=>'SitesController@store',
    ]);

    Route::get('sites-de-deploiements/modifier-un-site/{id}',[
        'as'=>'site.edit',
        'uses'=>'SitesController@edit',
    ]);

    Route::patch('sites-de-deploiements/modifier-un-site/{id}',[
        'as'=>'site.update',
        'uses'=>'SitesController@update',
    ]);

    Route::get('sites-de-deploiements/supprimer-un-site/{id}',[
        'as'=>'site.destroy',
        'uses'=>'SitesController@destroy',
    ]);

    Route::get('/absences/modifier/{id}',[
        'as'=>'absence.edit',
        'uses'=>'AbsencesController@edit',
    ]);

    Route::patch('/absences/modifier/{id}',[
        'as'=>'absence.update',
        'uses'=>'AbsencesController@update',
    ]);


    Route::get('/absences/supprimer/{id}',[
        'as'=>'absence.destroy',
        'uses'=>'AbsencesController@destroy',
    ]);
    Route::get('/absences/excels/',[
        'as'=>'absence.excels',
        'uses'=>'AbsencesController@excels',
    ]);
    Route::get('/absences/pdfs/',[
        'as'=>'absence.pdf',
        'uses'=>'AbsencesController@pdfs',
    ]);
    /*-------------------------------*\
    | Routes Conge
    \*-------------------------------*/
    // Route::get('/conges',[
    // 	'as'=>'conge.index',
    // 	'uses'=>'CongesController@index',
    // ]);

    // Route::get('/conges/ajouter',[
    // 	'as'=>'conge.create',
    // 	'uses'=>'CongesController@create',
    // ]);

    Route::post('/conges/ajouter',[
        'as'=>'conge.store',
        'uses'=>'CongesController@store',
    ]);

    // Route::get('/conges/modifier/{id}',[
    // 	'as'=>'conge.edit',
    // 	'uses'=>'CongesController@edit',
    // ]);

    // Route::patch('/conges/modifier/{id}',[
    // 	'as'=>'conge.update',
    // 	'uses'=>'CongesController@update',
    // ]);


    // Route::delete('/conges/supprimer/{id}',[
    // 	'as'=>'conge.destroy',
    // 	'uses'=>'CongesController@destroy',
    // ]);

    /*-------------------------------*\
    | Routes Absence
    \*-------------------------------*/
    Route::get('gestion-des-absences/liste-des-agents-absents',[
        'as'=>'absence.index',
        'uses'=>'AbsencesController@index',
    ]);

    Route::get('gestion-des-absences/enregistrer-une-absence',[
        'as'=>'absence.create',
        'uses'=>'AbsencesController@create',
    ]);

    Route::get('gestion-des-absences/enregistrer-une-absence/enregistrer',[
        'as'=>'absence.ajout',
        'uses'=>'AbsencesController@ajout',
    ]);

    Route::post('gestion-des-absences/enregistrer-une-absence/enregistrer',[
        'as'=>'absence.store',
        'uses'=>'AbsencesController@store',
    ]);

    /*-------------------------------*\
    | Routes Planning
    \*-------------------------------*/
    //Plannings Provisoires


//	Route::get('planification-des-agents/plannings-provisoires',[
//		'as'=>'planning.index',
//		'uses'=>'PlanningController@index',gestion-des-plannings/planning-provisoire
//	]);

//    Route::get('planification-des-agents/plannings-provisoire/',[
//        'as'=>'planning.index',
//        'uses'=>'PlanningprovisoireController@plaTest',
//    ]);

    Route::get('planification-des-agents/plannings-provisoires/search',[
        'as'=>'provisoire.search',
        'uses'=>'PlanningController@provisoire_search',
    ]);

    Route::get('planification-des-agents/plannings-provisoires/planifier-un-agent',[
        'as'=>'planning.create',
        'uses'=>'PlanningController@create',
    ]);
    Route::get('/planning/provisoires/voir/{id}',[
        'as'=>'planning.show',
        'uses'=>'PlanningController@show',
    ]);

    Route::get('planification-des-agents/planning-definitif/{id}',[
        'as'=>'planning.show_planning_agent',
        'uses'=>'PlanningController@show_planning_agent',
    ]);

    Route::get('planification-des-agents/plannings-definitifs/supprimer-le-planning/{id}',[
        'as'=>'planning.delete_planning_agent',
        'uses'=>'PlanningController@delete_planning_agent',
    ]);


    Route::post('/planification-des-agents/generer/plannings-provisoires',[
        'as'=>'planning.store',
        'uses'=>'PlanningController@store',
    ]);


    /** Agent excel data */

    Route::get('planification-des-agents/plannings-definitifs/generateExcel/{id?}',[
        'as'=>'agent.excle_agent',
        'uses'=>'AgentsController@exceleprint',
    ]);
    Route::get('planification-des-agents/plannings-definitifs/generatePdf/{id?}',[
        'as'=>'agent.pdf_agent',
        'uses'=>'AgentsController@pdf_agent',
    ]);
    /** End excel agent data */
    // Route::get('/planning/provisoires/modifier/{id}',[
    // 	'as'=>'planning.edit',
    // 	'uses'=>'PlanningController@edit',
    // ]);
    // Route::patch('/planning/provisoires/modifier/{id}',[
    // 	'as'=>'planning.update',
    // 	'uses'=>'PlanningController@update',
    // ]);
    // Route::delete('/planning/provisoires/supprimer/{id}',[
    // 	'as'=>'planning.destroy',
    // 	'uses'=>'PlanningController@destroy',
    // ]);

    //Plannings Definitives
    Route::get('/planning/definitifs/{id}',[
        'as'=>'planning.index_definitives_by_site',
        'uses'=>'PlanningController@index_definitives_by_site',
    ]);
    Route::match(['GET', 'POST'], 'planification-des-agents/plannings-definitifs',[
        'as'=>'planning.index_definitives',
        'uses'=>'PlanningController@index_definitives',
    ]);
    Route::get('planification-des-agents/plannings-definitifs/search',[
        'as'=>'definitif.search',
        'uses'=>'PlanningController@definitif_search',
    ]);
    //Plannings Archives
    Route::match(['GET', 'POST'], 'planification-des-agents/plannings-archives',[
        'as'=>'planning.index_archive',
        'uses'=>'PlanningController@index_archive',
    ]);

    //Search Planning Provisoire
    // Route::post('/planning/search',[
    // 	'as'=>'planning.search_planning',
    // 	'uses'=>'PlanningController@search_planning',
    // ]);

    //Validé les plannings provisoire
    Route::get('/planning/validate/{id}',[
        'as'=>'planning.validate',
        'uses'=>'PlanningController@validePlanning',
    ]);

    //Acrhive les plannings provisoire
    Route::get('/planning/archive/{id}',[
        'as'=>'planning.archive',
        'uses'=>'PlanningController@archivePlanning',
    ]);

    //Supprimer les plannings provisoires
    Route::delete('/planning/supprimer/provisoires/{id}',[
        'as'=>'planning.destroyallProvisoire',
        'uses'=>'PlanningController@destroyAllPlannings',
    ]);
    //Supprimer les plannings definitifs
    Route::delete('/planning/supprimer/definitifs/{id}',[
        'as'=>'planning.destroyallDefinitif',
        'uses'=>'PlanningController@destroyAllPlannings',
    ]);

    //generer les fichiers pdf et excel pour les differents des agents

    // Route::get('/planning/generate/pdf/{id}',[
    // 	'as'=>'planning.pdf',
    // 	'uses'=>'PDFplanningController@getDataPlanning',
    // ]);

    Route::get('/planification-des-agents/plannings-definitifs/generer-format-pdf/download',[
        'as'=>'planning.defIndivPdf',
        'uses'=>'PDFplanningController@planningDefinitif',
    ]);
    Route::get('/planification-des-agents/plannings-definitifs/generer-format-pdf/',[
        'as'=>'planning.defGeneralPdf',
        'uses'=>'PDFplanningController@planningDefinitifGeneral',
    ]);
    Route::get('/agent/absent/generate/pdf/',[
        'as'=>'agent.agentAbsent',
        'uses'=>'PDFplanningController@agentAbsent',
    ]);
    Route::get('/agents/registre-unique-du-personnel/generer-pdf/',[
        'as'=>'registre.unique',
        'uses'=>'PDFplanningController@registreUnique',
    ]);
    Route::get('/sites-de-deploiements/pdf/',[
        'as'=>'pdf.site',
        'uses'=>'PDFplanningController@site',
    ]);
    Route::get('/planification-des-agents/plannings-definitifs/generer-format-excel/', [
        'as' => 'excel.planningDef',
        'uses' => 'EXCELplanningController@excelPlanningGen'
    ]);
    Route::get('planning/definitif/generate/excel', [
        'as' => 'excel.planningDefIndiv',
        'uses' => 'EXCELplanningController@excelPlanningIndiv'
    ]);
    Route::get('agents/registre-unique-du-personnel/generer-excel', [
        'as' => 'excel.registreUnique',
        'uses' => 'EXCELplanningController@excelregistreUnique'
    ]);

    //Routes Manage account

    /*-------------------------------*\
    | Routes maanage account
    \*-------------------------------*/
    //Plannings Provisoires
    Route::get('gestion-des-comptes/ajouter-un-admin','AccountController@form')->name('account.create');
    Route::post('gestion-des-comptes/post-admin','AccountController@store')->name('account.post');
    Route::get('gestion-des-comptes/','AccountController@listUsers')->name('account.list');
    Route::post('gestion-des-comptes/action','AccountController@action')->name('account.action');
    Route::post('gestion-des-comptes/update','AccountController@update')->name('account.update');
    Route::get('gestion-des-comptes/mise-a-jour-info','AccountController@form_to_Update')->name('account.edit');
    Route::get('gestion-des-comptes/generateExcel', 'AccountController@execelUsers')->name('account.generateExcel');
    Route::get('gestion-des-comptes/generatePdf', 'AccountController@Pdfuser')->name('account.Pdfuser');

    /**Log activity  */

    Route::get('activite-des-comptes/', 'LogActivityController@index')->name('logactivity.list');
    Route::get('activite-des-comptes/getdata', 'LogActivityController@getdata')->name('logactivity.getdata');
    Route::get('activite-des-comptes/recherche/', 'LogActivityController@search')->name('logactivity.search');
    Route::post('activite-des-comptes/recherche/data', 'LogActivityController@doRecherche')->name('logactivity.post');
    Route::get('activite-des-comptes/{id}', 'LogActivityController@show')->name('logactivity.show');
    // Route::get('activite-des-comptes/recherche', 'LogActivityController@search')->name('logactivity.get');

    /*-------------------------------*\
    | end Routes manage account
    \*-------------------------------*/
    //Plannings Provisoires


});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// test fichier view
route::get('testfichier/pdf', 'TestFichierController@index')->name('testfichier');



