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

    public function editservice(Request $request)
    {   
        $main_id = $request->input('main_id');
        $sub_id = $request->input('sub_id');
        if ($main_id != 0 && $sub_id == 0) {
           $service = AdminPanel::where('id',$main_id)->first();
        }
        else {
            $service = AdminPanelSub::where('admin_panel_id',$main_id)->where('id',$sub_id)->first();
        }
        return Response::json($service, 200, array(), JSON_PRETTY_PRINT);
    }

    public function editservicepost(Request $request)
    {
        if(Session::has('user')){
            $id_service = $request->input('id_service');
            $subid_service = $request->input('subid_service');
            $price_service = $request->input('price_service');

            if ($id_service != 0 && $subid_service == 0) {
                $editadmin = AdminPanel::where('id',$id_service)->first();
                $editadmin->price = $price_service;
                $editadmin->save();
            }
            else {
                $editadmin = AdminPanelSub::where('id',$id_service)->where('admin_panel_id',$subid_service)->first();
                $editadmin->price = $price_service;
                $editadmin->save();
            }

            $adminpanelcat = AdminPanelCategory::all();
            $adminpanel = AdminPanel::all();
            $sub = AdminPanelSub::all();
            return redirect()->action('AdminPanelContoller@services');
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }
}
