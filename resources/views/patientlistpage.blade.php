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
        @if(Session::get('position') == "Doctor" || Session::get('position') == "Xray" || Session::get('position') == "Labtest" || Session::get('position') == "Cashier")
        <li><a href="/myinfo"><img src="{{ asset('/img/2009.png') }}" height="20" width="20"> <span>My Info</span></a></li>
        @endif
        
        <li class="treeview active"><a href="/NFHSI"><img src="{{ asset('/img/2010.png') }}" height="20" width="20"> <span>Patients</span><span class="pull-right-container"></span></a>
            <ul style="display: block;" class="treeview-menu menu-open">
            @if(Session::get('user') == 1 || Session::get('position') == "Cashier")
                <li><a href="/newvisit"><i class="fa fa-circle-o"></i> New Visit</a></li>
            @endif
                <li class="active"><a href="/NFHSI"><i class="fa fa-circle-o"></i> Patient List</a></li>
            @if(Session::get('position') == "Doctor")
                <li><a href="/generate/medcert"><i class="fa fa-circle-o"></i> Create Medical Certificate</a></li>
            @endif
            </ul>
        </li>

        @if(Session::get('user') == 1)
        <li><a href="/NFHSI/queueing"><img src="{{ asset('/img/queueing.png') }}" height="20" width="20"> <span>Queueing</span></a></li>
        <li><a href="/NFHSI/users"><img src="{{ asset('/img/2012.png') }}" height="20" width="20"> <span>Users</span></a></li>
        <li><a href="/NFHSI/doctors"><img src="{{ asset('/img/2013.png') }}" height="20" width="20"> <span>Doctors</span></a></li>
        <li><a href="/reports/{{Session::get('user')}}"><img src="{{ asset('/img/2014.png') }}" height="20" width="20"> <span>Reports</span></a></li>
        <li><a href="/NFHSI/services"><img src="{{ asset('/img/2015.png') }}" height="20" width="20"> <span>Services</span></a></li>
        @elseif(Session::get('user') > 1 && Session::get('position') == "Doctor" || Session::get('position') == "Cashier")
        <li><a href="/reports/{{Session::get('user')}}"><img src="{{ asset('/img/2014.png') }}" height="20" width="20"> <span>Reports</span></a></li>
        @elseif(Session::get('user') > 1 && Session::get('position') == "Xray" || Session::get('position') == "Labtest")
        <li><a href="/NFHSI/queueing"><img src="{{ asset('/img/queueing.png') }}" height="20" width="20"> <span>Queueing</span></a></li>
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
            
            @if(Session::get('user') == 1)
            <li><a href="/dashboard">Dashboard</a></li>
            @endif
            <li><a href="/myinfo">My Info</a></li>
            <li class="active"><a href="/NFHSI"><b>Patients</b></a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">List of Patients 
                            @if(Session::get('position') == 'Cashier' || Session::get('user') == 1)
                            <a href="/newvisit" class="btn btn-primary btn-xs">Add New</a>
                            @endif
                        </h3>
                        <div class="flash-message top-message topmessage">
                                @foreach (['danger', 'warning', 'success', 'info'] as $message)
                                    @if(Session::has('alert-' . $message))
                                        <p class="alert alert-{{ $message }}" style="padding:.5px;height:22px; width:40.5%; margin-top: 2.1%">{{ Session::get('alert-' . $message) }}</p>
                                    @endif
                                @endforeach
                            </div>
                    </div>
                        <div class="box-body">
                            <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="users-table_wrapper">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="myTable" class="table table-striped wawee">
                                            <thead>
                                                @if(Session::get('user') > 1 && Session::get('position') == "Doctor")
                                                <tr role="row">
                                                    <th style="width: 5%;">ID</th>
                                                    <th style="width: 30%;">Name</th>
                                                    <th style="width: 20%;">Address</th>
                                                    <th style="width: 5%;">Gender</th>
                                                    <th style="width: 5%;">Status</th>
                                                    <th style="width: 35%;">Action</th>
                                                </tr>
                                                @else
                                                <tr role="row">
                                                    <th style="width: 5%;">ID</th>
                                                    <th style="width: 30%;">Name</th>
                                                    <th style="width: 5%;">Gender</th>
                                                    <th style="width: 20%;">Last Visit Date</th>
                                                    <th style="width: 5%;">Status</th>
                                                    <th style="width: 35%;">Action</th>
                                                </tr>
                                                @endif
                                            </thead>
                                            <tbody>
                                            @foreach ($patientlist as $patient)
                                            <?php
                                                $id = $patient->id;
                                                $zero_id = sprintf("%04d", $id);
                                            ?>
                                            @if(Session::get('user') > 1 && Session::get('position') == "Doctor")
                                                <tr>
                                                    <td>{{$zero_id}}</td>
                                                    <td>{{$patient->f_name}} {{$patient->m_name}} {{$patient->l_name}}</td>
                                                    <td>{{$patient->address}}</td>
                                                    <td>{{$patient->gender}}</td>
                                                    <td>
                                                        <span class="label label-success">{{$patient->status}}</span>
                                                    </td>
                                                    <td>
                                                        @if(Session::get('position') == 'Cashier' || Session::get('user') == 1)
                                                        <button class="btn btn-xs btn-primary btn-edit-patient editpatient" data-toggle="modal" data-target="#modal_edit_patient" data-id="{{$patient->id}}">Edit</button>
                                                        @endif
                                                        <button id="viewvisit" class="btn btn-xs btn-info btn-view-visits viewvisit" data-toggle="modal" data-target="#modal_visits" data-id="{{$patient->id}}">View Visits</button>
                                                    </td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td>{{$zero_id}}</td>
                                                    <td>{{$patient->f_name}} {{$patient->m_name}} {{$patient->l_name}}</td>
                                                    <td>{{$patient->gender}}</td>
                                                    <td>
                                                        @if(!$patient->lastvisit)
                                                            0000-00-00 00:00:00
                                                        @else
                                                            {{$patient->lastvisit->created_at}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span class="label label-success">{{$patient->status}}</span>
                                                    </td>
                                                    <td>
                                                        @if(Session::get('position') == 'Cashier' || Session::get('user') == 1)
                                                        <button class="btn btn-xs btn-primary btn-edit-patient editpatient" data-toggle="modal" data-target="#modal_edit_patient" data-id="{{$patient->id}}">Edit</button>
                                                        @endif
                                                        <button id="viewvisit" class="btn btn-xs btn-info btn-view-visits viewvisit" data-toggle="modal" data-target="#modal_visits" data-id="{{$patient->id}}">View Visits</button>
                                                    </td>
                                                </tr>
                                            @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
        <!-- /.box-body -->
                </div>
      <!-- /.box -->
            </div>
        </div>


        <div class="modal fade" id="modal_visits" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document" style="width: 70%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Patient Visits 
                            @if(Session::get('position') == 'Cashier' || Session::get('user') == 1)
                                <a href="#" class="btn btn-primary btn-xs addnewvisit">Add New Visit</a>
                            @endif
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Order</th>
                                        <th>Date</th>
                                        <th>Purpose of Visit</th>
                                        <th style="text-align:right;">Total</th>
                                        <th style="text-align:right;">Discount %</th>
                                        <th style="text-align:right;">WH Discount</th>
                                        <th style="text-align:right;">Discounted</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="visit_list" class="visitlist_modal">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_editvisit" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal posteditvisit" id="posteditvisit" method="post" action="/NFHSI/editvisit">
                        {!! csrf_field() !!}
                        <input type="text" name="editvisit_p_id" class="editvisit_p_id" style="display: none;">
                        <input type="text" name="editvisit_v_id" class="editvisit_v_id" style="display: none;">

                        <div class="form-group">
                            <label class="col-sm-3 control-label" style="text-align: left;"><i><b>Purpose of Visit</b></i></label>
                            <div class="col-sm-9">
                                <textarea class="form-control purpose_visit" name="purpose_visit" rows="2" id="purpose_visit" required=""></textarea>
                            </div>
                        </div>
                        <div class="form-group 12345">
                            <label class="col-sm-3 control-label" style="text-align: left;">Discount %</label>
                            <div class="col-sm-3">
                                <input class="form-control discount" id="discount" name="discount" type="number" min="0" autocomplete="off" tabindex="4">
                            </div>
                        </div>
                        <div class="form-group 67890">
                            <label class="col-sm-3 control-label" style="text-align: left;">WH Discount</label>
                            <div class="col-sm-3">
                                <input class="form-control wh_discount" id="wh_discount" name="wh_discount" type="number" min="0" autocomplete="off" tabindex="4">
                            </div>
                        </div>

                        <h3 class="modal-title" id="myModalLabel">Services</h3>
                            @foreach($adminpanelcat as $cat)
                                <div class="col-sm-12 {{$cat->id}}" style="border:3px solid black;">
                                    <div class="row">
                                        <div class="col-sm-3" style="margin-left: 3%;">
                                            <h5>
                                                <i><b>{{$cat->cat_name}}</b></i>
                                            </h5>
                                        </div>
                                        <div class="col-sm-1" style="margin-top: .5%;">
                                            <button type="button" class="btn btn-xs btn-primary appendservice" data-mainid="{{$cat->id}}">Add</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <hr>
                            <div class="row">
                                <label class="col-sm-5 control-label total" style="text-align: left;">
                                    <b>Total : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>Php. <i class="totaltotal">0.00</i>
                                    <input type="text" name="totalprice" class="totalprice" style="display: none;">
                                </label>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary btn-xs" form="posteditvisit" id="btn-submit-personal_info" type="submit">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_edit_patient" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Edit Personal Info</h4>
                    </div>
                    <div class="modal-body">
                            <form class="form-horizontal posteditpatient" id="posteditpatient" method="post" action="/NFHSI">
                            {!! csrf_field() !!}
                            <input class="edit_p_id" name="p_id" type="text" style="display: none;">
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label class="radio-inline">
                                            <input type="radio" name="type" class="type walk" value="Walk-in" checked="">Walk-in
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="type" class="type co" value="Company">Company
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-4">
                                        <input class="form-control edit_fname" id="fname" name="fname" placeholder="First Name" required="" type="text" autocomplete="off">
                                    </div>
                                    <div class="col-sm-2 12345">
                                        <input class="form-control edit_mname" id="mname" name="mname" placeholder="M" type="text" autocomplete="off">
                                    </div>
                                    <div class="col-sm-4 12345">
                                        <input class="form-control edit_lname" id="lname" name="lname" placeholder="Last Name" required="" type="text" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Address</label>
                                    <div class="col-sm-10">
                                        <input class="form-control edit_address" id="address" name="address" placeholder="Address" type="text" autocomplete="off">
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
                                        <input type="text" id="datepicker" name="dob" class="form-control dob edit_dob" placeholder="YYYY-MM-DD" readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Age</label>
                                    <div class="col-sm-1">
                                        <input class="form-control age edit_age" id="age" name="age" placeholder="" type="text">
                                    </div>
                                </div>
                                <div class="form-group 12345">
                                    <div class="checkbox col-sm-3">
                                        <label><input type="checkbox" class="check_senciz_id" value="Yes">Senior Citizen ID #</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <input class="form-control senciz_id" id="senciz_id" name="senciz_id" placeholder="Senior Citizen ID #" type="type" autocomplete="off" readonly="">
                                    </div>
                                </div>
                                <div class="form-group 12345">
                                    <div class="checkbox col-sm-3">
                                        <label><input type="checkbox" class="check_pwd_id" value="Yes">PWD ID #</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <input class="form-control pwd_id" id="pwd_id" name="pwd_id" placeholder="PWD ID #" type="type" autocomplete="off" readonly="">
                                    </div>
                                </div>
                            </form>
                    </div>
                    <div class="modal-footer">
                        <input id="pid" name="pid" value="" type="hidden">
                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                        <button class="btn btn-primary btn-xs" form="posteditpatient" id="btn-submit-personal_info" type="submit">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
  </div>
    <!-- /.content-wrapper -->

    <!-- MODALS -->
        <div class="modal fade" id="modal_visit_date" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header v_list_head">
                        <button type="button" class="close close_add" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <span>Visit ID # : </span>&nbsp;&nbsp;<span class="visit_id_no" style="font-weight: bold;"></span>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" id="frm_setend" method="Post" action="/NFHSI/editvisitdate">
                            <input type="text" name="vid" class="vid" style="display: none;">
                            {!! csrf_field() !!}
                            <div class="row">
                                <div class="col-sm-12">
                                    <b>Set Date :</b> 
                                    <input class="form-control vdate" id="datepicker321" name="vdate" type="text" placeholder="YYYY-MM-DD" readonly="">
                                    <input class="form-control vdate_check" type="text" style="display: none;">
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="submit" form="frm_setend" name="submit" class="btn btn-xs btn-primary submitsubmit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_addreceipt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close close_add" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">Add Receipt Number</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" id="frm_addreceipt">
                            {!! csrf_field() !!}
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Receipt Number</label>
                                    <div class="col-sm-8">
                                        <input class="form-control receipt_no" name="receipt_no" type="text" placeholder="Receipt Number" required="" autocomplete="off">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <a href="" target="_blank" class="btn btn-xs btn-success finalprint" onclick="return false;">Print</a>
                        </div>
                    </div>
                </div>
            </div>
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

    function pad (str, max) {
        str = str.toString();
         return str.length < max ? pad("0" + str, max) : str;
    }

    $(document).ready(function(){
        $('#myTable').dataTable({
                "order": [[ 3, "desc" ]]
            });
        setTimeout(function(){ 
            $('.topmessage').hide();
        }, 2000);
    });

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

    $(".vdate").datepicker({
                dateFormat: "yy-mm-dd",
                yearRange: "1950:2050",
                changeYear: true,
                changeMonth: true,
            });

    $('.viewvisit').on( 'click', function(e){
        var p_id = $(this).data('id');
        var ses_pos = "{{Session::get('position')}}";
        var ses_id = "{{Session::get('user')}}";
        $('.visitlist_modal').empty();
        $('.addnewvisit').removeAttr('href','href');
        $('.addnewvisit').attr('href','/newvisit/'+p_id+'');
        $.get('api/modalavisit?p_id=' + p_id, function(data){
            if (ses_pos == 'Cashier') {
                $.each(data, function(index, visit){
                if (visit.status == 'Pending') {
                    $('.visitlist_modal').append('<tr>\
                    <td>'+visit.visitid+'</td>\
                    <td>\
                        <a href="#" class="visit_date" data-id="'+visit.id+'" data-datedate="'+visit.visit_date+'" data-toggle="modal" data-target="#modal_visit_date" data-backdrop="static">'+visit.visit_date+'</a>\
                    </td>\
                    <td>'+visit.purpose_visit+'</td>\
                    <td style="text-align:right;">'+visit.totalbill+'</td>\
                    <td style="text-align:right;">'+parseFloat(visit.discount)+'</td>\
                    <td style="text-align:right;">'+parseFloat(visit.wh_discount)+'</td>\
                    <td style="text-align:right;font-size:12pt;"><b>'+visit.discounted_total+'</b></td>\
                    <td style="color:red;"><b>'+visit.status+'</b></td>\
                    <td>\
                        <button class="btn btn-xs btn-primary editvisit" data-toggle="modal" data-target="#modal_editvisit" data-p_id="'+visit.patient_id+'" data-v_id="'+visit.visitid+'">Edit</button>\
                        <a href="/visit/'+visit.patient_id+'/'+visit.visitid+'" target="_blank" class="btn btn-xs btn-info">View</a>\
                        <a href="#" class="btn btn-xs btn-danger cancelvisit" data-patient_id="'+visit.patient_id+'" data-visit_id="'+visit.visitid+'">Cancel</a>\
                        <a href="/patient/pdf/view/'+visit.patient_id+'/'+visit.visitid+'" target="_blank" class="btn btn-xs btn-success">Print</a>\
                        <button type="button" class="btn btn-success btn-xs addreceipt" data-toggle="modal" data-target="#modal_addreceipt" data-backdrop="static" data-p_id="'+visit.patient_id+'" data-v_id="'+visit.visitid+'">Print Receipt</button>\
                    </td>\
                    </tr>');
                }
                else if (visit.status == 'Paid') {
                    $('.visitlist_modal').append('<tr>\
                    <td>'+visit.visitid+'</td>\
                    <td>'+visit.visit_date+'</td>\
                    <td>'+visit.purpose_visit+'</td>\
                    <td style="text-align:right;">'+visit.totalbill+'</td>\
                    <td style="text-align:right;">'+parseFloat(visit.discount)+'</td>\
                    <td style="text-align:right;">'+parseFloat(visit.wh_discount)+'</td>\
                    <td style="text-align:right;font-size:12pt;"><b>'+visit.discounted_total+'</b></td>\
                    <td style="color:green;"><b>'+visit.status+'</b></td>\
                    <td>\
                        <a href="/visit/'+visit.patient_id+'/'+visit.visitid+'" target="_blank" class="btn btn-xs btn-info">View</a>\
                        <a href="/patient/pdf/view/'+visit.patient_id+'/'+visit.visitid+'" target="_blank" class="btn btn-xs btn-success">Print</a>\
                        <button type="button" class="btn btn-success btn-xs addreceipt" data-toggle="modal" data-target="#modal_addreceipt" data-backdrop="static" data-p_id="'+visit.patient_id+'" data-v_id="'+visit.visitid+'">Print Receipt</button>\
                    </td>\
                    </tr>');
                }
                else {
                    $('.visitlist_modal').append('<tr>\
                    <td>'+visit.visitid+'</td>\
                    <td>'+visit.visit_date+'</td>\
                    <td>'+visit.purpose_visit+'</td>\
                    <td style="text-align:right;">'+visit.totalbill+'</td>\
                    <td style="text-align:right;">'+parseFloat(visit.discount)+'</td>\
                    <td style="text-align:right;">'+parseFloat(visit.wh_discount)+'</td>\
                    <td style="text-align:right;font-size:12pt;"><b>'+visit.discounted_total+'</b></td>\
                    <td style="color:gold;"><b>'+visit.status+'</b></td>\
                    <td></td>\
                    </tr>');
                }

                $('.receipt_no').on('change',function() {
                    var receipt_no = $(this).val();
                    var patient_id = $(this).data('p_id');
                    var visit_id = $(this).data('v_id');
                    if (!receipt_no) {
                        $('.finalprint').removeAttr('href');
                        $('.finalprint').attr('onclick','return false;');
                    }
                    else {
                        $('.finalprint').removeAttr('href');
                        $('.finalprint').removeAttr('onclick');
                        $('.finalprint').attr('href','/patientreceipt/pdf/view/'+patient_id+'/'+visit_id+'/'+receipt_no+'');
                    }
                })

                $('.addreceipt').on('click',function() {
                    var patient_id = $(this).data('p_id');
                    var visit_id = $(this).data('v_id');
                    $('.receipt_no').removeAttr('data-p_id');
                    $('.receipt_no').removeAttr('data-v_id');
                    $('.receipt_no').attr('data-p_id',patient_id);
                    $('.receipt_no').attr('data-v_id',visit_id);
                    $.get('api/checkreceipt?patient_id=' + patient_id +'&visit_id=' + visit_id, function(data){
                        if (!data.id) {
                            $('.finalprint').removeAttr('href');
                            $('.finalprint').attr('onclick','return false;');
                            $('.receipt_no').removeAttr('value');
                            $('.receipt_no').removeAttr('readonly');
                            $('.receipt_no').val('');
                        }
                        else {
                            $('.receipt_no').removeAttr('value');
                            $('.receipt_no').val(data.receipt_number);
                            $('.receipt_no').attr('readonly','readonly');
                            $('.finalprint').removeAttr('href');
                            $('.finalprint').removeAttr('onclick');
                            $('.finalprint').attr('href','/patientreceipt/pdf/view/'+data.patient_id+'/'+data.visit_id+'/'+data.receipt_number+'');
                        }
                    });
                })

                })
            }
            else if (ses_id == 1) {
                $.each(data, function(index, visit){
                if (visit.status == 'Pending') {
                    $('.visitlist_modal').append('<tr>\
                    <td>'+visit.visitid+'</td>\
                    <td>\
                        <a href="#" class="visit_date" data-id="'+visit.id+'" data-datedate="'+visit.visit_date+'" data-toggle="modal" data-target="#modal_visit_date" data-backdrop="static">'+visit.visit_date+'</a>\
                    </td>\
                    <td>'+visit.purpose_visit+'</td>\
                    <td style="text-align:right;">'+visit.totalbill+'</td>\
                    <td style="text-align:right;">'+parseFloat(visit.discount)+'</td>\
                    <td style="text-align:right;">'+parseFloat(visit.wh_discount)+'</td>\
                    <td style="text-align:right;font-size:12pt;"><b>'+visit.discounted_total+'</b></td>\
                    <td style="color:red;"><b>'+visit.status+'</b></td>\
                    <td>\
                        <button class="btn btn-xs btn-primary editvisit" data-toggle="modal" data-target="#modal_editvisit" data-p_id="'+visit.patient_id+'" data-v_id="'+visit.visitid+'">Edit</button>\
                        <a href="/visit/'+visit.patient_id+'/'+visit.visitid+'" target="_blank" class="btn btn-xs btn-info">View</a>\
                        <a href="#" class="btn btn-xs btn-danger cancelvisit" data-patient_id="'+visit.patient_id+'" data-visit_id="'+visit.visitid+'">Cancel</a>\
                        <a href="/patient/pdf/view/'+visit.patient_id+'/'+visit.visitid+'" target="_blank" class="btn btn-xs btn-success">Print</a>\
                        <button type="button" class="btn btn-success btn-xs addreceipt" data-toggle="modal" data-target="#modal_addreceipt" data-backdrop="static" data-p_id="'+visit.patient_id+'" data-v_id="'+visit.visitid+'">Print Receipt</button>\
                    </td>\
                    </tr>');
                }
                else if (visit.status == 'Paid') {
                    $('.visitlist_modal').append('<tr>\
                    <td>'+visit.visitid+'</td>\
                    <td>'+visit.visit_date+'</td>\
                    <td>'+visit.purpose_visit+'</td>\
                    <td style="text-align:right;">'+visit.totalbill+'</td>\
                    <td style="text-align:right;">'+parseFloat(visit.discount)+'</td>\
                    <td style="text-align:right;">'+parseFloat(visit.wh_discount)+'</td>\
                    <td style="text-align:right;font-size:12pt;"><b>'+visit.discounted_total+'</b></td>\
                    <td style="color:green;"><b>'+visit.status+'</b></td>\
                    <td>\
                        <a href="/visit/'+visit.patient_id+'/'+visit.visitid+'" target="_blank" class="btn btn-xs btn-info">View</a>\
                        <a href="/patient/pdf/view/'+visit.patient_id+'/'+visit.visitid+'" target="_blank" class="btn btn-xs btn-success">Print</a>\
                        <button type="button" class="btn btn-success btn-xs addreceipt" data-toggle="modal" data-target="#modal_addreceipt" data-backdrop="static" data-p_id="'+visit.patient_id+'" data-v_id="'+visit.visitid+'">Print Receipt</button>\
                    </td>\
                    </tr>');
                }
                else {
                    $('.visitlist_modal').append('<tr>\
                    <td>'+visit.visitid+'</td>\
                    <td>'+visit.visit_date+'</td>\
                    <td>'+visit.purpose_visit+'</td>\
                    <td style="text-align:right;">'+visit.totalbill+'</td>\
                    <td style="text-align:right;">'+parseFloat(visit.discount)+'</td>\
                    <td style="text-align:right;">'+parseFloat(visit.wh_discount)+'</td>\
                    <td style="text-align:right;font-size:12pt;"><b>'+visit.discounted_total+'</b></td>\
                    <td style="color:gold;"><b>'+visit.status+'</b></td>\
                    <td></td>\
                    </tr>');
                }

                $('.receipt_no').on('change',function() {
                    var receipt_no = $(this).val();
                    var patient_id = $(this).data('p_id');
                    var visit_id = $(this).data('v_id');
                    if (!receipt_no) {
                        $('.finalprint').removeAttr('href');
                        $('.finalprint').attr('onclick','return false;');
                    }
                    else {
                        $('.finalprint').removeAttr('href');
                        $('.finalprint').removeAttr('onclick');
                        $('.finalprint').attr('href','/patientreceipt/pdf/view/'+patient_id+'/'+visit_id+'/'+receipt_no+'');
                    }
                })

                $('.addreceipt').on('click',function() {
                    var patient_id = $(this).data('p_id');
                    var visit_id = $(this).data('v_id');
                    $('.receipt_no').removeAttr('data-p_id');
                    $('.receipt_no').removeAttr('data-v_id');
                    $('.receipt_no').attr('data-p_id',patient_id);
                    $('.receipt_no').attr('data-v_id',visit_id);
                    $.get('api/checkreceipt?patient_id=' + patient_id +'&visit_id=' + visit_id, function(data){
                        if (!data.id) {
                            $('.finalprint').removeAttr('href');
                            $('.finalprint').attr('onclick','return false;');
                            $('.receipt_no').removeAttr('value');
                            $('.receipt_no').removeAttr('readonly');
                            $('.receipt_no').val('');
                        }
                        else {
                            $('.receipt_no').removeAttr('value');
                            $('.receipt_no').val(data.receipt_number);
                            $('.receipt_no').attr('readonly','readonly');
                            $('.finalprint').removeAttr('href');
                            $('.finalprint').removeAttr('onclick');
                            $('.finalprint').attr('href','/patientreceipt/pdf/view/'+data.patient_id+'/'+data.visit_id+'/'+data.receipt_number+'');
                        }
                    });
                })

                })
            }
            else {
                $.each(data, function(index, visit){
                if (visit.status == 'Pending') {
                    $('.visitlist_modal').append('<tr>\
                    <td>'+visit.visitid+'</td>\
                    <td>'+visit.visit_date+'</td>\
                    <td>'+visit.purpose_visit+'</td>\
                    <td style="text-align:right;">'+visit.totalbill+'</td>\
                    <td style="text-align:right;">'+parseFloat(visit.discount)+'</td>\
                    <td style="text-align:right;">'+parseFloat(visit.wh_discount)+'</td>\
                    <td style="text-align:right;font-size:12pt;"><b>'+visit.discounted_total+'</b></td>\
                    <td style="color:red;"><b>'+visit.status+'</b></td>\
                    <td>\
                        <a href="/visit/'+visit.patient_id+'/'+visit.visitid+'" target="_blank" class="btn btn-xs btn-info">View</a>\
                        <a href="/patient/pdf/view/'+visit.patient_id+'/'+visit.visitid+'" target="_blank" class="btn btn-xs btn-success">Print</a>\
                    </td>\
                    </tr>');
                }
                else if (visit.status == 'Paid') {
                    $('.visitlist_modal').append('<tr>\
                    <td>'+visit.visitid+'</td>\
                    <td>'+visit.visit_date+'</td>\
                    <td>'+visit.purpose_visit+'</td>\
                    <td style="text-align:right;">'+visit.totalbill+'</td>\
                    <td style="text-align:right;">'+parseFloat(visit.discount)+'</td>\
                    <td style="text-align:right;">'+parseFloat(visit.wh_discount)+'</td>\
                    <td style="text-align:right;font-size:12pt;"><b>'+visit.discounted_total+'</b></td>\
                    <td style="color:green;"><b>'+visit.status+'</b></td>\
                    <td>\
                        <a href="/visit/'+visit.patient_id+'/'+visit.visitid+'" target="_blank" class="btn btn-xs btn-info">View</a>\
                        <a href="/patient/pdf/view/'+visit.patient_id+'/'+visit.visitid+'" target="_blank" class="btn btn-xs btn-success">Print</a>\
                    </td>\
                    </tr>');
                }
                else {
                    $('.visitlist_modal').append('<tr>\
                    <td>'+visit.visitid+'</td>\
                    <td>'+visit.visit_date+'</td>\
                    <td>'+visit.purpose_visit+'</td>\
                    <td style="text-align:right;">'+visit.totalbill+'</td>\
                    <td style="text-align:right;">'+parseFloat(visit.discount)+'</td>\
                    <td style="text-align:right;">'+parseFloat(visit.wh_discount)+'</td>\
                    <td style="text-align:right;font-size:12pt;"><b>'+visit.discounted_total+'</b></td>\
                    <td style="color:gold;"><b>'+visit.status+'</b></td>\
                    <td></td>\
                    </tr>');
                }

                $('.receipt_no').on('change',function() {
                    var receipt_no = $(this).val();
                    if (!receipt_no) {
                        $('.finalprint').removeAttr('href');
                        $('.finalprint').attr('onclick','return false;');
                    }
                    else {
                        $('.finalprint').removeAttr('href');
                        $('.finalprint').removeAttr('onclick');
                        $('.finalprint').attr('href','/patientreceipt/pdf/view/'+visit.patient_id+'/'+visit.visitid+'/'+receipt_no+'');
                    }
                })

                $('.addreceipt').on('click',function() {
                    var patient_id = visit.patient_id;
                    var visit_id = visit.visitid;
                    $.get('api/checkreceipt?patient_id=' + patient_id +'&visit_id=' + visit_id, function(data){
                        if (!data) {
                            $('.finalprint').removeAttr('href');
                            $('.finalprint').attr('onclick','return false;');
                            $('.receipt_no').removeAttr('value');
                            $('.receipt_no').removeAttr('readonly');
                            $('.receipt_no').val('');
                        }
                        else {
                            $('.receipt_no').removeAttr('value');
                            $('.receipt_no').val(data.receipt_number);
                            $('.receipt_no').attr('readonly','readonly');
                            $('.finalprint').removeAttr('href');
                            $('.finalprint').removeAttr('onclick');
                            $('.finalprint').attr('href','/patientreceipt/pdf/view/'+data.patient_id+'/'+data.visit_id+'/'+data.receipt_number+'');
                        }
                    });
                })

                })
            }

            $('.visit_date').on('click',function() {
                var id = $(this).data('id');
                var datedate = $(this).data('datedate');
                
                $('.visit_id_no').empty();
                $('.visit_id_no').text(pad(id,4));
                $('.vid').val(id);
                $('.vdate').val(datedate);
                $('.vdate_check').val(datedate);
            })

            $('.vdate').on('change',function() {
                var now = new Date($(this).val());
                var year = now.getFullYear();
                var month = now.getMonth()+1;
                var day = now.getDate();
                var completedate = year+'/'+month+'/'+day;

                var datedate = $('.vdate_check').val();
                var aa = new Date(datedate);
                var year1 = aa.getFullYear();
                var month1= aa.getMonth()+1;
                var day1 = aa.getDate();
                var datedate1 = year1+'/'+month1+'/'+day1;
                
                if (datedate1 > completedate) {
                    alert('Invalid Date.');
                    $('.vdate').val(datedate);
                }
            })

            $('.donevisit').on('click',function() {
                var patient_id = $(this).data('patient_id');
                var visit_id = $(this).data('visit_id');
                var r = confirm("Done this Visit?");
                    if (r == true) {
                        $.getJSON('/api/donevisit?patient_id=' + patient_id + '&visit_id=' + visit_id, function(data){
                            window.location.reload();
                        })
                    } 
                    else {
                        return false;
                    }
                return false;
            })

            $('.cancelvisit').on('click',function() {
                var patient_id = $(this).data('patient_id');
                var visit_id = $(this).data('visit_id');
                var r = confirm("Cancel this Visit?");
                    if (r == true) {
                        $.getJSON('/api/cancelvisit?patient_id=' + patient_id + '&visit_id=' + visit_id, function(data){
                            window.location.reload();
                        })
                    } 
                    else {
                        return false;
                    }
                return false;
            })

            $('.cateservices').click(function() {
                if ($(this).is(':checked')) {
                    var priceprice = parseFloat($(this).parent().parent().parent().find('.priceprice b').html());
                    var totaltotal = parseFloat($('.totaltotal').html());
                        if (!priceprice) {
                            var price2price = 0.00;
                        }
                        else {
                            var price2price = priceprice;
                        }
                    var totals = price2price + totaltotal;
                    var finaltotal = totals.toFixed(2);
                    $('.totaltotal').empty();
                    $('.totaltotal').append(''+finaltotal+'');
                    $('.totalprice').empty();
                    $('.totalprice').val(finaltotal);
            
                }
                else {
                    var priceprice = parseFloat($(this).parent().parent().parent().find('.priceprice b').html());
                    var totaltotal = parseFloat($('.totaltotal').html());
                        if (!priceprice) {
                            var price2price = 0.00;
                        }
                        else {
                            var price2price = priceprice;
                        }
                    var totals = totaltotal - price2price;
                    var finaltotal = totals.toFixed(2);
                    $('.totaltotal').empty();
                    $('.totaltotal').append(''+finaltotal+'');
                    $('.totalprice').empty();
                    $('.totalprice').val(finaltotal);
                }
            });

            
            $('.editvisit').on( 'click', function(e){
                var p_id = $(this).data('p_id');
                var v_id = $(this).data('v_id');
                $('.editvisit_p_id').removeAttr('value','value');
                $('.editvisit_p_id').attr('value',p_id);
                $('.editvisit_v_id').removeAttr('value','value');
                $('.editvisit_v_id').attr('value',v_id);

                $('.totaltotal').empty();
                $('.totalprice').empty();
                $('.wawsee').remove();
                $('.purpose_visit').empty();

                $('.discount').removeAttr('value');
                $('.wh_discount').removeAttr('value');

                $.get('/api/modalaeditpatient?p_id=' + p_id + '&v_id=' + v_id, function(data){
                    var aa = data.patient.totalbill;
                    var bbaa = aa.replace(/,/g , '');
                    var cc = bbaa.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                    $('.totaltotal').append(''+cc+'');
                    $('.totalprice').val(data.patient.totalbill);
                    $('.purpose_visit').text(data.patient.purpose_visit);

                    if (data.patient.type == 'Walk-in') {
                        $('.12345').show();
                        $('.67890').hide();
                        $('.discount').val(data.patient.discount);
                    }
                    else {
                        $('.12345').hide();
                        $('.67890').show();
                        $('.wh_discount').val(data.patient.wh_discount);
                    }
                    

                $.each(data.adminpanel,function(index,selser) {
                    $.getJSON('/api/submainservices?main_id=' + selser.APC_ID, function(data){
                        $('.'+selser.APC_ID+'').append('<div class="row wawsee">\
                                        <div class="col-sm-2"><input class="form-control ser_qty" type="number" name="ser_qty[]" min="1" value="'+selser.SER_QTY+'"></div>\
                                        <div class="col-sm-4">\
                                            <select class="form-control serser_name service_name'+selser.APC_ID+'" name="service_name[]" required="">\
                                            </select>\
                                        </div>\
                                        <div class="col-sm-2">\
                                            <input class="form-control services" type="text" placeholder="0.00" required="" value="'+selser.AP_PRICE+'" readonly="" autocomplete="off">\
                                            <input class="form-control" name="mainservice[]" value="'+selser.PRICE_AMOUNT+'" type="text" style="display:none;">\
                                        </div>\
                                        <div class="col-sm-1">\
                                            <a href="#" class="removeservice"><i class="fa fa-times fa-2x" style="color:red;"></i></a>\
                                        </div>\
                                        </div>');

                        $('.service_name'+selser.APC_ID+':last').empty();
                        $('.service_name'+selser.APC_ID+':last').append('<option value="">--Select One--</option>');
                            $.each(data,function(index,subsub) {
                                if (selser.AP_ID == subsub.id) {
                                    $('.service_name'+selser.APC_ID+':last').append('<option value="'+subsub.id+'" data-price="'+subsub.price123.price+'" selected>'+subsub.name+'</option>');
                                }
                                else {
                                    $('.service_name'+selser.APC_ID+':last').append('<option value="'+subsub.id+'" data-price="'+subsub.price123.price+'">'+subsub.name+'</option>');
                                }
                            })

                    $('.serser_name').on('change',function() {
                        var serserval = $('option:selected',this).data('price');
                        $(this).parent().parent().find('.services').val(serserval);

                        // var aa = $(this).val();
                        // var bbaa = aa.replace(/,/g , '');
                        // $(this).val( bbaa.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") );

                        var sum = 0;
                        $('.services').each(function() {
                            var qty = $(this).parent().parent().find('.ser_qty').val();
                            var others = $(this).val();
                            var qty_others = parseFloat(qty) * parseFloat(others);
                            var others2 = qty_others;
                                if (others2 == '') {
                                    var oth = 0;
                                }
                                else {
                                    var oth = others2;
                                }
                                    sum += parseFloat(oth);
                        })
                        var cc = sum.toString();
                        var dd = cc.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                        $('.totalprice').val(cc);
                        $('.totaltotal').text(dd);
                    })

                    $('.ser_qty').on('change',function() {
                        var sum = 0;
                            $('.services').each(function() {
                                var qty = $(this).parent().parent().find('.ser_qty').val();
                                var others = $(this).val();
                                var qty_others = parseFloat(qty) * parseFloat(others);
                                var others2 = qty_others;
                                    if (others2 == '') {
                                        var oth = 0;
                                    }
                                    else {
                                        var oth = others2;
                                    }
                                        sum += parseFloat(oth);
                            })
                            var cc = sum.toString();
                            var dd = cc.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                            $('.totalprice').val(cc);
                            $('.totaltotal').text(dd);
                    })

                    $('.removeservice').on('click',function() {
                        $(this).parent().parent().remove();
                        var sum = 0;
                            $('.services').each(function() {
                                var qty = $(this).parent().parent().find('.ser_qty').val();
                                var others = $(this).val();
                                var qty_others = parseFloat(qty) * parseFloat(others);
                                var others2 = qty_others;
                                    if (others2 == '') {
                                        var oth = 0;
                                    }
                                    else {
                                        var oth = others2;
                                    }
                                sum += parseFloat(oth);
                            })
                            var cc = sum.toString();
                            var dd = cc.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                            $('.totalprice').val(cc);
                            $('.totaltotal').text(dd);
                        return false;
                    })

                    });
                })
            })
            });

        })
    });

    $('.editpatient').on( 'click', function(e){
        var p_id = $(this).data('id');
        var v_id = 0;
        $('.edit_p_id').empty();
        $('.edit_fname').empty();
        $('.edit_mname').empty();
        $('.edit_lname').empty();
        $('.edit_address').empty();
        $('.edit_gender').empty();
        $('.edit_dob').empty();
        $('.edit_age').empty();
        
        $('.check_senciz_id').prop('checked',false);
        $('.senciz_id').removeAttr('value');
        $('.senciz_id').val('');
        $('.senciz_id').attr('readonly','readonly');
        $('.check_pwd_id').prop('checked',false);
        $('.pwd_id').removeAttr('value');
        $('.pwd_id').val('');
        $('.pwd_id').attr('readonly','readonly');

        $('.check_senciz_id').on('click',function() {
            if ($('.check_senciz_id').is(':checked')) {
                $('.pwd_id').val("");
                $('.pwd_id').attr('readonly','readonly');
                $('.senciz_id').removeAttr('readonly');
                $('.check_pwd_id').prop('checked',false);
            }
            else {
                $('.senciz_id').val("");
                $('.senciz_id').attr('readonly','readonly');
                $('.check_senciz_id').prop('checked',false);
            }
        })
        $('.check_pwd_id').on('click',function() {
            if ($('.check_pwd_id').is(':checked')) {
                $('.senciz_id').val("");
                $('.senciz_id').attr('readonly','readonly');
                $('.pwd_id').removeAttr('readonly');
                $('.check_senciz_id').prop('checked',false);
            }
            else {
                $('.pwd_id').val("");
                $('.pwd_id').attr('readonly','readonly');
                $('.check_pwd_id').prop('checked',false);
            }
        })

        $.get('api/modalaeditpatient?p_id=' + p_id + '&v_id=' + v_id, function(data){
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

            if (!data.patient.senior_id_no) {
                $('.check_senciz_id').prop('checked',false);
                $('.senciz_id').removeAttr('value','value');
            }
            else {
                $('.check_senciz_id').prop('checked',true);
                $('.senciz_id').val(data.patient.senior_id_no);
                $('.senciz_id').removeAttr('readonly');
            }
            if (!data.patient.pwd_id_no) {
                $('.check_pwd_id').prop('checked',false);
                $('.pwd_id').removeAttr('value','value');
            }
            else {
                $('.check_pwd_id').prop('checked',true);
                $('.pwd_id').val(data.patient.pwd_id_no);
                $('.pwd_id').removeAttr('readonly');
            }

            if (data.patient.type == 'Walk-in') {
                $('.walk').prop("checked", true);
                $('.co').removeAttr('checked');
                $('.12345').show();
            }
            else {
                $('.co').prop("checked", true);
                $('.walk').removeAttr('checked');
                $('.12345').hide();
            }

            $('.type').on('click',function() {
                var type = $(this).val();
                if (type == 'Walk-in') {
                    $('.12345').show();
                }
                else {
                    $('.12345').hide();
                }
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

    $('.appendservice').on('click',function() {
            var main_id = $(this).data('mainid');
            $(this).attr('disabled','disabled');     
            $('.'+main_id+'').append('<div class="row">\
                                    <div class="col-sm-2"><input class="form-control ser_qty" type="number" name="ser_qty[]" min="1" value="1"></div>\
                                    <div class="col-sm-4">\
                                        <select class="form-control serser_name service_name'+main_id+'" name="service_name[]" required="">\
                                        </select>\
                                    </div>\
                                    <div class="col-sm-2">\
                                        <input class="form-control services" type="text" placeholder="0.00" required="" readonly="" autocomplete="off">\
                                        <input class="form-control" name="mainservice[]" value="'+main_id+'" type="text" style="display:none;">\
                                    </div>\
                                    <div class="col-sm-1">\
                                        <a href="#" class="removeservice"><i class="fa fa-times fa-2x" style="color:red;"></i></a>\
                                    </div>\
                                    </div>');

            $.getJSON('/api/submainservices?main_id=' + main_id, function(data){
                $('.service_name'+main_id+':last').empty();
                $('.service_name'+main_id+':last').append('<option value="">--Select One--</option>');
                $.each(data,function(index,subsub) {
                    $('.service_name'+main_id+':last').append('<option value="'+subsub.id+'" data-price="'+subsub.price123.price+'">'+subsub.name+'</option>');
                })
                $('.appendservice').removeAttr('disabled');
            });

            $('.serser_name').on('change',function() {
                var serserval = $('option:selected',this).data('price');
                $(this).parent().parent().find('.services').val(serserval);

                // var aa = $(this).val();
                // var bbaa = aa.replace(/,/g , '');
                // $(this).val( bbaa.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") );

                var sum = 0;
                $('.services').each(function() {
                    var qty = $(this).parent().parent().find('.ser_qty').val();
                    var others = $(this).val();
                    var qty_others = parseFloat(qty) * parseFloat(others);
                    var others2 = qty_others;
                        if (others2 == '') {
                            var oth = 0;
                        }
                        else {
                            var oth = others2;
                        }
                            sum += parseFloat(oth);
                })
                    var cc = sum.toString();
                    var dd = cc.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                    $('.totalprice').val(cc);
                    $('.totaltotal').text(dd);

            })

            $('.ser_qty').on('change',function() {
                var sum = 0;
                $('.services').each(function() {
                    var qty = $(this).parent().parent().find('.ser_qty').val();
                    var others = $(this).val();
                    var qty_others = parseFloat(qty) * parseFloat(others);
                    var others2 = qty_others;
                        if (others2 == '') {
                            var oth = 0;
                        }
                        else {
                            var oth = others2;
                        }
                            sum += parseFloat(oth);
                })
                    var cc = sum.toString();
                    var dd = cc.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                    $('.totalprice').val(cc);
                    $('.totaltotal').text(dd);
            })

            $('.removeservice').on('click',function() {
                $(this).parent().parent().remove();
                var sum = 0;
                    $('.services').each(function() {
                        var qty = $(this).parent().parent().find('.ser_qty').val();
                        var others = $(this).val();
                        var qty_others = parseFloat(qty) * parseFloat(others);
                        var others2 = qty_others;
                            if (others2 == '') {
                                var oth = 0;
                            }
                            else {
                                var oth = others2;
                            }
                                sum += parseFloat(oth);
                            })
                        var cc = sum.toString();
                        var dd = cc.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                        $('.totalprice').val(cc);
                        $('.totaltotal').text(dd);
                return false;
            })

    });

    $('.finalprint').on('click',function() {
        window.location.reload();
    })
</script>
@show

</body>
</html>
