@extends('backend.master')
@section("title", "Client edit")
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
</section>

<section class="content">
  <div class="row">
   <section class="col-lg-6 col-sm-offset-3 connectedSortable">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title"><span class="dynamic">Edit</span> Client</h3>
      </div>
      <form role="form" id="portfolioCategoryForm" method="post" enctype="multipart/form-data" action="{{URL::to('career/update')}}">
        @csrf
        <div class="box-body">
        <input type="hidden" name="careerId" value="{{ encryptor('encrypt', $career->id) }}">

          <div class="form-group">
           <label for="designation">Designation <sup class="required">*</sup></label>
           <input type="text" name="designation" class="form-control" id="designation" placeholder="Designation" value="{{$career->designation}}" required>
         </div>

          <div class="form-group">
           <label for="body">Body</label>
           <textarea type="text" name="body" class="form-control" id="body" placeholder="Body">{{$career->body}}</textarea>
         </div>

         <div class="form-group">
          <label for="datepicker">Expire Date:</label>

          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" value="{{$career->expire_date}}" name="expireDate" class="form-control pull-right" id="datepicker">
          </div>
        </div>      

          <div class="form-group">
            <label for="status">Status <sup class="required">*</sup></label>
            <select name="status" id="status" class="form-control" required>
              @if ($career->status == 1)
                <option value="1" selected>Active</option>
                <option value="0">Inactive</option>
              @elseif($career->status == 0)
                <option value="1">Active</option>
                <option value="0" selected>Inactive</option>
              @endif
            </select>
          </div>

        </div>
        <div class="box-footer add">
          <button type="submit" class="btn btn-primary add" style="float: right;">Update</button>
        </div>
      </form>
    </div>
  </section>
  <script>
  $(document).ready(function(){
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true,
      format:"yyyy-mm-dd"
    });

     $('#body').summernote({
        placeholder: 'Description',
        tabsize: 2,
        height: 200
      });
  })
</script>
  @endsection