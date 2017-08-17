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
    .neg { 
        margin-top: -.4%;
    }
    .nor{
        margin-top: -1%;
    }
    .divxrayinfo{
        margin-top: -2%;
    }
    .modalwidth{
        width: 75%;
    }
    .nameleft{
        margin-left: -4.1%;
    }
    .divxrayinfo2{
        margin-top: -3%;
    }
</style>

<body class="skin-blue sidebar-mini">
<div id="app" v-cloak>
    <div class="wrapper">

    @include('adminlte::layouts.partials.mainheader')

<aside class="main-sidebar">
    <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        @if(Session::get('user') != 0)
        <li><a href="/myinfo"><i class="fa fa-info-circle"></i> <span>My Info</span></a></li>
        @endif
        <li class="treeview active"><a href="/NFHSI"><i class="fa fa-users"></i> <span>Patients</span><span class="pull-right-container"></span></a>
            <ul style="display: block;" class="treeview-menu menu-open">
                <li class="active"><a href="/newvisit"><i class="fa fa-circle-o"></i> New Visit</a></li>
                <li><a href="/NFHSI"><i class="fa fa-circle-o"></i> Patient List</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Create Medical Certificate</a></li>
            </ul>
        </li>
        @if(Session::get('user') == 1)
        <li><a href="/NFHSI/users"><i class="fa fa-user-md"></i> <span>Users</span></a></li>
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
            <li><a href="#">Dashboard</a></li>
            @if(Session::get('user') != 0)
            <li><a href="/myinfo">My Info</a></li>
            @endif
            <li class="active">Patients</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Patient Visit 
                    <a href="#" class="btn btn-warning btn-sm" target="_blank"> Generate Medical Certificate</a>
                    <a href="#" class="btn btn-info btn-sm" target="_blank"> Preview</a>
                </h3>
            </div>
            <div class="box-body"><!-- 
                <input id="pid" name="pid" value="1" type="text">
                <input id="vid" name="vid" value="1" type="text"> -->
            <div class="nav-tabs-custom">
    <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#personal_info" role="tab" data-toggle="tab">Personal Info</a>
                    </li>
                    <li role="presentation">
                        <a href="#reasonforconsulation" role="tab" data-toggle="tab">Reason for Consulation</a>
                    </li>
                    <li role="presentation">
                        <a href="#PMH" role="tab" data-toggle="tab">Past Medical History</a>
                    </li>
                    <li role="presentation">
                        <a href="#SH" role="tab" data-toggle="tab">Social History</a>
                    </li>
                    <li role="presentation">
                        <a href="#PE" role="tab" data-toggle="tab">Physical Exam</a>
                    </li>
                    <li role="presentation">
                        <a href="#diagnosis" role="tab" data-toggle="tab">Diagnosis</a>
                    </li>
                    <li role="presentation">
                        <a href="#plan" role="tab" data-toggle="tab">Plan</a>
                    </li>
                    <li role="presentation">
                        <a href="#medications" role="tab" data-toggle="tab">Medications</a>
                    </li>
                    @if(Session::get('user') != 0)
                    <li role="presentation">
                        <a href="#xray" role="tab" data-toggle="tab">X-ray</a>
                    </li>
                    @endif
                </ul>
                
                <div class="tab-content">

                        <!-- Personal Info -->
                        <div role="tabpanel" class="tab-pane active" id="personal_info">
                            <div class="col-md-5">
                                <h3>Personal Info</h3>
                                <form id="frm_personal_info" class="form-horizontal" method="post" action="">
                                    {!! csrf_field() !!}
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">Name</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" id="fname" name="fname" placeholder="First Name" required=""    type="text" value="{{$patient->f_name}}">
                                        </div>
                                        <div class="col-sm-2 nameleft">
                                            <input class="form-control" id="mname" name="mname" placeholder="M" type="text" value="{{$patient->m_name}}">
                                        </div>
                                        <div class="col-sm-4 nameleft">
                                            <input class="form-control" id="lname" name="lname" placeholder="Last Name" required=""     type="text" value="{{$patient->l_name}}">
                                        </div>
                                    </div>
                                    <div class="form-group divxrayinfo2">
                                        <label class="col-sm-2 control-label">Address</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="address" name="address" placeholder="Address" required=""   type="text" value="{{$patient->address}}">
                                        </div>
                                    </div>
                                    <div class="form-group divxrayinfo2">
                                        <label class="col-sm-2 control-label">Gender</label>
                                        <div class="col-sm-4">
                                            <select id="gender" name="gender" class="form-control" required="">
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
                                        <label class="col-sm-2 control-label">Birthdate</label>
                                        <div class="col-sm-7">
                                            <input type="text" id="datepicker" name="dob" class="form-control dob" required=""  placeholder="YYYY-MM-DD" value="{{$patient->dob}}">
                                        </div>
                                    </div>
                                    <div class="form-group divxrayinfo2">
                                        <label class="col-sm-2 control-label">Age</label>
                                        <div class="col-sm-2">
                                            <input class="form-control age" id="age" name="age" placeholder="" readonly="" required="" type="text" value="{{$patient->age}}">
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label class="col-sm-2 control-label"></label>
                                        <div class="col-sm-4">
                                            <button class="btn btn-lg btn-primary btn-block" id="btn-submit-personal_info" type="   submit">Submit</button>
                                        </div>
                                    </div> -->
                                </form>
                            </div>
                        </div>

                        <!-- Reason for Consulation -->
                        <div role="tabpanel" class="tab-pane fade" id="reasonforconsulation">
                            <div class="col-md-12">
                                <h3>Reason for Consultation</h3>
                                    <form id="frm_consult_reason" class="form-horizontal">
                                    {!! csrf_field() !!}
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Chief Complaint</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="chief_complaint" name="chief_complaint"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">History fo Present Illness</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control height500" rows="5" id="history_illness"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label"></label>
                                            <div class="col-sm-3">
                                                <button class="btn btn-lg btn-primary btn-block" id="btn-submit-consult_reason" type="button" data-loading-text="Submitting..." autocomplete="off">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                        </div>

                        <!-- Past Medical History -->
                        <div role="tabpanel" class="tab-pane fade" id="PMH">
                            <div class="col-md-12">
                                <h3>Past Medical History</h3>
                                    <form id="frm_consult_reason" class="form-horizontal">
                                    {!! csrf_field() !!}
                                        <div class="col-sm-5">
                                            <div class="checkbox">
                                                <label><input type="checkbox" class="surgery_check" value=""><b>Surgery</b></label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" value=""><b>Hypertension</b></label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" value=""><b>Diabetes Mellitus</b></label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" class="PR_check" value=""><b>Previous Hospitalization</b></label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" class="DD_check" value=""><b>Diseases Diagnosed</b></label>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" class="vaccine_check" value=""><b>Vaccinations</b></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-7">

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
                                                                <input type="text" id="datepicker1" name="surgery_date" class="form-control surgery_date" placeholder="YYYY-MM-DD" readonly="">
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
                                                                <input type="text" id="hospitalization_date" name="hospitalization_date" class="form-control hospitalization_date" placeholder="YYYY-MM-DD" readonly="">
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
                                                                <input type="text" id="disease_date" name="disease_date" class="form-control disease_date" placeholder="YYYY-MM-DD" readonly="">
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
                                                                <input type="text" id="vaccination_date" name="vaccination_date" class="form-control vaccination_date" placeholder="YYYY-MM-DD" readonly="">
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

                                        </div>
                                        <div class="clearfix"></div><br>
                                        <div class="form-group">
                                            <label for="inputEmail3" class=" control-label"></label>
                                            <div class="col-sm-3">
                                                <button class="btn btn-lg btn-primary btn-block" id="btn-submit-medical_history" type="button">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                        </div>

                        <!-- Social History -->
                        <div role="tabpanel" class="tab-pane fade" id="SH">
                            <div class="col-md-12">
                            <h3>Social History</h3>
                                    <form class="form-horizontal">
                                    {!! csrf_field() !!}
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
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label"></label>
                                            <div class="col-sm-3">
                                                <button class="btn btn-lg btn-primary btn-block" id="btn-submit-social_history" type="button" data-loading-text="Submitting..." autocomplete="off">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                        </div>

                        <!-- Physical Exam -->
                        <div role="tabpanel" class="tab-pane fade" id="PE">
                            <div class="col-md-12">
                            <h3>Physical Exam</h3>
                                    <form class="form-horizontal" id="frm_physical_exam">
                                    {!! csrf_field() !!}
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Gen. Survey</label>
                                            <div class="col-sm-6">
                                                <textarea class="form-control" id="gen_survey" name="gen_survey"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Vital Signs:</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">BP</label>
                                            <div class="col-sm-1">
                                                <input class="form-control" id="bp" name="bp" value="" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">HR</label>
                                            <div class="col-sm-1">
                                                <input class="form-control" id="hr" name="hr" value="" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">RR</label>
                                            <div class="col-sm-1">
                                                <input class="form-control" id="rr" name="rr" value="" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Temp.</label>
                                            <div class="col-sm-1">
                                                <input class="form-control" id="temp" name="temp" value="" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Head</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="head" name="head" value="" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Neck</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="neck" name="neck" value="" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Chest/Lungs</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="chest_lungs" name="chest_lungs" value="" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Heart</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="heart" name="heart" value="" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Abdomen</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="abdomen" name="abdomen" value="" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Back</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="back" name="back" value="" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Extremities</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="extremities" name="extremities" value="" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Neuro Exam</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="neuro_exam" name="neuro_exam" value="" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label"></label>
                                            <div class="col-sm-3">
                                                <button class="btn btn-lg btn-primary btn-block" id="btn-submit-physical_exam" type="button" data-loading-text="Submitting..." autocomplete="off">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                        </div>

                        <!-- Diagnosis -->
                        <div role="tabpanel" class="tab-pane fade" id="diagnosis">
                            <div class="col-md-12">
                                <h3>Diagnosis</h3>
                                    <form class="form-horizontal" id="frm_diagnosis">
                                    {!! csrf_field() !!}
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <textarea class="form-control height500" id="diagnosis_input" name="diagnosis_input" rows="8"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-3">
                                                <button class="btn btn-lg btn-primary btn-block" id="btn-submit-diagnosis" type="button" data-loading-text="Submitting..." autocomplete="off">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                        </div>

                        <!-- Plan -->
                        <div role="tabpanel" class="tab-pane fade" id="plan">
                            <div class="col-md-12">
                                <h3>Plan</h3>
                                    <form class="form-horizontal" id="frm_plan">
                                    {!! csrf_field() !!}
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <textarea class="form-control height500" id="plan_input" name="plan_input" rows="8"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-3">
                                                <button class="btn btn-lg btn-primary btn-block" id="btn-submit-plan" type="button" data-loading-text="Submitting..." autocomplete="off">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                        </div>

                        <!-- Medications -->
                        <div role="tabpanel" class="tab-pane fade" id="medications">
                            <div class="col-md-12">
                                <h3>Medications 
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_medication_add" data-backdrop="static">Add New</button> <a href="#" target="_blank" class="btn btn-warning">Generate Rx</a>
                                </h3>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Date Started</th>
                                                <th class="text-center">Date Ended</th>
                                                <th class="text-center">Drug</th>
                                                <th class="text-center">Frequency</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="medication_list">
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
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Add New Medication</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal" id="frm_add_medication">
                                                {!! csrf_field() !!}
                                                    <div class="form-group" id="dt_start_grp">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Date Start</label>
                                                        <div class="col-sm-4">
                                                            <?php $datenow2 = date("Y-m-d"); ?>
                                                            <input type="text" id="date_start" name="date_start" class="form-control date_start" required="" value="{{$datenow2}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group divxrayinfo" id="med_drug_grp">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Drug</label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control" id="med_drug" name="med_drug" type="text">
                                                            <span class="help-block hidden" id="med_drug_err"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group divxrayinfo" id="med_frequency_grp">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Frequency</label>
                                                        <div class="col-sm-6">
                                                            <input class="form-control" id="med_frequency" name="med_frequency" type="text">
                                                            <span class="help-block hidden" id="med_frequency_err"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group divxrayinfo" id="med_quantity_grp">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">Quantity</label>
                                                        <div class="col-sm-6">
                                                            <input class="form-control" id="med_quantity" name="med_quantity" type="text">
                                                            <span class="help-block hidden" id="med_quantity_err"></span>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" id="btn-add-medication" data-loading-text="Saving..." autocomplete="off">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END MODAL -->

                        <!-- X-ray -->
                        <div role="tabpanel" class="tab-pane fade" id="xray">
                            <div class="col-md-12">
                                <h3>X-ray 
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_xraynew" data-backdrop="static">Add New</button>
                                </h3>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
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
                                                    <button type="button" class="btn btn-sm btn-primary editpatientxray" data-toggle="modal" data-target="#modal_xraynew_edit" data-backdrop="static" data-id="{{$xray->id}}">Edit</button>
                                                    <button class="btn btn-sm btn-success">Print</button>
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

                                                    <form class="form-horizontal" method="POST" action="#">
                                                    {!! csrf_field() !!}
                                                        <div class="form-group">
                                                            <label class="col-sm-1 control-label">Name:</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="P_id_edit" value="{{$id}}" style="display: none;">
                                                                <input type="text" name="P_name_edit" required="" class="form-control" placeholder="Name" value="{{$patient->f_name}} {{$patient->m_name}} {{$patient->l_name}}" readonly="">
                                                            </div>
                                                            <label class="col-sm-2 control-label">O.R. No.</label>
                                                            <div class="col-sm-3">
                                                                <input type="text" name="orno_edit" class="form-control" placeholder="O.R. No." readonly="">
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
                                                                <input type="text" id="datepickerxray" name="xraydate_edit_edit" class="form-control xraydate" required="" value="{{$datenow}}" readonly="">
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

                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END MODAL -->

                    </div>

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
                                                    <select id="agesex" name="agesex" class="form-control" required=""> 
                                                        <option value="{{$patient->gender}}" selected="">{{$patient->gender}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group divxrayinfo">
                                                <label class="col-sm-1 control-label">Physician:</label>
                                                <div class="col-sm-6">
                                                    <select id="physician" name="physician" class="form-control physician" required=""> 
                                                        <option value="">- Select -</option>
                                                        @foreach($doctor as $doc)
                                                            <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}" >{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <label class="col-sm-2 control-label">Date:</label>
                                                <div class="col-sm-3">
                                                <?php $datenow = date("Y-m-d"); ?>
                                                    <input type="text" id="datepicker" name="xraydate" class="form-control xraydate" required="" value="{{$datenow}}">
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
                                                    <button class="btn btn-lg btn-primary btn-block" id="btn-submit-social_history" type="submit" data-loading-text="Submitting..." autocomplete="off">Submit</button>
                                                </div>
                                            </div>

                                        </form>
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
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
        </div>
            All rights reserved.
    </footer>

