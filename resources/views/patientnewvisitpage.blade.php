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
                <li class="active"><a href="/newvisit"><i class="fa fa-circle-o"></i> New Visit</a></li>
                <li><a href="/NFHSI"><i class="fa fa-circle-o"></i> Patient List</a></li>
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

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Patient Visit 
                    <!-- <a href="#" class="btn btn-warning btn-sm" target="_blank"> Generate Medical Certificate</a>
                    <a href="#" class="btn btn-info btn-sm" target="_blank"> Preview</a> -->
                </h3>
            </div>
            <div class="box-body">
                <div class="nav-tabs-custom">
        
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#personal_info" aria-controls="personal_info" role="tab" data-toggle="tab">Personal Info</a>
                    </li>
                </ul>
    
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="personal_info">
                        <div class="col-md-12">
                            <h3>Personal Info</h3>
                            <form id="frm_personal_info" class="form-horizontal" method="post" action="/newvisit">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label class="col-sm-1 control-label">Name</label>
                                    <div class="col-sm-2">
                                        <input class="form-control" id="fname" name="fname" placeholder="First Name" required="" type="text" autocomplete="off">
                                    </div>
                                    <div class="col-sm-1">
                                        <input class="form-control" id="mname" name="mname" placeholder="M" type="text" autocomplete="off">
                                    </div>
                                    <div class="col-sm-2">
                                        <input class="form-control" id="lname" name="lname" placeholder="Last Name" required="" type="text" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-sm-1 control-label">Address</label>
                                    <div class="col-sm-5">
                                        <input class="form-control" id="address" name="address" placeholder="Address" required="" type="text" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-sm-1 control-label">Gender</label>
                                    <div class="col-sm-3">
                                        <select id="gender" name="gender" class="form-control" required=""> 
                                            <option value="">- Select -</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-sm-1 control-label">Birthdate</label>
                                    <div class="col-sm-3">
                                        <input type="text" id="datepicker" name="dob" class="form-control dob" required="" placeholder="YYYY-MM-DD">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-sm-1 control-label">Age</label>
                                    <div class="col-sm-1">
                                        <input class="form-control age" id="age" name="age" placeholder="" readonly="" required="" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1 control-label">Purpose of Visit</label>
                                    <div class="col-sm-5">
                                        <textarea class="form-control purpose_visit" name="purpose_visit" rows="2" id="purpose_visit" required=""></textarea>
                                    </div>
                                </div><br>

                                <h3>Services</h3>
                                @foreach($adminpanelcat as $cat)
                                <h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><i>{{$cat->cat_name}}</i></b></h5><br>
                                    @foreach($adminpanel as $panel)
                                        @if($cat->id == $panel->admin_panel_cat_id)
                                            <div class="form-group ">
                                                <label class="col-sm-1 control-label"></label>
                                                <div class="col-sm-6">
                                                    <label><input type="checkbox" class="{{$panel->id}} cate" name="services[]" value="{{$panel->id}}-0"><b> {{$panel->name}}</b></label>
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
                                                    <div class="form-group ">
                                                        <label class="col-sm-1 control-label"></label>
                                                        <div class="col-sm-6">
                                                            <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="sub{{$panelsub->admin_panel_id}} subsub{{$panelsub->admin_panel_id}}{{$panelsub->id}}" name="services[]" value="{{$panel->id}}-{{$panelsub->id}}" disabled=""><b> {{$panelsub->name}}</b></label>
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

                                <div class="form-group">
                                    <label class="col-sm-1 control-label"></label>
                                    <div class="col-sm-1">
                                        <button class="btn btn-primary" id="btn-submit-personal_info" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
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
