<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Patientxray;
use App\PatientVisit;
use Response;
use App\Doctor;
use Session;
use App\ReasonForConsulation;
use App\PastMedicalHistory;
use App\Surgery;
use App\Hospitalization;
use App\Disease;
use App\Vaccination;
use App\SocialHistory;
use App\PhysicalExam;
use App\Diagnoses;
use App\Plan;
use App\PatientXrayLog;
use App\Urinalyses;
use App\AdminPanelCategory;
use App\AdminPanel;
use App\PatientService;
use App\AdminPanelSub;
use PDF;
use Dompdf\Dompdf;
use TCPDF;
use DB;
use App\Medication;
use App\Fecalyses;
use App\Chemistry;
use App\Ogtt;
use App\Hematology;
use App\ReceiptNumber;

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

class MYPDFreceipt extends TCPDF {
                public function Header() {

                    $image_file = K_PATH_IMAGES.'nfhsi_logo.png';
                    $this->Image($image_file, 7, 10, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

                    $image_file = K_PATH_IMAGES.'nfhsi_logo.png';
                    $this->Image($image_file, 7, 99, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
                }
            }

class PatientsController extends Controller
{

	public function newvisit()
    {
        $adminpanelcat = AdminPanelCategory::all();
        $adminpanel = AdminPanel::all();
        $sub = AdminPanelSub::all();
        $patient = 0;
    	return view('patientnewvisitpage',compact('adminpanelcat','adminpanel','sub','patient'));
    }

    public function addnewvisit(Request $request)
    {   
        $patient_id = $request->input('patient_id');
        if ($patient_id == 0) {
            $fname = $request->input('fname');
            $mname = $request->input('mname');
            $lname = $request->input('lname');
            $address = $request->input('address');
            if (!$address) {
                $add = "N/A";
            }
            else {
                $add = $request->input('address');
            }
            $gender = $request->input('gender');
            $dob = $request->input('dob');
            if (!$dob) {
                $bday = $request->input('dob');
            }
            else {
                $bday = $request->input('dob');
            }
            $age = $request->input('age');
            if (!$age) {
                $age0 = 0;
            }
            else {
                $age0 = $request->input('age');
            }
            $purpose_visit = $request->input('purpose_visit');
            if (!$purpose_visit) {
                $purvis = "N/A";
            }
            else {
                $purvis = $request->input('purpose_visit');
            }
            $totalprice = $request->input('totalprice');
            $mainservice = count($request->input('mainservice'));

            $senciz_id = $request->input('senciz_id');
            $pwd_id = $request->input('pwd_id');
            if (!$request->input('discount')) {
                $asd = 0;
            }
            else {
                $asd = $request->input('discount');
            }
            $discount = str_replace('.', '', $asd);
            $aa = '.'.$discount;
            $discounted_price = $totalprice * $aa;
            $discounted_total = $totalprice - $discounted_price;

            $patient = new Patient;
            $patient->f_name = $fname;
            $patient->m_name = $mname;
            $patient->l_name = $lname;
            $patient->gender = $gender;
            $patient->dob = $bday;
            $patient->age = $age0;
            $patient->address = $add;
            $patient->senior_id_no = $senciz_id;
            $patient->pwd_id_no = $pwd_id;
            $patient->save();

            $check_p_v = PatientVisit::where('patient_id',$patient->id)->orderBy('id', 'desc')->first();
            if (!$check_p_v) {
                $patientvisit = new PatientVisit;
                $patientvisit->patient_id = $patient->id;
                $datenow = date("Y-m-d");
                $patientvisit->visit_date = $datenow;
                $patientvisit->visitid = 1;
                $patientvisit->purpose_visit = $purvis;
                $patientvisit->discount = $asd;
                $patientvisit->totalbill = round($totalprice);
                $patientvisit->discounted_price = round($discounted_price);
                $patientvisit->discounted_total = round($discounted_total);
                $patientvisit->save();

                for ($i=0; $i < $mainservice; $i++) { 
                    if ($request->input('mainservice')[$i] == 5) {
                        $department = 'xray';
                    }
                    else {
                        $department = 'labtest';
                    }

                    $service = new PatientService;
                    $service->patient_id = $patient->id;
                    $service->admin_panel_id = $request->input('mainservice')[$i];
                    $service->admin_panel_sub_id = $request->input('service_name')[$i];
                    $service->visit_id = 1;
                    $service->department = $department;
                    $service->date_reg = $datenow;
                    $service->save();
                }

            }
            else {
                $patientvisit = new PatientVisit;
                $patientvisit->patient_id = $patient->id;
                $datenow = date("Y-m-d");
                $patientvisit->visit_date = $datenow;
                $patientvisit->visitid = $check_p_v->visitid + 1;
                $patientvisit->purpose_visit = $purvis;
                $patientvisit->discount = $asd;
                $patientvisit->totalbill = round($totalprice);
                $patientvisit->discounted_price = round($discounted_price);
                $patientvisit->discounted_total = round($discounted_total);
                $patientvisit->save();

                for ($i=0; $i < $mainservice; $i++) { 
                    if ($request->input('mainservice')[$i] == 5) {
                        $department = 'xray';
                    }
                    else {
                        $department = 'labtest';
                    }

                    $service = new PatientService;
                    $service->patient_id = $patient->id;
                    $service->admin_panel_id = $request->input('mainservice')[$i];
                    $service->admin_panel_sub_id = $request->input('service_name')[$i];
                    $service->visit_id = $check_p_v->visitid + 1;
                    $service->department = $department;
                    $service->date_reg = $datenow;
                    $service->save();
                }
            }
            Session::flash('alert-success', 'Personal Info Created.');
            // return redirect()->action('PatientsController@patientvisitpage',['id' => $patient->id, 'vid' => $patientvisit->visitid]);
            return redirect()->action('PatientsController@patientlist');
        }
        else {
            $purpose_visit = $request->input('purpose_visit');
            if (!$purpose_visit) {
                $purvis = "N/A";
            }
            else {
                $purvis = $request->input('purpose_visit');
            }
            $totalprice = $request->input('totalprice');

            // $service_name = $request->input('service_name');
            $mainservice = count($request->input('mainservice'));

            $senciz_id = $request->input('senciz_id');
            $pwd_id = $request->input('pwd_id');
            if (!$request->input('discount')) {
                $asd = 0;
            }
            else {
                $asd = $request->input('discount');
            }
            $discount = str_replace('.', '', $asd);
            $aa = '.'.$discount;
            $discounted_price = $totalprice * $aa;
            $discounted_total = $totalprice - $discounted_price;


            $check_p_v = PatientVisit::where('patient_id',$patient_id)->orderBy('id', 'desc')->first();
            if (!$check_p_v) {
                $patientvisit = new PatientVisit;
                $patientvisit->patient_id = $patient_id;
                $datenow = date("Y-m-d");
                $patientvisit->visit_date = $datenow;
                $patientvisit->visitid = 1;
                $patientvisit->purpose_visit = $purvis;
                $patientvisit->discount = $asd;
                $patientvisit->totalbill = round($totalprice);
                $patientvisit->discounted_price = round($discounted_price);
                $patientvisit->discounted_total = round($discounted_total);
                $patientvisit->save();

                for ($i=0; $i < $mainservice; $i++) { 
                    if ($request->input('mainservice')[$i] == 5) {
                        $department = 'xray';
                    }
                    else {
                        $department = 'labtest';
                    }

                    $service = new PatientService;
                    $service->patient_id = $patient_id;
                    $service->admin_panel_id = $request->input('mainservice')[$i];
                    $service->admin_panel_sub_id = $request->input('service_name')[$i];
                    $service->visit_id = 1;
                    $service->department = $department;
                    $service->date_reg = $datenow;
                    $service->save();
                }

            }
            else {
                $patientvisit = new PatientVisit;
                $patientvisit->patient_id = $patient_id;
                $datenow = date("Y-m-d");
                $patientvisit->visit_date = $datenow;
                $patientvisit->visitid = $check_p_v->visitid + 1;
                $patientvisit->purpose_visit = $purvis;
                $patientvisit->discount = $asd;
                $patientvisit->totalbill = round($totalprice);
                $patientvisit->discounted_price = round($discounted_price);
                $patientvisit->discounted_total = round($discounted_total);
                $patientvisit->save();

                for ($i=0; $i < $mainservice; $i++) { 
                    if ($request->input('mainservice')[$i] == 5) {
                        $department = 'xray';
                    }
                    else {
                        $department = 'labtest';
                    }

                    $service = new PatientService;
                    $service->patient_id = $patient_id;
                    $service->admin_panel_id = $request->input('mainservice')[$i];
                    $service->admin_panel_sub_id = $request->input('service_name')[$i];
                    $service->visit_id = $check_p_v->visitid + 1;
                    $service->department = $department;
                    $service->date_reg = $datenow;
                    $service->save();
                }
            }
            Session::flash('alert-success', 'Personal Info Created.');
            // return redirect()->action('PatientsController@patientvisitpage',['id' => $patient_id, 'vid' => $patientvisit->visitid]);
            return redirect()->action('PatientsController@patientlist');
        }
    }

	public function patientlist()
    {
        if(Session::has('user')){
            $doctor_id = Session::get('user');
            $doctor_pos = Session::get('position');

            $adminpanelcat = AdminPanelCategory::all();
            $adminpanel = AdminPanel::all();
            $sub = AdminPanelSub::all();

            if ($doctor_id != 1 && $doctor_pos == "Doctor") {
                $patientlist = Doctor::join('patientxrays','doctors.id','=','patientxrays.physician_id')
                ->leftJoin('urinalyses','doctors.id','=','urinalyses.physician_id')
                ->leftJoin('patients','patientxrays.patient_id','=','patients.id')
                ->where('doctors.id',$doctor_id)
                ->select('patients.*')
                ->get();
                $latsvisit = PatientVisit::select('patient_id','visit_date')->orderBy('visitid','desc')->groupBy('patient_id','visit_date')->get();
            }
            else if($doctor_id == 1 ) {
                $patientlist = Patient::all();
                $latsvisit = PatientVisit::select('patient_id','visit_date')->orderBy('visitid','desc')->groupBy('patient_id','visit_date')->get();
            }
            else {
                $patientlist = Patient::all();
                $latsvisit = PatientVisit::select('patient_id','visit_date')->orderBy('visitid','desc')->groupBy('patient_id','visit_date')->get();
            }
            // return Response::json($latsvisit, 200, array(), JSON_PRETTY_PRINT);
            return view('patientlistpage',compact('patientlist','adminpanelcat','adminpanel','sub','latsvisit'));
            
        }
        else {
            $adminpanelcat = AdminPanelCategory::all();
            $adminpanel = AdminPanel::all();
            $sub = AdminPanelSub::all();
            $patientlist = Patient::all();
            $latsvisit = PatientVisit::select('patient_id','visit_date')->orderBy('visitid','desc')->groupBy('patient_id','visit_date')->get();
            return view('patientlistpage',compact('patientlist','adminpanelcat','adminpanel','sub','latsvisit'));
        }
    }

	public function patientvisitpage($id,$vid)
    {
        $doctor_id = Session::get('user');
        $doctor_pos = Session::get('position');
        if (!$doctor_id) {
            $patientxray = Patientxray::where('patient_id',$id)->where('visitid',$vid)->get();
            $xraycount = Patientxray::where('patient_id',$id)->where('visitid',$vid)->count();

            $Urinalysis = Urinalyses::where('patient_id',$id)->where('visit_id',$vid)->get();
            $uricount = Urinalyses::where('patient_id',$id)->where('visit_id',$vid)->count();
        }
        elseif($doctor_id == 1) {
            $patientxray = Patientxray::where('patient_id',$id)->where('visitid',$vid)->get();
            $xraycount = Patientxray::where('patient_id',$id)->where('visitid',$vid)->count();

            $Urinalysis = Urinalyses::where('patient_id',$id)->where('visit_id',$vid)->get();
            $uricount = Urinalyses::where('patient_id',$id)->where('visit_id',$vid)->count();
        }
        elseif ($doctor_id != 1 && $doctor_pos == "Doctor") {
            $patientxray = Patientxray::where('patient_id',$id)->where('visitid',$vid)->where('physician_id',$doctor_id)->get();
            $xraycount = Patientxray::where('patient_id',$id)->where('visitid',$vid)->where('physician_id',$doctor_id)->count();

            $Urinalysis = Urinalyses::where('patient_id',$id)->where('visit_id',$vid)->where('physician_id',$doctor_id)->get();
            $uricount = Urinalyses::where('patient_id',$id)->where('visit_id',$vid)->where('physician_id',$doctor_id)->count();
        }
        else {
            $patientxray = Patientxray::where('patient_id',$id)->where('visitid',$vid)->get();
            $xraycount = Patientxray::where('patient_id',$id)->where('visitid',$vid)->count();

            $Urinalysis = Urinalyses::where('patient_id',$id)->where('visit_id',$vid)->get();
            $uricount = Urinalyses::where('patient_id',$id)->where('visit_id',$vid)->count();
        }
    	    
        $reasonforconsulation = ReasonForConsulation::where('patient_id',$id)->where('visit_id',$vid)->first();
        $PMH = PastMedicalHistory::where('patient_id',$id)->where('visit_id',$vid)->first();
        $PMH_sur = PastMedicalHistory::leftJoin('surgeries','past_medical_histories.id','=','surgeries.pmh_id')
        ->where('past_medical_histories.patient_id',$id)
        ->select('surgeries.*')
        ->get();
        $PMH_hos = PastMedicalHistory::leftJoin('hospitalizations','past_medical_histories.id','=','hospitalizations.pmh_id')
        ->where('past_medical_histories.patient_id',$id)
        ->select('hospitalizations.*')
        ->get();
        $PMH_dis = PastMedicalHistory::leftJoin('diseases','past_medical_histories.id','=','diseases.pmh_id')
        ->where('past_medical_histories.patient_id',$id)
        ->select('diseases.*')
        ->get();
        $PMH_vacc = PastMedicalHistory::leftJoin('vaccinations','past_medical_histories.id','=','vaccinations.pmh_id')
        ->where('past_medical_histories.patient_id',$id)
        ->select('vaccinations.*')
        ->get();
        $SH = SocialHistory::where('patient_id',$id)->where('visit_id',$vid)->first();
        $PE = PhysicalExam::where('patient_id',$id)->where('visit_id',$vid)->first();
        $diagnosis = Diagnoses::where('patient_id',$id)->where('visit_id',$vid)->first();
        $plan = Plan::where('patient_id',$id)->where('visit_id',$vid)->first();

        //return Response::json($PMH_hos, 200, array(), JSON_PRETTY_PRINT);
        $patient = Patient::join('patient_visits','patients.id','=','patient_visits.patient_id')
            ->where('patient_visits.patient_id',$id)
            ->where('patient_visits.visitid',$vid)
            ->select('patients.*','patient_visits.purpose_visit','patient_visits.status')
            ->first();
    	//$doctor = Doctor::with('user')->get();
        $doctor = Doctor::join('users','doctors.id','=','users.doc_id')->where('users.position','Doctor')->select('doctors.*')->get();
        $adminpanel = AdminPanelCategory::with('adminpanel')->get();
        $PatientService1002 = PatientService::where('patient_id',$id)->where('visit_id',$vid)->get();
        $PatientService = PatientService::select('department')
        ->where('patient_id',$id)
        ->where('visit_id',$vid)
        ->groupBy('department')
        ->get();
        $PatientService1003 = PatientService::join('admin_panels','patient_services.admin_panel_sub_id','=','admin_panels.id')
        ->leftJoin('admin_panel_categories','admin_panels.admin_panel_cat_id','admin_panel_categories.id')
        ->select('admin_panels.admin_panel_cat_id','admin_panel_categories.cat_name')
        ->where('patient_services.patient_id',$id)
        ->where('patient_services.visit_id',$vid)
        ->groupBy('admin_panels.admin_panel_cat_id','admin_panel_categories.cat_name')
        ->get();
        $Medication = Medication::where('patient_id',$id)->where('visit_id',$vid)->get();
        $Urinalyses = Urinalyses::where('patient_id',$id)->where('visit_id',$vid)->first();
        $Fecalyses = Fecalyses::where('patient_id',$id)->where('visit_id',$vid)->first();
        $Chemistry = Chemistry::where('patient_id',$id)->where('visit_id',$vid)->first();
        $Ogtt = Ogtt::where('patient_id',$id)->where('visit_id',$vid)->first();
        $Hematology = Hematology::where('patient_id',$id)->where('visit_id',$vid)->first();
        //return Response::json($PatientService1003, 200, array(), JSON_PRETTY_PRINT);
    	return view('patientvisitpage',compact('id','vid','patientxray','patient','doctor','reasonforconsulation','PMH','PMH_sur','PMH_hos','PMH_dis','PMH_vacc','SH','PE','diagnosis','plan','xraycount','Urinalysis','uricount','adminpanel','PatientService','Medication','PatientService1002','PatientService1003','Urinalyses','Fecalyses','Chemistry','Ogtt','Hematology'));
    }

	public function newpatientxray(Request $request, $id, $vid)
    {	
        if(Session::has('user')){
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
           $now = date("Y-m-d");
     	
     	  $patientxray = new Patientxray;
     	  $patientxray->patient_id = $P_id;
     	  $patientxray->or_no = $orno;
     	  $patientxray->physician_id = $physician;
     	  $patientxray->xray_date = $now;
     	  $patientxray->finding = $finding;
     	  $patientxray->finding_info = $comm;
     	  $patientxray->visitid = $vid;
          $patientxray->phy_fee = floatval(preg_replace("/[^-0-9\.]/","",$request->input('pfee')));
     	  $patientxray->save();

          $logs = new PatientXrayLog;
          $logs->xray_id = $patientxray->id;
          $logs->user_id = Session::get('user');
          $logs->date = $patientxray->xray_date;
          $logs->action = "Create";
          $logs->save();
	
    	   return redirect()->action('PatientsController@patientvisitpage',['id' => $id, 'vid' => $vid]);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function modalavisit(Request $request)
    {	
    	$p_id = $request->input('p_id');
    	$patientvisit = PatientVisit::where('patient_id',$p_id)->orderBy('status','asc')->orderBy('visitid','asc')->get();
    	return Response::json($patientvisit, 200, array(), JSON_PRETTY_PRINT);
    }

    public function modalaeditpatient(Request $request)
    {   
        $p_id = $request->input('p_id');
        $v_id = $request->input('v_id');

        $patient = Patient::join('patient_visits','patients.id','=','patient_visits.patient_id')
        ->where('patients.id',$p_id)
        ->select('patients.*','patient_visits.purpose_visit','patient_visits.visitid','patient_visits.id as patient_visit_id','patient_visits.totalbill as totalbill','patient_visits.discount')
        ->first();
        //$adminpanel = PatientService::where('patient_id',$p_id)->where('visit_id',$v_id)->with('adminPanels')->get();

        $adminpanel = PatientService::join('admin_panels','patient_services.admin_panel_sub_id','=','admin_panels.id')
        ->leftJoin('admin_panel_categories','admin_panels.admin_panel_cat_id','=','admin_panel_categories.id')
        ->where('patient_services.patient_id',$p_id)
        ->where('patient_services.visit_id',$v_id)
        ->select('patient_services.*','admin_panels.id as AP_ID','admin_panels.name as AP_NAME','admin_panels.price as AP_PRICE','admin_panel_categories.id as APC_ID')
        ->get();
        return Response::json(['patient' => $patient,'adminpanel' => $adminpanel], 200, array(), JSON_PRETTY_PRINT);
    }

    public function editpatient(Request $request)
    {
        $p_id = $request->input('p_id');
        $fname = $request->input('fname');
        $mname = $request->input('mname');
        $lname = $request->input('lname');
        $address = $request->input('address');
        if (!$address) {
            $add = "N/A";
        }
        else {
            $add = $request->input('address');
        }
        $gender = $request->input('gender');
        $dob = $request->input('dob');
        if (!$dob) {
            $bday = $request->input('dob');
        }
        else {
            $bday = $request->input('dob');
        }
        $age = $request->input('age');
        if (!$age) {
            $age0 = 0;
        }
        else {
            $age0 = $request->input('age');
        }
        $senciz_id = $request->input('senciz_id');
        $pwd_id = $request->input('pwd_id');

        $patient = Patient::where('id',$p_id)->first();
        $patient->f_name = $fname;
        $patient->m_name = $mname;
        $patient->l_name = $lname;
        $patient->gender = $gender;
        $patient->dob = $bday;
        $patient->age = $age0;
        $patient->address = $add;
        $patient->senior_id_no = $senciz_id;
        $patient->pwd_id_no = $pwd_id;
        $patient->save();

        return redirect()->action('PatientsController@patientlist');
    }

    public function modalxrayedit(Request $request)
    {   
        if(Session::has('user')){
            $xray_id = $request->input('dataid');
            //$patientxray = Patientxray::where('id',$xray_id)->first();
            $patientxray = Patientxray::join('doctors','patientxrays.physician_id','=','doctors.id')
            ->where('patientxrays.id',$xray_id)
            ->select('doctors.*','patientxrays.id as xray_id','patientxrays.xray_date','patientxrays.finding','patientxrays.finding_info','patientxrays.or_no as or_no','patientxrays.phy_fee')
            ->first();
            return Response::json($patientxray, 200, array(), JSON_PRETTY_PRINT);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function addreasonforconsulation(Request $request)
    {   
        if(Session::has('user')){
            $patient_id = $request->input('patient_id');
            $visit_id = $request->input('visit_id');
            $chief_complaint = $request->input('chief_complaint');
            $history_illness = $request->input('history_illness');

            $reasonforconsulation = new ReasonForConsulation;
            $reasonforconsulation->patient_id = $patient_id;
            $reasonforconsulation->visit_id = $visit_id;
            $reasonforconsulation->chief_complaint = $chief_complaint;
            $reasonforconsulation->history_of_present_illness = $history_illness;
            $reasonforconsulation->save();

            return Response::json($reasonforconsulation, 200, array(), JSON_PRETTY_PRINT);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function editreasonforconsulation(Request $request)
    {   
        if(Session::has('user')){
            $RFC_id = $request->input('RFC_id');
            $chief_complaint = $request->input('chief_complaint');
            $history_illness = $request->input('history_illness');

            $reasonforconsulation = ReasonForConsulation::where('id',$RFC_id)->first();
            $reasonforconsulation->chief_complaint = $chief_complaint;
            $reasonforconsulation->history_of_present_illness = $history_illness;
            $reasonforconsulation->save();

            return Response::json($reasonforconsulation, 200, array(), JSON_PRETTY_PRINT);
        }
        else{
            return redirect()->action('Auth@checklogin');
        }
    }

    public function addpastmedicalhistory(Request $request)
    {   
        if(Session::has('user')){
            $PMH_patient_id = $request->input('PMH_patient_id');
            $PMH_visit_id = $request->input('PMH_visit_id');
            $surgery = $request->input('surgery');
            $hypertension = $request->input('hypertension');
            $diabetes = $request->input('diabetes');
            $PR_check = $request->input('PR_check');
            $DD_check = $request->input('DD_check');
            $vaccine_check = $request->input('vaccine_check');

            $PMH = new PastMedicalHistory;
            $PMH->patient_id = $PMH_patient_id;
            $PMH->visit_id = $PMH_visit_id;
            $PMH->surgery = $surgery;
            $PMH->hypertension = $hypertension;
            $PMH->diabetes_mellitus = $diabetes;
            $PMH->previous_hospitalization = $PR_check;
            $PMH->diseases_diagnosed = $DD_check;
            $PMH->vaccination = $vaccine_check;
            $PMH->save();

            return Response::json($PMH, 200, array(), JSON_PRETTY_PRINT);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function addsurgery(Request $request)
    {   
        if(Session::has('user')){
            $PMH_id = $request->input('PMH_id');
            $sur_date = $request->input('sur_date');
            $operation = $request->input('operation');
            $counter = $request->input('counter');

            $Surgery = Surgery::where('pmh_id',$PMH_id)->where('counter',$counter)->first();
            if (!$Surgery) {
                $Surgery = new Surgery;
                $Surgery->pmh_id = $PMH_id;
                $Surgery->date = $sur_date;
                $Surgery->operation = $operation;
                $Surgery->counter = $counter;
                $Surgery->save();
            }
            else if ($Surgery->counter == $counter) {
                $Surgery->date = $sur_date;
                $Surgery->operation = $operation;
                $Surgery->counter = $counter;
                $Surgery->save();
            }
            else {
                $Surgery = new Surgery;
                $Surgery->pmh_id = $PMH_id;
                $Surgery->date = $sur_date;
                $Surgery->operation = $operation;
                $Surgery->counter = $counter;
                $Surgery->save();
            }

            return Response::json($Surgery, 200, array(), JSON_PRETTY_PRINT);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function addhospitalization(Request $request)
    {   
        if(Session::has('user')){
            $PMH_id = $request->input('PMH_id');
            $hos_date = $request->input('hos_date');
            $diagnosis = $request->input('diagnosis');
            $counter2 = $request->input('counter2');

            $Hospitalization = Hospitalization::where('pmh_id',$PMH_id)->where('counter',$counter2)->first();
            if (!$Hospitalization) {
                $Hospitalization = new Hospitalization;
                $Hospitalization->pmh_id = $PMH_id;
                $Hospitalization->date = $hos_date;
                $Hospitalization->diagnosis = $diagnosis;
                $Hospitalization->counter = $counter2;
                $Hospitalization->save();
            }
            else if ($Hospitalization->counter == $counter2) {
                $Hospitalization->date = $hos_date;
                $Hospitalization->diagnosis = $diagnosis;
                $Hospitalization->counter = $counter2;
                $Hospitalization->save();
            }
            else {
                $Hospitalization = new Hospitalization;
                $Hospitalization->pmh_id = $PMH_id;
                $Hospitalization->date = $hos_date;
                $Hospitalization->diagnosis = $diagnosis;
                $Hospitalization->counter = $counter2;
                $Hospitalization->save();
            }

            return Response::json($Hospitalization, 200, array(), JSON_PRETTY_PRINT);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }

        
    }

    public function adddisease(Request $request)
    {  
        if(Session::has('user')){ 
            $PMH_id = $request->input('PMH_id');
            $dis_date = $request->input('dis_date');
            $disease = $request->input('disease');
            $counter3 = $request->input('counter3');

            $Disease = Disease::where('pmh_id',$PMH_id)->where('counter',$counter3)->first();
            if (!$Disease) {
                $Disease = new Disease;
                $Disease->pmh_id = $PMH_id;
                $Disease->date = $dis_date;
                $Disease->disease = $disease;
                $Disease->counter = $counter3;
                $Disease->save();
            }
            else if ($Disease->counter == $counter3) {
                $Disease->date = $dis_date;
                $Disease->disease = $disease;
                $Disease->counter = $counter3;
                $Disease->save();
            }
            else {
                $Disease = new Disease;
                $Disease->pmh_id = $PMH_id;
                $Disease->date = $dis_date;
                $Disease->disease = $disease;
                $Disease->counter = $counter3;
                $Disease->save();
            }

            return Response::json($Disease, 200, array(), JSON_PRETTY_PRINT);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function addvaccination(Request $request)
    {   
        if(Session::has('user')){
            $PMH_id = $request->input('PMH_id');
            $vac_date = $request->input('vac_date');
            $vaccination = $request->input('vaccination');
            $counter4 = $request->input('counter4');

            $Vaccination = Vaccination::where('pmh_id',$PMH_id)->where('counter',$counter4)->first();
            if (!$Vaccination) {
                $Vaccination = new Vaccination;
                $Vaccination->pmh_id = $PMH_id;
                $Vaccination->date = $vac_date;
                $Vaccination->vaccine = $vaccination;
                $Vaccination->counter = $counter4;
                $Vaccination->save();
            }
            else if ($Vaccination->counter == $counter4) {
                $Vaccination->date = $vac_date;
                $Vaccination->vaccine = $vaccination;
                $Vaccination->counter = $counter4;
                $Vaccination->save();
            }
            else {
                $Vaccination = new Vaccination;
                $Vaccination->pmh_id = $PMH_id;
                $Vaccination->date = $vac_date;
                $Vaccination->vaccine = $vaccination;
                $Vaccination->counter = $counter4;
                $Vaccination->save();
            }

            return Response::json($Vaccination, 200, array(), JSON_PRETTY_PRINT);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function editpastmedicalhistory(Request $request)
    {      
        if(Session::has('user')){
            $PMH_id = $request->input('PMH_id');

            $surgery = $request->input('surgery');
            $hypertension = $request->input('hypertension');
            $diabetes = $request->input('diabetes');
            $PR_check = $request->input('PR_check');
            $DD_check = $request->input('DD_check');
            $vaccine_check = $request->input('vaccine_check');

            $PMH = PastMedicalHistory::where('id',$PMH_id)->first();
            $PMH->surgery = $surgery;
            $PMH->hypertension = $hypertension;
            $PMH->diabetes_mellitus = $diabetes;
            $PMH->previous_hospitalization = $PR_check;
            $PMH->diseases_diagnosed = $DD_check;
            $PMH->vaccination = $vaccine_check;
            $PMH->save();

            return Response::json($PMH, 200, array(), JSON_PRETTY_PRINT);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function addsocialhistory(Request $request)
    {    
        if(Session::has('user')){  
            $SH_id = $request->input('SH_id');
            $SH_patient_id = $request->input('SH_patient_id');
            $SH_visit_id = $request->input('SH_visit_id');
            $allergies = $request->input('allergies');
            $allergies_list = $request->input('allergies_list');
            $drink_alcohol = $request->input('drink_alcohol');
            $how_much_drink = $request->input('how_much_drink');
            $smoke = $request->input('smoke');
            $packs = $request->input('packs');

            $SocialHistory = SocialHistory::where('id',$SH_id)->first();
            if (!$SocialHistory) {
                $SocialHistory = new SocialHistory;
                $SocialHistory->patient_id = $SH_patient_id;
                $SocialHistory->visit_id = $SH_visit_id;
                $SocialHistory->allergy = $allergies;
                $SocialHistory->allergy_desc = $allergies_list;
                $SocialHistory->alcohol = $drink_alcohol;
                $SocialHistory->alcohol_desc = $how_much_drink;
                $SocialHistory->smoke = $smoke;
                $SocialHistory->smoke_desc = $packs;
                $SocialHistory->save();
            }
            else if ($SocialHistory->id == $SH_id) {
                $SocialHistory->allergy = $allergies;
                $SocialHistory->allergy_desc = $allergies_list;
                $SocialHistory->alcohol = $drink_alcohol;
                $SocialHistory->alcohol_desc = $how_much_drink;
                $SocialHistory->smoke = $smoke;
                $SocialHistory->smoke_desc = $packs;
                $SocialHistory->save();
            }
            else {
                $SocialHistory = new SocialHistory;
                $SocialHistory->patient_id = $SH_patient_id;
                $SocialHistory->visit_id = $SH_visit_id;
                $SocialHistory->allergy = $allergies;
                $SocialHistory->allergy_desc = $allergies_list;
                $SocialHistory->alcohol = $drink_alcohol;
                $SocialHistory->alcohol_desc = $how_much_drink;
                $SocialHistory->smoke = $smoke;
                $SocialHistory->smoke_desc = $packs;
                $SocialHistory->save();
            }

            return Response::json($SocialHistory, 200, array(), JSON_PRETTY_PRINT);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function addphysicalexam(Request $request)
    {      
        if(Session::has('user')){  
            $PE_id = $request->input('PE_id');
            $PE_patient_id = $request->input('PE_patient_id');
            $PE_visit_id = $request->input('PE_visit_id');

            $gen_survey = $request->input('gen_survey');
            $bp = $request->input('bp');
            $hr = $request->input('hr');
            $rr = $request->input('rr');
            $temp = $request->input('temp');
            $head = $request->input('head');
            $neck = $request->input('neck');
            $chest_lungs = $request->input('chest_lungs');
            $heart = $request->input('heart');
            $abdomen = $request->input('abdomen');
            $back = $request->input('back');
            $extremities = $request->input('extremities');
            $neuro_exam = $request->input('neuro_exam');
        

            $PhysicalExam = PhysicalExam::where('id',$PE_id)->first();
            if (!$PhysicalExam) {
                $PhysicalExam = new PhysicalExam;
                $PhysicalExam->patient_id = $PE_patient_id;
                $PhysicalExam->visit_id = $PE_visit_id;
                $PhysicalExam->gen_survey = $gen_survey;
                $PhysicalExam->bp = $bp;
                $PhysicalExam->hr = $hr;
                $PhysicalExam->rr = $rr;
                $PhysicalExam->temp = $temp;
                $PhysicalExam->head = $head;
                $PhysicalExam->neck = $neck;
                $PhysicalExam->chest_lung = $chest_lungs;
                $PhysicalExam->heart = $heart;
                $PhysicalExam->abdomen = $abdomen;
                $PhysicalExam->back = $back;
                $PhysicalExam->extremity = $extremities;
                $PhysicalExam->neuro_exam = $neuro_exam;
                $PhysicalExam->save();
            }
            else if ($PhysicalExam->id == $PE_id) {
                $PhysicalExam->gen_survey = $gen_survey;
                $PhysicalExam->bp = $bp;
                $PhysicalExam->hr = $hr;
                $PhysicalExam->rr = $rr;
                $PhysicalExam->temp = $temp;
                $PhysicalExam->head = $head;
                $PhysicalExam->neck = $neck;
                $PhysicalExam->chest_lung = $chest_lungs;
                $PhysicalExam->heart = $heart;
                $PhysicalExam->abdomen = $abdomen;
                $PhysicalExam->back = $back;
                $PhysicalExam->extremity = $extremities;
                $PhysicalExam->neuro_exam = $neuro_exam;
                $PhysicalExam->save();
            }
            else {
                $PhysicalExam = new PhysicalExam;
                $PhysicalExam->patient_id = $PE_patient_id;
                $PhysicalExam->visit_id = $PE_visit_id;
                $PhysicalExam->gen_survey = $gen_survey;
                $PhysicalExam->bp = $bp;
                $PhysicalExam->hr = $hr;
                $PhysicalExam->rr = $rr;
                $PhysicalExam->temp = $temp;
                $PhysicalExam->head = $head;
                $PhysicalExam->neck = $neck;
                $PhysicalExam->chest_lung = $chest_lungs;
                $PhysicalExam->heart = $heart;
                $PhysicalExam->abdomen = $abdomen;
                $PhysicalExam->back = $back;
                $PhysicalExam->extremity = $extremities;
                $PhysicalExam->neuro_exam = $neuro_exam;
                $PhysicalExam->save();
            }   

            return Response::json($PhysicalExam, 200, array(), JSON_PRETTY_PRINT);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function adddiagnosis(Request $request)
    {    
        if(Session::has('user')){   
            $diag_id = $request->input('diag_id');
            $diag_patient_id = $request->input('diag_patient_id');
            $diag_visit_id = $request->input('diag_visit_id');
            $diagnosis = $request->input('diagnosis');
        

            $Diagnosis = Diagnoses::where('id',$diag_id)->first();
            if (!$Diagnosis) {
                $Diagnosis = new Diagnoses;
                $Diagnosis->patient_id = $diag_patient_id;
                $Diagnosis->visit_id = $diag_visit_id;
                $Diagnosis->diagnosis = $diagnosis;
                $Diagnosis->save();
            }
            else if ($Diagnosis->id == $diag_id) {
                $Diagnosis->diagnosis = $diagnosis;
                $Diagnosis->save();
            }
            else {
                $Diagnosis = new Diagnoses;
                $Diagnosis->patient_id = $diag_patient_id;
                $Diagnosis->visit_id = $diag_visit_id;
                $Diagnosis->diagnosis = $diagnosis;
                $Diagnosis->save();
            }

            return Response::json($Diagnosis, 200, array(), JSON_PRETTY_PRINT);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function addplan(Request $request)
    {      
        if(Session::has('user')){
            $plan_id = $request->input('plan_id');
            $plan_patient_id = $request->input('plan_patient_id');
            $plan_visit_id = $request->input('plan_visit_id');
            $plan = $request->input('plan');
        

            $Plan = Plan::where('id',$plan_id)->first();
            if (!$Plan) {
                $Plan = new Plan;
                $Plan->patient_id = $plan_patient_id;
                $Plan->visit_id = $plan_visit_id;
                $Plan->plan = $plan;
                $Plan->save();
            }
            else if ($Plan->id == $plan_id) {
                $Plan->plan = $plan;
                $Plan->save();
            }
            else {
                $Plan = new Plan;
                $Plan->patient_id = $plan_patient_id;
                $Plan->visit_id = $plan_visit_id;
                $Plan->plan = $plan;
                $Plan->save();
            }

            return Response::json($Plan, 200, array(), JSON_PRETTY_PRINT);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function editpatientxray(Request $request, $id, $vid)
    {   
        if(Session::has('user')){
            $xray_id = $request->input('xray_id');
            $finding = $request->input('finding');
            $comm = $request->input('comm');
            $now = date("Y-m-d");
        
            $patientxray = Patientxray::where('id',$xray_id)->first();
            $patientxray->finding = $finding;
            $patientxray->finding_info = $comm;
            $patientxray->status = 'Old';
            $patientxray->save();

            $logs = new PatientXrayLog;
            $logs->xray_id = $patientxray->id;
            $logs->user_id = Session::get('user');
            $logs->date = $now;
            $logs->action = "Edit";
            $logs->save();
    
           return redirect()->action('PatientsController@patientvisitpage',['id' => $id, 'vid' => $vid]);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function xraylogs(Request $request)
    {      
        if(Session::has('user')){
            $dataid = $request->input('dataid');
            $PatientXrayLog = PatientXrayLog::where('xray_id',$dataid)->with('doctor')->get();
            return Response::json($PatientXrayLog, 200, array(), JSON_PRETTY_PRINT);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function newurinalysis(Request $request, $id, $vid)
    {   
        if(Session::has('user')){
            $uri_id = $request->input('uri_id');
            $physician_id = $request->input('physician');
            $orno = $request->input('orno');
            $now = date("Y-m-d");

            $physical = $request->input('physical');
            if ($physical == "Yes") {
                $phy = $physical;
            }
            else {
                $phy = "No";
            }
            $color = $request->input('color');
            $transparency = $request->input('transparency');
            $SG = $request->input('SG');

            $microscopic = $request->input('microscopic');
            if ($microscopic == "Yes") {
                $mic = $microscopic;
            }
            else {
                $mic = "No";
            }
            $wbc = $request->input('wbc');
            $rbc = $request->input('rbc');
            $EC = $request->input('EC');
            $bacteria = $request->input('bacteria');
            $cast = $request->input('cast');
            $cast2 = $request->input('cast2');
            $crystal = $request->input('crystal');
            $crystal2 = $request->input('crystal2');
            $AM = $request->input('AM');
            $MT = $request->input('MT');
            $others = $request->input('others');
            $others2 = $request->input('others2');
            $others3 = $request->input('others3');

            $chemical = $request->input('chemical');
            if ($chemical == "Yes") {
                $che = $chemical;
            }
            else {
                $che = "No";
            }
            $glucose = $request->input('glucose');
            $bilirubin = $request->input('bilirubin');
            $ketone = $request->input('ketone');
            $blood = $request->input('blood');
            $ph = $request->input('ph');
            $protein = $request->input('protein');
            $urobilingen = $request->input('urobilingen');
            $nitrites = $request->input('nitrites');
            $leucocytes = $request->input('leucocytes');

            $preg_test = $request->input('preg_test');
            if ($preg_test == "Yes") {
                $preg = $preg_test;
            }
            else {
                $preg = "No";
            }
            $preg_remarks = $request->input('preg_remarks');
            
            if(!$uri_id) {
                $Urinalysis = new Urinalyses;
                $Urinalysis->patient_id = $id;
                $Urinalysis->visit_id = $vid;
                $Urinalysis->physician_id = $physician_id;
                $Urinalysis->user_id = Session::get('user');
                $Urinalysis->date = $now;
                $Urinalysis->or_no = $orno;

                $Urinalysis->physical = $phy;
                $Urinalysis->color = $color;
                $Urinalysis->transparency = $transparency;
                $Urinalysis->specific_gravity = $SG;

                $Urinalysis->microscopic = $mic;
                $Urinalysis->wbc = $wbc;
                $Urinalysis->rbc = $rbc;
                $Urinalysis->epith_cell = $EC;
                $Urinalysis->bacteria = $bacteria;
                $Urinalysis->cast = $cast;
                $Urinalysis->cast2 = $cast2;
                $Urinalysis->crystal = $crystal;
                $Urinalysis->crystal2 = $crystal2;
                $Urinalysis->amorphous_material = $AM;
                $Urinalysis->mucus_thread = $MT;
                $Urinalysis->other = $others;
                $Urinalysis->other2 = $others2;
                $Urinalysis->other3 = $others3;

                $Urinalysis->chemical = $che;
                $Urinalysis->glucose = $glucose;
                $Urinalysis->bilirubin = $bilirubin;
                $Urinalysis->ketone = $ketone;
                $Urinalysis->blood = $blood;
                $Urinalysis->ph = $ph;
                $Urinalysis->protein = $protein;
                $Urinalysis->urobilinogen = $urobilingen;
                $Urinalysis->nitrites = $nitrites;
                $Urinalysis->leucocytes = $leucocytes;

                $Urinalysis->pregnancy_test = $preg;
                $Urinalysis->preg_remark = $preg_remarks;
                $Urinalysis->save();
            }
            else {
                $Urinalysis = Urinalyses::where('id',$uri_id)->first();

                $Urinalysis->physical = $phy;
                $Urinalysis->color = $color;
                $Urinalysis->transparency = $transparency;
                $Urinalysis->specific_gravity = $SG;

                $Urinalysis->microscopic = $mic;
                $Urinalysis->wbc = $wbc;
                $Urinalysis->rbc = $rbc;
                $Urinalysis->epith_cell = $EC;
                $Urinalysis->bacteria = $bacteria;
                $Urinalysis->cast = $cast;
                $Urinalysis->cast2 = $cast2;
                $Urinalysis->crystal = $crystal;
                $Urinalysis->crystal2 = $crystal2;
                $Urinalysis->amorphous_material = $AM;
                $Urinalysis->mucus_thread = $MT;
                $Urinalysis->other = $others;
                $Urinalysis->other2 = $others2;
                $Urinalysis->other3 = $others3;

                $Urinalysis->chemical = $che;
                $Urinalysis->glucose = $glucose;
                $Urinalysis->bilirubin = $bilirubin;
                $Urinalysis->ketone = $ketone;
                $Urinalysis->blood = $blood;
                $Urinalysis->ph = $ph;
                $Urinalysis->protein = $protein;
                $Urinalysis->urobilinogen = $urobilingen;
                $Urinalysis->nitrites = $nitrites;
                $Urinalysis->leucocytes = $leucocytes;

                $Urinalysis->pregnancy_test = $preg;
                $Urinalysis->preg_remark = $preg_remarks;
                $Urinalysis->save();
            }
    
            return redirect()->action('PatientsController@patientvisitpage',['id' => $id, 'vid' => $vid]);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function editurinalysis(Request $request)
    {      
        if(Session::has('user')){
            $uri_id = $request->input('uri_id');
            $Urinalysis = Urinalyses::where('id',$uri_id)->with('phy','user')->first();
            return Response::json($Urinalysis, 200, array(), JSON_PRETTY_PRINT);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function patientprintreport(Request $request,$id,$vid)
    {
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('NFHSI Patient PDF');

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

        $pdf->SetFont('Courier', '', 12);
        $pdf->AddPage();

        $patient = Patient::where('id',$id)->first();
        $reason = ReasonForConsulation::where('patient_id',$id)->where('visit_id',$vid)->first();
        $past = PastMedicalHistory::where('patient_id',$id)->where('visit_id',$vid)->with('surgery1001','hospitalization','disease','vaccination1001')->first();
        $social = SocialHistory::where('patient_id',$id)->where('visit_id',$vid)->first();
        $PE = PhysicalExam::where('patient_id',$id)->where('visit_id',$vid)->first();
        $diagnosis = Diagnoses::where('patient_id',$id)->where('visit_id',$vid)->first();
        $plan = Plan::where('patient_id',$id)->where('visit_id',$vid)->first();
        $p_xray = Patientxray::where('patient_id',$id)->where('visitid',$vid)->with('doctor','patient','xraydate')->first();
        $uriuri = Urinalyses::where('patient_id',$id)->where('visit_id',$vid)->with('phy')->first();
        $income = DB::table('patient_visits')->where('patient_id',$id)->where('visitid',$vid)->sum('totalbill');
        $med = Medication::where('patient_id',$id)->where('visit_id',$vid)->get();

        //return Response::json($p_xray, 200, array(), JSON_PRETTY_PRINT);

        $pdf->writeHTML(view('patientprintreport',compact('patient','reason','past','social','PE','diagnosis','plan','p_xray','uriuri','income','med'))->render());
        ob_end_clean();
        $pdf->Output('PatientReport.pdf','I');
    }

    public function editvisit(Request $request)
    {   
        $p_id = $request->input('editvisit_p_id');
        $v_id = $request->input('editvisit_v_id');
        $totalprice = $request->input('totalprice');

        if (!$request->input('discount')) {
            $asd = 0;
        }
        else {
            $asd = $request->input('discount');
        }
        $discount = str_replace('.', '', $asd);
        $aa = '.'.$discount;
        $discounted_price = $totalprice * $aa;
        $discounted_total = $totalprice - $discounted_price;

        $mainservice = count($request->input('mainservice'));
        $now = date("Y-m-d");
        $delete = PatientService::where('patient_id',$p_id)->where('visit_id',$v_id)->get();
            foreach ($delete as $del) {
                $deldel = PatientService::where('id',$del->id)->first();
                $deldel->delete();
            }

        for ($i=0; $i < $mainservice; $i++) { 
            if ($request->input('mainservice')[$i] == 5) {
                $department = 'xray';
            }
            else {
                $department = 'labtest';
            }
            $service = new PatientService;
            $service->patient_id = $p_id;
            $service->admin_panel_id = $request->input('mainservice')[$i];
            $service->admin_panel_sub_id = $request->input('service_name')[$i];
            $service->visit_id = $v_id;
            $service->department = $department;
            $service->date_reg = $now;
            $service->save();
        }

        $patientvisit = PatientVisit::where('patient_id',$p_id)->where('visitid',$v_id)->first();
        $patientvisit->discount = $asd;
        $patientvisit->totalbill = round($totalprice);
        $patientvisit->discounted_price = round($discounted_price);
        $patientvisit->discounted_total = round($discounted_total);
        $patientvisit->visit_date = $now;
        $patientvisit->purpose_visit = $request->input('purpose_visit');
        $patientvisit->save(); 

        return redirect()->action('PatientsController@patientlist');
    }

    public function newvisit1002($id)
    {
        $adminpanelcat = AdminPanelCategory::all();
        $adminpanel = AdminPanel::all();
        $sub = AdminPanelSub::all();
        $patient = Patient::where('id',$id)->first();
        //return Response::json($adminpanel, 200, array(), JSON_PRETTY_PRINT);
        return view('patientnewvisitpage',compact('adminpanelcat','adminpanel','sub','patient'));
    }

    public function modalmedication(Request $request)
    {      
        if(Session::has('user')){
            $med_id = $request->input('med_id');
            $patient_id = $request->input('patient_id');
            $visit_id = $request->input('visit_id');
            $date_start = $request->input('date_start');
            $med_drug = $request->input('med_drug');
            $med_frequency = $request->input('med_frequency');
            $med_quantity = $request->input('med_quantity');

            if (!$med_id) {
                $Medication = new Medication;
                $Medication->patient_id = $patient_id;
                $Medication->visit_id = $visit_id;
                $Medication->date_start = $date_start;
                $Medication->drug = $med_drug;
                $Medication->frequency = $med_frequency;
                $Medication->quantity = $med_quantity;
                $Medication->status = "Active";
                $Medication->save();
            }
            else {
                $Medication = Medication::where('id',$med_id)->first();
                $Medication->date_start = $date_start;
                $Medication->drug = $med_drug;
                $Medication->frequency = $med_frequency;
                $Medication->quantity = $med_quantity;
                $Medication->status = "Active";
                $Medication->save();
            }
            
            return Response::json($Medication, 200, array(), JSON_PRETTY_PRINT);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function editmedication(Request $request)
    {      
        if(Session::has('user')){
            $med_id = $request->input('med_id');

            $Medication = Medication::where('id',$med_id)->first();
            return Response::json($Medication, 200, array(), JSON_PRETTY_PRINT);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function patientreceipt(Request $request,$id,$vid,$recno)
    {   
        $pdf = new MYPDFreceipt(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('NFHSI Patient PDF');

        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        $pdf->SetMargins(0, 10, 10, true);
        $pdf->SetHeaderMargin(12);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        $pdf->SetFont('Courier', '', 12);
        $pdf->AddPage();

        $datenow = date("Y-m-d");
        $PatientService = PatientService::where('patient_id',$id)->where('visit_id',$vid)->with('adminP','adminsubP')->get();
        $totalbill = PatientVisit::where('patient_id',$id)->where('visitid',$vid)->first();
        $info = Patient::where('id',$id)->first();
        
        $check = ReceiptNumber::where('patient_id',$id)->where('visit_id',$vid)->first();
        if (!$check) {
            $ReceiptNumber = new ReceiptNumber;
            $ReceiptNumber->patient_id = $id;
            $ReceiptNumber->visit_id = $vid;
            $ReceiptNumber->receipt_number = $recno;
            $ReceiptNumber->date_reg = $datenow;
            $ReceiptNumber->save();
        }
        else {
            $check->receipt_number = $recno;
            $check->date_reg = $datenow;
            $check->save();
        }

        $PatientVisit = PatientVisit::where('patient_id',$id)->where('visitid',$vid)->first();
        $PatientVisit->status = "Paid";
        $PatientVisit->save();

        $pdf->writeHTML(view('patientreceipt',compact('PatientService','totalbill','info','recno'))->render());
        ob_end_clean();
        $pdf->Output('PatientReceiptReport.pdf','I');        
    }

    public function printpatientrx(Request $request,$id,$vid)
    {   
        if(Session::has('user')){

            $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetTitle('NFHSI Generate Rx');

            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);

            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            $pdf->SetMargins(10, 10, 10, true);
            $pdf->SetHeaderMargin(12);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                require_once(dirname(__FILE__).'/lang/eng.php');
                $pdf->setLanguageArray($l);
            }

            $pdf->SetFont('Courier', '', 12);
            $pdf->AddPage('L');

            $doctor_id = Session::get('user');
            $info = Patient::where('id',$id)->first();
            $med = Medication::where('patient_id',$id)->where('visit_id',$vid)->get();
            $doc = Doctor::where('id',$doctor_id)->first();
            $pdf->writeHTML(view('patientgeneraterx',compact('info','med','doc'))->render());
            ob_end_clean();
            $pdf->Output('PatientGenerateRx.pdf','I');

        }
        else {
            return redirect()->action('Auth@checklogin');
        }
        
    }

    public function xraypdfview(Request $request,$id)
    {   
        if(Session::has('user')){

            $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetTitle('NFHSI Patient Xray');

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

            $pdf->SetFont('Courier', '', 12);
            $pdf->AddPage();

            $Patientxray = Patientxray::where('id',$id)->with('patient','doctor','xraydate')->first();
            
            $pdf->writeHTML(view('xraypdfview',compact('Patientxray'))->render());
            ob_end_clean();
            $pdf->Output('PatientXray.pdf','I');

        }
        else {
            return redirect()->action('Auth@checklogin');
        }
        
    }

    public function urinalysispdfview(Request $request,$id)
    {   
        if(Session::has('user')){

            $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetTitle('NFHSI Patient Urinalysis');

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

            $pdf->SetFont('Courier', '', 12);
            $pdf->AddPage();

            $Urinalyses = Urinalyses::where('id',$id)->with('patient','phy')->first();
            
            $pdf->writeHTML(view('urinalysispdfview',compact('Urinalyses'))->render());
            ob_end_clean();
            $pdf->Output('PatientUrinalysis.pdf','I');

        }
        else {
            return redirect()->action('Auth@checklogin');
        }
        
    }

    public function submainservices(Request $request)
    {      
        $main_id = $request->input('main_id');

        $AdminPanel = AdminPanel::where('admin_panel_cat_id',$main_id)->get();
        return Response::json($AdminPanel, 200, array(), JSON_PRETTY_PRINT);
    }

    public function newfecalysis(Request $request, $id, $vid)
    {   
        if(Session::has('user')){
            $uri_id = $request->input('uri_id');
            $physician = $request->input('physician');
            $orno = $request->input('orno');
            $now = date("Y-m-d");
            $req_doc = $request->input('req_doc');

            $routine = $request->input('routine');
            if ($routine == "Yes") {
                $rout = $routine;
            }
            else {
                $rout = "No";
            }

            $amoeba = $request->input('amoeba');
            if ($amoeba == "Yes") {
                $amoe = $amoeba;
            }
            else {
                $amoe = "No";
            }
            
            if(!$uri_id) {
                $Fecalyses = new Fecalyses;
                $Fecalyses->patient_id = $id;
                $Fecalyses->visit_id = $vid;
                $Fecalyses->doc_id = $physician;
                $Fecalyses->date_reg = $now;
                $Fecalyses->or_no = $orno;
                $Fecalyses->req_doc = $req_doc;

                $Fecalyses->routine = $rout;
                $Fecalyses->consistency = $request->input('consistency');
                $Fecalyses->color = $request->input('color');
                $Fecalyses->red_cell = $request->input('red_cells');
                $Fecalyses->ascari = $request->input('ascaris');
                $Fecalyses->pus_cell = $request->input('pus_cells');
                $Fecalyses->trichuri = $request->input('trichuris');

                $Fecalyses->amoeba = $amoe;
                $Fecalyses->amoeba_desc = $request->input('amoeba_desc');
                $Fecalyses->hookworm = $request->input('hookworm');

                $Fecalyses->feca_other = $request->input('others_desc');
                $Fecalyses->remark = $request->input('remarks');
                $Fecalyses->save();
            }
            else {
                $Fecalyses = Fecalyses::where('id',$uri_id)->first();
                $Fecalyses->doc_id = $physician;
                $Fecalyses->or_no = $orno;
                $Fecalyses->req_doc = $req_doc;

                $Fecalyses->routine = $rout;
                $Fecalyses->consistency = $request->input('consistency');
                $Fecalyses->color = $request->input('color');
                $Fecalyses->red_cell = $request->input('red_cells');
                $Fecalyses->ascari = $request->input('ascaris');
                $Fecalyses->pus_cell = $request->input('pus_cells');
                $Fecalyses->trichuri = $request->input('trichuris');

                $Fecalyses->amoeba = $amoe;
                $Fecalyses->amoeba_desc = $request->input('amoeba_desc');
                $Fecalyses->hookworm = $request->input('hookworm');

                $Fecalyses->feca_other = $request->input('others_desc');
                $Fecalyses->remark = $request->input('remarks');
                $Fecalyses->save();
            }
    
            return redirect()->action('PatientsController@patientvisitpage',['id' => $id, 'vid' => $vid]);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function newchemistryii(Request $request, $id, $vid)
    {   
        if(Session::has('user')){
            $uri_id = $request->input('uri_id');
            $physician = $request->input('physician');
            $orno = $request->input('orno');
            $now = date("Y-m-d");
            // 1st
            $blood_sugar = $request->input('blood_sugar');
            if ($blood_sugar == "Yes") {
                $bloodsugar = $blood_sugar;
            }
            else {
                $bloodsugar = "No";
            }
            $fasting = $request->input('fasting');
            if ($fasting == "Yes") {
                $fasting1002 = $fasting;
            }
            else {
                $fasting1002 = "No";
            }
            $ppbs = $request->input('ppbs');
            if ($ppbs == "Yes") {
                $ppbs1002 = $ppbs;
            }
            else {
                $ppbs1002 = "No";
            }
            $random = $request->input('random');
            if ($random == "Yes") {
                $random1002 = $random;
            }
            else {
                $random1002 = "No";
            }
            $hbaic = $request->input('hbaic');
            if ($hbaic == "Yes") {
                $hbaic1002 = $hbaic;
            }
            else {
                $hbaic1002 = "No";
            }
            // 2nd
            $kidney_function = $request->input('kidney_function');
            if ($kidney_function == "Yes") {
                $kidneyfunction = $kidney_function;
            }
            else {
                $kidneyfunction = "No";
            }
            $creatinine = $request->input('creatinine');
            if ($creatinine == "Yes") {
                $creatinine1002 = $creatinine;
            }
            else {
                $creatinine1002 = "No";
            }
            $bun = $request->input('bun');
            if ($bun == "Yes") {
                $bun1002 = $bun;
            }
            else {
                $bun1002 = "No";
            }
            $uricacid = $request->input('uricacid');
            if ($uricacid == "Yes") {
                $uricacid1002 = $uricacid;
            }
            else {
                $uricacid1002 = "No";
            }
            // 3rd
            $liver_function = $request->input('liver_function');
            if ($liver_function == "Yes") {
                $liverfunction = $liver_function;
            }
            else {
                $liverfunction = "No";
            }
            $sgpt = $request->input('sgpt');
            if ($sgpt == "Yes") {
                $sgpt1002 = $sgpt;
            }
            else {
                $sgpt1002 = "No";
            }
            $sgot = $request->input('sgot');
            if ($sgot == "Yes") {
                $sgot1002 = $sgot;
            }
            else {
                $sgot1002 = "No";
            }
            $alk_phos = $request->input('alk_phos');
            if ($alk_phos == "Yes") {
                $alk_phos1002 = $alk_phos;
            }
            else {
                $alk_phos1002 = "No";
            }
            // 4th
            $lipid_profile = $request->input('lipid_profile');
            if ($lipid_profile == "Yes") {
                $lipidprofile = $lipid_profile;
            }
            else {
                $lipidprofile = "No";
            }
            $hdl_cholesterol = $request->input('hdl_cholesterol');
            if ($hdl_cholesterol == "Yes") {
                $hdl_cholesterol1002 = $hdl_cholesterol;
            }
            else {
                $hdl_cholesterol1002 = "No";
            }
            $triglycerides = $request->input('triglycerides');
            if ($triglycerides == "Yes") {
                $triglycerides1002 = $triglycerides;
            }
            else {
                $triglycerides1002 = "No";
            }
            $total_cholesterol = $request->input('total_cholesterol');
            if ($total_cholesterol == "Yes") {
                $total_cholesterol1002 = $total_cholesterol;
            }
            else {
                $total_cholesterol1002 = "No";
            }
            $ldl_cholesterol = $request->input('ldl_cholesterol');
            if ($ldl_cholesterol == "Yes") {
                $ldl_cholesterol1002 = $ldl_cholesterol;
            }
            else {
                $ldl_cholesterol1002 = "No";
            }
            $tc_hdl_ratio = $request->input('tc_hdl_ratio');
            if ($tc_hdl_ratio == "Yes") {
                $tc_hdl_ratio1002 = $tc_hdl_ratio;
            }
            else {
                $tc_hdl_ratio1002 = "No";
            }
            // 5th
            $electrolytes = $request->input('electrolytes');
            if ($electrolytes == "Yes") {
                $electrolytes2 = $electrolytes;
            }
            else {
                $electrolytes2 = "No";
            }
            $sodium = $request->input('sodium');
            if ($sodium == "Yes") {
                $sodium1002 = $sodium;
            }
            else {
                $sodium1002 = "No";
            }
            $potassium = $request->input('potassium');
            if ($potassium == "Yes") {
                $potassium1002 = $potassium;
            }
            else {
                $potassium1002 = "No";
            }
            $calcium = $request->input('calcium');
            if ($calcium == "Yes") {
                $calcium1002 = $calcium;
            }
            else {
                $calcium1002 = "No";
            }

            if(!$uri_id) {
                $Chemistry = new Chemistry;
                $Chemistry->patient_id = $id;
                $Chemistry->visit_id = $vid;
                $Chemistry->doc_id = $physician;
                $Chemistry->date_reg = $now;
                $Chemistry->or_no = $orno;

                $Chemistry->blood_sugar = $blood_sugar;
                $Chemistry->fasting = $fasting1002;
                $Chemistry->fasting_result = $request->input('fasting_result');
                $Chemistry->hours_ppbs = $ppbs1002;
                $Chemistry->ppbs_result = $request->input('ppbs_result');
                $Chemistry->random = $random1002;
                $Chemistry->random_result = $request->input('random_result');
                $Chemistry->hbaic = $hbaic1002;
                $Chemistry->hbaic_result = $request->input('hbaic_result');

                $Chemistry->kidney_function = $kidneyfunction;
                $Chemistry->creatinine = $creatinine1002;
                $Chemistry->creatinine_result = $request->input('creatinine_result');
                $Chemistry->bun = $bun1002;
                $Chemistry->bun_result = $request->input('bun_result');
                $Chemistry->uric_acid = $uricacid1002;
                $Chemistry->uric_acid_result = $request->input('uricacid_result');

                $Chemistry->liver_function = $liverfunction;
                $Chemistry->sgpt = $sgpt1002;
                $Chemistry->sgpt_result = $request->input('sgpt_result');
                $Chemistry->sgot = $sgot1002;
                $Chemistry->sgot_result = $request->input('sgot_result');
                $Chemistry->alk_phos = $alk_phos1002;
                $Chemistry->alk_phos_result = $request->input('alk_phos_result');

                $Chemistry->lipid_profile = $lipidprofile;
                $Chemistry->hdl_cholesterol = $hdl_cholesterol1002;
                $Chemistry->hdl_cholesterol_result = $request->input('hdl_cholesterol_result');
                $Chemistry->triglycerides = $triglycerides1002;
                $Chemistry->triglycerides_result = $request->input('triglycerides_result');
                $Chemistry->total_cholesterol = $total_cholesterol1002;
                $Chemistry->total_cholesterol_result = $request->input('total_cholesterol_result');
                $Chemistry->ldl_cholesterol = $ldl_cholesterol1002;
                $Chemistry->ldl_cholesterol_result = $request->input('ldl_cholesterol_result');
                $Chemistry->tc_hdl_ratio = $tc_hdl_ratio1002;
                $Chemistry->tc_hdl_ratio_result = $request->input('tc_hdl_ratio_result');

                $Chemistry->electrolytes = $electrolytes2;
                $Chemistry->sodium = $sodium1002;
                $Chemistry->sodium_result = $request->input('sodium_result');
                $Chemistry->potassium = $potassium1002;
                $Chemistry->potassium_result = $request->input('potassium_result');
                $Chemistry->calcium = $calcium1002;
                $Chemistry->calcium_result = $request->input('calcium_result');

                $Chemistry->chem_other = $request->input('chem_others');
                $Chemistry->remark = $request->input('chem_remarks');
                $Chemistry->save();
            }
            else {
                $Chemistry = Chemistry::where('id',$uri_id)->first();
                $Chemistry->doc_id = $physician;
                $Chemistry->or_no = $orno;

                $Chemistry->blood_sugar = $blood_sugar;
                $Chemistry->fasting = $fasting1002;
                $Chemistry->fasting_result = $request->input('fasting_result');
                $Chemistry->hours_ppbs = $ppbs1002;
                $Chemistry->ppbs_result = $request->input('ppbs_result');
                $Chemistry->random = $random1002;
                $Chemistry->random_result = $request->input('random_result');
                $Chemistry->hbaic = $hbaic1002;
                $Chemistry->hbaic_result = $request->input('hbaic_result');

                $Chemistry->kidney_function = $kidneyfunction;
                $Chemistry->creatinine = $creatinine1002;
                $Chemistry->creatinine_result = $request->input('creatinine_result');
                $Chemistry->bun = $bun1002;
                $Chemistry->bun_result = $request->input('bun_result');
                $Chemistry->uric_acid = $uricacid1002;
                $Chemistry->uric_acid_result = $request->input('uricacid_result');

                $Chemistry->liver_function = $liverfunction;
                $Chemistry->sgpt = $sgpt1002;
                $Chemistry->sgpt_result = $request->input('sgpt_result');
                $Chemistry->sgot = $sgot1002;
                $Chemistry->sgot_result = $request->input('sgot_result');
                $Chemistry->alk_phos = $alk_phos1002;
                $Chemistry->alk_phos_result = $request->input('alk_phos_result');

                $Chemistry->lipid_profile = $lipidprofile;
                $Chemistry->hdl_cholesterol = $hdl_cholesterol1002;
                $Chemistry->hdl_cholesterol_result = $request->input('hdl_cholesterol_result');
                $Chemistry->triglycerides = $triglycerides1002;
                $Chemistry->triglycerides_result = $request->input('triglycerides_result');
                $Chemistry->total_cholesterol = $total_cholesterol1002;
                $Chemistry->total_cholesterol_result = $request->input('total_cholesterol_result');
                $Chemistry->ldl_cholesterol = $ldl_cholesterol1002;
                $Chemistry->ldl_cholesterol_result = $request->input('ldl_cholesterol_result');
                $Chemistry->tc_hdl_ratio = $tc_hdl_ratio1002;
                $Chemistry->tc_hdl_ratio_result = $request->input('tc_hdl_ratio_result');

                $Chemistry->electrolytes = $electrolytes2;
                $Chemistry->sodium = $sodium1002;
                $Chemistry->sodium_result = $request->input('sodium_result');
                $Chemistry->potassium = $potassium1002;
                $Chemistry->potassium_result = $request->input('potassium_result');
                $Chemistry->calcium = $calcium1002;
                $Chemistry->calcium_result = $request->input('calcium_result');

                $Chemistry->chem_other = $request->input('chem_others');
                $Chemistry->remark = $request->input('chem_remarks');
                $Chemistry->save();
            }
    
            return redirect()->action('PatientsController@patientvisitpage',['id' => $id, 'vid' => $vid]);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function newogtt(Request $request, $id, $vid)
    {   
        if(Session::has('user')){
            $uri_id = $request->input('uri_id');
            $physician = $request->input('physician');
            $orno = $request->input('orno');
            $now = date("Y-m-d");

            // 1st
            $fif_gram = $request->input('50_grams');
            if ($fif_gram == "Yes") {
                $fgram = $fif_gram;
            }
            else {
                $fgram = "No";
            }
            $firsthour = $request->input('firsthour');
            if ($firsthour == "Yes") {
                $firsthour1002 = $firsthour;
            }
            else {
                $firsthour1002 = "No";
            }
            // 2nd
            $sevfi_gram = $request->input('75_grams');
            if ($sevfi_gram == "Yes") {
                $sv_gram = $sevfi_gram;
            }
            else {
                $sv_gram = "No";
            }
            $fasting_oggt = $request->input('fasting_oggt');
            if ($fasting_oggt == "Yes") {
                $fasting_oggt1002 = $fasting_oggt;
            }
            else {
                $fasting_oggt1002 = "No";
            }
            $firshour_oggt = $request->input('firshour_oggt');
            if ($firshour_oggt == "Yes") {
                $firshour_oggt1002 = $firshour_oggt;
            }
            else {
                $firshour_oggt1002 = "No";
            }
            $secondhour_oggt = $request->input('secondhour_oggt');
            if ($secondhour_oggt == "Yes") {
                $secondhour_oggt1002 = $secondhour_oggt;
            }
            else {
                $secondhour_oggt1002 = "No";
            }
            // 3rd
            $onhu_gram = $request->input('100_grams');
            if ($onhu_gram == "Yes") {
                $oh_gram = $onhu_gram;
            }
            else {
                $oh_gram = "No";
            }
            $fasting_oggt_grams = $request->input('fasting_oggt_grams');
            if ($fasting_oggt_grams == "Yes") {
                $fasting_oggt_grams1002 = $fasting_oggt_grams;
            }
            else {
                $fasting_oggt_grams1002 = "No";
            }
            $firshour_oggt_grams = $request->input('firshour_oggt_grams');
            if ($firshour_oggt_grams == "Yes") {
                $firshour_oggt_grams1002 = $firshour_oggt_grams;
            }
            else {
                $firshour_oggt_grams1002 = "No";
            }
            $secondhour_oggt_grams = $request->input('secondhour_oggt_grams');
            if ($secondhour_oggt_grams == "Yes") {
                $secondhour_oggt_grams1002 = $secondhour_oggt_grams;
            }
            else {
                $secondhour_oggt_grams1002 = "No";
            }
            $thirdhour_oggt_grams = $request->input('thirdhour_oggt_grams');
            if ($thirdhour_oggt_grams == "Yes") {
                $thirdhour_oggt_grams1002 = $thirdhour_oggt_grams;
            }
            else {
                $thirdhour_oggt_grams1002 = "No";
            }
            
            if(!$uri_id) {
                $Ogtt = new Ogtt;
                $Ogtt->patient_id = $id;
                $Ogtt->visit_id = $vid;
                $Ogtt->doc_id = $physician;
                $Ogtt->date_reg = $now;
                $Ogtt->or_no = $orno;

                $Ogtt->fifty_gram = $fgram;
                $Ogtt->first_hour = $firsthour1002;
                $Ogtt->first_hour_result = $request->input('firsthour_result');

                $Ogtt->seventy_five_gram = $sv_gram;
                $Ogtt->fasting = $fasting_oggt1002;
                $Ogtt->fasting_result = $request->input('fasting_oggt_result');
                $Ogtt->sv_first_hour = $firshour_oggt1002;
                $Ogtt->sv_first_hour_result = $request->input('firshour_oggt_result');
                $Ogtt->sv_second_hour = $secondhour_oggt1002;
                $Ogtt->sv_second_hour_result = $request->input('secondhour_oggt_result');

                $Ogtt->one_hundred_gram = $oh_gram;
                $Ogtt->oh_fasting = $fasting_oggt_grams1002;
                $Ogtt->oh_fasting_result = $request->input('fasting_oggt_grams_result');
                $Ogtt->oh_first_hour = $firshour_oggt_grams1002;
                $Ogtt->oh_first_hour_result = $request->input('firshour_oggt_grams_result');
                $Ogtt->oh_second_hour = $secondhour_oggt_grams1002;
                $Ogtt->oh_second_hour_result = $request->input('secondhour_oggt_grams_result');
                $Ogtt->oh_third_hour = $thirdhour_oggt_grams1002;
                $Ogtt->oh_third_hour_result = $request->input('thirdhour_oggt_grams_result');

                $Ogtt->save();
            }
            else {
                $Ogtt = Ogtt::where('id',$uri_id)->first();
                $Ogtt->doc_id = $physician;
                $Ogtt->or_no = $orno;

                $Ogtt->fifty_gram = $fgram;
                $Ogtt->first_hour = $firsthour1002;
                $Ogtt->first_hour_result = $request->input('firsthour_result');

                $Ogtt->seventy_five_gram = $sv_gram;
                $Ogtt->fasting = $fasting_oggt1002;
                $Ogtt->fasting_result = $request->input('fasting_oggt_result');
                $Ogtt->sv_first_hour = $firshour_oggt1002;
                $Ogtt->sv_first_hour_result = $request->input('firshour_oggt_result');
                $Ogtt->sv_second_hour = $secondhour_oggt1002;
                $Ogtt->sv_second_hour_result = $request->input('secondhour_oggt_result');

                $Ogtt->one_hundred_gram = $oh_gram;
                $Ogtt->oh_fasting = $fasting_oggt_grams1002;
                $Ogtt->oh_fasting_result = $request->input('fasting_oggt_grams_result');
                $Ogtt->oh_first_hour = $firshour_oggt_grams1002;
                $Ogtt->oh_first_hour_result = $request->input('firshour_oggt_grams_result');
                $Ogtt->oh_second_hour = $secondhour_oggt_grams1002;
                $Ogtt->oh_second_hour_result = $request->input('secondhour_oggt_grams_result');
                $Ogtt->oh_third_hour = $thirdhour_oggt_grams1002;
                $Ogtt->oh_third_hour_result = $request->input('thirdhour_oggt_grams_result');

                $Ogtt->save();
            }
    
            return redirect()->action('PatientsController@patientvisitpage',['id' => $id, 'vid' => $vid]);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function newhematology(Request $request, $id, $vid)
    {   
        if(Session::has('user')){
            $uri_id = $request->input('uri_id');
            $physician = $request->input('physician');
            $orno = $request->input('orno');
            $now = date("Y-m-d");

            // 1st
            $cbc = $request->input('cbc');
            if ($cbc == "Yes") {
                $cbc1002 = $cbc;
            }
            else {
                $cbc1002 = "No";
            }
            $hematocrit = $request->input('hematocrit');
            if ($hematocrit == "Yes") {
                $hematocrit1002 = $hematocrit;
            }
            else {
                $hematocrit1002 = "No";
            }
            $hemoglobin = $request->input('hemoglobin');
            if ($hemoglobin == "Yes") {
                $hemoglobin1002 = $hemoglobin;
            }
            else {
                $hemoglobin1002 = "No";
            }
            $wbc = $request->input('wbc');
            if ($wbc == "Yes") {
                $wbc1002 = $wbc;
            }
            else {
                $wbc1002 = "No";
            }
            // 2nd
            $protime = $request->input('protime');
            if ($protime == "Yes") {
                $protime1002 = $protime;
            }
            else {
                $protime1002 = "No";
            }
            // 3rd
            $cellindices = $request->input('cellindices');
            if ($cellindices == "Yes") {
                $cellindices1002 = $cellindices;
            }
            else {
                $cellindices1002 = "No";
            }
            // 4th
            $clotting_lw = $request->input('clotting_lw');
            if ($clotting_lw == "Yes") {
                $clotting_lw1002 = $clotting_lw;
            }
            else {
                $clotting_lw1002 = "No";
            }
            $clotting = $request->input('clotting');
            if ($clotting == "Yes") {
                $clotting1002 = $clotting;
            }
            else {
                $clotting1002 = "No";
            }
            $bleeding = $request->input('bleeding');
            if ($bleeding == "Yes") {
                $bleeding1002 = $bleeding;
            }
            else {
                $bleeding1002 = "No";
            }
            $clot = $request->input('clot');
            if ($clot == "Yes") {
                $clot1002 = $clot;
            }
            else {
                $clot1002 = "No";
            }
            $platelet = $request->input('platelet');
            if ($platelet == "Yes") {
                $platelet1002 = $platelet;
            }
            else {
                $platelet1002 = "No";
            }
            $esr = $request->input('esr');
            if ($esr == "Yes") {
                $esr1002 = $esr;
            }
            else {
                $esr1002 = "No";
            }
            $grp = $request->input('grp');
            if ($grp == "Yes") {
                $grp1002 = $grp;
            }
            else {
                $grp1002 = "No";
            }
            $smp = $request->input('smp');
            if ($smp == "Yes") {
                $smp1002 = $smp;
            }
            else {
                $smp1002 = "No";
            }
            $retic = $request->input('retic');
            if ($retic == "Yes") {
                $retic1002 = $retic;
            }
            else {
                $retic1002 = "No";
            }
            $rbc = $request->input('rbc');
            if ($rbc == "Yes") {
                $rbc1002 = $rbc;
            }
            else {
                $rbc1002 = "No";
            }
            
            if(!$uri_id) {
                $Hematology = new Hematology;
                $Hematology->patient_id = $id;
                $Hematology->visit_id = $vid;
                $Hematology->doc_id = $physician;
                $Hematology->date_reg = $now;
                $Hematology->or_no = $orno;

                $Hematology->cbc = $cbc1002;
                $Hematology->hematocrit = $hematocrit1002;
                $Hematology->hematocrit_desc = $request->input('hematocrit_desc');
                $Hematology->hemoglobin = $hemoglobin1002;
                $Hematology->hemoglobin_desc = $request->input('hemoglobin_desc');
                $Hematology->wbc = $wbc1002;
                $Hematology->wbc_desc = $request->input('wbc_desc');

                $Hematology->dc_band = $request->input('band');
                $Hematology->dc_pmn = $request->input('pmn');
                $Hematology->dc_baso = $request->input('baso');
                $Hematology->dc_eos = $request->input('eos');
                $Hematology->dc_mono = $request->input('mono');
                $Hematology->dc_lymph = $request->input('lymphs');

                $Hematology->protime = $protime1002;
                $Hematology->control_desc = $request->input('control_desc');
                $Hematology->patient_desc = $request->input('patient_desc');
                $Hematology->a_desc = $request->input('a_desc');
                $Hematology->inr_desc = $request->input('inr_desc');

                $Hematology->cellindice = $cellindices1002;
                $Hematology->mcv_desc = $request->input('mcv_desc');
                $Hematology->mch_desc = $request->input('indices_mch_desc');
                $Hematology->mchc_desc = $request->input('mchc_desc');

                $Hematology->clottinglw = $clotting_lw1002;
                $Hematology->clottinglw_time = $request->input('clotting_lw_desc');
                $Hematology->clotting = $clotting1002;
                $Hematology->clotting_time = $request->input('clotting_desc');
                $Hematology->bleedingdm = $bleeding1002;
                $Hematology->bleedingdm_time = $request->input('bleeding_desc');
                $Hematology->clot = $clot1002;
                $Hematology->clot_retraction = $request->input('clot_desc');
                $Hematology->platelet = $platelet1002;
                $Hematology->platelet_count = $request->input('platelet_desc');
                $Hematology->esr = $esr1002;
                $Hematology->esr_desc = $request->input('esr_desc');
                $Hematology->grp = $grp1002;
                $Hematology->grp_desc = $request->input('grp_desc');
                $Hematology->rh_desc = $request->input('rh_desc');
                $Hematology->smp = $smp1002;
                $Hematology->smp_desc = $request->input('smp_desc');
                $Hematology->retic = $retic1002;
                $Hematology->retic_desc = $request->input('retic_desc');
                $Hematology->rbc = $rbc1002;
                $Hematology->rbc_desc = $request->input('rbc_desc');

                $Hematology->save();
            }
            else {
                $Hematology = Hematology::where('id',$uri_id)->first();
                $Hematology->doc_id = $physician;
                $Hematology->or_no = $orno;

                $Hematology->cbc = $cbc1002;
                $Hematology->hematocrit = $hematocrit1002;
                $Hematology->hematocrit_desc = $request->input('hematocrit_desc');
                $Hematology->hemoglobin = $hemoglobin1002;
                $Hematology->hemoglobin_desc = $request->input('hemoglobin_desc');
                $Hematology->wbc = $wbc1002;
                $Hematology->wbc_desc = $request->input('wbc_desc');

                $Hematology->dc_band = $request->input('band');
                $Hematology->dc_pmn = $request->input('pmn');
                $Hematology->dc_baso = $request->input('baso');
                $Hematology->dc_eos = $request->input('eos');
                $Hematology->dc_mono = $request->input('mono');
                $Hematology->dc_lymph = $request->input('lymphs');

                $Hematology->protime = $protime1002;
                $Hematology->control_desc = $request->input('control_desc');
                $Hematology->patient_desc = $request->input('patient_desc');
                $Hematology->a_desc = $request->input('a_desc');
                $Hematology->inr_desc = $request->input('inr_desc');

                $Hematology->cellindice = $cellindices1002;
                $Hematology->mcv_desc = $request->input('mcv_desc');
                $Hematology->mch_desc = $request->input('indices_mch_desc');
                $Hematology->mchc_desc = $request->input('mchc_desc');

                $Hematology->clottinglw = $clotting_lw1002;
                $Hematology->clottinglw_time = $request->input('clotting_lw_desc');
                $Hematology->clotting = $clotting1002;
                $Hematology->clotting_time = $request->input('clotting_desc');
                $Hematology->bleedingdm = $bleeding1002;
                $Hematology->bleedingdm_time = $request->input('bleeding_desc');
                $Hematology->clot = $clot1002;
                $Hematology->clot_retraction = $request->input('clot_desc');
                $Hematology->platelet = $platelet1002;
                $Hematology->platelet_count = $request->input('platelet_desc');
                $Hematology->esr = $esr1002;
                $Hematology->esr_desc = $request->input('esr_desc');
                $Hematology->grp = $grp1002;
                $Hematology->grp_desc = $request->input('grp_desc');
                $Hematology->rh_desc = $request->input('rh_desc');
                $Hematology->smp = $smp1002;
                $Hematology->smp_desc = $request->input('smp_desc');
                $Hematology->retic = $retic1002;
                $Hematology->retic_desc = $request->input('retic_desc');
                $Hematology->rbc = $rbc1002;
                $Hematology->rbc_desc = $request->input('rbc_desc');

                $Hematology->save();
            }
    
            return redirect()->action('PatientsController@patientvisitpage',['id' => $id, 'vid' => $vid]);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function editvisitdate(Request $request)
    {   
        $PatientVisit = PatientVisit::where('id',$request->input('vid'))->first();
        $PatientVisit->visit_date = $request->input('vdate');
        $PatientVisit->save();

        $PatientService = PatientService::where('patient_id',$PatientVisit->patient_id)->where('visit_id',$PatientVisit->visitid)->get();
        foreach ($PatientService as $key) {
            $service = PatientService::where('id',$key->id)->first();
            $service->date_reg = $request->input('vdate');
            $service->save();
        }

        return redirect()->action('PatientsController@patientlist');
    }

    public function donevisit(Request $request)
    {   
        $id = $request->input('patient_id');
        $vid = $request->input('visit_id');
        $PatientVisit = PatientVisit::where('patient_id',$id)->where('visitid',$vid)->first();
        $PatientVisit->status = 'Done';
        $PatientVisit->save();

        $PatientService = PatientService::where('patient_id',$id)->where('visit_id',$vid)->get();
        foreach ($PatientService as $key) {
            $service = PatientService::where('id',$key->id)->first();
            $service->status = 'Done';
            $service->save();
        }
        return Response::json($PatientVisit, 200, array(), JSON_PRETTY_PRINT);
    }

    public function cancelvisit(Request $request)
    {   
        $id = $request->input('patient_id');
        $vid = $request->input('visit_id');
        $PatientVisit = PatientVisit::where('patient_id',$id)->where('visitid',$vid)->first();
        $PatientVisit->status = 'Canceled';
        $PatientVisit->save();

        $PatientService = PatientService::where('patient_id',$id)->where('visit_id',$vid)->get();
        foreach ($PatientService as $key) {
            $service = PatientService::where('id',$key->id)->first();
            $service->status = 'Canceled';
            $service->save();
        }
        return Response::json($PatientVisit, 200, array(), JSON_PRETTY_PRINT);
    }

    public function patientvisitxraydone(Request $request, $id, $vid)
    {   
        if(Session::has('user')){
            $datenow = date("Y-m-d");
            $patientxray = Patientxray::where('patient_id',$id)->where('visitid',$vid)->first();
            $patientxray->status = "Old";
            $patientxray->save();

            $logs = new PatientXrayLog;
            $logs->xray_id = $patientxray->id;
            $logs->user_id = Session::get('user');
            $logs->date = $datenow;
            $logs->action = "Done";
            $logs->save();

            $PatientService = PatientService::where('patient_id',$id)->where('visit_id',$vid)->where('admin_panel_id',35)->first();
            $PatientService->status = "Done";
            $PatientService->save();
    
           return redirect()->action('PatientsController@patientvisitpage',['id' => $id, 'vid' => $vid]);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function checkreceipt(Request $request)
    {   
        $patient_id = $request->input('patient_id');
        $visit_id = $request->input('visit_id');
        $ReceiptNumber = ReceiptNumber::where('patient_id',$patient_id)->where('visit_id',$visit_id)->first();
        return Response::json($ReceiptNumber, 200, array(), JSON_PRETTY_PRINT);
    }

}
