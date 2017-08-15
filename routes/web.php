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


//----API---
Route::get('api/modalavisit','PatientsController@modalavisit');
