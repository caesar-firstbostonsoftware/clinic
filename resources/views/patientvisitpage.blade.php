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
        @if(Session::get('position') == "Doctor")
        <li><a href="/dashboard"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>
        <li><a href="/myinfo"><i class="fa fa-info-circle"></i> <span>My Info</span></a></li>
        @endif
        <li class="treeview active"><a href="/NFHSI"><i class="fa fa-users"></i> <span>Patients</span><span class="pull-right-container"></span></a>
            <ul style="display: block;" class="treeview-menu menu-open">
                <li class="active"><a href="/newvisit"><i class="fa fa-circle-o"></i> New Visit</a></li>
                <li><a href="/NFHSI"><i class="fa fa-circle-o"></i> Patient List</a></li>
                <li><a href="/generate/medcert"><i class="fa fa-circle-o"></i> Create Medical Certificate</a></li>
            </ul>
        </li>
        @if(Session::get('user') == 1)
        <li><a href="/NFHSI/users"><i class="fa fa-user-md"></i> <span>Users</span></a></li>
        <li><a href="/reports/{{Session::get('user')}}"><i class="fa fa-bar-chart"></i> <span>Reports</span></a></li>
        <li><a href="/NFHSI/services"><i class="fa fa-flask"></i> <span>Services</span></a></li>
        @elseif(Session::get('user') > 1 && Session::get('position') == "Doctor")
        <li><a href="/reports/{{Session::get('user')}}"><i class="fa fa-bar-chart"></i> <span>Reports</span></a></li>
        @endif
        <li><a href="/logout"><i class="fa fa-sign-out"></i> <span>Sign out</span></a></li>
    </ul>
