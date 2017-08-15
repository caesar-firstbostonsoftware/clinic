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
        <li class="header">MAIN NAVIGATION</li>

        <li class="active"><a href="/myinfo"><i class="fa fa-info-circle"></i> <span>My Info</span></a></li>
        <li class="treeview"><a href="/NFHSI"><i class="fa fa-users"></i> <span>Patients</span><span class="pull-right-container"></span></a>
            <ul style="display: block;" class="treeview-menu menu-open">
                <li><a href="/newvisit"><i class="fa fa-circle-o"></i> New Visit</a></li>
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
        <h1><i class="fa fa-stethoscope"></i> My Info</h1>
        <ol class="breadcrumb">
            <li><a href="#">Dashboard</a></li>
            <li class="active"><a href="/myinfo">My Info</a></li>
        </ol>
    </section>
    
    <section class="content">
        <div class="box">
            <div class="box-body">
                <div class="nav-tabs-custom">
                        <div role="tabpanel" class="tab-pane active" id="personal_info">
                            <div class="col-md-7"><br>
                                <form id="frm_personal_info" class="form-horizontal" method="post" action="#">
                                    {!! csrf_field() !!}
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">Name</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" id="fname" name="fname" placeholder="First Name" required="" type="text" value="{{$info->f_name}}">
                                        </div>
                                        <div class="col-sm-2 nameleft">
                                            <input class="form-control" id="mname" name="mname" placeholder="M" type="text" value="{{$info->m_name}}">
                                        </div>
                                        <div class="col-sm-4 nameleft">
                                            <input class="form-control" id="lname" name="lname" placeholder="Last Name" required="" type="text" value="{{$info->l_name}}">
                                        </div>
                                    </div>
                                    <div class="form-group divxrayinfo">
                                        <label class="col-sm-2 control-label">Credential</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" id="credential" name="credential" placeholder="Credential" required="" type="text" value="{{$info->credential}}">
                                        </div>
                                    </div>
                                    <div class="form-group divxrayinfo">
                                        <label class="col-sm-2 control-label">Specialization</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="specialization" name="specialization" placeholder="Specialization" required="" type="text" value="{{$info->specialization}}">
                                        </div>
                                    </div>
                                    <div class="form-group divxrayinfo">
                                        <label class="col-sm-2 control-label">Address</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="address" name="address" placeholder="Address" type="text" required="" value="{{$info->address}}">
                                        </div>
                                    </div>
                                    <div class="form-group divxrayinfo">
                                        <label class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="email" name="email" placeholder="Email" type="email" required="" value="{{$info->email}}">
                                        </div>
                                    </div><br>
                                    <div class="form-group divxrayinfo">
                                        <label class="col-sm-2 control-label">Username</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="username" name="username" placeholder="Username" type="text" required="" value="{{$user->username}}">
                                        </div>
                                    </div>
                                    <!-- <div class="form-group divxrayinfo">
                                        <label class="col-sm-2 control-label">Password</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="password" name="password" placeholder="Password" type="text" required="">
                                        </div>
                                    </div> -->
                                    <!-- <div class="form-group">
                                        <label class="col-sm-2 control-label"></label>
                                        <div class="col-sm-4">
                                            <button class="btn btn-lg btn-primary btn-block" id="btn-submit-personal_info" type="submit">Submit</button>
                                        </div>
                                    </div> -->
                                </form>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>

    </div>

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

</body>
</html>