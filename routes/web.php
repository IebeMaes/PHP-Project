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

Auth::routes();

$functies=collect(["","2","0","0"]);

Route::view('/', 'homepage');
Route::view('/test', 'homepage');
Route::get('logout', 'Auth\LoginController@logout');



Route::resource('inschrijvenhelper','Helper\RegisterController');
Route::get('/inschrijving', 'User\InschrijvingController@index');
Route::post('/inschrijving/namiddag', 'User\InschrijvingController@namiddag');
Route::post('/inschrijving/namiddag/save', 'User\InschrijvingController@savenamiddag');
Route::get('/inschrijving/avond', 'User\InschrijvingController@avond');
Route::post('/inschrijving/avond/save', 'User\InschrijvingController@saveavond');
Route::get('/inschrijving/bevestiging', 'User\InschrijvingController@overzicht');

Route::middleware(['auth'])->prefix('organizer')->group(function () {
    Route::resource('helpers', 'Organizer\HelperController', ['parameters' => ['helpers' => 'participant']]);
    Route::resource('vervoersmogelijkheid', 'Organizer\TransportoptionController', ['parameters' => ['vervoersmogelijkheid' => 'transportoption']]);

    Route::resource('deelnemers', 'Organizer\ParticipantController',  ['parameters' => ['deelnemers' => 'participant']]);
    Route::resource('staffparties', 'Organizer\StaffPartyController', ['parameters' => ['Staffparties' => 'staffparty']]);
    Route::post('staffparties/addshort', 'Organizer\StaffPartyController@addDaypartS');
    Route::post('staffparties/copyparty', 'Organizer\StaffPartyController@copyparty');
    Route::delete('staffparty/deletedaypart', 'Organizer\StaffPartyController@deleteDaypart');

    Route::resource('registratieshelpers', 'Organizer\RegistrationtaskController', ['parameters' => ['registratieshelpers' => 'registrationtask']]);
    Route::resource('registraties', 'Organizer\RegistrationController', ['parameters' => ['registraties' => 'registration']]);


    Route::resource('taken', 'Organizer\TaskController', ['parameters' => ['taken' => 'task']]);









    Route::resource('registratiesdetail', 'Organizer\Registrationhulp', ['parameters' => ['registratiesdetail' => 'daypart_activity']]);

    //activiteiten per personeelsfeest
    Route::get('activiteiten/{feestid}','Organizer\ActiviteitenController@index');
    Route::resource('activiteiten2','Organizer\ActiviteitenController');
    //globale activiteiten
    Route::resource('activiteitenglobaal','Organizer\ActiviteitenGlobaalController');
    Route::Resource('mailtemplates', 'Organizer\MailtemplateController', ['parameters' => ['Mailtemplates' => 'mailtemplate']]);

    Route::resource('locations', 'Organizer\LocationController');


    Route::get('password', 'User\PasswordController@edit');
    Route::post('password', 'User\PasswordController@update');
    Route::get('profile/me', 'Organizer\ProfileController@index');
    Route::post('profile', 'Organizer\ProfileController@update');
    Route::resource('locations', 'Organizer\LocationController');
});

Route::middleware(['auth', 'headorganizer'])->prefix('headorganizer')->group(function () {
    Route::resource('users', 'Headorganizer\Usercontroller');

});



