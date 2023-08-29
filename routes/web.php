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
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

Route::get('cron_email', function () {
    Log::info('iniciando queue work');
   // Artisan::call('schedule:run');
    Artisan::call('queue:work --tries=3')
    ->cron('* * * * *')
    ->withoutOverlapping();
    //->emailOutputOnFailure('danielbq111144@gmail.com');
    
    //Artisan::call('queue:restart');
    //dd('schudule ejecutado');
});

Route::get('/', 'Web\HomeController@index')->name('home');
//prefijo q se aplica a todas las rutas

Route::get('/panel','Admin\PanelController@index');
Route::get('/admin','Admin\PanelController@index');
Route::match(['get','post'],'admin/authentication','Admin\PanelController@authentication');

Route::post('queryRuc','Admin\EmployerController@queryRuc');
Route::get('admin/employers/{employer_id}/find','Admin\EmployerController@find');

Route::get('admin/employers/{employer_id}/find','Admin\EmployerController@find');
Route::match(['get','post'],'recoverPassword/{usert_type}','Web\LoginController@recoverPassword');
Route::match(['get','post'],'resetPassword/{token}','Web\LoginController@resetPassword');
Route::match(['post','get'],'changePassword','Web\LoginController@changePassword');


Route::middleware(['admin'])->group(function () 
{
    Route::prefix('admin')->group(function () 
    {
        Route::match(['post','get'],'changePassword','Admin\PanelController@changePassword');
        Route::get('logout','Admin\PanelController@logout');
        //****************************panel******************************//
        Route::get('loginNumber','Admin\PanelController@loginNumber');
        //****************************roles******************************//
        Route::get('roles','Admin\RoleController@index')->name('roles')->middleware('permission:roles.index');
        Route::match(['post','get'],'roles/create','Admin\RoleController@create')->name('roles.create')->middleware('permission:roles.create');
        Route::match(['post','get'],'roles/{role_id}/update','Admin\RoleController@update')->name('roles.update')->middleware('permission:roles.update');
        Route::post('roles/{role_id}/delete','Admin\RoleController@delete')->name('roles.delete')->middleware('permission:roles.delete');;

        //****************************users******************************//
        Route::get('users','Admin\UserController@index')->name('users')->middleware('permission:users.index');
        Route::get('users/{user_id}/show','Admin\UserController@show')->name('users.show');
        Route::match(['post','get'],'users/create','Admin\UserController@create')->name('users.create')->middleware('permission:users.create');
        Route::match(['post','get'],'users/{user_id}/update','Admin\UserController@update')->name('users.update')->middleware('permission:users.update');
        Route::post('users/{user_id}/delete','Admin\UserController@delete')->name('users.delete')->middleware('permission:users.delete');

        //****************************employers******************************//
        Route::get('employers','Admin\EmployerController@index')->middleware('permission:employers.index');
        Route::match(['post','get'],'employers/create','Admin\EmployerController@create')->middleware('permission:employers.create');
        Route::match(['post','get'],'employers/{employer_id}/update','Admin\EmployerController@update')->middleware('permission:employers.update');
        Route::post('employers/{user_id}/delete','Admin\EmployerController@delete')->middleware('permission:employers.delete');

        //****************************candidates******************************//
        Route::get('candidates','Admin\CandidateController@index')->middleware('permission:candidates.index');
        Route::get('candidates/{candidate_id}/find','Admin\CandidateController@find');
        Route::match(['post','get'],'candidates/create','Admin\CandidateController@create')->middleware('permission:candidates.create');
        Route::match(['post','get'],'candidates/{candidate_id}/update','Admin\CandidateController@update')->middleware('permission:candidates.update');
        Route::post('candidates/{user_id}/delete','Admin\CandidateController@delete')->middleware('permission:candidates.delete');

        //****************************Ofertas laborales internas******************************// 
        Route::get('internalJobOffers','Admin\InternalJobOfferController@index')->middleware('permission:internalJobOffers.index');
        Route::get('internalJobOffers/{offer_id}/find','Admin\InternalJobOfferController@find');
        Route::match(['post','get'],'internalJobOffers/create','Admin\InternalJobOfferController@create')->middleware('permission:internalJobOffers.create');
        Route::match(['post','get'],'internalJobOffers/{offer_id}/update','Admin\InternalJobOfferController@update')->middleware('permission:internalJobOffers.update');
        Route::post('internalJobOffers/{offer_id}/delete','Admin\InternalJobOfferController@delete')->middleware('permission:internalJobOffers.delete');
        Route::post('internalJobOffers/{offer_id}/sendEmails','Admin\InternalJobOfferController@sendEmails')->middleware('permission:internalJobOffers.sendEmails');
        
        //****************************Ofertas laborales Externas******************************//
        Route::get('employerJobOffers','Admin\EmployerJobOfferController@index')->middleware('permission:employerJobOffers.index');
        Route::get('employerJobOffers/{offer_id}/find','Admin\EmployerJobOfferController@find');
        // Route::match(['post','get'],'employerJobOffers/create','Admin\EmployerJobOfferController@create')->middleware('permission:employerJobOffers.create');
        Route::match(['post','get'],'employerJobOffers/{offer_id}/update','Admin\EmployerJobOfferController@update')->middleware('permission:employerJobOffers.update');
        Route::post('employerJobOffers/{offer_id}/delete','Admin\EmployerJobOfferController@delete')->middleware('permission:employerJobOffers.delete');
        Route::post('employerJobOffers/{offer_id}/sendEmails','Admin\EmployerJobOfferController@sendEmails')->middleware('permission:employerJobOffers.sendEmails');

        //****************************Recursos*******************************************//
        Route::get('resources','Admin\ResourceController@index')->name('resources')->middleware('permission:resources.index');
        Route::get('resources/search_image','Admin\ResourceController@searchImage')->name('resources.search_image');
        Route::get('resources/search_pdf','Admin\ResourceController@searchPdf')->name('resources.search_pdf');
        Route::get('resources/search_doc','Admin\ResourceController@searchDoc')->name('resources.search_doc');
        Route::post('resources/create','Admin\ResourceController@create')->name('resources.create')->middleware('permission:resources.create');
        Route::post('resources/{id}/delete','Admin\ResourceController@delete')->name('resources.delete')->middleware('permission:resources.delete');
        //****************************Publicaciones******************************//
        Route::get('publications','Admin\PublicationController@index')->name('publications')->middleware('permission:publications.index');
        Route::get('publications/{id}/find','Admin\PublicationController@find')->name('publications.find');
        Route::match(['post','get'],'publications/create','Admin\PublicationController@create')->middleware('permission:publications.create');
        Route::match(['post','get'],'publications/{offer_id}/update','Admin\PublicationController@update')->middleware('permission:publications.update');
        Route::post('publications/{id}/delete','Admin\PublicationController@delete')->middleware('permission:publications.delete');
        //***********************************Galeria */
        Route::get('publications/{id}/images','Admin\PublicationController@images')->name('publications.images')->middleware('permission:publications.images');
        Route::post('publications/{id}/images/create','Admin\PublicationController@imagesCreate')->name('publications.imagesCreate');
        Route::post('publications/{id}/images/delete','Admin\PublicationController@imagesDelete')->name('publications.imagesDelete');

         //****************************Importar datos******************************//
         Route::match(['get','post'],'imports','Admin\ImportController@importCandidates');

         //****************************Reporte Candidatos******************************//
         Route::get('registeredUsers','Admin\ReportController@registeredUsers')->name('registeredUsers')->middleware('permission:report.candidates');
         Route::get('registeredUsers/excelDownload','Admin\ReportController@candidateExcelDownload')->name('candidateExcelDownload')->middleware('permission:report.candidatesExcelDownload');
         Route::get('registeredUsers/pdfDownload','Admin\ReportController@candidatePdfDownload')->name('candidatePdfDownload')->middleware('permission:report.candidatesPdfDownload');
        //****************************Reporte Empleadores******************************//
         Route::get('registeredEmployers','Admin\ReportController@registeredEmployers')->name('registeredEmployers')->middleware('permission:report.employers');
         Route::get('registeredEmployers/excelDownload','Admin\ReportController@employerExcelDownload')->name('employerExcelDownload')->middleware('permission:report.employersExcelDownload');
         Route::get('registeredEmployers/pdfDownload','Admin\ReportController@employerPdfDownload')->name('employerPdfDownload')->middleware('permission:report.employersPdfDownload');
         //****************************Reporte ofertas labores******************************//
         Route::get('registeredJobOffers','Admin\ReportController@registeredJobOffers')->name('registeredJobOffers')->middleware('permission:report.jobOffers');;
         Route::get('registeredJobOffers/excelDownload','Admin\ReportController@jobOfferExcelDownload')->name('jobOfferExcelDownload')->middleware('permission:report.jobOffersExcelDownload');
         Route::get('registeredJobOffers/pdfDownload','Admin\ReportController@jobOfferPdfDownload')->name('jobOfferPdfDownload')->middleware('permission:report.jobOffersPdfDownload');

    });
});
//****************************Vista Institución**********************************/
Route::get('institution','Web\HomeController@institution')->name('institution');
//****************************Eventos**********************************/
Route::get('events','Web\PublicationController@index')->name('events');
Route::get('events/{id}/show','Web\PublicationController@event_show')->name('events.show');
//****************************Artículod e interes**********************************/
Route::get('articles_interest','Web\PublicationController@articles_interest')->name('articles_interest');
Route::get('articles_interest/{id}/show','Web\PublicationController@articles_interest_show')->name('articles_interest.show');
//****************************Registro**********************************/
Route::match(['post','get'],'registerEmployer','Web\EmployerController@create')->name('registerEmployer');
Route::match(['post','get'],'registerCandidate','Web\CandidateController@register')->name('registerCandidate');

