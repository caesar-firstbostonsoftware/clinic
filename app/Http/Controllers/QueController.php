<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Session;
use PDF;
use Dompdf\Dompdf;
use TCPDF;
use DB;
use App\PatientService;

class QueController extends Controller
{
    public function queueing()
    {
    	if(Session::has('user')){
    		$now = date("Y-m-d");
        	$xray = PatientService::where('admin_panel_id',35)->where('date_reg',$now)->where('status','Pending')->orderBy('date_reg','asc')->with('patient')->get();
        	$urinalysis = PatientService::where('admin_panel_id',1)->where('date_reg',$now)->where('status','Pending')->orderBy('date_reg','asc')->with('patient')->get();
        	$fecalysis = DB::select("SELECT patients.f_name, patients.m_name, patients.l_name,patient_services.admin_panel_id
        		FROM patient_services
        		INNER JOIN patients ON patient_services.patient_id = patients.id
        		WHERE patient_services.date_reg = '$now' AND patient_services.status = 'Pending'");
        	$chemistryii = DB::select("SELECT patients.f_name, patients.m_name, patients.l_name,patient_services.admin_panel_id
        		FROM patient_services
        		INNER JOIN patients ON patient_services.patient_id = patients.id
        		WHERE patient_services.date_reg = '$now' AND patient_services.status = 'Pending'");
        	$ogtt = DB::select("SELECT patients.f_name, patients.m_name, patients.l_name,patient_services.admin_panel_id
        		FROM patient_services
        		INNER JOIN patients ON patient_services.patient_id = patients.id
        		WHERE patient_services.date_reg = '$now' AND patient_services.status = 'Pending'");
        	$hematology = DB::select("SELECT patients.f_name, patients.m_name, patients.l_name,patient_services.admin_panel_id
        		FROM patient_services
        		INNER JOIN patients ON patient_services.patient_id = patients.id
        		WHERE patient_services.date_reg = '$now' AND patient_services.status = 'Pending'");
        	//return Response::json($chemistryii, 200, array(), JSON_PRETTY_PRINT);
    		return view('queueingpage',compact('xray','urinalysis','fecalysis','chemistryii','ogtt','hematology'));
    	}
    	else {
    		return redirect()->action('Auth@checklogin');
    	}
    }
}
