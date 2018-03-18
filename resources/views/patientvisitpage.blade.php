<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

@section('htmlheader')
    @include('adminlte::layouts.partials.htmlheader')
@show

<style type="text/css">
    .modalwidth{
        width: 75%;
    }
    .modalwidthuri{
        width: 80%;
    }
</style>

<body class="skin-blue sidebar-mini">
<div id="app" v-cloak>
    <div class="wrapper">

    @include('adminlte::layouts.partials.mainheader')

<aside class="main-sidebar">
    <ul class="sidebar-menu">
        <li class="header"><b style="color: white;font-size: 7.5pt;">NEGROS FAMILY HEALTH SERVICES, INC.</b></li>
        @if(Session::get('position') == "Doctor" && Session::get('user') == 1)
        <li><a href="/dashboard"><img src="{{ asset('/img/2001.png') }}" height="20" width="20"> <span>Dashboard</span></a></li>
        @endif
        @if(Session::get('position') == "Doctor" || Session::get('position') == "Xray" || Session::get('position') == "Labtest" || Session::get('position') == "Cashier")
        <li><a href="/myinfo"><img src="{{ asset('/img/2009.png') }}" height="20" width="20"> <span>My Info</span></a></li>
        @endif
        @if(Session::get('user') == 1 || Session::get('position') == "Cashier" || Session::get('position') == 'Labtest')
        <li><a href="/company"><img src="{{ asset('/img/company.png') }}" height="20" width="20"> <span>Company</span></a></li>
        @endif
        
        <li class="treeview active"><a href="/NFHSI"><img src="{{ asset('/img/2010.png') }}" height="20" width="20"> <span>Patients</span><span class="pull-right-container"></span></a>
            <ul style="display: block;" class="treeview-menu menu-open">
            @if(Session::get('user') == 1 || Session::get('position') == "Cashier" || Session::get('position') == 'Labtest')
                <li class="active"><a href="/newvisit"><i class="fa fa-circle-o"></i> New Visit</a></li>
            @endif
                <li><a href="/NFHSI"><i class="fa fa-circle-o"></i> Patient List</a></li>
            @if(Session::get('position') == "Doctor")
                <li><a href="/generate/medcert"><i class="fa fa-circle-o"></i> Create Medical Certificate</a></li>
            @endif
            </ul>
        </li>

        @if(Session::get('user') == 1)
        <li><a href="/NFHSI/queueing"><img src="{{ asset('/img/queueing.png') }}" height="20" width="20"> <span>Queueing</span></a></li>
        <li><a href="/NFHSI/users"><img src="{{ asset('/img/2012.png') }}" height="20" width="20"> <span>Users</span></a></li>
        <li><a href="/NFHSI/doctors"><img src="{{ asset('/img/2013.png') }}" height="20" width="20"> <span>Doctors</span></a></li>
        <li><a href="/reports/{{Session::get('user')}}"><img src="{{ asset('/img/2014.png') }}" height="20" width="20"> <span>Reports</span></a></li>
        <li><a href="/NFHSI/services"><img src="{{ asset('/img/2015.png') }}" height="20" width="20"> <span>Services</span></a></li>
        @elseif(Session::get('user') > 1 && Session::get('position') == "Doctor" || Session::get('position') == "Cashier")
        <li><a href="/reports/{{Session::get('user')}}"><img src="{{ asset('/img/2014.png') }}" height="20" width="20"> <span>Reports</span></a></li>
        @elseif(Session::get('user') > 1 && Session::get('position') == "Xray" || Session::get('position') == "Labtest")
        <li><a href="/NFHSI/queueing"><img src="{{ asset('/img/queueing.png') }}" height="20" width="20"> <span>Queueing</span></a></li>
        @endif
        <li><a href="/logout"><img src="{{ asset('/img/2016.png') }}" height="20" width="20"> <span>Sign out</span></a></li>
    </ul>
