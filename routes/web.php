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
Route::get('/', 'Auth@checklogin');
Route::post('/', 'Auth@getlogin');
Route::get('/logout', 'Auth@logout');

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});

Route::get('/NFHSI', 'PatientsController@patientlist');

Route::get('/newvisit', 'PatientsController@newvisit');
Route::post('/newvisit', 'PatientsController@addnewvisit');
Route::get('/visit/{id}/{vid}', 'PatientsController@patientvisitpage');
Route::post('/visit/{id}/{vid}', 'PatientsController@newpatientxray');

//Route::get('/doctorspage', 'DoctorsController@doctorspatientlist');

Route::get('/myinfo', 'DoctorsController@myinfo');
Route::get('/NFHSI/users', 'DoctorsController@userdoctorpage');
Route::post('/NFHSI/users', 'DoctorsController@adduserdoctorpage');

Route::post('/NFHSI', 'PatientsController@editpatient');
Route::post('/myinfo', 'DoctorsController@editmyinfo');

Route::post('/visit/{id}/{vid}/edit', 'PatientsController@editpatientxray');
Route::get('/reports/{id}', 'DoctorsController@reports');

Route::post('/visit/{id}/{vid}/urinalysis', 'PatientsController@newurinalysis');

// Route::get('/adminpanel', 'AdminPanelContoller@adminpanel');

Route::get('/NFHSI/services', 'AdminPanelContoller@services');

Route::get('/dashboard', 'AdminPanelContoller@dashboard');

Route::post('/NFHSI/editvisit', 'PatientsController@editvisit');
Route::get('/newvisit/{id}', 'PatientsController@newvisit1002');
Route::get('/generate/medcert', 'DoctorsController@medcert');
Route::post('/generate/medcert', 'DoctorsController@postmedcert');

Route::post('/NFHSI/services/edit/service', 'AdminPanelContoller@editservicepost');

// --- PDF ---
Route::get('/pdf/view/{id}/{datefrom}/{dateto}', 'DoctorsController@printreport');
Route::get('/patient/pdf/view/{id}/{vid}', 'PatientsController@patientprintreport');
Route::get('/patientreceipt/pdf/view/{id}/{vid}', 'PatientsController@patientreceipt');
Route::get('/pdf/view2/{id}/{datefrom}/{dateto}', 'DoctorsController@printxrayreport');
Route::get('/print/rx/{id}/{vid}', 'PatientsController@printpatientrx');

Route::get('/NFHSI/doctors', 'DoctorsController@doctoruserpage');

Route::get('/xray/pdf/view/{id}', 'PatientsController@xraypdfview');
Route::get('/urinalysis/pdf/view/{id}', 'PatientsController@urinalysispdfview');


//----API---
Route::get('api/modalavisit','PatientsController@modalavisit');
Route::get('api/modalaeditpatient','PatientsController@modalaeditpatient');

Route::get('api/modalxrayedit','PatientsController@modalxrayedit');

Route::get('api/addreasonforconsulation','PatientsController@addreasonforconsulation');
Route::get('api/editreasonforconsulation','PatientsController@editreasonforconsulation');

Route::get('api/addpastmedicalhistory','PatientsController@addpastmedicalhistory');
Route::get('api/addsurgery','PatientsController@addsurgery');
Route::get('api/addhospitalization','PatientsController@addhospitalization');
Route::get('api/adddisease','PatientsController@adddisease');
Route::get('api/addvaccination','PatientsController@addvaccination');

Route::get('api/editpastmedicalhistory','PatientsController@editpastmedicalhistory');
Route::get('api/addsocialhistory','PatientsController@addsocialhistory');
Route::get('api/addphysicalexam','PatientsController@addphysicalexam');
Route::get('api/adddiagnosis','PatientsController@adddiagnosis');
Route::get('api/addplan','PatientsController@addplan');

Route::get('api/getuserinfo','DoctorsController@getuserinfo');
Route::get('api/reportsreports','DoctorsController@reportsreports');

Route::get('api/xraylogs','PatientsController@xraylogs');

Route::get('api/editurinalysis','PatientsController@editurinalysis');

Route::get('api/modalmedication','PatientsController@modalmedication');
Route::get('api/editmedication','PatientsController@editmedication');

Route::get('api/xrayreportsreports','DoctorsController@xrayreportsreports');

Route::get('api/editservice','AdminPanelContoller@editservice');

