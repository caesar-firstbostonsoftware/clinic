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
    max-height:225px;
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
        <li><a href="/dashboard"><img src="{{ asset('/img/2001.png') }}" height="20" width="20"> <span>Dashboard</span></a></li>
        @endif
        @if(Session::get('position') == "Doctor" || Session::get('position') == "Xray" || Session::get('position') == "Labtest" || Session::get('position') == "Cashier")
        <li><a href="/myinfo"><img src="{{ asset('/img/2009.png') }}" height="20" width="20"> <span>My Info</span></a></li>
        @endif
        @if(Session::get('user') == 1 || Session::get('position') == "Cashier")
        <li class="active"><a href="/company"><img src="{{ asset('/img/company.png') }}" height="20" width="20"> <span>Company</span></a></li>
        @endif
        
        <li class="treeview"><a href="/NFHSI"><img src="{{ asset('/img/2010.png') }}" height="20" width="20"> <span>Patients</span><span class="pull-right-container"></span></a>
            <ul style="display: block;" class="treeview-menu menu-open">
            @if(Session::get('user') == 1 || Session::get('position') == "Cashier")
                <li><a href="/newvisit"><i class="fa fa-circle-o"></i> New Visit</a></li>
            @endif
                <li><a href="/NFHSI"><i class="fa fa-circle-o"></i> Patient List</a></li>
            @if(Session::get('position') == "Doctor")
                <li><a href="/generate/medcert"><i class="fa fa-circle-o"></i> Create Medical Certificate</a></li>
            @endif
            </ul>
        </li>

        @if(Session::get('user') == 1)
        <li><a href="/NFHSI/queueing"><img src="{{ asset('/img/queueing.png') }}" height="20" width="20"> <span>Queueing</span></a></li>
        <li><a href="/NFHSI/users"><img src="{{ asset('/img/2012.png') }}" height="20" width="20"> <span>Users</span></a></li>
        <li><a href="/NFHSI/doctors"><img src="{{ asset('/img/2013.png') }}" height="20" width="20"> <span>Doctors</span></a></li>
        <li class="active"><a href="/reports/{{Session::get('user')}}"><img src="{{ asset('/img/2014.png') }}" height="20" width="20"> <span>Reports</span></a></li>
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
        <h1><img src="{{ asset('/img/company.png') }}" alt="" height="30" width="30"> Company</h1>
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">List of Company 
                            @if(Session::get('position') == 'Cashier' || Session::get('user') == 1)
                                <button type="button" class="btn btn-primary btn-xs addcompany" data-toggle="modal" data-target="#modal_addcompany" data-backdrop="static">Add New</button>
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
                                            <tr role="row">
                                                <th style="width: 5%;">ID</th>
                                                <th style="width: 31%;text-align: center;">Name</th>
                                                <th style="width: 16%;text-align: center;">Address</th>
                                                <th style="width: 14%;text-align: center;">Contact No.</th>
                                                <th style="width: 10%;text-align: center;">Status</th>
                                                <th style="width: 14%;text-align: center;">Date Register</th>
                                                <th style="width: 10%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($Company as $comcom)
                                            <?php
                                                $id = $comcom->id;
                                                $zero_id = sprintf("%04d", $id);
                                            ?>
                                            <tr>
                                                <td style="width: 5%;">
                                                    <a href="#" class="viewcompany" data-id="{{$comcom->id}}" data-toggle="modal" data-target="#modal_viewcompany" data-backdrop="static">{{$zero_id}}</a>
                                                </td>
                                                <td style="width: 31%;text-align: center;">{{$comcom->complete_name}}</td>
                                                <td style="width: 16%;text-align: center;">{{$comcom->address}}</td>
                                                <td style="width: 14%;text-align: center;">{{$comcom->contact_no}}</td>
                                                <td style="width: 10%;text-align: center;">{{$comcom->status}}</td>
                                                <td style="width: 14%;text-align: center;">{{$comcom->date_reg}}</td>
                                                <td style="width: 10%;">
                                                    <a href="#" class="viewpatentlist btn btn-primary btn-xs" data-id="{{$comcom->id}}" data-toggle="modal" data-target="#modal_viewpatentlist" data-backdrop="static">Patient List</a>
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

    <!-- MODALS -->
        <div class="modal fade" id="modal_addcompany" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close close_add" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add New Company</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" id="frm_addcompany" method="Post" action="/company">
                        {!! csrf_field() !!}
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Name / Company</label>
                                <div class="col-sm-9">
                                    <input class="form-control completename" id="completename" name="completename" type="text" placeholder="Name / Company" required="" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Address</label>
                                <div class="col-sm-9">
                                    <input class="form-control address" id="address" name="address" type="text" placeholder="Address" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Contact No.</label>
                                <div class="col-sm-9">
                                    <input class="form-control contact_no" id="contact_no" name="contact_no" type="text" placeholder="Contact No." autocomplete="off">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" form="frm_addcompany" class="btn btn-xs btn-primary submitsubmit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal_viewcompany" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close close_add" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit Company</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" id="frm_viewcompany" method="Post" action="/company/viewedit">
                        {!! csrf_field() !!}
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Name / Company</label>
                                <div class="col-sm-9">
                                    <input class="form-control edit_company_id" name="company_id" type="text" style="display: none;">
                                    <input class="form-control edit_completename" id="completename" name="completename" type="text" placeholder="Name / Company" required="" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Address</label>
                                <div class="col-sm-9">
                                    <input class="form-control edit_address" id="address" name="address" type="text" placeholder="Address" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Contact No.</label>
                                <div class="col-sm-9">
                                    <input class="form-control edit_contact_no" id="contact_no" name="contact_no" type="text" placeholder="Contact No." autocomplete="off">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" form="frm_viewcompany" class="btn btn-xs btn-primary submitsubmit">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal_viewpatentlist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document" style="width: 80%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close close_add" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">Patient List</h4>
                    </div>
                    <div class="modal-body">
                        <table id="myTable" class="table table-striped wawee">
                            <thead>
                                <tr role="row">
                                    <th style="width: 5%;">ID</th>
                                    <th style="width: 30%;">Name</th>
                                    <th style="width: 20%;">Address</th>
                                    <th style="width: 10%;">DOB</th>
                                    <th style="width: 10%;">Gender</th>
                                    <th style="width: 10%;">Age</th>
                                    <th style="width: 10%;">Status</th>
                                    <th style="width: 5%;">Action</th>
                                </tr>
                            </thead>
                            <tbody class="appendpatienthere">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal_visits" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document" style="width: 90%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Patient Visits
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
           <b>Powered by</b> <a href="http://www.inovenzo.com" target="_blank">Inovenzo</a> <img src="{{ asset('/img/LOGO.png') }}" height="30" width="30">
        </div> 
    </footer>

