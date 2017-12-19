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
use App\User;

class QueController extends Controller
{
    public function queueing()
    {
    	if(Session::has('user')){

    		$now = date("Y-m-d");
            $user_id = Session::get('user');
            $User = User::where('doc_id',$user_id)->first();
            $xray = PatientService::join('patients','patient_services.patient_id','=','patients.id')
            ->select('patient_services.patient_id','patient_services.visit_id','patients.f_name','patients.l_name')
            ->where('patient_services.admin_panel_id',5)
            ->where('patient_services.date_reg',$now)
            ->where('patient_services.status','Pending')
            ->orderBy('patient_services.date_reg','asc')
            ->groupBy('patient_services.patient_id','patient_services.visit_id','patients.f_name','patients.l_name')
            ->get();
            $xrayservice = PatientService::where('admin_panel_id',5)->where('date_reg',$now)->where('status','Pending')->orderBy('date_reg','asc')->with('xrayservice1001')->get();

            $urinalysis = PatientService::join('patients','patient_services.patient_id','=','patients.id')
            ->select('patient_services.patient_id','patient_services.visit_id','patients.f_name','patients.l_name')
            ->where('patient_services.admin_panel_id',1)
            ->where('patient_services.admin_panel_sub_id',1)
            ->where('patient_services.date_reg',$now)
            ->where('patient_services.status','Pending')
            ->orderBy('patient_services.date_reg','asc')
            ->groupBy('patient_services.patient_id','patient_services.visit_id','patients.f_name','patients.l_name')
            ->get();

            $pregnancy = PatientService::join('patients','patient_services.patient_id','=','patients.id')
            ->select('patient_services.patient_id','patient_services.visit_id','patients.f_name','patients.l_name')
            ->where('patient_services.admin_panel_id',4)
            ->where('patient_services.admin_panel_sub_id',40)
            ->where('patient_services.date_reg',$now)
            ->where('patient_services.status','Pending')
            ->orderBy('patient_services.date_reg','asc')
            ->groupBy('patient_services.patient_id','patient_services.visit_id','patients.f_name','patients.l_name')
            ->get();

            $fecalysis = PatientService::join('patients','patient_services.patient_id','=','patients.id')
            ->select('patient_services.patient_id','patient_services.visit_id','patients.f_name','patients.l_name')
            ->where('patient_services.admin_panel_id',1)
            ->where('patient_services.admin_panel_sub_id',2)
            ->where('patient_services.date_reg',$now)
            ->where('patient_services.status','Pending')
            ->orderBy('patient_services.date_reg','asc')
            ->groupBy('patient_services.patient_id','patient_services.visit_id','patients.f_name','patients.l_name')
            ->get();

            $amoeba = PatientService::join('patients','patient_services.patient_id','=','patients.id')
            ->select('patient_services.patient_id','patient_services.visit_id','patients.f_name','patients.l_name')
            ->where('patient_services.admin_panel_id',1)
            ->where('patient_services.admin_panel_sub_id',3)
            ->where('patient_services.date_reg',$now)
            ->where('patient_services.status','Pending')
            ->orderBy('patient_services.date_reg','asc')
            ->groupBy('patient_services.patient_id','patient_services.visit_id','patients.f_name','patients.l_name')
            ->get();

            $hematology = PatientService::join('patients','patient_services.patient_id','=','patients.id')
            ->select('patient_services.patient_id','patient_services.visit_id','patients.f_name','patients.l_name')
            ->where('patient_services.admin_panel_id',3)
            ->where('patient_services.date_reg',$now)
            ->where('patient_services.status','Pending')
            ->orderBy('patient_services.date_reg','asc')
            ->groupBy('patient_services.patient_id','patient_services.visit_id','patients.f_name','patients.l_name')
            ->get();
            $hematologyservice = PatientService::where('admin_panel_id',3)->where('date_reg',$now)->where('status','Pending')->orderBy('date_reg','asc')->with('xrayservice1001')->get();

            $serology = PatientService::join('patients','patient_services.patient_id','=','patients.id')
            ->select('patient_services.patient_id','patient_services.visit_id','patients.f_name','patients.l_name')
            ->where('patient_services.admin_panel_id',4)
            ->where('patient_services.admin_panel_sub_id','!=',40)
            ->where('patient_services.date_reg',$now)
            ->where('patient_services.status','Pending')
            ->orderBy('patient_services.date_reg','asc')
            ->groupBy('patient_services.patient_id','patient_services.visit_id','patients.f_name','patients.l_name')
            ->get();
            $serologyservice = PatientService::where('admin_panel_id',4)->where('admin_panel_sub_id','!=',40)->where('date_reg',$now)->where('status','Pending')->orderBy('date_reg','asc')->with('xrayservice1001')->get();

            $ecg = PatientService::join('patients','patient_services.patient_id','=','patients.id')
            ->select('patient_services.patient_id','patient_services.visit_id','patients.f_name','patients.l_name')
            ->where('patient_services.admin_panel_id',7)
            ->where('patient_services.admin_panel_sub_id',92)
            ->where('patient_services.date_reg',$now)
            ->where('patient_services.status','Pending')
            ->orderBy('patient_services.date_reg','asc')
            ->groupBy('patient_services.patient_id','patient_services.visit_id','patients.f_name','patients.l_name')
            ->get();

            $chemistryi = PatientService::join('patients','patient_services.patient_id','=','patients.id')
            ->select('patient_services.patient_id','patient_services.visit_id','patients.f_name','patients.l_name')
            ->where('patient_services.admin_panel_id',2)
            ->where('patient_services.date_reg',$now)
            ->where('patient_services.status','Pending')
            ->orderBy('patient_services.date_reg','asc')
            ->groupBy('patient_services.patient_id','patient_services.visit_id','patients.f_name','patients.l_name')
            ->get();
            $chemistryiservice = PatientService::where('admin_panel_id',2)->where('date_reg',$now)->where('status','Pending')->orderBy('date_reg','asc')->with('xrayservice1001')->get();

             $chemistryii = PatientService::join('patients','patient_services.patient_id','=','patients.id')
            ->select('patient_services.patient_id','patient_services.visit_id','patients.f_name','patients.l_name')
            ->where('patient_services.admin_panel_id',8)
            ->where('patient_services.date_reg',$now)
            ->where('patient_services.status','Pending')
            ->orderBy('patient_services.date_reg','asc')
            ->groupBy('patient_services.patient_id','patient_services.visit_id','patients.f_name','patients.l_name')
            ->get();
            $chemistryiiservice = PatientService::where('admin_panel_id',8)->where('date_reg',$now)->where('status','Pending')->orderBy('date_reg','asc')->with('xrayservice1001')->get();

    		return view('queueingpage',compact('xray','xrayservice','urinalysis','pregnancy','fecalysis','amoeba','hematology','hematologyservice','serology','serologyservice','ecg','chemistryii','chemistryiiservice','chemistryi','chemistryiservice','User'));
            
    	}
    	else {
    		return redirect()->action('Auth@checklogin');
    	}
    }
}
