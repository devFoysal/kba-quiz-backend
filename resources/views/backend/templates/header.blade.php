<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{csrf_token()}}">
  <link rel="shortcut icon" href="{{ asset('storage/images/logo/favicon.png') }}" type="image/png" />
  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" type="image/png" href="{{asset('images/logo/favicon.png')}}" />
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('')}}dashboard/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('')}}dashboard/assets/plugins/datatables/dataTables.bootstrap.css">
  <!--<link rel="stylesheet" href="{{asset('')}}dashboard/assets/plugins/datatables/buttons.dataTables.min.css">-->
  <!--<link rel="stylesheet" href="{{asset('')}}dashboard/assets/plugins/datatables/select.dataTables.min.css">-->
  <!--{{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css"> --}}-->
  <!--{{-- <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css"> --}}-->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('')}}dashboard/assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('')}}dashboard/assets/dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('')}}dashboard/assets/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{asset('')}}dashboard/assets/plugins/morris/morris.css">
  <!-- jvectormap -->
  <!--<link rel="stylesheet" href="{{asset('')}}dashboard/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">-->
  <!-- Date Picker -->
  {{-- <link rel="stylesheet" href="{{asset('')}}dashboard/assets/plugins/datepicker/datepicker3.css"> --}}
  <!-- Daterange picker -->
  {{-- <link rel="stylesheet" href="{{asset('')}}dashboard/assets/plugins/daterangepicker/daterangepicker.css"> --}}
  <!-- bootstrap wysihtml5 - text editor -->
  <!--<link rel="stylesheet" href="{{asset('')}}dashboard/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">-->
  <!-- Toster -->
  <link rel="stylesheet" href="{{asset('')}}dashboard/assets/dist/summernote/summernote.css">
  {{-- <link rel="stylesheet" href="{{asset('')}}dashboard/assets/dist/toastr/toastr.min.css"> --}}

  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('')}}dashboard/assets/plugins/select2/select2.min.css">

  <link rel="stylesheet" href="{{asset('')}}dashboard/assets/dist/css/custom_style.css">
  <!-- jQuery 2.2.3 -->
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  {{-- <script src="{{asset('')}}dashboard/assets/dist/js/validation/jquery.validate.min.js"></script> --}}

  {{-- <script src="{{asset('')}}dashboard/assets/dist/js/validation/additional-methods.min.js"></script> --}}
  <!-- Toster -->
  <script src="{{asset('')}}dashboard/assets/dist/summernote/summernote.min.js"></script>
  {{-- <script src="{{asset('')}}dashboard/assets/dist/toastr/toastr.min.js"></script> --}}
  {{-- <script src="//cdn.tinymce.com/4/tinymce.min.js" referrerpolicy="origin"></script> --}}
  {{-- <script src="{{asset('')}}dashboard/assets/plugins/tinymce/tinymce.min.js" referrerpolicy="origin"></script> --}}
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <!-- Logo -->
      <a href="{{URL::to('management/dashboard')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
          KBA
          {{-- <img style="width: 38%" class="img-fluid" src="{{asset('storage/images/logo/favicon.png') }}" alt="">
          --}}
        </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
          KBA
          {{-- <img style="width: 38%" class="img-fluid" src="{{asset('storage/images/logo/coconut.png') }}" alt="">
          --}}
        </span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="bg-danger"><a href="{{URL::to('management/logout')}}" class="text-white">Logout</a></li>
            {{-- <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{asset('')}}dashboard/assets/dist/img/user2-160x160.jpg" class="user-image" alt="User
            Image">
            <span class="hidden-xs">{{Session::get('username')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="{{asset('')}}dashboard/assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{URL::to('logout')}}" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
            </li> --}}
          </ul>
        </div>
      </nav>
    </header>