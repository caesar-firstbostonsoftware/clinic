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
    .nameleft{
        margin-left: -4.1%;
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
        <li class="treeview"><a href="/NFHSI"><i class="fa fa-users"></i> <span>Patients</span><span class="pull-right-container"></span></a>
            <ul style="display: block;" class="treeview-menu menu-open">
                <li><a href="/newvisit"><i class="fa fa-circle-o"></i> New Visit</a></li>
                <li><a href="/NFHSI"><i class="fa fa-circle-o"></i> Patient List</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Create Medical Certificate</a></li>
            </ul>
        </li>
        @else
        <li class="treeview active"><a href="/NFHSI"><i class="fa fa-users"></i> <span>Patients</span><span class="pull-right-container"></span></a>
            <ul style="display: block;" class="treeview-menu menu-open">
                <li><a href="/newvisit"><i class="fa fa-circle-o"></i> New Visit</a></li>
                <li><a href="/NFHSI"><i class="fa fa-circle-o"></i> Patient List</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Create Medical Certificate</a></li>
            </ul>
        </li>
        @endif
        @if(Session::get('user') == 1)
        <li class="active"><a href="/NFHSI/users"><i class="fa fa-user-md"></i> <span>Users</span></a></li>
        @endif
        <li><a href="/logout"><i class="fa fa-sign-out"></i> <span>Sign out</span></a></li>
    </ul>
</aside>
    
    <!-- Content Wrapper. Contains page content -->
    <div style="min-height: 245px;" class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-user-md"></i> Users</h1>
        <ol class="breadcrumb">
            <li><a href="#">Dashboard</a></li>
            <li><a href="/myinfo">My Info</a></li>
            <li><a href="/NFHSI">Patients</a></li>
            <li class="active">Users</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">List of Users <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addnewuser">Add New</button></h3>
                    </div>
                        <div class="box-body">
                            <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="users-table_wrapper">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr role="row">
                                                    <th style="width: 5%;">ID</th>
                                                    <th style="width: 25%;">Name</th>
                                                    <th style="width: 5%;">Credential</th>
                                                    <th style="width: 10%;">Specialization</th>
                                                    <th style="width: 15%;">Address</th>
                                                    <th style="width: 15%;">Email</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($users as $u_doctor)
                                            <?php
                                                $id = $u_doctor->id;
                                                $zero_id = sprintf("%04d", $id);
                                            ?>
                                                <tr>
                                                    <td>{{$zero_id}}</td>
                                                    <td>{{$u_doctor->f_name}} {{$u_doctor->m_name}} {{$u_doctor->l_name}}</td>
                                                    <td>{{$u_doctor->credential}}</td>
                                                    <td>{{$u_doctor->specialization}}</td>
                                                    <td>{{$u_doctor->address}}</td>
                                                    <td>{{$u_doctor->email}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
    </div>

    <div class="modal fade" id="addnewuser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <form class="form-horizontal" action="/NFHSI/users" method="post">
                            {!! csrf_field() !!}
                                <div class="form-group ">
                                    <label class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" id="fname" name="fname" placeholder="First Name" required="" type="text">
                                    </div>
                                    <div class="col-sm-2 nameleft">
                                        <input class="form-control" id="mname" name="mname" placeholder="M" type="text">
                                    </div>
                                    <div class="col-sm-4 nameleft">
                                        <input class="form-control" id="lname" name="lname" placeholder="Last Name" required="" type="text">
                                    </div>
                                </div>
                                <div class="form-group divxrayinfo">
                                    <label class="col-sm-2 control-label">Credential</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" id="credential" name="credential" placeholder="Credential" required="" type="text">
                                    </div>
                                </div>
                                <div class="form-group divxrayinfo">
                                    <label class="col-sm-2 control-label">Specialization</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="specialization" name="specialization" placeholder="Specialization" required="" type="text">
                                    </div>
                                </div>
                                <div class="form-group divxrayinfo">
                                    <label class="col-sm-2 control-label">Address</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="address" name="address" placeholder="Address" type="text" required="">
                                    </div>
                                </div>
                                <div class="form-group divxrayinfo">
                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="email" name="email" placeholder="Email" type="email" required="">
                                    </div>
                                </div><br>
                                <div class="form-group divxrayinfo">
                                    <label class="col-sm-2 control-label">Username</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="username" name="username" placeholder="Username" type="text" required="">
                                    </div>
                                </div>
                                <div class="form-group divxrayinfo">
                                    <label class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="password" name="password" placeholder="Password" type="text" required="">
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
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
