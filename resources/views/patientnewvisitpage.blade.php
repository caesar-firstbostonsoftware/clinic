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
        margin-top: -3%;
    }
    .modalwidth{
        width: 75%;
    }
    .nameleft{
        margin-left: -4.1%;
    }
</style>

<body class="skin-blue sidebar-mini">
<div id="app" v-cloak>
    <div class="wrapper">

    @include('adminlte::layouts.partials.mainheader')

    <!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview active"><a href="#"><i class="fa fa-users"></i> <span>Patients</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul style="display: block;" class="treeview-menu menu-open">
                    <li class="active"><a href="/newvisit"><i class="fa fa-circle-o"></i> New Visit</a></li>
                    <li><a href="/"><i class="fa fa-circle-o"></i> Patient List</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Create Medical Certificate</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-user-md"></i> <span>Users</span></a></li>
            <li><a href="#"><i class="fa fa-cogs"></i> <span>Settings</span></a></li>
            <li><a href="#"><i class="fa fa-sign-out"></i> <span>Sign out</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

    <!-- Content Wrapper. Contains page content -->
    <div style="min-height: 245px;" class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-users"></i> Patients</h1>
        <ol class="breadcrumb">
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Patients</a></li>
            <li class="active">New Visit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">New Visit
                </h3>
            </div>
            <div class="box-body">
                <div class="nav-tabs-custom">
        
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#personal_info" aria-controls="personal_info" role="tab" data-toggle="tab">Personal Info</a>
                        </li>
                    </ul>
    
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="personal_info">
                        <div class="col-md-5">
                            <h3>Personal Info</h3>
                            <form id="frm_personal_info" class="form-horizontal" method="post">
                                <input name="_token" value="HbMasNfwj9Ewv5M4a9aemF8jJFciISoBxgjSQmHw" type="hidden">
                                <div class="form-group ">
                                    <label class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" id="name" name="name" placeholder="First Name" required="" type="text">
                                    </div>
                                    <div class="col-sm-2 nameleft">
                                        <input class="form-control" id="name" name="name" placeholder="M" required="" type="text">
                                    </div>
                                    <div class="col-sm-4 nameleft">
                                        <input class="form-control" id="name" name="name" placeholder="Last Name" required="" type="text">
                                    </div>
                                </div>
                                <div class="form-group divxrayinfo">
                                    <label class="col-sm-2 control-label">Address</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" id="address" name="address" placeholder="Address" required="" type="text">
                                    </div>
                                </div>
                                <div class="form-group divxrayinfo">
                                    <label class="col-sm-2 control-label">Gender</label>
                                    <div class="col-sm-4">
                                        <select id="gender" name="gender" class="form-control" required=""> 
                                            <option value="">- Select -</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group divxrayinfo">
                                    <label class="col-sm-2 control-label">Birthdate</label>
                                    <div class="col-sm-5">
                                        <input type="text" id="datepicker" name="dob" class="form-control dob" required="" readonly="">
                                    </div>
                                </div>
                                <div class="form-group divxrayinfo">
                                    <label class="col-sm-2 control-label">Age</label>
                                    <div class="col-sm-2">
                                        <input class="form-control" id="age" name="age" placeholder="" readonly="" required="" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"></label>
                                    <div class="col-sm-4">
                                        <button class="btn btn-lg btn-primary btn-block" id="btn-submit-personal_info" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="clearfix"></div>
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
@show

<script type="text/javascript">
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
                        document.getElementById('age').value = years;
                    }
    });
</script>

</body>
</html>
