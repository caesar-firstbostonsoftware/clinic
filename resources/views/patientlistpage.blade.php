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
        <li class="header">MAIN NAVIGATION</li>
        @if(Session::get('user') != 0)
        <li><a href="/myinfo"><i class="fa fa-info-circle"></i> <span>My Info</span></a></li>
        @endif
        <li class="treeview active"><a href="/NFHSI"><i class="fa fa-users"></i> <span>Patients</span><span class="pull-right-container"></span></a>
            <ul style="display: block;" class="treeview-menu menu-open">
                <li><a href="/newvisit"><i class="fa fa-circle-o"></i> New Visit</a></li>
                <li class="active"><a href="/NFHSI"><i class="fa fa-circle-o"></i> Patient List</a></li>
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

        <div class="row">
            <div class="col-md-12">
 <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">List of Patients <a href="/newvisit" class="btn btn-primary btn-sm">Add New</a></h3>
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
                                                    <th style="width: 5%;">Gender</th>
                                                    <th style="width: 9%;">DOB</th>
                                                    <th style="width: 5%;">Age</th>
                                                    <th style="width: 5%;">Status</th>
                                                    <th style="width: 45%;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($patientlist as $patient)
                                            <?php
                                                $id = $patient->id;
                                                $zero_id = sprintf("%04d", $id);
                                            ?>
                                                <tr>
                                                    <td>{{$zero_id}}</td>
                                                    <td>{{$patient->f_name}} {{$patient->m_name}} {{$patient->l_name}}</td>
                                                    <td>{{$patient->gender}}</td>
                                                    <td>{{$patient->dob}}</td>
                                                    <td>{{$patient->age}}</td>
                                                    <td>
                                                        <span class="label label-success">{{$patient->status}}</span>
                                                    </td>
                                                    <td>
                                                        <button id="edit-1" class="btn btn-sm btn-primary btn-edit-patient" data-pid="1">Edit</button>
                                                        <button id="viewvisit" class="btn btn-sm btn-info btn-view-visits viewvisit" data-toggle="modal" data-target="#modal_visits" data-id="{{$patient->id}}">View Visits</button>
                                                        <a href="#" class="btn btn-sm btn-success" target="_blank">Add Follow-up Visit</a>
                                                        <a href="#" class="btn btn-sm btn-warning" target="_blank">Lab Flowsheet</a>
                                                        <a href="#" class="btn btn-sm bg-purple" target="_blank">Medication</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                            <div style="display: none;" class="dataTables_processing" id="users-table_processing">Processing...</div>
                                    </div>
                                </div>
                            </div>
                        </div>
        <!-- /.box-body -->
                </div>
      <!-- /.box -->
            </div>
        </div>


        <div class="modal fade" id="modal_visits" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Patient Visits</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Order</th>
                                        <th>Date &amp; Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="visit_list" class="visitlist_modal">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal_edit_patient" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Edit Personal Info</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-success hidden" id="personal_info_succ">Information updated successfully.</div>
                            <form id="frm_personal_info" class="form-horizontal">
                                <div class="form-group" id="name_grp">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" id="name" name="name" placeholder="Full Name" type="text">
                                        <span class="help-block hidden" id="name_err"></span>
                                    </div>
                                </div>
                                <div class="form-group" id="gender_grp">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Gender</label>
                                    <div class="col-sm-4">
                                        <select id="gender" name="gender" class="form-control"> 
                                            <option value="">- Select -</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        <span class="help-block hidden" id="gender_err"></span>
                                    </div>
                                </div>
                                <div class="form-group" id="birthdate_grp">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Birthdate</label>
                                    <div class="col-sm-5">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input class="form-control pull-right" id="birthdate" name="birthdate" type="text">
                                        </div>
                                        <span class="help-block hidden" id="birthdate_err"></span>
                                    </div>
                                </div>
                                <div class="form-group" id="age_grp">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Age</label>
                                    <div class="col-sm-2">
                                        <input class="form-control" id="age" name="age" placeholder="" readonly="" type="text">
                                        <span class="help-block hidden" id="age_err"></span>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                    </div>
                    <div class="modal-footer">
                        <input id="pid" name="pid" value="" type="hidden">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" id="btn-submit-personal_info" type="button" data-loading-text="Saving..." autocomplete="off">Save Changes</button>
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
    $('.viewvisit').on( 'click', function(e){
        var p_id = $(this).data('id');
        $('.visitlist_modal').empty();
        $.get('api/modalavisit?p_id=' + p_id, function(data){
            $.each(data, function(index, visit){
                $('.visitlist_modal').append('<tr>\
                    <td>'+visit.visitid+'</td>\
                    <td>'+visit.visit_date+'</td>\
                    <td>\
                        <a href="/visit/'+visit.patient_id+'/'+visit.visitid+'" target="_blank" class="btn btn-sm btn-info">View</a>\
                    </td>\
                </tr>');
            })
        })
    });
</script>
@show

</body>
</html>
