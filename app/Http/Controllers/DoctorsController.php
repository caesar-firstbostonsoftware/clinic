<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use Response;
use App\Doctor;
use App\Patientxray;
use Session;
use App\User;

class DoctorsController extends Controller
{
    public function myinfo()
    {   
        if(Session::has('user')){
            $doctor_id = Session::get('user');
            $info = Doctor::where('id',$doctor_id)->first();
            $user = User::where('doc_id',$doctor_id)->first();
            return view('doctormyinfopage',compact('info','user'));
        }
        else {
            return view('welcome');
        }
        
    }

    // public function doctorspatientlist()
    // {	
    // 	$doctor_id = 2;
    // 	//$xray = Doctor::where('id',$doctor_id)->with('xray_p')->first();
    // 	$xray = Doctor::join('patientxrays','doctors.id','=','patientxrays.physician_id')
    // 	->leftJoin('patients','patientxrays.patient_id','=','patients.id')
    // 	->where('doctors.id',$doctor_id)
    // 	->select('patients.*')
    // 	->get();
    // 	//return Response::json($xray, 200, array(), JSON_PRETTY_PRINT);
    // 	//$patientlist = Patient::all();
    // 	return view('doctorspatientpage',compact('xray'));
    // }

    public function userdoctorpage()
    {   
        if(Session::has('user')){
            $users = User::join('doctors','users.doc_id','=','doctors.id')
            ->select('doctors.*')
            ->get();
            return view('userdoctorpage',compact('users'));
        }
        else {
            return view('welcome');
        }
        
    }

    public function adduserdoctorpage(Request $request)
    {   
        if(Session::has('user')){
            $fname = $request->input('fname');
            $mname = $request->input('mname');
            $lname = $request->input('lname');
            $credential = $request->input('credential');
            $specialization = $request->input('specialization');
            $address = $request->input('address');
            $email = $request->input('email');
            $username = $request->input('username');
            $password = bcrypt($request->input('password'));
            
            $doctor = new Doctor;
            $doctor->f_name = $fname;
            $doctor->m_name = $mname;
            $doctor->l_name = $lname;
            $doctor->credential = $credential;
            $doctor->specialization = $specialization;
            $doctor->address = $address;
            $doctor->email = $email;
            $doctor->save();

            $user = new User;
            $user->doc_id = $doctor->id;
            $user->username = $username;
            $user->password = $password;
            $user->save();

            $users = User::join('doctors','users.doc_id','=','doctors.id')
            ->select('doctors.*')
            ->get();
            return view('userdoctorpage',compact('users'));
        }
        else {
            return view('welcome');
        }
        
    }
}
