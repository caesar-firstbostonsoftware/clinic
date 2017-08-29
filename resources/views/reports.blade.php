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
        <li class="header">Negros Family Health Services, Inc.</li>

        <li><a href="/myinfo"><i class="fa fa-info-circle"></i> <span>My Info</span></a></li>
        <li class="treeview"><a href="/NFHSI"><i class="fa fa-users"></i> <span>Patients</span><span class="pull-right-container"></span></a>
            <ul style="display: block;" class="treeview-menu menu-open">
                <li><a href="/newvisit"><i class="fa fa-circle-o"></i> New Visit</a></li>
                <li><a href="/NFHSI"><i class="fa fa-circle-o"></i> Patient List</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Create Medical Certificate</a></li>
            </ul>
        </li>
        @if(Session::get('user') == 1)
        <li><a href="/NFHSI/users"><i class="fa fa-user-md"></i> <span>Users</span></a></li>
        <li class="active"><a href="/reports/{{Session::get('user')}}"><i class="fa fa-bar-chart"></i> <span>Reports</span></a></li>
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
            <li><a href="#">Dashboard</a></li>
            <li><a href="/myinfo">My Info</a></li>
            <li><a href="/NFHSI">Patients</a></li>
            <li><a href="/NFHSI/users">Users</a></li>
            <li class="active"><a href="/reports/{{Session::get('user')}}"><b>Reports</b></a></li>
        </ol>
    </section>
    
    <section class="content">
        <div class="box">
            <div class="box-body">
            <div class="col-md-7"><br>
                <form id="frm_personal_info" class="form-horizontal" method="post" action="#">
                    {!! csrf_field() !!}
                    <input type="text" class="user_id" value="{{$id}}" style="display: none;">
                    <div class="form-group ">
                        <label class="col-sm-2 control-label">Date From :</label>
                        <div class="col-sm-6">
                            <input type="text" id="datepicker" class="form-control datefrom"  placeholder="YYYY-MM-DD" readonly="">
                        </div>
                    </div>
                    <div class="form-group divxrayinfo">
                        <label class="col-sm-2 control-label">Date To :</label>
                        <div class="col-sm-6">
                            <input type="text" id="datepicker1" class="form-control dateto"  placeholder="YYYY-MM-DD" readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-2">
                                <button class="btn btn-sm btn-primary btn-block generate" id="btn-submit-personal_info" type="button" disabled="">Generate</button>
                            </div>
                    </div>
                </form>
            </div><br>
            
            <div class="col-sm-6 Pcount"></div>
            <div class="col-sm-6 Income"></div>
            <br><br><br><br><br><br><br><br>
            <div class="col-md-12 appendreports">
                
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
    <script type="text/javascript">
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
                        var dateto = $(".dateto").val();
                        if (datefrom <= dateto) {
                            $('.generate').removeAttr('disabled');
                        }
                        else {
                            $('.generate').attr('disabled','disabled');
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
                        var datefrom = $(this).val();
                        var dateto = $(".dateto").val();
                        if (datefrom <= dateto) {
                            $('.generate').removeAttr('disabled');
                        }
                        else {
                            $('.generate').attr('disabled','disabled');
                        }
                    }
    });

        $('.generate').on('click',function() {
            var id = $('.user_id').val();
            var datefrom = $(".datefrom").val();
            var dateto = $('.dateto').val();

            $.get('../../api/reportsreports?id=' + id + '&datefrom=' + datefrom + '&dateto=' + dateto, function(data){
                var count = 0;
                $('.appendreports').append('<table class="table table-striped">\
                    <thead>\
                        <tr>\
                            <th>ID</th>\
                            <th>Dr. Incharge</th>\
                            <th>Name</th>\
                            <th>Date</th>\
                        </tr>\
                    </thead>\
                    <tbody class="tbodyreports">\
                    </tbody>\
                </table>');

                $.each(data, function(index, report){
                    count++;
                    if (!report.P_m_name) {
                        var m_name = "";
                    }
                    else {
                        var m_name = report.P_m_name;
                    }
                    $('.tbodyreports').append('<tr>\
                            <td>'+report.patient_id+'</td>\
                            <td>'+report.D_f_name+' '+report.D_m_name+' '+report.D_l_name+', '+report.D_credential+'</td>\
                            <td>'+report.P_f_name+' '+m_name+' '+report.P_l_name+'</td>\
                            <td>'+report.date+'</td>\
                        </tr>');
                })

                $('.Pcount').append('<b>Patient Count : '+count+'</b>');
                $('.Income').append('<b>Income : Php. 100.00</b>');
            });

            
            
        })
    </script>
@show

</body>
</html>
