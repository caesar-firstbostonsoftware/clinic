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
    .login-box{
        width: 100%;
    }
</style>

<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="/">NFHSI</a><br>
        <a href="/NFHSI" class="btn btn-primary btn-sm" style="color:white;font-size:11pt;">Sign In as Nurse</a>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#signindoctor" data-backdrop="static">Sign In as Doctor</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#signinadmin" data-backdrop="static">Sign In as Admin</button>
    </div>
    
  <!--<div class="login-box-body">
    <form role="form" method="POST" action="http://demo_emr.jwits.co/login">
    <input name="_token" value="e3YMNRHplvvKbcJPOZZVLOQzUimFFhltU8eWFX63" type="hidden">
      <div class="form-group has-feedback ">
        <input id="username" class="form-control" name="username" value="" autofocus="" placeholder="Username" type="teext">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
               </div>
      <div class="form-group has-feedback ">
         <input id="password" class="form-control" name="password" placeholder="Password" type="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                 </div>
      <div class="row">
        <div class="col-xs-8"></div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form></div>-->

</div>

<div class="modal fade" id="signindoctor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                        <form role="form" method="POST" action="">
                            <div class="form-group has-feedback ">
                                <input id="username" class="form-control" name="username" value="" autofocus="" placeholder="Username" type="teext">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback ">
                                <input id="password" class="form-control" name="password" placeholder="Password" type="password">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div class="row">
                                <div class="col-xs-8"></div>
                                <div class="col-xs-4">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="signinadmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                        <form role="form" method="POST" action="">
                            <div class="form-group has-feedback ">
                                <input id="username" class="form-control" name="username" value="" autofocus="" placeholder="Username" type="teext">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback ">
                                <input id="password" class="form-control" name="password" placeholder="Password" type="password">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div class="row">
                                <div class="col-xs-8"></div>
                                <div class="col-xs-4">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    @include('adminlte::layouts.partials.scripts')
@show
</body>
</html>
