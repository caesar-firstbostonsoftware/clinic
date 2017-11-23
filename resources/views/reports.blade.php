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
        @if(Session::get('position') == "Doctor" || Session::get('position') == "Xray" || Session::get('position') == "Labtest")
        <li><a href="/myinfo"><img src="{{ asset('/img/2009.png') }}" height="20" width="20"> <span>My Info</span></a></li>
        @endif
        
        <li class="treeview"><a href="/NFHSI"><img src="{{ asset('/img/2010.png') }}" height="20" width="20"> <span>Patients</span><span class="pull-right-container"></span></a>
            <ul style="display: block;" class="treeview-menu menu-open">
                <li><a href="/newvisit"><i class="fa fa-circle-o"></i> New Visit</a></li>
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
        @elseif(Session::get('user') > 1 && Session::get('position') == "Doctor")
        <!-- <li><a href="/NFHSI/queueing"><img src="{{ asset('/img/queueing.png') }}" height="20" width="20"> <span>Queueing</span></a></li> -->
        <li class="active"><a href="/reports/{{Session::get('user')}}"><img src="{{ asset('/img/2014.png') }}" height="20" width="20"> <span>Reports</span></a></li>
        @elseif(Session::get('user') > 1 && Session::get('position') != "Doctor")
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
            <li><a href="/dashboard">Dashboard</a></li>
            <li><a href="/myinfo">My Info</a></li>
            <li><a href="/NFHSI">Patients</a></li>
            <li><a href="/NFHSI/users">Users</a></li>
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
                        <a href="#xrareports" role="tab" data-toggle="tab" style="font-size: 8pt;">X-Ray Reports</a>
                    </li>
                @elseif(Session::get('user') > 1 && Session::get('position') == "Doctor")
                    <li role="presentation" class="active">
                        <a href="#xrareports" role="tab" data-toggle="tab" style="font-size: 8pt;">X-Ray Reports</a>
                    </li>
                @endif
                </ul>
                <div class="tab-content">
                    <!-- Income Reports -->
                    @if(Session::get('user') == 1)
                        <div role="tabpanel" class="tab-pane active" id="incomereports">
                    @elseif(Session::get('user') > 1 && Session::get('position') == "Doctor")
                        <div role="tabpanel" class="tab-pane fade" id="incomereports">
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

                    <!-- X-Ray Reports -->
                    @if(Session::get('user') == 1)
                        <div role="tabpanel" class="tab-pane fade" id="xrareports">
                    @elseif(Session::get('user') > 1 && Session::get('position') == "Doctor")
                        <div role="tabpanel" class="tab-pane active" id="xrareports">
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

        $('.inc_generate').on('click',function() {
            var id = $('.inc_user_id').val();
            var datefrom = $(".inc_datefrom").val();
            var dateto = $('.inc_dateto').val();
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
            if (id == 1) {
                $.get('../../api/xrayreportsreports?id=' + id + '&datefrom=' + datefrom + '&dateto=' + dateto, function(data){
                var count = 0;
                $('.xra_appendreports').append('<table class="table table-striped">\
                    <thead>\
                        <tr>\
                            <th style="text-align: center;">Physician Name</th>\
                            <th style="text-align: center;">Patient Count</th>\
                            <th style="text-align: center;">Amount</th>\
                        </tr>\
                    </thead>\
                    <tbody class="xra_tbodyreports">\
                    </tbody>\
                </table>');
                $.each(data.doctor, function(index, docreport){
                $.each(data.patientxray, function(index, report){
                    if (docreport.id == report.physician_id) {
                        count += report.counter
                        var amount = report.counter * data.xrayprice.price;
                        $('.xra_tbodyreports').append('<tr>\
                            <td style="text-align: center;">'+docreport.f_name+' '+docreport.m_name+' '+docreport.l_name+', '+docreport.credential+'</td>\
                            <td style="text-align: center;">'+report.counter+'</td>\
                            <td style="text-align: center;">'+amount+'</td>\
                        </tr>'); 
                    } 
                })
                })
                var finalincome = ReplaceNumberWithCommas(count * data.xrayprice.price);
                $('.xra_Income').append('<b>Income : Php. '+finalincome+'</b>');
                })
            }
            else {
                $.get('../../api/xrayreportsreports?id=' + id + '&datefrom=' + datefrom + '&dateto=' + dateto, function(data){
                var count = 0;
                $('.xra_appendreports').append('<table class="table table-striped">\
                    <thead>\
                        <tr>\
                            <th style="text-align: center;">Date</th>\
                            <th style="text-align: center;">Patient Count</th>\
                            <th style="text-align: center;">Amount</th>\
                        </tr>\
                    </thead>\
                    <tbody class="xra_tbodyreports">\
                    </tbody>\
                </table>');
                $.each(data.patientxray, function(index, report){
                        count += report.counter
                        var amount = report.counter * data.xrayprice.price;
                        $('.xra_tbodyreports').append('<tr>\
                            <td style="text-align: center;">'+report.xray_date+'</td>\
                            <td style="text-align: center;">'+report.counter+'</td>\
                            <td style="text-align: center;">'+amount+'</td>\
                        </tr>'); 
                    
                })
                var finalincome = ReplaceNumberWithCommas(count * data.xrayprice.price);
                $('.xra_Income').append('<b>Income : Php. '+finalincome+'</b>');
                })
            } 
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
    </script>
@show

</body>
</html>
