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
use App\PatientVisit;
use App\UserPicture;

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
        $pdf->SetTitle('NFHSI Income Report');

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

        if (Session::get('position') == 'Cashier') {
            $Patientxray = DB::select("SELECT patient_visits.visit_date AS visit_date,COUNT(patient_visits.id) as counter
            FROM patient_visits
            WHERE patient_visits.visit_date >= '$datefrom' AND patient_visits.visit_date <= '$dateto' AND patient_visits.cashier_id = '$id'
            GROUP BY patient_visits.visit_date");
            $counter = 0;
            $income = DB::table('patient_visits')->where('visit_date','>=',$datefrom)->where('visit_date','<=',$dateto)->where('cashier_id',$id)->sum('discounted_total');
        }
        else {
            $Patientxray = DB::select("SELECT patient_visits.visit_date AS visit_date,COUNT(patient_visits.id) as counter
            FROM patient_visits
            WHERE patient_visits.visit_date >= '$datefrom' AND patient_visits.visit_date <= '$dateto'
            GROUP BY patient_visits.visit_date");
            $counter = 0;
            $income = DB::table('patient_visits')->where('visit_date','>=',$datefrom)->where('visit_date','<=',$dateto)->sum('discounted_total');
        }

        $pdf->writeHTML(view('printreport',compact('Patientxray','id','counter','income','datefrom','dateto'))->render());
        ob_end_clean();
        $pdf->Output('NFHSIIncomeReport.pdf','I');

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
            ->where('users.position','!=','Doctor')
            ->select('doctors.*','users.username','users.position','users.doc_id')
            ->with('user_picture')
            ->get();
            return view('userdoctorpage',compact('users'));

        }
        else {
            return redirect()->action('Auth@checklogin');
        }
        
    }

    public function doctoruserpage()
    {   
        if(Session::has('user')){

            $users = User::join('doctors','users.doc_id','=','doctors.id')
            ->where('users.position','Doctor')
            ->select('doctors.*','users.username','users.position')
            ->get();
            return view('doctoruserpage',compact('users'));

        }
        else {
            return redirect()->action('Auth@checklogin');
        }
        
    }

    public function adduserdoctorpage(Request $request)
    {   
        if(Session::has('user')){

            $datenow = date("Y-m-d");
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

                if ($user->position == 'Doctor') {
                    $users = User::join('doctors','users.doc_id','=','doctors.id')
                    ->where('users.position','Doctor')
                    ->select('doctors.*','users.username','users.position')
                    ->get();
                    Session::flash('alert-success', 'Doctor Created.');
                    return redirect()->action('DoctorsController@doctoruserpage');
                }
                else {
                    $users = User::join('doctors','users.doc_id','=','doctors.id')
                    ->where('users.position','!=','Doctor')
                    ->select('doctors.*','users.username','users.position')
                    ->get();
                    Session::flash('alert-success', 'User Created.');
                    return redirect()->action('DoctorsController@userdoctorpage');
                }

                if (!$request->file('image')) {
                }
                else {
                    $imageName = 'user'.'_'.$doctor->id.'_'.$request->file('image')->getClientOriginalName();

                    $UserPicture = new UserPicture;
                    $UserPicture->user_id = $doctor->id;
                    $UserPicture->image_desc = $imageName;
                    $UserPicture->date_uploaded = $datenow;
                    $UserPicture->save();

                    $request->file('image')->move(base_path() . '/public/user_pics/', $imageName);
                }
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

                if ($user->position == 'Doctor') {
                    $users = User::join('doctors','users.doc_id','=','doctors.id')
                    ->where('users.position','Doctor')
                    ->select('doctors.*','users.username','users.position')
                    ->get();

                    $UserPicture = UserPicture::where('user_id',$user_id)->first();
                    if (!$UserPicture) {
                        if (!$request->file('image')) {
                        }
                        else {
                            $imageName = 'user'.'_'.$doctor->id.'_'.$request->file('image')->getClientOriginalName();

                            $UserPicture = new UserPicture;
                            $UserPicture->user_id = $doctor->id;
                            $UserPicture->image_desc = $imageName;
                            $UserPicture->date_uploaded = $datenow;
                            $UserPicture->save();

                            $request->file('image')->move(base_path() . '/public/user_pics/', $imageName);
                        }
                    }
                    else {
                        if (!$request->file('image')) {
                        }
                        else {
                            $imageName = $UserPicture->image_desc;
                            unlink("../public/user_pics/".$imageName);

                            $imageName2 = 'user'.'_'.$doctor->id.'_'.$request->file('image')->getClientOriginalName();

                            $UserPicture = new UserPicture;
                            $UserPicture->user_id = $doctor->id;
                            $UserPicture->image_desc = $imageName2;
                            $UserPicture->date_uploaded = $datenow;
                            $UserPicture->save();

                            $request->file('image')->move(base_path() . '/public/user_pics/', $imageName2);
                        }
                    }

                    Session::flash('alert-success', 'Doctor Edited.');
                    return redirect()->action('DoctorsController@doctoruserpage');
                }
                else{
                    $users = User::join('doctors','users.doc_id','=','doctors.id')
                    ->where('users.position','!=','Doctor')
                    ->select('doctors.*','users.username','users.position')
                    ->get();

                    $UserPicture = UserPicture::where('user_id',$user_id)->first();
                    if (!$UserPicture) {
                        if (!$request->file('image')) {
                        }
                        else {
                            $imageName = 'user'.'_'.$doctor->id.'_'.$request->file('image')->getClientOriginalName();

                            $UserPicture = new UserPicture;
                            $UserPicture->user_id = $doctor->id;
                            $UserPicture->image_desc = $imageName;
                            $UserPicture->date_uploaded = $datenow;
                            $UserPicture->save();

                            $request->file('image')->move(base_path() . '/public/user_pics/', $imageName);
                        }
                    }
                    else {
                        if (!$request->file('image')) {
                        }
                        else {
                            $imageName = $UserPicture->image_desc;
                            unlink("../public/user_pics/".$imageName);

                            $imageName2 = 'user'.'_'.$doctor->id.'_'.$request->file('image')->getClientOriginalName();

                            $UserPicture = new UserPicture;
                            $UserPicture->user_id = $doctor->id;
                            $UserPicture->image_desc = $imageName2;
                            $UserPicture->date_uploaded = $datenow;
                            $UserPicture->save();

                            $request->file('image')->move(base_path() . '/public/user_pics/', $imageName2);
                        }
                    }

                    Session::flash('alert-success', 'User Edited.');
                    return redirect()->action('DoctorsController@userdoctorpage');
                }
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
        if (Session::get('position') == 'Cashier') {
            $Patientxray = DB::select("SELECT patient_visits.visit_date AS visit_date,COUNT(patient_visits.id) as counter
            FROM patient_visits
            WHERE patient_visits.visit_date >= '$datefrom' AND patient_visits.visit_date <= '$dateto' AND patient_visits.cashier_id = '$id'
            GROUP BY patient_visits.visit_date");
            $counter = 0;
            $income = DB::table('patient_visits')->where('visit_date','>=',$datefrom)->where('visit_date','<=',$dateto)->where('cashier_id',$id)->sum('discounted_total');
        }
        else {
            $Patientxray = DB::select("SELECT patient_visits.visit_date AS visit_date,COUNT(patient_visits.id) as counter
            FROM patient_visits
            WHERE patient_visits.visit_date >= '$datefrom' AND patient_visits.visit_date <= '$dateto'
            GROUP BY patient_visits.visit_date");
            $counter = 0;
            $income = DB::table('patient_visits')->where('visit_date','>=',$datefrom)->where('visit_date','<=',$dateto)->sum('discounted_total');
        }

        return Response::json(['patientxray'=>$Patientxray,'id'=>$id,'counter'=>$counter,'income'=>$income], 200, array(), JSON_PRETTY_PRINT);

        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function medcert()
    {
        if(Session::has('user')){

            return view('medicalcertificate');

        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function postmedcert(Request $request)
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

            $name = $request->input('name');
            $datedate = date_create($request->input('datedate'));
            $aa = date_format($datedate,"F j, Y");
            $diagnosis = $request->input('diagnosis');
            $recommendation = $request->input('recommendation');

            $docname = $request->input('docname');
            $licenseNo = $request->input('licenseNo');
            $ptrNo = $request->input('ptrNo');


            $pdf->writeHTML(view('printmedcert',compact('name','datedate','diagnosis','recommendation','aa','docname','licenseNo','ptrNo'))->render());
            ob_end_clean();
            $pdf->Output('Medical-Certificate.pdf','I');

        }
        else {
            return redirect()->action('Auth@checklogin');
        }
        
    }

    public function xrayreportsreports(Request $request)
    {      
        if(Session::has('user')){

            $id = $request->input('id');
            $datefrom = $request->input('datefrom');
            $dateto = $request->input('dateto');

            $Patientxray = DB::select("SELECT patient_services.date_reg AS date_reg,COUNT(patient_services.id) as counter
            FROM patient_services
            WHERE patient_services.date_reg >= '$datefrom' AND patient_services.date_reg <= '$dateto' AND patient_services.admin_panel_id = 5
            GROUP BY patient_services.date_reg");
            $counter = 0;
            $income = DB::table('patient_services')->where('date_reg','>=',$datefrom)->where('date_reg','<=',$dateto)->where('admin_panel_id',5)->sum('price_amount');

            return Response::json(['patientxray'=>$Patientxray,'id'=>$id,'counter'=>$counter,'income'=>$income], 200, array(), JSON_PRETTY_PRINT);

        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function printxrayreport(Request $request,$id,$datefrom,$dateto)
    {   
        if(Session::has('user')){

            $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetTitle('NFHSI X-Ray Report');

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

            $Patientxray = DB::select("SELECT patient_services.date_reg AS date_reg,COUNT(patient_services.id) as counter
            FROM patient_services
            WHERE patient_services.date_reg >= '$datefrom' AND patient_services.date_reg <= '$dateto' AND patient_services.admin_panel_id = 5
            GROUP BY patient_services.date_reg");
            $counter = 0;
            $income = DB::table('patient_services')->where('date_reg','>=',$datefrom)->where('date_reg','<=',$dateto)->where('admin_panel_id',5)->sum('price_amount');

            $pdf->writeHTML(view('printxrayreport',compact('Patientxray','counter','income','id','datefrom','dateto'))->render());
            ob_end_clean();
            $pdf->Output('NFHSIXrayIncomeReport.pdf','I');

        }
        else {
            return redirect()->action('Auth@checklogin');
        }
        
    }

}
