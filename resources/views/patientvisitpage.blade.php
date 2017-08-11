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
    .neg { 
        margin-top: -.4%;
    }
    .nor{
        margin-top: -1%;
    }
    .divxrayinfo{
        margin-top: -2%;
    }
    .modalwidth{
        width: 75%;
    }
</style>

<body class="skin-blue sidebar-mini">
<div id="app" v-cloak>
    <div class="wrapper">

    @include('adminlte::layouts.partials.mainheader')

    <!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview active"><a href="#"><i class="fa fa-users"></i> <span>Patients</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                <ul style="display: block;" class="treeview-menu menu-open">
                    <li class="active"><a href="/newvisit"><i class="fa fa-circle-o"></i> New Visit</a></li>
                    <li><a href="/"><i class="fa fa-circle-o"></i> Patient List</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Create Medical Certificate</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-user-md"></i> <span>Users</span></a></li>
            <li><a href="#"><i class="fa fa-cogs"></i> <span>Settings</span></a></li>
            <li><a href="#"><i class="fa fa-sign-out"></i> <span>Sign out</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

    <!-- Content Wrapper. Contains page content -->
    <div style="min-height: 245px;" class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-users"></i> Patients</h1>
        <ol class="breadcrumb">
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Patients</a></li>
            <li class="active">Visit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Patient Visit 
                    <a href="#" class="btn btn-warning btn-sm" target="_blank"> Generate Medical Certificate</a>
                    <a href="#" class="btn btn-info btn-sm" target="_blank"> Preview</a>
                </h3>
            </div>
            <div class="box-body">
                <input id="pid" name="pid" value="1" type="hidden">
                <input id="vid" name="vid" value="1" type="hidden">
            <div class="nav-tabs-custom">
    <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#personal_info" aria-controls="personal_info" role="tab" data-toggle="tab">Personal Info</a>
                    </li>
                    <li role="presentation">
                        <a href="#consult_reason" aria-controls="consult_reason" role="tab" data-toggle="tab">Reason for Consulation</a>
                    </li>
                    <li role="presentation">
                        <a href="#medical_history" aria-controls="medical_history" role="tab" data-toggle="tab">Past Medical History</a>
                    </li>
                    <li role="presentation">
                        <a href="#social_history" aria-controls="social_history" role="tab" data-toggle="tab">Social History</a>
                    </li>
                    <li role="presentation">
                        <a href="#physical_exam" aria-controls="physical_exam" role="tab" data-toggle="tab">Physical Exam</a>
                    </li>
                    <li role="presentation">
                        <a href="#diagnosis" aria-controls="diagnosis" role="tab" data-toggle="tab">Diagnosis</a>
                    </li>
                    <li role="presentation">
                        <a href="#plan" aria-controls="plan" role="tab" data-toggle="tab">Plan</a>
                    </li>
                    <li role="presentation">
                        <a href="#medications" aria-controls="medications" role="tab" data-toggle="tab">Medications</a>
                    </li>
                    <li role="presentation">
                        <a href="#xray" aria-controls="xrays" role="tab" data-toggle="tab">X-ray</a>
                    </li>
                </ul>

                <div role="tabpanel" class="tab-pane fade" id="xray">
                    <div class="col-md-12">
                        <h3>X-ray 
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_xraynew" data-backdrop="static">Add New
                            </button>
                            <a href="http://demo_emr.jwits.co/patients/visit/print-medication/1" target="_blank" class="btn btn-warning">Generate Record</a>
                        </h3>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Physician</th>
                                        <th class="text-center">Result</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="medication_list">
                                @foreach($patientxray as $xray)
                                    <tr id="med1">
                                        <td>{{$xray->xray_date}}</td>
                                        <td>
                                            @foreach($doctor as $doc)
                                                @if($doc->id == $xray->physician_id)
                                                {{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{$xray->finding}}</td>
                                        <td>{{$xray->status}}</td>
                                        <td><button class="btn btn-sm btn-primary btn-edit-xray">Edit</button></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="modal fade" id="modal_xraynew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modalwidth" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="table-responsive">
                                    <div class="col-md-12">
                                        <center><h3 class="neg">NEGROS FAMILY HEALTH SERVICES INC.</h3></center>
                                        <center><p class="nor">North Road, Daro(in front of NOPH) Dumaguete City, Negros Oriental</p></center>
                                        <center><p class="nor">Tel. No. (035) 225-3544</p></center>
                                        <h4><b>X-RAY / ULTRASOUND</b></h4>

                                        <form class="form-horizontal" method="POST" action="/visit/{{$id}}/{{$vid}}">
                                        {!! csrf_field() !!}
                                            <div class="form-group">
                                                <label class="col-sm-1 control-label">Name:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="P_id" value="{{$id}}" style="display: none;">
                                                    <input type="text" name="P_name" required="" class="form-control" placeholder="Name" value="{{$patient->f_name}} {{$patient->m_name}} {{$patient->l_name}}" readonly="">
                                                </div>
                                                <label class="col-sm-2 control-label">O.R. No.</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="orno" class="form-control" placeholder="O.R. No.">
                                                </div>
                                            </div>
                                            <div class="form-group divxrayinfo">
                                                <label class="col-sm-1 control-label">Address:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="address" required="" class="form-control" placeholder="Address" value="{{$patient->address}}" readonly="">
                                                </div>
                                                <label class="col-sm-2 control-label">Age/Sex:</label>
                                                <div class="col-sm-3">
                                                    <select id="agesex" name="agesex" class="form-control" required=""> 
                                                        <option value="{{$patient->gender}}" selected="">{{$patient->gender}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group divxrayinfo">
                                                <label class="col-sm-1 control-label">Physician:</label>
                                                <div class="col-sm-6">
                                                    <select id="physician" name="physician" class="form-control physician" required=""> 
                                                        <option value="">- Select -</option>
                                                        @foreach($doctor as $doc)
                                                            <option data-id="{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}-{{$doc->specialization}}" value="{{$doc->id}}" >{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <label class="col-sm-2 control-label">Date:</label>
                                                <div class="col-sm-3">
                                                <?php $datenow = date("Y-m-d"); ?>
                                                    <input type="text" id="datepicker" name="xraydate" class="form-control xraydate" required="" value="{{$datenow}}">
                                                </div>
                                            </div>

                                            <h5><b>Result / Finding :</b></h5>

                                            <div class="form-group divxrayinfo">
                                                <div class="col-sm-6">
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="finding" checked="" value="Normal" class="noramlfinding">Normal</label>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <label><input type="checkbox" value="Not Normal" class="notnoramlfinding">Not Normal</label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group divxrayinfo">
                                                <div class="col-sm-12 fnnormal">
                                                    <textarea class="form-control txtcommnor" name="comm" rows="5" id="comment">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet.
                                                    </textarea>
                                                </div>
                                                <div class="col-sm-12 fnnotnormal" style="display: none;">
                                                    <textarea class="form-control txtcommnotnor" rows="5" id="comment">123Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet.
                                                    </textarea>
                                                </div>
                                            </div>

                                            <div class="form-group phyname divxrayinfo"></div>
                                            <div class="form-group phypos"></div>

                                            <div class="form-group">
                                                <label for="inputEmail3" class="control-label"></label>
                                                <div class="col-sm-3">
                                                    <button class="btn btn-lg btn-primary btn-block" id="btn-submit-social_history" type="submit" data-loading-text="Submitting..." autocomplete="off">Submit</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
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
@show

<script type="text/javascript">
    $(".xraydate").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: "1950:2050",
        changeYear: true,
        changeMonth: true,
    });
    
    $('.noramlfinding').click(function() {
        if ($(this).is(':checked')) {
            $('.noramlfinding').attr('checked');
            $('.noramlfinding').attr('name','finding');

            $('.notnoramlfinding').prop('checked', false);
            $('.notnoramlfinding').removeAttr('name','finding');

            $('.fnnormal').show();
            $('.txtcommnor').attr('name','comm');

            $('.fnnotnormal').hide();
            $('.txtcommnotnor').removeAttr('name','comm');
        }
    });
    $('.notnoramlfinding').click(function() {
        if ($(this).is(':checked')) {
            $('.notnoramlfinding').attr('checked');
            $('.notnoramlfinding').attr('name','finding');

            $('.noramlfinding').prop('checked', false);
            $('.noramlfinding').removeAttr('name','finding');

            $('.fnnotnormal').show();
            $('.txtcommnotnor').attr('name','comm');

            $('.fnnormal').hide();
            $('.txtcommnor').removeAttr('name','comm');
        }
    });

    $( ".physician" ).change(function() {
        var dataid = $(this).find(':selected').data('id');
        var phy  = $(this).val();
        var phynamepos = dataid.split('-');
        var name = phynamepos[0];
        var pos = phynamepos[1];

        $('.phyname').empty();
        $('.phypos').empty();
        $('.phyname').append('<label class="col-sm-5 control-label" style="text-align: left;"><b>'+name+'</b></label>');
        $('.phypos').append('<label class="col-sm-5 control-label" style="text-align: left; margin-top: -3%; font-size: 8pt;">'+pos+'</label>');
    });
</script>
</body>
</html>
