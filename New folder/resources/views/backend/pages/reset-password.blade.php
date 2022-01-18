@extends('backend.master')
@section("title", "Reset Password")
@section('content')
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
	    Dashboard
	    <small>Control panel</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li class="active">Dashboard</li>
	  </ol>

	  @if(Session::has('message'))
	    <div class="alert alert-success" role="alert">
	      <strong>{{Session::get('message')}}</strong>
	    </div>
	  @endif

	      @if(Session::has('error'))
      <div class="alert alert-danger" role="alert">
        <strong>{{Session::get('error')}}</strong>
      </div>
    @endif
	</section>
	<section class="content">
	  <div class="row">
	    <section class="col-lg-4 connectedSortable col-lg-offset-3">
	        <div class="box box-primary">
	          <div class="box-header with-border">
	            <h3 class="box-title"><span class="dynamic">Reset</span> Password</h3>
	          </div>
	          <form role="form" id="careerForm" action="{{URL::to('reset-password')}}" method="post">
	          	{{csrf_field()}}
	            <div class="box-body">
	             
	              <div class="form-group">
	                <label for="oldPass">Old password <sup class="required">*</sup></label>
	                <input type="password" name="oldPass" class="form-control" id="oldPass" placeholder="Old password" value="{{old('oldPass')}}" required>
	              </div>

	                <div class="form-group">
	                <label for="newPassword">New passwrod <sup class="required">*</sup></label>
	                <input type="password" name="newPassword" class="form-control" id="newPassword" placeholder="New password" value="{{old('newPassword')}}" required>
	              </div>
	          
	            <div class="box-footer">
	              <button class="btn btn-primary cancel" style="float: left;" onclick="location.reload()">Cancel</button>
	              <button type="submit" class="btn btn-primary" style="float: right;">Password Reset</button>
	            </div>
	        </div>
	          </form>
	        </div>
	      </section>
	    <script>
	      $(document).ready(function(){
	        $("form#careerForm").validate();
	      });
	     
	      function cancelForm(){
	        $("form#careerForm").addClass('isProcess');
	        reloadPage(100)
	      }
	    </script>
@endsection