<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use Response;
use App\Doctor;
use App\Patientxray;
use Session;
use App\User;
use App\Urinalyses;
use DB;

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
            return redirect()->action('Auth@checklogin');
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
            return redirect()->action('Auth@checklogin');
        }
        
    }

    public function adduserdoctorpage(Request $request)
    {   
        if(Session::has('user')){

            $user_id = $request->input('user_id');
            $fname = $request->input('fname');
            $mname = $request->input('mname');
            $lname = $request->input('lname');
            $credential = $request->input('credential');
            $specialization = $request->input('specialization');
            $address = $request->input('address');
            $email = $request->input('email');
            $username = $request->input('username');
            $password = bcrypt($request->input('password'));
            $position = $request->input('position');

            if (!$user_id) {
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
                $user->position = $position;
                $user->save();

                $users = User::join('doctors','users.doc_id','=','doctors.id')
                ->select('doctors.*')
                ->get();

                Session::flash('alert-success', 'User Created.');
                return view('userdoctorpage',compact('users'));
            }
            else {
                $doctor = Doctor::where('id',$user_id)->first();
                $doctor->f_name = $fname;
                $doctor->m_name = $mname;
                $doctor->l_name = $lname;
                $doctor->credential = $credential;
                $doctor->specialization = $specialization;
                $doctor->address = $address;
                $doctor->email = $email;
                $doctor->save();

                $user = User::where('doc_id',$user_id)->first();
                $user->username = $username;
                $user->password = $password;
                $user->position = $position;
                $user->save();

                $users = User::join('doctors','users.doc_id','=','doctors.id')
                ->select('doctors.*')
                ->get();

                Session::flash('alert-success', 'User Edited.');
                return view('userdoctorpage',compact('users'));
            }

        }
        else {

            return redirect()->action('Auth@checklogin');

        } 
    }

    public function editmyinfo(Request $request)
    {   
        if(Session::has('user')){
            $doc_id = $request->input('doc_id');
            $fname = $request->input('fname');
            $mname = $request->input('mname');
            $lname = $request->input('lname');
            $credential = $request->input('credential');
            $specialization = $request->input('specialization');
            $address = $request->input('address');
            $email = $request->input('email');
            $username = $request->input('username');
            $password = bcrypt($request->input('password'));
            
            $doctor = Doctor::where('id',$doc_id)->first();
            $doctor->f_name = $fname;
            $doctor->m_name = $mname;
            $doctor->l_name = $lname;
            $doctor->credential = $credential;
            $doctor->specialization = $specialization;
            $doctor->address = $address;
            $doctor->email = $email;
            $doctor->save();

            $user = User::where('doc_id',$doctor->id)->first();
            $user->username = $username;
            if ($request->input('password') != "") {
                $user->password = $password;
            }
            $user->save();

            Session::flash('alert-success', 'My Info Edited.');
            return redirect()->action('DoctorsController@myinfo');
        }
        else {
            return redirect()->action('Auth@checklogin');
        } 
    }

    public function getuserinfo(Request $request)
    {      
        if(Session::has('user')){
            $user_id = $request->input('user_id');
            $Doctor = Doctor::where('id',$user_id)->with('user')->first();

            return Response::json($Doctor, 200, array(), JSON_PRETTY_PRINT);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function reports(Request $request, $id)
    {   
        if(Session::has('user')){
            return view('reports',compact('id'));
        }
        else {
            return redirect()->action('Auth@checklogin');
        } 
    }

    public function reportsreports(Request $request)
    {      
        if(Session::has('user')){
            $id = $request->input('id');
            $datefrom = $request->input('datefrom');
            $dateto = $request->input('dateto');
            if ($id == 1) {
                $Patientxray = Patientxray::where('xray_date','>=',$datefrom)->where('xray_date','<=',$dateto)->with('doctor','patient')->get();
                // $Urinalyses = Urinalyses::where('date','>=',$datefrom)->where('date','<=',$dateto)->with('phy','patient')->get();

                // $wawee = DB::select("select query.patient_id as patient_id, patients.f_name as P_f_name, patients.m_name as P_m_name,
                //         patients.l_name as P_l_name,query.date as date, doctors.f_name as D_f_name, doctors.m_name as D_m_name,
                //         doctors.l_name as D_l_name, doctors.credential as D_credential

                //         from ((select patient_id, physician_id, xray_date as date from patientxrays 
                //         where xray_date >= '$datefrom' and xray_date <= '$dateto') 
                //         union 
                //         (select patient_id, physician_id, date from urinalyses
                //         where date >= '$datefrom' and date <= '$dateto')) 
                //         as query


                //         left join patients on query.patient_id = patients.id
                //         left join doctors on query.physician_id = doctors.id");
            }
            else {
                $Patientxray = Patientxray::where('physician_id',$id)->where('xray_date','>=',$datefrom)->where('xray_date','<=',$dateto)->with('doctor','patient')->get();
                // $wawee = DB::select("select query.patient_id as patient_id, patients.f_name as P_f_name, patients.m_name as P_m_name,
                //         patients.l_name as P_l_name,query.date as date, doctors.f_name as D_f_name, doctors.m_name as D_m_name,
                //         doctors.l_name as D_l_name, doctors.credential as D_credential

                //         from ((select patient_id, physician_id, xray_date as date from patientxrays 
                //         where xray_date >= '$datefrom' and xray_date <= '$dateto' and physician_id = '$id') 
                //         union 
                //         (select patient_id, physician_id, date from urinalyses
                //         where date >= '$datefrom' and date <= '$dateto' and physician_id = '$id')) 
                //         as query

                //         left join patients on query.patient_id = patients.id
                //         left join doctors on query.physician_id = doctors.id");
            }

            return Response::json($Patientxray, 200, array(), JSON_PRETTY_PRINT);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

}
