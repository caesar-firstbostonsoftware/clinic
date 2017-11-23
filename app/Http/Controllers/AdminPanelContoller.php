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
use App\Patientxray;

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
                    WHERE patient_visits.visit_date >= '$maindate1' AND patient_visits.visit_date <= '$maindate2' AND patient_visits.status != 'Canceled'
                    GROUP BY patient_visits.patient_id,patients.f_name,patients.m_name,patients.l_name,patients.address,patients.gender,patients.age");
            $count = count($pv);

            $pv2 = PatientVisit::where('visit_date','>=',$maindate1)->where('visit_date','<=',$maindate2)->where('status','!=','Canceled')->with('patient')->get();
            $income = DB::table('patient_visits')->where('visit_date','>=',$maindate1)->where('visit_date','<=',$maindate2)->sum('totalbill');
            $Patientxray = Patientxray::where('status','New')->with('patient')->orderBy('id','asc')->orderBy('status','asc')->get();

            $day1 = $datenow_Y.'-'.$datenow_m.'-01';
            $day7 = $datenow_Y.'-'.$datenow_m.'-07';
            $day08 = $datenow_Y.'-'.$datenow_m.'-08';
            $day14 = $datenow_Y.'-'.$datenow_m.'-14';
            $day15 = $datenow_Y.'-'.$datenow_m.'-15';
            $day21 = $datenow_Y.'-'.$datenow_m.'-21';
            $day22 = $datenow_Y.'-'.$datenow_m.'-22';
            $day28 = $datenow_Y.'-'.$datenow_m.'-28';
            $day29 = $datenow_Y.'-'.$datenow_m.'-29';
            $day31 = $datenow_Y.'-'.$datenow_m.'-31';

            $week1 = PatientVisit::where('visit_date','>=',$day1)->where('visit_date','<=',$day7)->where('status','!=','Canceled')->count();
            $week2 = PatientVisit::where('visit_date','>=',$day08)->where('visit_date','<=',$day14)->where('status','!=','Canceled')->count();
            $week3 = PatientVisit::where('visit_date','>=',$day15)->where('visit_date','<=',$day21)->where('status','!=','Canceled')->count();
            $week4 = PatientVisit::where('visit_date','>=',$day22)->where('visit_date','<=',$day28)->where('status','!=','Canceled')->count();
            $week5 = PatientVisit::where('visit_date','>=',$day29)->where('visit_date','<=',$day31)->where('status','!=','Canceled')->count();

            //return Response::json($pv, 200, array(), JSON_PRETTY_PRINT);

            return view('dashboard',compact('info','user','pv','count','pv2','income','Patientxray','week1','week2','week3','week4','week5'));
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
            $name_service = $request->input('name_service');
            $price_service = $request->input('price_service');

            $editadmin = AdminPanel::where('id',$id_service)->first();
            $editadmin->name = $name_service;
            $editadmin->price = $price_service;
            $editadmin->save();

            return redirect()->action('AdminPanelContoller@services');
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function addmain(Request $request)
    {
        if(Session::has('user')){
            $sersermain = $request->input('sersermain');

            $AdminPanelCategory = new AdminPanelCategory;
            $AdminPanelCategory->cat_name = $sersermain;
            $AdminPanelCategory->save();

            return redirect()->action('AdminPanelContoller@services');
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function subadd(Request $request)
    {
        if(Session::has('user')){
            $sub_mainedit_id = $request->input('sub_mainedit_id');
            $subname = $request->input('subname');
            $price_service = $request->input('price_service');
            if (!$price_service) {
                $price = 0;
            }
            else {
                $price = $request->input('price_service');
            }

            $AdminPanel = new AdminPanel;
            $AdminPanel->admin_panel_cat_id = $sub_mainedit_id;
            $AdminPanel->name = $subname;
            $AdminPanel->price = $price;
            $AdminPanel->save();

            return redirect()->action('AdminPanelContoller@services');
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function editmain(Request $request)
    {
        if(Session::has('user')){
            $mainedit_id = $request->input('mainedit_id');
            $mainedit_name = $request->input('mainedit_name');

            $AdminPanelCategory = AdminPanelCategory::where('id',$mainedit_id)->first();
            $AdminPanelCategory->cat_name = $mainedit_name;
            $AdminPanelCategory->save();

            return redirect()->action('AdminPanelContoller@services');
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }
}
