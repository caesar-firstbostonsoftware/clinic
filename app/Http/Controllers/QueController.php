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
        	// $xray = PatientService::where('admin_panel_id',5)->where('date_reg',$now)->where('status','Pending')->orderBy('date_reg','asc')->with('patient')->get();
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

            $chemistryi = DB::select("SELECT patients.f_name,patients.m_name,patients.l_name,patient_services.admin_panel_id,patient_services.patient_id,patient_services.visit_id
            FROM patient_services
            INNER JOIN patients ON patient_services.patient_id = patients.id
            WHERE patient_services.date_reg = '$now' AND patient_services.status = 'Pending' AND patient_services.admin_panel_id = 7 OR patient_services.admin_panel_sub_id = 4 OR patient_services.admin_panel_sub_id = 10 OR patient_services.admin_panel_sub_id = 11 OR patient_services.admin_panel_sub_id = 8 OR patient_services.admin_panel_sub_id = 12 OR patient_services.admin_panel_sub_id = 13 OR patient_services.admin_panel_sub_id = 14 OR patient_services.admin_panel_sub_id = 15 OR patient_services.admin_panel_sub_id = 16 OR patient_services.admin_panel_sub_id = 17 OR patient_services.admin_panel_sub_id = 20 OR patient_services.admin_panel_sub_id = 21 OR patient_services.admin_panel_sub_id = 22 OR patient_services.admin_panel_sub_id = 23 OR patient_services.admin_panel_sub_id = 24 OR patient_services.admin_panel_sub_id = 25 OR patient_services.admin_panel_sub_id = 26 OR patient_services.admin_panel_sub_id = 27 OR patient_services.admin_panel_sub_id = 28 OR patient_services.admin_panel_sub_id = 29 OR patient_services.admin_panel_sub_id = 30
            GROUP By patients.f_name,patients.m_name,patients.l_name,patient_services.admin_panel_id,patient_services.patient_id,patient_services.visit_id
            ORDER BY patient_services.date_reg ASC");

            $chemistryii = DB::select("SELECT patients.f_name,patients.m_name,patients.l_name,patient_services.admin_panel_id,patient_services.patient_id,patient_services.visit_id
            FROM patient_services
            INNER JOIN patients ON patient_services.patient_id = patients.id
            WHERE patient_services.date_reg = '$now' AND patient_services.status = 'Pending' AND patient_services.admin_panel_id = 7 OR patient_services.admin_panel_sub_id = 5 OR patient_services.admin_panel_sub_id = 6 OR patient_services.admin_panel_sub_id = 7 OR patient_services.admin_panel_sub_id = 8 OR patient_services.admin_panel_sub_id = 9 OR patient_services.admin_panel_sub_id = 18 OR patient_services.admin_panel_sub_id = 19
            GROUP By patients.f_name,patients.m_name,patients.l_name,patient_services.admin_panel_id,patient_services.patient_id,patient_services.visit_id
            ORDER BY patient_services.date_reg ASC");

        	// $fecalysis = DB::select("SELECT patients.f_name, patients.m_name, patients.l_name,patient_services.admin_panel_id
        	// 	FROM patient_services
        	// 	INNER JOIN patients ON patient_services.patient_id = patients.id
        	// 	WHERE patient_services.date_reg = '$now' AND patient_services.status = 'Pending'");
        	// $chemistryii = DB::select("SELECT patients.f_name, patients.m_name, patients.l_name,patient_services.admin_panel_id
        	// 	FROM patient_services
        	// 	INNER JOIN patients ON patient_services.patient_id = patients.id
        	// 	WHERE patient_services.date_reg = '$now' AND patient_services.status = 'Pending'");
        	// $ogtt = DB::select("SELECT patients.f_name, patients.m_name, patients.l_name,patient_services.admin_panel_id
        	// 	FROM patient_services
        	// 	INNER JOIN patients ON patient_services.patient_id = patients.id
        	// 	WHERE patient_services.date_reg = '$now' AND patient_services.status = 'Pending'");
        	// $hematology = DB::select("SELECT patients.f_name, patients.m_name, patients.l_name,patient_services.admin_panel_id,patients.id,patient_services.visit_id
        	// 	FROM patient_services
        	// 	INNER JOIN patients ON patient_services.patient_id = patients.id
        	// 	WHERE patient_services.date_reg = '$now' AND patient_services.status = 'Pending'");
        	//return Response::json($chemistryii, 200, array(), JSON_PRETTY_PRINT);
    		return view('queueingpage',compact('xray','xrayservice','urinalysis','pregnancy','fecalysis','amoeba','hematology','hematologyservice','serology','serologyservice','ecg','chemistryii','chemistryi','User'));
    	}
    	else {
    		return redirect()->action('Auth@checklogin');
    	}
    }
}