</aside>

    <!-- Content Wrapper. Contains page content -->
    <div style="min-height: 245px;" class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-users"></i> Patients</h1>
        <ol class="breadcrumb">
            
            @if(Session::get('position') == "Doctor")
            <li><a href="/dashboard">Dashboard</a></li>
            <li><a href="/myinfo">My Info</a></li>
            @endif
            <li class="active"><a href="/NFHSI"><b>Patients</b></a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Patient Visit 
                    <!-- <a href="#" class="btn btn-warning btn-sm" target="_blank"> Generate Medical Certificate</a>
                    <a href="#" class="btn btn-info btn-sm" target="_blank"> Preview</a> -->
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
                        <a href="#reasonforconsulation" role="tab" data-toggle="tab" style="font-size: 8pt;">Reason for Consulation</a>
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
                            @if($service->admin_panel_id == 36)
                                <li role="presentation">
                                    <a href="#xray" role="tab" data-toggle="tab" style="font-size: 8pt;">X-ray</a>
                                </li>
                            @endif
                        @endforeach
                    <li role="presentation">
                        <a href="#labtest" role="tab" data-toggle="tab" style="font-size: 8pt;">Lab Test</a>
                    </li>
                    @elseif(Session::get('position') == "Xray")
                        @foreach($PatientService as $service)
                            @if($service->admin_panel_id == 36)
                                <li role="presentation">
                                    <a href="#xray" role="tab" data-toggle="tab" style="font-size: 8pt;">X-ray</a>
                                </li>
                            @endif
                        @endforeach
                    @elseif(Session::get('position') == "Labtest")
                    <li role="presentation">
                        <a href="#labtest" role="tab" data-toggle="tab" style="font-size: 8pt;">Lab Test</a>
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
                                                <button class="btn btn-primary btn-sm submit_RFC" id="btn-submit-consult_reason" type="button">Submit</button>
                                            </div>
                                            @else
                                            <div class="col-sm-3">
                                                <button class="btn btn-primary btn-sm edit_RFC" id="btn-submit-consult_reason" type="button">Save Changes</button>
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
                                                                        <button type="button" class="btn btn-primary btn-sm add_surgery" id="add-surgery" title="Add More">
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
                                                                        <button type="button" class="btn btn-primary btn-sm add_hospitalization" id="add-hospitalization" title="Add More">
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
                                                                    <button type="button" class="btn btn-primary btn-sm add_disease" id="add-disease" title="Add More">
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
                                                                    <button type="button" class="btn btn-primary btn-sm add_vaccination" id="add-vaccination" title="Add More">
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
                                                                        <button type="button" class="btn btn-primary btn-sm add_surgery" id="add-surgery" title="Add More">
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
                                                                        <button type="button" class="btn btn-primary btn-sm add_surgery" id="add-surgery" title="Add More">
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
                                                                        <button type="button" class="btn btn-primary btn-sm add_hospitalization" id="add-hospitalization" title="Add More">
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
                                                                        <button type="button" class="btn btn-primary btn-sm add_hospitalization" id="add-hospitalization" title="Add More">
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
                                                                    <button type="button" class="btn btn-primary btn-sm add_disease" id="add-disease" title="Add More">
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
                                                                    <button type="button" class="btn btn-primary btn-sm add_disease" id="add-disease" title="Add More">
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
                                                                    <button type="button" class="btn btn-primary btn-sm add_vaccination" id="add-vaccination" title="Add More">
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
                                                                    <button type="button" class="btn btn-primary btn-sm add_vaccination" id="add-vaccination" title="Add More">
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
                                            <button class="btn btn-primary btn-sm medical_history" id="btn-submit-medical_history" type="button">Submit</button>
                                            <button class="btn btn-primary btn-sm edit_medical_history" id="btn-submit-medical_history" type="button" style="display: none;">Save Changes</button>
                                            @else
                                            <button class="btn btn-primary btn-sm edit_medical_history" id="btn-submit-medical_history" type="button">Save Changes</button>
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
                                                <button class="btn btn-primary btn-sm addsocial_history" id="btn-submit-social_history" type="button">Submit</button>
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
                                                <button class="btn btn-primary btn-sm addsocial_history" id="btn-submit-social_history" type="button">Save Changes</button>
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
                                                <button class="btn btn-primary btn-sm addphysical_exam" id="btn-submit-physical_exam" type="button">Submit</button>
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
                                                <button class="btn btn-primary btn-sm addphysical_exam" id="btn-submit-physical_exam" type="button">Save Changes</button>
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
                                                <button class="btn btn-primary btn-sm adddiagnosis" id="btn-submit-diagnosis" type="button">Submit</button>
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
                                                <button class="btn btn-primary btn-sm adddiagnosis" id="btn-submit-diagnosis" type="button">Save Changes</button>
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
                                                <button class="btn btn-primary btn-sm addplan" id="btn-submit-plan" type="button">Submit</button>
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
                                                <button class="btn btn-primary btn-sm addplan" id="btn-submit-plan" type="button">Save Changes</button>
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
                                    <button type="button" class="btn btn-primary btn-sm addmedadd" data-toggle="modal" data-target="#modal_medication_add" data-backdrop="static">Add New</button> 
                                    <!-- <a href="#" target="_blank" class="btn btn-warning">Generate Rx</a> -->
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
                                                    <td><button class="btn btn-sm btn-primary editmedication" data-toggle="modal" data-target="#modal_medication_add" data-med_id="{{$medmed->id}}">Edit</button></td>
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
                                                <button type="button" class="btn btn-primary btn-sm addmedication" id="btn-add-medication">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END MODAL -->

                        <!-- X-ray -->
                        <div role="tabpanel" class="tab-pane fade" id="xray">
                            <div class="col-md-12">
                                <h3>X-ray
                                @if(!Session::get('user'))
                                @else
                                    @if($xraycount == 1)
                                    @else
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_xraynew" data-backdrop="static">Add New</button>
                                    @endif
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
                                            <tr id="med1">
                                                <td>{{$xray->id}}</td>
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
                                                    <button type="button" class="btn btn-sm btn-primary btn-sm editpatientxray" data-toggle="modal" data-target="#modal_xraynew_edit" data-backdrop="static" data-id="{{$xray->id}}">Edit</button>
                                                    <button class="btn btn-sm btn-success">Print</button>
                                                    <button type="button" class="btn btn-sm btn-warning patientxraylog" data-toggle="modal" data-target="#modal_patientxraylog" data-backdrop="static" data-id="{{$xray->id}}">Logs</button>
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

                                                    <form class="form-horizontal" method="POST" action="/visit/{{$id}}/{{$vid}}/edit">
                                                    {!! csrf_field() !!}
                                                        <div class="form-group">
                                                            <label class="col-sm-1 control-label">Name:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" class="xray_id" name="xray_id" value="" style="display: none;">
                                                                <input type="text" name="P_id_edit" value="{{$id}}" style="display: none;">
                                                                <input type="text" name="P_name_edit" required="" class="form-control" placeholder="Name" value="{{$patient->f_name}} {{$patient->m_name}} {{$patient->l_name}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">O.R. No.</label>
                                                            <div class="col-sm-3">
                                                                <input type="text" name="orno_edit" class="form-control orno_edit" placeholder="O.R. No." readonly="">
                                                            </div>
                                                        </div>

                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-1 control-label">Address:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="address_edit" required="" class="form-control" placeholder="Address" value="{{$patient->address}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">Age/Sex:</label>
                                                            <div class="col-sm-3">
                                                                <select id="agesex" name="agesex_edit" class="form-control" required="" disabled=""> 
                                                                    <option value="{{$patient->gender}}" selected="">{{$patient->gender}}</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-1 control-label">Physician:</label>
                                                            <div class="col-sm-6">
                                                                <select id="physician" name="physician_edit" class="form-control physician_edit" required="" disabled=""> 
                                                                    
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-2 control-label">Date:</label>
                                                            <div class="col-sm-3">
                                                                <input type="text" name="xraydate_edit" class="form-control xraydate_edit" required="" value="" disabled="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group divxrayinfo">
                                                            <label class="col-sm-1 control-label"></label>
                                                            <div class="col-sm-6"></div>
                                                            <label class="col-sm-2 control-label">Edit Date:</label>
                                                            <div class="col-sm-3">
                                                            <?php $datenow = date("Y-m-d"); ?>
                                                                <input type="text" id="datepickerxray" name="xraydate_edit_edit" class="form-control xraydate" required="" value="{{$datenow}}" readonly="" disabled="">
                                                            </div>
                                                        </div>

                                                        <h5><b>Result / Finding :</b></h5>

                                                        <div class="form-group divxrayinfo">
                                                            <div class="col-sm-6">
                                                                <div class="checkbox results_edit"></div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group divxrayinfo results_info_edit"></div>

                                                        <div class="form-group phyname divxrayinfo"></div>
                                                        <div class="form-group phypos"></div>

                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="control-label"></label>
                                                            <div class="col-sm-3">
                                                                <button class="btn btn-primary btn-sm" id="btn-submit-social_history" type="submit">Save Changes</button>
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

                                        <form class="form-horizontal" method="POST" action="/visit/{{$id}}/{{$vid}}">
                                        {!! csrf_field() !!}
                                            <div class="form-group">
                                                <label class="col-sm-1 control-label">Name:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="P_id" value="{{$id}}" style="display: none;">
                                                    <input type="text" name="P_name" required="" class="form-control" placeholder="Name" value="{{$patient->f_name}} {{$patient->m_name}} {{$patient->l_name}}" readonly="">
                                                </div>
                                                <label class="col-sm-2 control-label">O.R. No.</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="orno" class="form-control" placeholder="O.R. No.">
                                                </div>
                                            </div>
                                            <div class="form-group divxrayinfo">
                                                <label class="col-sm-1 control-label">Address:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="address" required="" class="form-control" placeholder="Address" value="{{$patient->address}}" readonly="">
                                                </div>
                                                <label class="col-sm-2 control-label">Age/Sex:</label>
                                                <div class="col-sm-3">
                                                    <select id="agesex" name="agesex" class="form-control" required="" disabled=""> 
                                                        <option value="{{$patient->gender}}" selected="">{{$patient->gender}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group divxrayinfo">
                                                <label class="col-sm-1 control-label">Physician:</label>
                                                <div class="col-sm-6">
                                                    <select id="physician" name="physician" class="form-control physician" required="">
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
                                                    <input type="text" id="datepicker" name="xraydate" class="form-control xraydate" required="" value="{{$datenow}}" disabled="">
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
                                                    <textarea class="form-control txtcommnor" name="comm" rows="5" id="comment">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet.
                                                    </textarea>
                                                </div>
                                                <div class="col-sm-12 fnnotnormal" style="display: none;">
                                                    <textarea class="form-control txtcommnotnor" rows="5" id="comment">123Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet.
                                                    </textarea>
                                                </div>
                                            </div>

                                            <div class="form-group phyname divxrayinfo"></div>
                                            <div class="form-group phypos"></div>

                                            <div class="form-group">
                                                <label for="inputEmail3" class="control-label"></label>
                                                <div class="col-sm-3">
                                                    <button class="btn btn-primary btn-sm" id="btn-submit-social_history" type="submit">Submit</button>
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
                            <ul class="nav nav-tabs" role="tablist" style="margin-left: 2%;">
                                <li role="presentation" class="active">
                                    <a href="#urinalysis" role="tab" data-toggle="tab" style="font-size: 8pt;">Urinalysis</a>
                                </li>
                                <li role="presentation">
                                    <a href="#fecalysis1" role="tab" data-toggle="tab" style="font-size: 8pt;">Fecalysis</a>
                                </li>
                                <li role="presentation">
                                    <a href="#OGTT1" role="tab" data-toggle="tab" style="font-size: 8pt;">Oral Glucose Tolerance Test</a>
                                </li>
                                <li role="presentation">
                                    <a href="#hematology1" role="tab" data-toggle="tab" style="font-size: 8pt;">Hematology</a>
                                </li>
                                <li role="presentation">
                                    <a href="#chemistry1" role="tab" data-toggle="tab" style="font-size: 8pt;">Chemistry II</a>
                                </li>
                            </ul>
                            <div class="tab-content">

                            <div role="tabpanel" class="tab-pane active" id="urinalysis">
                            <div class="col-md-12">
                                <h3>Urinalysis
                                @if(!Session::get('user'))
                                @else
                                @if($uricount >= 1)
                                @else
                                    <button type="button" class="btn btn-primary btn-sm newurinalysis" data-toggle="modal" data-target="#modal_urinalysis" data-backdrop="static">Add New</button>
                                @endif
                                @endif
                                </h3>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th class="text-center">Date</th>
                                                <th class="text-center">Physician</th>
                                                <th class="text-center">RMT</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="urinalysis_list">
                                        @foreach($Urinalysis as $Uri)
                                            <tr>
                                                <td>{{$Uri->id}}</td>
                                                <td class="text-center">{{$Uri->date}}</td>
                                                @foreach($doctor as $docdoc)
                                                @if($docdoc->id == $Uri->physician_id)
                                                <td class="text-center">{{$docdoc->f_name}} {{$docdoc->m_name}} {{$docdoc->l_name}}, {{$docdoc->credential}}</td>
                                                @endif
                                                @if($docdoc->id == $Uri->user_id)
                                                <td class="text-center">{{$docdoc->f_name}} {{$docdoc->m_name}} {{$docdoc->l_name}}, {{$docdoc->credential}}</td>
                                                @endif
                                                @endforeach
                                                <td>
                                                @if(!Session::get('user'))
                                                @else
                                                    <button type="button" class="btn btn-sm btn-primary editpatienturinalysis" data-toggle="modal" data-target="#modal_urinalysis" data-backdrop="static" data-id="{{$Uri->id}}">Edit</button>
                                                    <button class="btn btn-sm btn-success">Print</button>
                                                @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                <!-- MODAL Urinalysis -->
                <div class="modal fade" id="modal_urinalysis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modalwidthuri" role="document">
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
                                        <h4><b>URINALYSIS</b></h4>

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
                                                    <input type="text" name="orno" class="form-control uri_orno" placeholder="O.R. No.">
                                                </div>
                                            </div>
                                            <div class="form-group divxrayinfo">
                                                <label class="col-sm-1 control-label">Address:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="address" required="" class="form-control" placeholder="Address" value="{{$patient->address}}" readonly="">
                                                </div>
                                                <label class="col-sm-2 control-label">Age/Sex:</label>
                                                <div class="col-sm-3">
                                                    <select id="agesex" name="agesex" class="form-control" required="" disabled=""> 
                                                        <option value="{{$patient->gender}}" selected="">{{$patient->gender}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group divxrayinfo">
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
                                            </div><br>

                                            <div class=" divxrayinfo">
                                                <div class="row"> 
                                                    <div class="col-sm-6">
                                                        <label class="control-label" style="text-align: left;"><input type="checkbox" class="physical" name="physical" checked="" value="Yes"> <b>PHYSICAL</b></label>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Color </label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="color" required="" class="form-control color" placeholder="Color" value="" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Transparency </label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="transparency" required="" class="form-control transparency" placeholder="Transparency" value="" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Specific Gravity </label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="SG" required="" class="form-control SG" placeholder="Specific Gravity" value="" autocomplete="off">
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
                                                                <input type="text" name="wbc" required="" class="form-control wbc" placeholder="WBC" value="" autocomplete="off">
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
                                                                <input type="text" name="rbc" required="" class="form-control rbc" placeholder="RBC" value="" autocomplete="off">
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
                                                                <input type="text" name="EC" required="" class="form-control EC" placeholder="Epith. Cells" value="" autocomplete="off">
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
                                                                <input type="text" name="bacteria" required="" class="form-control bacteria" placeholder="Bacteria" value="" autocomplete="off">
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
                                                                <input type="text" name="cast" required="" class="form-control cast" placeholder="Cast" value="" autocomplete="off">
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
                                                                <input type="text" name="cast2" required="" class="form-control cast2" placeholder="Cast" value="" autocomplete="off">
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
                                                                <input type="text" name="crystal" required="" class="form-control crystal" placeholder="Crystal" value="" autocomplete="off">
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
                                                                <input type="text" name="crystal2" required="" class="form-control crystal2" placeholder="Crystal" value="" autocomplete="off">
                                                            </div>
                                                            <div>
                                                                <label class="control-label">LPF</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label class="control-label">Amorphous Materials </label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="AM" required="" class="form-control AM" placeholder="Amorphous Materials" value="" autocomplete="off">
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
                                                                <input type="text" name="MT" required="" class="form-control MT" placeholder="Mucus Thread" value="" autocomplete="off">
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
                                                                <input type="text" name="others" required="" class="form-control others" placeholder="Others" value="" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label class="control-label"></label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="others2" required="" class="form-control others2" placeholder="Others" value="" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label class="control-label"></label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="others3" required="" class="form-control others3" placeholder="Others" value="" autocomplete="off">
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
                                                                <input type="text" name="glucose" required="" class="form-control glucose" placeholder="Glucose" value="" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bilirubin </label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="bilirubin" required="" class="form-control bilirubin" placeholder="Bilirubin" value="" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ketone </label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="ketone" required="" class="form-control ketone" placeholder="Ketone" value="" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Blood </label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="blood" required="" class="form-control blood" placeholder="Blood" value="" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;pH </label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="ph" required="" class="form-control ph" placeholder="pH" value="" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Protein </label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="protein" required="" class="form-control protein" placeholder="Protein" value="" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Urobilingen </label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="urobilingen" required="" class="form-control urobilingen" placeholder="Urobilingen" value="" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nitrites </label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="nitrites" required="" class="form-control nitrites" placeholder="Nitrites" value="" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Leucocytes </label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="leucocytes" required="" class="form-control leucocytes" placeholder="Leucocytes" value="" autocomplete="off">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><br>
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
                                            </div><br>

                                            <div class="form-group docs">
                                                <label class="col-sm-6 control-label patho" style="text-align: center;"></label>
                                                <label class="col-sm-6 control-label uri_rmt" style="text-align: center;"></label>
                                            </div>
                                            <!-- <div class="form-group divxrayinfo docs2">
                                                <label class="col-sm-6 control-label" style="text-align: center; font-size: 8pt; margin-top: -1.1%;">Pathologist</label>
                                                <label class="col-sm-6 control-label" style="text-align: center; font-size: 8pt; margin-top: -1.1%;">RMT</label>
                                            </div> -->
                                            <br>

                                            <div class="form-group">
                                                <label for="inputEmail3" class="control-label"></label>
                                                <div class="col-sm-3">
                                                    <button class="btn btn-sm btn-primary" id="btn-submit-social_history" type="submit">Submit</button>
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

                            <div role="tabpanel" class="tab-pane fade" id="fecalysis">
                            <div class="col-md-12">
                                <h3>Fecalysis
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_fecalysis" data-backdrop="static">Add New</button>
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
                                        <tbody id="fecalysis_list">
                                            <tr>
                                                <td>1</td>
                                                <td>2</td>
                                                <td>3</td>
                                                <td>4</td>
                                                <td>5</td>
                                                <td>6</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="OGTT">
                            <div class="col-md-12">
                                <h3>Oral Glucose Tolerance Test
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_OGTT" data-backdrop="static">Add New</button>
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
                                        <tbody id="OGTT_list">
                                            <tr>
                                                <td>1</td>
                                                <td>2</td>
                                                <td>3</td>
                                                <td>4</td>
                                                <td>5</td>
                                                <td>6</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="hematology">
                            <div class="col-md-12">
                                <h3>Hematology
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_hematology" data-backdrop="static">Add New</button>
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
                                        <tbody id="hematology_list">
                                            <tr>
                                                <td>1</td>
                                                <td>2</td>
                                                <td>3</td>
                                                <td>4</td>
                                                <td>5</td>
                                                <td>6</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="chemistry">
                            <div class="col-md-12">
                                <h3>Chemistry II
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_chemistry" data-backdrop="static">Add New</button>
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
                                        <tbody id="chemistry_list">
                                            <tr>
                                                <td>1</td>
                                                <td>2</td>
                                                <td>3</td>
                                                <td>4</td>
                                                <td>5</td>
                                                <td>6</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>

                            </div>
                        </div>

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
            <b>Powered by </b> <img src="{{ asset('/img/fbismain.png') }}" alt="" height="40" width="200">
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
    })

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
        $('.physician_edit').empty();
        $('.results_edit').empty();
        $('.results_info_edit').empty();
        $('.phyname').empty();
        $('.phypos').empty();
        $('.xray_id').removeAttr('value');
        $('.orno_edit').removeAttr('value');
        $.get('../../api/modalxrayedit?dataid=' + dataid, function(data){
            $('.xray_id').attr('value',data.xray_id);
            $('.orno_edit').attr('value',data.or_no);
            $('.xraydate_edit').val(data.xray_date);
            $('.physician_edit').append('<option>'+data.f_name+' '+data.m_name+' '+data.l_name+', '+data.credential+'</option>');

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
                    <textarea class="form-control txtcommnotnor" rows="5" id="comment">123Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet.</textarea>\
                </div>');
            }
            else {
                $('.results_edit').append('<label>\
                <input type="checkbox" name="finding" value="Normal" class="noramlfinding">\
                Normal</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\
                <label><input type="checkbox" checked="" value="Not Normal" class="notnoramlfinding">Not Normal</label>');

                $('.results_info_edit').append('<div class="col-sm-12 fnnormal" style="display: none;">\
                    <textarea class="form-control txtcommnor" name="comm" rows="5" id="comment">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet.</textarea>\
                </div>\
                <div class="col-sm-12 fnnotnormal">\
                    <textarea class="form-control txtcommnotnor" rows="5" id="comment">'+data.finding_info+'</textarea>\
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
            $('.subsubRFC').append('<button class="btn btn-sm btn-primary edit_RFC" id="btn-submit-consult_reason" type="button">Save Changes</button>');

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
                        <td><button class="btn btn-sm btn-primary editmedication" data-toggle="modal" data-target="#modal_medication_add" data-med_id="'+data.id+'">Edit</button></td>\
                        </tr>');   
                }
                else {
                    $('.med_id_'+med_id+'').empty();
                    $('.med_id_'+med_id+'').append('<td>'+data.date_start+'</td>\
                        <td>'+data.drug+'</td>\
                        <td>'+data.frequency+'</td>\
                        <td>'+data.quantity+'</td>\
                        <td>'+data.status+'</td>\
                        <td><button class="btn btn-sm btn-primary editmedication" data-toggle="modal" data-target="#modal_medication_add" data-med_id="'+med_id+'">Edit</button></td>');

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


</script>
@show

</body>
</html>