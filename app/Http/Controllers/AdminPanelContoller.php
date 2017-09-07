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
            return view('dashboard',compact('info','user'));
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
        
    }
}
