<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Session;
use App\AdminPanelCategory;
use App\AdminPanel;
use App\AdminPanelSub;
use App\Doctor;
use App\User;
use App\PatientVisit;
use DB;

class AdminPanelContoller extends Controller
{
    public function adminpanel()
    {
    	return view('adminpanel');
    }

    public function services()
    {
    	$adminpanelcat = AdminPanelCategory::all();
    	$adminpanel = AdminPanel::all();
    	$sub = AdminPanelSub::all();
    	return view('adminpanelservices',compact('adminpanelcat','adminpanel','sub'));
    }

    // ------DashBoard---
    public function dashboard()
    {   
        if(Session::has('user')){
            $doctor_id = Session::get('user');
            $info = Doctor::where('id',$doctor_id)->first();
            $user = User::where('doc_id',$doctor_id)->first();
            $datenow_Y = date("Y");
            $datenow_m = date("m");
            $maindate1 = $datenow_Y.'-'.$datenow_m.'-01';
            $maindate2 = $datenow_Y.'-'.$datenow_m.'-31';

            //$PatientVisit = PatientVisit::where('visit_date','>=',$maindate1)->where('visit_date','<=',$maindate2)->get();
            $pv = DB::select("SELECT patient_visits.patient_id AS patient_id,COUNT(patient_visits.id) as counter,
                    patients.f_name AS f_name,patients.m_name AS m_name,patients.l_name AS l_name,
                    patients.address AS address,patients.gender AS gender,patients.age AS age
                    FROM patient_visits
                    INNER JOIN patients ON patient_visits.patient_id = patients.id
                    WHERE patient_visits.visit_date >= '$maindate1' AND patient_visits.visit_date <= '$maindate2'
                    GROUP BY patient_visits.patient_id,patients.f_name,patients.m_name,patients.l_name,patients.address,patients.gender,patients.age");
            $count = count($pv);

            $pv2 = PatientVisit::where('visit_date','>=',$maindate1)->where('visit_date','<=',$maindate2)->with('patient')->get();
            $income = DB::table('patient_visits')->where('visit_date','>=',$maindate1)->where('visit_date','<=',$maindate2)->sum('totalbill');

            //return Response::json($pv, 200, array(), JSON_PRETTY_PRINT);

            return view('dashboard',compact('info','user','pv','count','pv2','income'));
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
        
    }
}
