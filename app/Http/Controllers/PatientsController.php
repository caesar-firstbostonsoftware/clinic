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

class PatientsController extends Controller
{

	public function newvisit()
    {
        $adminpanelcat = AdminPanelCategory::all();
        $adminpanel = AdminPanel::all();
        $sub = AdminPanelSub::all();
        //return Response::json($adminpanel, 200, array(), JSON_PRETTY_PRINT);
    	return view('patientnewvisitpage',compact('adminpanelcat','adminpanel','sub'));
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
        $purpose_visit = $request->input('purpose_visit');

        $services = $request->input('services');

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
        $patientvisit->purpose_visit = $purpose_visit;
    	$patientvisit->save();

        foreach ($services as $key) {
            $explode = explode('-', $key);
            $fisrt = $explode[0];
            $second = $explode[1];

            $service = new PatientService;
            $service->patient_id = $patient->id;
            $service->admin_panel_id = $fisrt;
            $service->admin_panel_sub_id = $second;
            $service->save();
        }

        Session::flash('alert-success', 'Personal Info Created.');
    	return redirect()->action('PatientsController@patientvisitpage',['id' => $patient->id, 'vid' => $patientvisit->visitid]);
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
            }
            elseif($doctor_id == 1 ) {
                // $patientlist = Doctor::join('patientxrays','doctors.id','=','patientxrays.physician_id')
                // ->leftJoin('patients','patientxrays.patient_id','=','patients.id')
                // ->select('patients.*','doctors.f_name as doctor_fname','doctors.m_name as doctor_mname','doctors.l_name as doctor_lname','doctors.credential as doctor_credential')
                // ->get();

                $patientlist = Patient::all();
            }
            else {
                $patientlist = Patient::all();
            }
            //return Response::json($patientlist, 200, array(), JSON_PRETTY_PRINT);
            return view('patientlistpage',compact('patientlist','adminpanelcat','adminpanel','sub'));
            
        }
        else {
            $patientlist = Patient::all();
            return view('patientlistpage',compact('patientlist'));
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
        else if($doctor_id == 1) {
            $patientxray = Patientxray::where('patient_id',$id)->where('visitid',$vid)->get();
            $xraycount = Patientxray::where('patient_id',$id)->where('visitid',$vid)->count();

            $Urinalysis = Urinalyses::where('patient_id',$id)->where('visit_id',$vid)->get();
            $uricount = Urinalyses::where('patient_id',$id)->where('visit_id',$vid)->count();
        }
        else if ($doctor_id != 1 && $doctor_pos == "Doctor") {
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
            ->where('patients.id',$id)
            ->select('patients.*','patient_visits.purpose_visit')
            ->first();
    	$doctor = Doctor::with('user')->get();
        $adminpanel = AdminPanelCategory::with('adminpanel')->get();
    	return view('patientvisitpage',compact('id','vid','patientxray','patient','doctor','reasonforconsulation','PMH','PMH_sur','PMH_hos','PMH_dis','PMH_vacc','SH','PE','diagnosis','plan','xraycount','Urinalysis','uricount','adminpanel'));
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
    	$patientvisit = PatientVisit::where('patient_id',$p_id)->get();
    	return Response::json($patientvisit, 200, array(), JSON_PRETTY_PRINT);
    }

    public function modalaeditpatient(Request $request)
    {   
        if(Session::has('user')){
            $p_id = $request->input('p_id');
            $patient = Patient::join('patient_visits','patients.id','=','patient_visits.patient_id')
            ->where('patients.id',$p_id)
            ->select('patients.*','patient_visits.purpose_visit','patient_visits.visitid','patient_visits.id as patient_visit_id')
            ->first();
            $adminpanel = PatientService::where('patient_id',$p_id)->get();
            return Response::json(['patient' => $patient,'adminpanel' => $adminpanel], 200, array(), JSON_PRETTY_PRINT);
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function editpatient(Request $request)
    {   
        if(Session::has('user')){
            $p_id = $request->input('p_id');
            $fname = $request->input('fname');
            $mname = $request->input('mname');
            $lname = $request->input('lname');
            $address = $request->input('address');
            $gender = $request->input('gender');
            $dob = $request->input('dob');
            $age = $request->input('age');

            $patient_visit_id = $request->input('patient_visit_id');
            $purpose_visit = $request->input('purpose_visit');

            $services = $request->input('services');
            //return $fname.' *** '.$mname.' *** '.$lname.' *** '.$address.' *** '.$gender.' *** '.$dob.' *** '.$age;
            $patient = Patient::where('id',$p_id)->first();
            $patient->f_name = $fname;
            $patient->m_name = $mname;
            $patient->l_name = $lname;
            $patient->gender = $gender;
            $patient->dob = $dob;
            $patient->age = $age;
            $patient->address = $address;
            $patient->save();

            $delete = PatientService::where('patient_id',$p_id)->get();
                foreach ($delete as $del) {
                   $deldel = PatientService::where('id',$del->id)->first();
                   $deldel->delete();
                }

            foreach ($services as $key) {
                $explode = explode('-', $key);
                $fisrt = $explode[0];
                $second = $explode[1];

                $service = new PatientService;
                $service->patient_id = $patient->id;
                $service->admin_panel_id = $fisrt;
                $service->admin_panel_sub_id = $second;
                $service->save();
            }

            $patientvisit = PatientVisit::where('id',$patient_visit_id)->first();
            $patientvisit->purpose_visit = $purpose_visit;
            $patientvisit->save(); 

            return redirect()->action('PatientsController@patientlist');
        }
        else {
            return redirect()->action('Auth@checklogin');
        }
    }

    public function modalxrayedit(Request $request)
    {   
        if(Session::has('user')){
            $xray_id = $request->input('dataid');
            //$patientxray = Patientxray::where('id',$xray_id)->first();
            $patientxray = Patientxray::join('doctors','patientxrays.physician_id','=','doctors.id')
            ->where('patientxrays.id',$xray_id)
            ->select('doctors.*','patientxrays.id as xray_id','patientxrays.xray_date','patientxrays.finding','patientxrays.finding_info')
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
            $PatientXrayLog = PatientXrayLog::where('xray_id',$dataid)->get();
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

    
}
