<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use Response;
use App\Doctor;
use App\Patientxray;

class DoctorsController extends Controller
{
    public function doctorspatientlist()
    {	
    	$doctor_id = 2;
    	//$xray = Doctor::where('id',$doctor_id)->with('xray_p')->first();
    	$xray = Doctor::join('patientxrays','doctors.id','=','patientxrays.physician_id')
    	->leftJoin('patients','patientxrays.patient_id','=','patients.id')
    	->where('doctors.id',$doctor_id)
    	->select('patients.*')
    	->get();
    	//return Response::json($xray, 200, array(), JSON_PRETTY_PRINT);
    	//$patientlist = Patient::all();
    	return view('doctorspatientpage',compact('xray'));
    }
}
