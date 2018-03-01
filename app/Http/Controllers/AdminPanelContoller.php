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
use App\ServicePrice;
use App\PackageService;

class AdminPanelContoller extends Controller
{
    public function adminpanel()
    {
    	return view('adminpanel');
    }

    public function services()
    {
    	$adminpanelcat = AdminPanelCategory::all();
    	$adminpanel = AdminPanel::with('price123')->get();
    	$sub = AdminPanelSub::all();
        //return Response::json($adminpanel, 200, array(), JSON_PRETTY_PRINT);
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
            $income = DB::table('patient_visits')->where('visit_date','>=',$maindate1)->where('visit_date','<=',$maindate2)->sum('discounted_total');
            $Patientxray = Patientxray::where('status','New')->with('patient')->orderBy('id','asc')->orderBy('status','asc')->get();

            $datus = array();
            for($d=1; $d<=31; $d++)
            {
                $time=mktime(12, 0, 0, $datenow_m, $d, $datenow_Y);          
                    if (date('m', $time)==$datenow_m) {
                        $list=date('Y-m-d', $time);
                        $datus[]= PatientVisit::where('visit_date',$list)->where('status','!=','Canceled')->count();
                    } 
            }

            return view('dashboard',compact('info','user','pv','count','pv2','income','Patientxray','week1','week2','week3','week4','week5','datus'));
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
            $now = date("Y-m-d");
            $id_service = $request->input('id_service');
            $subid_service = $request->input('subid_service');
            $name_service = $request->input('name_service');
            $price_service = $request->input('price_service');
            if (!$price_service) {
                $price = 0;
            }
            else {
                $price = $request->input('price_service');
            }

            $editadmin = AdminPanel::where('id',$id_service)->first();
            $editadmin->name = $name_service;
            $editadmin->price = $price;
            $editadmin->type = $request->input('type');
            $editadmin->save();

            $ServicePrice = new ServicePrice;
            $ServicePrice->admin_panel_id = $editadmin->admin_panel_cat_id;
            $ServicePrice->admin_panel_sub_id = $editadmin->id;
            $ServicePrice->price = $price;
            $ServicePrice->date_reg = $now;
            $ServicePrice->save();

            $delete = PackageService::where('package_id',$id_service)->get();
            if (!$delete) {
            }
            else {
                foreach ($delete as $key) {
                    $deldel = PackageService::where('id',$key->id)->first();
                    $deldel->delete();
                }
            }

            if ($request->input('type') == 'Package') {
                $counter = count($request->input('service_name'));
                for ($i=0; $i < $counter; $i++) { 
                    $PackageService = new PackageService;
                    $PackageService->package_id = $editadmin->id;
                    $PackageService->main_id = $request->input('main_id')[$i];
                    $PackageService->service_id = $request->input('service_name')[$i];
                    $PackageService->price = $request->input('service_price')[$i];
                    $PackageService->date_reg = $now;
                    $PackageService->save();
                }
            }

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
            $now = date("Y-m-d");
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
            $AdminPanel->type = $request->input('type');
            $AdminPanel->save();

            $ServicePrice = new ServicePrice;
            $ServicePrice->admin_panel_id = $AdminPanel->admin_panel_cat_id;
            $ServicePrice->admin_panel_sub_id = $AdminPanel->id;
            $ServicePrice->price = $price;
            $ServicePrice->date_reg = $now;
            $ServicePrice->save();

            if ($request->input('type') == 'Package') {
                $counter = count($request->input('service_name'));
                for ($i=0; $i < $counter; $i++) { 
                    $PackageService = new PackageService;
                    $PackageService->package_id = $AdminPanel->id;
                    $PackageService->main_id = $request->input('main_id')[$i];
                    $PackageService->service_id = $request->input('service_name')[$i];
                    $PackageService->price = $request->input('service_price')[$i];
                    $PackageService->date_reg = $now;
                    $PackageService->save();
                }
            }

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

    public function historyservice(Request $request)
    {   
        $main_id = $request->input('main_id');
        $sub_id = $request->input('sub_id');
        $service = ServicePrice::where('admin_panel_sub_id',$main_id)->orderBy('id','DESC')->get();
        return Response::json($service, 200, array(), JSON_PRETTY_PRINT);
    }

    public function allservice(Request $request)
    {   
        if(Session::has('user')){
            $AdminPanel = AdminPanel::all();
            return Response::json($AdminPanel, 200, array(), JSON_PRETTY_PRINT);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function servicepackage(Request $request)
    {   
        if(Session::has('user')){
            $package_id = $request->input('package_id');
            $PackageService = PackageService::where('package_id',$package_id)->with('service')->get();
            return Response::json($PackageService, 200, array(), JSON_PRETTY_PRINT);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }
}
