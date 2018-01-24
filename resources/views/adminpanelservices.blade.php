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
        @if(Session::get('position') == "Doctor" && Session::get('user') == 1)
        <li><a href="/dashboard"><img src="{{ asset('/img/2001.png') }}" height="20" width="20"> <span>Dashboard</span></a></li>
        @endif
        @if(Session::get('position') == "Doctor" || Session::get('position') == "Xray" || Session::get('position') == "Labtest")
        <li><a href="/myinfo"><img src="{{ asset('/img/2009.png') }}" height="20" width="20"> <span>My Info</span></a></li>
        @endif
        
        <li class="treeview"><a href="/NFHSI"><img src="{{ asset('/img/2010.png') }}" height="20" width="20"> <span>Patients</span><span class="pull-right-container"></span></a>
            <ul style="display: block;" class="treeview-menu menu-open">
            @if(Session::get('user') == 1)
                <li><a href="/newvisit"><i class="fa fa-circle-o"></i> New Visit</a></li>
            @endif
            @if(!Session::get('user'))
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
        <li><a href="/reports/{{Session::get('user')}}"><img src="{{ asset('/img/2014.png') }}" height="20" width="20"> <span>Reports</span></a></li>
        <li class="active"><a href="/NFHSI/services"><img src="{{ asset('/img/2015.png') }}" height="20" width="20"> <span>Services</span></a></li>
        @elseif(Session::get('user') > 1 && Session::get('position') == "Doctor")
        <!-- <li><a href="/NFHSI/queueing"><img src="{{ asset('/img/queueing.png') }}" height="20" width="20"> <span>Queueing</span></a></li> -->
        <li><a href="/reports/{{Session::get('user')}}"><img src="{{ asset('/img/2014.png') }}" height="20" width="20"> <span>Reports</span></a></li>
        @elseif(Session::get('user') > 1 && Session::get('position') != "Doctor")
        <li><a href="/NFHSI/queueing"><img src="{{ asset('/img/queueing.png') }}" height="20" width="20"> <span>Queueing</span></a></li>
        @endif

        @if(!Session::get('user'))
        <li><a href="/reports/0"><img src="{{ asset('/img/2014.png') }}" height="20" width="20"> <span>Reports</span></a></li>
        @endif
        <li><a href="/logout"><img src="{{ asset('/img/2016.png') }}" height="20" width="20"> <span>Sign out</span></a></li>
    </ul>
