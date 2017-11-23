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
        @if(Session::get('position') == "Doctor" || Session::get('position') == "Xray" || Session::get('position') == "Labtest")
        <li><a href="/myinfo"><img src="{{ asset('/img/2009.png') }}" height="20" width="20"> <span>My Info</span></a></li>
        @endif
        
        <li class="treeview"><a href="/NFHSI"><img src="{{ asset('/img/2010.png') }}" height="20" width="20"> <span>Patients</span><span class="pull-right-container"></span></a>
            <ul style="display: block;" class="treeview-menu menu-open">
                <li><a href="/newvisit"><i class="fa fa-circle-o"></i> New Visit</a></li>
                <li><a href="/NFHSI"><i class="fa fa-circle-o"></i> Patient List</a></li>
            @if(Session::get('position') == "Doctor")
                <li><a href="/generate/medcert"><i class="fa fa-circle-o"></i> Create Medical Certificate</a></li>
            @endif
            </ul>
        </li>

        @if(Session::get('user') == 1)
        <!-- <li><a href="#" data-toggle="modal" data-target="#modal_editvisit"><img src="{{ asset('/img/2018.png') }}" height="20" width="20"> <span>Queued X-ray</span></a></li> -->
        <li class="active"><a href="/NFHSI/queueing"><img src="{{ asset('/img/queueing.png') }}" height="20" width="20"> <span>Queueing</span></a></li>
        <li><a href="/NFHSI/users"><img src="{{ asset('/img/2012.png') }}" height="20" width="20"> <span>Users</span></a></li>
        <li><a href="/NFHSI/doctors"><img src="{{ asset('/img/2013.png') }}" height="20" width="20"> <span>Doctors</span></a></li>
        <li><a href="/reports/{{Session::get('user')}}"><img src="{{ asset('/img/2014.png') }}" height="20" width="20"> <span>Reports</span></a></li>
        <li><a href="/NFHSI/services"><img src="{{ asset('/img/2015.png') }}" height="20" width="20"> <span>Services</span></a></li>
        @elseif(Session::get('user') > 1 && Session::get('position') == "Doctor")
        <!-- <li><a href="#" data-toggle="modal" data-target="#modal_editvisit"><img src="{{ asset('/img/2018.png') }}" height="20" width="20"> <span>Queued X-ray</span></a></li> -->
        <!-- <li class="active"><a href="/NFHSI/queueing"><img src="{{ asset('/img/queueing.png') }}" height="20" width="20"> <span>Queueing</span></a></li> -->
        <li><a href="/reports/{{Session::get('user')}}"><img src="{{ asset('/img/2014.png') }}" height="20" width="20"> <span>Reports</span></a></li>
        @elseif(Session::get('user') > 1 && Session::get('position') != "Doctor")
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
            <li><a href="/dashboard">Dashboard</a></li>
            <li><a href="/myinfo">My Info</a></li>
            <li><a href="/NFHSI">Patients</a></li>
            <li class="active"><a href="/NFHSI/queueing"><b>Queueing</b></a></li>
        </ol>
    </section>
    @if($User->position == "Xray")
    <section class="content col-md-4">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b>X-Ray</b></h3>
                    </div>
                    <div class="box-body">
                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="users-table_wrapper">
                            <div class="row">
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
                                        {{$xrayser->xrayservice1001->name}},
                                        @endforeach
                                        <br>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    @if($User->position == "Labtest")
    <section class="content col-md-2">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b>Urinalysis</b></h3>
                    </div>
                    <div class="box-body">
                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="users-table_wrapper">
                            <div class="row">
                                <div class="col-sm-12">
                                    <?php $counter = 1;?>
                                    @foreach($urinalysis as $patienturinalysis)
                                    <?php
                                        $id = $counter++;
                                        $zero_id = sprintf("%03d", $id);
                                    ?>
                                        <b style="font-size: 12pt;color: red;">{{$zero_id}}.</b><a href="/visit/{{$patienturinalysis->patient->id}}/{{$patienturinalysis->visit_id}}"> {{$patienturinalysis->patient->l_name}}, {{$patienturinalysis->patient->f_name}}</a><br>

                                    @endforeach
                                </div>
                            </div>
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
                window.location.reload();
            }, 20000);
        });
    </script>
@show

</body>
</html>
