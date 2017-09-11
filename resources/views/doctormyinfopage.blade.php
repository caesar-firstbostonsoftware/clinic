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
        @if(Session::get('position') == "Doctor" || Session::get('position') == "Xray" || Session::get('position') == "Labtest")
        <li><a href="/dashboard"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>
        <li class="active"><a href="/myinfo"><i class="fa fa-info-circle"></i> <span>My Info</span></a></li>
        @endif
        <li class="treeview"><a href="/NFHSI"><i class="fa fa-users"></i> <span>Patients</span><span class="pull-right-container"></span></a>
            <ul style="display: block;" class="treeview-menu menu-open">
                <li><a href="/newvisit"><i class="fa fa-circle-o"></i> New Visit</a></li>
                <li><a href="/NFHSI"><i class="fa fa-circle-o"></i> Patient List</a></li>
            @if(Session::get('position') == "Doctor" || Session::get('position') == "Xray" || Session::get('position') == "Labtest")
                <li><a href="/generate/medcert"><i class="fa fa-circle-o"></i> Create Medical Certificate</a></li>
            @endif
            </ul>
        </li>
        @if(Session::get('user') == 1)
        <li><a href="/NFHSI/users"><i class="fa fa-user-circle-o"></i> <span>Users</span></a></li>
        <li><a href="/NFHSI/doctors"><i class="fa fa-user-md"></i> <span>Doctors</span></a></li>
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
        <h1><i class="fa fa-stethoscope"></i> My Info</h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard">Dashboard</a></li>
            <li class="active"><a href="/myinfo"><b>My Info</b></a></li>
        </ol>
    </section>
    
    <section class="content">
        <div class="box">
            <div class="box-body">
                <div class="nav-tabs-custom">
                        <div role="tabpanel" class="tab-pane active" id="personal_info">
                            <div class="col-md-7">
                                    <div class="flash-message top-message topmessage">
                                        @foreach (['danger', 'warning', 'success', 'info'] as $message)
                                            @if(Session::has('alert-' . $message))
                                                <p class="alert alert-{{ $message }}" style="padding:.5px;height:22px; width:73%;">{{ Session::get('alert-' . $message) }}</p>
                                            @endif
                                        @endforeach
                                    </div><br>
                                <form id="frm_personal_info" class="form-horizontal" method="post" action="/myinfo">
                                <input class="edit_doc_id" name="doc_id" type="text" style="display: none;" value="{{$info->id}}">
                                    {!! csrf_field() !!}
                                    <div class="form-group ">
                                        <label class="col-sm-2 control-label">Name</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" id="fname" name="fname" placeholder="First Name" required="" type="text" value="{{$info->f_name}}" autocomplete="off">
                                        </div>
                                        <div class="col-sm-2 nameleft">
                                            <input class="form-control" id="mname" name="mname" placeholder="M" type="text" value="{{$info->m_name}}" autocomplete="off">
                                        </div>
                                        <div class="col-sm-4 nameleft">
                                            <input class="form-control" id="lname" name="lname" placeholder="Last Name" required="" type="text" value="{{$info->l_name}}" autocomplete="off">
                                        </div>
                                    </div>
                                    @if(Session::get('position') == "Doctor")
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Credential</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" id="credential" name="credential" placeholder="Credential" required="" type="text" value="{{$info->credential}}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Specialization</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="specialization" name="specialization" placeholder="Specialization" required="" type="text" value="{{$info->specialization}}" autocomplete="off">
                                        </div>
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Address</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="address" name="address" placeholder="Address" type="text" required="" value="{{$info->address}}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="email" name="email" placeholder="Email" type="email" required="" value="{{$info->email}}" autocomplete="off">
                                        </div>
                                    </div><br>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Username</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="username" name="username" placeholder="Username" type="text" required="" value="{{$user->username}}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Password</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="password" name="password" placeholder="Password" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"></label>
                                        <div class="col-sm-4">
                                            <button class="btn btn-primary" id="btn-submit-personal_info" type="submit">Save Changes</button>
                                        </div>
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
        $(document).ready(function() {
        setTimeout(function(){ 
            $('.topmessage').hide();
        }, 2000);
    })
    </script>
@show

</body>
</html>
