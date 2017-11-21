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
        <li class="active"><a href="/dashboard"><img src="{{ asset('/img/2001.png') }}" height="20" width="20"> <span>Dashboard</span></a></li>
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
        <li><a href="/NFHSI/queueing"><img src="{{ asset('/img/queueing.png') }}" height="20" width="20"> <span>Queueing</span></a></li>
        <li><a href="/NFHSI/users"><img src="{{ asset('/img/2012.png') }}" height="20" width="20"> <span>Users</span></a></li>
        <li><a href="/NFHSI/doctors"><img src="{{ asset('/img/2013.png') }}" height="20" width="20"> <span>Doctors</span></a></li>
        <li><a href="/reports/{{Session::get('user')}}"><img src="{{ asset('/img/2014.png') }}" height="20" width="20"> <span>Reports</span></a></li>
        <li><a href="/NFHSI/services"><img src="{{ asset('/img/2015.png') }}" height="20" width="20"> <span>Services</span></a></li>
        @elseif(Session::get('user') > 1 && Session::get('position') == "Doctor")
        <!-- <li><a href="#" data-toggle="modal" data-target="#modal_editvisit"><img src="{{ asset('/img/2018.png') }}" height="20" width="20"> <span>Queued X-ray</span></a></li> -->
        <li><a href="/NFHSI/queueing"><img src="{{ asset('/img/queueing.png') }}" height="20" width="20"> <span>Queueing</span></a></li>
        <li><a href="/reports/{{Session::get('user')}}"><img src="{{ asset('/img/2014.png') }}" height="20" width="20"> <span>Reports</span></a></li>
        @elseif(Session::get('user') > 1 && Session::get('position') != "Doctor")
        <li><a href="/NFHSI/queueing"><img src="{{ asset('/img/queueing.png') }}" height="20" width="20"> <span>Queueing</span></a></li>
        @endif
        <li><a href="/logout"><img src="{{ asset('/img/2016.png') }}" height="20" width="20"> <span>Sign out</span></a></li>
    </ul>
