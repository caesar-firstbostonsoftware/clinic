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
                <li class="active"><a href="/newvisit"><i class="fa fa-circle-o"></i> New Visit</a></li>
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
                                    @if(!$patient)
                                    <div class="col-sm-4">
                                        <label class="radio-inline">
                                            <input type="radio" name="type" class="type" value="Walk-in" checked="">Walk-in
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="type" class="type" value="Company">Company
                                        </label>
                                    </div>
                                    @else
                                    <div class="col-sm-4">
                                        @if($patient->type == 'Walk-in')
                                        <label class="radio-inline">
                                            <input type="radio" name="type" class="type" value="Walk-in" checked="">Walk-in
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="type" class="type" value="Company">Company
                                        </label>
                                        @else
                                        <label class="radio-inline">
                                            <input type="radio" name="type" class="type" value="Walk-in">Walk-in
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="type" class="type" value="Company" checked="">Company
                                        </label>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1 control-label">Name</label>
                                    <div class="col-sm-2">
                                        @if(!$patient)
                                            <input class="form-control" id="fname" name="fname" placeholder="First / Company" required="" type="text" autocomplete="off" autofocus="" tabindex="1">
                                            <input type="text" name="patient_id" value="0" style="display: none;">
                                        @else
                                            <input class="form-control" id="fname" name="fname" placeholder="First / Company" type="text" readonly="" value="{{$patient->f_name}}">
                                            <input type="text" name="patient_id" value="{{$patient->id}}" style="display: none;">
                                        @endif
                                    </div>
                                    @if(!$patient)
                                    <div class="col-sm-1 discount12345">
                                    @else
                                    @if($patient->type == 'Walk-in')
                                    <div class="col-sm-1 discount12345">
                                    @else
                                    <div class="col-sm-1 discount12345" style="display: none;">
                                    @endif
                                    @endif
                                        @if(!$patient)
                                            <input class="form-control" id="mname" name="mname" placeholder="M" type="text" autocomplete="off" tabindex="2">
                                        @else
                                            <input class="form-control" id="mname" name="mname" placeholder="M" type="text" readonly="" value="{{$patient->m_name}}">
                                        @endif
                                    </div>
                                    @if(!$patient)
                                    <div class="col-sm-2 discount12345">
                                    @else
                                    @if($patient->type == 'Walk-in')
                                    <div class="col-sm-2 discount12345">
                                    @else
                                    <div class="col-sm-2 discount12345" style="display: none;">
                                    @endif
                                    @endif
                                        @if(!$patient)
                                            <input class="form-control" id="lname" name="lname" placeholder="Last Name" type="text" autocomplete="off" tabindex="3">
                                        @else
                                            <input class="form-control" id="lname" name="lname" placeholder="Last Name" type="text" readonly="" value="{{$patient->l_name}}">
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-sm-1 control-label">Address</label>
                                    <div class="col-sm-5">
                                        @if(!$patient)
                                            <input class="form-control" id="address" name="address" placeholder="Address" type="text" autocomplete="off" tabindex="4">
                                        @else
                                            <input class="form-control" id="address" name="address" placeholder="Address" type="text" readonly="" value="{{$patient->address}}" tabindex="4">
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
                                            <select id="gender" name="gender" class="form-control" disabled="" tabindex="5"> 
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
                                            <input type="text" id="datepicker" name="dob" class="form-control dob" placeholder="YYYY-MM-DD" disabled="" value="{{$patient->dob}}" readonly="" tabindex="6">
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="col-sm-1 control-label">Age</label>
                                    <div class="col-sm-2">
                                        @if(!$patient)
                                            <input class="form-control age" id="age" name="age" placeholder="" type="number" min="0" tabindex="7" autocomplete="off">
                                        @else
                                            <input class="form-control age" id="age" name="age" placeholder="" readonly="" type="number" min="0" value="{{$patient->age}}" tabindex="7" autocomplete="off">
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-1 control-label">Purpose of Visit</label>
                                    <div class="col-sm-5">
                                        <textarea class="form-control purpose_visit" name="purpose_visit" rows="2" id="purpose_visit" tabindex="8"></textarea>
                                    </div>
                                </div>
                                @if(!$patient)
                                <div class="form-group discount12345">
                                    <div class="checkbox col-sm-2">
                                        <label><input type="checkbox" class="check_senciz_id" value="Yes">Senior Citizen ID #</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <input class="form-control senciz_id" id="senciz_id" name="senciz_id" placeholder="Senior Citizen ID #" type="type" autocomplete="off" readonly="">
                                    </div>
                                </div>
                                <div class="form-group discount12345">
                                    <div class="checkbox col-sm-2">
                                        <label><input type="checkbox" class="check_pwd_id" value="Yes">PWD ID #</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <input class="form-control pwd_id" id="pwd_id" name="pwd_id" placeholder="PWD ID #" type="type" autocomplete="off" readonly="">
                                    </div>
                                </div>
                                @else
                                @if($patient->type == 'Walk-in')
                                <div class="form-group discount12345">
                                @else
                                <div class="form-group discount12345" style="display: none;">
                                @endif
                                    <div class="checkbox col-sm-2">
                                        <label><input type="checkbox" class="check_senciz_id" value="Yes">Senior Citizen ID #</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <input class="form-control senciz_id" id="senciz_id" name="senciz_id" placeholder="Senior Citizen ID #" type="type" autocomplete="off" readonly="" value="{{$patient->senior_id_no}}">
                                    </div>
                                </div>
                                @if($patient->type == 'Walk-in')
                                <div class="form-group discount12345">
                                @else
                                <div class="form-group discount12345" style="display: none;">
                                @endif
                                    <div class="checkbox col-sm-2">
                                        <label><input type="checkbox" class="check_pwd_id" value="Yes">PWD ID #</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <input class="form-control pwd_id" id="pwd_id" name="pwd_id" placeholder="PWD ID #" type="type" autocomplete="off" readonly="" value="{{$patient->pwd_id_no}}">
                                    </div>
                                </div>
                                @endif
                                @if(!$patient)
                                <div class="form-group discount12345">
                                    <label class="col-sm-2 control-label" style="text-align: left;">Discount %</label>
                                    <div class="col-sm-3">
                                        <input class="form-control discount" id="discount" name="discount" type="number" min="0" autocomplete="off" tabindex="9">
                                    </div>
                                </div>
                                <div class="form-group discount67890" style="display: none;">
                                    <label class="col-sm-2 control-label" style="text-align: left;">WH Tax Discount</label>
                                    <div class="col-sm-3">
                                        <input class="form-control discount" id="discount" name="wh_discount" type="number" min="0" autocomplete="off" tabindex="9">
                                    </div>
                                </div>
                                @else
                                @if($patient->type == 'Walk-in')
                                <div class="form-group discount12345">
                                @else
                                <div class="form-group discount12345" style="display: none;">
                                @endif
                                    <label class="col-sm-2 control-label" style="text-align: left;">Discount %</label>
                                    <div class="col-sm-3">
                                        <input class="form-control discount" id="discount" name="discount" type="number" min="0" autocomplete="off" tabindex="9" value="{{$patient->discount}}">
                                    </div>
                                </div>
                                @if($patient->type == 'Walk-in')
                                <div class="form-group discount67890" style="display: none;">
                                @else
                                <div class="form-group discount67890">
                                @endif
                                    <label class="col-sm-2 control-label" style="text-align: left;">WH Tax Discount</label>
                                    <div class="col-sm-3">
                                        <input class="form-control discount" id="discount" name="wh_discount" type="number" min="0" autocomplete="off" tabindex="9" value="{{$patient->wh_discount}}">
                                    </div>
                                </div>
                                @endif
                                <br>

                                <h3>Services</h3>
                                @foreach($adminpanelcat as $cat)
                                <div class="col-sm-12 {{$cat->id}}" style="border:3px solid black;">
                                    <div class="row">
                                        <div class="col-sm-2" style="margin-left: 3%;">
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
                                <div class="form-group ">
                                    <label class="col-sm-5 control-label total" style="text-align: left;">
                                        <b>Total : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>Php. <i class="totaltotal">0.00</i>
                                        <input type="text" name="totalprice" class="totalprice" style="display: none;">
                                    </label>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-1">
                                        <button class="btn btn-primary btn-xs submitsubmit" id="btn-submit-personal_info" type="submit">Submit</button>
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
           <b>Powered by</b> <a href="www.inovenzo.com" target="_blank">Inovenzo</a> <img src="{{ asset('/img/LOGO.png') }}" height="30" width="30">
        </div> 
    </footer>

</div><!-- ./wrapper -->
</div>
@section('scripts')
    @include('adminlte::layouts.partials.scripts')
    <script type="text/javascript">
    $(".dob").datepicker({
        dateFormat: "yy-mm-dd",
        yearRange: "1900:2050",
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

    $('.type').on('click',function() {
        var type = $(this).val();
        if (type == 'Walk-in') {
            $('.discount67890').hide();
            $('.discount12345').show();
        }
        else {
            $('.discount12345').hide();
            $('.discount67890').show();
        }
    })

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
                //$(this).next('input').val(serserval);

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

    // $('.submitsubmit').on('click',function() {
    //     var datedate = $('.dob').val();
    //     if (!datedate) {
    //         alert('Please Fill Up Birth Date.');
    //         return false;
    //     }
    //     else {
    //         return true;
    //     }
    // })
    

</script>
@show



</body>
</html>