</div>
</div>
@section('scripts')
    @include('adminlte::layouts.partials.scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#myTable').DataTable( {
                "order": [[ 0, "desc" ]]
            });
            setTimeout(function(){ 
                $('.topmessage').hide();
            }, 2000);
        });

        function pad (str, max) {
            str = str.toString();
            return str.length < max ? pad("0" + str, max) : str;
        }

        $('.viewcompany').on('click',function() {
            var company_id = $(this).data('id');
            $('.edit_company_id').val('');
            $('.edit_completename').val('');
            $('.edit_address').val('');
            $('.edit_contact_no').val('');
            $.get('/api/viewcompany?company_id=' + company_id, function(data){
                $('.edit_company_id').val(data.id);
                $('.edit_completename').val(data.complete_name);
                $('.edit_address').val(data.address);
                $('.edit_contact_no').val(data.contact_no);
            });
        });

        $('.viewpatentlist').on('click',function() {
            var company_id = $(this).data('id');
            $('.appendpatienthere').empty();
            $.get('/api/viewpatentlist?company_id=' + company_id, function(data){
                $.each(data,function(index,patient) {
                    $('.appendpatienthere').append('<tr>\
                                    <td>'+pad(patient.id,4)+'</td>\
                                    <td>'+patient.f_name+' '+patient.m_name+' '+patient.l_name+'</td>\
                                    <td>'+patient.address+'</td>\
                                    <td>'+patient.dob+'</td>\
                                    <td>'+patient.gender+'</td>\
                                    <td>'+patient.age+'</td>\
                                    <td>'+patient.status+'</td>\
                                    <td><button id="viewvisit" class="btn btn-xs btn-info btn-view-visits viewvisit" data-toggle="modal" data-target="#modal_visits" data-id="'+patient.id+'">View Visits</button></td>\
                                </tr>');

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
                                        <td>'+visit.visit_date+'</td>\
                                        <td>'+visit.purpose_visit+'</td>\
                                        <td style="text-align:right;">'+visit.totalbill+'</td>\
                                        <td style="text-align:right;">'+parseFloat(visit.discount)+'</td>\
                                        <td style="text-align:right;">'+parseFloat(visit.wh_discount)+'</td>\
                                        <td style="text-align:right;font-size:12pt;"><b>'+visit.discounted_total+'</b></td>\
                                        <td style="color:red;"><b>'+visit.status+'</b></td>\
                                        <td>\
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
                                        <td>'+visit.visit_date+'</td>\
                                        <td>'+visit.purpose_visit+'</td>\
                                        <td style="text-align:right;">'+visit.totalbill+'</td>\
                                        <td style="text-align:right;">'+parseFloat(visit.discount)+'</td>\
                                        <td style="text-align:right;">'+parseFloat(visit.wh_discount)+'</td>\
                                        <td style="text-align:right;font-size:12pt;"><b>'+visit.discounted_total+'</b></td>\
                                        <td style="color:red;"><b>'+visit.status+'</b></td>\
                                        <td>\
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
                        })
                    });
                })
            })
        })

    </script>
@show

</body>
</html>