</aside>
    
    <!-- Content Wrapper. Contains page content -->
    <div style="min-height: 245px;" class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><img src="{{ asset('/img/2001.png') }}" alt="" height="30" width="30"> Dashboard</h1>
        <ol class="breadcrumb">
            <li class="active"><a href="/dashboard"><b>Dashboard</b></a></li>
        </ol>
    </section>
    
    <section class="content">
        <div id="chartContainer" style="height: 270px; width: 100%;"></div>
        <br>
        <div class="box">
            <div class="box-body">
                <div class="nav-tabs-custom">
                        <div role="tabpanel" class="tab-pane active" id="personal_info">
                            <div class="col-md-12">
                                <div class="mb-0 mt-4">
                                    <img src="{{ asset('/img/2010.png') }}" height="30" width="30">
                                    <?php $datenow = date("F");?>
                                    No. of Patient for the month of <b>{{$datenow}}</b>
                                    <i style="margin-left: 50%;"><b>{{$count}} Results Found</b></i>
                                </div>
                                <hr class="mt-2">
                                
                                <table class="tableBodyScroll table-striped">
                                    <thead class="dtl">
                                        <tr class="dtl">
                                            <th width="5%">ID</th>
                                            <th width="30%">Name</th>
                                            <th width="34%">Address</th>
                                            <th>Gender</th>
                                            <th>Age</th>
                                            <th>Number of Visit</th>
                                            <th width="1%"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="dtl">
                                    @foreach($pv as $patient)
                                        <tr class="dtl">
                                            <td width="6%">{{$patient->patient_id}}</td>
                                            <td width="31%">{{$patient->f_name}} {{$patient->m_name}} {{$patient->l_name}}</td>
                                            <td width="34%">{{$patient->address}}</td>
                                            <td>{{$patient->gender}}</td>
                                            <td>{{$patient->age}}</td>
                                            <td>{{$patient->counter}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="box-body">
                <div class="nav-tabs-custom">
                        <div role="tabpanel" class="tab-pane active" id="personal_info">
                            <div class="col-md-12">
                                <div class="mb-0 mt-4">
                                    <img src="{{ asset('/img/2011.png') }}" height="30" width="30">
                                    Income for the month of <b>{{$datenow}}</b>
                                    <?php $datenow2 = date("Y-m-d"); ?>
                                    <i style="margin-left: 40%;"><b>Total as of {{$datenow2}} :</b> Php. <?php echo number_format($income, 2);?></i>
                                </div>
                                <hr class="mt-2">
                                
                                <table class="tableBodyScroll table-striped">
                                    <thead class="dtl">
                                        <tr class="dtl">
                                            <th width="30%">Patient Name</th>
                                            <th width="10%">Visit Date</th>
                                            <th width="40%" style="text-align: center;">Purpose of Visit</th>
                                            <th width="20%" style="text-align: right;">Total Bill</th>
                                            <th width="1%"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="dtl">
                                    @foreach($pv2 as $income)
                                        <tr class="dtl">
                                            <td width="30%">{{$income->patient->f_name}} {{$income->patient->m_name}} {{$income->patient->l_name}}</td>
                                            <td width="10%">{{$income->visit_date}}</td>
                                            <td width="40%" style="text-align: center;">{{$income->purpose_visit}}</td>
                                            <td width="20%" style="text-align: right;">{{$income->totalbill}}</td>
                                            <td width="1%"></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>

    </div>

    <!-- MODALS -->
        <!-- <div class="modal fade" id="modal_editvisit" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">X-ray List</h4>
                    </div>
                    <div class="modal-body">
                        <table id="myTable" class="table table-striped wawee">
                            <thead>
                                <tr role="row">
                                    <th style="width: 5%;">ID</th>
                                    <th style="width: 30%;">Name</th>
                                    <th style="width: 29%;">Address</th>
                                    <th style="width: 5%;">Gender</th>
                                    <th style="width: 15%;">Date</th>
                                    <th style="width: 10%;">Status</th>
                                    <th style="width: 1%;"></th>
                                    <th style="width: 5%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($Patientxray as $xray)
                            <?php
                                $id = $xray->patient->id;
                                $zero_id = sprintf("%04d", $id);
                                $counter = 1;
                            ?>
                                <tr>
                                    <td>{{$zero_id}}</td>
                                    <td>{{$xray->patient->f_name}} {{$xray->patient->m_name}} {{$xray->patient->l_name}}</td>
                                    <td>{{$xray->patient->address}}</td>
                                    <td>{{$xray->patient->gender}}</td>
                                    <td>{{$xray->xray_date}}</td>
                                    <td>
                                        @if($xray->status == 'New')
                                        <b style="color: red;">Pending</b>
                                        @else
                                        <b style="color: green;">Done</b>
                                        @endif
                                    </td>
                                    <td>{{$counter++}}</td>
                                    <td>
                                        @if($xray->status == 'New')
                                        <a href="/visit/{{$xray->patient_id}}/{{$xray->visitid}}" target="_blank" class="btn btn-xs btn-info">View</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> -->
    <!-- END -->

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
    </script>
    <script>
        window.onload = function () {

        var d = new Date();
        var n = d.getMonth();

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            title:{
                text: "Number of Visits this Month"
            },
            axisY:{
                includeZero: false,
                labelFontSize: 15,
            },
            axisX:{
                labelFontSize: 15,
            },
            legend: {
                fontSize: 15
            },
            data: [{
                type: "line",
                name: "Visits",
                color: "red",
                showInLegend: true,
                axisYIndex: 1,
                dataPoints: [
                    { label: "1st Week" , y: {{$week1}} },
                    { label: "2nd Week" , y: {{$week2}} },
                    { label: "3rd Week" , y: {{$week3}} },
                    { label: "4th Week" , y: {{$week4}} },
                    { label: "5th Week" , y: {{$week5}} }
                ]
            }]
        });
        chart.render();

        }
    </script>
@show

</body>
</html>
