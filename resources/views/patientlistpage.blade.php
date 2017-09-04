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
        @if(Session::get('position') == "Doctor")
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
        <li><a href="/reports/{{Session::get('user')}}"><i class="fa fa-bar-chart"></i> <span>Reports</span></a></li>
        <li><a href="/NFHSI/services"><i class="fa fa-flask"></i> <span>Services</span></a></li>
        @elseif(Session::get('user') > 1 && Session::get('position') == "Doctor")
        <li><a href="/reports/{{Session::get('user')}}"><i class="fa fa-bar-chart"></i> <span>Reports</span></a></li>
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
            @if(Session::get('position') == "Doctor")
            <li><a href="/myinfo">My Info</a></li>
            @endif
            <li class="active"><a href="/NFHSI"><b>Patients</b></a></li>
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
                                                    @if(!Session::get('user'))
                                                    @else
                                                        <button class="btn btn-sm btn-primary btn-edit-patient editpatient" data-toggle="modal" data-target="#modal_edit_patient" data-id="{{$patient->id}}">Edit</button>
                                                    @endif
                                                        <button id="viewvisit" class="btn btn-sm btn-info btn-view-visits viewvisit" data-toggle="modal" data-target="#modal_visits" data-id="{{$patient->id}}">View Visits</button>
                                                        <!-- <a href="#" class="btn btn-sm btn-success" target="_blank">Add Follow-up Visit</a>
                                                        <a href="#" class="btn btn-sm btn-warning" target="_blank">Lab Flowsheet</a>
                                                        <a href="#" class="btn btn-sm bg-purple" target="_blank">Medication</a> -->
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
                                        <th>Purpose of Visit</th>
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
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <!-- <h4 class="modal-title" id="myModalLabel">Edit Personal Info</h4> -->
                    </div>
                    <div class="modal-body">
                            <form class="form-horizontal posteditpatient" id="posteditpatient" method="post" action="/NFHSI">
                            {!! csrf_field() !!}
                            <input class="edit_p_id" name="p_id" type="text" style="display: none;">
                            <h3>Edit Personal Info</h3>
                                <div class="form-group ">
                                    <label class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-4">
                                        <input class="form-control edit_fname" id="fname" name="fname" placeholder="First Name" required="" type="text" autocomplete="off">
                                    </div>
                                    <div class="col-sm-2">
                                        <input class="form-control edit_mname" id="mname" name="mname" placeholder="M" type="text" autocomplete="off">
                                    </div>
                                    <div class="col-sm-4">
                                        <input class="form-control edit_lname" id="lname" name="lname" placeholder="Last Name" required="" type="text" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Address</label>
                                    <div class="col-sm-10">
                                        <input class="form-control edit_address" id="address" name="address" placeholder="Address" required="" type="text" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Gender</label>
                                    <div class="col-sm-4">
                                        <select id="gender" name="gender" class="form-control edit_gender" required=""> 
                                            <option value="">- Select -</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Birthdate</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="datepicker" name="dob" class="form-control dob edit_dob" required="" placeholder="YYYY-MM-DD" readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Age</label>
                                    <div class="col-sm-1">
                                        <input class="form-control age edit_age" id="age" name="age" placeholder="" readonly="" required="" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Purpose of Visit</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="patient_visit_id" class="patient_visit_id" style="display: none;">
                                        <textarea class="form-control purpose_visit" name="purpose_visit" rows="2" id="purpose_visit" required=""></textarea>
                                    </div>
                                </div>

                                <h3>Services</h3>
                                @foreach($adminpanelcat as $cat)
                                <h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><i>{{$cat->cat_name}}</i></b></h5><br>
                                    @foreach($adminpanel as $panel)
                                        @if($cat->id == $panel->admin_panel_cat_id)
                                            <div class="form-group">
                                                <label class="col-sm-1 control-label"></label>
                                                <div class="col-sm-6">
                                                    <label>
                                                        <input type="checkbox" class="{{$panel->id}} cate" name="services[]" value="{{$panel->id}}-0"><b> {{$panel->name}}</b>
                                                    </label>
                                                </div>
                                                <div class="col-sm-2" style="text-align: right;">
                                                    @if($panel->price == 0)
                                                    <label><b></b></label>
                                                    @else
                                                    <?php $price = number_format($panel->price,2); ?>
                                                    <label><b> {{$price}}</b></label>
                                                    @endif
                                                </div>
                                            </div>
                                            @foreach($sub as $panelsub)
                                                @if($panel->id == $panelsub->admin_panel_id)
                                                    <div class="form-group">
                                                        <label class="col-sm-1 control-label"></label>
                                                        <div class="col-sm-6">
                                                            <label>
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="sub{{$panelsub->admin_panel_id}} subsub{{$panelsub->admin_panel_id}}{{$panelsub->id}}" name="services[]" value="{{$panelsub->admin_panel_id}}-{{$panelsub->id}}" disabled=""><b> {{$panelsub->name}}</b>
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2" style="text-align: right;">
                                                            <?php $price = number_format($panelsub->price,2); ?>
                                                            <label><b> {{$price}}</b></label>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endforeach

                            </form>
                    </div>
                    <div class="modal-footer">
                        <input id="pid" name="pid" value="" type="hidden">
                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                        <button class="btn btn-primary" form="posteditpatient" id="btn-submit-personal_info" type="submit">Save Changes</button>
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
            <b>Powered by </b> <img src="{{ asset('/img/fbismain.png') }}" alt="" height="40" width="200">
        </div> 
    </footer>

