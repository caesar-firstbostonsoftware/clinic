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
        @if(Session::get('user') == 1 || Session::get('position') == "Cashier")
        <li><a href="/company"><img src="{{ asset('/img/company.png') }}" height="20" width="20"> <span>Company</span></a></li>
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
        <li class="active"><a href="/reports/{{Session::get('user')}}"><img src="{{ asset('/img/2014.png') }}" height="20" width="20"> <span>Reports</span></a></li>
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
        <h1><img src="{{ asset('/img/2014.png') }}" height="30" width="30"> Reports</h1>
        <ol class="breadcrumb">
            @if(Session::get('user') == 1)
            <li><a href="/dashboard">Dashboard</a></li>
            @endif
            <li><a href="/myinfo">My Info</a></li>
            <li><a href="/NFHSI">Patients</a></li>
            @if(Session::get('user') == 1)
            <li><a href="/NFHSI/users">Users</a></li>
            @endif
            <li class="active"><a href="/reports/{{Session::get('user')}}"><b>Reports</b></a></li>
        </ol>
    </section>
    
    <section class="content">
        <div class="box">
            <div class="box-body">
            <div class="nav-tabs-custom">

                <ul class="nav nav-tabs" role="tablist">
                @if(Session::get('user') == 1)
                    <li role="presentation" class="active">
                        <a href="#incomereports" role="tab" data-toggle="tab" style="font-size: 8pt;">Income Reports</a>
                    </li>
                    <li role="presentation">
                        <a href="#ledger" role="tab" data-toggle="tab" style="font-size: 8pt;">Ledger Reports</a>
                    </li>
                    <li role="presentation">
                        <a href="#xrareports" role="tab" data-toggle="tab" style="font-size: 8pt;">X-Ray Reports</a>
                    </li>
                    <li role="presentation">
                        <a href="#servicereports" role="tab" data-toggle="tab" style="font-size: 8pt;">Service Reports</a>
                    </li>
                    <li role="presentation">
                        <a href="#companyreport" role="tab" data-toggle="tab" style="font-size: 8pt;">Company Reports</a>
                    </li>
                @elseif(Session::get('user') > 1 && Session::get('position') == "Doctor")
                    <li role="presentation" class="active">
                        <a href="#xrareports" role="tab" data-toggle="tab" style="font-size: 8pt;">X-Ray Reports</a>
                    </li>
                @elseif(Session::get('user') > 1 && Session::get('position') == "Cashier")
                    <li role="presentation" class="active">
                        <a href="#incomereports" role="tab" data-toggle="tab" style="font-size: 8pt;">Income Reports</a>
                    </li>
                    <li role="presentation">
                        <a href="#ledger" role="tab" data-toggle="tab" style="font-size: 8pt;">Ledger Reports</a>
                    </li>
                @endif
                </ul>
                <div class="tab-content">
                    <!-- Income Reports -->
                    @if(Session::get('user') == 1)
                        <div role="tabpanel" class="tab-pane active" id="incomereports">
                    @elseif(Session::get('user') > 1 && Session::get('position') == "Doctor")
                        <div role="tabpanel" class="tab-pane fade" id="incomereports">
                    @elseif(Session::get('user') > 1 && Session::get('position') == "Cashier")
                        <div role="tabpanel" class="tab-pane active" id="incomereports">
                    @endif
                            <form id="frm_personal_info" class="form-horizontal" method="post" action="#">
                                {!! csrf_field() !!}
                                <input type="text" class="inc_user_id" value="{{$id}}" style="display: none;">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Date From :</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="datepicker" class="form-control inc_datefrom"  placeholder="YYYY-MM-DD" readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Date To :</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="datepicker1" class="form-control inc_dateto"  placeholder="YYYY-MM-DD" readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"></label>
                                    <div class="col-sm-2">
                                        <button class="btn btn-xs btn-primary inc_generate" id="btn-submit-personal_info" type="button" disabled="">Generate</button>
                                        <a href="/pdf/view" class="btn btn-xs btn-success inc_printrep" id="btn-submit-personal_info" type="button" disabled="" target="_blank">Print</a>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-6 inc_Pcount"></div>
                                    <div class="col-sm-6 inc_Income" style="text-align: right;"></div>
                                    <br>
                                    <div class="col-md-12 inc_appendreports"></div>
                                </div>
                            </form>
                        </div>

                    <!-- Ledger Reports -->
                    <div role="tabpanel" class="tab-pane fade" id="ledger">
                        <form id="frm_personal_info" class="form-horizontal" method="post" action="#">
                            {!! csrf_field() !!}
                            <input type="text" class="ledg_user_id" value="{{$id}}" style="display: none;">

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Date From :</label>
                                <div class="col-sm-3">
                                    <input type="text" id="datepickerledg" class="form-control ledg_datefrom"  placeholder="YYYY-MM-DD" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Date To :</label>
                                <div class="col-sm-3">
                                    <input type="text" id="datepickerledg1" class="form-control ledg_dateto"  placeholder="YYYY-MM-DD" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"></label>
                                <div class="col-sm-2">
                                    <button class="btn btn-xs btn-primary ledg_generate" id="btn-submit-personal_info" type="button" disabled="">Generate</button>
                                    <a href="/pdf/view" class="btn btn-xs btn-success ledg_printrep" id="btn-submit-personal_info" type="button" disabled="" target="_blank">Print</a>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 ledg_appendreports"></div>
                            </div>
                        </form>
                    </div>

                    <!-- X-Ray Reports -->
                    @if(Session::get('user') == 1)
                        <div role="tabpanel" class="tab-pane fade" id="xrareports">
                    @elseif(Session::get('user') > 1 && Session::get('position') == "Doctor")
                        <div role="tabpanel" class="tab-pane active" id="xrareports">
                    @elseif(Session::get('user') > 1 && Session::get('position') == "Cashier")
                        <div role="tabpanel" class="tab-pane fade" id="xrareports">
                    @endif
                            <form id="frm_personal_info" class="form-horizontal" method="post" action="#">
                                {!! csrf_field() !!}
                                <input type="text" class="xra_user_id" value="{{$id}}" style="display: none;">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Date From :</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="datepickerxra" class="form-control xra_datefrom"  placeholder="YYYY-MM-DD" readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Date To :</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="datepickerxra1" class="form-control xra_dateto"  placeholder="YYYY-MM-DD" readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"></label>
                                    <div class="col-sm-2">
                                        <button class="btn btn-xs btn-primary xra_generate" id="btn-submit-personal_info" type="button" disabled="">Generate</button>
                                        <a href="/pdf/view" class="btn btn-xs btn-success xra_printrep" id="btn-submit-personal_info" type="button" disabled="" target="_blank">Print</a>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-6 xra_Pcount"></div>
                                    <div class="col-sm-6 xra_Income" style="text-align: right;"></div>
                                    <br>
                                    <div class="col-md-12 xra_appendreports"></div>
                                </div>
                            </form>
                        </div>

                    <!-- Service Reports -->
                        <div role="tabpanel" class="tab-pane fade" id="servicereports">
                            <form id="frm_personal_info" class="form-horizontal" method="post" action="#">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Date From :</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="datepickerser" class="form-control ser_datefrom"  placeholder="YYYY-MM-DD" readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Date To :</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="datepickerser1" class="form-control ser_dateto"  placeholder="YYYY-MM-DD" readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"></label>
                                    <div class="col-sm-2">
                                        <button class="btn btn-xs btn-primary ser_generate" id="btn-submit-personal_info" type="button" disabled="">Generate</button>
                                        <a href="/pdf/view" class="btn btn-xs btn-success ser_printrep" id="btn-submit-personal_info" type="button" disabled="" target="_blank">Print</a>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 ser_appendreports"></div>
                                </div>
                            </form>
                        </div>

                    <!-- Comapny Reports -->
                        <div role="tabpanel" class="tab-pane fade" id="companyreport">
                            <form id="frm_personal_info" class="form-horizontal" method="post" action="#">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Company Name :</label>
                                    <div class="col-sm-3">
                                        <select class="form-control company_name">
                                            <option value="">--Select One--</option>
                                            @foreach($Company as $comcom)
                                                <option value="{{$comcom->id}}">{{$comcom->complete_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Date From :</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="datepickercompany" class="form-control company_datefrom"  placeholder="YYYY-MM-DD" readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Date To :</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="datepickercompany1" class="form-control company_dateto"  placeholder="YYYY-MM-DD" readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"></label>
                                    <div class="col-sm-2">
                                        <!-- <button class="btn btn-xs btn-primary company_generate" id="btn-submit-personal_info" type="button" disabled="">Generate</button> -->
                                        <a href="/pdf/view" class="btn btn-xs btn-success company_printrep" id="btn-submit-personal_info" type="button" disabled="" target="_blank">Print</a>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 company_appendreports"></div>
                                </div>
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
        <div style="text-align: right;">
           <b>Powered by</b> <a href="http://www.inovenzo.com" target="_blank">Inovenzo</a> <img src="{{ asset('/img/LOGO.png') }}" height="30" width="30">
        </div> 
    </footer>

</div><!-- ./wrapper -->
</div>
@section('scripts')
    @include('adminlte::layouts.partials.scripts')
    <script type="text/javascript">
        function ReplaceNumberWithCommas(yourNumber) {
            var n= yourNumber.toString().split(".");
            n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return n.join(".");
        }

        $(".inc_datefrom").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: "1950:2050",
        changeYear: true,
        changeMonth: true,
        onSelect: function() {
                        $('.inc_Pcount').empty();
                        $('.inc_Income').empty();
                        $('.inc_appendreports').empty();
                        var datefrom = $(this).val();
                        var dateto = $('.inc_dateto').val();
                        if (datefrom <= dateto) {
                            $('.inc_generate').removeAttr('disabled');
                            $('.inc_printrep').removeAttr('disabled');
                        }
                        else {
                            $('.inc_generate').attr('disabled','disabled');
                            $('.inc_printrep').attr('disabled','disabled');
                        }
                    }
    });
        $(".xra_datefrom").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: "1950:2050",
        changeYear: true,
        changeMonth: true,
        onSelect: function() {
                        $('.xra_Pcount').empty();
                        $('.xra_Income').empty();
                        $('.xra_appendreports').empty();
                        var datefrom = $(this).val();
                        var dateto = $('.xra_dateto').val();
                        if (datefrom <= dateto) {
                            $('.xra_generate').removeAttr('disabled');
                            $('.xra_printrep').removeAttr('disabled');
                        }
                        else {
                            $('.xra_generate').attr('disabled','disabled');
                            $('.xra_printrep').attr('disabled','disabled');
                        }
                    }
    });

        $(".inc_dateto").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: "1950:2050",
        changeYear: true,
        changeMonth: true,
        onSelect: function() {
                        $('.inc_Pcount').empty();
                        $('.inc_Income').empty();
                        $('.inc_appendreports').empty();
                        var dateto = $(this).val();
                        var datefrom = $('.inc_datefrom').val();
                        if (datefrom <= dateto) {
                            $('.inc_generate').removeAttr('disabled');
                            $('.inc_printrep').removeAttr('disabled');
                        }
                        else {
                            $('.inc_generate').attr('disabled','disabled');
                            $('.inc_printrep').attr('disabled','disabled');
                        }
                    }
    });
        $(".xra_dateto").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: "1950:2050",
        changeYear: true,
        changeMonth: true,
        onSelect: function() {
                        $('.xra_Pcount').empty();
                        $('.xra_Income').empty();
                        $('.xra_appendreports').empty();
                        var dateto = $(this).val();
                        var datefrom = $('.xra_datefrom').val();
                        if (datefrom <= dateto) {
                            $('.xra_generate').removeAttr('disabled');
                            $('.xra_printrep').removeAttr('disabled');
                        }
                        else {
                            $('.xra_generate').attr('disabled','disabled');
                            $('.xra_printrep').attr('disabled','disabled');
                        }
                    }
    });

        $(".ser_datefrom").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: "1950:2050",
        changeYear: true,
        changeMonth: true,
        onSelect: function() {
                        $('.ser_Pcount').empty();
                        $('.ser_Income').empty();
                        $('.ser_appendreports').empty();
                        var datefrom = $(this).val();
                        var dateto = $('.ser_dateto').val();
                        if (datefrom <= dateto) {
                            $('.ser_generate').removeAttr('disabled');
                            $('.ser_printrep').removeAttr('disabled');
                        }
                        else {
                            $('.ser_generate').attr('disabled','disabled');
                            $('.ser_printrep').attr('disabled','disabled');
                        }
                    }
    });

        $(".ser_dateto").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: "1950:2050",
        changeYear: true,
        changeMonth: true,
        onSelect: function() {
                        $('.ser_Pcount').empty();
                        $('.ser_Income').empty();
                        $('.ser_appendreports').empty();
                        var dateto = $(this).val();
                        var datefrom = $('.ser_datefrom').val();
                        if (datefrom <= dateto) {
                            $('.ser_generate').removeAttr('disabled');
                            $('.ser_printrep').removeAttr('disabled');
                        }
                        else {
                            $('.ser_generate').attr('disabled','disabled');
                            $('.ser_printrep').attr('disabled','disabled');
                        }
                    }
    });

        $(".ledg_datefrom").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: "1950:2050",
        changeYear: true,
        changeMonth: true,
        onSelect: function() {
                        $('.ledg_Pcount').empty();
                        $('.ledg_Income').empty();
                        $('.ledg_appendreports').empty();
                        var datefrom = $(this).val();
                        var dateto = $('.ledg_dateto').val();
                        if (datefrom <= dateto) {
                            $('.ledg_generate').removeAttr('disabled');
                            $('.ledg_printrep').removeAttr('disabled');
                        }
                        else {
                            $('.ledg_generate').attr('disabled','disabled');
                            $('.ledg_printrep').attr('disabled','disabled');
                        }
                    }
    });

        $(".ledg_dateto").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: "1950:2050",
        changeYear: true,
        changeMonth: true,
        onSelect: function() {
                        $('.ledg_Pcount').empty();
                        $('.ledg_Income').empty();
                        $('.ledg_appendreports').empty();
                        var dateto = $(this).val();
                        var datefrom = $('.ledg_datefrom').val();
                        if (datefrom <= dateto) {
                            $('.ledg_generate').removeAttr('disabled');
                            $('.ledg_printrep').removeAttr('disabled');
                        }
                        else {
                            $('.ledg_generate').attr('disabled','disabled');
                            $('.ledg_printrep').attr('disabled','disabled');
                        }
                    }
    });

        $(".company_datefrom").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: "1950:2050",
        changeYear: true,
        changeMonth: true,
        onSelect: function() {
                        $('.company_Pcount').empty();
                        $('.company_Income').empty();
                        $('.company_appendreports').empty();
                        var datefrom = $(this).val();
                        var dateto = $('.company_dateto').val();
                        if (datefrom <= dateto) {
                            $('.company_generate').removeAttr('disabled');
                            $('.company_printrep').removeAttr('disabled');
                        }
                        else {
                            $('.company_generate').attr('disabled','disabled');
                            $('.company_printrep').attr('disabled','disabled');
                        }
                    }
    });

        $(".company_dateto").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: "1950:2050",
        changeYear: true,
        changeMonth: true,
        onSelect: function() {
                        $('.company_Pcount').empty();
                        $('.company_Income').empty();
                        $('.company_appendreports').empty();
                        var dateto = $(this).val();
                        var datefrom = $('.company_datefrom').val();
                        if (datefrom <= dateto) {
                            $('.company_generate').removeAttr('disabled');
                            $('.company_printrep').removeAttr('disabled');
                        }
                        else {
                            $('.company_generate').attr('disabled','disabled');
                            $('.company_printrep').attr('disabled','disabled');
                        }
                    }
    });

        $('.inc_generate').on('click',function() {
            var id = $('.inc_user_id').val();
            var datefrom = $(".inc_datefrom").val();
            var dateto = $('.inc_dateto').val();
            $('.inc_appendreports').empty();
            $('.inc_Income').empty();
            $.get('../../api/reportsreports?id=' + id + '&datefrom=' + datefrom + '&dateto=' + dateto, function(data){
                var count = 0;
                $('.inc_appendreports').append('<table class="table table-striped">\
                    <thead>\
                        <tr>\
                            <th style="text-align: center;">Date</th>\
                            <th style="text-align: center;">Patient Count</th>\
                        </tr>\
                    </thead>\
                    <tbody class="inc_tbodyreports">\
                    </tbody>\
                </table>');
                $.each(data.patientxray, function(index, report){
                        $('.inc_tbodyreports').append('<tr>\
                            <td style="text-align: center;">'+report.visit_date+'</td>\
                            <td style="text-align: center;">'+report.counter+'</td>\
                        </tr>');   
                })
                var finalincome = ReplaceNumberWithCommas(data.income);
                $('.inc_Income').append('<b>Income : Php. '+finalincome+'</b>');
            });    
        })

        $('.xra_generate').on('click',function() {
            var id = $('.xra_user_id').val();
            var datefrom = $(".xra_datefrom").val();
            var dateto = $('.xra_dateto').val();
            $('.xra_appendreports').empty();
            $('.xra_Income').empty();
                $.get('../../api/xrayreportsreports?id=' + id + '&datefrom=' + datefrom + '&dateto=' + dateto, function(data){
                    var count = 0;
                    $('.xra_appendreports').append('<table class="table table-striped">\
                        <thead>\
                            <tr>\
                                <th style="text-align: center;">Date</th>\
                                <th style="text-align: center;">Xray Count</th>\
                            </tr>\
                        </thead>\
                        <tbody class="xra_tbodyreports">\
                        </tbody>\
                    </table>');
                    $.each(data.patientxray, function(index, report){
                        $('.xra_tbodyreports').append('<tr>\
                            <td style="text-align: center;">'+report.date_reg+'</td>\
                            <td style="text-align: center;">'+report.counter+'</td>\
                        </tr>');   
                    })
                }) 
        })

        $('.ser_generate').on('click',function() {
            var datefrom = $(".ser_datefrom").val();
            var dateto = $('.ser_dateto').val();
            $('.ser_appendreports').empty();
            $('.ser_Income').empty();
                $.get('../../api/servicereportsreports?datefrom=' + datefrom + '&dateto=' + dateto, function(data){
                    $('.ser_appendreports').append('<table class="table table-striped">\
                        <thead>\
                            <tr>\
                                <th style="text-align: center;">Service Description</th>\
                                <th style="text-align: center;">Patient Count</th>\
                                <th style="text-align: center;">Date</th>\
                            </tr>\
                        </thead>\
                        <tbody class="ser_tbodyreports">\
                        </tbody>\
                    </table>');
                    $.each(data, function(index, report){
                            $('.ser_tbodyreports').append('<tr>\
                                <td style="text-align: center;">'+report.service_name+'</td>\
                                <td style="text-align: center;">'+report.counter+'</td>\
                                <td style="text-align: center;">'+report.date_reg+'</td>\
                            </tr>');   
                    })
                }) 
        })

        $('.ledg_generate').on('click',function() {
            var datefrom = $(".ledg_datefrom").val();
            var dateto = $('.ledg_dateto').val();
            $('.ledg_appendreports').empty();
            $('.ledg_Income').empty();
            $.get('../../api/ledgerreports?datefrom=' + datefrom + '&dateto=' + dateto, function(data){
                $('.ledg_appendreports').append('<table class="table table-striped">\
                    <thead>\
                        <tr>\
                            <th style="width:9%;font-size:8pt;">Date</th>\
                            <th style="width:9%;font-size:8pt;">OR No.</th>\
                            <th style="width:40%;font-size:8pt;">Service(s)</th>\
                            <th style="text-align: right;width:6%;font-size:8pt;">Laboratory</th>\
                            <th style="text-align: right;width:6%;font-size:8pt;">Ultrasound</th>\
                            <th style="text-align: right;width:6%;font-size:8pt;">Xray</th>\
                            <th style="text-align: right;width:6%;font-size:8pt;">ECG</th>\
                            <th style="text-align: right;width:6%;font-size:8pt;">Amount</th>\
                            <th style="text-align: right;width:6%;font-size:8pt;">Discount</th>\
                            <th style="text-align: right;width:6%;font-size:8pt;">Total</th>\
                        </tr>\
                    </thead>\
                    <tbody class="ledg_tbodyreports">\
                    </tbody>\
                </table>');
                var total1 = 0;
                var total2 = 0;
                var total3 = 0;
                var total4 = 0;
                var total5 = 0;
                var total6 = 0;
                var total7 = 0;
                $.each(data.PatientVisit, function(index, ledgerreport){
                    if (!ledgerreport.receipt) {
                        var rere = '';
                    }
                    else {
                        var rere = ledgerreport.receipt.receipt_number;
                    }
                        $('.ledg_tbodyreports').append('<tr>\
                            <td style="width:9%;font-size:8pt;">'+ledgerreport.visit_date+'</td>\
                            <td style="width:9%;font-size:8pt;">'+rere+'</td>\
                            <td style="width:40%;font-size:8pt;" class="putservice"></td>\
                            <td style="text-align: right;width:6%;font-size:8pt;" class="putlab"></td>\
                            <td style="text-align: right;width:6%;font-size:8pt;" class="putultra"></td>\
                            <td style="text-align: right;width:6%;font-size:8pt;" class="putxray"></td>\
                            <td style="text-align: right;width:6%;font-size:8pt;" class="putecg"></td>\
                            <td style="text-align: right;width:6%;font-size:8pt;">'+ReplaceNumberWithCommas(ledgerreport.totalbill)+'</td>\
                            <td style="text-align: right;width:6%;font-size:8pt;">'+ReplaceNumberWithCommas(ledgerreport.discounted_price)+'</td>\
                            <td style="text-align: right;width:6%;font-size:8pt;">'+ReplaceNumberWithCommas(ledgerreport.discounted_total)+'</td>\
                        </tr>');
                        var sum1 = 0;
                        var sum2 = 0;
                        var sum3 = 0;
                        var sum4 = 0;
                        total5 += parseFloat(ledgerreport.totalbill);
                        total6 += parseFloat(ledgerreport.discounted_price);
                        total7 += parseFloat(ledgerreport.discounted_total);
                        $.each(ledgerreport.service, function(index, ledgerservice){
                            $.each(data.AdminPanel, function(index, adminpanel){
                                if (ledgerreport.visitid == ledgerservice.visit_id) {
                                    if (ledgerservice.admin_panel_sub_id == adminpanel.id) {
                                        $('.putservice:last').append(''+adminpanel.name+',');

                                        if (adminpanel.type == 'Package') {
                                            $.each(adminpanel.package,function(index,package) {
                                                if (package.main_id == 1 || package.main_id == 2 || package.main_id == 3 || package.main_id == 4 || package.main_id == 7 || package.main_id == 8 || package.main_id == 9 || package.main_id == 10 ) {
                                                    if (package.service_id == 92) {
                                                    }
                                                    else {
                                                        sum1 += parseFloat(package.price);
                                                    }
                                                }
                                                if (package.main_id == 6) {
                                                    sum2 += parseFloat(package.price);
                                                }
                                                if (package.main_id == 5) {
                                                    sum3 += parseFloat(package.price);
                                                }
                                                if (package.service_id == 92) {
                                                    sum4 += parseFloat(package.price);
                                                }
                                            })
                                        }
                                        else {
                                            if (ledgerservice.admin_panel_id == 1 || ledgerservice.admin_panel_id == 2 || ledgerservice.admin_panel_id == 3 || ledgerservice.admin_panel_id == 4 || ledgerservice.admin_panel_id == 7 || ledgerservice.admin_panel_id == 8 || ledgerservice.admin_panel_id == 9 || ledgerservice.admin_panel_id == 10 ) {
                                                if (ledgerservice.admin_panel_sub_id == 92) {
                                                }
                                                else {
                                                    sum1 += parseFloat(adminpanel.price);
                                                }
                                            }
                                            if (ledgerservice.admin_panel_id == 6) {
                                                sum2 += parseFloat(adminpanel.price);
                                            }
                                            if (ledgerservice.admin_panel_id == 5) {
                                                sum3 += parseFloat(adminpanel.price);
                                            }
                                            if (ledgerservice.admin_panel_sub_id == 92) {
                                                sum4 += parseFloat(adminpanel.price);
                                            }
                                        }
                                        
                                    }
                                }
                            })
                        })
                        $('.putlab:last').append(''+ReplaceNumberWithCommas(sum1)+'');
                        $('.putultra:last').append(''+ReplaceNumberWithCommas(sum2)+'');
                        $('.putxray:last').append(''+ReplaceNumberWithCommas(sum3)+'');
                        $('.putecg:last').append(''+ReplaceNumberWithCommas(sum4)+'');
                        total1 += parseFloat(sum1);
                        total2 += parseFloat(sum2);
                        total3 += parseFloat(sum3);
                        total4 += parseFloat(sum4);
                })
                $('.ledg_tbodyreports').append('<tr>\
                                <td style="font-size:8pt;"></td>\
                                <td style="font-size:8pt;"></td>\
                                <td style="text-align: right;font-size:8pt;"><b>TOTAL (Php)</b></td>\
                                <td style="text-align: right;color:red;font-weight: bold;font-size:8pt;" class="putlab_total"></td>\
                                <td style="text-align: right;color:red;font-weight: bold;font-size:8pt;" class="putultra_total"></td>\
                                <td style="text-align: right;color:red;font-weight: bold;font-size:8pt;" class="putxray_total"></td>\
                                <td style="text-align: right;color:red;font-weight: bold;font-size:8pt;" class="putecg_total"></td>\
                                <td style="text-align: right;color:red;font-weight: bold;font-size:8pt;" class="put_amount"></td>\
                                <td style="text-align: right;color:red;font-weight: bold;font-size:8pt;" class="put_discount"></td>\
                                <td style="text-align: right;color:red;font-weight: bold;font-size:8pt;" class="put_total"></td>\
                        </tr>');
                $('.putlab_total:last').append(''+ReplaceNumberWithCommas(total1)+'');
                $('.putultra_total:last').append(''+ReplaceNumberWithCommas(total2)+'');
                $('.putxray_total:last').append(''+ReplaceNumberWithCommas(total3)+'');
                $('.putecg_total:last').append(''+ReplaceNumberWithCommas(total4)+'');
                $('.put_amount:last').append(''+ReplaceNumberWithCommas(total5)+'');
                $('.put_discount:last').append(''+ReplaceNumberWithCommas(total6)+'');
                $('.put_total:last').append(''+ReplaceNumberWithCommas(total7)+'');
            });    
        })

        $('.inc_printrep').on('click',function() {
            var id = $('.inc_user_id').val();
            var datefrom = $(".inc_datefrom").val();
            var dateto = $('.inc_dateto').val();
            $(this).removeAttr('href','href');
            $(this).attr('href','/pdf/view/'+id+'/'+datefrom+'/'+dateto+'');
        })

        $('.xra_printrep').on('click',function() {
            var id = $('.xra_user_id').val();
            var datefrom = $(".xra_datefrom").val();
            var dateto = $('.xra_dateto').val();
            $(this).removeAttr('href','href');
            $(this).attr('href','/pdf/view2/'+id+'/'+datefrom+'/'+dateto+'');
        })

        $('.ser_printrep').on('click',function() {
            var datefrom = $(".ser_datefrom").val();
            var dateto = $('.ser_dateto').val();
            $(this).removeAttr('href','href');
            $(this).attr('href','/pdf/viewservice/'+datefrom+'/'+dateto+'');
        })

        $('.ledg_printrep').on('click',function() {
            var datefrom = $(".ledg_datefrom").val();
            var dateto = $('.ledg_dateto').val();
            $(this).removeAttr('href','href');
            $(this).attr('href','/pdf/viewledger/'+datefrom+'/'+dateto+'');
        })

        $('.company_printrep').on('click',function() {
            var datefrom = $(".company_datefrom").val();
            var dateto = $('.company_dateto').val();
            var company_id = $('.company_name option:selected').val();
            $(this).removeAttr('href','href');
            $(this).attr('href','/pdf/viewcompanyreport/'+datefrom+'/'+dateto+'/'+company_id+'');
        })
    </script>
@show

</body>
</html>
