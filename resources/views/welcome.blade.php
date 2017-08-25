<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

@section('htmlheader')
    @include('adminlte::layouts.partials.htmlheader')
@show

<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="/">NFHSI</a>
    </div>
    
  <div class="login-box-body">
    <form role="form" method="POST" action="/">
    {!! csrf_field() !!}
      <div class="form-group has-feedback ">
        <input id="username" class="form-control" name="username" value="" autofocus="" placeholder="Username" type="teext">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
               </div>
      <div class="form-group has-feedback ">
         <input id="password" class="form-control" name="password" placeholder="Password" type="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                 </div>
      <div class="row">
        <div class="col-xs-8">
            <a href="/NFHSI">Enter as Receptionist</a>
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form></div>

</div>

@section('scripts')
    @include('adminlte::layouts.partials.scripts')
@show
</body>
</html>
