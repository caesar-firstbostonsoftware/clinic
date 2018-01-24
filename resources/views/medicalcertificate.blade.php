<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

@section('htmlheader')
    @include('adminlte::layouts.partials.htmlheader')
@show

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
        
        <li class="treeview active"><a href="/NFHSI"><img src="{{ asset('/img/2010.png') }}" height="20" width="20"> <span>Patients</span><span class="pull-right-container"></span></a>
            <ul style="display: block;" class="treeview-menu menu-open">
            @if(Session::get('user') == 1)
                <li><a href="/newvisit"><i class="fa fa-circle-o"></i> New Visit</a></li>
            @endif
            @if(!Session::get('user'))
                <li><a href="/newvisit"><i class="fa fa-circle-o"></i> New Visit</a></li>
            @endif
                <li><a href="/NFHSI"><i class="fa fa-circle-o"></i> Patient List</a></li>
            @if(Session::get('position') == "Doctor")
                <li class="active"><a href="/generate/medcert"><i class="fa fa-circle-o"></i> Create Medical Certificate</a></li>
            @endif
            </ul>
        </li>

        @if(Session::get('user') == 1)
        <li><a href="/NFHSI/queueing"><img src="{{ asset('/img/queueing.png') }}" height="20" width="20"> <span>Queueing</span></a></li>
        <li><a href="/NFHSI/users"><img src="{{ asset('/img/2012.png') }}" height="20" width="20"> <span>Users</span></a></li>
        <li><a href="/NFHSI/doctors"><img src="{{ asset('/img/2013.png') }}" height="20" width="20"> <span>Doctors</span></a></li>
        <li><a href="/reports/{{Session::get('user')}}"><img src="{{ asset('/img/2014.png') }}" height="20" width="20"> <span>Reports</span></a></li>
        <li><a href="/NFHSI/services"><img src="{{ asset('/img/2015.png') }}" height="20" width="20"> <span>Services</span></a></li>
        @elseif(Session::get('user') > 1 && Session::get('position') == "Doctor")
        <!-- <li><a href="/NFHSI/queueing"><img src="{{ asset('/img/queueing.png') }}" height="20" width="20"> <span>Queueing</span></a></li> -->
        <li><a href="/reports/{{Session::get('user')}}"><img src="{{ asset('/img/2014.png') }}" height="20" width="20"> <span>Reports</span></a></li>
        @elseif(Session::get('user') > 1 && Session::get('position') != "Doctor")
        <li><a href="/NFHSI/queueing"><img src="{{ asset('/img/queueing.png') }}" height="20" width="20"> <span>Queueing</span></a></li>
        @endif
        
        @if(!Session::get('user'))
        <li><a href="/reports/0"><img src="{{ asset('/img/2014.png') }}" height="20" width="20"> <span>Reports</span></a></li>
        @endif
        <li><a href="/logout"><img src="{{ asset('/img/2016.png') }}" height="20" width="20"> <span>Sign out</span></a></li>
    </ul>
</aside>

    <!-- Content Wrapper. Contains page content -->
    <div style="min-height: 245px;" class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><img src="{{ asset('/img/2010.png') }}" height="30" width="30"> Patients</h1>
        <ol class="breadcrumb">
            
            @if(Session::get('position') == "Doctor")
            <li><a href="/dashboard">Dashboard</a></li>
            <li><a href="/myinfo">My Info</a></li>
            @endif
            <li><a href="/NFHSI">Patients</a></li>
            <li class="active"><a href="/generate/medcert"><b>Medical Certificate</b></a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Create Medical Certificate</h3>
            </div>
            <div class="box-body">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="personal_info">
                        <div class="col-md-12" style="text-align: center;">
                            <h3 style="margin-bottom: 0">NEGROS FAMILY HEALTH SERVICES, INC.</h3>
                                <span style="font-size:12px;">NORTH ROAD, DARO (IN FRONT OF NOPH)
                                    <br>DUMAGUETE CITY, NEGROS ORIENTAL
                                    <br>TEL No. (035)225-3544
                                </span><br><br><br>
                                <h1 style="text-transform: uppercase;">Medical Certificate</h1>
                                <br><br><br>
                            <form id="frm_personal_info" class="form-horizontal medcert" method="post" action="/generate/medcert">
                                {!! csrf_field() !!}

                                <div class="container">
                                    <div class="row">
                                        <div class="col-6 col-md-2"></div>
                                        <div class="col-6 col-md-7" style="text-align: left;">This is to certify that</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-md-2"></div>
                                        <div class="col-6 col-md-7">
                                            <input type="text" id="name" name="name" class="form-control" placeholder="Full Name" required="" value="" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 col-md-2"></div>
                                        <div class="col-6 col-md-7" style="text-align: left;">was seen and examined last</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-md-2"></div>
                                        <div class="col-6 col-md-7">
                                            <input type="text" id="datepicker" name="datedate" class="form-control datedate" required="" placeholder="YYYY-MM-DD" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 col-md-2"></div>
                                        <div class="col-6 col-md-7" style="text-align: left;">Diagnosis:</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-md-2"></div>
                                        <div class="col-6 col-md-7">
                                            <textarea class="form-control diagnosis" name="diagnosis" rows="2" id="diagnosis" required="" autocomplete="off"></textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 col-md-2"></div>
                                        <div class="col-6 col-md-7" style="text-align: left;">Recommendation:</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-md-2"></div>
                                        <div class="col-6 col-md-7">
                                            <textarea class="form-control recommendation" name="recommendation" rows="2" id="recommendation" required="" autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                    <br><br><br>

                                    <div class="row">
                                        <div class="col-6 col-md-2"></div>
                                        <div class="col-6 col-md-2"></div>
                                        <div class="col-6 col-md-5" style="text-align: right;">
                                            <input type="text" id="docname" name="docname" class="form-control" placeholder="Full Doctor Name" required="" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-md-2"></div>
                                        <div class="col-6 col-md-2"></div>
                                        <div class="col-6 col-md-5" style="text-align: right;">
                                            <input type="text" id="licenseNo" name="licenseNo" class="form-control" placeholder="License No." autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 col-md-2"></div>
                                        <div class="col-6 col-md-2"></div>
                                        <div class="col-6 col-md-5" style="text-align: right;">
                                            <input type="text" id="ptrNo" name="ptrNo" class="form-control" placeholder="PTR No." autocomplete="off">
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-6 col-md-2"></div>
                                        <div class="col-6 col-md-2"></div>
                                        <div class="col-6 col-md-2" style="text-align: right;">
                                            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-download"></i> Generate Certificate</button>
                                        </div>
                                    </div>
                                    

                                    
                                </div>
                                
                                
                            </form>
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
           <b>Powered by</b> <a href="www.inovenzo.com" target="_blank">Inovenzo</a> <img src="{{ asset('/img/LOGO.png') }}" height="30" width="30">
        </div> 
    </footer>

</div><!-- ./wrapper -->
</div>
@section('scripts')
    @include('adminlte::layouts.partials.scripts')
    <script type="text/javascript">
        $(".datedate").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: "1950:2050",
        changeYear: true,
        changeMonth: true,
    });
    </script>
@show



</body>
</html>
