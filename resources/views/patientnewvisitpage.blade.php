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
        <li><a href="/dashboard"><img src="{{ asset('/img/2001.png') }}" height="20" width="20"> <span>Dashboard</span></a></li>
        @endif
        @if(Session::get('position') == "Doctor" || Session::get('position') == "Xray" || Session::get('position') == "Labtest")
        <li><a href="/myinfo"><img src="{{ asset('/img/2009.png') }}" height="20" width="20"> <span>My Info</span></a></li>
        @endif
        
        <li class="treeview active"><a href="/NFHSI"><img src="{{ asset('/img/2010.png') }}" height="20" width="20"> <span>Patients</span><span class="pull-right-container"></span></a>
            <ul style="display: block;" class="treeview-menu menu-open">
                <li class="active"><a href="/newvisit"><i class="fa fa-circle-o"></i> New Visit</a></li>
                <li><a href="/NFHSI"><i class="fa fa-circle-o"></i> Patient List</a></li>
            @if(Session::get('position') == "Doctor" || Session::get('position') == "Xray" || Session::get('position') == "Labtest")
                <li><a href="/generate/medcert"><i class="fa fa-circle-o"></i> Create Medical Certificate</a></li>
            @endif
            </ul>
        </li>

        @if(Session::get('user') == 1)
        <li><a href="/NFHSI/users"><img src="{{ asset('/img/2012.png') }}" height="20" width="20"> <span>Users</span></a></li>
        <li><a href="/NFHSI/doctors"><img src="{{ asset('/img/2013.png') }}" height="20" width="20"> <span>Doctors</span></a></li>
        <li><a href="/reports/{{Session::get('user')}}"><img src="{{ asset('/img/2014.png') }}" height="20" width="20"> <span>Reports</span></a></li>
        <li><a href="/NFHSI/services"><img src="{{ asset('/img/2015.png') }}" height="20" width="20"> <span>Services</span></a></li>
        @elseif(Session::get('user') > 1 && Session::get('position') == "Doctor")
        <li><a href="/reports/{{Session::get('user')}}"><img src="{{ asset('/img/2014.png') }}" height="20" width="20"> <span>Reports</span></a></li>
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
            
            @if(Session::get('position') == "Doctor")
            <li><a href="/dashboard">Dashboard</a></li>
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
                    <!-- <a href="#" class="btn btn-warning btn-xs" target="_blank"> Generate Medical Certificate</a>
                    <a href="#" class="btn btn-info btn-xs" target="_blank"> Preview</a> -->
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
                                        @if(!$patient)
                                            <input class="form-control" id="fname" name="fname" placeholder="First Name" required="" type="text" autocomplete="off" autofocus="" tabindex="1">
                                            <input type="text" name="patient_id" value="0" style="display: none;">
                                        @else
                                            <input class="form-control" id="fname" name="fname" placeholder="First Name" type="text" readonly="" value="{{$patient->f_name}}">
                                            <input type="text" name="patient_id" value="{{$patient->id}}" style="display: none;">
                                        @endif
                                    </div>
                                    <div class="col-sm-1">
                                        @if(!$patient)
                                            <input class="form-control" id="mname" name="mname" placeholder="M" type="text" autocomplete="off" tabindex="2">
                                        @else
                                            <input class="form-control" id="mname" name="mname" placeholder="M" type="text" readonly="" value="{{$patient->m_name}}">
                                        @endif
                                        
                                    </div>
                                    <div class="col-sm-2">
                                        @if(!$patient)
                                            <input class="form-control" id="lname" name="lname" placeholder="Last Name" required="" type="text" autocomplete="off" tabindex="3">
                                        @else
                                            <input class="form-control" id="lname" name="lname" placeholder="Last Name" type="text" readonly="" value="{{$patient->l_name}}">
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-sm-1 control-label">Address</label>
                                    <div class="col-sm-5">
                                        @if(!$patient)
                                            <input class="form-control" id="address" name="address" placeholder="Address" required="" type="text" autocomplete="off" tabindex="4">
                                        @else
                                            <input class="form-control" id="address" name="address" placeholder="Address" type="text" readonly="" value="{{$patient->address}}">
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-sm-1 control-label">Gender</label>
                                    <div class="col-sm-3">
                                        @if(!$patient)
                                            <select id="gender" name="gender" class="form-control" required="" tabindex="5"> 
                                                <option value="">- Select -</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        @else
                                            <select id="gender" name="gender" class="form-control" disabled=""> 
                                                <option value="{{$patient->gender}}">{{$patient->gender}}</option>
                                            </select>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-sm-1 control-label">Birthdate</label>
                                    <div class="col-sm-3">
                                        @if(!$patient)
                                            <input type="text" id="datepicker" name="dob" class="form-control dob" required="" placeholder="YYYY-MM-DD" readonly="" tabindex="6">
                                        @else
                                            <input type="text" id="datepicker" name="dob" class="form-control dob" placeholder="YYYY-MM-DD" disabled="" value="{{$patient->dob}}" readonly="">
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-sm-1 control-label">Age</label>
                                    <div class="col-sm-1">
                                        @if(!$patient)
                                            <input class="form-control age" id="age" name="age" placeholder="" readonly="" required="" type="text" tabindex="-1">
                                        @else
                                            <input class="form-control age" id="age" name="age" placeholder="" readonly="" type="text" value="{{$patient->age}}">
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1 control-label">Purpose of Visit</label>
                                    <div class="col-sm-5">
                                        <textarea class="form-control purpose_visit" name="purpose_visit" rows="2" id="purpose_visit" required="" tabindex="7"></textarea>
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
                                                    <label><input type="checkbox" class="{{$panel->id}} cate cateservices" name="services[]" value="{{$panel->id}}-0"><b> {{$panel->name}}</b></label>
                                                </div>
                                                <div class="col-sm-2" style="text-align: right;">
                                                    @if($panel->price == 0)
                                                    <label><b></b></label>
                                                    @else
                                                    <?php $price = number_format($panel->price,2); ?>
                                                    <label class="priceprice"><b> {{$price}}</b></label>
                                                    @endif
                                                </div>
                                            </div>
                                            @foreach($sub as $panelsub)
                                                @if($panel->id == $panelsub->admin_panel_id)
                                                    <div class="form-group ">
                                                        <label class="col-sm-1 control-label"></label>
                                                        <div class="col-sm-6">
                                                            <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="sub{{$panelsub->admin_panel_id}} subsub{{$panelsub->admin_panel_id}}{{$panelsub->id}} cateservices" name="services[]" value="{{$panel->id}}-{{$panelsub->id}}" disabled=""><b> {{$panelsub->name}}</b></label>
                                                        </div>
                                                        <div class="col-sm-2" style="text-align: right;">
                                                            <?php $price = number_format($panelsub->price,2); ?>
                                                            <label class="priceprice"><b> {{$price}}</b></label>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endforeach
                                <hr>
                                <div class="form-group ">
                                    <label class="col-sm-5 control-label total" style="text-align: left;">
                                        <b>Total : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>Php. <i class="totaltotal">0.00</i>
                                        <input type="text" name="totalprice" class="totalprice" style="display: none;">
                                    </label>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-1">
                                        <button class="btn btn-primary btn-xs" id="btn-submit-personal_info" type="submit">Submit</button>
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
</script>
@show



</body>
</html>
