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
        <li class="header"><b style="color: white;font-size: 7.5pt;">NEGROS FAMILY HEALTH SERVICES, INC.</b></li>
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
        <!-- <li class="active"><a href="/NFHSI/users"><i class="fa fa-user-md"></i> <span>Users</span></a></li> -->
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
        <h1><i class="fa fa-user-md"></i> Users</h1>
        <ol class="breadcrumb">
            <li><a href="#">Dashboard</a></li>
            <li><a href="/myinfo">My Info</a></li>
            <li><a href="/NFHSI">Patients</a></li>
            <li class="active"><a href="/NFHSI/users"><b>Users</b></a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">List of Users <button class="btn btn-primary btn-sm addnew" data-toggle="modal" data-target="#addnewuser" data-backdrop="static">Add New</button></h3>
                    </div>
                        <div class="box-body">
                            <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="users-table_wrapper">
                                <div class="row">
                                    <div class="col-sm-12">
                                    <div class="flash-message top-message topmessage">
                                        @foreach (['danger', 'warning', 'success', 'info'] as $message)
                                            @if(Session::has('alert-' . $message))
                                                <p class="alert alert-{{ $message }}" style="padding:.5px;height:22px; width:40.5%;">{{ Session::get('alert-' . $message) }}</p>
                                            @endif
                                        @endforeach
                                    </div>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr role="row">
                                                    <th style="width: 5%;">ID</th>
                                                    <th style="width: 20%;">Name</th>
                                                    <th style="width: 5%;">Credential</th>
                                                    <th style="width: 10%;">Specialization</th>
                                                    <th style="width: 15%;">Address</th>
                                                    <th style="width: 15%;">Email</th>
                                                    <th style="width: 5%">Action</th>
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
                                                    <td>
                                                        <button class="btn btn-sm btn-primary btn-edit-patient edituser" data-toggle="modal" data-target="#addnewuser" data-id="{{$u_doctor->id}}" data-backdrop="static">Edit</button>
                                                    </td>
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
                            <form class="form-horizontal" id="adddoctoruser" action="/NFHSI/users" method="post">
                            {!! csrf_field() !!}
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Position</label>
                                    <div class="col-sm-6">
                                        <select class="form-control position" name="position" required="">
                                            <option value="">-- Select One --</option>
                                            <option value="Doctor">Doctor</option>
                                            <option value="Xray">Xray</option>
                                            <option value="Labtest">Lab Test</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group divxrayinfo">
                                    <label class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-4">
                                        <input class="form-control user_id" id="user_id" name="user_id" type="text" style="display: none;">
                                        <input class="form-control fname" id="fname" name="fname" placeholder="First Name" required="" type="text">
                                    </div>
                                    <div class="col-sm-2 nameleft">
                                        <input class="form-control mname" id="mname" name="mname" placeholder="M" type="text">
                                    </div>
                                    <div class="col-sm-4 nameleft">
                                        <input class="form-control lname" id="lname" name="lname" placeholder="Last Name" required="" type="text">
                                    </div>
                                </div>
                                <div class="form-group divxrayinfo divcredential">
                                    <label class="col-sm-2 control-label">Credential</label>
                                    <div class="col-sm-4">
                                        <input class="form-control credential" id="credential" name="credential" placeholder="Credential" type="text">
                                    </div>
                                </div>
                                <div class="form-group divxrayinfo divspecialization">
                                    <label class="col-sm-2 control-label">Specialization</label>
                                    <div class="col-sm-10">
                                        <input class="form-control specialization" id="specialization" name="specialization" placeholder="Specialization" type="text">
                                    </div>
                                </div>
                                <div class="form-group divxrayinfo">
                                    <label class="col-sm-2 control-label">Address</label>
                                    <div class="col-sm-10">
                                        <input class="form-control address" id="address" name="address" placeholder="Address" type="text" required="">
                                    </div>
                                </div>
                                <div class="form-group divxrayinfo">
                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control email" id="email" name="email" placeholder="Email" type="email" required="">
                                    </div>
                                </div><br>
                                <div class="form-group divxrayinfo">
                                    <label class="col-sm-2 control-label">Username</label>
                                    <div class="col-sm-10">
                                        <input class="form-control username" id="username" name="username" placeholder="Username" type="text" required="">
                                    </div>
                                </div>
                                <div class="form-group divxrayinfo">
                                    <label class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control password" id="password" name="password" placeholder="Password" type="text" required="">
                                    </div>
                                </div>
                            </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" form="adddoctoruser" type="submit">Submit</button>
                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
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
    <script type="text/javascript">

    $(document).ready(function() {
        setTimeout(function(){ 
            $('.topmessage').hide();
        }, 2000);
    })

        $('.addnew').on('click',function() {
                $('.user_id').removeAttr('value');
                $('.fname').removeAttr('value');
                $('.mname').removeAttr('value');
                $('.lname').removeAttr('value');
                $('.credential').removeAttr('value');
                $('.specialization').removeAttr('value');
                $('.address').removeAttr('value');
                $('.email').removeAttr('value');
                $('.username').removeAttr('value');
                $('.position').empty();
                $('.position').append('<option value+"">-- Select One --</option>\
                                            <option value="Doctor">Doctor</option>\
                                            <option value="Xray">Xray</option>\
                                            <option value="Labtest">Lab Test</option>');
        })

        $('.edituser').on('click',function() {
            var user_id = $(this).data('id');
            $.get('../../api/getuserinfo?user_id=' + user_id, function(data){
                $('.user_id').removeAttr('value');
                $('.fname').removeAttr('value');
                $('.mname').removeAttr('value');
                $('.lname').removeAttr('value');
                $('.credential').removeAttr('value');
                $('.specialization').removeAttr('value');
                $('.address').removeAttr('value');
                $('.email').removeAttr('value');
                $('.username').removeAttr('value');
                $('.position').empty();

                $('.user_id').attr('value',data.id);
                $('.fname').attr('value',data.f_name);
                $('.mname').attr('value',data.m_name);
                $('.lname').attr('value',data.l_name);
                $('.credential').attr('value',data.credential);
                $('.specialization').attr('value',data.specialization);
                $('.address').attr('value',data.address);
                $('.email').attr('value',data.email);
                $('.username').attr('value',data.user.username);

                if (data.user.position == "Doctor") {
                    $('.divcredential').show();
                    $('.divspecialization').show();
                    $('.position').append('<option value="">-- Select One --</option>\
                                            <option value="Doctor" selected >Doctor</option>\
                                            <option value="Xray">Xray</option>\
                                            <option value="Labtest">Lab Test</option>');
                }
                else if (data.user.position == "Xray"){
                    $('.divcredential').hide();
                    $('.divspecialization').hide();
                    $('.position').append('<option value="">-- Select One --</option>\
                                            <option value="Doctor">Doctor</option>\
                                            <option value="Xray" selected >Xray</option>\
                                            <option value="Labtest">Lab Test</option>');
                }   
                else if (data.user.position == "Labtest"){
                    $('.divcredential').hide();
                    $('.divspecialization').hide();
                    $('.position').append('<option value="">-- Select One --</option>\
                                            <option value="Doctor">Doctor</option>\
                                            <option value="Xray">Xray</option>\
                                            <option value="Labtest" selected >Lab Test</option>');
                }

            })
        })

        $('.position').on('change',function() {
        var optionSelected = $(this).val();
            if (optionSelected == "Doctor") {
                $('.divcredential').show();
                $('.divspecialization').show();
            }
            else if (optionSelected == "Xray") {
                $('.divcredential').hide();
                $('.divspecialization').hide();
            }
            else if (optionSelected == "Labtest") {
                $('.divcredential').hide();
                $('.divspecialization').hide();
            }
        })

    </script>
@show

</body>
</html>
