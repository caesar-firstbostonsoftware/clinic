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
    .divxrayinfo{
        margin-top: -2%;
    }
</style>

<body class="skin-blue sidebar-mini">
<div id="app" v-cloak>
    <div class="wrapper">

    @include('adminlte::layouts.partials.mainheader')

<aside class="main-sidebar">
    <ul class="sidebar-menu">
        <li class="header"><b style="color: white;font-size: 7.5pt;">NEGROS FAMILY HEALTH SERVICES, INC.</b></li>

        <li><a href="/myinfo"><i class="fa fa-info-circle"></i> <span>My Info</span></a></li>
        <li class="treeview"><a href="/NFHSI"><i class="fa fa-users"></i> <span>Patients</span><span class="pull-right-container"></span></a>
            <ul style="display: block;" class="treeview-menu menu-open">
                <li><a href="/newvisit"><i class="fa fa-circle-o"></i> New Visit</a></li>
                <li><a href="/NFHSI"><i class="fa fa-circle-o"></i> Patient List</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Create Medical Certificate</a></li>
            </ul>
        </li>
        @if(Session::get('user') == 1)
        <!-- <li><a href="/NFHSI/users"><i class="fa fa-user-md"></i> <span>Users</span></a></li> -->
        <li><a href="/reports/{{Session::get('user')}}"><i class="fa fa-bar-chart"></i> <span>Reports</span></a></li>
        <li class="active"><a href="/adminpanel"><i class="fa fa-desktop"></i> <span>Admin Panel</span></a></li>
        @elseif(Session::get('user') > 1)
        <li><a href="/reports/{{Session::get('user')}}"><i class="fa fa-bar-chart"></i> <span>Reports</span></a></li>
        @endif
        <li><a href="/logout"><i class="fa fa-sign-out"></i> <span>Sign out</span></a></li>
    </ul>
</aside>
    
    <!-- Content Wrapper. Contains page content -->
    <div style="min-height: 245px;" class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-desktop"></i> Admin Panel</h1>
        <ol class="breadcrumb">
            <li><a href="#">Dashboard</a></li>
            <li><a href="/myinfo">My Info</a></li>
            <li><a href="/NFHSI">Patients</a></li>
            <!-- <li><a href="/NFHSI/users">Users</a></li> -->
            <li><a href="/reports/{{Session::get('user')}}">Reports</a></li>
            <li class="active"><a href="/myinfo"><b>Admin Panel</b></a></li>
        </ol>
    </section>
    
    <section class="content">
        <div class="box">
            <div class="box-body">
                <div class="nav-tabs-custom">
                    <div class="box-body">

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-2" style="background-color:#ebebe0;box-shadow: 8px 8px 3px #888888;margin-left: 5%;">
                                    <a href="/NFHSI/users" class="btn default" style="font-size: 14pt;">
                                        <i class="fa fa-user-md fa-2x"></i>
                                        &nbsp;&nbsp;Users
                                    </a>
                                </div>
                                <div class="col-sm-2" style="background-color:#ebebe0;box-shadow: 8px 8px 3px #888888;margin-left: 1.5%;">
                                    <a href="/NFHSI/services" class="btn default" style="font-size: 14pt;">
                                        <i class="fa fa-flask fa-2x"></i>
                                        &nbsp;&nbsp;Services
                                    </a>
                                </div>
                                <!-- <div class="col-sm-2" style="background-color:#ebebe0;box-shadow: 8px 8px 3px #888888;margin-left: 1.5%;">
                                    <a href="#" class="btn default" style="font-size: 14pt;">
                                        <i class="fa fa-user-md fa-4x"></i>
                                        &nbsp;&nbsp;Users
                                    </a>
                                </div>
                                <div class="col-sm-2" style="background-color:#ebebe0;box-shadow: 8px 8px 3px #888888;margin-left: 1.5%;">
                                    <a href="#" class="btn default" style="font-size: 14pt;">
                                        <i class="fa fa-user-md fa-4x"></i>
                                        &nbsp;&nbsp;Users
                                    </a>
                                </div>
                                <div class="col-sm-2" style="background-color:#ebebe0;box-shadow: 8px 8px 3px #888888;margin-left: 1.5%;">
                                    <a href="#" class="btn default" style="font-size: 14pt;">
                                        <i class="fa fa-user-md fa-4x"></i>
                                        &nbsp;&nbsp;Users
                                    </a>
                                </div> -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

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
@show

</body>
</html>
