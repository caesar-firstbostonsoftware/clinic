<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Session;
use App\AdminPanelCategory;
use App\AdminPanel;
use App\AdminPanelSub;

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
}
