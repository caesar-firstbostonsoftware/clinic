<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patientxray;

class PatientsController extends Controller
{
	public function patientxray($id)
    {	
    	return view('patientvisitpage',compact('id'));
    }

	public function newpatientxray(Request $request, $id)
    {	
    	$P_id = $request->input('P_id');
    	$P_name = $request->input('P_name');
    	$orno = $request->input('orno');
    	$address = $request->input('address');
    	$agesex = $request->input('agesex');
    	$physician = $request->input('physician');
    	// $broken = explode('-', $physician);
    	// $phyname = $broken[0];
    	// $phypos = $broken[1];
    	$xraydate = $request->input('xraydate');
    	$finding = $request->input('finding');
    	$comm = $request->input('comm');
     	
     	$patientxray = new Patientxray;
     	$patientxray->patient_id = $P_id;
     	$patientxray->or_no = $orno;
     	$patientxray->physician_id = $physician;
     	$patientxray->xray_date = $xraydate;
     	$patientxray->finding = $finding;
     	$patientxray->finding_info = $comm;
     	$patientxray->save();
	
    	return redirect()->action('PatientsController@patientxray',$P_id);
    }
    
}