</div><!-- ./wrapper -->
</div>
@section('scripts')
    @include('adminlte::layouts.partials.scripts')

    <script type="text/javascript">
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

    var i;
    i = 1;
    $('.add_surgery').click(function() {
        i = i + 1;
        $('.surgery-item').append('<div class="row">\
                            <div class="col-sm-3">\
                                <div class="form-group">\
                                    <input type="text" id="datepicker'+i+'" name="surgery_date" class="form-control surgery_date" placeholder="YYYY-MM-DD" readonly="">\
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
    x = 1;
    $('.add_hospitalization').click(function() {
        x = x + 1;
        $('.hospitalization-item').append('<div class="row">\
                        <div class="col-sm-3">\
                            <div class="form-group">\
                                <input type="text" id="hospitalization_date'+x+'" name="hospitalization_date" class="form-control hospitalization_date" placeholder="YYYY-MM-DD" readonly="">\
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
    y = 1;
    $('.add_disease').click(function() {
        y = y + 1;
        $('.disease-item').append('<div class="row">\
                        <div class="col-sm-3">\
                            <div class="form-group">\
                                <input type="text" id="disease_date'+y+'" name="disease_date" class="form-control disease_date" placeholder="YYYY-MM-DD" readonly="">\
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
    z = 1;
    $('.add_vaccination').click(function() {
        z = z + 1;
        $('.vaccination-item').append('<div class="row">\
                        <div class="col-sm-3">\
                            <div class="form-group">\
                                <input type="text" id="vaccination_date'+z+'" name="vaccination_date" class="form-control vaccination_date" placeholder="YYYY-MM-DD" readonly="">\
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
        $.get('../../api/modalxrayedit?dataid=' + dataid, function(data){
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

</script>
@show

</body>
</html>
