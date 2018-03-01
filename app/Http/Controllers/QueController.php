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
use App\PackageService;
use App\ForQueue;

class QueController extends Controller
{
    public function queueing()
    {
    	if(Session::has('user')){

    		$now = date("Y-m-d");
            $user_id = Session::get('user');
            $User = User::where('doc_id',$user_id)->first();
            $xray = ForQueue::join('patients','for_queues.patient_id','=','patients.id')
            ->select('for_queues.patient_id','for_queues.visit_id','patients.f_name','patients.l_name')
            ->where('for_queues.admin_panel_id',5)
            ->where('for_queues.date_reg',$now)
            ->where('for_queues.status','Pending')
            ->orderBy('for_queues.date_reg','asc')
            ->groupBy('for_queues.patient_id','for_queues.visit_id','patients.f_name','patients.l_name')
            ->get();
            $xrayservice = ForQueue::where('admin_panel_id',5)->where('date_reg',$now)->where('status','Pending')->orderBy('date_reg','asc')->with('xrayservice1001')->get();

            $urinalysis = ForQueue::join('patients','for_queues.patient_id','=','patients.id')
            ->select('for_queues.patient_id','for_queues.visit_id','patients.f_name','patients.l_name')
            ->where('for_queues.admin_panel_id',1)
            ->where('for_queues.admin_panel_sub_id',1)
            ->where('for_queues.date_reg',$now)
            ->where('for_queues.status','Pending')
            ->orderBy('for_queues.date_reg','asc')
            ->groupBy('for_queues.patient_id','for_queues.visit_id','patients.f_name','patients.l_name')
            ->get();

            $pregnancy = ForQueue::join('patients','for_queues.patient_id','=','patients.id')
            ->select('for_queues.patient_id','for_queues.visit_id','patients.f_name','patients.l_name')
            ->where('for_queues.admin_panel_id',4)
            ->where('for_queues.admin_panel_sub_id',40)
            ->where('for_queues.date_reg',$now)
            ->where('for_queues.status','Pending')
            ->orderBy('for_queues.date_reg','asc')
            ->groupBy('for_queues.patient_id','for_queues.visit_id','patients.f_name','patients.l_name')
            ->get();

            $fecalysis = ForQueue::join('patients','for_queues.patient_id','=','patients.id')
            ->select('for_queues.patient_id','for_queues.visit_id','patients.f_name','patients.l_name')
            ->where('for_queues.admin_panel_id',1)
            ->where('for_queues.admin_panel_sub_id',2)
            ->where('for_queues.date_reg',$now)
            ->where('for_queues.status','Pending')
            ->orderBy('for_queues.date_reg','asc')
            ->groupBy('for_queues.patient_id','for_queues.visit_id','patients.f_name','patients.l_name')
            ->get();

            $amoeba = ForQueue::join('patients','for_queues.patient_id','=','patients.id')
            ->select('for_queues.patient_id','for_queues.visit_id','patients.f_name','patients.l_name')
            ->where('for_queues.admin_panel_id',1)
            ->where('for_queues.admin_panel_sub_id',3)
            ->where('for_queues.date_reg',$now)
            ->where('for_queues.status','Pending')
            ->orderBy('for_queues.date_reg','asc')
            ->groupBy('for_queues.patient_id','for_queues.visit_id','patients.f_name','patients.l_name')
            ->get();

            $hematology = ForQueue::join('patients','for_queues.patient_id','=','patients.id')
            ->select('for_queues.patient_id','for_queues.visit_id','patients.f_name','patients.l_name')
            ->where('for_queues.admin_panel_id',3)
            ->where('for_queues.date_reg',$now)
            ->where('for_queues.status','Pending')
            ->orderBy('for_queues.date_reg','asc')
            ->groupBy('for_queues.patient_id','for_queues.visit_id','patients.f_name','patients.l_name')
            ->get();
            $hematologyservice = ForQueue::where('admin_panel_id',3)->where('date_reg',$now)->where('status','Pending')->orderBy('date_reg','asc')->with('xrayservice1001')->get();

            $serology = ForQueue::join('patients','for_queues.patient_id','=','patients.id')
            ->select('for_queues.patient_id','for_queues.visit_id','patients.f_name','patients.l_name')
            ->where('for_queues.admin_panel_id',4)
            ->where('for_queues.admin_panel_sub_id','!=',40)
            ->where('for_queues.date_reg',$now)
            ->where('for_queues.status','Pending')
            ->orderBy('for_queues.date_reg','asc')
            ->groupBy('for_queues.patient_id','for_queues.visit_id','patients.f_name','patients.l_name')
            ->get();
            $serologyservice = ForQueue::where('admin_panel_id',4)->where('admin_panel_sub_id','!=',40)->where('date_reg',$now)->where('status','Pending')->orderBy('date_reg','asc')->with('xrayservice1001')->get();

            $ecg = ForQueue::join('patients','for_queues.patient_id','=','patients.id')
            ->select('for_queues.patient_id','for_queues.visit_id','patients.f_name','patients.l_name')
            ->where('for_queues.admin_panel_id',7)
            ->where('for_queues.admin_panel_sub_id',92)
            ->where('for_queues.date_reg',$now)
            ->where('for_queues.status','Pending')
            ->orderBy('for_queues.date_reg','asc')
            ->groupBy('for_queues.patient_id','for_queues.visit_id','patients.f_name','patients.l_name')
            ->get();

            $chemistryi = ForQueue::join('patients','for_queues.patient_id','=','patients.id')
            ->select('for_queues.patient_id','for_queues.visit_id','patients.f_name','patients.l_name')
            ->where('for_queues.admin_panel_id',2)
            ->where('for_queues.date_reg',$now)
            ->where('for_queues.status','Pending')
            ->orderBy('for_queues.date_reg','asc')
            ->groupBy('for_queues.patient_id','for_queues.visit_id','patients.f_name','patients.l_name')
            ->get();
            $chemistryiservice = ForQueue::where('admin_panel_id',2)->where('date_reg',$now)->where('status','Pending')->orderBy('date_reg','asc')->with('xrayservice1001')->get();

             $chemistryii = ForQueue::join('patients','for_queues.patient_id','=','patients.id')
            ->select('for_queues.patient_id','for_queues.visit_id','patients.f_name','patients.l_name')
            ->where('for_queues.admin_panel_id',10)
            ->where('for_queues.date_reg',$now)
            ->where('for_queues.status','Pending')
            ->orderBy('for_queues.date_reg','asc')
            ->groupBy('for_queues.patient_id','for_queues.visit_id','patients.f_name','patients.l_name')
            ->get();
            $chemistryiiservice = ForQueue::where('admin_panel_id',10)->where('date_reg',$now)->where('status','Pending')->orderBy('date_reg','asc')->with('xrayservice1001')->get();

    		return view('queueingpage',compact('xray','xrayservice','urinalysis','pregnancy','fecalysis','amoeba','hematology','hematologyservice','serology','serologyservice','ecg','chemistryii','chemistryiiservice','chemistryi','chemistryiservice','User'));
            
    	}
    	else {
    		return redirect()->action('Auth@checklogin');
    	}
    }
}
