<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Session;
use TCPDF;
use App\Company;
use App\Patient;

class CompanyController extends Controller
{
    public function company()
    {
    	$Company = Company::where('status','Active')->get();
    	return view('company',compact('Company'));
    }

    public function newcompany(Request $request)
    {   
        if(Session::has('user')){
        	$datenow = date("Y-m-d");

        	$Company = new Company;
        	$Company->complete_name = $request->input('completename');
        	$Company->address = $request->input('address');
        	$Company->contact_no = $request->input('contact_no');
        	$Company->date_reg = $datenow;
        	$Company->save();

            Session::flash('alert-success', 'New Company Created.');
            return redirect()->action('CompanyController@company');
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function viewcompany(Request $request)
    {	
        if(Session::has('user')){
    		$company_id = $request->input('company_id');
    		$Company = Company::where('id',$company_id)->first();
    		return Response::json($Company, 200, array(), JSON_PRETTY_PRINT);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function editcompany(Request $request)
    {   
        if(Session::has('user')){
        	$datenow = date("Y-m-d");

        	$Company = Company::where('id',$request->input('company_id'))->first();
        	$Company->complete_name = $request->input('completename');
        	$Company->address = $request->input('address');
        	$Company->contact_no = $request->input('contact_no');
        	$Company->save();

            Session::flash('alert-success', 'Company Successfully Edited.');
            return redirect()->action('CompanyController@company');
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function getcompany()
    {	
        if(Session::has('user')){
    		$Company = Company::where('status','Active')->get();
    		return Response::json($Company, 200, array(), JSON_PRETTY_PRINT);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function viewpatentlist(Request $request)
    {   
        if(Session::has('user')){
            $Patient = Patient::where('company_id',$request->input('company_id'))->where('status','Active')->get();
            return Response::json($Patient, 200, array(), JSON_PRETTY_PRINT);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }
}
