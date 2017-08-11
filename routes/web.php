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

Route::get('/', 'PatientsController@patientlist');
// Route::get('/', function () {
//     return view('patientlistpage');
// });

Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});

Route::get('/newvisit', 'PatientsController@newvisit');
Route::get('/visit/{id}/{vid}', 'PatientsController@patientxray');
Route::post('/visit/{id}/{vid}', 'PatientsController@newpatientxray');


//----API---
Route::get('api/modalavisit','PatientsController@modalavisit');
