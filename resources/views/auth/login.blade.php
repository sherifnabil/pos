<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ url('dashboard') }}/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('dashboard') }}/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('dashboard') }}/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('dashboard') }}/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ url('dashboard') }}/plugins/iCheck/square/blue.css">


  @if(app()->getLocale() == 'ar')
  <link rel="stylesheet" href="{{ asset('dashboard') }}/dist/css/rtl/AdminLTE.min.css">
  <link rel="stylesheet" href="{{ asset('dashboard') }}/dist/css/rtl/bootstrap-rtl.min.css">
  <link rel="stylesheet" href="{{ asset('dashboard') }}/dist/css/rtl/rtl.css"/>
  <link href="https://fonts.googleapis.com/css?family=Cairo:400,600&amp;subset=arabic" rel="stylesheet">
    <style>
        html, body, h1, h2, h3{
            font-family: 'Cairo', sans-serif
        }
    </style>
  @else
  <link rel="stylesheet" href="{{ asset('dashboard') }}/dist/css/AdminLTE.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600&amp;" rel="stylesheet">

  @endif


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form method="post" action="{{ route('login') }}" >

            {{ csrf_field() }}
            {{ method_field('post') }}

            @include('partials._errors')

        <div class="form-group has-feedback">
        <input name="email" type="email" class="form-control" value="{{ old('email') }}" placeholder="@lang('site.email')">

        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control"  name="password"  placeholder="@lang('site.password')">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
        <div class="">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"  name="remember"> @lang('site.remember_me')
            </label>
          </div>
        </div>

        <div class="form-group has-feedback">
        <button type="submit" class="btn btn-primary btn-block btn-flat">@lang('site.sign_in')</button>
      </div>
    </div>
    </form>


  </div>•
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{ url('dashboard') }}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ url('dashboard') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="{{ url('dashboard') }}/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