Route::get('candidates/{document}/find','Web\CandidateController@find');
Route::get('confirmAcount/{document}/candidate','Web\CandidateController@confirmAcount');

//rutas candidato

//****************************Geolocation******************************//
Route::get('geolocations/{geolocation_id}/getDistricts','GeolocationController@getDistricts');
Route::get('geolocations/{geolocation_id}/getProvinces','GeolocationController@getProvinces');
//*****************************Job Offer************************ *//
Route::get('jobOffers','Web\JobOfferController@index')->name('jobOffers');
Route::get('jobOffers/{id}/find','Web\JobOfferController@find')->name('jobOffers.find');
//candidate
Route::post('jobOffers/authenticate','Web\LoginController@authenticateJobOffer')->name('jobOffer.authenticate');
//****************************Employer**********************************/
Route::get('authenticate','Web\LoginController@authenticate')->name('authenticate');
Route::post('authenticateCandidate','Web\LoginController@authenticateCandidate')->name('authenticateCandidate');
Route::post('authenticateEmployer','Web\LoginController@authenticateEmployer')->name('authenticateEmployer');
Route::get('logoutWeb','Web\LoginController@logout')->name('logoutWeb');

Route::middleware(['loginEstudent'])->group(function () 
{
    //*****************************Job Offer************************ *//
    Route::get('jobOffers/{id}/show','Web\JobOfferController@show')->name('jobOffers.show');
    Route::get('candidate/curriculum','Web\CandidateController@curriculum')->name('candidate.curriculum');
    Route::post('candidate/curriculum/create','Web\CandidateController@curriculumCreate')->name('curriculum.create');
    Route::post('candidate/curriculum/{id}/update','Web\CandidateController@curriculumUpdate')->name('curriculum.update');
    Route::post('candidate/curriculum/{id}/delete','Web\CandidateController@curriculumDelete')->name('curriculum.delete');

    Route::match(['post','get'],'updateCandidate','Web\CandidateController@update')->name('updateCandidate');
    //****************************Postulation**********************************/
    Route::get('candidate/postulation','Web\CandidateController@postulation')->name('candidate.postulation');
    Route::get('candidate/postulation/{id}/search','Web\CandidateController@postulationSearch')->name('postulation.search');
    Route::post('candidate/postulation/{id}/create','Web\CandidateController@postulationCreate')->name('postulation.create');
    Route::post('candidate/postulation/{id}/delete','web\CandidateController@postulationDelete')->name('postulation.delete');

});

Route::middleware(['loginEmployer'])->group(function () 
{
//*********************************************My ooffer************************* */
    Route::get('employers','Web\Employer\JobOfferController@index')->name('employers');
   
    Route::get('employers/{id}/show','Web\Employer\JobOfferController@watch')->name('employers.show');
    Route::match(['post','get'],'employers/create','Web\Employer\JobOfferController@create')->name('employers.create');
    Route::match(['post','get'],'employers/{id}/edit','Web\Employer\JobOfferController@edit')->name('employers.edit');
    Route::post('employers/{id}/delete','Web\Employer\JobOfferController@delete')->name('employers.delete');
    Route::match(['post','get'],'updateEmployer','Web\EmployerController@update')->name('updateEmployer');
    Route::get('employers/{slug}/postulations','Web\Employer\JobOfferController@postulations')->name('employers.postulations');
    Route::post('finalistPostulation/{job_offer_id}/{candidate_id}/{value}','Web\Employer\JobOfferController@finalistPostulation');
    Route::post('viewCvPostulation/{job_offer_id}/{candidate_id}','Web\Employer\JobOfferController@viewCvPostulation');

});