</aside>
    
    <!-- Content Wrapper. Contains page content -->
    <div style="min-height: 245px;" class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><img src="{{ asset('/img/2015.png') }}" height="30" width="30"> Services</h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard">Dashboard</a></li>
            <li><a href="/myinfo">My Info</a></li>
            <li><a href="/NFHSI">Patients</a></li>
            <li><a href="/NFHSI/users">Users</a></li>
            <li><a href="/reports/{{Session::get('user')}}">Reports</a></li>
            <li class="active"><a href="/NFHSI/services"><b>Services</b></a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">List of Service &nbsp; 
                            <button type="button" class="btn btn-primary btn-xs addserviceadd" data-toggle="modal" data-target="#modal_addservice" data-backdrop="static">Add New</button>
                        </h3>
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
                                                    <th style="width: 80%;">Name</th>
                                                    <th style="width: 10%;">Price</th>
                                                    <th style="width: 10%;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($adminpanelcat as $cat)
                                                <tr>
                                                    <td style="text-transform: uppercase;"><b><i>{{$cat->cat_name}}</i></b></td>
                                                    <td></td>
                                                    <td>
                                                        <a href="#" class="mainedit" data-id="{{$cat->id}}" data-mainname="{{$cat->cat_name}}" data-toggle="modal" data-target="#modal_mainedit" data-backdrop="static"><i class="fa fa-pencil-square-o fa-lg"></i></a>
                                                        &nbsp;&nbsp;&nbsp;
                                                        <a href="#" class="addsub" data-id="{{$cat->id}}" data-toggle="modal" data-target="#modal_addsub" data-backdrop="static"><i class="fa fa-plus-circle fa-lg"></i></a>
                                                    </td>
                                                </tr>
                                                @foreach($adminpanel as $panel)
                                                    @if($cat->id == $panel->admin_panel_cat_id)
                                                        <tr>
                                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$panel->name}}</td>
                                                            <td style="text-align: right;">{{$panel->price123->price}}</td>
                                                            <td>
                                                               <a href="#" class="btn btn-xs editservice" data-id="{{$panel->id}}" data-subid="0" data-toggle="modal" data-target="#modal_edit_services" data-backdrop="static"><i class="fa fa-pencil-square-o fa-lg"></i></a>
                                                               <a href="#" class="btn btn-xs historyservice" data-id="{{$panel->id}}" data-subid="0" data-toggle="modal" data-target="#modal_historyservice" data-backdrop="static"><i class="fa fa-history fa-lg" style="color:brown;"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
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

                                <!-- MODAL MEDICATIONS -->
                                <div class="modal fade" id="modal_edit_services" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close close_medication" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal" id="formeditservices" method="POST" action="/NFHSI/services/edit/service">
                                                {!! csrf_field() !!}
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Name</label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control id_service" id="id_service" name="id_service" type="text" value="" style="display: none;">
                                                            <input class="form-control subid_service" id="subid_service" name="subid_service" type="text" value="" style="display: none;">
                                                            <input class="form-control name_service" id="name_service" name="name_service" type="text" value="" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Price</label>
                                                        <div class="col-sm-4">
                                                            <input class="form-control price_service" id="price_service" name="price_service" type="text" placeholder="Price" autocomplete="off" onkeypress="return isNumberKey(event)">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" form="formeditservices" class="btn btn-primary btn-xs" id="btn-add-medication">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

            <div class="modal fade" id="modal_addservice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close close_add" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">Add New Main Service</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" id="frm_addservice" method="Post" action="/NFHSI/services/addmain">
                            {!! csrf_field() !!}
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Service Description</label>
                                    <div class="col-sm-8">
                                        <input class="form-control sersermain" name="sersermain" type="text" placeholder="Service Description" required="" autocomplete="off">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" form="frm_addservice" class="btn btn-xs btn-primary submitsubmit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal_addsub" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close close_add" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">Add New Sub Service</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" id="frm_addsub" method="Post" action="/NFHSI/services/subadd">
                            {!! csrf_field() !!}
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Service Description</label>
                                    <div class="col-sm-8">
                                        <input class="form-control sub_mainedit_id" name="sub_mainedit_id" type="text" style="display: none;">
                                        <input class="form-control subname" name="subname" type="text" placeholder="Service Description" required="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Price</label>
                                    <div class="col-sm-4">
                                        <input class="form-control price_service" id="price_service" name="price_service" type="text" placeholder="Price" autocomplete="off" onkeypress="return isNumberKey(event)">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" form="frm_addsub" class="btn btn-xs btn-primary submitsubmit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal_mainedit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close close_add" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit Main Service</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" id="frm_mainedit" method="Post" action="/NFHSI/services/editmain">
                            {!! csrf_field() !!}
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Service Description</label>
                                    <div class="col-sm-8">
                                        <input class="form-control mainedit_id" name="mainedit_id" type="text" style="display: none;">
                                        <input class="form-control mainedit_name" name="mainedit_name" type="text" placeholder="Service Description" required="" autocomplete="off">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" form="frm_mainedit" class="btn btn-xs btn-primary submitsubmit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal_historyservice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close close_medication" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">Service Price History</h4>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr role="row">
                                        <th style="width: 50%;">Date</th>
                                        <th style="width: 50%;text-align:right;">Price</th>
                                    </tr>
                                </thead>
                                <tbody class="historyservice_tbody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

                                <!-- END MODAL -->

    </section>
    </div>

    @include('adminlte::layouts.partials.controlsidebar')

    <footer class="main-footer">
        <div style="text-align: right;">
           <b>Powered by</b> <a href="www.inovenzo.com" target="_blank">Inovenzo</a> <img src="{{ asset('/img/LOGO.png') }}" height="30" width="30">
        </div> 
    </footer>

</div><!-- ./wrapper -->
</div>
@section('scripts')
    @include('adminlte::layouts.partials.scripts')
    <script type="text/javascript">
    function isNumberKey(evt)
        {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode != 46 && charCode > 31 
                && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }

        $('.editservice').on('click',function() {
            var main_id = $(this).data('id');
            var sub_id = $(this).data('subid');
            $.get('../../api/editservice?main_id=' + main_id +'&sub_id='+ sub_id, function(data){
                $('.id_service').val(data.id);
                if (!data.admin_panel_id) {
                    $('.subid_service').val(0);
                }
                else {
                    $('.subid_service').val(data.admin_panel_id);
                }
                $('.name_service').val(data.name);
                $('.price_service').val(data.price);
            })
        })

        $('.addsub').on('click',function() {
            var id = $(this).data('id');
            $('.sub_mainedit_id').val(id);
        })

        $('.mainedit').on('click',function() {
            var id = $(this).data('id');
            var mainname = $(this).data('mainname');
            $('.mainedit_id').val(id);
            $('.mainedit_name').val(mainname);
        })

        $('.historyservice').on('click',function() {
            var main_id = $(this).data('id');
            $('.historyservice_tbody').empty();
            $.get('../../api/historyservice?main_id=' + main_id, function(data){
                $.each(data,function(index,history) {
                    $('.historyservice_tbody').append('<tr>\
                        <td>'+history.date_reg+'</td>\
                        <td style="text-align:right;">'+history.price+'</td>\
                        </tr>');
                });
            });
        });
    </script>
@show

</body>
</html>
