<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>KBA | Sign in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" type="image/png" href="{{asset('images/logo/favicon.png')}}" />
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('')}}dashboard/assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Toster -->
  <link rel="stylesheet" href="{{asset('')}}dashboard/assets/dist/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('')}}dashboard/assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('')}}dashboard/assets/plugins/iCheck/square/blue.css">
  <script src="{{asset('')}}dashboard/assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="{{asset('')}}dashboard/assets/dist/js/validation/jquery.validate.min.js"></script>
  <script src="{{asset('')}}dashboard/assets/dist/js/validation/additional-methods.min.js"></script>
  <!-- Toster -->
  <script src="{{asset('')}}dashboard/assets/dist/toastr/toastr.min.js"></script>
  <style>
    .error {
      color: #FF5722 !important;
    }

    .login-box,
    .register-box {
      width: 360px;
      margin: 0;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }
  </style>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    @if(Session::has('error'))
    <div class="alert alert-danger" role="alert">
      <strong>{{Session::get('error')}}</strong>
    </div>
    @endif
    @if(Session::has('message'))
    <div class="alert alert-success" role="alert">
      <strong>{{Session::get('message')}}</strong>
    </div>
    @endif
    <div class="login-logo">
      <a href="#"><img width="50%" src="{{asset('images/logo/coconut.png')}}" alt=""></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <form id="loginForm" action="{{URL::to('check')}}" method="post">
        {{ csrf_field() }}
        <div class="form-group has-feedback">
          <input type="text" name="username" value="{{old('email')}}" class="form-control" placeholder="Username"
            required>
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          @if ($errors->has('username'))
          <div class="text-danger">{{ $errors->first('username') }}</div>
          @endif
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="userPassword" class="form-control" placeholder="Password" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          @if ($errors->has('userPassword'))
          <div class="text-danger">{{ $errors->first('userPassword') }}</div>
          @endif
        </div>
        <div class="row">
          <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
  </div>

  <!-- jQuery 2.2.3 -->
  <!-- Bootstrap 3.3.6 -->
  <script src="{{asset('')}}dashboard/assets/bootstrap/js/bootstrap.min.js"></script>
  <!-- iCheck -->
  <script src="{{asset('')}}dashboard/assets/plugins/iCheck/icheck.min.js"></script>
  <script>
    $(document).ready(function(){
      $("form#loginForm").validate();
      setTimeout(function(){
        $('.alert').css({'display':'none'})
      }, 1000);
    });

    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
    });
  </script>
</body>

</html>