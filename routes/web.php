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
Route::post('/visit/{id}/{vid}/fecalysis', 'PatientsController@newfecalysis');
Route::post('/visit/{id}/{vid}/chemistryii', 'PatientsController@newchemistryii');
Route::post('/visit/{id}/{vid}/ogtt', 'PatientsController@newogtt');
Route::post('/visit/{id}/{vid}/hematology', 'PatientsController@newhematology');
Route::post('/visit/{id}/{vid}/ultrasound', 'PatientsController@newultrasound');
Route::post('/visit/{id}/{vid}/ultrasoundedit', 'PatientsController@newultrasoundedit');
Route::post('/visit/{id}/{vid}/aptt', 'PatientsController@newaptt');

// Route::get('/adminpanel', 'AdminPanelContoller@adminpanel');

Route::get('/NFHSI/services', 'AdminPanelContoller@services');

Route::get('/dashboard', 'AdminPanelContoller@dashboard');

Route::post('/NFHSI/editvisit', 'PatientsController@editvisit');
Route::get('/newvisit/{id}', 'PatientsController@newvisit1002');
Route::get('/generate/medcert', 'DoctorsController@medcert');
Route::post('/generate/medcert', 'DoctorsController@postmedcert');

Route::post('/NFHSI/services/edit/service', 'AdminPanelContoller@editservicepost');
Route::post('/NFHSI/services/addmain', 'AdminPanelContoller@addmain');
Route::post('/NFHSI/services/subadd', 'AdminPanelContoller@subadd');
Route::post('/NFHSI/services/editmain', 'AdminPanelContoller@editmain');

Route::post('/NFHSI/editvisitdate', 'PatientsController@editvisitdate');
Route::get('/NFHSI/queueing', 'QueController@queueing');

Route::get('/visit/{id}/{vid}/xraydone', 'PatientsController@patientvisitxraydone');
Route::get('/visit/{id}/{vid}/urinalysisdone', 'PatientsController@urinalysisdone');
Route::get('/visit/{id}/{vid}/fecalysisdone', 'PatientsController@fecalysisdone');
Route::get('/visit/{id}/{vid}/chemistryidone', 'PatientsController@chemistryidone');
Route::get('/visit/{id}/{vid}/ogttdone', 'PatientsController@ogttdone');
Route::get('/visit/{id}/{vid}/hematologydone', 'PatientsController@hematologydone');
Route::get('/visit/{id}/{vid}/serologydone', 'PatientsController@serologydone');
Route::get('/visit/{id}/{vid}/chemistryiidone', 'PatientsController@chemistryiidone');
Route::get('/visit/{id}/{vid}/ecgdone', 'PatientsController@ecgdone');
Route::get('/visit/{id}/{vid}/ultrasounddone', 'PatientsController@ultrasounddone');
Route::get('/visit/{id}/{vid}/apttdone', 'PatientsController@apttdone');


Route::post('/visit/{id}/{vid}/serology', 'PatientsController@newserology');
Route::post('/visit/{id}/{vid}/ecg', 'PatientsController@newecg');
Route::post('/visit/{id}/{vid}/chemtwo', 'PatientsController@newchemtwo');

Route::get('/NFHSI/{id}/disabled', 'PatientsController@disabledpatient');

// --- PDF ---
Route::get('/pdf/view/{id}/{datefrom}/{dateto}', 'DoctorsController@printreport');
Route::get('/patient/pdf/view/{id}/{vid}', 'PatientsController@patientprintreport');
Route::get('/patientreceipt/pdf/view/{id}/{vid}/{recno}', 'PatientsController@patientreceipt');
Route::get('/pdf/view2/{id}/{datefrom}/{dateto}', 'DoctorsController@printxrayreport');
Route::get('/print/rx/{id}/{vid}', 'PatientsController@printpatientrx');
Route::get('/pdf/viewservice/{datefrom}/{dateto}', 'DoctorsController@viewservice');

Route::get('/NFHSI/doctors', 'DoctorsController@doctoruserpage');

Route::get('/xray/pdf/view/{id}', 'PatientsController@xraypdfview');
Route::get('/xray/pdf/view/{id}/reprint', 'PatientsController@reprintxraypdfview');
Route::get('/urinalysis/pdf/view/{id}', 'PatientsController@urinalysispdfview');

Route::get('/visit/{id}/{vid}/ecgdone/pdf', 'PatientsController@ecgdonepdf');
Route::get('/visit/{id}/{vid}/chemistryiidone/pdf', 'PatientsController@chemistryiidonepdf');
Route::get('/visit/{id}/{vid}/serologydone/pdf', 'PatientsController@serologydonepdf');
Route::get('/visit/{id}/{vid}/hematologydone/pdf', 'PatientsController@hematologydonepdf');
Route::get('/visit/{id}/{vid}/ogttdone/pdf', 'PatientsController@ogttdonepdf');
Route::get('/visit/{id}/{vid}/chemistryidone/pdf', 'PatientsController@chemistryidonepdf');
Route::get('/visit/{id}/{vid}/fecalysisdone/pdf', 'PatientsController@fecalysisdonepdf');
Route::get('/visit/{id}/{vid}/urinalysisdone/pdf', 'PatientsController@urinalysisdonepdf');
Route::get('/visit/{id}/{vid}/apttdone/pdf', 'PatientsController@apttdonepdf');

Route::get('/ultrasound/pdf/view/{id}', 'PatientsController@ultrasoundpdfview');
Route::get('/ultrasound/pdf/view/{id}/reprint', 'PatientsController@reprintultrasoundpdfview');

Route::get('/pdf/viewledger/{datefrom}/{dateto}', 'DoctorsController@viewledger');

Route::get('/company', 'CompanyController@company');
Route::post('/company', 'CompanyController@newcompany');
Route::post('/company/viewedit', 'CompanyController@editcompany');

Route::get('/pdf/viewcompanyreport/{datefrom}/{dateto}/{company_id}', 'DoctorsController@viewcompanyreport');

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

Route::get('api/submainservices','PatientsController@submainservices');

Route::get('api/donevisit','PatientsController@donevisit');
Route::get('api/cancelvisit','PatientsController@cancelvisit');

Route::get('api/checkreceipt','PatientsController@checkreceipt');

Route::get('api/historyservice','AdminPanelContoller@historyservice');

Route::get('api/ultrasoundedit','PatientsController@ultrasoundedit');
Route::get('api/ultrasoundlogs','PatientsController@ultrasoundlogs');

Route::get('api/servicereportsreports','DoctorsController@servicereportsreports');

Route::get('api/ledgerreports','DoctorsController@ledgerreports');

Route::get('api/viewcompany','CompanyController@viewcompany');
Route::get('api/getcompany','CompanyController@getcompany');

Route::get('api/allservice','AdminPanelContoller@allservice');
Route::get('api/servicepackage','AdminPanelContoller@servicepackage');

Route::get('api/viewpatentlist','CompanyController@viewpatentlist');

Route::get('api/getplate','PatientsController@getplate');

