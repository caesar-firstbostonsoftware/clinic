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
use App\AdminPanelCategory;
use App\AdminPanel;
use App\AdminPanelSub;
use PDF;
use Dompdf\Dompdf;
use TCPDF;

class MYPDF extends TCPDF {
                public function Header() {

                    // $image_file = K_PATH_IMAGES.'logo_example.jpg';
                    // $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

                    $this->SetFont('Courier', 'B', 14);
                    $this->Cell(0, 15, 'NEGROS FAMILY HEALTH SERVICES, INC.', 0, false, 'C', 0, '', 0, false, 'M', 'M');
                    
                    $this->SetXY(0, 18);
                    $this->SetFont('Courier', '', 12);
                    $this->Cell(0, 15, 'NORTH ROAD, DARO (IN FRONT OF NOPH)', 0, false, 'C', 0, '', 0, false, 'M', 'M');

                    $this->SetXY(0, 23);
                    $this->SetFont('Courier', '', 12);
                    $this->Cell(0, 15, 'DUMAGUETE CITY, NEGROS ORIENTAL', 0, false, 'C', 0, '', 0, false, 'M', 'M');

                    $this->SetXY(0, 28);
                    $this->SetFont('Courier', '', 10);
                    $this->Cell(0, 15, 'TEL No. (035)225-3544', 0, false, 'C', 0, '', 0, false, 'M', 'M');
                }

                public function Footer() {

                    $this->SetY(-15);

                    $this->SetFont('Courier', 'I', 8);

                    $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
                }
            }

class DoctorsController extends Controller
{
    
    public function printreport(Request $request,$id,$datefrom,$dateto)
    {   
        if(Session::has('user')){

            $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetTitle('NFHSI X-Ray');

            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            $pdf->SetMargins(10, 36, 10, true);
            $pdf->SetHeaderMargin(12);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                require_once(dirname(__FILE__).'/lang/eng.php');
                $pdf->setLanguageArray($l);
            }

            $pdf->SetFont('Courier', '', 10);

            $pdf->AddPage();

                if ($id == 1) {
                    $Patientxray = DB::select("SELECT 
                    doctors.id,doctors.f_name,doctors.m_name,doctors.l_name,credential,patients.id as p_id,patients.f_name AS p_fname,patients.m_name AS p_mname,patients.l_name AS p_lname,COUNT(doctors.id) as counter
                    FROM doctors
                    INNER JOIN patientxrays ON doctors.id = patientxrays.physician_id
                    INNER JOIN patients ON patientxrays.patient_id = patients.id
                    WHERE patientxrays.xray_date >= '$datefrom' AND patientxrays.xray_date <= '$dateto'
                    GROUP BY id,f_name,m_name,l_name,credential,patients.id,patients.f_name,patients.m_name,patients.l_name");
                    $counter = 0;
                }
                else {
                    $Patientxray = Patientxray::where('physician_id',$id)->where('xray_date','>=',$datefrom)->where('xray_date','<=',$dateto)->with('doctor','patient')->get();
                    $counter = count($Patientxray);
                }

                // return Response::json($Patientxray, 200, array(), JSON_PRETTY_PRINT);

            $pdf->writeHTML(view('printreport',compact('Patientxray','id','counter'))->render());
            ob_end_clean();
            $pdf->Output('DocReport.pdf','I');

        }
        else {
            return redirect()->action('Auth@checklogin');
        }
        
    }

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
                //$Patientxray = Patientxray::where('xray_date','>=',$datefrom)->where('xray_date','<=',$dateto)->with('doctor','patient')->get();
                $Patientxray = DB::select("SELECT 
                    doctors.id,doctors.f_name,doctors.m_name,doctors.l_name,credential,patients.id as p_id,patients.f_name AS p_fname,patients.m_name AS p_mname,patients.l_name AS p_lname,COUNT(doctors.id) as counter
                    FROM doctors
                    INNER JOIN patientxrays ON doctors.id = patientxrays.physician_id
                    INNER JOIN patients ON patientxrays.patient_id = patients.id
                    WHERE patientxrays.xray_date >= '$datefrom' AND patientxrays.xray_date <= '$dateto'
                    GROUP BY id,f_name,m_name,l_name,credential,patients.id,patients.f_name,patients.m_name,patients.l_name");

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
