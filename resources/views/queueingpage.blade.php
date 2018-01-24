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
    .tableBodyScroll tbody.dtl {
    display:block;
    max-height:100px;
    overflow-y:scroll;
    }
    .tableBodyScroll thead.dtl, tbody.dtl tr.dtl {
    display:table;
    width:100%;
    table-layout:fixed;
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
        
        <li class="treeview"><a href="/NFHSI"><img src="{{ asset('/img/2010.png') }}" height="20" width="20"> <span>Patients</span><span class="pull-right-container"></span></a>
            <ul style="display: block;" class="treeview-menu menu-open">
            @if(Session::get('user') == 1 || Session::get('position') == "Cashier")
                <li><a href="/newvisit"><i class="fa fa-circle-o"></i> New Visit</a></li>
            @endif
                <li><a href="/NFHSI"><i class="fa fa-circle-o"></i> Patient List</a></li>
            @if(Session::get('position') == "Doctor")
                <li><a href="/generate/medcert"><i class="fa fa-circle-o"></i> Create Medical Certificate</a></li>
            @endif
            </ul>
        </li>

        @if(Session::get('user') == 1)
        <li class="active"><a href="/NFHSI/queueing"><img src="{{ asset('/img/queueing.png') }}" height="20" width="20"> <span>Queueing</span></a></li>
        <li><a href="/NFHSI/users"><img src="{{ asset('/img/2012.png') }}" height="20" width="20"> <span>Users</span></a></li>
        <li><a href="/NFHSI/doctors"><img src="{{ asset('/img/2013.png') }}" height="20" width="20"> <span>Doctors</span></a></li>
        <li><a href="/reports/{{Session::get('user')}}"><img src="{{ asset('/img/2014.png') }}" height="20" width="20"> <span>Reports</span></a></li>
        <li><a href="/NFHSI/services"><img src="{{ asset('/img/2015.png') }}" height="20" width="20"> <span>Services</span></a></li>
        @elseif(Session::get('user') > 1 && Session::get('position') == "Doctor" || Session::get('position') == "Cashier")
        <li><a href="/reports/{{Session::get('user')}}"><img src="{{ asset('/img/2014.png') }}" height="20" width="20"> <span>Reports</span></a></li>
        @elseif(Session::get('user') > 1 && Session::get('position') == "Xray" || Session::get('position') == "Labtest")
        <li class="active"><a href="/NFHSI/queueing"><img src="{{ asset('/img/queueing.png') }}" height="20" width="20"> <span>Queueing</span></a></li>
        @endif
        <li><a href="/logout"><img src="{{ asset('/img/2016.png') }}" height="20" width="20"> <span>Sign out</span></a></li>
    </ul>
</aside>
    
    <!-- Content Wrapper. Contains page content -->
    <div style="min-height: 245px;" class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><img src="{{ asset('/img/queueing.png') }}" alt="" height="30" width="30"> Queueing</h1>
        <ol class="breadcrumb">
            @if(Session::get('user') == 1)
            <li><a href="/dashboard">Dashboard</a></li>
            @endif
            <li><a href="/myinfo">My Info</a></li>
            <li><a href="/NFHSI">Patients</a></li>
            <li class="active"><a href="/NFHSI/queueing"><b>Queueing</b></a></li>
        </ol>
    </section>
    @if($User->position == "Doctor" && $User->doc_id == 1)
    <section class="content">
        <div class="row">
        <div class="col-md-3">
            <div class="box box-widget widget-user-2">
                <div class="widget-user-header bg-light-blue">
                    <h3 class="box-title"><b>X-Ray</b></h3>
                </div>
                <div class="box-footer no-padding">
                    <div class="col-sm-12">
                        <?php $counter = 1;?>
                        @foreach($xray as $patientxray)
                        <?php
                            $id = $counter++;
                            $zero_id = sprintf("%03d", $id);
                        ?>
                            <b style="font-size: 12pt;color: red;">{{$zero_id}}.</b><a href="/visit/{{$patientxray->patient_id}}/{{$patientxray->visit_id}}" target="_blank"> {{$patientxray->l_name}}, {{$patientxray->f_name}}</a> --
                            <b>Services:</b>
                            @foreach($xrayservice as $xrayser)
                                @if($patientxray->patient_id == $xrayser->patient_id)
                                    {{$xrayser->xrayservice1001->name}},
                                @endif
                            @endforeach
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box box-widget widget-user-2">
                <div class="widget-user-header bg-light-blue">
                    <h3 class="box-title"><b>Urinalysis</b></h3>
                </div>
                <div class="box-footer no-padding">
                    <div class="col-sm-12">
                        <?php $counter = 1;?>
                        @foreach($urinalysis as $patienturinalysis)
                        <?php
                            $id = $counter++;
                            $zero_id = sprintf("%03d", $id);
                        ?>
                            <b style="font-size: 12pt;color: red;">{{$zero_id}}.</b><a href="/visit/{{$patienturinalysis->patient->id}}/{{$patienturinalysis->visit_id}}" target="_blank"> {{$patienturinalysis->patient->l_name}}, {{$patienturinalysis->patient->f_name}}</a>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box box-widget widget-user-2">
                <div class="widget-user-header bg-light-blue">
                    <h3 class="box-title"><b>Pregnancy Test</b></h3>
                </div>
                <div class="box-footer no-padding">
                    <div class="col-sm-12">
                        <?php $counter = 1;?>
                        @foreach($pregnancy as $patientpregnancy)
                        <?php
                            $id = $counter++;
                            $zero_id = sprintf("%03d", $id);
                        ?>
                            <b style="font-size: 12pt;color: red;">{{$zero_id}}.</b><a href="/visit/{{$patientpregnancy->patient->id}}/{{$patientpregnancy->visit_id}}" target="_blank"> {{$patientpregnancy->patient->l_name}}, {{$patientpregnancy->patient->f_name}}</a>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box box-widget widget-user-2">
                <div class="widget-user-header bg-light-blue">
                    <h3 class="box-title"><b>Fecalysis</b></h3>
                </div>
                <div class="box-footer no-padding">
                    <div class="col-sm-12">
                        <?php $counter = 1;?>
                        @foreach($fecalysis as $patientfecalysis)
                        <?php
                            $id = $counter++;
                            $zero_id = sprintf("%03d", $id);
                        ?>
                            <b style="font-size: 12pt;color: red;">{{$zero_id}}.</b><a href="/visit/{{$patientfecalysis->patient->id}}/{{$patientfecalysis->visit_id}}" target="_blank"> {{$patientfecalysis->patient->l_name}}, {{$patientfecalysis->patient->f_name}}</a>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="row">
        <div class="col-md-3">
            <div class="box box-widget widget-user-2">
                <div class="widget-user-header bg-light-blue">
                    <h3 class="box-title"><b>Amoeba</b></h3>
                </div>
                <div class="box-footer no-padding">
                    <div class="col-sm-12">
                        <?php $counter = 1;?>
                        @foreach($amoeba as $patientamoeba)
                        <?php
                            $id = $counter++;
                            $zero_id = sprintf("%03d", $id);
                        ?>
                            <b style="font-size: 12pt;color: red;">{{$zero_id}}.</b><a href="/visit/{{$patientamoeba->patient->id}}/{{$patientamoeba->visit_id}}" target="_blank"> {{$patientamoeba->patient->l_name}}, {{$patientamoeba->patient->f_name}}</a>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box box-widget widget-user-2">
                <div class="widget-user-header bg-light-blue">
                    <h3 class="box-title"><b>Hematology</b></h3>
                </div>
                <div class="box-footer no-padding">
                    <div class="col-sm-12">
                        <?php $counter = 1;?>
                        @foreach($hematology as $patienthematology)
                        <?php
                            $id = $counter++;
                            $zero_id = sprintf("%03d", $id);
                        ?>
                            <b style="font-size: 12pt;color: red;">{{$zero_id}}.</b><a href="/visit/{{$patienthematology->patient->id}}/{{$patienthematology->visit_id}}" target="_blank"> {{$patienthematology->patient->l_name}}, {{$patienthematology->patient->f_name}}</a> --
                            <b>Services:</b>
                            @foreach($hematologyservice as $hemaser)
                                @if($patienthematology->patient_id == $hemaser->patient_id)
                                    {{$hemaser->xrayservice1001->name}},
                                @endif
                            @endforeach
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box box-widget widget-user-2">
                <div class="widget-user-header bg-light-blue">
                    <h3 class="box-title"><b>Serology</b></h3>
                </div>
                <div class="box-footer no-padding">
                    <div class="col-sm-12">
                        <?php $counter = 1;?>
                        @foreach($serology as $patientserology)
                        <?php
                            $id = $counter++;
                            $zero_id = sprintf("%03d", $id);
                        ?>
                            <b style="font-size: 12pt;color: red;">{{$zero_id}}.</b><a href="/visit/{{$patientserology->patient->id}}/{{$patientserology->visit_id}}" target="_blank"> {{$patientserology->patient->l_name}}, {{$patientserology->patient->f_name}}</a> --
                            <b>Services:</b>
                            @foreach($serologyservice as $seroser)
                                @if($patientserology->patient_id == $seroser->patient_id)
                                    {{$seroser->xrayservice1001->name}},
                                @endif
                            @endforeach
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box box-widget widget-user-2">
                <div class="widget-user-header bg-light-blue">
                    <h3 class="box-title"><b>Chemistry I</b></h3>
                </div>
                <div class="box-footer no-padding">
                    <div class="col-sm-12">
                        <?php $counter = 1;?>
                        @foreach($chemistryi as $patientchemistryi)
                        <?php
                            $id = $counter++;
                            $zero_id = sprintf("%03d", $id);
                        ?>
                            <b style="font-size: 12pt;color: red;">{{$zero_id}}.</b><a href="/visit/{{$patientchemistryi->patient->id}}/{{$patientchemistryi->visit_id}}" target="_blank"> {{$patientchemistryi->patient->l_name}}, {{$patientchemistryi->patient->f_name}}</a> --
                            <b>Services:</b>
                            @foreach($chemistryiservice as $chemiser)
                                @if($patientchemistryi->patient_id == $chemiser->patient_id)
                                    {{$chemiser->xrayservice1001->name}},
                                @endif
                            @endforeach
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="row">
        <div class="col-md-3">
            <div class="box box-widget widget-user-2">
                <div class="widget-user-header bg-light-blue">
                    <h3 class="box-title"><b>Chemistry II</b></h3>
                </div>
                <div class="box-footer no-padding">
                    <div class="col-sm-12">
                        <?php $counter = 1;?>
                        @foreach($chemistryii as $patientchemistryii)
                        <?php
                            $id = $counter++;
                            $zero_id = sprintf("%03d", $id);
                        ?>
                            <b style="font-size: 12pt;color: red;">{{$zero_id}}.</b><a href="/visit/{{$patientchemistryii->patient->id}}/{{$patientchemistryii->visit_id}}" target="_blank"> {{$patientchemistryii->patient->l_name}}, {{$patientchemistryii->patient->f_name}}</a> --
                            <b>Services:</b>
                            @foreach($chemistryiiservice as $chemiiser)
                                @if($patientchemistryii->patient_id == $chemiiser->patient_id)
                                    {{$chemiiser->xrayservice1001->name}},
                                @endif
                            @endforeach
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-widget widget-user-2">
                <div class="widget-user-header bg-light-blue">
                    <h3 class="box-title"><b>Electrocardiographic</b></h3>
                </div>
                <div class="box-footer no-padding">
                    <div class="col-sm-12">
                        <?php $counter = 1;?>
                        @foreach($ecg as $patientecg)
                        <?php
                            $id = $counter++;
                            $zero_id = sprintf("%03d", $id);
                        ?>
                            <b style="font-size: 12pt;color: red;">{{$zero_id}}.</b><a href="/visit/{{$patientecg->patient->id}}/{{$patientecg->visit_id}}" target="_blank"> {{$patientecg->patient->l_name}}, {{$patientecg->patient->f_name}}</a>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    @endif
    @if($User->position == "Xray")
    <section class="content">
        <div class="row">
            <div class="col-md-4">
            <div class="box box-widget widget-user-2">
                <div class="widget-user-header bg-light-blue">
                    <h3 class="box-title"><b>X-Ray</b></h3>
                </div>
                <div class="box-footer no-padding">
                    <div class="col-sm-12">
                        <?php $counter = 1;?>
                        @foreach($xray as $patientxray)
                        <?php
                            $id = $counter++;
                            $zero_id = sprintf("%03d", $id);
                        ?>
                            <b style="font-size: 12pt;color: red;">{{$zero_id}}.</b><a href="/visit/{{$patientxray->patient_id}}/{{$patientxray->visit_id}}" target="_blank"> {{$patientxray->l_name}}, {{$patientxray->f_name}}</a> --
                            <b>Services:</b>
                            @foreach($xrayservice as $xrayser)
                                @if($patientxray->patient_id == $xrayser->patient_id)
                                    {{$xrayser->xrayservice1001->name}},
                                @endif
                            @endforeach
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>
    @endif
    @if($User->position == "Labtest")
    <section class="content">
        <div class="row">
        <div class="col-md-3">
            <div class="box box-widget widget-user-2">
                <div class="widget-user-header bg-light-blue">
                    <h3 class="box-title"><b>Urinalysis</b></h3>
                </div>
                <div class="box-footer no-padding">
                    <div class="col-sm-12">
                        <?php $counter = 1;?>
                        @foreach($urinalysis as $patienturinalysis)
                        <?php
                            $id = $counter++;
                            $zero_id = sprintf("%03d", $id);
                        ?>
                            <b style="font-size: 12pt;color: red;">{{$zero_id}}.</b><a href="/visit/{{$patienturinalysis->patient->id}}/{{$patienturinalysis->visit_id}}" target="_blank"> {{$patienturinalysis->patient->l_name}}, {{$patienturinalysis->patient->f_name}}</a>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box box-widget widget-user-2">
                <div class="widget-user-header bg-light-blue">
                    <h3 class="box-title"><b>Pregnancy Test</b></h3>
                </div>
                <div class="box-footer no-padding">
                    <div class="col-sm-12">
                        <?php $counter = 1;?>
                        @foreach($pregnancy as $patientpregnancy)
                        <?php
                            $id = $counter++;
                            $zero_id = sprintf("%03d", $id);
                        ?>
                            <b style="font-size: 12pt;color: red;">{{$zero_id}}.</b><a href="/visit/{{$patientpregnancy->patient->id}}/{{$patientpregnancy->visit_id}}" target="_blank"> {{$patientpregnancy->patient->l_name}}, {{$patientpregnancy->patient->f_name}}</a>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box box-widget widget-user-2">
                <div class="widget-user-header bg-light-blue">
                    <h3 class="box-title"><b>Fecalysis</b></h3>
                </div>
                <div class="box-footer no-padding">
                    <div class="col-sm-12">
                        <?php $counter = 1;?>
                        @foreach($fecalysis as $patientfecalysis)
                        <?php
                            $id = $counter++;
                            $zero_id = sprintf("%03d", $id);
                        ?>
                            <b style="font-size: 12pt;color: red;">{{$zero_id}}.</b><a href="/visit/{{$patientfecalysis->patient->id}}/{{$patientfecalysis->visit_id}}" target="_blank"> {{$patientfecalysis->patient->l_name}}, {{$patientfecalysis->patient->f_name}}</a>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box box-widget widget-user-2">
                <div class="widget-user-header bg-light-blue">
                    <h3 class="box-title"><b>Amoeba</b></h3>
                </div>
                <div class="box-footer no-padding">
                    <div class="col-sm-12">
                        <?php $counter = 1;?>
                        @foreach($amoeba as $patientamoeba)
                        <?php
                            $id = $counter++;
                            $zero_id = sprintf("%03d", $id);
                        ?>
                            <b style="font-size: 12pt;color: red;">{{$zero_id}}.</b><a href="/visit/{{$patientamoeba->patient->id}}/{{$patientamoeba->visit_id}}" target="_blank"> {{$patientamoeba->patient->l_name}}, {{$patientamoeba->patient->f_name}}</a>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="row">
        <div class="col-md-3">
            <div class="box box-widget widget-user-2">
                <div class="widget-user-header bg-light-blue">
                    <h3 class="box-title"><b>Hematology</b></h3>
                </div>
                <div class="box-footer no-padding">
                    <div class="col-sm-12">
                        <?php $counter = 1;?>
                        @foreach($hematology as $patienthematology)
                        <?php
                            $id = $counter++;
                            $zero_id = sprintf("%03d", $id);
                        ?>
                            <b style="font-size: 12pt;color: red;">{{$zero_id}}.</b><a href="/visit/{{$patienthematology->patient->id}}/{{$patienthematology->visit_id}}" target="_blank"> {{$patienthematology->patient->l_name}}, {{$patienthematology->patient->f_name}}</a> --
                            <b>Services:</b>
                            @foreach($hematologyservice as $hemaser)
                                @if($patienthematology->patient_id == $hemaser->patient_id)
                                    {{$hemaser->xrayservice1001->name}},
                                @endif
                            @endforeach
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box box-widget widget-user-2">
                <div class="widget-user-header bg-light-blue">
                    <h3 class="box-title"><b>Serology</b></h3>
                </div>
                <div class="box-footer no-padding">
                    <div class="col-sm-12">
                        <?php $counter = 1;?>
                        @foreach($serology as $patientserology)
                        <?php
                            $id = $counter++;
                            $zero_id = sprintf("%03d", $id);
                        ?>
                            <b style="font-size: 12pt;color: red;">{{$zero_id}}.</b><a href="/visit/{{$patientserology->patient->id}}/{{$patientserology->visit_id}}" target="_blank"> {{$patientserology->patient->l_name}}, {{$patientserology->patient->f_name}}</a> --
                            <b>Services:</b>
                            @foreach($serologyservice as $seroser)
                                @if($patientserology->patient_id == $seroser->patient_id)
                                    {{$seroser->xrayservice1001->name}},
                                @endif
                            @endforeach
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box box-widget widget-user-2">
                <div class="widget-user-header bg-light-blue">
                    <h3 class="box-title"><b>Electrocardiographic</b></h3>
                </div>
                <div class="box-footer no-padding">
                    <div class="col-sm-12">
                        <?php $counter = 1;?>
                        @foreach($ecg as $patientecg)
                        <?php
                            $id = $counter++;
                            $zero_id = sprintf("%03d", $id);
                        ?>
                            <b style="font-size: 12pt;color: red;">{{$zero_id}}.</b><a href="/visit/{{$patientecg->patient->id}}/{{$patientecg->visit_id}}" target="_blank"> {{$patientecg->patient->l_name}}, {{$patientecg->patient->f_name}}</a>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box box-widget widget-user-2">
                <div class="widget-user-header bg-light-blue">
                    <h3 class="box-title"><b>Chemistry I</b></h3>
                </div>
                <div class="box-footer no-padding">
                    <div class="col-sm-12">
                        <?php $counter = 1;?>
                        @foreach($chemistryi as $patientchemistryi)
                        <?php
                            $id = $counter++;
                            $zero_id = sprintf("%03d", $id);
                        ?>
                            <b style="font-size: 12pt;color: red;">{{$zero_id}}.</b><a href="/visit/{{$patientchemistryi->patient->id}}/{{$patientchemistryi->visit_id}}" target="_blank"> {{$patientchemistryi->patient->l_name}}, {{$patientchemistryi->patient->f_name}}</a> --
                            <b>Services:</b>
                            @foreach($chemistryiservice as $chemiser)
                                @if($patientchemistryi->patient_id == $chemiser->patient_id)
                                    {{$chemiser->xrayservice1001->name}},
                                @endif
                            @endforeach
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="row">
        <div class="col-md-3">
            <div class="box box-widget widget-user-2">
                <div class="widget-user-header bg-light-blue">
                    <h3 class="box-title"><b>Chemistry II</b></h3>
                </div>
                <div class="box-footer no-padding">
                    <div class="col-sm-12">
                        <?php $counter = 1;?>
                        @foreach($chemistryii as $patientchemistryii)
                        <?php
                            $id = $counter++;
                            $zero_id = sprintf("%03d", $id);
                        ?>
                            <b style="font-size: 12pt;color: red;">{{$zero_id}}.</b><a href="/visit/{{$patientchemistryii->patient->id}}/{{$patientchemistryii->visit_id}}" target="_blank"> {{$patientchemistryii->patient->l_name}}, {{$patientchemistryii->patient->f_name}}</a> --
                            <b>Services:</b>
                            @foreach($chemistryiiservice as $chemiiser)
                                @if($patientchemistryii->patient_id == $chemiiser->patient_id)
                                    {{$chemiiser->xrayservice1001->name}},
                                @endif
                            @endforeach
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    @endif
    </div>

    @include('adminlte::layouts.partials.controlsidebar')

    <footer class="main-footer">
        <div style="text-align: right;">
           <b>Powered by</b> <a href="www.inovenzo.com" target="_blank">Inovenzo</a> <img src="{{ asset('/img/LOGO.png') }}" height="30" width="30">
        </div> 
    </footer>

</div><!-- ./wrapper -->
</div>
@section('scripts')
    @include('adminlte::layouts.partials.scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            setTimeout(function(){ 
                window.location.reload();
            }, 20000);
        });
    </script>
@show

</body>
</html>
