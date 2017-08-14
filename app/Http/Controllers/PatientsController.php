<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Patientxray;
use App\PatientVisit;
use Response;
use App\Doctor;

class PatientsController extends Controller
{

	public function newvisit()
    {
    	return view('patientnewvisitpage');
    }

    public function addnewvisit(Request $request)
    {
    	$fname = $request->input('fname');
    	$mname = $request->input('mname');
    	$lname = $request->input('lname');
    	$address = $request->input('address');
    	$gender = $request->input('gender');
    	$dob = $request->input('dob');
    	$age = $request->input('age');
    	//return $fname.' *** '.$mname.' *** '.$lname.' *** '.$address.' *** '.$gender.' *** '.$dob.' *** '.$age;
    	$patient = new Patient;
    	$patient->f_name = $fname;
    	$patient->m_name = $mname;
    	$patient->l_name = $lname;
    	$patient->gender = $gender;
    	$patient->dob = $dob;
    	$patient->age = $age;
    	$patient->address = $address;
    	$patient->save();

    	$patientvisit = new PatientVisit;
    	$patientvisit->patient_id = $patient->id;
    	$datenow = date("Y-m-d");
    	$patientvisit->visit_date = $datenow;
    	$patientvisit->visitid = 1;
    	$patientvisit->save();

    	return redirect()->action('PatientsController@patientvisitpage',['id' => $patient->id, 'vid' => $patientvisit->visitid]);
    }

	public function patientlist()
    {
    	$patientlist = Patient::all();
    	return view('patientlistpage',compact('patientlist'));
    }

	public function patientvisitpage($id,$vid)
    {
    	$patientxray = Patientxray::where('patient_id',$id)->where('visitid',$vid)->get();
    	$patient = Patient::where('id',$id)->first();
    	$doctor = Doctor::all();
    	return view('patientvisitpage',compact('id','vid','patientxray','patient','doctor'));
    }

	public function newpatientxray(Request $request, $id, $vid)
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
     	$patientxray->visitid = $vid;
     	$patientxray->save();
	
    	return redirect()->action('PatientsController@patientvisitpage',['id' => $id, 'vid' => $vid]);
    }

    public function modalavisit(Request $request)
    {	
    	$p_id = $request->input('p_id');
    	$patientvisit = PatientVisit::where('patient_id',$p_id)->get();
    	return Response::json($patientvisit, 200, array(), JSON_PRETTY_PRINT);
    }
    
}
