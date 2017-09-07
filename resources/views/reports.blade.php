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

        <li><a href="/dashboard"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>
        <li><a href="/myinfo"><i class="fa fa-info-circle"></i> <span>My Info</span></a></li>
        <li class="treeview"><a href="/NFHSI"><i class="fa fa-users"></i> <span>Patients</span><span class="pull-right-container"></span></a>
            <ul style="display: block;" class="treeview-menu menu-open">
                <li><a href="/newvisit"><i class="fa fa-circle-o"></i> New Visit</a></li>
                <li><a href="/NFHSI"><i class="fa fa-circle-o"></i> Patient List</a></li>
                <li><a href="/generate/medcert"><i class="fa fa-circle-o"></i> Create Medical Certificate</a></li>
            </ul>
        </li>
        @if(Session::get('user') == 1)
        <li><a href="/NFHSI/users"><i class="fa fa-user-md"></i> <span>Users</span></a></li>
        <li class="active"><a href="/reports/{{Session::get('user')}}"><i class="fa fa-bar-chart"></i> <span>Reports</span></a></li>
        <li><a href="/NFHSI/services"><i class="fa fa-flask"></i> <span>Services</span></a></li>
        @elseif(Session::get('user') > 1)
        <li class="active"><a href="/reports/{{Session::get('user')}}"><i class="fa fa-bar-chart"></i> <span>Reports</span></a></li>
        @endif
        <li><a href="/logout"><i class="fa fa-sign-out"></i> <span>Sign out</span></a></li>
    </ul>
</aside>
    
    <!-- Content Wrapper. Contains page content -->
    <div style="min-height: 245px;" class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-bar-chart"></i> Reports</h1>
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
                    <li role="presentation" class="active">
                        <a href="#xrareports" role="tab" data-toggle="tab" style="font-size: 8pt;">X-Ray Reports</a>
                    </li>
                    <li role="presentation">
                        <a href="#labreports" role="tab" data-toggle="tab" style="font-size: 8pt;">Lab Reports</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <!-- X-Ray Reports -->
                        <div role="tabpanel" class="tab-pane active" id="xrareports">
                            <form id="frm_personal_info" class="form-horizontal" method="post" action="#">
                                {!! csrf_field() !!}
                                <input type="text" class="user_id" value="{{$id}}" style="display: none;">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Date From :</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="datepicker" class="form-control datefrom"  placeholder="YYYY-MM-DD" readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Date To :</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="datepicker1" class="form-control dateto"  placeholder="YYYY-MM-DD" readonly="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"></label>
                                    <div class="col-sm-2">
                                        <button class="btn btn-sm btn-primary generate" id="btn-submit-personal_info" type="button" disabled="">Generate</button>
                                        <a href="/pdf/view" class="btn btn-sm btn-success printrep" id="btn-submit-personal_info" type="button" disabled="" target="_blank">Print</a>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-6 Pcount"></div>
                                    <div class="col-sm-6 Income" style="text-align: right;"></div>
                                    <br>
                                    <div class="col-md-12 appendreports"></div>
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

        $(".datefrom").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: "1950:2050",
        changeYear: true,
        changeMonth: true,
        onSelect: function() {
                        $('.Pcount').empty();
                        $('.Income').empty();
                        $('.appendreports').empty();
                        var datefrom = $(this).val();
                        var dateto = $('.dateto').val();
                        if (datefrom <= dateto) {
                            $('.generate').removeAttr('disabled');
                            $('.printrep').removeAttr('disabled');
                        }
                        else {
                            $('.generate').attr('disabled','disabled');
                            $('.printrep').attr('disabled','disabled');
                        }
                    }
    });
        $(".dateto").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: "1950:2050",
        changeYear: true,
        changeMonth: true,
        onSelect: function() {
                        $('.Pcount').empty();
                        $('.Income').empty();
                        $('.appendreports').empty();
                        var dateto = $(this).val();
                        var datefrom = $('.datefrom').val();
                        if (datefrom <= dateto) {
                            $('.generate').removeAttr('disabled');
                            $('.printrep').removeAttr('disabled');
                        }
                        else {
                            $('.generate').attr('disabled','disabled');
                            $('.printrep').attr('disabled','disabled');
                        }
                    }
    });

        $('.generate').on('click',function() {
            var id = $('.user_id').val();
            var datefrom = $(".datefrom").val();
            var dateto = $('.dateto').val();

            if (id == 1) {

            $.get('../../api/reportsreports?id=' + id + '&datefrom=' + datefrom + '&dateto=' + dateto, function(data){
                var count = 0;
                $('.appendreports').append('<table class="table table-striped">\
                    <thead>\
                        <tr>\
                            <th>Physician ID</th>\
                            <th>Physician</th>\
                            <th>Patient Count</th>\
                        </tr>\
                    </thead>\
                    <tbody class="tbodyreports">\
                    </tbody>\
                </table>');
                $.each(data.doctor, function(index, reportmain){
                $.each(data.patientxray, function(index, report){
                    if (!reportmain.m_name) {
                        var m_name = "";
                    }
                    else {
                        var m_name = reportmain.m_name;
                    }
                    if (reportmain.id == report.physician_id) {
                        $('.tbodyreports').append('<tr>\
                            <td>'+reportmain.id+'</td>\
                            <td>'+reportmain.f_name+' '+m_name+' '+reportmain.l_name+', '+reportmain.credential+'</td>\
                            <td>'+report.counter+'</td>\
                        </tr>');
                    } 
                })
                })

                var finalincome = ReplaceNumberWithCommas(data.income);
                $('.Income').append('<b>Income : Php. '+finalincome+'</b>');
            });

            }
            else {

            $.get('../../api/reportsreports?id=' + id + '&datefrom=' + datefrom + '&dateto=' + dateto, function(data){
                var count = 0;
                $('.appendreports').append('<table class="table table-striped">\
                    <thead>\
                        <tr>\
                            <th>Patient ID</th>\
                            <th>Patient Name</th>\
                            <th>Date</th>\
                        </tr>\
                    </thead>\
                    <tbody class="tbodyreports">\
                    </tbody>\
                </table>');

                $.each(data, function(index, report){
                    count++;
                    if (!report.patient.m_name) {
                        var m_name = "";
                    }
                    else {
                        var m_name = report.patient.m_name;
                    }
                    $('.tbodyreports').append('<tr>\
                            <td>'+report.patient.id+'</td>\
                            <td>'+report.patient.f_name+' '+m_name+' '+report.patient.l_name+'</td>\
                            <td>'+report.xray_date+'</td>\
                        </tr>');
                })

                $('.Pcount').append('<b>Patient Count : '+count+'</b>');
                $('.Income').append('<b>Income : Php. 100.00</b>');
            });

            }     
            
        })

        $('.printrep').on('click',function() {
            var id = $('.user_id').val();
            var datefrom = $(".datefrom").val();
            var dateto = $('.dateto').val();
            $(this).removeAttr('href','href');
            $(this).attr('href','/pdf/view/'+id+'/'+datefrom+'/'+dateto+'');
        })
    </script>
@show

</body>
</html>