</aside>

    <!-- Content Wrapper. Contains page content -->
    <div style="min-height: 245px;" class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><img src="{{ asset('/img/2010.png') }}" height="30" width="30"> Patients</h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Patient Visit 
                    <!-- <a href="#" class="btn btn-warning btn-xs" target="_blank"> Generate Medical Certificate</a>
                    <a href="#" class="btn btn-info btn-xs" target="_blank"> Preview</a> -->
                </h3>
            </div>
            <div class="box-body"><!-- 
                <input id="pid" name="pid" value="1" type="text">
                <input id="vid" name="vid" value="1" type="text"> -->
            <div class="nav-tabs-custom">
    <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    @if(!Session::get('user'))
                    <li role="presentation" class="active">
                        <a href="#personal_info" role="tab" data-toggle="tab" style="font-size: 8pt;">Personal Info</a>
                    </li>
                    @else
                    <li role="presentation" class="active">
                        <a href="#personal_info" role="tab" data-toggle="tab" style="font-size: 8pt;">Personal Info</a>
                    </li>
                    <li role="presentation">
                        <a href="#reasonforconsulation" role="tab" data-toggle="tab" style="font-size: 8pt;">Reason for Consultation</a>
                    </li>
                    <li role="presentation">
                        <a href="#PMH" role="tab" data-toggle="tab" style="font-size: 8pt;">Past Medical History</a>
                    </li>
                    <li role="presentation">
                        <a href="#SH" role="tab" data-toggle="tab" style="font-size: 8pt;">Social History</a>
                    </li>
                    <li role="presentation">
                        <a href="#PE" role="tab" data-toggle="tab" style="font-size: 8pt;">Physical Exam</a>
                    </li>
                    <li role="presentation">
                        <a href="#diagnosis" role="tab" data-toggle="tab" style="font-size: 8pt;">Diagnosis</a>
                    </li>
                    <li role="presentation">
                        <a href="#plan" role="tab" data-toggle="tab" style="font-size: 8pt;">Plan</a>
                    </li>
                    <li role="presentation">
                        <a href="#medications" role="tab" data-toggle="tab" style="font-size: 8pt;">Medications</a>
                    </li>
                    @if(Session::get('position') == "Doctor")
                        @foreach($PatientService as $service)
                            @if($service->department == 'xray')
                                <li role="presentation">
                                    <a href="#xray" role="tab" data-toggle="tab" style="font-size: 8pt;">X-ray</a>
                                </li>
                                <li role="presentation">
                                    <a href="#ultrasound" role="tab" data-toggle="tab" style="font-size: 8pt;">Ultrasound</a>
                                </li>
                            @elseif($service->department == 'labtest')
                                <li role="presentation">
                                    <a href="#labtest" role="tab" data-toggle="tab" style="font-size: 8pt;">Lab Test</a>
                                </li>
                                <li role="presentation">
                                    <a href="#ecg" role="tab" data-toggle="tab" style="font-size: 8pt;">ECG</a>
                                </li>
                            @endif
                        @endforeach
                    
                    @elseif(Session::get('position') == "Xray")
                        @foreach($PatientService as $service)
                            @if($service->department == 'xray')
                                <li role="presentation">
                                    <a href="#xray" role="tab" data-toggle="tab" style="font-size: 8pt;">X-ray</a>
                                </li>
                            @endif
                        @endforeach
                        <li role="presentation">
                            <a href="#ultrasound" role="tab" data-toggle="tab" style="font-size: 8pt;">Ultrasound</a>
                        </li>

                    @elseif(Session::get('position') == "Labtest")
                        @foreach($PatientService as $service)
                            @if($service->department == 'labtest')
                                <li role="presentation">
                                    <a href="#labtest" role="tab" data-toggle="tab" style="font-size: 8pt;">Lab Test</a>
                                </li>
                            @endif
                        @endforeach
                        <li role="presentation">
                            <a href="#ecg" role="tab" data-toggle="tab" style="font-size: 8pt;">ECG</a>
                        </li>
                    @endif
                    @endif
                </ul>
                
                <div class="tab-content">

                        <!-- Personal Info -->
                        <div role="tabpanel" class="tab-pane active" id="personal_info">
                            <div class="col-md-12">
                            <div class="flash-message top-message topmessage">
                                @foreach (['danger', 'warning', 'success', 'info'] as $message)
                                    @if(Session::has('alert-' . $message))
                                        <p class="alert alert-{{ $message }}" style="padding:.5px;height:22px; width:40.5%; margin-top: 2.1%">{{ Session::get('alert-' . $message) }}</p>
                                    @endif
                                @endforeach
                            </div>
                                <h3>Personal Info</h3>
                                <form id="frm_personal_info" class="form-horizontal" method="post" action="">
                                    {!! csrf_field() !!}
                                    <div class="form-group ">
                                        <label class="col-sm-1 control-label">Name</label>
                                        <div class="col-sm-2">
                                            <input class="form-control" id="fname" name="fname" placeholder="First Name" required=""    type="text" value="{{$patient->f_name}}" readonly="">
                                        </div>
                                        <div class="col-sm-1 nameleft">
                                            <input class="form-control" id="mname" name="mname" placeholder="M" type="text" value="{{$patient->m_name}}" readonly="">
                                        </div>
                                        <div class="col-sm-2 nameleft">
                                            <input class="form-control" id="lname" name="lname" placeholder="Last Name" required=""     type="text" value="{{$patient->l_name}}" readonly="">
                                        </div>
                                    </div>
                                    <div class="form-group divxrayinfo2">
                                        <label class="col-sm-1 control-label">Address</label>
                                        <div class="col-sm-5">
                                            <input class="form-control" id="address" name="address" placeholder="Address" required=""   type="text" value="{{$patient->address}}" readonly="">
                                        </div>
                                    </div>
                                    <div class="form-group divxrayinfo2">
                                        <label class="col-sm-1 control-label">Gender</label>
                                        <div class="col-sm-3">
                                            <select id="gender" name="gender" class="form-control" required="" disabled="">
                                            @if($patient->gender == 'Male')
                                                <option value="Male" selected="">Male</option>
                                                <option value="Female">Female</option>
                                            @else
                                                <option value="Male">Male</option>
                                                <option value="Female" selected="">Female</option>
                                            @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group divxrayinfo2">
                                        <label class="col-sm-1 control-label">Birthdate</label>
                                        <div class="col-sm-3">
                                            <input type="text" id="datepicker" name="dob" class="form-control dob" required=""  placeholder="YYYY-MM-DD" value="{{$patient->dob}}" disabled="">
                                        </div>
                                    </div>
                                    <div class="form-group divxrayinfo2">
                                        <label class="col-sm-1 control-label">Age</label>
                                        <div class="col-sm-1">
                                            <input class="form-control age" id="age" name="age" placeholder="" readonly="" required="" type="text" value="{{$patient->age}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <label class="col-sm-1 control-label">Purpose of Visit</label>
                                    <div class="col-sm-5">
                                        <textarea class="form-control purpose_visit" name="purpose_visit" rows="2" id="purpose_visit" required="" disabled="">{{$patient->purpose_visit}}</textarea>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>

                        <!-- Reason for Consulation -->
                        <div role="tabpanel" class="tab-pane fade" id="reasonforconsulation">
                            <div class="col-md-12">
                            <div class="flash-message top-message topmessage2"></div>
                                <h3>Reason for Consultation</h3>
                                    <form id="frm_consult_reason" class="form-horizontal frm_consult_reason">
                                    {!! csrf_field() !!}
                                    <input type="text" name="RFCpatient_id" class="RFCpatient_id" style="display: none;" value="{{$id}}">
                                    <input type="text" name="RFCvisit_id" class="RFCvisit_id" style="display: none;" value="{{$vid}}">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Chief Complaint</label>
                                            <div class="col-sm-10">
                                            @if(!$reasonforconsulation)
                                                <input type="text" name="RFC_id" class="RFC_id" style="display: none;" value="">
                                                <textarea class="form-control chief_complaint" id="chief_complaint" name="chief_complaint"></textarea>
                                            @else
                                                 <input type="text" name="RFC_id" class="RFC_id" style="display: none;" value="{{$reasonforconsulation->id}}">
                                                <textarea class="form-control chief_complaint" id="chief_complaint" name="chief_complaint">{{$reasonforconsulation->chief_complaint}}</textarea>
                                            @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">History of Present Illness</label>
                                            <div class="col-sm-10">
                                            @if(!$reasonforconsulation)
                                                <textarea class="form-control height500 history_illness" rows="5" id="history_illness"></textarea>
                                            @else
                                                <textarea class="form-control height500 history_illness" rows="5" id="history_illness">{{$reasonforconsulation->history_of_present_illness}}</textarea>
                                            @endif
                                            </div>
                                        </div>
                                        @if(!Session::get('user'))
                                        @else
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label"></label>
                                            @if(!$reasonforconsulation)
                                            <div class="col-sm-3 subsubRFC">
                                                <button class="btn btn-primary btn-xs submit_RFC" id="btn-submit-consult_reason" type="button">Submit</button>
                                            </div>
                                            @else
                                            <div class="col-sm-3">
                                                <button class="btn btn-primary btn-xs edit_RFC" id="btn-submit-consult_reason" type="button">Save Changes</button>
                                            </div>
                                            @endif
                                        </div>
                                        @endif
                                    </form>
                            </div>
                        </div>

                        <!-- Past Medical History -->
                        <div role="tabpanel" class="tab-pane fade" id="PMH">
                            <div class="col-md-12">
                            <div class="flash-message top-message topmessage3"></div>
                                <h3>Past Medical History</h3>
                                    <form id="frm_consult_reason" class="form-horizontal">
                                    {!! csrf_field() !!}
                                        <div class="col-sm-5">
                                        @if(!$PMH)
                                            <input type="text" name="PMH_patient_id" class="PMH_patient_id" value="{{$id}}" style="display: none;">
                                            <input type="text" name="PMH_visit_id" class="PMH_visit_id" value="{{$vid}}" style="display: none;">
                                            <input type="text" name="PMH_id" class="PMH_id" value="" style="display: none;">
                                            <div class="checkbox">
                                                <label><input type="checkbox" class="surgery_check"><b>Surgery</b></label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" class="hypertension"><b>Hypertension</b></label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" class="diabetes"><b>Diabetes Mellitus</b></label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" class="PR_check"><b>Previous Hospitalization</b></label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" class="DD_check"><b>Diseases Diagnosed</b></label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" class="vaccine_check"><b>Vaccinations</b></label>
                                            </div>
                                        @else
                                            <input type="text" name="PMH_patient_id" class="PMH_patient_id" value="{{$id}}" style="display: none;">
                                            <input type="text" name="PMH_visit_id" class="PMH_visit_id" value="{{$vid}}" style="display: none;">
                                            <input type="text" name="PMH_id" class="PMH_id" style="display: none;" value="{{$PMH->id}}">
                                            <div class="checkbox">
                                                @if($PMH->surgery == "Yes")
                                                <label><input type="checkbox" class="surgery_check" checked=""><b>Surgery</b></label>
                                                @else
                                                <label><input type="checkbox" class="surgery_check"><b>Surgery</b></label>
                                                @endif
                                            </div>
                                            <div class="checkbox">
                                                @if($PMH->hypertension == "Yes")
                                                <label><input type="checkbox" class="hypertension" checked=""><b>Hypertension</b></label>
                                                @else
                                                <label><input type="checkbox" class="hypertension"><b>Hypertension</b></label>
                                                @endif
                                                
                                            </div>
                                            <div class="checkbox">
                                                @if($PMH->diabetes_mellitus == "Yes")
                                                <label><input type="checkbox" class="diabetes" checked=""><b>Diabetes Mellitus</b></label>
                                                @else
                                                <label><input type="checkbox" class="diabetes"><b>Diabetes Mellitus</b></label>
                                                @endif
                                            </div>
                                            <div class="checkbox">
                                                @if($PMH->previous_hospitalization == "Yes")
                                                <label><input type="checkbox" class="PR_check" checked=""><b>Previous Hospitalization</b></label>
                                                @else
                                                <label><input type="checkbox" class="PR_check"><b>Previous Hospitalization</b></label>
                                                @endif
                                            </div>
                                            <div class="checkbox">
                                                @if($PMH->diseases_diagnosed == "Yes")
                                                <label><input type="checkbox" class="DD_check" checked=""><b>Diseases Diagnosed</b></label>
                                                @else
                                                <label><input type="checkbox" class="DD_check"><b>Diseases Diagnosed</b></label>
                                                @endif
                                            </div>
                                            <div class="checkbox">
                                                @if($PMH->vaccination == "Yes")
                                                <label><input type="checkbox" class="vaccine_check" checked=""><b>Vaccinations</b></label>
                                                @else
                                                <label><input type="checkbox" class="vaccine_check"><b>Vaccinations</b></label>
                                                @endif
                                            </div>
                                        @endif
                                        </div>
                                        <div class="col-sm-7">

                                        @if(!$PMH)
                                            <ul id="surgery_list" class="list-unstyled surgery_list" style="display: none;">
                                                <li>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>
                                                                    <h4>Surgeries &nbsp;&nbsp;
                                                                        <button type="button" class="btn btn-primary btn-xs add_surgery" id="add-surgery" title="Add More">
                                                                            <i class="fa fa-plus"></i>
                                                                        </button>
                                                                    </h4>
                                                                    Date
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="form-group">
                                                                <label><h4 style="margin-bottom: 35%;">&nbsp;</h4>Operation </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="surgery-item">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <input type="text" id="datepicker1" name="surgery_date" class="form-control surgery_date surdataid1" placeholder="YYYY-MM-DD" readonly="">
                                                                <input type="text" name="counter" class="counter" value="1" style="display: none;">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <div class="form-group">
                                                                <input class="form-control surgery_operation" name="surgery_operation" value="" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>

                                            <ul id="hospitalization_list" class="list-unstyled hospitalization_list" style="display: none;">
                                                <li>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>
                                                                    <h4>Hospitalizations &nbsp;&nbsp;
                                                                        <button type="button" class="btn btn-primary btn-xs add_hospitalization" id="add-hospitalization" title="Add More">
                                                                            <i class="fa fa-plus"></i>
                                                                        </button>
                                                                    </h4>
                                                                    Date
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-8 ">
                                                            <div class="form-group">
                                                                <label><h4 style="margin-bottom: 35%;">&nbsp;</h4>Diagnosis </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="hospitalization-item">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <input type="text" id="hospitalization_date" name="hospitalization_date" class="form-control hospitalization_date hosdataid1" placeholder="YYYY-MM-DD" readonly="">
                                                                <input type="text" name="counter2" class="counter2" value="1" style="display: none;">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <div class="form-group">
                                                                <textarea class="form-control hospitalization_diagnosis" name="hospitalization_diagnosis"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>

                                            <ul id="disease_list" class="list-unstyled disease_list" style="display: none;">
                                                <li>
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <div class="form-group">
                                                                <label>
                                                                    <h4>Diseases Diagnosed &nbsp;&nbsp;
                                                                    <button type="button" class="btn btn-primary btn-xs add_disease" id="add-disease" title="Add More">
                                                                        <i class="fa fa-plus"></i>
                                                                    </button>
                                                                    </h4>
                                                                Date
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-7">
                                                            <div class="form-group">
                                                                <label><h4 style="margin-bottom: 40%;">&nbsp;</h4>Disease </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="disease-item">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <input type="text" id="disease_date" name="disease_date" class="form-control disease_date disdataid1" placeholder="YYYY-MM-DD" readonly="">
                                                                <input type="text" name="counter3" class="counter3" value="1" style="display: none;">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <div class="form-group">
                                                                <input class="form-control disease" name="disease" value="" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>

                                            <ul id="vaccination_list" class="list-unstyled vaccination_list" style="display: none;">
                                                <li>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>
                                                                    <h4>Vaccinations &nbsp;&nbsp;
                                                                    <button type="button" class="btn btn-primary btn-xs add_vaccination" id="add-vaccination" title="Add More">
                                                                        <i class="fa fa-plus"></i>
                                                                    </button>
                                                                    </h4>
                                                                Date
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="form-group">
                                                                <label><h4 style="margin-bottom: 45%;">&nbsp;</h4>Vaccine </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="vaccination-item">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <input type="text" id="vaccination_date" name="vaccination_date" class="form-control vaccination_date vaccdataid1" placeholder="YYYY-MM-DD" readonly="">
                                                                <input type="text" name="counter4" class="counter4" value="1" style="display: none;">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <div class="form-group">
                                                                <input class="form-control vaccination" name="vaccination" value="" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>


                                        @else
                                            @if($PMH->surgery == "Yes")
                                            <ul id="surgery_list" class="list-unstyled surgery_list">
                                                <li>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>
                                                                    <h4>Surgeries &nbsp;&nbsp;
                                                                        <button type="button" class="btn btn-primary btn-xs add_surgery" id="add-surgery" title="Add More">
                                                                            <i class="fa fa-plus"></i>
                                                                        </button>
                                                                    </h4>
                                                                    Date
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="form-group">
                                                                <label><h4 style="margin-bottom: 35%;">&nbsp;</h4>Operation </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="surgery-item">
                                                @foreach($PMH_sur as $surgery1001)
                                                    @if(!$surgery1001->id)
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <input type="text" id="datepicker1" name="surgery_date" class="form-control surgery_date surdataid1" placeholder="YYYY-MM-DD" readonly="" value="">
                                                                <input type="text" name="counter" class="counter" value="1" style="display: none;">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <div class="form-group">
                                                                <input class="form-control surgery_operation" name="surgery_operation" value="" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <input type="text" id="datepicker{{$surgery1001->counter}}" name="surgery_date" class="form-control surgery_date surdataid{{$surgery1001->counter}}" placeholder="YYYY-MM-DD" readonly="" value="{{$surgery1001->date}}">
                                                                <input type="text" name="counter" class="counter" value="{{$surgery1001->counter}}" style="display: none;">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <div class="form-group">
                                                                <input class="form-control surgery_operation" name="surgery_operation" value="{{$surgery1001->operation}}" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                @endforeach
                                                </li>
                                            </ul>
                                            @else
                                            <ul id="surgery_list" class="list-unstyled surgery_list" style="display: none;">
                                                <li>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>
                                                                    <h4>Surgeries &nbsp;&nbsp;
                                                                        <button type="button" class="btn btn-primary btn-xs add_surgery" id="add-surgery" title="Add More">
                                                                            <i class="fa fa-plus"></i>
                                                                        </button>
                                                                    </h4>
                                                                    Date
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="form-group">
                                                                <label><h4 style="margin-bottom: 35%;">&nbsp;</h4>Operation </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="surgery-item">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <input type="text" id="datepicker1" name="surgery_date" class="form-control surgery_date surdataid1" placeholder="YYYY-MM-DD" readonly="">
                                                                <input type="text" name="counter" class="counter" value="1" style="display: none;">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <div class="form-group">
                                                                <input class="form-control surgery_operation" name="surgery_operation" value="" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            @endif

                                            @if($PMH->previous_hospitalization == "Yes")
                                            <ul id="hospitalization_list" class="list-unstyled hospitalization_list">
                                                <li>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>
                                                                    <h4>Hospitalizations &nbsp;&nbsp;
                                                                        <button type="button" class="btn btn-primary btn-xs add_hospitalization" id="add-hospitalization" title="Add More">
                                                                            <i class="fa fa-plus"></i>
                                                                        </button>
                                                                    </h4>
                                                                    Date
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-8 ">
                                                            <div class="form-group">
                                                                <label><h4 style="margin-bottom: 35%;">&nbsp;</h4>Diagnosis </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="hospitalization-item">
                                                @foreach($PMH_hos as $hospital)
                                                    @if(!$hospital->id)
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <input type="text" id="hospitalization_date" name="hospitalization_date" class="form-control hospitalization_date hosdataid1" placeholder="YYYY-MM-DD" readonly="">
                                                                <input type="text" name="counter2" class="counter2" value="1" style="display: none;">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <div class="form-group">
                                                                <textarea class="form-control hospitalization_diagnosis" name="hospitalization_diagnosis"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <input type="text" id="hospitalization_date{{$hospital->counter}}" name="hospitalization_date" class="form-control hospitalization_date hosdataid{{$hospital->counter}}" placeholder="YYYY-MM-DD" readonly="" value="{{$hospital->date}}">
                                                                <input type="text" name="counter22" class="counter2" value="{{$hospital->counter}}" style="display: none;">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <div class="form-group">
                                                                <textarea class="form-control hospitalization_diagnosis" name="hospitalization_diagnosis">{{$hospital->diagnosis}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                @endforeach
                                                </li>
                                            </ul>
                                            @else
                                            <ul id="hospitalization_list" class="list-unstyled hospitalization_list" style="display: none;">
                                                <li>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>
                                                                    <h4>Hospitalizations &nbsp;&nbsp;
                                                                        <button type="button" class="btn btn-primary btn-xs add_hospitalization" id="add-hospitalization" title="Add More">
                                                                            <i class="fa fa-plus"></i>
                                                                        </button>
                                                                    </h4>
                                                                    Date
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-8 ">
                                                            <div class="form-group">
                                                                <label><h4 style="margin-bottom: 35%;">&nbsp;</h4>Diagnosis </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="hospitalization-item">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <input type="text" id="hospitalization_date" name="hospitalization_date" class="form-control hospitalization_date hosdataid1" placeholder="YYYY-MM-DD" readonly="">
                                                                <input type="text" name="counter2" class="counter2" value="1" style="display: none;">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <div class="form-group">
                                                                <textarea class="form-control hospitalization_diagnosis" name="hospitalization_diagnosis"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            @endif

                                            @if($PMH->diseases_diagnosed == "Yes")
                                            <ul id="disease_list" class="list-unstyled disease_list">
                                                <li>
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <div class="form-group">
                                                                <label>
                                                                    <h4>Diseases Diagnosed &nbsp;&nbsp;
                                                                    <button type="button" class="btn btn-primary btn-xs add_disease" id="add-disease" title="Add More">
                                                                        <i class="fa fa-plus"></i>
                                                                    </button>
                                                                    </h4>
                                                                Date
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-7">
                                                            <div class="form-group">
                                                                <label><h4 style="margin-bottom: 40%;">&nbsp;</h4>Disease </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="disease-item">
                                                @foreach($PMH_dis as $diseases)
                                                    @if(!$diseases->id)
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <input type="text" id="disease_date" name="disease_date" class="form-control disease_date disdataid1" placeholder="YYYY-MM-DD" readonly="">
                                                                <input type="text" name="counter3" class="counter3" value="1" style="display: none;">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <div class="form-group">
                                                                <input class="form-control disease" name="disease" value="" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <input type="text" id="disease_date{{$diseases->counter}}" name="disease_date" class="form-control disease_date disdataid{{$diseases->counter}}" placeholder="YYYY-MM-DD" readonly="" value="{{$diseases->date}}">
                                                                <input type="text" name="counter3" class="counter3" value="{{$diseases->counter}}" style="display: none;">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <div class="form-group">
                                                                <input class="form-control disease" name="disease" value="{{$diseases->disease}}" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                @endforeach
                                                </li>
                                            </ul>
                                            @else
                                            <ul id="disease_list" class="list-unstyled disease_list" style="display: none;">
                                                <li>
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <div class="form-group">
                                                                <label>
                                                                    <h4>Diseases Diagnosed &nbsp;&nbsp;
                                                                    <button type="button" class="btn btn-primary btn-xs add_disease" id="add-disease" title="Add More">
                                                                        <i class="fa fa-plus"></i>
                                                                    </button>
                                                                    </h4>
                                                                Date
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-7">
                                                            <div class="form-group">
                                                                <label><h4 style="margin-bottom: 40%;">&nbsp;</h4>Disease </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="disease-item">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <input type="text" id="disease_date" name="disease_date" class="form-control disease_date disdataid1" placeholder="YYYY-MM-DD" readonly="">
                                                                <input type="text" name="counter3" class="counter3" value="1" style="display: none;">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <div class="form-group">
                                                                <input class="form-control disease" name="disease" value="" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            @endif

                                            @if($PMH->vaccination == "Yes")
                                            <ul id="vaccination_list" class="list-unstyled vaccination_list">
                                                <li>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>
                                                                    <h4>Vaccinations &nbsp;&nbsp;
                                                                    <button type="button" class="btn btn-primary btn-xs add_vaccination" id="add-vaccination" title="Add More">
                                                                        <i class="fa fa-plus"></i>
                                                                    </button>
                                                                    </h4>
                                                                Date
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="form-group">
                                                                <label><h4 style="margin-bottom: 45%;">&nbsp;</h4>Vaccine </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="vaccination-item">
                                                @foreach($PMH_vacc as $vaccine)
                                                    @if(!$vaccine->id)
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <input type="text" id="vaccination_date" name="vaccination_date" class="form-control vaccination_date vaccdataid1" placeholder="YYYY-MM-DD" readonly="">
                                                                <input type="text" name="counter4" class="counter4" value="1" style="display: none;">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <div class="form-group">
                                                                <input class="form-control vaccination" name="vaccination" value="" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <input type="text" id="vaccination_date{{$vaccine->counter}}" name="vaccination_date" class="form-control vaccination_date vaccdataid{{$vaccine->counter}}" placeholder="YYYY-MM-DD" readonly="" value="{{$vaccine->date}}">
                                                                <input type="text" name="counter4" class="counter4" value="{{$vaccine->counter}}" style="display: none;">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <div class="form-group">
                                                                <input class="form-control vaccination" name="vaccination" value="{{$vaccine->vaccine}}" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                @endforeach
                                                </li>
                                            </ul>
                                            @else
                                            <ul id="vaccination_list" class="list-unstyled vaccination_list" style="display: none;">
                                                <li>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>
                                                                    <h4>Vaccinations &nbsp;&nbsp;
                                                                    <button type="button" class="btn btn-primary btn-xs add_vaccination" id="add-vaccination" title="Add More">
                                                                        <i class="fa fa-plus"></i>
                                                                    </button>
                                                                    </h4>
                                                                Date
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="form-group">
                                                                <label><h4 style="margin-bottom: 45%;">&nbsp;</h4>Vaccine </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="vaccination-item">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <input type="text" id="vaccination_date" name="vaccination_date" class="form-control vaccination_date vaccdataid1" placeholder="YYYY-MM-DD" readonly="">
                                                                <input type="text" name="counter4" class="counter4" value="1" style="display: none;">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <div class="form-group">
                                                                <input class="form-control vaccination" name="vaccination" value="" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            @endif
                                            

                                        @endif

                                        </div>

                                        <div class="clearfix"></div><br>
                                        @if(!Session::get('user'))
                                        @else
                                        <div class="form-group">
                                            <label for="inputEmail3" class=" control-label"></label>
                                            <div class="col-sm-3 med_his_butt">
                                            @if(!$PMH)
                                            <button class="btn btn-primary btn-xs medical_history" id="btn-submit-medical_history" type="button">Submit</button>
                                            <button class="btn btn-primary btn-xs edit_medical_history" id="btn-submit-medical_history" type="button" style="display: none;">Save Changes</button>
                                            @else
                                            <button class="btn btn-primary btn-xs edit_medical_history" id="btn-submit-medical_history" type="button">Save Changes</button>
                                            @endif  
                                            </div>
                                        </div>
                                        @endif
                                    </form>
                            </div>
                        </div>

                        <!-- Social History -->
                        <div role="tabpanel" class="tab-pane fade" id="SH">
                            <div class="col-md-12">
                            <div class="flash-message top-message topmessage4"></div>
                            <h3>Social History</h3>
                                    <form class="form-horizontal">
                                    {!! csrf_field() !!}
                                        <input type="text" name="SH_patient_id" class="SH_patient_id" value="{{$id}}" style="display: none;">
                                        <input type="text" name="SH_visit_id" class="SH_visit_id" value="{{$vid}}" style="display: none;">
                                        @if(!$SH)
                                        <input type="text" name="SH_id" class="SH_id" value="" style="display: none;">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Allergies?</label>
                                            <div class="col-sm-2">
                                                <select id="allergies" name="allergies" class="form-control allergies"> 
                                                    <option value="">- Select -</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-5">
                                                <textarea class="form-control allergies_list" id="allergies_list" name="allergies_list" style="display: none;"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Do you drink alcohol?</label>
                                            <div class="col-sm-2">
                                                <select id="drink-alcohol" name="drink-alcohol" class="form-control drink_alcohol"> 
                                                    <option value="">- Select -</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <input class="form-control how_much_drink" name="how_much_drink" id="how_much_drink" placeholder="How much?" value="" type="text" style="display: none;">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Do you smoke?</label>
                                            <div class="col-sm-2">
                                                <select id="smoke" name="smoke" class="form-control smoke"> 
                                                    <option value="">- Select -</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <input class="form-control packs" name="packs" id="packs" placeholder="Packs - Years " value="" type="text" style="display: none;">
                                            </div>
                                        </div>
                                        @if(!Session::get('user'))
                                        @else
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label"></label>
                                            <div class="col-sm-3">
                                                <button class="btn btn-primary btn-xs addsocial_history" id="btn-submit-social_history" type="button">Submit</button>
                                            </div>
                                        </div>
                                        @endif
                                        @else
                                        <input type="text" name="SH_id" class="SH_id" value="{{$SH->id}}" style="display: none;">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Allergies?</label>
                                            <div class="col-sm-2">
                                                <select id="allergies" name="allergies" class="form-control allergies"> 
                                                    <option value="">- Select -</option>
                                                    @if($SH->allergy == "Yes")
                                                    <option value="Yes" selected="">Yes</option>
                                                    <option value="No">No</option>
                                                    @else
                                                    <option value="Yes">Yes</option>
                                                    <option value="No" selected="">No</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-sm-5">
                                                @if($SH->allergy == "Yes")
                                                <textarea class="form-control allergies_list" id="allergies_list" name="allergies_list">{{$SH->allergy_desc}}</textarea>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Do you drink alcohol?</label>
                                            <div class="col-sm-2">
                                                <select id="drink-alcohol" name="drink-alcohol" class="form-control drink_alcohol"> 
                                                    <option value="">- Select -</option>
                                                    @if($SH->alcohol == "Yes")
                                                    <option value="Yes" selected="">Yes</option>
                                                    <option value="No">No</option>
                                                    @else
                                                    <option value="Yes">Yes</option>
                                                    <option value="No" selected="">No</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                @if($SH->alcohol == "Yes")
                                                <input class="form-control how_much_drink" name="how_much_drink" id="how_much_drink" placeholder="How much?" value="{{$SH->alcohol_desc}}" type="text">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Do you smoke?</label>
                                            <div class="col-sm-2">
                                                <select id="smoke" name="smoke" class="form-control smoke"> 
                                                    <option value="">- Select -</option>
                                                    @if($SH->smoke == "Yes")
                                                    <option value="Yes" selected="">Yes</option>
                                                    <option value="No">No</option>
                                                    @else
                                                    <option value="Yes">Yes</option>
                                                    <option value="No" selected="">No</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                @if($SH->smoke == "Yes")
                                                <input class="form-control packs" name="packs" id="packs" placeholder="Packs - Years " value="{{$SH->smoke_desc}}" type="text">
                                                @endif
                                            </div>
                                        </div>
                                        @if(!Session::get('user'))
                                        @else
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label"></label>
                                            <div class="col-sm-3">
                                                <button class="btn btn-primary btn-xs addsocial_history" id="btn-submit-social_history" type="button">Save Changes</button>
                                            </div>
                                        </div>
                                        @endif
                                        @endif
                                    </form>
                            </div>
                        </div>

                        <!-- Physical Exam -->
                        <div role="tabpanel" class="tab-pane fade" id="PE">
                            <div class="col-md-12">
                            <div class="flash-message top-message topmessage5"></div>
                            <h3>Physical Exam</h3>
                                    <form class="form-horizontal" id="frm_physical_exam">
                                    {!! csrf_field() !!}
                                        <input type="text" name="PE_patient_id" class="PE_patient_id" value="{{$id}}" style="display: none;">
                                        <input type="text" name="PE_visit_id" class="PE_visit_id" value="{{$vid}}" style="display: none;">
                                        @if(!$PE)
                                        <input type="text" name="PE_id" class="PE_id" value="" style="display: none;">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Gen. Survey</label>
                                            <div class="col-sm-6">
                                                <textarea class="form-control gen_survey" id="gen_survey" name="gen_survey"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Vital Signs:</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">BP</label>
                                            <div class="col-sm-2">
                                                <input class="form-control bp" id="bp" name="bp" value="" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">HR</label>
                                            <div class="col-sm-2">
                                                <input class="form-control hr" id="hr" name="hr" value="" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">RR</label>
                                            <div class="col-sm-2">
                                                <input class="form-control rr" id="rr" name="rr" value="" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Temp.</label>
                                            <div class="col-sm-2">
                                                <input class="form-control temp" id="temp" name="temp" value="" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Head</label>
                                            <div class="col-sm-6">
                                                <input class="form-control head" id="head" name="head" value="" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Neck</label>
                                            <div class="col-sm-6">
                                                <input class="form-control neck" id="neck" name="neck" value="" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Chest/Lungs</label>
                                            <div class="col-sm-6">
                                                <input class="form-control chest_lungs" id="chest_lungs" name="chest_lungs" value="" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Heart</label>
                                            <div class="col-sm-6">
                                                <input class="form-control heart" id="heart" name="heart" value="" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Abdomen</label>
                                            <div class="col-sm-6">
                                                <input class="form-control abdomen" id="abdomen" name="abdomen" value="" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Back</label>
                                            <div class="col-sm-6">
                                                <input class="form-control back" id="back" name="back" value="" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Extremities</label>
                                            <div class="col-sm-6">
                                                <input class="form-control extremities" id="extremities" name="extremities" value="" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Neuro Exam</label>
                                            <div class="col-sm-6">
                                                <input class="form-control neuro_exam" id="neuro_exam" name="neuro_exam" value="" type="text">
                                            </div>
                                        </div>
                                        @if(!Session::get('user'))
                                        @else
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label"></label>
                                            <div class="col-sm-3">
                                                <button class="btn btn-primary btn-xs addphysical_exam" id="btn-submit-physical_exam" type="button">Submit</button>
                                            </div>
                                        </div>
                                        @endif
                                        @else
                                        <input type="text" name="PE_id" class="PE_id" value="{{$PE->id}}" style="display: none;">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Gen. Survey</label>
                                            <div class="col-sm-6">
                                                <textarea class="form-control gen_survey" id="gen_survey" name="gen_survey">{{$PE->gen_survey}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Vital Signs:</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">BP</label>
                                            <div class="col-sm-2">
                                                <input class="form-control bp" id="bp" name="bp" value="{{$PE->bp}}" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">HR</label>
                                            <div class="col-sm-2">
                                                <input class="form-control hr" id="hr" name="hr" value="{{$PE->hr}}" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">RR</label>
                                            <div class="col-sm-2">
                                                <input class="form-control rr" id="rr" name="rr" value="{{$PE->rr}}" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Temp.</label>
                                            <div class="col-sm-2">
                                                <input class="form-control temp" id="temp" name="temp" value="{{$PE->temp}}" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Head</label>
                                            <div class="col-sm-6">
                                                <input class="form-control head" id="head" name="head" value="{{$PE->head}}" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Neck</label>
                                            <div class="col-sm-6">
                                                <input class="form-control neck" id="neck" name="neck" value="{{$PE->neck}}" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Chest/Lungs</label>
                                            <div class="col-sm-6">
                                                <input class="form-control chest_lungs" id="chest_lungs" name="chest_lungs" value="{{$PE->chest_lung}}" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Heart</label>
                                            <div class="col-sm-6">
                                                <input class="form-control heart" id="heart" name="heart" value="{{$PE->heart}}" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Abdomen</label>
                                            <div class="col-sm-6">
                                                <input class="form-control abdomen" id="abdomen" name="abdomen" value="{{$PE->abdomen}}" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Back</label>
                                            <div class="col-sm-6">
                                                <input class="form-control back" id="back" name="back" value="{{$PE->back}}" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Extremities</label>
                                            <div class="col-sm-6">
                                                <input class="form-control extremities" id="extremities" name="extremities" value="{{$PE->extremity}}" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Neuro Exam</label>
                                            <div class="col-sm-6">
                                                <input class="form-control neuro_exam" id="neuro_exam" name="neuro_exam" value="{{$PE->neuro_exam}}" type="text">
                                            </div>
                                        </div>
                                        @if(!Session::get('user'))
                                        @else
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label"></label>
                                            <div class="col-sm-3">
                                                <button class="btn btn-primary btn-xs addphysical_exam" id="btn-submit-physical_exam" type="button">Save Changes</button>
                                            </div>
                                        </div>
                                        @endif
                                        @endif
                                    </form>
                            </div>
                        </div>

                        <!-- Diagnosis -->
                        <div role="tabpanel" class="tab-pane fade" id="diagnosis">
                            <div class="col-md-12">
                            <div class="flash-message top-message topmessage6"></div>
                                <h3>Diagnosis</h3>
                                    <form class="form-horizontal" id="frm_diagnosis">
                                    {!! csrf_field() !!}
                                        <input type="text" name="diag_patient_id" class="diag_patient_id" value="{{$id}}" style="display: none;">
                                        <input type="text" name="diag_visit_id" class="diag_visit_id" value="{{$vid}}" style="display: none;">
                                        @if(!$diagnosis)
                                        <input type="text" name="diag_id" class="diag_id" value="" style="display: none;">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <textarea class="form-control height500 diagnosis" id="diagnosis_input" name="diagnosis_input" rows="8"></textarea>
                                            </div>
                                        </div>
                                        @if(!Session::get('user'))
                                        @else
                                        <div class="form-group">
                                            <div class="col-sm-3">
                                                <button class="btn btn-primary btn-xs adddiagnosis" id="btn-submit-diagnosis" type="button">Submit</button>
                                            </div>
                                        </div>
                                        @endif
                                        @else
                                        <input type="text" name="diag_id" class="diag_id" value="{{$diagnosis->id}}" style="display: none;">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <textarea class="form-control height500 diagnosis" id="diagnosis_input" name="diagnosis_input" rows="8">{{$diagnosis->diagnosis}}</textarea>
                                            </div>
                                        </div>
                                        @if(!Session::get('user'))
                                        @else
                                        <div class="form-group">
                                            <div class="col-sm-3">
                                                <button class="btn btn-primary btn-xs adddiagnosis" id="btn-submit-diagnosis" type="button">Save Changes</button>
                                            </div>
                                        </div>
                                        @endif
                                        @endif
                                    </form>
                            </div>
                        </div>

                        <!-- Plan -->
                        <div role="tabpanel" class="tab-pane fade" id="plan">
                            <div class="col-md-12">
                            <div class="flash-message top-message topmessage7"></div>
                                <h3>Plan</h3>
                                    <form class="form-horizontal" id="frm_plan">
                                    {!! csrf_field() !!}
                                        <input type="text" name="plan_patient_id" class="plan_patient_id" value="{{$id}}" style="display: none;">
                                        <input type="text" name="plan_visit_id" class="plan_visit_id" value="{{$vid}}" style="display: none;">
                                        @if(!$plan)
                                        <input type="text" name="plan_id" class="plan_id" value="" style="display: none;">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <textarea class="form-control height500 plan" id="plan_input" name="plan_input" rows="8"></textarea>
                                            </div>
                                        </div>
                                        @if(!Session::get('user'))
                                        @else
                                        <div class="form-group">
                                            <div class="col-sm-3">
                                                <button class="btn btn-primary btn-xs addplan" id="btn-submit-plan" type="button">Submit</button>
                                            </div>
                                        </div>
                                        @endif
                                        @else
                                        <input type="text" name="plan_id" class="plan_id" value="{{$plan->id}}" style="display: none;">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <textarea class="form-control height500 plan" id="plan_input" name="plan_input" rows="8">{{$plan->plan}}</textarea>
                                            </div>
                                        </div>
                                        @if(!Session::get('user'))
                                        @else
                                        <div class="form-group">
                                            <div class="col-sm-3">
                                                <button class="btn btn-primary btn-xs addplan" id="btn-submit-plan" type="button">Save Changes</button>
                                            </div>
                                        </div>
                                        @endif
                                        @endif
                                    </form>
                            </div>
                        </div>

                        <!-- Medications -->
                        <div role="tabpanel" class="tab-pane fade" id="medications">
                            <div class="col-md-12">
                            <div class="flash-message top-message topmessage8"></div>
                                <h3>Medications 
                                    <button type="button" class="btn btn-primary btn-xs addmedadd" data-toggle="modal" data-target="#modal_medication_add" data-backdrop="static">Add New</button> 
                                    <a href="/print/rx/{{$id}}/{{$vid}}" target="_blank" class="btn btn-xs btn-warning genrx">Generate Rx</a>
                                </h3>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Date Started</th>
                                                <th>Drug</th>
                                                <th>Frequency</th>
                                                <th>Quantity</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="medication_list2" class="medication_list2">
                                            @foreach($Medication as $medmed)
                                                @if(!$medmed->id)
                                                @else
                                                <tr class="med_id_{{$medmed->id}}">
                                                    <td>{{$medmed->date_start}}</td>
                                                    <td>{{$medmed->drug}}</td>
                                                    <td>{{$medmed->frequency}}</td>
                                                    <td>{{$medmed->quantity}}</td>
                                                    <td>{{$medmed->status}}</td>
                                                    <td><button class="btn btn-xs btn-primary editmedication" data-toggle="modal" data-target="#modal_medication_add" data-med_id="{{$medmed->id}}">Edit</button></td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                                <!-- MODAL MEDICATIONS -->
                                <div class="modal fade" id="modal_medication_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close close_medication" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Add New Medication</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal" id="frm_add_medication">
                                                <input type="text" name="med_patient_id" class="med_patient_id" value="{{$id}}" style="display: none;">
                                                <input type="text" name="med_visit_id" class="med_visit_id" value="{{$vid}}" style="display: none;">
                                                <input type="text" name="med_id" class="med_id" value="" style="display: none;">
                                                {!! csrf_field() !!}
                                                    <div class="form-group" id="dt_start_grp">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Date Start</label>
                                                        <div class="col-sm-4 divdate_start">
                                                            <?php $datenow2 = date("Y-m-d"); ?>
                                                            <input type="text" id="date_start" name="date_start" class="form-control date_start" readonly="" required="" value="{{$datenow2}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group divxrayinfo" id="med_drug_grp">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Drug</label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control med_drug" id="med_drug" name="med_drug" type="text" placeholder="Drug" autocomplete="off">
                                                            <span class="help-block med_drug_err" id="med_drug_err" style="color: red; display: none;"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group divxrayinfo" id="med_frequency_grp">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Frequency</label>
                                                        <div class="col-sm-6">
                                                            <input class="form-control med_frequency" id="med_frequency" name="med_frequency" type="text" placeholder="Frequency" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="form-group divxrayinfo" id="med_quantity_grp">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Quantity</label>
                                                        <div class="col-sm-6">
                                                            <input class="form-control med_quantity" id="med_quantity" name="med_quantity" type="number" min="0" placeholder="Quantity" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary btn-xs addmedication" id="btn-add-medication">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END MODAL -->

                        <!-- X-ray -->
                        <div role="tabpanel" class="tab-pane fade" id="xray">
                            <div class="col-md-12">
                                <h3>X-ray
                                <!-- @if(Session::get('position') == 'Xray' || Session::get('user') == 1)
                                    @if($xraycount == 1)
                                    @else
                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal_xraynew" data-backdrop="static">Add New</button>
                                    @endif
                                @endif -->
                                <button type="button" class="btn btn-primary btn-xs addnewxrayplate" data-toggle="modal" data-target="#modal_xraynew" data-backdrop="static">Add New</button>
                                @if($xraycount != 0)
                                <a href="/visit/{{$id}}/{{$vid}}/xraydone" class="btn btn-xs btn-default">Done</a>
                                @endif
                                </h3>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th class="text-center">Date</th>
                                                <th class="text-center">Physician</th>
                                                <th class="text-center">Result</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="medication_list">
                                        @foreach($patientxray as $xray)
                                        <?php
                                            $id = $xray->id;
                                            $zero_id = sprintf("%04d", $id);
                                        ?>
                                            <tr id="med1">
                                                <td>{{$zero_id}}</td>
                                                <td class="text-center">{{$xray->xray_date}}</td>
                                                <td class="text-center">
                                                    @foreach($doctor as $doc)
                                                        @if($doc->id == $xray->physician_id)
                                                        {{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="text-center">{{$xray->finding}}</td>
                                                <td class="text-center">{{$xray->status}}</td>
                                                <td class="text-center">
                                                @if(!Session::get('user'))
                                                @else
                                                    <button type="button" class="btn btn-xs btn-primary btn-xs editpatientxray" data-toggle="modal" data-target="#modal_xraynew_edit" data-backdrop="static" data-id="{{$xray->id}}">Edit</button>
                                                    <a href="/xray/pdf/view/{{$xray->id}}" target="_blank" class="btn btn-xs btn-success">Print</a>
                                                    <a href="/xray/pdf/view/{{$xray->id}}/reprint" target="_blank" class="btn btn-xs btn-default">Re-Print</a>
                                                    <button type="button" class="btn btn-xs btn-warning patientxraylog" data-toggle="modal" data-target="#modal_patientxraylog" data-backdrop="static" data-id="{{$xray->id}}">Logs</button>
                                                    <!-- @if($xray->status == 'New')
                                                    <a href="/visit/{{$xray->patient_id}}/{{$xray->visitid}}/xraydone" class="btn btn-xs btn-default">Done</a>
                                                    @endif -->
                                                @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                            <!-- XRAY EDIT MODAL -->
                            <div class="modal fade" id="modal_xraynew_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog modalwidth" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="table-responsive">
                                                <div class="col-md-12">
                                                    <center><h3 class="neg">NEGROS FAMILY HEALTH SERVICES INC.</h3></center>
                                                    <center><p class="nor">North Road, Daro(in front of NOPH) Dumaguete City, Negros Oriental</p></center>
                                                    <center><p class="nor">Tel. No. (035) 225-3544</p></center>
                                                    <h4><b>X-RAY / ULTRASOUND</b></h4>

                                                    <form class="form-horizontal" method="POST" action="/visit/{{$patient->id}}/{{$vid}}/edit">
                                                    {!! csrf_field() !!}
                                                        <div class="form-group">
                                                            <label class="col-sm-1 control-label">Name:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" class="xray_id" name="xray_id" value="" style="display: none;">
                                                                <input type="text" name="P_id_edit" value="{{$patient->id}}" style="display: none;">
                                                                <input type="text" name="P_name_edit" required="" class="form-control" placeholder="Name" value="{{$patient->f_name}} {{$patient->m_name}} {{$patient->l_name}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">O.R. No.</label>
                                                            <div class="col-sm-3">
                                                                <input type="text" name="orno_edit" class="form-control orno_edit" placeholder="O.R. No." value="{{$receipt_number}}" readonly="">
                                                            </div>
                                                        </div>

                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-1 control-label">Address:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="address_edit" required="" class="form-control" placeholder="Address" value="{{$patient->address}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">Sex:</label>
                                                            <div class="col-sm-3">
                                                                <select id="agesex" name="agesex_edit" class="form-control" required="" disabled=""> 
                                                                    <option value="{{$patient->gender}}" selected="">{{$patient->gender}}</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-1 control-label">Physician:</label>
                                                            <div class="col-sm-6">
                                                                <select id="physician" name="physician_edit" class="form-control physician_edit">
                                                                    @if(Session::get('position') == "Doctor")
                                                                        @foreach($doctor as $doc)
                                                                            @if(Session::get('user') == $doc->id)
                                                                                <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}" selected="">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    @else
                                                                        <option value="">-- Select One --</option>
                                                                        @foreach($doctor as $doc)
                                                                            <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-2 control-label">Date:</label>
                                                            <div class="col-sm-3">
                                                                <?php $datenow = date("Y-m-d"); ?>
                                                                <input type="text" name="xraydate_edit" class="form-control xraydate_edit" required="" value="{{$datenow}}" disabled="">
                                                            </div>
                                                        </div>
                                                        <!-- <div class="form-group divxrayinfo">
                                                            <label class="col-sm-1 control-label">Phys.Fee:</label>
                                                            <div class="col-sm-3">
                                                                <input type="text" name="pfee" class="form-control pfee_edit stopalpha" placeholder="0.00" required="">
                                                            </div>
                                                            <label class="col-sm-5 control-label">Edit Date:</label>
                                                            <div class="col-sm-3">
                                                            <?php $datenow = date("Y-m-d"); ?>
                                                                <input type="text" id="datepickerxray" name="xraydate_edit_edit" class="form-control xraydate" required="" value="{{$datenow}}" readonly="" disabled="">
                                                            </div>
                                                        </div> -->
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-1 control-label">PLATE</label>
                                                            <div class="col-sm-3">
                                                                <input type="text" name="plate" class="form-control plate_edit" placeholder="PLATE" autocomplete="off" readonly="">
                                                            </div>
                                                        </div>

                                                        <h5><b>Result / Finding :</b></h5>

                                                        <div class="form-group divxrayinfo">
                                                            <div class="col-sm-6">
                                                                <div class="checkbox results_edit"></div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group divxrayinfo results_info_edit"></div>

                                                        <!-- <div class="form-group phyname divxrayinfo"></div>
                                                        <div class="form-group phypos"></div> -->

                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label"></label>
                                                            <div class="col-sm-3">
                                                                <button class="btn btn-primary btn-xs" id="btn-submit-social_history" type="submit">Save Changes</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END MODAL -->

                <!-- XRAY NEW MODAL -->
                <div class="modal fade" id="modal_xraynew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modalwidth" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="table-responsive">
                                    <div class="col-md-12">
                                        <center><h3 class="neg">NEGROS FAMILY HEALTH SERVICES INC.</h3></center>
                                        <center><p class="nor">North Road, Daro(in front of NOPH) Dumaguete City, Negros Oriental</p></center>
                                        <center><p class="nor">Tel. No. (035) 225-3544</p></center>
                                        <h4><b>X-RAY / ULTRASOUND</b></h4>

                                        <form class="form-horizontal" method="POST" action="/visit/{{$patient->id}}/{{$vid}}">
                                        {!! csrf_field() !!}
                                            <div class="form-group">
                                                <label class="col-sm-1 control-label">Name:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="P_id" value="{{$patient->id}}" style="display: none;">
                                                    <input type="text" name="P_name" required="" class="form-control" placeholder="Name" value="{{$patient->f_name}} {{$patient->m_name}} {{$patient->l_name}}" readonly="">
                                                </div>
                                                <label class="col-sm-2 control-label">O.R. No.</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="orno" class="form-control" placeholder="O.R. No." autocomplete="off" readonly="" value="{{$receipt_number}}">
                                                </div>
                                            </div>
                                            <div class="form-group divxrayinfo">
                                                <label class="col-sm-1 control-label">Address:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="address" required="" class="form-control" placeholder="Address" value="{{$patient->address}}" readonly="">
                                                </div>
                                                <label class="col-sm-2 control-label">Sex:</label>
                                                <div class="col-sm-3">
                                                    <select id="agesex" name="agesex" class="form-control" required="" disabled=""> 
                                                        <option value="{{$patient->gender}}" selected="">{{$patient->gender}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group divxrayinfo">
                                                <label class="col-sm-1 control-label">Physician:</label>
                                                <div class="col-sm-6">
                                                    <select id="physician" name="physician" class="form-control physician">
                                                        @if(Session::get('position') == "Doctor")
                                                            @foreach($doctor as $doc)
                                                                @if(Session::get('user') == $doc->id)
                                                                    <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}" selected="">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <option value="">-- Select One --</option>
                                                            @foreach($doctor as $doc)
                                                                    <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <label class="col-sm-2 control-label">Date:</label>
                                                <div class="col-sm-3">
                                                <?php $datenow = date("Y-m-d"); ?>
                                                    <input type="text" id="datepicker" name="xraydate" class="form-control xraydate" required="" value="{{$datenow}}" disabled="">
                                                </div>
                                            </div>
                                            <!-- <div class="form-group divxrayinfo">
                                                <label class="col-sm-1 control-label">Phys.Fee:</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="pfee" class="form-control pfee" placeholder="0.00" required="" autocomplete="off">
                                                </div>
                                            </div> -->
                                            <div class="form-group divxrayinfo">
                                                <label class="col-sm-1 control-label">PLATE</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="plate" class="form-control plate" placeholder="PLATE" autocomplete="off" readonly="">
                                                </div>
                                            </div>

                                            <h5><b>Result / Finding :</b></h5>

                                            <div class="form-group divxrayinfo">
                                                <div class="col-sm-6">
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="finding" checked="" value="Normal" class="noramlfinding">Normal</label>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <label><input type="checkbox" value="Not Normal" class="notnoramlfinding">Not Normal</label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group divxrayinfo">
                                                <div class="col-sm-12 fnnormal">
                                                    <textarea class="form-control txtcommnor" name="comm" rows="5" id="comment"></textarea>
                                                </div>
                                                <div class="col-sm-12 fnnotnormal" style="display: none;">
                                                    <textarea class="form-control txtcommnotnor" rows="5" id="comment"></textarea>
                                                </div>
                                            </div>

                                            <!-- <div class="form-group phyname divxrayinfo"></div>
                                            <div class="form-group phypos"></div> -->

                                            <div class="form-group">
                                                <label for="inputEmail3" class="control-label"></label>
                                                <div class="col-sm-3">
                                                    <button class="btn btn-primary btn-xs" id="btn-submit-social_history" type="submit">Submit</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>            
                <!-- END MODAL -->

                            <!-- XRAY LOGS MODAL -->
                            <div class="modal fade" id="modal_patientxraylog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th class="text-center">Date</th>
                                                        <th class="text-center">Physician</th>
                                                        <th class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="xraylogs">
                                                </tbody>
                                            </table>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END MODAL -->

                        <!-- Lab Test -->
                        <div role="tabpanel" class="tab-pane fade" id="labtest">
                            <ul class="nav nav-tabs" role="tablist">
                                @if(Session::get('position') == "Doctor")
                                    @foreach($Labtest as $service)
                                        @if($service->id != 5 && $service->id != 6 && $service->id != 7 && $service->id != 8 && $service->id != 9)
                                        <li role="presentation" class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="font-size: 8pt;">{{$service->cat_name}} <span class="caret"></span></a>
                                            @if($service->id == 1)
                                            <ul class="dropdown-menu">
                                                <li role="presentation">
                                                    <a href="#Urinalysis" role="tab" data-toggle="tab" style="font-size: 8pt;">Urinalysis</a>
                                                </li>
                                                <li role="presentation">
                                                    <a href="#Fecalysis" role="tab" data-toggle="tab" style="font-size: 8pt;">Fecalysis</a>
                                                </li>                     
                                            </ul>
                                            @elseif($service->id == 2)
                                            <ul class="dropdown-menu">
                                                <li role="presentation">
                                                    <a href="#ChemistryI" role="tab" data-toggle="tab" style="font-size: 8pt;">Chemistry I</a>
                                                </li>
                                                <li role="presentation">
                                                    <a href="#OGTT" role="tab" data-toggle="tab" style="font-size: 8pt;">OGTT</a>
                                                </li>
                                            </ul>
                                            @elseif($service->id == 3)
                                            <ul class="dropdown-menu">
                                                <li role="presentation">
                                                    <a href="#Hematology" role="tab" data-toggle="tab" style="font-size: 8pt;">Hematology</a>
                                                </li>
                                                <li role="presentation">
                                                    <a href="#Aptt" role="tab" data-toggle="tab" style="font-size: 8pt;">APTT</a>
                                                </li>
                                            </ul>
                                            @elseif($service->id == 4)
                                            <ul class="dropdown-menu">
                                                <li role="presentation">
                                                    <a href="#Serology" role="tab" data-toggle="tab" style="font-size: 8pt;">Serology</a>
                                                </li>
                                            </ul>
                                            @elseif($service->id == 10)
                                            <ul class="dropdown-menu">
                                                <li role="presentation">
                                                    <a href="#ChemistryII" role="tab" data-toggle="tab" style="font-size: 8pt;">Chemistry II</a>
                                                </li>
                                            </ul>
                                            @endif
                                        </li>
                                        @endif
                                    @endforeach
                                @elseif(Session::get('position') == "Labtest")
                                    @foreach($Labtest as $service)
                                        @if($service->id != 5 && $service->id != 6 && $service->id != 7 && $service->id != 8 && $service->id != 9)
                                        <li role="presentation" class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="font-size: 8pt;">{{$service->cat_name}} <span class="caret"></span></a>
                                            @if($service->id == 1)
                                            <ul class="dropdown-menu">
                                                <li role="presentation">
                                                    <a href="#Urinalysis" role="tab" data-toggle="tab" style="font-size: 8pt;">Urinalysis</a>
                                                </li>
                                                <li role="presentation">
                                                    <a href="#Fecalysis" role="tab" data-toggle="tab" style="font-size: 8pt;">Fecalysis</a>
                                                </li>                     
                                            </ul>
                                            @elseif($service->id == 2)
                                            <ul class="dropdown-menu">
                                                <li role="presentation">
                                                    <a href="#ChemistryI" role="tab" data-toggle="tab" style="font-size: 8pt;">Chemistry I</a>
                                                </li>
                                                <li role="presentation">
                                                    <a href="#OGTT" role="tab" data-toggle="tab" style="font-size: 8pt;">OGTT</a>
                                                </li>
                                            </ul>
                                            @elseif($service->id == 3)
                                            <ul class="dropdown-menu">
                                                <li role="presentation">
                                                    <a href="#Hematology" role="tab" data-toggle="tab" style="font-size: 8pt;">Hematology</a>
                                                </li>
                                                <li role="presentation">
                                                    <a href="#Aptt" role="tab" data-toggle="tab" style="font-size: 8pt;">APTT</a>
                                                </li>
                                            </ul>
                                            @elseif($service->id == 4)
                                            <ul class="dropdown-menu">
                                                <li role="presentation">
                                                    <a href="#Serology" role="tab" data-toggle="tab" style="font-size: 8pt;">Serology</a>
                                                </li>
                                            </ul>
                                            @elseif($service->id == 10)
                                            <ul class="dropdown-menu">
                                                <li role="presentation">
                                                    <a href="#ChemistryII" role="tab" data-toggle="tab" style="font-size: 8pt;">Chemistry II</a>
                                                </li>
                                            </ul>
                                            @endif
                                        </li>
                                        @endif
                                    @endforeach
                                @endif
                            </ul>

                            <div class="tab-content">
                                <!-- done OK-->
                                <div role="tabpanel" class="tab-pane fade" id="Urinalysis">
                                <div class="col-md-12">
                                    <div class="flash-message top-message topmessage7"></div><br>
                                    @if($Urinalyses)
                                    <a href="/visit/{{$id}}/{{$vid}}/urinalysisdone" class="btn btn-xs btn-primary">Done Service</a>
                                    <a href="/visit/{{$id}}/{{$vid}}/urinalysisdone/pdf" target="_blank" class="btn btn-xs btn-success">Print</a>
                                    @endif
                                            <div class="table-responsive">
                                                <div class="col-md-12">
                                                    <center><h3 class="neg">NEGROS FAMILY HEALTH SERVICES INC.</h3></center>
                                                    <center><p class="nor">North Road, Daro(in front of NOPH) Dumaguete City, Negros Oriental</p></center>
                                                    <center><p class="nor">Tel. No. (035) 225-3544</p></center>
                                                    <h4><b>URINALYSIS</b></h4>
                                                    @if(!$Urinalyses)
                                                    <form class="form-horizontal" method="POST" action="/visit/{{$id}}/{{$vid}}/urinalysis">
                                                    {!! csrf_field() !!}
                                                    <input type="text" name="uri_id" value="" class="uri_id" style="display: none;">
                                                        <div class="form-group">
                                                            <label class="col-sm-1 control-label">Name:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="P_id" value="{{$id}}" style="display: none;">
                                                                <input type="text" name="P_name" required="" class="form-control" placeholder="Name" value="{{$patient->f_name}} {{$patient->m_name}} {{$patient->l_name}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">O.R. No.</label>
                                                            <div class="col-sm-3">
                                                                <input type="text" name="orno" class="form-control uri_orno" placeholder="O.R. No." readonly="" value="{{$receipt_number}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-1 control-label">Address:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="address" required="" class="form-control" placeholder="Address" value="{{$patient->address}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">Sex:</label>
                                                            <div class="col-sm-3">
                                                                <select id="agesex" name="agesex" class="form-control" required="" disabled=""> 
                                                                    <option value="{{$patient->gender}}" selected="">{{$patient->gender}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="form-group divxrayinfo">
                                                            <label class="col-sm-1 control-label">Physician:</label>
                                                            <div class="col-sm-6">
                                                                <select id="physician" name="physician" class="form-control uri_physician" required="">
                                                                    <option value="">-- Select One --</option>
                                                                    @foreach($doctor as $doc)
                                                                    @if(Session::get('position') == "Doctor")
                                                                        @if(Session::get('user') == $doc->id)
                                                                        <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}" selected="">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @endif
                                                                    @else
                                                                        @if($doc->user->position == "Doctor")
                                                                        <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @endif
                                                                    @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-2 control-label">Date:</label>
                                                            <div class="col-sm-3">
                                                            <?php $datenow = date("Y-m-d"); ?>
                                                                <input type="text" id="datepicker" class="form-control uri_date" required="" value="{{$datenow}}" disabled="">
                                                            </div>
                                                        </div> -->
                                                        <div class=" divxrayinfo">
                                                        <div class="row"> 
                                                            <div class="col-sm-6">
                                                                <label class="control-label" style="text-align: left;"><input type="checkbox" class="physical" name="physical" checked="" value="Yes"> <b>PHYSICAL</b></label>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Color </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="color" class="form-control color" placeholder="Color" value="" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Transparency </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="transparency" class="form-control transparency" placeholder="Transparency" value="" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Specific Gravity </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="SG" class="form-control SG" placeholder="Specific Gravity" value="" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <label class="control-label" style="text-align: left;"><input type="checkbox" class="microscopic" name="microscopic" checked="" value="Yes"> <b>MICROSCOPIC</b></label>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;WBC  </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="wbc" class="form-control wbc" placeholder="WBC" value="" autocomplete="off">
                                                                    </div>
                                                                    <div>
                                                                        <label class="control-label">HPF</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RBC </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="rbc" class="form-control rbc" placeholder="RBC" value="" autocomplete="off">
                                                                    </div>
                                                                    <div>
                                                                        <label class="control-label">HPF</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Epith. Cells </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="EC" class="form-control EC" placeholder="Epith. Cells" value="" autocomplete="off">
                                                                    </div>
                                                                    <div>
                                                                        <label class="control-label">HPF</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bacteria </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="bacteria" class="form-control bacteria" placeholder="Bacteria" value="" autocomplete="off">
                                                                    </div>
                                                                    <div>
                                                                        <label class="control-label">HPF</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cast(s) </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="cast" class="form-control cast" placeholder="Cast" value="" autocomplete="off">
                                                                    </div>
                                                                    <div>
                                                                        <label class="control-label">LPF</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label"></label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="cast2" class="form-control cast2" placeholder="Cast" value="" autocomplete="off">
                                                                    </div>
                                                                    <div>
                                                                        <label class="control-label">LPF</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Crystal(s) </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="crystal" class="form-control crystal" placeholder="Crystal" value="" autocomplete="off">
                                                                    </div>
                                                                    <div>
                                                                        <label class="control-label">LPF</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label"></label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="crystal2" class="form-control crystal2" placeholder="Crystal" value="" autocomplete="off">
                                                                    </div>
                                                                    <div>
                                                                        <label class="control-label">LPF</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">Amorphous_Materials</label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="AM" class="form-control AM" placeholder="Amorphous Materials" value="" autocomplete="off">
                                                                    </div>
                                                                    <div>
                                                                        <label class="control-label">HPF</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mucus Thread </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="MT" class="form-control MT" placeholder="Mucus Thread" value="" autocomplete="off">
                                                                    </div>
                                                                    <div>
                                                                        <label class="control-label">HPF</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Others </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="others" class="form-control others" placeholder="Others" value="" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label"></label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="others2" class="form-control others2" placeholder="Others" value="" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label"></label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="others3" class="form-control others3" placeholder="Others" value="" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6" style="margin-top:-33%;">
                                                                <label class="control-label" style="text-align: left;"><input type="checkbox" class="chemical" name="chemical" checked="" value="Yes"> <b>CHEMICAL</b></label>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Glucose </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="glucose" class="form-control glucose" placeholder="Glucose" value="" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bilirubin </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="bilirubin" class="form-control bilirubin" placeholder="Bilirubin" value="" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ketone </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="ketone" class="form-control ketone" placeholder="Ketone" value="" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Blood </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="blood" class="form-control blood" placeholder="Blood" value="" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pH </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="ph" class="form-control ph" placeholder="pH" value="" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Protein </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="protein" class="form-control protein" placeholder="Protein" value="" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Urobilingen </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="urobilingen" class="form-control urobilingen" placeholder="Urobilingen" value="" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nitrites </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="nitrites" class="form-control nitrites" placeholder="Nitrites" value="" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Leucocytes </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="leucocytes" class="form-control leucocytes" placeholder="Leucocytes" value="" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><br>
                                                        @if(Session::get('position') == "Doctor")
                                                            @foreach($PatientService1002 as $service)
                                                                @if($service->admin_panel_id == 4 && $service->admin_panel_sub_id == 40)
                                                                    <div class="row">
                                                                        <div class="col-sm-12" >
                                                                            <label class="control-label" style="text-align: left;"><input type="checkbox" class="preg_test" name="preg_test" checked="" value="Yes"> <b>PREGNANCY TEST</b></label>
                                                                            <div class="row">
                                                                                <div class="col-sm-2">
                                                                                    <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS </label>
                                                                                </div>
                                                                                <div class="col-sm-10">
                                                                                    <textarea class="form-control preg_remarks" name="preg_remarks" rows="5" id="preg_remarks"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @elseif(Session::get('position') == "Labtest")
                                                            @foreach($PatientService1002 as $service)
                                                                @if($service->admin_panel_id == 4 && $service->admin_panel_sub_id == 40)
                                                                    <div class="row">
                                                                        <div class="col-sm-12" >
                                                                            <label class="control-label" style="text-align: left;"><input type="checkbox" class="preg_test" name="preg_test" checked="" value="Yes"> <b>PREGNANCY TEST</b></label>
                                                                            <div class="row">
                                                                                <div class="col-sm-2">
                                                                                    <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS </label>
                                                                                </div>
                                                                                <div class="col-sm-10">
                                                                                    <textarea class="form-control preg_remarks" name="preg_remarks" rows="5" id="preg_remarks"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label"></label>
                                                            <div class="col-sm-3">
                                                                <button class="btn btn-xs btn-primary" id="btn-submit-social_history" type="submit">Submit</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    @else
                                                    <form class="form-horizontal" method="POST" action="/visit/{{$id}}/{{$vid}}/urinalysis">
                                                    {!! csrf_field() !!}
                                                    <input type="text" name="uri_id" value="{{$Urinalyses->id}}" class="uri_id" style="display: none;">
                                                        <div class="form-group">
                                                            <label class="col-sm-1 control-label">Name:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="P_id" value="{{$id}}" style="display: none;">
                                                                <input type="text" name="P_name" required="" class="form-control" placeholder="Name" value="{{$patient->f_name}} {{$patient->m_name}} {{$patient->l_name}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">O.R. No.</label>
                                                            <div class="col-sm-3">
                                                                <input type="text" name="orno" class="form-control uri_orno" value="{{$receipt_number}}" readonly="" placeholder="O.R. No.">
                                                            </div>
                                                        </div>
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-1 control-label">Address:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="address" required="" class="form-control" placeholder="Address" value="{{$patient->address}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">Sex:</label>
                                                            <div class="col-sm-3">
                                                                <select id="agesex" name="agesex" class="form-control" required="" disabled=""> 
                                                                    <option value="{{$patient->gender}}" selected="">{{$patient->gender}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="form-group divxrayinfo">
                                                            <label class="col-sm-1 control-label">Physician:</label>
                                                            <div class="col-sm-6">
                                                                <select id="physician" name="physician" class="form-control uri_physician" required="">
                                                                    <option value="">-- Select One --</option>
                                                                    @foreach($doctor as $doc)
                                                                        @if($Urinalyses->physician_id == $doc->id)
                                                                        <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}" selected="">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @else
                                                                        <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-2 control-label">Date:</label>
                                                            <div class="col-sm-3">
                                                            <?php $datenow = date("Y-m-d"); ?>
                                                                <input type="text" id="datepicker" class="form-control uri_date" required="" value="{{$Urinalyses->date}}" disabled="">
                                                            </div>
                                                        </div> -->
                                                        <div class=" divxrayinfo">
                                                        <div class="row"> 
                                                            <div class="col-sm-6">
                                                                @if($Urinalyses->physical == 'Yes')
                                                                    <label class="control-label" style="text-align: left;"><input type="checkbox" class="physical" name="physical" checked="" value="Yes"> <b>PHYSICAL</b></label>
                                                                @else
                                                                    <label class="control-label" style="text-align: left;"><input type="checkbox" class="physical" name="physical" value="Yes"> <b>PHYSICAL</b></label>
                                                                @endif
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Color </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="color" class="form-control color" placeholder="Color" value="{{$Urinalyses->color}}" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Transparency </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="transparency" class="form-control transparency" placeholder="Transparency" value="{{$Urinalyses->transparency}}" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Specific Gravity </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="SG" class="form-control SG" placeholder="Specific Gravity" value="{{$Urinalyses->specific_gravity}}" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                @if($Urinalyses->microscopic == 'Yes')
                                                                    <label class="control-label" style="text-align: left;"><input type="checkbox" class="microscopic" name="microscopic" checked="" value="Yes"> <b>MICROSCOPIC</b></label>
                                                                @else
                                                                    <label class="control-label" style="text-align: left;"><input type="checkbox" class="microscopic" name="microscopic" value="Yes"> <b>MICROSCOPIC</b></label>
                                                                @endif
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;WBC  </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="wbc" class="form-control wbc" placeholder="WBC" value="{{$Urinalyses->wbc}}" autocomplete="off">
                                                                    </div>
                                                                    <div>
                                                                        <label class="control-label">HPF</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RBC </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="rbc" class="form-control rbc" placeholder="RBC" value="{{$Urinalyses->rbc}}" autocomplete="off">
                                                                    </div>
                                                                    <div>
                                                                        <label class="control-label">HPF</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Epith. Cells </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="EC" class="form-control EC" placeholder="Epith. Cells" value="{{$Urinalyses->epith_cell}}" autocomplete="off">
                                                                    </div>
                                                                    <div>
                                                                        <label class="control-label">HPF</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bacteria </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="bacteria" class="form-control bacteria" placeholder="Bacteria" value="{{$Urinalyses->bacteria}}" autocomplete="off">
                                                                    </div>
                                                                    <div>
                                                                        <label class="control-label">HPF</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cast(s) </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="cast" class="form-control cast" placeholder="Cast" value="{{$Urinalyses->cast}}" autocomplete="off">
                                                                    </div>
                                                                    <div>
                                                                        <label class="control-label">LPF</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label"></label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="cast2" class="form-control cast2" placeholder="Cast" value="{{$Urinalyses->cast2}}" autocomplete="off">
                                                                    </div>
                                                                    <div>
                                                                        <label class="control-label">LPF</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Crystal(s) </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="crystal" class="form-control crystal" placeholder="Crystal" value="{{$Urinalyses->crystal}}" autocomplete="off">
                                                                    </div>
                                                                    <div>
                                                                        <label class="control-label">LPF</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label"></label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="crystal2" class="form-control crystal2" placeholder="Crystal" value="{{$Urinalyses->crystal2}}" autocomplete="off">
                                                                    </div>
                                                                    <div>
                                                                        <label class="control-label">LPF</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">Amorphous_Materials</label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="AM" class="form-control AM" placeholder="Amorphous Materials" value="{{$Urinalyses->amorphous_material}}" autocomplete="off">
                                                                    </div>
                                                                    <div>
                                                                        <label class="control-label">HPF</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mucus Thread </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="MT" class="form-control MT" placeholder="Mucus Thread" value="{{$Urinalyses->mucus_thread}}" autocomplete="off">
                                                                    </div>
                                                                    <div>
                                                                        <label class="control-label">HPF</label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Others </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="others" class="form-control others" placeholder="Others" value="{{$Urinalyses->other}}" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label"></label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="others2" class="form-control others2" placeholder="Others" value="{{$Urinalyses->other2}}" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label"></label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="others3" class="form-control others3" placeholder="Others" value="{{$Urinalyses->other3}}" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6" style="margin-top:-33%;">
                                                                @if($Urinalyses->chemical == 'Yes')
                                                                    <label class="control-label" style="text-align: left;"><input type="checkbox" class="chemical" name="chemical" checked="" value="Yes"> <b>CHEMICAL</b></label>
                                                                @else
                                                                    <label class="control-label" style="text-align: left;"><input type="checkbox" class="chemical" name="chemical" value="Yes"> <b>CHEMICAL</b></label>
                                                                @endif
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Glucose </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="glucose" class="form-control glucose" placeholder="Glucose" value="{{$Urinalyses->glucose}}" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bilirubin </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="bilirubin" class="form-control bilirubin" placeholder="Bilirubin" value="{{$Urinalyses->bilirubin}}" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ketone </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="ketone" class="form-control ketone" placeholder="Ketone" value="{{$Urinalyses->ketone}}" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Blood </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="blood" class="form-control blood" placeholder="Blood" value="{{$Urinalyses->blood}}" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pH </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="ph" class="form-control ph" placeholder="pH" value="{{$Urinalyses->ph}}" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Protein </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="protein" class="form-control protein" placeholder="Protein" value="{{$Urinalyses->protein}}" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Urobilingen </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="urobilingen" class="form-control urobilingen" placeholder="Urobilingen" value="{{$Urinalyses->urobilinogen}}" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nitrites </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="nitrites" class="form-control nitrites" placeholder="Nitrites" value="{{$Urinalyses->nitrites}}" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Leucocytes </label>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <input type="text" name="leucocytes" class="form-control leucocytes" placeholder="Leucocytes" value="{{$Urinalyses->leucocytes}}" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><br>
                                                        @if(Session::get('position') == "Doctor")
                                                            @foreach($PatientService1002 as $service)
                                                                @if($service->admin_panel_id == 4 && $service->admin_panel_sub_id == 40)
                                                                    <div class="row">
                                                                        <div class="col-sm-12" >
                                                                            @if($Urinalyses->pregnancy_test == 'Yes')
                                                                                <label class="control-label" style="text-align: left;"><input type="checkbox" class="preg_test" name="preg_test" checked="" value="Yes"> <b>PREGNANCY TEST</b></label>
                                                                            @else
                                                                                <label class="control-label" style="text-align: left;"><input type="checkbox" class="preg_test" name="preg_test" value="Yes"> <b>PREGNANCY TEST</b></label>
                                                                            @endif
                                                                            <div class="row">
                                                                                <div class="col-sm-2">
                                                                                    <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS </label>
                                                                                </div>
                                                                                <div class="col-sm-10">
                                                                                    <textarea class="form-control preg_remarks" name="preg_remarks" rows="5" id="preg_remarks">{{$Urinalyses->preg_remark}}</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @elseif(Session::get('position') == "Labtest")
                                                            @foreach($PatientService1002 as $service)
                                                                @if($service->admin_panel_id == 4 && $service->admin_panel_sub_id == 40)
                                                                    <div class="row">
                                                                        <div class="col-sm-12" >
                                                                            @if($Urinalyses->pregnancy_test == 'Yes')
                                                                                <label class="control-label" style="text-align: left;"><input type="checkbox" class="preg_test" name="preg_test" checked="" value="Yes"> <b>PREGNANCY TEST</b></label>
                                                                            @else
                                                                                <label class="control-label" style="text-align: left;"><input type="checkbox" class="preg_test" name="preg_test" value="Yes"> <b>PREGNANCY TEST</b></label>
                                                                            @endif
                                                                            <div class="row">
                                                                                <div class="col-sm-2">
                                                                                    <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARKS </label>
                                                                                </div>
                                                                                <div class="col-sm-10">
                                                                                    <textarea class="form-control preg_remarks" name="preg_remarks" rows="5" id="preg_remarks">{{$Urinalyses->preg_remark}}</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label"></label>
                                                            <div class="col-sm-3">
                                                                <button class="btn btn-xs btn-primary" id="btn-submit-social_history" type="submit">Save Changes</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    @endif
                                                </div>
                                            </div>
                                </div>
                                </div>
                                <!-- done OK-->
                                <div role="tabpanel" class="tab-pane fade" id="Fecalysis">
                                <div class="col-md-12">
                                    <div class="flash-message top-message topmessage7"></div><br>
                                    @if($Fecalyses)
                                    <a href="/visit/{{$id}}/{{$vid}}/fecalysisdone" class="btn btn-xs btn-primary">Done Service</a>
                                    <a href="/visit/{{$id}}/{{$vid}}/fecalysisdone/pdf" target="_blank" class="btn btn-xs btn-success">Print</a>
                                    @endif
                                        <div class="col-md-12">
                                            <center><h3 class="neg">NEGROS FAMILY HEALTH SERVICES INC.</h3></center>
                                            <center><p class="nor">North Road, Daro(in front of NOPH) Dumaguete City, Negros Oriental</p></center>
                                            <center><p class="nor">Tel. No. (035) 225-3544</p></center>
                                            <h4>
                                                <i style="font-size: 8pt;">Clinical Laboratory</i><br>
                                                <b>FECALYSIS</b>
                                            </h4>
                                            @if(!$Fecalyses)
                                                <form class="form-horizontal" method="POST" action="/visit/{{$id}}/{{$vid}}/fecalysis">
                                                    {!! csrf_field() !!}
                                                    <input type="text" name="uri_id" value="" class="uri_id" style="display: none;">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Name:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="P_id" value="{{$id}}" style="display: none;">
                                                                <input type="text" name="P_name" required="" class="form-control" placeholder="Name" value="{{$patient->f_name}} {{$patient->m_name}} {{$patient->l_name}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">O.R. No.</label>
                                                            <div class="col-sm-2">
                                                                <input type="text" name="orno" class="form-control uri_orno" placeholder="O.R. No." readonly="" value="{{$receipt_number}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Address:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="address" required="" class="form-control" placeholder="Address" value="{{$patient->address}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">Sex:</label>
                                                            <div class="col-sm-2">
                                                                <select id="agesex" name="agesex" class="form-control" required="" disabled=""> 
                                                                    <option value="{{$patient->gender}}" selected="">{{$patient->gender}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Physician:</label>
                                                            <div class="col-sm-6">
                                                                <select id="physician" name="physician" class="form-control uri_physician" required="">
                                                                    <option value="">-- Select One --</option>
                                                                    @foreach($doctor as $doc)
                                                                    @if(Session::get('position') == "Doctor")
                                                                        @if(Session::get('user') == $doc->id)
                                                                        <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}" selected="">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @endif
                                                                    @else
                                                                        @if($doc->user->position == "Doctor")
                                                                        <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @endif
                                                                    @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-2 control-label">Date:</label>
                                                            <div class="col-sm-2">
                                                            <?php $datenow = date("Y-m-d"); ?>
                                                                <input type="text" id="datepicker" class="form-control uri_date" required="" value="{{$datenow}}" disabled="">
                                                            </div>
                                                        </div> -->
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Requesting M.D.</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" class="form-control req_doc" name="req_doc" placeholder="Requesting M.D.">
                                                            </div>
                                                        </div>

                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: left;"><input type="checkbox" class="routine" name="routine" checked="" value="Yes"> <b>ROUTINE</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-2">
                                                                    <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Consistency </label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" name="consistency" class="form-control consistency" placeholder="Consistency" value="" autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2" style="text-align: right;">
                                                                    <label class="control-label">Color </label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" name="color" class="form-control color" placeholder="Color" value="" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-2">
                                                                    <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Red Cells </label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" name="red_cells" class="form-control red_cells" placeholder="Red Cells" value="" autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2" style="text-align: right;">
                                                                    <label class="control-label">Ascaris </label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" name="ascaris" class="form-control ascaris" placeholder="Ascaris" value="" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-2">
                                                                    <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pus Cells </label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" name="pus_cells" class="form-control pus_cells" placeholder="Pus Cells" value="" autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2" style="text-align: right;">
                                                                    <label class="control-label">Trichuris </label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" name="trichuris" class="form-control trichuris" placeholder="Trichuris" value="" autocomplete="off">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-2">
                                                                    <label class="control-label" style="text-align: left;"><input type="checkbox" class="amoeba" name="amoeba" checked="" value="Yes"> <b>Amoeba</b></label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" name="amoeba_desc" class="form-control amoeba_desc" placeholder="Amoeba" value="" autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2" style="text-align: right;">
                                                                    <label class="control-label">Hookworm </label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" name="hookworm" class="form-control hookworm" placeholder="Hookworm" value="" autocomplete="off">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: left;"><b>Others</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-12">
                                                                    <textarea class="form-control others_desc" name="others_desc" rows="2"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: left;"><b>Remarks</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-12">
                                                                    <textarea class="form-control remarks" name="remarks" rows="2"></textarea>
                                                                </div>
                                                            </div>
                                                        </div><br><br>

                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    ________________________________________<br>
                                                                    <b>ROGELIO S. McNTIRE, M.D.,FPSP</b><br>
                                                                    <i style="font-size: 9pt;">Pathologist</i>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    ________________________________________, RMT
                                                                </div>
                                                            </div>
                                                        </div><br>

                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <i style="font-size: 9pt;">Time Submitted ______________________</i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <i style="font-size: 9pt;">Time Done __________________________</i>
                                                                </div>
                                                            </div>
                                                        </div><br>

                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label"></label>
                                                            <div class="col-sm-3">
                                                                <button class="btn btn-xs btn-primary" id="btn-submit-social_history" type="submit">Submit</button>
                                                            </div>
                                                        </div>
                                                </form>
                                            @else
                                                <form class="form-horizontal" method="POST" action="/visit/{{$id}}/{{$vid}}/fecalysis">
                                                    {!! csrf_field() !!}
                                                    <input type="text" name="uri_id" value="{{$Fecalyses->id}}" class="uri_id" style="display: none;">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Name:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="P_id" value="{{$id}}" style="display: none;">
                                                                <input type="text" name="P_name" required="" class="form-control" placeholder="Name" value="{{$patient->f_name}} {{$patient->m_name}} {{$patient->l_name}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">O.R. No.</label>
                                                            <div class="col-sm-2">
                                                                <input type="text" name="orno" class="form-control uri_orno" placeholder="O.R. No." value="{{$receipt_number}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Address:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="address" required="" class="form-control" placeholder="Address" value="{{$patient->address}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">Sex:</label>
                                                            <div class="col-sm-2">
                                                                <select id="agesex" name="agesex" class="form-control" required="" disabled=""> 
                                                                    <option value="{{$patient->gender}}" selected="">{{$patient->gender}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Physician:</label>
                                                            <div class="col-sm-6">
                                                                <select id="physician" name="physician" class="form-control uri_physician" required="">
                                                                    <option value="">-- Select One --</option>
                                                                    @foreach($doctor as $doc)
                                                                        @if($Fecalyses->doc_id == $doc->id)
                                                                        <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}" selected="">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @else
                                                                        <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-2 control-label">Date:</label>
                                                            <div class="col-sm-2">
                                                            <?php $datenow = date("Y-m-d"); ?>
                                                                <input type="text" id="datepicker" class="form-control uri_date" required="" value="{{$Fecalyses->date_reg}}" disabled="">
                                                            </div>
                                                        </div> -->
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Requesting M.D.</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" class="form-control req_doc" name="req_doc" placeholder="Requesting M.D." value="{{$Fecalyses->req_doc}}">
                                                            </div>
                                                        </div>

                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Fecalyses->routine == 'Yes')
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="routine" name="routine" checked="" value="Yes"> <b>ROUTINE</b></label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="routine" name="routine" value="Yes"> <b>ROUTINE</b></label>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-2">
                                                                    <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Consistency </label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" name="consistency" class="form-control consistency" placeholder="Consistency" value="{{$Fecalyses->consistency}}" autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2" style="text-align: right;">
                                                                    <label class="control-label">Color </label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" name="color" class="form-control color" placeholder="Color" value="{{$Fecalyses->color}}" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-2">
                                                                    <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Red Cells </label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" name="red_cells" class="form-control red_cells" placeholder="Red Cells" value="{{$Fecalyses->red_cell}}" autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2" style="text-align: right;">
                                                                    <label class="control-label">Ascaris </label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" name="ascaris" class="form-control ascaris" placeholder="Ascaris" value="{{$Fecalyses->ascari}}" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-2">
                                                                    <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pus Cells </label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" name="pus_cells" class="form-control pus_cells" placeholder="Pus Cells" value="{{$Fecalyses->pus_cell}}" autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2" style="text-align: right;">
                                                                    <label class="control-label">Trichuris </label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" name="trichuris" class="form-control trichuris" placeholder="Trichuris" value="{{$Fecalyses->trichuri}}" autocomplete="off">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-2">
                                                                    @if($Fecalyses->amoeba == 'Yes')
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="amoeba" name="amoeba" checked="" value="Yes"> <b>Amoeba</b></label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="amoeba" name="amoeba" value="Yes"> <b>Amoeba</b></label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" name="amoeba_desc" class="form-control amoeba_desc" placeholder="Amoeba" value="{{$Fecalyses->amoeba_desc}}" autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-2" style="text-align: right;">
                                                                    <label class="control-label">Hookworm </label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" name="hookworm" class="form-control hookworm" placeholder="Hookworm" value="{{$Fecalyses->hookworm}}" autocomplete="off">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: left;"><b>Others</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-12">
                                                                    <textarea class="form-control others_desc" name="others_desc" rows="2">{{$Fecalyses->feca_other}}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: left;"><b>Remarks</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-12">
                                                                    <textarea class="form-control remarks" name="remarks" rows="2">{{$Fecalyses->remark}}</textarea>
                                                                </div>
                                                            </div>
                                                        </div><br><br>

                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    ________________________________________<br>
                                                                    <b>ROGELIO S. McNTIRE, M.D.,FPSP</b><br>
                                                                    <i style="font-size: 9pt;">Pathologist</i>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    ________________________________________, RMT
                                                                </div>
                                                            </div>
                                                        </div><br>

                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <i style="font-size: 9pt;">Time Submitted ______________________</i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <i style="font-size: 9pt;">Time Done __________________________</i>
                                                                </div>
                                                            </div>
                                                        </div><br>

                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label"></label>
                                                            <div class="col-sm-3">
                                                                <button class="btn btn-xs btn-primary" id="btn-submit-social_history" type="submit">Save Changes</button>
                                                            </div>
                                                        </div>
                                                </form>
                                            @endif
                                        </div>
                                </div>
                                </div>
                                <!-- done OK-->
                                <div role="tabpanel" class="tab-pane fade" id="ChemistryI">
                                <div class="col-md-12">
                                    <div class="flash-message top-message topmessage7"></div><br>
                                    @if($Chemistry)
                                    <a href="/visit/{{$id}}/{{$vid}}/chemistryidone" class="btn btn-xs btn-primary">Done Service</a>
                                    <a href="/visit/{{$id}}/{{$vid}}/chemistryidone/pdf" target="_blank" class="btn btn-xs btn-success">Print</a>
                                    @endif
                                        <div class="col-md-12">
                                            <center><h3 class="neg">NEGROS FAMILY HEALTH SERVICES INC.</h3></center>
                                            <center><p class="nor">North Road, Daro(in front of NOPH) Dumaguete City, Negros Oriental</p></center>
                                            <center><p class="nor">Tel. No. (035) 225-3544</p></center>
                                            <h4><b>CHEMISTRY I</b></h4>
                                        @if(!$Chemistry)
                                            <form class="form-horizontal" method="POST" action="/visit/{{$id}}/{{$vid}}/chemistryii">
                                                    {!! csrf_field() !!}
                                                    <input type="text" name="uri_id" value="" class="uri_id" style="display: none;">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Name:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="P_id" value="{{$id}}" style="display: none;">
                                                                <input type="text" name="P_name" required="" class="form-control" placeholder="Name" value="{{$patient->f_name}} {{$patient->m_name}} {{$patient->l_name}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">O.R. No.</label>
                                                            <div class="col-sm-2">
                                                                <input type="text" name="orno" class="form-control uri_orno" placeholder="O.R. No." readonly="" value="{{$receipt_number}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Address:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="address" required="" class="form-control" placeholder="Address" value="{{$patient->address}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">Sex:</label>
                                                            <div class="col-sm-2">
                                                                <select id="agesex" name="agesex" class="form-control" required="" disabled=""> 
                                                                    <option value="{{$patient->gender}}" selected="">{{$patient->gender}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Physician:</label>
                                                            <div class="col-sm-6">
                                                                <select id="physician" name="physician" class="form-control uri_physician" required="">
                                                                    <option value="">-- Select One --</option>
                                                                    @foreach($doctor as $doc)
                                                                    @if(Session::get('position') == "Doctor")
                                                                        @if(Session::get('user') == $doc->id)
                                                                        <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}" selected="">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @endif
                                                                    @else
                                                                        @if($doc->user->position == "Doctor")
                                                                        <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @endif
                                                                    @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-2 control-label">Date:</label>
                                                            <div class="col-sm-2">
                                                            <?php $datenow = date("Y-m-d"); ?>
                                                                <input type="text" id="datepicker" class="form-control uri_date" required="" value="{{$datenow}}" disabled="">
                                                            </div>
                                                        </div> -->

                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: left;"><input type="checkbox" class="blood_sugar" name="blood_sugar" checked="" value="Yes"> <b>BLOOD SUGAR</b></label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label"><b>Result</b></label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label"><b>Normal Value</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="fasting" name="fasting" checked="" value="Yes"> Fasting</label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="fasting_result" class="form-control fasting_result" value="" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">75 - 115 mg / dl</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="ppbs" name="ppbs" checked="" value="Yes"> 2-hrs PPBS</label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="ppbs_result" class="form-control ppbs_result" value="" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">70 - 150 mg / dl</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="random" name="random" checked="" value="Yes"> Random</label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="random_result" class="form-control random_result" value="" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;font-size: 9pt;">
                                                                    <label class="control-label">< 60 yO 45 - 130mg/dl<br> > 60yO 70 - 160mg/dl</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="hbaic" name="hbaic" checked="" value="Yes"> HbAIC</label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="hbaic_result" class="form-control hbaic_result" value="" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">4.5 -6.3 %</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: left;"><input type="checkbox" class="kidney_function" name="kidney_function" checked="" value="Yes"> <b>KIDNEY FUNCTION</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="creatinine" name="creatinine" checked="" value="Yes"> Creatinine</label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="creatinine_result" class="form-control creatinine_result" value="" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;font-size: 9pt;">
                                                                    <label class="control-label">M09 - 13mg/dl <br> F06 - 11mg/dl</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="bun" name="bun" checked="" value="Yes"> BUN</label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="bun_result" class="form-control bun_result" value="" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">10 - 50mg/dl</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="uricacid" name="uricacid" checked="" value="Yes"> Uric Acid</label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="uricacid_result" class="form-control uricacid_result" value="" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">F24 - 57mg/dl</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: left;"><input type="checkbox" class="liver_function" name="liver_function" checked="" value="Yes"> <b>LIVER FUNCTION</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="sgpt" name="sgpt" checked="" value="Yes"> SGPT</label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="sgpt_result" class="form-control sgpt_result" value="" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;font-size: 9pt;">
                                                                    <label class="control-label">M 0 - 42 U/L<br>F 0 - 32 U/L</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="sgot" name="sgot" checked="" value="Yes"> SGOT</label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="sgot_result" class="form-control sgot_result" value="" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;font-size: 9pt;">
                                                                    <label class="control-label">M 0 - 37 U/L<br>F 0 - 31 U/L</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="alk_phos" name="alk_phos" checked="" value="Yes"> Alk. Phos.</label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="alk_phos_result" class="form-control alk_phos_result" value="" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;font-size: 9pt;">
                                                                    <label class="control-label">M 80 - 306 U/L<br>F 64 - 306 U/L</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: left;"><input type="checkbox" class="lipid_profile" name="lipid_profile" checked="" value="Yes"> <b>LIPID PROFILE</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="hdl_cholesterol" name="hdl_cholesterol" checked="" value="Yes"> HDL-Cholesterol</label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="hdl_cholesterol_result" class="form-control hdl_cholesterol_result" value="" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;font-size: 9pt;">
                                                                    <label class="control-label">M  > 55 mg/dl<br>F > 65 mg/dl</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="triglycerides" name="triglycerides" checked="" value="Yes"> Triglycerides</label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="triglycerides_result" class="form-control triglycerides_result" value="" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">40 - 190 mg/dl</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="total_cholesterol" name="total_cholesterol" checked="" value="Yes"> Total Cholesterol</label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="total_cholesterol_result" class="form-control total_cholesterol_result" value="" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">< 220 mg/dl</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="ldl_cholesterol" name="ldl_cholesterol" checked="" value="Yes"> LDL - Cholesterol</label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="ldl_cholesterol_result" class="form-control ldl_cholesterol_result" value="" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">< 150 mg/dl</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="tc_hdl_ratio" name="tc_hdl_ratio" checked="" value="Yes"> TC/HDL Ratio</label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="tc_hdl_ratio_result" class="form-control tc_hdl_ratio_result" value="" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">< 4.5 mg/dl</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: left;"><input type="checkbox" class="electrolytes" name="electrolytes" checked="" value="Yes"> <b>ELECTROLYTES</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="sodium" name="sodium" checked="" value="Yes"> Sodium</label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="sodium_result" class="form-control sodium_result" value="" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;font-size: 9pt;">
                                                                    <label class="control-label">F 135 - 155 mmol/L<br>M 135 - 148 mmol/L</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="potassium" name="potassium" checked="" value="Yes"> Potassium</label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="potassium_result" class="form-control potassium_result" value="" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">3.5 - 5.3 mmol/L</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="calcium" name="calcium" checked="" value="Yes"> Calcium</label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="calcium_result" class="form-control calcium_result" value="" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">8.6 - 10.3 mg/dl</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: left;"><b>OTHERS</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-12">
                                                                    <textarea class="form-control chem_others" name="chem_others" rows="2"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: left;"><b>REMARKS</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-12">
                                                                    <textarea class="form-control chem_remarks" name="chem_remarks" rows="2"></textarea>
                                                                </div>
                                                            </div>
                                                        </div><br><br>

                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    ________________________________________<br>
                                                                    <b>ROGELIO S. McNTIRE, M.D.,FPSP</b><br>
                                                                    <i style="font-size: 9pt;">Pathologist</i>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    ________________________________________, RMT
                                                                </div>
                                                            </div>
                                                        </div><br>

                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label"></label>
                                                            <div class="col-sm-3">
                                                                <button class="btn btn-xs btn-primary" id="btn-submit-social_history" type="submit">Submit</button>
                                                            </div>
                                                        </div>
                                            </form>
                                        @else
                                            <form class="form-horizontal" method="POST" action="/visit/{{$id}}/{{$vid}}/chemistryii">
                                                    {!! csrf_field() !!}
                                                    <input type="text" name="uri_id" value="{{$Chemistry->id}}" class="uri_id" style="display: none;">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Name:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="P_id" value="{{$id}}" style="display: none;">
                                                                <input type="text" name="P_name" required="" class="form-control" placeholder="Name" value="{{$patient->f_name}} {{$patient->m_name}} {{$patient->l_name}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">O.R. No.</label>
                                                            <div class="col-sm-2">
                                                                <input type="text" name="orno" class="form-control uri_orno" placeholder="O.R. No." value="{{$receipt_number}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Address:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="address" required="" class="form-control" placeholder="Address" value="{{$patient->address}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">Sex:</label>
                                                            <div class="col-sm-2">
                                                                <select id="agesex" name="agesex" class="form-control" required="" disabled=""> 
                                                                    <option value="{{$patient->gender}}" selected="">{{$patient->gender}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Physician:</label>
                                                            <div class="col-sm-6">
                                                                <select id="physician" name="physician" class="form-control uri_physician" required="">
                                                                    <option value="">-- Select One --</option>
                                                                    @foreach($doctor as $doc)
                                                                        @if($Chemistry->doc_id == $doc->id)
                                                                        <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}" selected="">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @else
                                                                        <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-2 control-label">Date:</label>
                                                            <div class="col-sm-2">
                                                            <?php $datenow = date("Y-m-d"); ?>
                                                                <input type="text" id="datepicker" class="form-control uri_date" required="" value="{{$Chemistry->date_reg}}" disabled="">
                                                            </div>
                                                        </div> -->

                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Chemistry->blood_sugar == 'Yes')
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="blood_sugar" name="blood_sugar" checked="" value="Yes"> <b>BLOOD SUGAR</b></label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="blood_sugar" name="blood_sugar" value="Yes"> <b>BLOOD SUGAR</b></label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label"><b>Result</b></label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label"><b>Normal Value</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Chemistry->fasting == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="fasting" name="fasting" checked="" value="Yes"> Fasting</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="fasting" name="fasting" value="Yes"> Fasting</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="fasting_result" class="form-control fasting_result" value="{{$Chemistry->fasting_result}}" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">75 - 115 mg / dl</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Chemistry->hours_ppbs == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="ppbs" name="ppbs" checked="" value="Yes"> 2-hrs PPBS</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="ppbs" name="ppbs" value="Yes"> 2-hrs PPBS</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="ppbs_result" class="form-control ppbs_result" value="{{$Chemistry->ppbs_result}}" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">70 - 150 mg / dl</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Chemistry->random == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="random" name="random" checked="" value="Yes"> Random</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="random" name="random" value="Yes"> Random</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="random_result" class="form-control random_result" value="{{$Chemistry->random_result}}" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;font-size: 9pt;">
                                                                    <label class="control-label">< 60 yO 45 - 130mg/dl<br> > 60yO 70 - 160mg/dl</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Chemistry->hbaic == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="hbaic" name="hbaic" checked="" value="Yes"> HbAIC</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="hbaic" name="hbaic" value="Yes"> HbAIC</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="hbaic_result" class="form-control hbaic_result" value="{{$Chemistry->hbaic_result}}" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">4.5 -6.3 %</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Chemistry->kidney_function == 'Yes')
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="kidney_function" name="kidney_function" checked="" value="Yes"> <b>KIDNEY FUNCTION</b></label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="kidney_function" name="kidney_function" value="Yes"> <b>KIDNEY FUNCTION</b></label>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Chemistry->creatinine == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="creatinine" name="creatinine" checked="" value="Yes"> Creatinine</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="creatinine" name="creatinine" value="Yes"> Creatinine</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="creatinine_result" class="form-control creatinine_result" value="{{$Chemistry->creatinine_result}}" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;font-size: 9pt;">
                                                                    <label class="control-label">M09 - 13mg/dl <br> F06 - 11mg/dl</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Chemistry->bun == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="bun" name="bun" checked="" value="Yes"> BUN</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="bun" name="bun" value="Yes"> BUN</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="bun_result" class="form-control bun_result" value="{{$Chemistry->bun_result}}" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">10 - 50mg/dl</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Chemistry->uric_acid == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="uricacid" name="uricacid" checked="" value="Yes"> Uric Acid</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="uricacid" name="uricacid" value="Yes"> Uric Acid</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="uricacid_result" class="form-control uricacid_result" value="{{$Chemistry->uric_acid_result}}" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">F24 - 57mg/dl</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Chemistry->liver_function == 'Yes')
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="liver_function" name="liver_function" checked="" value="Yes"> <b>LIVER FUNCTION</b></label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="liver_function" name="liver_function" value="Yes"> <b>LIVER FUNCTION</b></label>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Chemistry->sgpt == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="sgpt" name="sgpt" checked="" value="Yes"> SGPT</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="sgpt" name="sgpt" value="Yes"> SGPT</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="sgpt_result" class="form-control sgpt_result" value="{{$Chemistry->sgpt_result}}" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;font-size: 9pt;">
                                                                    <label class="control-label">M 0 - 42 U/L<br>F 0 - 32 U/L</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Chemistry->sgot == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="sgot" name="sgot" checked="" value="Yes"> SGOT</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="sgot" name="sgot" value="Yes"> SGOT</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="sgot_result" class="form-control sgot_result" value="{{$Chemistry->sgot_result}}" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;font-size: 9pt;">
                                                                    <label class="control-label">M 0 - 37 U/L<br>F 0 - 31 U/L</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Chemistry->alk_phos == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="alk_phos" name="alk_phos" checked="" value="Yes"> Alk. Phos.</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="alk_phos" name="alk_phos" value="Yes"> Alk. Phos.</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="alk_phos_result" class="form-control alk_phos_result" value="{{$Chemistry->alk_phos_result}}" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;font-size: 9pt;">
                                                                    <label class="control-label">M 80 - 306 U/L<br>F 64 - 306 U/L</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Chemistry->lipid_profile == 'Yes')
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="lipid_profile" name="lipid_profile" checked="" value="Yes"> <b>LIPID PROFILE</b></label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="lipid_profile" name="lipid_profile" value="Yes"> <b>LIPID PROFILE</b></label>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Chemistry->hdl_cholesterol == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="hdl_cholesterol" name="hdl_cholesterol" checked="" value="Yes"> HDL-Cholesterol</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="hdl_cholesterol" name="hdl_cholesterol" value="Yes"> HDL-Cholesterol</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="hdl_cholesterol_result" class="form-control hdl_cholesterol_result" value="{{$Chemistry->hdl_cholesterol_result}}" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;font-size: 9pt;">
                                                                    <label class="control-label">M  > 55 mg/dl<br>F > 65 mg/dl</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Chemistry->triglycerides == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="triglycerides" name="triglycerides" checked="" value="Yes"> Triglycerides</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="triglycerides" name="triglycerides" value="Yes"> Triglycerides</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="triglycerides_result" class="form-control triglycerides_result" value="{{$Chemistry->triglycerides_result}}" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">40 - 190 mg/dl</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Chemistry->total_cholesterol == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="total_cholesterol" name="total_cholesterol" checked="" value="Yes"> Total Cholesterol</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="total_cholesterol" name="total_cholesterol" value="Yes"> Total Cholesterol</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="total_cholesterol_result" class="form-control total_cholesterol_result" value="{{$Chemistry->total_cholesterol_result}}" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">< 220 mg/dl</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Chemistry->ldl_cholesterol == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="ldl_cholesterol" name="ldl_cholesterol" checked="" value="Yes"> LDL - Cholesterol</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="ldl_cholesterol" name="ldl_cholesterol" checked="" value="Yes"> LDL - Cholesterol</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="ldl_cholesterol_result" class="form-control ldl_cholesterol_result" value="{{$Chemistry->ldl_cholesterol_result}}" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">< 150 mg/dl</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Chemistry->tc_hdl_ratio == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="tc_hdl_ratio" name="tc_hdl_ratio" checked="" value="Yes"> TC/HDL Ratio</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="tc_hdl_ratio" name="tc_hdl_ratio" value="Yes"> TC/HDL Ratio</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="tc_hdl_ratio_result" class="form-control tc_hdl_ratio_result" value="{{$Chemistry->tc_hdl_ratio_result}}" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">< 4.5 mg/dl</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Chemistry->electrolytes == 'Yes')
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="electrolytes" name="electrolytes" checked="" value="Yes"> <b>ELECTROLYTES</b></label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="electrolytes" name="electrolytes" value="Yes"> <b>ELECTROLYTES</b></label>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Chemistry->sodium == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="sodium" name="sodium" checked="" value="Yes"> Sodium</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="sodium" name="sodium" value="Yes"> Sodium</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="sodium_result" class="form-control sodium_result" value="{{$Chemistry->sodium_result}}" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;font-size: 9pt;">
                                                                    <label class="control-label">F 135 - 155 mmol/L<br>M 135 - 148 mmol/L</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Chemistry->potassium == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="potassium" name="potassium" checked="" value="Yes"> Potassium</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="potassium" name="potassium" value="Yes"> Potassium</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="potassium_result" class="form-control potassium_result" value="{{$Chemistry->potassium_result}}" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">3.5 - 5.3 mmol/L</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Chemistry->calcium == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="calcium" name="calcium" checked="" value="Yes"> Calcium</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="calcium" name="calcium" value="Yes"> Calcium</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="calcium_result" class="form-control calcium_result" value="{{$Chemistry->calcium_result}}" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">8.6 - 10.3 mg/dl</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: left;"><b>OTHERS</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-12">
                                                                    <textarea class="form-control chem_others" name="chem_others" rows="2">{{$Chemistry->chem_other}}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: left;"><b>REMARKS</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-12">
                                                                    <textarea class="form-control chem_remarks" name="chem_remarks" rows="2">{{$Chemistry->remark}}</textarea>
                                                                </div>
                                                            </div>
                                                        </div><br><br>

                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    ________________________________________<br>
                                                                    <b>ROGELIO S. McNTIRE, M.D.,FPSP</b><br>
                                                                    <i style="font-size: 9pt;">Pathologist</i>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    ________________________________________, RMT
                                                                </div>
                                                            </div>
                                                        </div><br>

                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label"></label>
                                                            <div class="col-sm-3">
                                                                <button class="btn btn-xs btn-primary" id="btn-submit-social_history" type="submit">Save Changes</button>
                                                            </div>
                                                        </div>
                                            </form>
                                        @endif
                                        </div>
                                </div>
                                </div>
                                <!-- done OK-->
                                <div role="tabpanel" class="tab-pane fade" id="OGTT">
                                <div class="col-md-12">
                                    <div class="flash-message top-message topmessage7"></div><br>
                                    @if($Ogtt)
                                    <a href="/visit/{{$id}}/{{$vid}}/ogttdone" class="btn btn-xs btn-primary">Done Service</a>
                                    <a href="/visit/{{$id}}/{{$vid}}/ogttdone/pdf" target="_blank" class="btn btn-xs btn-success">Print</a>
                                    @endif
                                        <div class="col-md-12">
                                            <center><h3 class="neg">NEGROS FAMILY HEALTH SERVICES INC.</h3></center>
                                            <center><p class="nor">North Road, Daro(in front of NOPH) Dumaguete City, Negros Oriental</p></center>
                                            <center><p class="nor">Tel. No. (035) 225-3544</p></center>
                                            <h4><b>ORAL GLUCOSE TOLERANCE TEST</b></h4>
                                        @if(!$Ogtt)
                                            <form class="form-horizontal" method="POST" action="/visit/{{$id}}/{{$vid}}/ogtt">
                                                    {!! csrf_field() !!}
                                                    <input type="text" name="uri_id" value="" class="uri_id" style="display: none;">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Name:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="P_id" value="{{$id}}" style="display: none;">
                                                                <input type="text" name="P_name" required="" class="form-control" placeholder="Name" value="{{$patient->f_name}} {{$patient->m_name}} {{$patient->l_name}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">O.R. No.</label>
                                                            <div class="col-sm-2">
                                                                <input type="text" name="orno" class="form-control uri_orno" placeholder="O.R. No." readonly="" value="{{$receipt_number}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Address:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="address" required="" class="form-control" placeholder="Address" value="{{$patient->address}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">Sex:</label>
                                                            <div class="col-sm-2">
                                                                <select id="agesex" name="agesex" class="form-control" required="" disabled=""> 
                                                                    <option value="{{$patient->gender}}" selected="">{{$patient->gender}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Physician:</label>
                                                            <div class="col-sm-6">
                                                                <select id="physician" name="physician" class="form-control uri_physician" required="">
                                                                    <option value="">-- Select One --</option>
                                                                    @foreach($doctor as $doc)
                                                                    @if(Session::get('position') == "Doctor")
                                                                        @if(Session::get('user') == $doc->id)
                                                                        <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}" selected="">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @endif
                                                                    @else
                                                                        @if($doc->user->position == "Doctor")
                                                                        <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @endif
                                                                    @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-2 control-label">Date:</label>
                                                            <div class="col-sm-2">
                                                            <?php $datenow = date("Y-m-d"); ?>
                                                                <input type="text" id="datepicker" class="form-control uri_date" required="" value="{{$datenow}}" disabled="">
                                                            </div>
                                                        </div> -->

                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: left;"></label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label"><b>Result</b></label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label"><b>Normal Value</b></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: left;"><input type="checkbox" class="50_grams" name="50_grams" checked="" value="Yes"> <b>50 GRAMS</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="firsthour" name="firsthour" checked="" value="Yes"> 1st Hour</label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="firsthour_result" class="form-control firsthour_result" value="" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">90 - 165 mg / dl</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: left;"><input type="checkbox" class="75_grams" name="75_grams" checked="" value="Yes"> <b>75 GRAMS</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="fasting_oggt" name="fasting_oggt" checked="" value="Yes"> Fasting</label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="fasting_oggt_result" class="form-control fasting_oggt_result" value="" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">< 95 mg / dl</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="firshour_oggt" name="firshour_oggt" checked="" value="Yes"> 1st Hour</label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="firshour_oggt_result" class="form-control firshour_oggt_result" value="" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">< 180 mg / dl</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="secondhour_oggt" name="secondhour_oggt" checked="" value="Yes"> 2nd Hour</label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="secondhour_oggt_result" class="form-control secondhour_oggt_result" value="" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">< 155 mg / dl</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: left;"><input type="checkbox" class="100_grams" name="100_grams" checked="" value="Yes"> <b>100 GRAMS</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="fasting_oggt_grams" name="fasting_oggt_grams" checked="" value="Yes"> Fasting</label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="fasting_oggt_grams_result" class="form-control fasting_oggt_grams_result" value="" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">< 95 mg / dl</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="firshour_oggt_grams" name="firshour_oggt_grams" checked="" value="Yes"> 1st Hour</label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="firshour_oggt_grams_result" class="form-control firshour_oggt_grams_result" value="" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">< 180 mg / dl</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="secondhour_oggt_grams" name="secondhour_oggt_grams" checked="" value="Yes"> 2nd Hour</label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="secondhour_oggt_grams_result" class="form-control secondhour_oggt_grams_result" value="" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">< 155 mg / dl</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="thirdhour_oggt_grams" name="thirdhour_oggt_grams" checked="" value="Yes"> 3rd Hour</label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="thirdhour_oggt_grams_result" class="form-control thirdhour_oggt_grams_result" value="" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">< 155 mg / dl</label>
                                                                </div>
                                                            </div>
                                                        </div><br><br>

                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    ________________________________________<br>
                                                                    <b>ROGELIO S. McNTIRE, M.D.,FPSP</b><br>
                                                                    <i style="font-size: 9pt;">Pathologist</i>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    ________________________________________, RMT
                                                                </div>
                                                            </div>
                                                        </div><br>

                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label"></label>
                                                            <div class="col-sm-3">
                                                                <button class="btn btn-xs btn-primary" id="btn-submit-social_history" type="submit">Submit</button>
                                                            </div>
                                                        </div>
                                            </form>
                                        @else
                                            <form class="form-horizontal" method="POST" action="/visit/{{$id}}/{{$vid}}/ogtt">
                                                    {!! csrf_field() !!}
                                                    <input type="text" name="uri_id" value="{{$Ogtt->id}}" class="uri_id" style="display: none;">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Name:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="P_id" value="{{$id}}" style="display: none;">
                                                                <input type="text" name="P_name" required="" class="form-control" placeholder="Name" value="{{$patient->f_name}} {{$patient->m_name}} {{$patient->l_name}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">O.R. No.</label>
                                                            <div class="col-sm-2">
                                                                <input type="text" name="orno" class="form-control uri_orno" placeholder="O.R. No." value="{{$receipt_number}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Address:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="address" required="" class="form-control" placeholder="Address" value="{{$patient->address}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">Sex:</label>
                                                            <div class="col-sm-2">
                                                                <select id="agesex" name="agesex" class="form-control" required="" disabled=""> 
                                                                    <option value="{{$patient->gender}}" selected="">{{$patient->gender}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Physician:</label>
                                                            <div class="col-sm-6">
                                                                <select id="physician" name="physician" class="form-control uri_physician" required="">
                                                                    <option value="">-- Select One --</option>
                                                                    @foreach($doctor as $doc)
                                                                        @if($Ogtt->doc_id == $doc->id)
                                                                        <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}" selected="">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @else
                                                                        <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-2 control-label">Date:</label>
                                                            <div class="col-sm-2">
                                                            <?php $datenow = date("Y-m-d"); ?>
                                                                <input type="text" id="datepicker" class="form-control uri_date" required="" value="{{$Ogtt->date_reg}}" disabled="">
                                                            </div>
                                                        </div> -->

                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: left;"></label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label"><b>Result</b></label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label"><b>Normal Value</b></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Ogtt->fifty_gram == 'Yes')
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="50_grams" name="50_grams" checked="" value="Yes"> <b>50 GRAMS</b></label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="50_grams" name="50_grams" value="Yes"> <b>50 GRAMS</b></label>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Ogtt->first_hour == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="firsthour" name="firsthour" checked="" value="Yes"> 1st Hour</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="firsthour" name="firsthour" value="Yes"> 1st Hour</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="firsthour_result" class="form-control firsthour_result" value="{{$Ogtt->first_hour_result}}" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">90 - 165 mg / dl</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Ogtt->seventy_five_gram == 'Yes')
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="75_grams" name="75_grams" checked="" value="Yes"> <b>75 GRAMS</b></label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="75_grams" name="75_grams" value="Yes"> <b>75 GRAMS</b></label>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Ogtt->fasting == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="fasting_oggt" name="fasting_oggt" checked="" value="Yes"> Fasting</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="fasting_oggt" name="fasting_oggt" value="Yes"> Fasting</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="fasting_oggt_result" class="form-control fasting_oggt_result" value="{{$Ogtt->fasting_result}}" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">< 95 mg / dl</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Ogtt->sv_first_hour == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="firshour_oggt" name="firshour_oggt" checked="" value="Yes"> 1st Hour</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="firshour_oggt" name="firshour_oggt" value="Yes"> 1st Hour</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="firshour_oggt_result" class="form-control firshour_oggt_result" value="{{$Ogtt->sv_first_hour_result}}" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">< 180 mg / dl</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Ogtt->sv_second_hour == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="secondhour_oggt" name="secondhour_oggt" checked="" value="Yes"> 2nd Hour</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="secondhour_oggt" name="secondhour_oggt" value="Yes"> 2nd Hour</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="secondhour_oggt_result" class="form-control secondhour_oggt_result" value="{{$Ogtt->sv_second_hour_result}}" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">< 155 mg / dl</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Ogtt->one_hundred_gram == 'Yes')
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="100_grams" name="100_grams" checked="" value="Yes"> <b>100 GRAMS</b></label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="100_grams" name="100_grams" value="Yes"> <b>100 GRAMS</b></label>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Ogtt->oh_fasting == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="fasting_oggt_grams" name="fasting_oggt_grams" checked="" value="Yes"> Fasting</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="fasting_oggt_grams" name="fasting_oggt_grams" value="Yes"> Fasting</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="fasting_oggt_grams_result" class="form-control fasting_oggt_grams_result" value="{{$Ogtt->oh_fasting_result}}" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">< 95 mg / dl</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Ogtt->oh_first_hour == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="firshour_oggt_grams" name="firshour_oggt_grams" checked="" value="Yes"> 1st Hour</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="firshour_oggt_grams" name="firshour_oggt_grams" value="Yes"> 1st Hour</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="firshour_oggt_grams_result" class="form-control firshour_oggt_grams_result" value="{{$Ogtt->oh_first_hour_result}}" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">< 180 mg / dl</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Ogtt->oh_second_hour == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="secondhour_oggt_grams" name="secondhour_oggt_grams" checked="" value="Yes"> 2nd Hour</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="secondhour_oggt_grams" name="secondhour_oggt_grams" value="Yes"> 2nd Hour</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="secondhour_oggt_grams_result" class="form-control secondhour_oggt_grams_result" value="{{$Ogtt->oh_second_hour_result}}" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">< 155 mg / dl</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Ogtt->oh_third_hour == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="thirdhour_oggt_grams" name="thirdhour_oggt_grams" checked="" value="Yes"> 3rd Hour</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="thirdhour_oggt_grams" name="thirdhour_oggt_grams" value="Yes"> 3rd Hour</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">
                                                                        <input type="text" name="thirdhour_oggt_grams_result" class="form-control thirdhour_oggt_grams_result" value="{{$Ogtt->oh_third_hour_result}}" autocomplete="off">
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-3" style="text-align: center;">
                                                                    <label class="control-label">< 155 mg / dl</label>
                                                                </div>
                                                            </div>
                                                        </div><br><br>

                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    ________________________________________<br>
                                                                    <b>ROGELIO S. McNTIRE, M.D.,FPSP</b><br>
                                                                    <i style="font-size: 9pt;">Pathologist</i>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    ________________________________________, RMT
                                                                </div>
                                                            </div>
                                                        </div><br>

                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label"></label>
                                                            <div class="col-sm-3">
                                                                <button class="btn btn-xs btn-primary" id="btn-submit-social_history" type="submit">Save Changes</button>
                                                            </div>
                                                        </div>
                                            </form>
                                        @endif
                                        </div>
                                </div>
                                </div>
                                <!-- done OK-->
                                <div role="tabpanel" class="tab-pane fade" id="Hematology">
                                <div class="col-md-12">
                                    <div class="flash-message top-message topmessage7"></div><br>
                                    @if($Hematology)
                                    <a href="/visit/{{$id}}/{{$vid}}/hematologydone" class="btn btn-xs btn-primary">Done Service</a>
                                    <a href="/visit/{{$id}}/{{$vid}}/hematologydone/pdf" target="_blank" class="btn btn-xs btn-success">Print</a>
                                    @endif
                                        <div class="col-md-12">
                                            <center><h3 class="neg">NEGROS FAMILY HEALTH SERVICES INC.</h3></center>
                                            <center><p class="nor">North Road, Daro(in front of NOPH) Dumaguete City, Negros Oriental</p></center>
                                            <center><p class="nor">Tel. No. (035) 225-3544</p></center>
                                            <h4><b>HEMATOLOGY</b></h4>
                                        @if(!$Hematology)
                                            <form class="form-horizontal" method="POST" action="/visit/{{$id}}/{{$vid}}/hematology">
                                                    {!! csrf_field() !!}
                                                    <input type="text" name="uri_id" value="" class="uri_id" style="display: none;">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Name:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="P_id" value="{{$id}}" style="display: none;">
                                                                <input type="text" name="P_name" required="" class="form-control" placeholder="Name" value="{{$patient->f_name}} {{$patient->m_name}} {{$patient->l_name}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">O.R. No.</label>
                                                            <div class="col-sm-2">
                                                                <input type="text" name="orno" class="form-control uri_orno" placeholder="O.R. No." readonly="" value="{{$receipt_number}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Address:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="address" required="" class="form-control" placeholder="Address" value="{{$patient->address}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">Sex:</label>
                                                            <div class="col-sm-2">
                                                                <select id="agesex" name="agesex" class="form-control" required="" disabled=""> 
                                                                    <option value="{{$patient->gender}}" selected="">{{$patient->gender}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Physician:</label>
                                                            <div class="col-sm-6">
                                                                <select id="physician" name="physician" class="form-control uri_physician" required="">
                                                                    <option value="">-- Select One --</option>
                                                                    @foreach($doctor as $doc)
                                                                    @if(Session::get('position') == "Doctor")
                                                                        @if(Session::get('user') == $doc->id)
                                                                        <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}" selected="">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @endif
                                                                    @else
                                                                        @if($doc->user->position == "Doctor")
                                                                        <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @endif
                                                                    @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-2 control-label">Date:</label>
                                                            <div class="col-sm-2">
                                                            <?php $datenow = date("Y-m-d"); ?>
                                                                <input type="text" id="datepicker" class="form-control uri_date" required="" value="{{$datenow}}" disabled="">
                                                            </div>
                                                        </div> -->

                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: left;"><input type="checkbox" class="cbc" name="cbc" checked="" value="Yes"> <b>CBC</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-2">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="hematocrit" name="hematocrit" checked="" value="Yes"> Hematocrit</label>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <label class="control-label">
                                                                        <input type="text" name="hematocrit_desc" class="form-control hematocrit_desc" value="" autocomplete="off"> 
                                                                    </label> %
                                                                </div>
                                                                <div class="col-sm-1" style="font-size: 8pt;">
                                                                    F42 ± 5<br>M47 ± 7
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="clotting_lw" name="clotting_lw" checked="" value="Yes"> Clotting(Lee & White)</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    Time :
                                                                    <label class="control-label">
                                                                        <input type="text" name="clotting_lw_desc" class="form-control clotting_lw_desc" value="" autocomplete="off"> 
                                                                    </label>
                                                                    N:6-17 min.
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-2">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="hemoglobin" name="hemoglobin" checked="" value="Yes"> Hemoglobin</label>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <label class="control-label">
                                                                        <input type="text" name="hemoglobin_desc" class="form-control hemoglobin_desc" value="" autocomplete="off"> 
                                                                    </label> %
                                                                </div>
                                                                <div class="col-sm-1" style="font-size: 8pt;">
                                                                    F14 ± 2
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="clotting" name="clotting" checked="" value="Yes"> Clotting</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    Time :
                                                                    <label class="control-label">
                                                                        <input type="text" name="clotting_desc" class="form-control clotting_desc" value="" autocomplete="off"> 
                                                                    </label>
                                                                    N:3-5 min.
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-2">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="wbc" name="wbc" checked="" value="Yes"> WBC</label>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <label class="control-label">
                                                                        <input type="text" name="wbc_desc" class="form-control wbc_desc" value="" autocomplete="off"> 
                                                                    </label> T/mm
                                                                </div>
                                                                <div class="col-sm-1" style="font-size: 8pt;">
                                                                    3A5 10<br>CH6 13
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="bleeding" name="bleeding" checked="" value="Yes"> Bleeding(Duke Method)</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    Time :
                                                                    <label class="control-label">
                                                                        <input type="text" name="bleeding_desc" class="form-control bleeding_desc" value="" autocomplete="off"> 
                                                                    </label>
                                                                    N:1-3 min.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: left;"><b>Differential Count %</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: center;font-size: 9pt;">BAND<br>0 - 10</label>
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: center;font-size: 9pt;">PMN<br>53 - 70</label>
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: center;font-size: 9pt;">BASO<br>0 - 1</label>
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: center;font-size: 9pt;">EOS<br>1 - 4</label>
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: center;font-size: 9pt;">MONO<br>1 - 6</label>
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: center;font-size: 9pt;">LYMPHS<br>20 - 36</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <input type="text" name="band" class="band form-control">
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <input type="text" name="pmn" class="pmn form-control">
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <input type="text" name="baso" class="baso form-control">
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <input type="text" name="eos" class="eos form-control">
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <input type="text" name="mono" class="mono form-control">
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <input type="text" name="lymphs" class="lymphs form-control">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="clot" name="clot" checked="" value="Yes"> Clot</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    Retraction :
                                                                    <label class="control-label">
                                                                        <input type="text" name="clot_desc" class="form-control clot_desc" value="" autocomplete="off"> 
                                                                    </label>
                                                                    N:48-64%
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="platelet" name="platelet" checked="" value="Yes"> Platelet</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    Count :
                                                                    <label class="control-label">
                                                                        <input type="text" name="platelet_desc" class="form-control platelet_desc" value="" autocomplete="off"> 
                                                                    </label>
                                                                    N:150-400 T/mm*
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="esr" name="esr" checked="" value="Yes"> ESR (WESTERNGREEN)</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <label class="control-label">
                                                                        <input type="text" name="esr_desc" class="form-control esr_desc" value="" autocomplete="off"> 
                                                                    </label>
                                                                    mm/HR.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: left;"><input type="checkbox" class="protime" name="protime" checked="" value="Yes"> <b>PRO TIME</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-1" style="text-align: right;">
                                                                    <label class="control-label">Control</label>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <label class="control-label">
                                                                        <input type="text" name="control_desc" class="form-control control_desc" value="" autocomplete="off"> 
                                                                    </label> sec.
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="grp" name="grp" checked="" value="Yes"> GRP</label>
                                                                    <label class="control-label">
                                                                        <input type="text" name="grp_desc" class="form-control grp_desc" value="" autocomplete="off" > 
                                                                    </label>
                                                                    <label class="control-label" style="text-align: right;"> Rh</label>
                                                                    <label class="control-label">
                                                                        <input type="text" name="rh_desc" class="form-control rh_desc" value="" autocomplete="off" style="width: 50%;"> 
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-1" style="text-align: right;">
                                                                    <label class="control-label">Patient</label>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <label class="control-label">
                                                                        <input type="text" name="patient_desc" class="form-control patient_desc" value="" autocomplete="off"> 
                                                                    </label> sec.
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="smp" name="smp" checked="" value="Yes"> SMP</label>
                                                                    <label class="control-label">
                                                                        <input type="text" name="smp_desc" class="form-control smp_desc" value="" autocomplete="off" > 
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-1" style="text-align: right;">
                                                                    <label class="control-label">%A</label>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <label class="control-label">
                                                                        <input type="text" name="a_desc" class="form-control a_desc" value="" autocomplete="off"> 
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-1" style="text-align: right;">
                                                                    <label class="control-label">INR.</label>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <label class="control-label">
                                                                        <input type="text" name="inr_desc" class="form-control inr_desc" value="" autocomplete="off"> 
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: left;"><input type="checkbox" class="cellindices" name="cellindices" checked="" value="Yes"> <b>CELL INDICES</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-1" style="text-align: right;">
                                                                    <label class="control-label">MCV</label>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <label class="control-label">
                                                                        <input type="text" name="mcv_desc" class="form-control mcv_desc" value="" autocomplete="off"> 
                                                                    </label> 80 - 90
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="retic" name="retic" checked="" value="Yes"> RETIC</label>
                                                                    <label class="control-label">
                                                                        <input type="text" name="retic_desc" class="form-control retic_desc" value="" autocomplete="off">
                                                                    </label> %0.5 - 1.5
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-1" style="text-align: right;">
                                                                    <label class="control-label">INDICES MCH</label>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <label class="control-label">
                                                                        <input type="text" name="indices_mch_desc" class="form-control indices_mch_desc" value="" autocomplete="off"> 
                                                                    </label> 21 - 31 pg
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="rbc" name="rbc" checked="" value="Yes"> RBC&nbsp;&nbsp;&nbsp;</label>
                                                                    <label class="control-label">
                                                                        <input type="text" name="rbc_desc" class="form-control rbc_desc" value="" autocomplete="off">
                                                                    </label> MIL/mm4<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;F 4 - 5.5 &nbsp;&nbsp;&nbsp;&nbsp;M 4.5 - 6.0
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-1" style="text-align: right;">
                                                                    <label class="control-label">MCHC</label>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <label class="control-label">
                                                                        <input type="text" name="mchc_desc" class="form-control mchc_desc" value="" autocomplete="off"> 
                                                                    </label> 33 - 38 %
                                                                </div>
                                                            </div>
                                                        </div><br><br>

                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    ________________________________________<br>
                                                                    <b>ROGELIO S. McNTIRE, M.D.,FPSP</b><br>
                                                                    <i style="font-size: 9pt;">Pathologist</i>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    ________________________________________, RMT
                                                                </div>
                                                            </div>
                                                        </div><br>

                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label"></label>
                                                            <div class="col-sm-3">
                                                                <button class="btn btn-xs btn-primary" id="btn-submit-social_history" type="submit">Submit</button>
                                                            </div>
                                                        </div>
                                            </form>
                                        @else
                                            <form class="form-horizontal" method="POST" action="/visit/{{$id}}/{{$vid}}/hematology">
                                                    {!! csrf_field() !!}
                                                    <input type="text" name="uri_id" value="{{$Hematology->id}}" class="uri_id" style="display: none;">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Name:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="P_id" value="{{$id}}" style="display: none;">
                                                                <input type="text" name="P_name" required="" class="form-control" placeholder="Name" value="{{$patient->f_name}} {{$patient->m_name}} {{$patient->l_name}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">O.R. No.</label>
                                                            <div class="col-sm-2">
                                                                <input type="text" name="orno" class="form-control uri_orno" placeholder="O.R. No." value="{{$receipt_number}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Address:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="address" required="" class="form-control" placeholder="Address" value="{{$patient->address}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">Sex:</label>
                                                            <div class="col-sm-2">
                                                                <select id="agesex" name="agesex" class="form-control" required="" disabled=""> 
                                                                    <option value="{{$patient->gender}}" selected="">{{$patient->gender}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Physician:</label>
                                                            <div class="col-sm-6">
                                                                <select id="physician" name="physician" class="form-control uri_physician" required="">
                                                                    <option value="">-- Select One --</option>
                                                                    @foreach($doctor as $doc)
                                                                        @if($Hematology->doc_id == $doc->id)
                                                                        <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}" selected="">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @else
                                                                        <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-2 control-label">Date:</label>
                                                            <div class="col-sm-2">
                                                            <?php $datenow = date("Y-m-d"); ?>
                                                                <input type="text" id="datepicker" class="form-control uri_date" required="" value="{{$Hematology->date_reg}}" disabled="">
                                                            </div>
                                                        </div> -->

                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Hematology->cbc == 'Yes')
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="cbc" name="cbc" checked="" value="Yes"> <b>CBC</b></label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="cbc" name="cbc" value="Yes"> <b>CBC</b></label>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-2">
                                                                    @if($Hematology->hematocrit == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="hematocrit" name="hematocrit" checked="" value="Yes"> Hematocrit</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="hematocrit" name="hematocrit" value="Yes"> Hematocrit</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <label class="control-label">
                                                                        <input type="text" name="hematocrit_desc" class="form-control hematocrit_desc" value="{{$Hematology->hematocrit_desc}}" autocomplete="off"> 
                                                                    </label> %
                                                                </div>
                                                                <div class="col-sm-1" style="font-size: 8pt;">
                                                                    F42 ± 5<br>M47 ± 7
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    @if($Hematology->clottinglw == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="clotting_lw" name="clotting_lw" checked="" value="Yes"> Clotting(Lee & White)</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="clotting_lw" name="clotting_lw" value="Yes"> Clotting(Lee & White)</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    @endif
                                                                    Time :
                                                                    <label class="control-label">
                                                                        <input type="text" name="clotting_lw_desc" class="form-control clotting_lw_desc" value="{{$Hematology->clottinglw_time}}" autocomplete="off"> 
                                                                    </label>
                                                                    N:6-17 min.
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-2">
                                                                    @if($Hematology->hemoglobin == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="hemoglobin" name="hemoglobin" checked="" value="Yes"> Hemoglobin</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="hemoglobin" name="hemoglobin" value="Yes"> Hemoglobin</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <label class="control-label">
                                                                        <input type="text" name="hemoglobin_desc" class="form-control hemoglobin_desc" value="{{$Hematology->hemoglobin_desc}}" autocomplete="off"> 
                                                                    </label> %
                                                                </div>
                                                                <div class="col-sm-1" style="font-size: 8pt;">
                                                                    F14 ± 2
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    @if($Hematology->clotting == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="clotting" name="clotting" checked="" value="Yes"> Clotting</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="clotting" name="clotting" value="Yes"> Clotting</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    @endif
                                                                    Time :
                                                                    <label class="control-label">
                                                                        <input type="text" name="clotting_desc" class="form-control clotting_desc" value="{{$Hematology->clotting_time}}" autocomplete="off"> 
                                                                    </label>
                                                                    N:3-5 min.
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-2">
                                                                    @if($Hematology->wbc == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="wbc" name="wbc" checked="" value="Yes"> WBC</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="wbc" name="wbc" value="Yes"> WBC</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <label class="control-label">
                                                                        <input type="text" name="wbc_desc" class="form-control wbc_desc" value="{{$Hematology->wbc_desc}}" autocomplete="off"> 
                                                                    </label> T/mm
                                                                </div>
                                                                <div class="col-sm-1" style="font-size: 8pt;">
                                                                    3A5 10<br>CH6 13
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    @if($Hematology->bleedingdm == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="bleeding" name="bleeding" checked="" value="Yes"> Bleeding(Duke Method)</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="bleeding" name="bleeding" value="Yes"> Bleeding(Duke Method)</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    @endif
                                                                    Time :
                                                                    <label class="control-label">
                                                                        <input type="text" name="bleeding_desc" class="form-control bleeding_desc" value="{{$Hematology->bleedingdm_time}}" autocomplete="off"> 
                                                                    </label>
                                                                    N:1-3 min.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: left;"><b>Differential Count %</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: center;font-size: 9pt;">BAND<br>0 - 10</label>
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: center;font-size: 9pt;">PMN<br>53 - 70</label>
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: center;font-size: 9pt;">BASO<br>0 - 1</label>
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: center;font-size: 9pt;">EOS<br>1 - 4</label>
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: center;font-size: 9pt;">MONO<br>1 - 6</label>
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: center;font-size: 9pt;">LYMPHS<br>20 - 36</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <input type="text" name="band" class="band form-control" value="{{$Hematology->dc_band}}">
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <input type="text" name="pmn" class="pmn form-control" value="{{$Hematology->dc_pmn}}">
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <input type="text" name="baso" class="baso form-control" value="{{$Hematology->dc_baso}}">
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <input type="text" name="eos" class="eos form-control" value="{{$Hematology->dc_eos}}">
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <input type="text" name="mono" class="mono form-control" value="{{$Hematology->dc_mono}}">
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <input type="text" name="lymphs" class="lymphs form-control" value="{{$Hematology->dc_lymph}}">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    @if($Hematology->clot == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="clot" name="clot" checked="" value="Yes"> Clot</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="clot" name="clot" value="Yes"> Clot</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    @endif
                                                                    Retraction :
                                                                    <label class="control-label">
                                                                        <input type="text" name="clot_desc" class="form-control clot_desc" value="{{$Hematology->clot_retraction}}" autocomplete="off"> 
                                                                    </label>
                                                                    N:48-64%
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    @if($Hematology->platelet == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="platelet" name="platelet" checked="" value="Yes"> Platelet</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="platelet" name="platelet" value="Yes"> Platelet</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    @endif
                                                                    Count :
                                                                    <label class="control-label">
                                                                        <input type="text" name="platelet_desc" class="form-control platelet_desc" value="{{$Hematology->platelet_count}}" autocomplete="off"> 
                                                                    </label>
                                                                    N:150-400 T/mm*
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    @if($Hematology->esr == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="esr" name="esr" checked="" value="Yes"> ESR (WESTERNGREEN)</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="esr" name="esr" value="Yes"> ESR (WESTERNGREEN)</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    @endif
                                                                    <label class="control-label">
                                                                        <input type="text" name="esr_desc" class="form-control esr_desc" value="{{$Hematology->esr_desc}}" autocomplete="off"> 
                                                                    </label>
                                                                    mm/HR.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Hematology->protime == 'Yes')
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="protime" name="protime" checked="" value="Yes"> <b>PRO TIME</b></label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="protime" name="protime" value="Yes"> <b>PRO TIME</b></label>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-1" style="text-align: right;">
                                                                    <label class="control-label">Control</label>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <label class="control-label">
                                                                        <input type="text" name="control_desc" class="form-control control_desc" value="{{$Hematology->control_desc}}" autocomplete="off"> 
                                                                    </label> sec.
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    @if($Hematology->grp == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="grp" name="grp" checked="" value="Yes"> GRP</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="grp" name="grp" value="Yes"> GRP</label>
                                                                    @endif
                                                                    <label class="control-label">
                                                                        <input type="text" name="grp_desc" class="form-control grp_desc" value="{{$Hematology->grp_desc}}" autocomplete="off" > 
                                                                    </label>
                                                                    <label class="control-label" style="text-align: right;"> Rh</label>
                                                                    <label class="control-label">
                                                                        <input type="text" name="rh_desc" class="form-control rh_desc" value="{{$Hematology->rh_desc}}" autocomplete="off" style="width: 50%;"> 
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-1" style="text-align: right;">
                                                                    <label class="control-label">Patient</label>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <label class="control-label">
                                                                        <input type="text" name="patient_desc" class="form-control patient_desc" value="{{$Hematology->patient_desc}}" autocomplete="off"> 
                                                                    </label> sec.
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    @if($Hematology->smp == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="smp" name="smp" checked="" value="Yes"> SMP</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="smp" name="smp" value="Yes"> SMP</label>
                                                                    @endif
                                                                    <label class="control-label">
                                                                        <input type="text" name="smp_desc" class="form-control smp_desc" value="{{$Hematology->smp_desc}}" autocomplete="off" > 
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-1" style="text-align: right;">
                                                                    <label class="control-label">%A</label>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <label class="control-label">
                                                                        <input type="text" name="a_desc" class="form-control a_desc" value="{{$Hematology->a_desc}}" autocomplete="off"> 
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-1" style="text-align: right;">
                                                                    <label class="control-label">INR.</label>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <label class="control-label">
                                                                        <input type="text" name="inr_desc" class="form-control inr_desc" value="{{$Hematology->inr_desc}}" autocomplete="off"> 
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Hematology->cellindice == 'Yes')
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="cellindices" name="cellindices" checked="" value="Yes"> <b>CELL INDICES</b></label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="cellindices" name="cellindices" value="Yes"> <b>CELL INDICES</b></label>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-1" style="text-align: right;">
                                                                    <label class="control-label">MCV</label>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <label class="control-label">
                                                                        <input type="text" name="mcv_desc" class="form-control mcv_desc" value="{{$Hematology->mcv_desc}}" autocomplete="off"> 
                                                                    </label> 80 - 90
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    @if($Hematology->retic == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="retic" name="retic" checked="" value="Yes"> RETIC</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="retic" name="retic" value="Yes"> RETIC</label>
                                                                    @endif
                                                                    <label class="control-label">
                                                                        <input type="text" name="retic_desc" class="form-control retic_desc" value="{{$Hematology->retic_desc}}" autocomplete="off">
                                                                    </label> %0.5 - 1.5
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-1" style="text-align: right;">
                                                                    <label class="control-label">INDICES MCH</label>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <label class="control-label">
                                                                        <input type="text" name="indices_mch_desc" class="form-control indices_mch_desc" value="{{$Hematology->mch_desc}}" autocomplete="off"> 
                                                                    </label> 21 - 31 pg
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    @if($Hematology->rbc == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="rbc" name="rbc" checked="" value="Yes"> RBC&nbsp;&nbsp;&nbsp;</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="rbc" name="rbc" value="Yes"> RBC&nbsp;&nbsp;&nbsp;</label>
                                                                    @endif
                                                                    <label class="control-label">
                                                                        <input type="text" name="rbc_desc" class="form-control rbc_desc" value="{{$Hematology->rbc_desc}}" autocomplete="off">
                                                                    </label> MIL/mm4<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;F 4 - 5.5 &nbsp;&nbsp;&nbsp;&nbsp;M 4.5 - 6.0
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-1" style="text-align: right;">
                                                                    <label class="control-label">MCHC</label>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <label class="control-label">
                                                                        <input type="text" name="mchc_desc" class="form-control mchc_desc" value="{{$Hematology->mchc_desc}}" autocomplete="off"> 
                                                                    </label> 33 - 38 %
                                                                </div>
                                                            </div>
                                                        </div><br><br>

                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    ________________________________________<br>
                                                                    <b>ROGELIO S. McNTIRE, M.D.,FPSP</b><br>
                                                                    <i style="font-size: 9pt;">Pathologist</i>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    ________________________________________, RMT
                                                                </div>
                                                            </div>
                                                        </div><br>

                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label"></label>
                                                            <div class="col-sm-3">
                                                                <button class="btn btn-xs btn-primary" id="btn-submit-social_history" type="submit">Save Changes</button>
                                                            </div>
                                                        </div>
                                            </form>
                                        @endif
                                        </div>
                                </div>
                                </div>
                                <!-- done OK-->
                                <div role="tabpanel" class="tab-pane fade" id="Serology">
                                <div class="col-md-12">
                                    <div class="flash-message top-message topmessage7"></div><br>
                                    @if($patientserologyhead)
                                    <a href="/visit/{{$id}}/{{$vid}}/serologydone" class="btn btn-xs btn-primary">Done Service</a>
                                    <a href="/visit/{{$id}}/{{$vid}}/serologydone/pdf" target="_blank" class="btn btn-xs btn-success">Print</a>
                                    @endif
                                        <div class="col-md-12">
                                            <center><h3 class="neg">NEGROS FAMILY HEALTH SERVICES INC.</h3></center>
                                            <center><p class="nor">North Road, Daro(in front of NOPH) Dumaguete City, Negros Oriental</p></center>
                                            <center><p class="nor">Tel. No. (035) 225-3544</p></center>
                                            <h4><b>SEROLOGY</b></h4>
                                            <form class="form-horizontal" id="serologysubmit" method="POST" action="/visit/{{$id}}/{{$vid}}/serology">
                                                    {!! csrf_field() !!}
                                                    @if(!$patientserologyhead)
                                                    <input type="text" name="serology_id" value="" class="serology_id" style="display: none;">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Name:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="P_id" value="{{$id}}" style="display: none;">
                                                                <input type="text" name="P_name" required="" class="form-control" placeholder="Name" value="{{$patient->f_name}} {{$patient->m_name}} {{$patient->l_name}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">O.R. No.</label>
                                                            <div class="col-sm-2">
                                                                <input type="text" name="orno" class="form-control sero_orno" placeholder="O.R. No." readonly="" value="{{$receipt_number}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Address:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="address" required="" class="form-control" placeholder="Address" value="{{$patient->address}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">Sex:</label>
                                                            <div class="col-sm-2">
                                                                <select id="agesex" name="agesex" class="form-control" required="" disabled=""> 
                                                                    <option value="{{$patient->gender}}" selected="">{{$patient->gender}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Physician:</label>
                                                            <div class="col-sm-6">
                                                                <select id="physician" name="physician" class="form-control sero_physician" required="">
                                                                    <option value="">-- Select One --</option>
                                                                    @foreach($doctor as $doc)
                                                                    @if(Session::get('position') == "Doctor")
                                                                        @if(Session::get('user') == $doc->id)
                                                                        <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}" selected="">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @endif
                                                                    @else
                                                                        @if($doc->user->position == "Doctor")
                                                                        <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @endif
                                                                    @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-2 control-label">Date:</label>
                                                            <div class="col-sm-2">
                                                            <?php $datenow = date("Y-m-d"); ?>
                                                                <input type="text" id="datepicker" class="form-control sero_date" required="" value="{{$datenow}}" name="sero_date" readonly="">
                                                            </div>
                                                        </div> -->

                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: left;"><b>EXAMS :</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    <label class="control-label" style="text-align: left;"></label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <label class="control-label" style="text-align: left;"><b>RESULT</b></label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <label class="control-label" style="text-align: left;"><b>REMARKS</b></label>
                                                                </div>
                                                            </div>
                                                            @foreach($seroser as $serosers)
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    <label class="control-label"><b>{{$serosers->name}}</b></label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control seroser" name="seroser_id[]" value="{{$serosers->id}}" style="display: none;">
                                                                    <input type="text" class="form-control seroser_cat" name="seroser_cat_id[]" value="{{$serosers->admin_panel_cat_id}}" style="display: none;">
                                                                    <input type="text" class="form-control hemaresult" name="hemaresult[]" autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control hemaremark" name="hemaremark[]" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                        <br><br>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    ________________________________________<br>
                                                                    <b>ROGELIO S. McNTIRE, M.D.,FPSP</b><br>
                                                                    <i style="font-size: 9pt;">Pathologist</i>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    ________________________________________, RMT
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label"></label>
                                                            <div class="col-sm-3">
                                                                <button class="btn btn-xs btn-primary" form="serologysubmit" id="btn-submit-social_history" type="submit">Submit</button>
                                                            </div>
                                                        </div>
                                                    @else
                                                    <input type="text" name="serology_id" value="{{$patientserologyhead->id}}" class="serology_id" style="display: none;">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Name:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="P_id" value="{{$id}}" style="display: none;">
                                                                <input type="text" name="P_name" required="" class="form-control" placeholder="Name" value="{{$patient->f_name}} {{$patient->m_name}} {{$patient->l_name}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">O.R. No.</label>
                                                            <div class="col-sm-2">
                                                                <input type="text" name="orno" class="form-control sero_orno" placeholder="O.R. No." value="{{$receipt_number}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Address:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="address" required="" class="form-control" placeholder="Address" value="{{$patient->address}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">Sex:</label>
                                                            <div class="col-sm-2">
                                                                <select id="agesex" name="agesex" class="form-control" required="" disabled=""> 
                                                                    <option value="{{$patient->gender}}" selected="">{{$patient->gender}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Physician:</label>
                                                            <div class="col-sm-6">
                                                                <select id="physician" name="physician" class="form-control sero_physician" required="">
                                                                    <option value="">-- Select One --</option>
                                                                    @foreach($doctor as $doc)
                                                                        @if($patientserologyhead->doctor_id == $doc->id)
                                                                        <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}" selected="">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @else
                                                                        <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-2 control-label">Date:</label>
                                                            <div class="col-sm-2">
                                                            <?php $datenow = date("Y-m-d"); ?>
                                                                <input type="text" id="datepicker" class="form-control sero_date" required="" value="{{$patientserologyhead->serology_date}}" name="sero_date" readonly="">
                                                            </div>
                                                        </div> -->

                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: left;"><b>EXAMS :</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    <label class="control-label" style="text-align: left;"></label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <label class="control-label" style="text-align: left;"><b>RESULT</b></label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <label class="control-label" style="text-align: left;"><b>REMARKS</b></label>
                                                                </div>
                                                            </div>
                                                                @foreach($patientserologybody as $paserobody)
                                                                    <div class="row"> 
                                                                        <div class="col-sm-4">
                                                                            <label class="control-label"><b>{{$paserobody->adminpanel->name}}</b></label>
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <input type="text" class="form-control seroser" name="seroser_id[]" value="{{$paserobody->admin_panel_id}}" style="display: none;">
                                                                            <input type="text" class="form-control seroser_cat" name="seroser_cat_id[]" value="{{$paserobody->admin_panel_cat_id}}" style="display: none;">
                                                                            <input type="text" class="form-control hemaresult" name="hemaresult[]" value="{{$paserobody->result}}" autocomplete="off">
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <input type="text" class="form-control hemaremark" name="hemaremark[]" value="{{$paserobody->remark}}" autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                        </div>
                                                        <br><br>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    ________________________________________<br>
                                                                    <b>ROGELIO S. McNTIRE, M.D.,FPSP</b><br>
                                                                    <i style="font-size: 9pt;">Pathologist</i>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    ________________________________________, RMT
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label"></label>
                                                            <div class="col-sm-3">
                                                                <button class="btn btn-xs btn-primary" form="serologysubmit" id="btn-submit-social_history" type="submit">Save Changes</button>
                                                            </div>
                                                        </div>
                                                    @endif
                                            </form>
                                        
                                        </div>
                                </div>
                                </div>
                                <!-- done OK-->
                                <div role="tabpanel" class="tab-pane fade" id="ChemistryII">
                                <div class="col-md-12">
                                    <div class="flash-message top-message topmessage7"></div><br>
                                    @if($SecondChemistry)
                                    <a href="/visit/{{$id}}/{{$vid}}/chemistryiidone" class="btn btn-xs btn-primary">Done Service</a>
                                    <a href="/visit/{{$id}}/{{$vid}}/chemistryiidone/pdf" target="_blank" class="btn btn-xs btn-success">Print</a>
                                    @endif
                                        <div class="col-md-12">
                                            <center><h3 class="neg">NEGROS FAMILY HEALTH SERVICES INC.</h3></center>
                                            <center><p class="nor">North Road, Daro(in front of NOPH) Dumaguete City, Negros Oriental</p></center>
                                            <center><p class="nor">Tel. No. (035) 225-3544</p></center>
                                            <h4><b>Chemistry II</b></h4>
                                            <form class="form-horizontal" id="chemtwosubmit" method="POST" action="/visit/{{$id}}/{{$vid}}/chemtwo">
                                                    {!! csrf_field() !!}
                                                @if(!$SecondChemistry)
                                                    <input type="text" name="chemtwo_id" value="" class="chemtwo_id" style="display: none;">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Name:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="P_id" value="{{$id}}" style="display: none;">
                                                                <input type="text" name="P_name" required="" class="form-control" placeholder="Name" value="{{$patient->f_name}} {{$patient->m_name}} {{$patient->l_name}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">O.R. No.</label>
                                                            <div class="col-sm-2">
                                                                <input type="text" name="orno" class="form-control uri_orno" placeholder="O.R. No." readonly="" value="{{$receipt_number}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Address:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="address" required="" class="form-control" placeholder="Address" value="{{$patient->address}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">Sex:</label>
                                                            <div class="col-sm-2">
                                                                <select id="agesex" name="agesex" class="form-control" required="" disabled=""> 
                                                                    <option value="{{$patient->gender}}" selected="">{{$patient->gender}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Physician:</label>
                                                            <div class="col-sm-6">
                                                                <select id="physician" name="physician" class="form-control uri_physician" required="">
                                                                    <option value="">-- Select One --</option>
                                                                    @foreach($doctor as $doc)
                                                                    @if(Session::get('position') == "Doctor")
                                                                        @if(Session::get('user') == $doc->id)
                                                                        <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}" selected="">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @endif
                                                                    @else
                                                                        @if($doc->user->position == "Doctor")
                                                                        <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @endif
                                                                    @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-2 control-label">Date:</label>
                                                            <div class="col-sm-2">
                                                            <?php $datenow = date("Y-m-d"); ?>
                                                                <input type="text" id="datepicker_chemtwo" class="form-control chemtwo_date" required="" value="{{$datenow}}" readonly="" name="chemtwo_date">
                                                            </div>
                                                        </div> -->

                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    <label class="control-label" style="text-align: left;"></label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <label class="control-label" style="text-align: left;"><b>Result</b></label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <label class="control-label" style="text-align: left;"><b>Normal Value</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    <label class="control-label"><b> THYROID PANEL</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    <label class="control-label">
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TSH(Thyroid-Stimulating Hormone)
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="tsh" autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    0.3 - 4.2 mIU/L
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    <label class="control-label">
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T3(Triiodothyronine)
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="t3" autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    1.3 - 3.1 nmd/L
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    <label class="control-label">
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T4(Thyroxine)
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="t4" autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    66 - 181 nmd/L
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    <label class="control-label">
                                                                        <b>PSA (Protate Specific Antigen)</b>
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="psa" autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    < 4ng/mL
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    <label class="control-label">
                                                                        <b>LIVER FUNCTION</b>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    <label class="control-label">
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bilirubin</b>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -- Total
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="bilirubin_total" autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    < 1.1 mg/dl
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -- Direct
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="bilirubin_direct" autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    < 0.25 mg/dl
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -- Indirect
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="bilirubin_indirect" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    <label class="control-label">
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Serum Protien</b>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -- Total
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="protien_total" autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    < 15.1 - 8.0 g/dl
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -- Albumin
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="protien_albumin" autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    3.0 - 5.0 g/dl
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -- Globulin
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="protien_globulin" autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    2.5 - 6.0 g/dl
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -- A/G Ratio
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="protien_ag_ratio" autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    1.5 - 3.0 :1.0 g/dl
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-1 control-label"><b>REMARKS</b></label>
                                                            <div class="col-sm-11">
                                                                <textarea class="form-control" name="chemtwo_remark"></textarea>
                                                            </div>
                                                        </div>
                                                        <br><br>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    ________________________________________<br>
                                                                    <b>ROGELIO S. McNTIRE, M.D.,FPSP</b><br>
                                                                    <i style="font-size: 9pt;">Pathologist</i>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    ________________________________________, RMT
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                    
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label"></label>
                                                            <div class="col-sm-3">
                                                                <button class="btn btn-xs btn-primary" form="chemtwosubmit" id="btn-submit-social_history" type="submit">Submit</button>
                                                            </div>
                                                        </div>
                                                @else
                                                    <input type="text" name="chemtwo_id" value="{{$SecondChemistry->id}}" class="chemtwo_id" style="display: none;">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Name:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="P_id" value="{{$id}}" style="display: none;">
                                                                <input type="text" name="P_name" required="" class="form-control" placeholder="Name" value="{{$patient->f_name}} {{$patient->m_name}} {{$patient->l_name}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">O.R. No.</label>
                                                            <div class="col-sm-2">
                                                                <input type="text" name="orno" class="form-control uri_orno" placeholder="O.R. No." value="{{$receipt_number}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Address:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="address" required="" class="form-control" placeholder="Address" value="{{$patient->address}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">Sex:</label>
                                                            <div class="col-sm-2">
                                                                <select id="agesex" name="agesex" class="form-control" required="" disabled=""> 
                                                                    <option value="{{$patient->gender}}" selected="">{{$patient->gender}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Physician:</label>
                                                            <div class="col-sm-6">
                                                                <select id="physician" name="physician" class="form-control uri_physician" required="">
                                                                    <option value="">-- Select One --</option>
                                                                    @foreach($doctor as $doc)
                                                                        @if($SecondChemistry->doc_id == $doc->id)
                                                                            <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}" selected="">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @else
                                                                            <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-2 control-label">Date:</label>
                                                            <div class="col-sm-2">
                                                            <?php $datenow = date("Y-m-d"); ?>
                                                                <input type="text" id="datepicker_chemtwo" class="form-control chemtwo_date" required="" value="{{$datenow}}" readonly="" name="chemtwo_date">
                                                            </div>
                                                        </div> -->

                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    <label class="control-label" style="text-align: left;"></label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <label class="control-label" style="text-align: left;"><b>Result</b></label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <label class="control-label" style="text-align: left;"><b>Normal Value</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    <label class="control-label"><b> THYROID PANEL</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    <label class="control-label">
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TSH(Thyroid-Stimulating Hormone)
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="tsh" value="{{$SecondChemistry->tsh}}" autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    0.3 - 4.2 mIU/L
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    <label class="control-label">
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T3(Triiodothyronine)
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="t3" value="{{$SecondChemistry->t3}}" autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    1.3 - 3.1 nmd/L
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    <label class="control-label">
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T4(Thyroxine)
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="t4" value="{{$SecondChemistry->t4}}" autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    66 - 181 nmd/L
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    <label class="control-label">
                                                                        <b>PSA (Protate Specific Antigen)</b>
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="psa" value="{{$SecondChemistry->psa}}" autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    < 4ng/mL
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    <label class="control-label">
                                                                        <b>LIVER FUNCTION</b>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    <label class="control-label">
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bilirubin</b>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -- Total
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="bilirubin_total" value="{{$SecondChemistry->bilirubin_total}}" autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    < 1.1 mg/dl
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -- Direct
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="bilirubin_direct" value="{{$SecondChemistry->bilirubin_direct}}" autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    < 0.25 mg/dl
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -- Indirect
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="bilirubin_indirect" value="{{$SecondChemistry->bilirubin_indirect}}" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    <label class="control-label">
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Serum Protien</b>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -- Total
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="protien_total" value="{{$SecondChemistry->protien_total}}" autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    < 15.1 - 8.0 g/dl
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -- Albumin
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="protien_albumin" value="{{$SecondChemistry->protien_albumin}}" autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    3.0 - 5.0 g/dl
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -- Globulin
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="protien_globulin" value="{{$SecondChemistry->protien_globulin}}" autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    2.5 - 6.0 g/dl
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-4">
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -- A/G Ratio
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" name="protien_ag_ratio" value="{{$SecondChemistry->protien_ag_ratio}}" autocomplete="off">
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    1.5 - 3.0 :1.0 g/dl
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-1 control-label"><b>REMARKS</b></label>
                                                            <div class="col-sm-11">
                                                                <textarea class="form-control" name="chemtwo_remark">{{$SecondChemistry->remark}}</textarea>
                                                            </div>
                                                        </div>
                                                        <br><br>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    ________________________________________<br>
                                                                    <b>ROGELIO S. McNTIRE, M.D.,FPSP</b><br>
                                                                    <i style="font-size: 9pt;">Pathologist</i>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    ________________________________________, RMT
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                    
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label"></label>
                                                            <div class="col-sm-3">
                                                                <button class="btn btn-xs btn-primary" form="chemtwosubmit" id="btn-submit-social_history" type="submit">Save Changes</button>
                                                            </div>
                                                        </div>
                                                @endif
                                            </form>
                                        
                                        </div>
                                </div>
                                </div>
                                <!-- done OK -->
                                <div role="tabpanel" class="tab-pane fade" id="Aptt">
                                <div class="col-md-12">
                                    <div class="flash-message top-message topmessage7"></div><br>
                                    @if($Aptt)
                                    <a href="/visit/{{$id}}/{{$vid}}/apttdone" class="btn btn-xs btn-primary">Done Service</a>
                                    <a href="/visit/{{$id}}/{{$vid}}/apttdone/pdf" target="_blank" class="btn btn-xs btn-success">Print</a>
                                    @endif
                                        <div class="col-md-12">
                                            <center><h3 class="neg">NEGROS FAMILY HEALTH SERVICES INC.</h3></center>
                                            <center><p class="nor">North Road, Daro(in front of NOPH) Dumaguete City, Negros Oriental</p></center>
                                            <center><p class="nor">Tel. No. (035) 225-3544</p></center>
                                            <h4><b>HEMATOLOGY APTT</b></h4>
                                        @if(!$Aptt)
                                            <form class="form-horizontal" method="POST" action="/visit/{{$id}}/{{$vid}}/aptt">
                                                    {!! csrf_field() !!}
                                                    <input type="text" name="uri_id" value="" class="uri_id" style="display: none;">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Name:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="P_id" value="{{$id}}" style="display: none;">
                                                                <input type="text" name="P_name" required="" class="form-control" placeholder="Name" value="{{$patient->f_name}} {{$patient->m_name}} {{$patient->l_name}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">O.R. No.</label>
                                                            <div class="col-sm-2">
                                                                <input type="text" name="orno" class="form-control uri_orno" placeholder="O.R. No." readonly="" value="{{$receipt_number}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Address:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="address" required="" class="form-control" placeholder="Address" value="{{$patient->address}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">Sex:</label>
                                                            <div class="col-sm-2">
                                                                <select id="agesex" name="agesex" class="form-control" required="" disabled=""> 
                                                                    <option value="{{$patient->gender}}" selected="">{{$patient->gender}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Physician:</label>
                                                            <div class="col-sm-6">
                                                                <select id="physician" name="physician" class="form-control uri_physician" required="">
                                                                    <option value="">-- Select One --</option>
                                                                    @foreach($doctor as $doc)
                                                                    @if(Session::get('position') == "Doctor")
                                                                        @if(Session::get('user') == $doc->id)
                                                                        <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}" selected="">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @endif
                                                                    @else
                                                                        @if($doc->user->position == "Doctor")
                                                                        <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @endif
                                                                    @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-2 control-label">Date:</label>
                                                            <div class="col-sm-2">
                                                            <?php $datenow = date("Y-m-d"); ?>
                                                                <input type="text" id="datepicker" class="form-control uri_date" required="" value="{{$datenow}}" disabled="">
                                                            </div>
                                                        </div> -->

                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: left;"><input type="checkbox" class="cbc" name="cbc" checked="" value="Yes"> <b>CBC</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-2">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="hematocrit" name="hematocrit" checked="" value="Yes"> Hematocrit</label>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <label class="control-label">
                                                                        <input type="text" name="hematocrit_desc" class="form-control hematocrit_desc" value="" autocomplete="off"> 
                                                                    </label> %
                                                                </div>
                                                                <div class="col-sm-1" style="font-size: 8pt;">
                                                                    F42 ± 5<br>M47 ± 7
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="clotting_lw" name="clotting_lw" checked="" value="Yes"> Clotting(Lee & White)</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    Time :
                                                                    <label class="control-label">
                                                                        <input type="text" name="clotting_lw_desc" class="form-control clotting_lw_desc" value="" autocomplete="off"> 
                                                                    </label>
                                                                    N:6-17 min.
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-2">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="hemoglobin" name="hemoglobin" checked="" value="Yes"> Hemoglobin</label>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <label class="control-label">
                                                                        <input type="text" name="hemoglobin_desc" class="form-control hemoglobin_desc" value="" autocomplete="off"> 
                                                                    </label> %
                                                                </div>
                                                                <div class="col-sm-1" style="font-size: 8pt;">
                                                                    F14 ± 2
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="clotting" name="clotting" checked="" value="Yes"> Clotting</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    Time :
                                                                    <label class="control-label">
                                                                        <input type="text" name="clotting_desc" class="form-control clotting_desc" value="" autocomplete="off"> 
                                                                    </label>
                                                                    N:3-5 min.
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-2">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="wbc" name="wbc" checked="" value="Yes"> WBC</label>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <label class="control-label">
                                                                        <input type="text" name="wbc_desc" class="form-control wbc_desc" value="" autocomplete="off"> 
                                                                    </label> T/mm
                                                                </div>
                                                                <div class="col-sm-1" style="font-size: 8pt;">
                                                                    3A5 10<br>CH6 13
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="bleeding" name="bleeding" checked="" value="Yes"> Bleeding(Duke Method)</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    Time :
                                                                    <label class="control-label">
                                                                        <input type="text" name="bleeding_desc" class="form-control bleeding_desc" value="" autocomplete="off"> 
                                                                    </label>
                                                                    N:1-3 min.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: left;"><b>Differential Count %</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: center;font-size: 9pt;">BAND<br>0 - 10</label>
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: center;font-size: 9pt;">PMN<br>53 - 70</label>
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: center;font-size: 9pt;">BASO<br>0 - 1</label>
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: center;font-size: 9pt;">EOS<br>1 - 4</label>
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: center;font-size: 9pt;">MONO<br>1 - 6</label>
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: center;font-size: 9pt;">LYMPHS<br>20 - 36</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <input type="text" name="band" class="band form-control">
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <input type="text" name="pmn" class="pmn form-control">
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <input type="text" name="baso" class="baso form-control">
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <input type="text" name="eos" class="eos form-control">
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <input type="text" name="mono" class="mono form-control">
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <input type="text" name="lymphs" class="lymphs form-control">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="clot" name="clot" checked="" value="Yes"> Clot</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    Retraction :
                                                                    <label class="control-label">
                                                                        <input type="text" name="clot_desc" class="form-control clot_desc" value="" autocomplete="off"> 
                                                                    </label>
                                                                    N:48-64%
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="platelet" name="platelet" checked="" value="Yes"> Platelet</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    Count :
                                                                    <label class="control-label">
                                                                        <input type="text" name="platelet_desc" class="form-control platelet_desc" value="" autocomplete="off"> 
                                                                    </label>
                                                                    N:150-400 T/mm*
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: left;"><input type="checkbox" class="protime" name="protime" checked="" value="Yes"> <b>PRO TIME</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-1" style="text-align: right;">
                                                                    <label class="control-label">Control</label>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <label class="control-label">
                                                                        <input type="text" name="control_desc" class="form-control control_desc" value="" autocomplete="off"> 
                                                                    </label> sec.
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="grp" name="grp" checked="" value="Yes"> GRP</label>&nbsp;&nbsp;
                                                                    <label class="control-label">
                                                                        <input type="text" name="grp_desc" class="form-control grp_desc" value="" autocomplete="off" > 
                                                                    </label>
                                                                    <label class="control-label" style="text-align: right;"> Rh</label>
                                                                    <label class="control-label">
                                                                        <input type="text" name="rh_desc" class="form-control rh_desc" value="" autocomplete="off" style="width: 50%;"> 
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-1" style="text-align: right;">
                                                                    <label class="control-label">Patient</label>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <label class="control-label">
                                                                        <input type="text" name="patient_desc" class="form-control patient_desc" value="" autocomplete="off"> 
                                                                    </label> sec.
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="esr" name="esr" checked="" value="Yes"> APTT</label>&nbsp;
                                                                    <label class="control-label">
                                                                        <input type="text" name="esr_desc" class="form-control esr_desc" value="" autocomplete="off"> 
                                                                    </label>
                                                                    mm/HR.
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-1" style="text-align: right;">
                                                                    <label class="control-label">%A</label>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <label class="control-label">
                                                                        <input type="text" name="a_desc" class="form-control a_desc" value="" autocomplete="off"> 
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-1" style="text-align: right;">
                                                                    <label class="control-label">INR.</label>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <label class="control-label">
                                                                        <input type="text" name="inr_desc" class="form-control inr_desc" value="" autocomplete="off"> 
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: left;"><input type="checkbox" class="cellindices" name="cellindices" checked="" value="Yes"> <b>CELL INDICES</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-1" style="text-align: right;">
                                                                    <label class="control-label">MCV</label>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <label class="control-label">
                                                                        <input type="text" name="mcv_desc" class="form-control mcv_desc" value="" autocomplete="off"> 
                                                                    </label> 80 - 90
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="rbc" name="rbc" checked="" value="Yes"> RBC&nbsp;&nbsp;&nbsp;</label>
                                                                    <label class="control-label">
                                                                        <input type="text" name="rbc_desc" class="form-control rbc_desc" value="" autocomplete="off">
                                                                    </label> MIL/mm4<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;F 4 - 5.5 &nbsp;&nbsp;&nbsp;&nbsp;M 4.5 - 6.0
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-1" style="text-align: right;">
                                                                    <label class="control-label">INDICES MCH</label>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <label class="control-label">
                                                                        <input type="text" name="indices_mch_desc" class="form-control indices_mch_desc" value="" autocomplete="off"> 
                                                                    </label> 21 - 31 pg
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-1" style="text-align: right;">
                                                                    <label class="control-label">MCHC</label>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <label class="control-label">
                                                                        <input type="text" name="mchc_desc" class="form-control mchc_desc" value="" autocomplete="off"> 
                                                                    </label> 33 - 38 %
                                                                </div>
                                                            </div>
                                                        </div><br><br>

                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    ________________________________________<br>
                                                                    <b>ROGELIO S. McNTIRE, M.D.,FPSP</b><br>
                                                                    <i style="font-size: 9pt;">Pathologist</i>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    ________________________________________, RMT
                                                                </div>
                                                            </div>
                                                        </div><br>

                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label"></label>
                                                            <div class="col-sm-3">
                                                                <button class="btn btn-xs btn-primary" id="btn-submit-social_history" type="submit">Submit</button>
                                                            </div>
                                                        </div>
                                            </form>
                                        @else
                                            <form class="form-horizontal" method="POST" action="/visit/{{$id}}/{{$vid}}/aptt">
                                                    {!! csrf_field() !!}
                                                    <input type="text" name="uri_id" value="{{$Aptt->id}}" class="uri_id" style="display: none;">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Name:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="P_id" value="{{$id}}" style="display: none;">
                                                                <input type="text" name="P_name" required="" class="form-control" placeholder="Name" value="{{$patient->f_name}} {{$patient->m_name}} {{$patient->l_name}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">O.R. No.</label>
                                                            <div class="col-sm-2">
                                                                <input type="text" name="orno" class="form-control uri_orno" placeholder="O.R. No." value="{{$receipt_number}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Address:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="address" required="" class="form-control" placeholder="Address" value="{{$patient->address}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">Sex:</label>
                                                            <div class="col-sm-2">
                                                                <select id="agesex" name="agesex" class="form-control" required="" disabled=""> 
                                                                    <option value="{{$patient->gender}}" selected="">{{$patient->gender}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Physician:</label>
                                                            <div class="col-sm-6">
                                                                <select id="physician" name="physician" class="form-control uri_physician" required="">
                                                                    <option value="">-- Select One --</option>
                                                                    @foreach($doctor as $doc)
                                                                        @if($Aptt->doc_id == $doc->id)
                                                                        <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}" selected="">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @else
                                                                        <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-2 control-label">Date:</label>
                                                            <div class="col-sm-2">
                                                            <?php $datenow = date("Y-m-d"); ?>
                                                                <input type="text" id="datepicker" class="form-control uri_date" required="" value="{{$Aptt->date_reg}}" disabled="">
                                                            </div>
                                                        </div> -->

                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Aptt->cbc == 'Yes')
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="cbc" name="cbc" checked="" value="Yes"> <b>CBC</b></label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="cbc" name="cbc" value="Yes"> <b>CBC</b></label>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-2">
                                                                    @if($Aptt->hematocrit == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="hematocrit" name="hematocrit" checked="" value="Yes"> Hematocrit</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="hematocrit" name="hematocrit" value="Yes"> Hematocrit</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <label class="control-label">
                                                                        <input type="text" name="hematocrit_desc" class="form-control hematocrit_desc" value="{{$Aptt->hematocrit_desc}}" autocomplete="off"> 
                                                                    </label> %
                                                                </div>
                                                                <div class="col-sm-1" style="font-size: 8pt;">
                                                                    F42 ± 5<br>M47 ± 7
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    @if($Aptt->clottinglw == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="clotting_lw" name="clotting_lw" checked="" value="Yes"> Clotting(Lee & White)</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="clotting_lw" name="clotting_lw" value="Yes"> Clotting(Lee & White)</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    @endif
                                                                    Time :
                                                                    <label class="control-label">
                                                                        <input type="text" name="clotting_lw_desc" class="form-control clotting_lw_desc" value="{{$Aptt->clottinglw_time}}" autocomplete="off"> 
                                                                    </label>
                                                                    N:6-17 min.
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-2">
                                                                    @if($Aptt->hemoglobin == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="hemoglobin" name="hemoglobin" checked="" value="Yes"> Hemoglobin</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="hemoglobin" name="hemoglobin" value="Yes"> Hemoglobin</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <label class="control-label">
                                                                        <input type="text" name="hemoglobin_desc" class="form-control hemoglobin_desc" value="{{$Aptt->hemoglobin_desc}}" autocomplete="off"> 
                                                                    </label> %
                                                                </div>
                                                                <div class="col-sm-1" style="font-size: 8pt;">
                                                                    F14 ± 2
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    @if($Aptt->clotting == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="clotting" name="clotting" checked="" value="Yes"> Clotting</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="clotting" name="clotting" value="Yes"> Clotting</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    @endif
                                                                    Time :
                                                                    <label class="control-label">
                                                                        <input type="text" name="clotting_desc" class="form-control clotting_desc" value="{{$Aptt->clotting_time}}" autocomplete="off"> 
                                                                    </label>
                                                                    N:3-5 min.
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-2">
                                                                    @if($Aptt->wbc == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="wbc" name="wbc" checked="" value="Yes"> WBC</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="wbc" name="wbc" value="Yes"> WBC</label>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <label class="control-label">
                                                                        <input type="text" name="wbc_desc" class="form-control wbc_desc" value="{{$Aptt->wbc_desc}}" autocomplete="off"> 
                                                                    </label> T/mm
                                                                </div>
                                                                <div class="col-sm-1" style="font-size: 8pt;">
                                                                    3A5 10<br>CH6 13
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    @if($Aptt->bleedingdm == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="bleeding" name="bleeding" checked="" value="Yes"> Bleeding(Duke Method)</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="bleeding" name="bleeding" value="Yes"> Bleeding(Duke Method)</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    @endif
                                                                    Time :
                                                                    <label class="control-label">
                                                                        <input type="text" name="bleeding_desc" class="form-control bleeding_desc" value="{{$Aptt->bleedingdm_time}}" autocomplete="off"> 
                                                                    </label>
                                                                    N:1-3 min.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    <label class="control-label" style="text-align: left;"><b>Differential Count %</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: center;font-size: 9pt;">BAND<br>0 - 10</label>
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: center;font-size: 9pt;">PMN<br>53 - 70</label>
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: center;font-size: 9pt;">BASO<br>0 - 1</label>
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: center;font-size: 9pt;">EOS<br>1 - 4</label>
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: center;font-size: 9pt;">MONO<br>1 - 6</label>
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: center;font-size: 9pt;">LYMPHS<br>20 - 36</label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <input type="text" name="band" class="band form-control" value="{{$Aptt->dc_band}}">
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <input type="text" name="pmn" class="pmn form-control" value="{{$Aptt->dc_pmn}}">
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <input type="text" name="baso" class="baso form-control" value="{{$Aptt->dc_baso}}">
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <input type="text" name="eos" class="eos form-control" value="{{$Aptt->dc_eos}}">
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <input type="text" name="mono" class="mono form-control" value="{{$Aptt->dc_mono}}">
                                                                </div>
                                                                <div class="col-sm-1" style="border: 1px solid black;">
                                                                    <input type="text" name="lymphs" class="lymphs form-control" value="{{$Aptt->dc_lymph}}">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    @if($Aptt->clot == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="clot" name="clot" checked="" value="Yes"> Clot</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="clot" name="clot" value="Yes"> Clot</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    @endif
                                                                    Retraction :
                                                                    <label class="control-label">
                                                                        <input type="text" name="clot_desc" class="form-control clot_desc" value="{{$Aptt->clot_retraction}}" autocomplete="off"> 
                                                                    </label>
                                                                    N:48-64%
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    @if($Aptt->platelet == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="platelet" name="platelet" checked="" value="Yes"> Platelet</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="platelet" name="platelet" value="Yes"> Platelet</label><br>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    @endif
                                                                    Count :
                                                                    <label class="control-label">
                                                                        <input type="text" name="platelet_desc" class="form-control platelet_desc" value="{{$Aptt->platelet_count}}" autocomplete="off"> 
                                                                    </label>
                                                                    N:150-400 T/mm*
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Aptt->protime == 'Yes')
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="protime" name="protime" checked="" value="Yes"> <b>PRO TIME</b></label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="protime" name="protime" value="Yes"> <b>PRO TIME</b></label>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-1" style="text-align: right;">
                                                                    <label class="control-label">Control</label>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <label class="control-label">
                                                                        <input type="text" name="control_desc" class="form-control control_desc" value="{{$Aptt->control_desc}}" autocomplete="off"> 
                                                                    </label> sec.
                                                                </div>
                                                                <!-- 123 -->
                                                                <div class="col-sm-6">
                                                                    @if($Aptt->grp == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="grp" name="grp" checked="" value="Yes"> GRP</label>&nbsp;&nbsp;
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="grp" name="grp" value="Yes"> GRP</label>&nbsp;&nbsp;
                                                                    @endif
                                                                    <label class="control-label">
                                                                        <input type="text" name="grp_desc" class="form-control grp_desc" value="{{$Aptt->grp_desc}}" autocomplete="off" > 
                                                                    </label>
                                                                    <label class="control-label" style="text-align: right;"> Rh</label>
                                                                    <label class="control-label">
                                                                        <input type="text" name="rh_desc" class="form-control rh_desc" value="{{$Aptt->rh_desc}}" autocomplete="off" style="width: 50%;"> 
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-1" style="text-align: right;">
                                                                    <label class="control-label">Patient</label>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <label class="control-label">
                                                                        <input type="text" name="patient_desc" class="form-control patient_desc" value="{{$Aptt->patient_desc}}" autocomplete="off"> 
                                                                    </label> sec.
                                                                </div>
                                                                <!-- 123 -->
                                                                <div class="col-sm-6">
                                                                    @if($Aptt->esr == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="esr" name="esr" checked="" value="Yes"> APTT</label>&nbsp;
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="esr" name="esr" value="Yes"> APTT</label>&nbsp;
                                                                    @endif
                                                                    <label class="control-label">
                                                                        <input type="text" name="esr_desc" class="form-control esr_desc" value="{{$Aptt->esr_desc}}" autocomplete="off"> 
                                                                    </label>
                                                                    mm/HR.
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-1" style="text-align: right;">
                                                                    <label class="control-label">%A</label>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <label class="control-label">
                                                                        <input type="text" name="a_desc" class="form-control a_desc" value="{{$Aptt->a_desc}}" autocomplete="off"> 
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-1" style="text-align: right;">
                                                                    <label class="control-label">INR.</label>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <label class="control-label">
                                                                        <input type="text" name="inr_desc" class="form-control inr_desc" value="{{$Aptt->inr_desc}}" autocomplete="off"> 
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    @if($Aptt->cellindice == 'Yes')
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="cellindices" name="cellindices" checked="" value="Yes"> <b>CELL INDICES</b></label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="cellindices" name="cellindices" value="Yes"> <b>CELL INDICES</b></label>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-1" style="text-align: right;">
                                                                    <label class="control-label">MCV</label>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <label class="control-label">
                                                                        <input type="text" name="mcv_desc" class="form-control mcv_desc" value="{{$Aptt->mcv_desc}}" autocomplete="off"> 
                                                                    </label> 80 - 90
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    @if($Aptt->rbc == 'Yes')
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="rbc" name="rbc" checked="" value="Yes"> RBC&nbsp;&nbsp;&nbsp;</label>
                                                                    @else
                                                                        <label class="control-label" style="text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="rbc" name="rbc" value="Yes"> RBC&nbsp;&nbsp;&nbsp;</label>
                                                                    @endif
                                                                    <label class="control-label">
                                                                        <input type="text" name="rbc_desc" class="form-control rbc_desc" value="{{$Aptt->rbc_desc}}" autocomplete="off">
                                                                    </label> MIL/mm4<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;F 4 - 5.5 &nbsp;&nbsp;&nbsp;&nbsp;M 4.5 - 6.0
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-1" style="text-align: right;">
                                                                    <label class="control-label">INDICES MCH</label>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <label class="control-label">
                                                                        <input type="text" name="indices_mch_desc" class="form-control indices_mch_desc" value="{{$Aptt->mch_desc}}" autocomplete="off"> 
                                                                    </label> 21 - 31 pg
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-1" style="text-align: right;">
                                                                    <label class="control-label">MCHC</label>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <label class="control-label">
                                                                        <input type="text" name="mchc_desc" class="form-control mchc_desc" value="{{$Aptt->mchc_desc}}" autocomplete="off"> 
                                                                    </label> 33 - 38 %
                                                                </div>
                                                            </div>
                                                        </div><br><br>

                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-6">
                                                                    ________________________________________<br>
                                                                    <b>ROGELIO S. McNTIRE, M.D.,FPSP</b><br>
                                                                    <i style="font-size: 9pt;">Pathologist</i>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    ________________________________________, RMT
                                                                </div>
                                                            </div>
                                                        </div><br>

                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label"></label>
                                                            <div class="col-sm-3">
                                                                <button class="btn btn-xs btn-primary" id="btn-submit-social_history" type="submit">Save Changes</button>
                                                            </div>
                                                        </div>
                                            </form>
                                        @endif 
                                        </div>
                                </div>
                                </div>
                            </div>

                        </div>


                        <div role="tabpanel" class="tab-pane fade" id="ecg">
                            <div class="col-md-12">
                                <div class="flash-message top-message topmessage7"></div><br>
                                @if($ecg)
                                <a href="/visit/{{$id}}/{{$vid}}/ecgdone" class="btn btn-xs btn-primary">Done Service</a>
                                <a href="/visit/{{$id}}/{{$vid}}/ecgdone/pdf" target="_blank" class="btn btn-xs btn-success">Print</a>
                                @endif
                                    <div class="col-md-12">
                                        <center><h3 class="neg">NEGROS FAMILY HEALTH SERVICES INC.</h3></center>
                                        <center><p class="nor">North Road, Daro(in front of NOPH) Dumaguete City, Negros Oriental</p></center>
                                        <center><p class="nor">Tel. No. (035) 225-3544</p></center>
                                        <h4><b>Electrocardiographic Report</b></h4>
                                            <form class="form-horizontal" id="ecgsubmit" method="POST" action="/visit/{{$id}}/{{$vid}}/ecg">
                                                    {!! csrf_field() !!}
                                                @if(!$ecg)
                                                    <input type="text" name="ecg_id" value="" class="ecg_id" style="display: none;">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Name:</label>
                                                            <div class="col-sm-5">
                                                                <input type="text" name="P_id" value="{{$id}}" style="display: none;">
                                                                <input type="text" name="P_name" required="" class="form-control" placeholder="Name" value="{{$patient->f_name}} {{$patient->m_name}} {{$patient->l_name}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">O.R. No.</label>
                                                            <div class="col-sm-3">
                                                                <input type="text" name="orno" class="form-control uri_orno" placeholder="O.R. No." value="{{$receipt_number}}" readonly="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Address:</label>
                                                            <div class="col-sm-5">
                                                                <input type="text" name="address" required="" class="form-control" placeholder="Address" value="{{$patient->address}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-1 control-label">Sex:</label>
                                                            <div class="col-sm-2">
                                                                <select id="agesex" name="agesex" class="form-control" required="" disabled=""> 
                                                                    <option value="{{$patient->gender}}" selected="">{{$patient->gender}}</option>
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-1 control-label">Age:</label>
                                                            <div class="col-sm-1">
                                                                <input type="text" name="age" required="" class="form-control" placeholder="Age" value="{{$patient->age}}" readonly="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Requesting M.D.:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" class="form-control req_doc" name="req_doc" autocomplete="off">
                                                            </div>
                                                            <label class="col-sm-2 control-label">Date:</label>
                                                            <div class="col-sm-2">
                                                            <?php $datenow = date("Y-m-d"); ?>
                                                                <input type="text" id="datepicker_ecg" class="form-control ecg_date" required="" value="{{$datenow}}" readonly="" name="ecg_date">
                                                            </div>
                                                        </div>
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Diagnosis:</label>
                                                            <div class="col-sm-10">
                                                                <textarea class="form-control ecg_diagnosis" name="ecg_diagnosis"></textarea>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Phys.Fee:</label>
                                                            <div class="col-sm-3">
                                                                <input type="text" name="phyfee_ecg" class="form-control phyfee_ecg stopalpha" placeholder="0.00" autocomplete="off">
                                                            </div>
                                                        </div> -->

                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-2" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: left;"><b>Auricular Rate</b></label>
                                                                </div>
                                                                <div class="col-sm-2" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: left;"><b>Venticular Rate</b></label>
                                                                </div>
                                                                <div class="col-sm-2" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: left;"><b>Rhythm</b></label>
                                                                </div>
                                                                <div class="col-sm-2" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: left;"><b>PR Interval</b></label>
                                                                </div>
                                                                <div class="col-sm-2" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: left;"><b>QRS Interval</b></label>
                                                                </div>
                                                                <div class="col-sm-2" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: left;"><b>Electrical Axis</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-2" style="border: 1px solid black;">
                                                                    <textarea class="form-control AuricularRate" name="AuricularRate" rows="6"></textarea>
                                                                </div>
                                                                <div class="col-sm-2" style="border: 1px solid black;">
                                                                    <textarea class="form-control VenticularRate" name="VenticularRate" rows="6"></textarea>
                                                                </div>
                                                                <div class="col-sm-2" style="border: 1px solid black;">
                                                                    <textarea class="form-control Rhythm" name="Rhythm" rows="6"></textarea>
                                                                </div>
                                                                <div class="col-sm-2" style="border: 1px solid black;">
                                                                    <textarea class="form-control PRInterval" name="PRInterval" rows="6"></textarea>
                                                                </div>
                                                                <div class="col-sm-2" style="border: 1px solid black;">
                                                                    <textarea class="form-control QRSInterval" name="QRSInterval" rows="6"></textarea>
                                                                </div>
                                                                <div class="col-sm-2" style="border: 1px solid black;">
                                                                    <textarea class="form-control ElectricalAxis" name="ElectricalAxis" rows="6"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Significant Findings:</label>
                                                            <div class="col-sm-10">
                                                                <textarea class="form-control sig_find" name="sig_find"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Interpretations:</label>
                                                            <div class="col-sm-10">
                                                                <textarea class="form-control interpretation" name="interpretation"></textarea>
                                                            </div>
                                                        </div>
                                                        <br>
                                    
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label"></label>
                                                            <div class="col-sm-3">
                                                                <button class="btn btn-xs btn-primary" form="ecgsubmit" id="btn-submit-social_history" type="submit">Submit</button>
                                                            </div>
                                                        </div>
                                                @else
                                                    <input type="text" name="ecg_id" value="{{$ecg->id}}" class="ecg_id" style="display: none;">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Name:</label>
                                                            <div class="col-sm-5">
                                                                <input type="text" name="P_id" value="{{$id}}" style="display: none;">
                                                                <input type="text" name="P_name" required="" class="form-control" placeholder="Name" value="{{$patient->f_name}} {{$patient->m_name}} {{$patient->l_name}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">O.R. No.</label>
                                                            <div class="col-sm-3">
                                                                <input type="text" name="orno" class="form-control uri_orno" placeholder="O.R. No." value="{{$receipt_number}}" readonly="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Address:</label>
                                                            <div class="col-sm-5">
                                                                <input type="text" name="address" required="" class="form-control" placeholder="Address" value="{{$patient->address}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-1 control-label">Sex:</label>
                                                            <div class="col-sm-2">
                                                                <select id="agesex" name="agesex" class="form-control" required="" disabled=""> 
                                                                    <option value="{{$patient->gender}}" selected="">{{$patient->gender}}</option>
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-1 control-label">Age:</label>
                                                            <div class="col-sm-1">
                                                                <input type="text" name="age" required="" class="form-control" placeholder="Age" value="{{$patient->age}}" readonly="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Requesting M.D.:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" class="form-control req_doc" name="req_doc" autocomplete="off" value="{{$ecg->req_doc}}">
                                                            </div>
                                                            <label class="col-sm-2 control-label">Date:</label>
                                                            <div class="col-sm-2">
                                                            <?php $datenow = date("Y-m-d"); ?>
                                                                <input type="text" id="datepicker_ecg" class="form-control ecg_date" required="" value="{{$ecg->ecg_date}}" readonly="" name="ecg_date">
                                                            </div>
                                                        </div>
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Diagnosis:</label>
                                                            <div class="col-sm-10">
                                                                <textarea class="form-control ecg_diagnosis" name="ecg_diagnosis">{{$ecg->diagnosis}}</textarea>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Phys.Fee:</label>
                                                            <div class="col-sm-3">
                                                                <input type="text" name="phyfee_ecg" class="form-control phyfee_ecg stopalpha" placeholder="0.00" autocomplete="off" value="{{$ecg->phy_fee}}">
                                                            </div>
                                                        </div> -->

                                                        <div class=" divxrayinfo">
                                                            <div class="row"> 
                                                                <div class="col-sm-2" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: left;"><b>Auricular Rate</b></label>
                                                                </div>
                                                                <div class="col-sm-2" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: left;"><b>Venticular Rate</b></label>
                                                                </div>
                                                                <div class="col-sm-2" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: left;"><b>Rhythm</b></label>
                                                                </div>
                                                                <div class="col-sm-2" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: left;"><b>PR Interval</b></label>
                                                                </div>
                                                                <div class="col-sm-2" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: left;"><b>QRS Interval</b></label>
                                                                </div>
                                                                <div class="col-sm-2" style="border: 1px solid black;">
                                                                    <label class="control-label" style="text-align: left;"><b>Electrical Axis</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-sm-2" style="border: 1px solid black;">
                                                                    <textarea class="form-control AuricularRate" name="AuricularRate" rows="6">{{$ecg->auricular_rate}}</textarea>
                                                                </div>
                                                                <div class="col-sm-2" style="border: 1px solid black;">
                                                                    <textarea class="form-control VenticularRate" name="VenticularRate" rows="6">{{$ecg->venticular_rate}}</textarea>
                                                                </div>
                                                                <div class="col-sm-2" style="border: 1px solid black;">
                                                                    <textarea class="form-control Rhythm" name="Rhythm" rows="6">{{$ecg->rhythm}}</textarea>
                                                                </div>
                                                                <div class="col-sm-2" style="border: 1px solid black;">
                                                                    <textarea class="form-control PRInterval" name="PRInterval" rows="6">{{$ecg->pr_interval}}</textarea>
                                                                </div>
                                                                <div class="col-sm-2" style="border: 1px solid black;">
                                                                    <textarea class="form-control QRSInterval" name="QRSInterval" rows="6">{{$ecg->qrs_interval}}</textarea>
                                                                </div>
                                                                <div class="col-sm-2" style="border: 1px solid black;">
                                                                    <textarea class="form-control ElectricalAxis" name="ElectricalAxis" rows="6">{{$ecg->electrical_axis}}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Significant Findings:</label>
                                                            <div class="col-sm-10">
                                                                <textarea class="form-control sig_find" name="sig_find">{{$ecg->significant_finding}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-2 control-label">Interpretations:</label>
                                                            <div class="col-sm-10">
                                                                <textarea class="form-control interpretation" name="interpretation">{{$ecg->interpretation}}</textarea>
                                                            </div>
                                                        </div>
                                                        <br>
                                    
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label"></label>
                                                            <div class="col-sm-3">
                                                                <button class="btn btn-xs btn-primary" form="ecgsubmit" id="btn-submit-social_history" type="submit">Save Changes</button>
                                                            </div>
                                                        </div>
                                                @endif
                                            </form>
                                    </div>
                            </div>
                        </div>

                        <!-- Ultrasound -->
                        <div role="tabpanel" class="tab-pane fade" id="ultrasound">
                            <div class="col-md-12">
                                <h3> Ultrasound
                                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal_ultrasoundnew" data-backdrop="static">Add New</button>
                                @if($Patientultrasoundcount != 0)
                                <a href="/visit/{{$patient->id}}/{{$vid}}/ultrasounddone" class="btn btn-xs btn-default">Done</a>
                                @endif
                                </h3>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th class="text-center">Date</th>
                                                <th class="text-center">Physician</th>
                                                <th class="text-center">Result</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="medication_list">
                                            @foreach($Patientultrasound as $ultrasound)
                                            <?php
                                                $id = $ultrasound->id;
                                                $zero_id = sprintf("%04d", $id);
                                            ?>
                                                <tr>
                                                    <td>{{$zero_id}}</td>
                                                    <td class="text-center">{{$ultrasound->ultrasound_date}}</td>
                                                    <td class="text-center">
                                                        @if(!$ultrasound->doctor)
                                                        @else
                                                        {{$ultrasound->doctor->f_name}} {{$ultrasound->doctor->m_name}} {{$ultrasound->doctor->l_name}}, {{$ultrasound->doctor->credential}}
                                                        @endif
                                                    </td>
                                                    <td class="text-center">{{$ultrasound->finding}}</td>
                                                    <td class="text-center">{{$ultrasound->status}}</td>
                                                    <td class="text-center">
                                                        @if(!Session::get('user'))
                                                        @else
                                                            <button type="button" class="btn btn-xs btn-primary btn-xs editpatientultrasound" data-toggle="modal" data-target="#modal_ultrasoundnew_edit" data-backdrop="static" data-id="{{$ultrasound->id}}">Edit</button>
                                                            <a href="/ultrasound/pdf/view/{{$ultrasound->id}}" target="_blank" class="btn btn-xs btn-success">Print</a>
                                                            <a href="/ultrasound/pdf/view/{{$ultrasound->id}}/reprint" target="_blank" class="btn btn-xs btn-default">Re-Print</a>
                                                            <button type="button" class="btn btn-xs btn-warning patientultrasoundlog" data-toggle="modal" data-target="#modal_patientultrasoundlog" data-backdrop="static" data-id="{{$ultrasound->id}}">Logs</button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Ultrasound NEW MODAL -->
                        <div class="modal fade" id="modal_ultrasoundnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog modalwidth" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="table-responsive">
                                            <div class="col-md-12">
                                                <center><h3 class="neg">NEGROS FAMILY HEALTH SERVICES INC.</h3></center>
                                                <center><p class="nor">North Road, Daro(in front of NOPH) Dumaguete City, Negros Oriental</p></center>
                                                <center><p class="nor">Tel. No. (035) 225-3544</p></center>
                                                <h4><b>ULTRASOUND</b></h4>

                                                <form class="form-horizontal" method="POST" action="/visit/{{$patient->id}}/{{$vid}}/ultrasound">
                                                {!! csrf_field() !!}
                                                    <div class="form-group">
                                                        <label class="col-sm-1 control-label">Name:</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" name="P_id" value="{{$patient->id}}" style="display: none;">
                                                            <input type="text" name="P_name" required="" class="form-control" placeholder="Name" value="{{$patient->f_name}} {{$patient->m_name}} {{$patient->l_name}}" readonly="">
                                                        </div>
                                                        <label class="col-sm-2 control-label">O.R. No.</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" name="orno" class="form-control" placeholder="O.R. No." autocomplete="off" value="{{$receipt_number}}" readonly="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group divxrayinfo">
                                                        <label class="col-sm-1 control-label">Address:</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" name="address" required="" class="form-control" placeholder="Address" value="{{$patient->address}}" readonly="">
                                                        </div>
                                                        <label class="col-sm-2 control-label">Sex:</label>
                                                        <div class="col-sm-3">
                                                            <select id="agesex" name="agesex" class="form-control" required="" disabled=""> 
                                                                <option value="{{$patient->gender}}" selected="">{{$patient->gender}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group divxrayinfo">
                                                        <label class="col-sm-1 control-label">Physician:</label>
                                                        <div class="col-sm-6">
                                                            <select id="physician" name="physician" class="form-control physician">
                                                                @if(Session::get('position') == "Doctor")
                                                                    @foreach($doctor as $doc)
                                                                    @if(Session::get('user') == $doc->id)
                                                                            <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}" selected="">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @endif
                                                                @endforeach
                                                                @else
                                                                    <option value="">-- Select One --</option>
                                                                    @foreach($doctor as $doc)
                                                                            <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <label class="col-sm-2 control-label">Date:</label>
                                                        <div class="col-sm-3">
                                                        <?php $datenow = date("Y-m-d"); ?>
                                                            <input type="text" id="datepicker" name="ultrasounddate" class="form-control ultrasounddate" required="" value="{{$datenow}}" disabled="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group divxrayinfo">
                                                        <label class="col-sm-1 control-label">Service(s)</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" name="ultraservice" class="form-control ultraservice" placeholder="Service(s)" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <!-- <div class="form-group divxrayinfo">
                                                        <label class="col-sm-1 control-label">Phys.Fee:</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" name="pfee" class="form-control pfee" placeholder="0.00" required="" autocomplete="off">
                                                        </div>
                                                    </div> -->

                                                    <h5><b>Result / Finding :</b></h5>

                                                    <div class="form-group divxrayinfo">
                                                        <div class="col-sm-6">
                                                            <div class="checkbox">
                                                                <label><input type="checkbox" name="finding" checked="" value="Normal" class="noramlfinding_ULTRA">Normal</label>
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <label><input type="checkbox" value="Not Normal" class="notnoramlfinding_ULTRA">Not Normal</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                            
                                                    <div class="form-group divxrayinfo">
                                                        <div class="col-sm-12 fnnormal_ULTRA">
                                                            <textarea class="form-control txtcommnor_ULTRA" name="comm" rows="5" id="comment"></textarea>
                                                        </div>
                                                        <div class="col-sm-12 fnnotnormal_ULTRA" style="display: none;">
                                                            <textarea class="form-control txtcommnotnor_ULTRA" rows="5" id="comment"></textarea>
                                                        </div>
                                                    </div>

                                                    <!-- <div class="form-group phyname divxrayinfo"></div>
                                                    <div class="form-group phypos"></div> -->

                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="control-label"></label>
                                                        <div class="col-sm-3">
                                                            <button class="btn btn-primary btn-xs" id="btn-submit-social_history" type="submit">Submit</button>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Ultrasound EDIT MODAL -->
                        <div class="modal fade" id="modal_ultrasoundnew_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog modalwidth" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <div class="col-md-12">
                                                <center><h3 class="neg">NEGROS FAMILY HEALTH SERVICES INC.</h3></center>
                                                <center><p class="nor">North Road, Daro(in front of NOPH) Dumaguete City, Negros Oriental</p></center>
                                                <center><p class="nor">Tel. No. (035) 225-3544</p></center>
                                                <h4><b>ULTRASOUND</b></h4>
                                                <form class="form-horizontal" method="POST" action="/visit/{{$patient->id}}/{{$vid}}/ultrasoundedit">
                                                {!! csrf_field() !!}
                                                    <div class="form-group">
                                                        <label class="col-sm-1 control-label">Name:</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="ultrasound_id" name="ultrasound_id" value="" style="display:none;">
                                                            <input type="text" name="P_name_edit" required="" class="form-control" placeholder="Name" value="{{$patient->f_name}} {{$patient->m_name}} {{$patient->l_name}}" readonly="">
                                                        </div>
                                                        <label class="col-sm-2 control-label">O.R. No.</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" name="orno_edit_ultra" class="form-control orno_edit_ultra" placeholder="O.R. No." readonly="" value="{{$receipt_number}}" autocomplete="off">
                                                        </div>
                                                    </div>

                                                    <div class="form-group divxrayinfo">
                                                        <label class="col-sm-1 control-label">Address:</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" name="address_edit" required="" class="form-control" placeholder="Address" value="{{$patient->address}}" readonly="">
                                                        </div>
                                                        <label class="col-sm-2 control-label">Sex:</label>
                                                        <div class="col-sm-3">
                                                            <select id="agesex" name="agesex_edit" class="form-control" required="" disabled=""> 
                                                                <option value="{{$patient->gender}}" selected="">{{$patient->gender}}</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group divxrayinfo">
                                                        <label class="col-sm-1 control-label">Physician:</label>
                                                        <div class="col-sm-6">
                                                            <select id="physician" name="physician" class="form-control physician_edit_ultra">
                                                                @if(Session::get('position') == "Doctor")
                                                                    @foreach($doctor as $doc)
                                                                    @if(Session::get('user') == $doc->id)
                                                                            <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}" selected="">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                        @endif
                                                                @endforeach
                                                                @else
                                                                    <option value="">-- Select One --</option>
                                                                    @foreach($doctor as $doc)
                                                                            <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}">{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <label class="col-sm-2 control-label">Date:</label>
                                                        <div class="col-sm-3">
                                                            <?php $datenow = date("Y-m-d"); ?>
                                                            <input type="text" name="ultrasound_edit_date" class="form-control ultrasound_edit_date" value="{{$datenow}}" disabled="">
                                                        </div>
                                                    </div>

                                                    <div class="form-group divxrayinfo">
                                                        <label class="col-sm-1 control-label">Service(s)</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" name="ultraservice" class="form-control ultraservice_edit" placeholder="Service(s)" autocomplete="off">
                                                        </div>
                                                    </div>

                                                    <!-- <div class="form-group divxrayinfo">
                                                        <label class="col-sm-1 control-label">Phys.Fee:</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" name="phyfee_edit_ultra" class="form-control phyfee_edit_ultra" placeholder="0.00" required="" autocomplete="off">
                                                        </div>
                                                    </div> -->

                                                    <h5><b>Result / Finding :</b></h5>

                                                    <div class="form-group divxrayinfo">
                                                        <div class="col-sm-6">
                                                            <div class="checkbox results_edit_ultra"></div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group divxrayinfo results_info_edit_ultra"></div>

                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="control-label"></label>
                                                        <div class="col-sm-3">
                                                            <button class="btn btn-primary btn-xs" id="btn-submit-social_history" type="submit">Save Changes</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Ultrasound LOGS MODAL -->
                        <div class="modal fade" id="modal_patientultrasoundlog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th class="text-center">Date</th>
                                                        <th class="text-center">Physician</th>
                                                        <th class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="ultrasoundlogs">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- END MODAL -->
                        
                    </div>

            </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
    <!-- /.content-wrapper -->

    @include('adminlte::layouts.partials.controlsidebar')

    <footer class="main-footer">
        <div style="text-align: right;">
           <b>Powered by</b> <a href="http://www.inovenzo.com" target="_blank">Inovenzo</a> <img src="{{ asset('/img/LOGO.png') }}" height="30" width="30">
        </div> 
    </footer>

</div><!-- ./wrapper -->
</div>
@section('scripts')
    @include('adminlte::layouts.partials.scripts')

    <script type="text/javascript">
    $(document).ready(function() {
        setTimeout(function(){ 
            $('.topmessage').hide();
        }, 2000);
        $('.pfee').keypress(function(e) {
                var a = [46];
                var k = e.which;
                console.log( k );
                for (i = 48; i < 58; i++)
                    a.push(i);
    
                 if (!($.inArray(k,a)>=0))
                    e.preventDefault();
            });
        $('.pfee').change(function() {
            var aa = $(this).val();
            var bbaa = aa.replace(/,/g , '');
            $(this).val( bbaa.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") );
        })

        if ('{{$patient->status}}' == 'Done') {
            $('button').attr("disabled", "disabled");
            $('.genrx').attr("onclick","return false;")
        }
    })

    $('.stopalpha').keypress(function(event) {
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });

    $(".xraydate").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: "1950:2050",
        changeYear: true,
        changeMonth: true,
    });

    $(".dob").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: "1950:2050",
        changeYear: true,
        changeMonth: true,
        onSelect: function() {
                        var dob = $(this).val();
                        var datenow = new Date();
                        var birthDate = new Date(dob);
                        var years = (datenow.getFullYear() - birthDate.getFullYear());
                        $('.age').val(years);
                    }
    });

    $(".surgery_date").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: "1950:2050",
        changeYear: true,
        changeMonth: true,
    });

    $(".hospitalization_date").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: "1950:2050",
        changeYear: true,
        changeMonth: true,
    });

    $(".disease_date").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: "1950:2050",
        changeYear: true,
        changeMonth: true,
    });

    $(".vaccination_date").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: "1950:2050",
        changeYear: true,
        changeMonth: true,
    });

    $(".date_start").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: "1950:2050",
        changeYear: true,
        changeMonth: true,
    });

    $(".sero_date").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: "1950:2050",
        changeYear: true,
        changeMonth: true,
    });

    $(".ecg_date").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: "1950:2050",
        changeYear: true,
        changeMonth: true,
    });

    $(".chemtwo_date").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: "1950:2050",
        changeYear: true,
        changeMonth: true,
    });
    
    $('.noramlfinding').click(function() {
        if ($(this).is(':checked')) {
            $('.noramlfinding').attr('checked');
            $('.noramlfinding').attr('name','finding');

            $('.notnoramlfinding').prop('checked', false);
            $('.notnoramlfinding').removeAttr('name','finding');

            $('.fnnormal').show();
            $('.txtcommnor').attr('name','comm');

            $('.fnnotnormal').hide();
            $('.txtcommnotnor').removeAttr('name','comm');
        }
    });
    $('.notnoramlfinding').click(function() {
        if ($(this).is(':checked')) {
            $('.notnoramlfinding').attr('checked');
            $('.notnoramlfinding').attr('name','finding');

            $('.noramlfinding').prop('checked', false);
            $('.noramlfinding').removeAttr('name','finding');

            $('.fnnotnormal').show();
            $('.txtcommnotnor').attr('name','comm');

            $('.fnnormal').hide();
            $('.txtcommnor').removeAttr('name','comm');
        }
    });

    $('.noramlfinding_ULTRA').click(function() {
        if ($(this).is(':checked')) {
            $('.noramlfinding_ULTRA').attr('checked');
            $('.noramlfinding_ULTRA').attr('name','finding');

            $('.notnoramlfinding_ULTRA').prop('checked', false);
            $('.notnoramlfinding_ULTRA').removeAttr('name','finding');

            $('.fnnormal_ULTRA').show();
            $('.txtcommnor_ULTRA').attr('name','comm');

            $('.fnnotnormal_ULTRA').hide();
            $('.txtcommnotnor_ULTRA').removeAttr('name','comm');
        }
    });
    $('.notnoramlfinding_ULTRA').click(function() {
        if ($(this).is(':checked')) {
            $('.notnoramlfinding_ULTRA').attr('checked');
            $('.notnoramlfinding_ULTRA').attr('name','finding');

            $('.noramlfinding_ULTRA').prop('checked', false);
            $('.noramlfinding_ULTRA').removeAttr('name','finding');

            $('.fnnotnormal_ULTRA').show();
            $('.txtcommnotnor_ULTRA').attr('name','comm');

            $('.fnnormal_ULTRA').hide();
            $('.txtcommnor_ULTRA').removeAttr('name','comm');
        }
    });

    $( ".physician" ).change(function() {
        var dataid = $(this).find(':selected').data('id');
        var phy  = $(this).val();
        var phynamepos = dataid.split('-');
        var name = phynamepos[0];
        var pos = phynamepos[1];

        $('.phyname').empty();
        $('.phypos').empty();
        $('.phyname').append('<label class="col-sm-5 control-label" style="text-align: left;"><b>'+name+'</b></label>');
        $('.phypos').append('<label class="col-sm-5 control-label" style="text-align: left; margin-top: -3%; font-size: 8pt;">'+pos+'</label>');
    });

    $(document).ready(function() {
        var i;
        i = parseInt($('.counter:last').val());
    
    $('.add_surgery').click(function() {
        i = i + 1;
        $('.surgery-item').append('<div class="row">\
                            <div class="col-sm-3">\
                                <div class="form-group">\
                                    <input type="text" id="datepicker'+i+'" name="surgery_date" class="form-control surgery_date surdataid'+i+'" placeholder="YYYY-MM-DD" readonly="">\
                                    <input type="text" name="counter" class="counter" value="'+i+'" style="display: none;">\
                                </div>\
                            </div>\
                            <div class="col-sm-9">\
                                <div class="form-group">\
                                    <input class="form-control surgery_operation" name="surgery_operation" value="" type="text">\
                                </div>\
                            </div>\
                        </div>');
        $(".surgery_date").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: "1950:2050",
        changeYear: true,
        changeMonth: true,
    });
    });


    var x;
    x = parseInt($('.counter2:last').val());

    $('.add_hospitalization').click(function() {
        x = x + 1;
        $('.hospitalization-item').append('<div class="row">\
                        <div class="col-sm-3">\
                            <div class="form-group">\
                                <input type="text" id="hospitalization_date'+x+'" name="hospitalization_date" class="form-control hospitalization_date hosdataid'+x+'" placeholder="YYYY-MM-DD" readonly="">\
                                <input type="text" name="counter2" class="counter2" value="'+x+'" style="display: none;">\
                            </div>\
                        </div>\
                        <div class="col-sm-9">\
                            <div class="form-group">\
                                <textarea class="form-control hospitalization_diagnosis"></textarea>\
                            </div>\
                        </div>\
                    </div>');
        $(".hospitalization_date").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: "1950:2050",
        changeYear: true,
        changeMonth: true,
    });
    });


    var y;
    y = parseInt($('.counter3:last').val());
    $('.add_disease').click(function() {
        y = y + 1;
        $('.disease-item').append('<div class="row">\
                        <div class="col-sm-3">\
                            <div class="form-group">\
                                <input type="text" id="disease_date'+y+'" name="disease_date" class="form-control disease_date disdataid'+y+'" placeholder="YYYY-MM-DD" readonly="">\
                                <input type="text" name="counter3" class="counter3" value="'+y+'" style="display: none;">\
                            </div>\
                        </div>\
                        <div class="col-sm-9">\
                            <div class="form-group">\
                                <input class="form-control disease" name="disease" value="" type="text">\
                            </div>\
                        </div>\
                    </div>');
        $(".disease_date").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: "1950:2050",
        changeYear: true,
        changeMonth: true,
    });
    });


    var z;
    z = parseInt($('.counter4:last').val());
    $('.add_vaccination').click(function() {
        z = z + 1;
        $('.vaccination-item').append('<div class="row">\
                        <div class="col-sm-3">\
                            <div class="form-group">\
                                <input type="text" id="vaccination_date'+z+'" name="vaccination_date" class="form-control vaccination_date vaccdataid'+z+'" placeholder="YYYY-MM-DD" readonly="">\
                                <input type="text" name="counter4" class="counter4" value="'+z+'" style="display: none;">\
                            </div>\
                        </div>\
                        <div class="col-sm-9">\
                            <div class="form-group">\
                                <input class="form-control vaccination" name="vaccination" value="" type="text">\
                            </div>\
                        </div>\
                    </div>');
        $(".vaccination_date").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: "1950:2050",
        changeYear: true,
        changeMonth: true,
    });
    });

    })
    

    $('.surgery_check').click(function() {
        if ($(this).is(':checked')) {
            $('.surgery_list').show();
        }
        else {
            $('.surgery_list').hide();
        }
    });
    $('.PR_check').click(function() {
        if ($(this).is(':checked')) {
            $('.hospitalization_list').show();
        }
        else {
            $('.hospitalization_list').hide();
        }
    });
    $('.DD_check').click(function() {
        if ($(this).is(':checked')) {
            $('.disease_list').show();
        }
        else {
            $('.disease_list').hide();
        }
    });
    $('.vaccine_check').click(function() {
        if ($(this).is(':checked')) {
            $('.vaccination_list').show();
        }
        else {
            $('.vaccination_list').hide();
        }
    });

    $('.allergies').on('change',function() {
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;
        if (valueSelected == "Yes") {
            $('.allergies_list').show();
        }
        else {
            $('.allergies_list').hide();
        }
    })
    $('.drink_alcohol').on('change',function() {
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;
        if (valueSelected == "Yes") {
            $('.how_much_drink').show();
        }
        else {
            $('.how_much_drink').hide();
        }
    })
    $('.smoke').on('change',function() {
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;
        if (valueSelected == "Yes") {
            $('.packs').show();
        }
        else {
            $('.packs').hide();
        }
    })

    $('.editpatientxray').on('click',function() {
        var dataid = $(this).data('id');
        $('.physician_edit option[value=""]').prop("selected", true);
        $('.results_edit').empty();
        $('.results_info_edit').empty();
        $('.phyname').empty();
        $('.phypos').empty();
        $('.xray_id').removeAttr('value');
        //$('.orno_edit').removeAttr('value');
        $('.pfee_edit').removeAttr('value');
        $('.plate_edit').removeAttr('value');
        $.get('../../api/modalxrayedit?dataid=' + dataid, function(data){
            $('.xray_id').attr('value',data.xray_id);
            //$('.orno_edit').attr('value',data.or_no);
            if (!data.xray_date) {
            }
            else {
                $('.xraydate_edit').val(data.xray_date);
            }
            $('.pfee_edit').val(data.phy_fee);
            $('.plate_edit').val(data.plate);
            $('.physician_edit option[value="'+data.id+'"]').prop("selected", true);
            //$('.physician_edit').append('<option>'+data.f_name+' '+data.m_name+' '+data.l_name+', '+data.credential+'</option>');

            $('.phyname').append('<label class="col-sm-5 control-label" style="text-align: left;"><b>'+data.f_name+' '+data.m_name+' '+data.l_name+', '+data.credential+'</b></label>');
            $('.phypos').append('<label class="col-sm-5 control-label" style="text-align: left; margin-top: -2.5%; font-size: 8pt;">'+data.specialization+'</label>');

            if (data.finding == "Normal") {
                $('.results_edit').append('<label>\
                <input type="checkbox" name="finding" checked="" value="Normal" class="noramlfinding">\
                Normal</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\
                <label><input type="checkbox" value="Not Normal" class="notnoramlfinding">Not Normal</label>');

                $('.results_info_edit').append('<div class="col-sm-12 fnnormal">\
                    <textarea class="form-control txtcommnor" name="comm" rows="5" id="comment">'+data.finding_info+'</textarea>\
                </div>\
                <div class="col-sm-12 fnnotnormal" style="display: none;">\
                    <textarea class="form-control txtcommnotnor" rows="5" id="comment"></textarea>\
                </div>');
            }
            else if (data.finding == "Not Normal") {
                $('.results_edit').append('<label>\
                <input type="checkbox" name="finding" value="Normal" class="noramlfinding">\
                Normal</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\
                <label><input type="checkbox" checked="" value="Not Normal" class="notnoramlfinding">Not Normal</label>');

                $('.results_info_edit').append('<div class="col-sm-12 fnnormal" style="display: none;">\
                    <textarea class="form-control txtcommnor" name="comm" rows="5" id="comment"></textarea>\
                </div>\
                <div class="col-sm-12 fnnotnormal">\
                    <textarea class="form-control txtcommnotnor" rows="5" id="comment">'+data.finding_info+'</textarea>\
                </div>');
            }
            else {
                $('.results_edit').append('<label>\
                <input type="checkbox" name="finding" value="Normal" class="noramlfinding">\
                Normal</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\
                <label><input type="checkbox" value="Not Normal" class="notnoramlfinding">Not Normal</label>');

                $('.results_info_edit').append('<div class="col-sm-12 fnnormal" style="display: none;">\
                    <textarea class="form-control txtcommnor" name="comm" rows="5" id="comment"></textarea>\
                </div>\
                <div class="col-sm-12 fnnotnormal">\
                    <textarea class="form-control txtcommnotnor" rows="5" id="comment"></textarea>\
                </div>');
            }

            $('.noramlfinding').click(function() {
            if ($(this).is(':checked')) {
            $('.noramlfinding').attr('checked');
            $('.noramlfinding').attr('name','finding');

            $('.notnoramlfinding').prop('checked', false);
            $('.notnoramlfinding').removeAttr('name','finding');

            $('.fnnormal').show();
            $('.txtcommnor').attr('name','comm');

            $('.fnnotnormal').hide();
            $('.txtcommnotnor').removeAttr('name','comm');
            }
            });
            $('.notnoramlfinding').click(function() {
            if ($(this).is(':checked')) {
            $('.notnoramlfinding').attr('checked');
            $('.notnoramlfinding').attr('name','finding');

            $('.noramlfinding').prop('checked', false);
            $('.noramlfinding').removeAttr('name','finding');

            $('.fnnotnormal').show();
            $('.txtcommnotnor').attr('name','comm');

            $('.fnnormal').hide();
            $('.txtcommnor').removeAttr('name','comm');
            }
            });
        })
    })

    $('.submit_RFC').on('click',function() {
        var RFCpatient_id = $('.RFCpatient_id').val();
        var RFCvisit_id = $('.RFCvisit_id').val();
        var chief_complaint = $('.chief_complaint').val();
        var history_illness = $('.history_illness').val();
        if (chief_complaint == "" && history_illness == "") {
            alert('Please Fill Up the Form.');
        }
        else {
            $.get('../../api/addreasonforconsulation?patient_id=' + RFCpatient_id + '&visit_id=' + RFCvisit_id + '&chief_complaint=' + chief_complaint + '&history_illness=' + history_illness, function(data){
            $('.RFC_id').val(data.id);
            $('.subsubRFC').empty();
            $('.subsubRFC').append('<button class="btn btn-xs btn-primary edit_RFC" id="btn-submit-consult_reason" type="button">Save Changes</button>');

            $('.topmessage2').empty();
            $('.topmessage2').show();
            $('.topmessage2').append('<p class="alert alert-success" style="padding:.5px;height:22px; width:40.5%; margin-top: 2.1%">Successfully Created.</p>');
            setTimeout(function(){ 
                $('.topmessage2').hide();
            }, 2000);

            });
        }
    });

     $('.edit_RFC').on('click',function() {
        var RFC_id = $('.RFC_id').val();
        var chief_complaint = $('.chief_complaint').val();
        var history_illness = $('.history_illness').val();
        $.get('../../api/editreasonforconsulation?RFC_id=' + RFC_id + '&chief_complaint=' + chief_complaint + '&history_illness=' + history_illness, function(data){

            $('.topmessage2').empty();
            $('.topmessage2').show();
            $('.topmessage2').append('<p class="alert alert-success" style="padding:.5px;height:22px; width:40.5%; margin-top: 2.1%">Successfully Edited.</p>');
            setTimeout(function(){ 
                $('.topmessage2').hide();
            }, 2000);

        });
     });

     $('.medical_history').on('click',function() {
        var PMH_patient_id = $('.PMH_patient_id').val();
        var PMH_visit_id = $('.PMH_visit_id').val();
        if ($('.surgery_check').is(':checked')) {
            var surgery_check = "Yes";
        }
        else {
            var surgery_check = "No";
        }

        if ($('.hypertension').is(':checked')) {
            var hypertension = "Yes";
        }
        else {
            var hypertension = "No";
        }

        if ($('.diabetes').is(':checked')) {
            var diabetes = "Yes";
        }
        else {
            var diabetes = "No";
        }

        if ($('.PR_check').is(':checked')) {
            var PR_check = "Yes";
        }
        else {
            var PR_check = "No";
        }

        if ($('.DD_check').is(':checked')) {
            var DD_check = "Yes";
        }
        else {
            var DD_check = "No";
        }

        if ($('.vaccine_check').is(':checked')) {
            var vaccine_check = "Yes";
        }
        else {
            var vaccine_check = "No";
        }

        $.get('../../api/addpastmedicalhistory?PMH_patient_id=' + PMH_patient_id + '&PMH_visit_id=' + PMH_visit_id + '&surgery=' + surgery_check + '&hypertension=' + hypertension + '&diabetes=' + diabetes + '&PR_check=' + PR_check + '&DD_check=' + DD_check + '&vaccine_check=' + vaccine_check, function(data){
            $('.PMH_id').attr('value',data.id);
            $('.medical_history').hide();
            $('.edit_medical_history').show();

            if (surgery_check == "Yes") {
                $('.surgery_date').each(function() {
                    var PMH_id = data.id;
                    var truedate = $(this).parent().parent().parent().find('.surgery_date').val();
                    var counter = $(this).parent().parent().parent().find('.counter').val();
                    var operation = $(this).parent().parent().parent().find('.surgery_operation').val();
                    if (!truedate) {}
                        else{
                                $.get('../../api/addsurgery?PMH_id=' + PMH_id + '&sur_date=' + truedate + '&operation=' + operation + '&counter=' + counter, function(data1){
                                });        
                            }   
                });
            }

            if (PR_check == "Yes") {
                $('.hospitalization_date').each(function() {
                    var PMH_id = data.id;
                    var truedate = $(this).parent().parent().parent().find('.hospitalization_date').val();
                    var counter2 = $(this).parent().parent().parent().find('.counter2').val();
                    var diagnosis = $(this).parent().parent().parent().find('.hospitalization_diagnosis').val();
                    if (!truedate) {}
                    else{
                        $.get('../../api/addhospitalization?PMH_id=' + PMH_id + '&hos_date=' + truedate + '&diagnosis=' + diagnosis + '&counter2=' + counter2, function(data2){
                        });
                    }
                });
            }

            if (DD_check == "Yes") {
                $('.disease_date').each(function() {
                    var PMH_id = data.id;
                    var truedate = $(this).parent().parent().parent().find('.disease_date').val();
                    var counter3 = $(this).parent().parent().parent().find('.counter3').val();
                    var disease = $(this).parent().parent().parent().find('.disease').val();
                    if (!truedate) {}
                    else{
                        $.get('../../api/adddisease?PMH_id=' + PMH_id + '&dis_date=' + truedate + '&disease=' + disease + '&counter3=' + counter3, function(data3){
                        });
                    }
                });
            }

            if (vaccine_check == "Yes") {
                $('.vaccination_date').each(function() {
                    var PMH_id = data.id;
                    var truedate = $(this).parent().parent().parent().find('.vaccination_date').val();
                    var counter4 = $(this).parent().parent().parent().find('.counter4').val();
                    var vaccination = $(this).parent().parent().parent().find('.vaccination').val();
                    if (!truedate) {}
                    else{
                        $.get('../../api/addvaccination?PMH_id=' + PMH_id + '&vac_date=' + truedate + '&vaccination=' + vaccination + '&counter4=' + counter4, function(data4){
                        });
                    }
                });
            }

            $('.topmessage3').empty();
            $('.topmessage3').show();
            $('.topmessage3').append('<p class="alert alert-success" style="padding:.5px;height:22px; width:40.5%; margin-top: 2.1%">Successfully Created.</p>');
            setTimeout(function(){ 
                $('.topmessage3').hide();
            }, 2000);

        });

     });

    $('.edit_medical_history').on('click',function() {
        var PMH_patient_id = $('.PMH_patient_id').val();
        var PMH_visit_id = $('.PMH_visit_id').val();
        var PMH_id = $('.PMH_id').val();

        if ($('.surgery_check').is(':checked')) {
            var surgery_check = "Yes";
        }
        else {
            var surgery_check = "No";
        }

        if ($('.hypertension').is(':checked')) {
            var hypertension = "Yes";
        }
        else {
            var hypertension = "No";
        }

        if ($('.diabetes').is(':checked')) {
            var diabetes = "Yes";
        }
        else {
            var diabetes = "No";
        }

        if ($('.PR_check').is(':checked')) {
            var PR_check = "Yes";
        }
        else {
            var PR_check = "No";
        }

        if ($('.DD_check').is(':checked')) {
            var DD_check = "Yes";
        }
        else {
            var DD_check = "No";
        }

        if ($('.vaccine_check').is(':checked')) {
            var vaccine_check = "Yes";
        }
        else {
            var vaccine_check = "No";
        }

        $.get('../../api/editpastmedicalhistory?PMH_id=' + PMH_id + '&surgery=' + surgery_check + '&hypertension=' + hypertension + '&diabetes=' + diabetes + '&PR_check=' + PR_check + '&DD_check=' + DD_check + '&vaccine_check=' + vaccine_check, function(data){

            if (surgery_check == "Yes") {
                $('.surgery_date').each(function() {
                    var PMH_id = data.id;
                    var truedate = $(this).parent().parent().parent().find('.surgery_date').val();
                    var counter = $(this).parent().parent().parent().find('.counter').val();
                    var operation = $(this).parent().parent().parent().find('.surgery_operation').val();
                    if (!truedate) {}
                        else{
                                $.get('../../api/addsurgery?PMH_id=' + PMH_id + '&sur_date=' + truedate + '&operation=' + operation + '&counter=' + counter, function(data1){
                                });        
                            }   
                });
            }

            if (PR_check == "Yes") {
                $('.hospitalization_date').each(function() {
                    var PMH_id = data.id;
                    var truedate = $(this).parent().parent().parent().find('.hospitalization_date').val();
                    var counter2 = $(this).parent().parent().parent().find('.counter2').val();
                    var diagnosis = $(this).parent().parent().parent().find('.hospitalization_diagnosis').val();
                    if (!truedate) {}
                    else{
                        $.get('../../api/addhospitalization?PMH_id=' + PMH_id + '&hos_date=' + truedate + '&diagnosis=' + diagnosis + '&counter2=' + counter2, function(data2){
                        });
                    }
                });
            }

            if (DD_check == "Yes") {
                $('.disease_date').each(function() {
                    var PMH_id = data.id;
                    var truedate = $(this).parent().parent().parent().find('.disease_date').val();
                    var counter3 = $(this).parent().parent().parent().find('.counter3').val();
                    var disease = $(this).parent().parent().parent().find('.disease').val();
                    if (!truedate) {}
                    else{
                        $.get('../../api/adddisease?PMH_id=' + PMH_id + '&dis_date=' + truedate + '&disease=' + disease + '&counter3=' + counter3, function(data3){
                        });
                    }
                });
            }

            if (vaccine_check == "Yes") {
                $('.vaccination_date').each(function() {
                    var PMH_id = data.id;
                    var truedate = $(this).parent().parent().parent().find('.vaccination_date').val();
                    var counter4 = $(this).parent().parent().parent().find('.counter4').val();
                    var vaccination = $(this).parent().parent().parent().find('.vaccination').val();
                    if (!truedate) {}
                    else{
                        $.get('../../api/addvaccination?PMH_id=' + PMH_id + '&vac_date=' + truedate + '&vaccination=' + vaccination + '&counter4=' + counter4, function(data4){
                        });
                    }
                });
            }

            $('.topmessage3').empty();
            $('.topmessage3').show();
            $('.topmessage3').append('<p class="alert alert-success" style="padding:.5px;height:22px; width:40.5%; margin-top: 2.1%">Successfully Edited.</p>');
            setTimeout(function(){ 
                $('.topmessage3').hide();
            }, 2000);

        });

     });
    
    $('.addsocial_history').on('click',function() {
        var SH_id = $('.SH_id').val();
        var SH_patient_id = $('.SH_patient_id').val();
        var SH_visit_id = $('.SH_visit_id').val();
        var allergies = $('.allergies').val();
        var allergies_list = $('.allergies_list').val();
        var drink_alcohol = $('.drink_alcohol').val();
        var how_much_drink = $('.how_much_drink').val();
        var smoke = $('.smoke').val();
        var packs = $('.packs').val();

        $.get('../../api/addsocialhistory?SH_id=' + SH_id + '&SH_patient_id=' + SH_patient_id + '&SH_visit_id=' + SH_visit_id + '&allergies=' + allergies + '&allergies_list=' + allergies_list + '&drink_alcohol=' + drink_alcohol + '&how_much_drink=' + how_much_drink + '&smoke=' + smoke + '&packs=' + packs, function(data){
            $('.addsocial_history').html('Save Changes');
            $('.SH_id').attr('value',data.id);
            
            if (!SH_id) {
                $('.topmessage4').empty();
                $('.topmessage4').show();
                $('.topmessage4').append('<p class="alert alert-success" style="padding:.5px;height:22px; width:40.5%; margin-top: 2.1%">Successfully Created.</p>');
                setTimeout(function(){ 
                    $('.topmessage4').hide();
                }, 2000);
            }
            else {
                $('.topmessage4').empty();
                $('.topmessage4').show();
                $('.topmessage4').append('<p class="alert alert-success" style="padding:.5px;height:22px; width:40.5%; margin-top: 2.1%">Successfully Edited.</p>');
                setTimeout(function(){ 
                    $('.topmessage4').hide();
                }, 2000);
            }

        });
    })

    $('.addphysical_exam').on('click',function() {
        var PE_id = $('.PE_id').val();
        var PE_patient_id = $('.PE_patient_id').val();
        var PE_visit_id = $('.PE_visit_id').val();
        var gen_survey = $('.gen_survey').val();
        var bp = $('.bp').val();
        var hr = $('.hr').val();
        var rr = $('.rr').val();
        var temp = $('.temp').val();
        var head = $('.head').val();
        var neck = $('.neck').val();
        var chest_lungs = $('.chest_lungs').val();
        var heart = $('.heart').val();
        var abdomen = $('.abdomen').val();
        var back = $('.back').val();
        var extremities = $('.extremities').val();
        var neuro_exam = $('.neuro_exam').val();

        $.get('../../api/addphysicalexam?PE_id=' + PE_id + '&PE_patient_id=' + PE_patient_id + '&PE_visit_id=' + PE_visit_id + '&gen_survey=' + gen_survey + '&bp=' + bp + '&hr=' + hr + '&rr=' + rr + '&temp=' + temp + '&head=' + head + '&neck=' + neck + '&chest_lungs=' + chest_lungs + '&heart=' + heart + '&abdomen=' + abdomen + '&back=' + back + '&extremities=' + extremities + '&neuro_exam=' + neuro_exam, function(data){
            $('.addphysical_exam').html('Save Changes');
            $('.PE_id').attr('value',data.id);

            if (!PE_id) {
                $('.topmessage5').empty();
                $('.topmessage5').show();
                $('.topmessage5').append('<p class="alert alert-success" style="padding:.5px;height:22px; width:40.5%; margin-top: 2.1%">Successfully Created.</p>');
                setTimeout(function(){ 
                    $('.topmessage5').hide();
                }, 2000);
            }
            else {
                $('.topmessage5').empty();
                $('.topmessage5').show();
                $('.topmessage5').append('<p class="alert alert-success" style="padding:.5px;height:22px; width:40.5%; margin-top: 2.1%">Successfully Edited.</p>');
                setTimeout(function(){ 
                    $('.topmessage5').hide();
                }, 2000);
            }

        });
    })

    $('.adddiagnosis').on('click',function() {
        var diag_id = $('.diag_id').val();
        var diag_patient_id = $('.diag_patient_id').val();
        var diag_visit_id = $('.diag_visit_id').val();
        var diagnosis = $('.diagnosis').val();

        $.get('../../api/adddiagnosis?diag_id=' + diag_id + '&diag_patient_id=' + diag_patient_id + '&diag_visit_id=' + diag_visit_id + '&diagnosis=' + diagnosis, function(data){
            $('.adddiagnosis').html('Save Changes');
            $('.diag_id').attr('value',data.id);

            if (!diag_id) {
                $('.topmessage6').empty();
                $('.topmessage6').show();
                $('.topmessage6').append('<p class="alert alert-success" style="padding:.5px;height:22px; width:40.5%; margin-top: 2.1%">Successfully Created.</p>');
                setTimeout(function(){ 
                    $('.topmessage6').hide();
                }, 2000);
            }
            else {
                $('.topmessage6').empty();
                $('.topmessage6').show();
                $('.topmessage6').append('<p class="alert alert-success" style="padding:.5px;height:22px; width:40.5%; margin-top: 2.1%">Successfully Edited.</p>');
                setTimeout(function(){ 
                    $('.topmessage6').hide();
                }, 2000);
            }

        });
    })

    $('.addplan').on('click',function() {
        var plan_id = $('.plan_id').val();
        var plan_patient_id = $('.plan_patient_id').val();
        var plan_visit_id = $('.plan_visit_id').val();
        var plan = $('.plan').val();

        $.get('../../api/addplan?plan_id=' + plan_id + '&plan_patient_id=' + plan_patient_id + '&plan_visit_id=' + plan_visit_id + '&plan=' + plan, function(data){
            $('.addplan').html('Save Changes');
            $('.plan_id').attr('value',data.id);

            if (!plan_id) {
                $('.topmessage7').empty();
                $('.topmessage7').show();
                $('.topmessage7').append('<p class="alert alert-success" style="padding:.5px;height:22px; width:40.5%; margin-top: 2.1%">Successfully Created.</p>');
                setTimeout(function(){ 
                    $('.topmessage7').hide();
                }, 2000);
            }
            else {
                $('.topmessage7').empty();
                $('.topmessage7').show();
                $('.topmessage7').append('<p class="alert alert-success" style="padding:.5px;height:22px; width:40.5%; margin-top: 2.1%">Successfully Edited.</p>');
                setTimeout(function(){ 
                    $('.topmessage7').hide();
                }, 2000);
            }

        });
    })

    $('.patientxraylog').on('click',function() {
        var dataid = $(this).data('id');
        $.get('../../api/xraylogs?dataid=' + dataid, function(data){
            $('.xraylogs').empty();
            $.each(data, function(index, logsss){
                $('.xraylogs').append('<tr>\
                                <td>'+logsss.id+'</td>\
                                <td class="text-center">'+logsss.date+'</td>\
                                <td class="text-center">'+logsss.doctor.f_name+' '+logsss.doctor.m_name+' '+logsss.doctor.l_name+', '+logsss.doctor.credential+'</td>\
                                <td class="text-center">'+logsss.action+'</td>\
                                </tr>');
            });
        });
    })

    $('.physical').click(function() {
        if ($(this).is(':checked')) {
            $('.color').removeAttr('readonly','readonly');
            $('.transparency').removeAttr('readonly','readonly');
            $('.SG').removeAttr('readonly','readonly');
        }
        else {
            $('.color').attr('readonly','readonly');
            $('.transparency').attr('readonly','readonly');
            $('.SG').attr('readonly','readonly');
        }
    });

    $('.microscopic').click(function() {
        if ($(this).is(':checked')) {
            $('.wbc').removeAttr('readonly','readonly');
            $('.rbc').removeAttr('readonly','readonly');
            $('.EC').removeAttr('readonly','readonly');
            $('.bacteria').removeAttr('readonly','readonly');
            $('.cast').removeAttr('readonly','readonly');
            $('.cast2').removeAttr('readonly','readonly');
            $('.crystal').removeAttr('readonly','readonly');
            $('.crystal2').removeAttr('readonly','readonly');
            $('.AM').removeAttr('readonly','readonly');
            $('.MT').removeAttr('readonly','readonly');
            $('.others').removeAttr('readonly','readonly');
            $('.others2').removeAttr('readonly','readonly');
            $('.others3').removeAttr('readonly','readonly');
        }
        else {
            $('.wbc').attr('readonly','readonly');
            $('.rbc').attr('readonly','readonly');
            $('.EC').attr('readonly','readonly');
            $('.bacteria').attr('readonly','readonly');
            $('.cast').attr('readonly','readonly');
            $('.cast2').attr('readonly','readonly');
            $('.crystal').attr('readonly','readonly');
            $('.crystal2').attr('readonly','readonly');
            $('.AM').attr('readonly','readonly');
            $('.MT').attr('readonly','readonly');
            $('.others').attr('readonly','readonly');
            $('.others2').attr('readonly','readonly');
            $('.others3').attr('readonly','readonly');
        }
    });

    $('.chemical').click(function() {
        if ($(this).is(':checked')) {
            $('.glucose').removeAttr('readonly','readonly');
            $('.bilirubin').removeAttr('readonly','readonly');
            $('.ketone').removeAttr('readonly','readonly');
            $('.blood').removeAttr('readonly','readonly');
            $('.ph').removeAttr('readonly','readonly');
            $('.protein').removeAttr('readonly','readonly');
            $('.urobilingen').removeAttr('readonly','readonly');
            $('.nitrites').removeAttr('readonly','readonly');
            $('.leucocytes').removeAttr('readonly','readonly');
        }
        else {
            $('.glucose').attr('readonly','readonly');
            $('.bilirubin').attr('readonly','readonly');
            $('.ketone').attr('readonly','readonly');
            $('.blood').attr('readonly','readonly');
            $('.ph').attr('readonly','readonly');
            $('.protein').attr('readonly','readonly');
            $('.urobilingen').attr('readonly','readonly');
            $('.nitrites').attr('readonly','readonly');
            $('.leucocytes').attr('readonly','readonly');
        }
    });
    $('.preg_test').click(function() {
        if ($(this).is(':checked')) {
            $('.preg_remarks').removeAttr('disabled','disabled');
        }
        else {
            $('.preg_remarks').attr('disabled','disabled');
        }
    });

    $('.editpatienturinalysis').on('click',function() {
        var uri_id = $(this).data('id');
        $.get('../../api/editurinalysis?uri_id=' + uri_id, function(data){
            $('.uri_id').removeAttr('value');
            $('.uri_orno').removeAttr('value');
            $('.uri_physician').empty();
            $('.uri_date').removeAttr('value');

            $('.uri_id').attr('value',data.id);
            $('.uri_orno').attr('value',data.or_no);
            $('.uri_orno').attr('readonly','readonly');
            $('.uri_physician').append('<option>'+data.phy.f_name+' '+data.phy.m_name+' '+data.phy.l_name+', '+data.phy.credential+'</option>');
            $('.uri_physician').attr('disabled','disabled');
            $('.uri_date').attr('value',data.date);

            if (data.physical == "Yes") {
                $('.physical').attr('checked','checked');
                $('.color').removeAttr('value');
                $('.transparency').removeAttr('value');
                $('.SG').removeAttr('value');

                $('.color').attr('value',data.color);
                $('.transparency').attr('value',data.transparency);
                $('.SG').attr('value',data.specific_gravity);
            }
            else {
                $('.physical').removeAttr('checked','checked');
                $('.color').attr('readonly','readonly');
                $('.transparency').attr('readonly','readonly');
                $('.SG').attr('readonly','readonly');
            }

            if (data.microscopic == "Yes") {
                $('.microscopic').attr('checked','checked');
                $('.wbc').removeAttr('value');
                $('.rbc').removeAttr('value');
                $('.EC').removeAttr('value');
                $('.bacteria').removeAttr('value');
                $('.cast').removeAttr('value');
                $('.cast2').removeAttr('value');
                $('.crystal').removeAttr('value');
                $('.crystal2').removeAttr('value');
                $('.AM').removeAttr('value');
                $('.MT').removeAttr('value');
                $('.others').removeAttr('value');
                $('.others2').removeAttr('value');
                $('.others3').removeAttr('value');

                $('.wbc').attr('value',data.wbc);
                $('.rbc').attr('value',data.rbc);
                $('.EC').attr('value',data.epith_cell);
                $('.bacteria').attr('value',data.bacteria);
                $('.cast').attr('value',data.cast);
                $('.cast2').attr('value',data.cast2);
                $('.crystal').attr('value',data.crystal);
                $('.crystal2').attr('value',data.crystal2);
                $('.AM').attr('value',data.amorphous_material);
                $('.MT').attr('value',data.mucus_thread);
                $('.others').attr('value',data.other);
                $('.others2').attr('value',data.other2);
                $('.others3').attr('value',data.other3);
            }
            else {
                $('.microscopic').removeAttr('checked','checked');
                $('.wbc').attr('readonly','readonly');
                $('.rbc').attr('readonly','readonly');
                $('.EC').attr('readonly','readonly');
                $('.bacteria').attr('readonly','readonly');
                $('.cast').attr('readonly','readonly');
                $('.cast2').attr('readonly','readonly');
                $('.crystal').attr('readonly','readonly');
                $('.crystal2').attr('readonly','readonly');
                $('.AM').attr('readonly','readonly');
                $('.MT').attr('readonly','readonly');
                $('.others').attr('readonly','readonly');
                $('.others2').attr('readonly','readonly');
                $('.others3').attr('readonly','readonly');
            }

            if (data.chemical == "Yes") {
                $('.chemical').attr('checked','checked');
                $('.glucose').removeAttr('value');
                $('.bilirubin').removeAttr('value');
                $('.ketone').removeAttr('value');
                $('.blood').removeAttr('value');
                $('.ph').removeAttr('value');
                $('.protein').removeAttr('value');
                $('.urobilingen').removeAttr('value');
                $('.nitrites').removeAttr('value');
                $('.leucocytes').removeAttr('value');

                $('.glucose').attr('value',data.glucose);
                $('.bilirubin').attr('value',data.bilirubin);
                $('.ketone').attr('value',data.ketone);
                $('.blood').attr('value',data.blood);
                $('.ph').attr('value',data.ph);
                $('.protein').attr('value',data.protein);
                $('.urobilingen').attr('value',data.urobilinogen);
                $('.nitrites').attr('value',data.nitrites);
                $('.leucocytes').attr('value',data.leucocytes);
            }
            else {
                $('.chemical').removeAttr('checked','checked');
                $('.glucose').attr('readonly','readonly');
                $('.bilirubin').attr('readonly','readonly');
                $('.ketone').attr('readonly','readonly');
                $('.blood').attr('readonly','readonly');
                $('.ph').attr('readonly','readonly');
                $('.protein').attr('readonly','readonly');
                $('.urobilingen').attr('readonly','readonly');
                $('.nitrites').attr('readonly','readonly');
                $('.leucocytes').attr('readonly','readonly');
            }

            if (data.pregnancy_test == "Yes") {
                $('.preg_test').attr('checked','checked');
                $('.preg_remarks').empty();

                $('.preg_remarks').text(data.preg_remark);
            }
            else {
                $('.preg_test').removeAttr('checked','checked');
                $('.preg_remarks').attr('disabled','disabled');
            }

            $('.patho').append('<b style="text-decoration:underline;">'+data.phy.f_name+' '+data.phy.m_name+' '+data.phy.l_name+', '+data.phy.credential+'</b>');
            $('.uri_rmt').append('<b style="text-decoration:underline;">'+data.user.f_name+' '+data.user.m_name+' '+data.user.l_name+', '+data.user.credential+'</b>');
            

        })
    })

    $('.addmedication').on('click',function() {
        var med_id = $('.med_id').val();
        var patient_id = $('.med_patient_id').val();
        var visit_id = $('.med_visit_id').val();
        var date_start = $('.date_start').val();
        var med_drug = $('.med_drug').val();
        var med_frequency = $('.med_frequency').val();
        var med_quantity = $('.med_quantity').val();
        if (!med_drug) {
            $('.med_drug_err').show();
            $('.med_drug_err').append('Drug Name is Required.');
            setTimeout(function(){ 
                    $('.med_drug_err').hide();
                }, 2000);
        }
        else {
            $.get('../../api/modalmedication?patient_id=' + patient_id + '&visit_id=' + visit_id + '&date_start=' + date_start + '&med_drug=' + med_drug + '&med_frequency=' + med_frequency + '&med_quantity=' + med_quantity + '&med_id=' + med_id, function(data){
                if (!med_id) {
                    $('.medication_list2').append('<tr class="med_id_'+med_id+'">\
                        <td>'+data.date_start+'</td>\
                        <td>'+data.drug+'</td>\
                        <td>'+data.frequency+'</td>\
                        <td>'+data.quantity+'</td>\
                        <td>'+data.status+'</td>\
                        <td><button class="btn btn-xs btn-primary editmedication" data-toggle="modal" data-target="#modal_medication_add" data-med_id="'+data.id+'">Edit</button></td>\
                        </tr>');   
                }
                else {
                    $('.med_id_'+med_id+'').empty();
                    $('.med_id_'+med_id+'').append('<td>'+data.date_start+'</td>\
                        <td>'+data.drug+'</td>\
                        <td>'+data.frequency+'</td>\
                        <td>'+data.quantity+'</td>\
                        <td>'+data.status+'</td>\
                        <td><button class="btn btn-xs btn-primary editmedication" data-toggle="modal" data-target="#modal_medication_add" data-med_id="'+med_id+'">Edit</button></td>');

                    $('.editmedication').on('click',function() {
                        var med_id = $(this).data('med_id');
                        $.get('../../api/editmedication?med_id=' + med_id, function(data1){
                            $('.med_id').val(med_id);
                            $('.divdate_start').empty();
                            $('.divdate_start').append('<input type="text" id="date_start" name="date_start" class="form-control date_start" readonly="" required="" value="'+data1.date_start+'">');
                            $('.med_drug').val(data1.drug);
                            $('.med_frequency').val(data1.frequency);
                            $('.med_quantity').val(data1.quantity);
                            $(".date_start").datepicker({
                                dateFormat: "yy-mm-dd",
                                yearRange: "1950:2050",
                                changeYear: true,
                                changeMonth: true,
                            });
                        })
                    })

                }
            })
        }
            $('.divdate_start').empty();
            var myDate = new Date();
            var nowdate = myDate.getFullYear() + '-' + ( '0' + (myDate.getMonth()+1) ).slice( -2 ) + '-' + ( '0' + (myDate.getDate()) ).slice( -2 );
            $('.divdate_start').append('<input type="text" id="date_start" name="date_start" class="form-control date_start" readonly="" required="" value="'+nowdate+'">');
            $('.med_drug').val('');
            $('.med_frequency').val('');
            $('.med_quantity').val('');
            $( ".close_medication" ).trigger( "click" );
            $(".date_start").datepicker({
                dateFormat: "yy-mm-dd",
                yearRange: "1950:2050",
                changeYear: true,
                changeMonth: true,
            });
    })

    $('.addmedadd').on('click',function() {
        $('.divdate_start').empty();
        var myDate = new Date();
        var nowdate = myDate.getFullYear() + '-' + ( '0' + (myDate.getMonth()+1) ).slice( -2 ) + '-' + ( '0' + (myDate.getDate()) ).slice( -2 );
        $('.divdate_start').append('<input type="text" id="date_start" name="date_start" class="form-control date_start" readonly="" required="" value="'+nowdate+'">');
        $('.med_drug').val('');
        $('.med_frequency').val('');
        $('.med_quantity').val('');
    })

    $('.editmedication').on('click',function() {
        var med_id = $(this).data('med_id');
        $.get('../../api/editmedication?med_id=' + med_id, function(data){
            $('.med_id').val(med_id);
            $('.divdate_start').empty();
            $('.divdate_start').append('<input type="text" id="date_start" name="date_start" class="form-control date_start" readonly="" required="" value="'+data.date_start+'">');
            $('.med_drug').val(data.drug);
            $('.med_frequency').val(data.frequency);
            $('.med_quantity').val(data.quantity);
            $(".date_start").datepicker({
                dateFormat: "yy-mm-dd",
                yearRange: "1950:2050",
                changeYear: true,
                changeMonth: true,
            });
        })
    })

    $('.editpatientultrasound').on('click',function() {
        var dataid = $(this).data('id');
        $('.ultrasound_id').val('');
        //$('.orno_edit_ultra').val('');
        //$('.physician_edit_ultra').empty();
        $('.physician_edit_ultra option[value=""]').prop("selected", true);
        $('.ultrasound_edit_date').val('');
        $('.phyfee_edit_ultra').val('');
        $('.results_edit_ultra').empty();
        $('.results_info_edit_ultra').empty();
        $('.plate_edit').removeAttr('value');

        $.get('../../api/ultrasoundedit?dataid=' + dataid, function(data){
            $('.ultrasound_id').val(data.id);
            //$('.orno_edit_ultra').val(data.or_no);
            //$('.physician_edit_ultra').append('<option value="'+data.doctor.id+'">'+data.doctor.f_name+' '+data.doctor.m_name+' '+data.doctor.l_name+', '+data.doctor.credential+'</option>');
            $('.physician_edit_ultra option[value="'+data.physician_id+'"]').prop("selected", true);
            if (!data.ultrasound_date) {
            }
            else {
                $('.ultrasound_edit_date').val(data.ultrasound_date);
            }
            //$('.ultrasound_edit_date').val(data.ultrasound_date);
            $('.phyfee_edit_ultra').val(data.phy_fee);
            $('.ultraservice_edit').val(data.ultraservice);

            if (data.finding == "Normal") {
                $('.results_edit_ultra').append('<label>\
                <input type="checkbox" name="finding" checked="" value="Normal" class="noramlfinding_ULTRA">\
                Normal</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\
                <label><input type="checkbox" value="Not Normal" class="notnoramlfinding_ULTRA">Not Normal</label>');

                $('.results_info_edit_ultra').append('<div class="col-sm-12 fnnormal_ULTRA">\
                    <textarea class="form-control txtcommnor_ULTRA" name="comm" rows="5" id="comment">'+data.finding_info+'</textarea>\
                </div>\
                <div class="col-sm-12 fnnotnormal_ULTRA" style="display: none;">\
                    <textarea class="form-control txtcommnotnor_ULTRA" rows="5" id="comment"></textarea>\
                </div>');
            }
            else if (data.finding == "Not Normal") {
                $('.results_edit_ultra').append('<label>\
                <input type="checkbox" name="finding" value="Normal" class="noramlfinding_ULTRA">\
                Normal</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\
                <label><input type="checkbox" checked="" value="Not Normal" class="notnoramlfinding_ULTRA">Not Normal</label>');

                $('.results_info_edit_ultra').append('<div class="col-sm-12 fnnormal_ULTRA" style="display: none;">\
                    <textarea class="form-control txtcommnor_ULTRA" name="comm" rows="5" id="comment"></textarea>\
                </div>\
                <div class="col-sm-12 fnnotnormal_ULTRA">\
                    <textarea class="form-control txtcommnotnor_ULTRA" rows="5" id="comment">'+data.finding_info+'</textarea>\
                </div>');
            }
            else {
                $('.results_edit_ultra').append('<label>\
                <input type="checkbox" name="finding" value="Normal" class="noramlfinding_ULTRA">\
                Normal</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\
                <label><input type="checkbox" value="Not Normal" class="notnoramlfinding_ULTRA">Not Normal</label>');

                $('.results_info_edit_ultra').append('<div class="col-sm-12 fnnormal_ULTRA" style="display: none;">\
                    <textarea class="form-control txtcommnor_ULTRA" name="comm" rows="5" id="comment"></textarea>\
                </div>\
                <div class="col-sm-12 fnnotnormal_ULTRA">\
                    <textarea class="form-control txtcommnotnor_ULTRA" rows="5" id="comment"></textarea>\
                </div>');
            }

            $('.noramlfinding_ULTRA').click(function() {
            if ($(this).is(':checked')) {
            $('.noramlfinding_ULTRA').attr('checked');
            $('.noramlfinding_ULTRA').attr('name','finding');

            $('.notnoramlfinding_ULTRA').prop('checked', false);
            $('.notnoramlfinding_ULTRA').removeAttr('name','finding');

            $('.fnnormal_ULTRA').show();
            $('.txtcommnor_ULTRA').attr('name','comm');

            $('.fnnotnormal_ULTRA').hide();
            $('.txtcommnotnor_ULTRA').removeAttr('name','comm');
            }
            });
            $('.notnoramlfinding_ULTRA').click(function() {
            if ($(this).is(':checked')) {
            $('.notnoramlfinding_ULTRA').attr('checked');
            $('.notnoramlfinding_ULTRA').attr('name','finding');

            $('.noramlfinding_ULTRA').prop('checked', false);
            $('.noramlfinding_ULTRA').removeAttr('name','finding');

            $('.fnnotnormal_ULTRA').show();
            $('.txtcommnotnor_ULTRA').attr('name','comm');

            $('.fnnormal_ULTRA').hide();
            $('.txtcommnor_ULTRA').removeAttr('name','comm');
            }
            });
        })
    })

    $('.patientultrasoundlog').on('click',function() {
        var dataid = $(this).data('id');
        $.get('../../api/ultrasoundlogs?dataid=' + dataid, function(data){
            $('.ultrasoundlogs').empty();
            $.each(data, function(index, logsss){
                $('.ultrasoundlogs').append('<tr>\
                                <td>'+logsss.id+'</td>\
                                <td class="text-center">'+logsss.date+'</td>\
                                <td class="text-center">'+logsss.doctor.f_name+' '+logsss.doctor.m_name+' '+logsss.doctor.l_name+', '+logsss.doctor.credential+'</td>\
                                <td class="text-center">'+logsss.action+'</td>\
                                </tr>');
            });
        });
    })

    $('.addnewxrayplate').on('click',function() {
        $('.plate').val('');
        $.get('../../api/getplate', function(data){
            $('.plate').val(data.plate_no);
        });
    })

</script>
@show

</body>
</html>