</div><!-- ./wrapper -->
</div>
@section('scripts')
    @include('adminlte::layouts.partials.scripts')
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
                        $('.age').val(years);
                    }
    });

    $('.viewvisit').on( 'click', function(e){
        var p_id = $(this).data('id');
        $('.visitlist_modal').empty();
        $.get('api/modalavisit?p_id=' + p_id, function(data){
            $.each(data, function(index, visit){
                $('.visitlist_modal').append('<tr>\
                    <td>'+visit.visitid+'</td>\
                    <td>'+visit.visit_date+'</td>\
                    <td>'+visit.purpose_visit+'</td>\
                    <td>\
                        <a href="/visit/'+visit.patient_id+'/'+visit.visitid+'" target="_blank" class="btn btn-sm btn-info">View</a>\
                        <a href="#" target="_blank" class="btn btn-sm btn-success">Print</a>\
                    </td>\
                </tr>');
            })
        })
    });

    $('.editpatient').on( 'click', function(e){
        var p_id = $(this).data('id');
        $('.edit_p_id').empty();
        $('.edit_fname').empty();
        $('.edit_mname').empty();
        $('.edit_lname').empty();
        $('.edit_address').empty();
        $('.edit_gender').empty();
        $('.edit_dob').empty();
        $('.edit_age').empty();
        $('.purpose_visit').empty();
        $.get('api/modalaeditpatient?p_id=' + p_id, function(data){
            $('.edit_p_id').val(data.patient.id);
            $('.edit_fname').val(data.patient.f_name);
            $('.edit_mname').val(data.patient.m_name);
            $('.edit_lname').val(data.patient.l_name);
            $('.edit_address').val(data.patient.address);
            if (data.patient.gender == "Male") {
                $('.edit_gender').append('<option value="">- Select -</option>\
                                            <option value="Male" selected>Male</option>\
                                            <option value="Female">Female</option>');
            }
            else {
                $('.edit_gender').append('<option value="">- Select -</option>\
                                            <option value="Male">Male</option>\
                                            <option value="Female" selected>Female</option>');
            }
            $('.edit_dob').val(data.patient.dob);
            $('.edit_age').val(data.patient.age);
            if (data.patient.visitid == 1) {
                $('.patient_visit_id').val(data.patient.patient_visit_id)
                $('.purpose_visit').val(data.patient.purpose_visit)
            }

            $.each(data.adminpanel, function(index, panel){
                $('.'+panel.admin_panel_id+'').attr('checked','checked')
                $('.subsub'+panel.admin_panel_id+''+panel.admin_panel_sub_id+'').removeAttr('disabled','disabled')
                $('.subsub'+panel.admin_panel_id+''+panel.admin_panel_sub_id+'').attr('checked','checked')
            })

        })
    });

    $('.cate').click(function() {
        if ($(this).is(':checked')) {
            var adid = $(this).val();
            var split = adid.split('-');
            $('.sub'+split[0]+'').removeAttr('disabled','disabled');
        }
        else {
            var adid = $(this).val();
            var split = adid.split('-');
            $('.sub'+split[0]+'').prop('checked',false);
            $('.sub'+split[0]+'').attr('disabled','disabled');
        }
    });
</script>
@show

</body>
</html>
