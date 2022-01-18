@extends('backend.master')
@section("title", "Users")
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
    <section class="col-lg-9 connectedSortable">
     <div class="row">
      <div class="col-lg-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title text-uppercase">User List</h3>
          </div>
        </div>
      </div>
    </div>
    <div class="box">
      <div class="box-body">
        <table class="display table table-bordered table-striped portfolioListTbl">
          <thead>
            <tr>
              <th>#</th>
              <th width="10%">Image</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Username</th>
              <th>Contact</th>
              <th>Email</th>
              <th>Status</th>
              <th>Created Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if($users)
            @foreach($users as $index=>$user)
            <tr>
              <td>{{$index + 1}} </td>
              @if ($user->image)
              <td><img width="30%" src="{{asset('storage/images/users/user_'.$user->id.'.'.$user->image)}}" /></td>
              @else
              <td></td>
              @endif
              <td>{{$user->first_name}}</td>
              <td>{{$user->last_name}}</td>
              <td>{{$user->username}}</td>
              <td>{{$user->contact}}</td>
              <td>{{$user->email}}</td>
              @if($user->status == 0)
              <td><small class="label bg-danger">Inactive</small></td>
              @elseif($user->status == 1)
              <td><small class="label bg-green">Active</small></td>
              @endif
              <td>{{date('Y-m-d', strtotime($user->created_at))}}</td>
              <td>
                <a href="#" class="btn btn-warning edit" data-userId="{{$user->id}}">Edit</a>
                <a href="#" class="btn btn-danger delete" data-userId="{{$user->id}}">Delete</a>
              </td>
            </tr>
            @endforeach
            @endif
          </tbody>
          <tfoot>
            <tr>
              <th>#</th>
              <th width="10%">Image</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Username</th>
              <th>Contact</th>
              <th>Email</th>
              <th>Status</th>
              <th>Created Date</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </section>
  
  <section class="col-lg-3 connectedSortable">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title"><span class="dynamic">Add new</span> User</h3>
      </div>
      <form role="form" id="userForm" action="{{URL::to('users/add')}}">
        <div class="box-body">
          <input type="hidden" name="userId">

          <div class="form-group">
            <label for="role">User Role <sup class="required">*</sup></label>
            <select name="role" id="role" class="form-control" required>
              <option value="1">Subscriber</option>
              <option value="2">Administrator</option>
              <option value="3">Admin</option>
              <option value="4">Super Admin</option>
            </select>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12 text-center">
                <label for="image" style="display: block; text-align: left">Image</label>
                <div class="file-upload">
                  <label for="image" class="file-upload__label" id="lableImage"><img src="{{asset('storage/images/camera.png')}}" alt=""></label>
                  <input type="file" name="image" accept="image/png, image/jpg, image/jpeg, image/gif" class="form-control file-upload__input" id="image" onChange="showPreviewImage(this);">
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="firstName">First Name <sup class="required">*</sup></label>
            <input type="text" name="firstName" class="form-control" id="firstName" placeholder="First Name" value="{{old('firstName')}}" required>
          </div>

          <div class="form-group">
            <label for="lastName">Last Name <sup class="required">*</sup></label>
            <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Last Name" value="{{old('lastName')}}" required>
          </div>

          <div class="form-group">
            <label for="username">Username <sup class="required">*</sup></label>
            <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="{{old('username')}}" required>
          </div>

          <div class="form-group">
            <label for="contact">Contact <sup class="required">*</sup></label>
            <input type="number" name="contact" class="form-control" id="contact" placeholder="Contact" value="{{old('contact')}}" required>
          </div>

          <div class="form-group">
            <label for="email">Email <sup class="required">*</sup></label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{old('email')}}" required>
          </div>

          <div class="form-group passField">
            <label for="password">Password <sup class="required">*</sup></label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password" value="{{old('password')}}" required>
          </div>

          <div class="form-group">
            <label for="status">Status <sup class="required">*</sup></label>
            <select name="status" id="status" class="form-control" required>
              <option value="1">Active</option>
              <option value="0" selected>Inactive</option>
            </select>
          </div>

          <div class="form-group">
            <div class="box-footer add">
              <button class="btn btn-primary cancel" style="float: left;" onclick="cancelForm()">Cancel</button>
              <button type="submit" class="btn btn-primary add" style="float: right;">Add</button>
            </div>
          </div>

          <div class="form-group">
            <div class="box-footer update" style="display: none">
              <button class="btn btn-primary cancel" style="float: left;" onclick="location.reload()">Cancel</button>
              <button type="submit" class="btn btn-primary update" style="float: right;">Update</button>
            </div>
          </div>

        </div>
      </form>
    </div>
  </section>
  <script>
    $(document).ready(function(){
      $("form#userForm").validate();
      $('form#userForm').on('submit', function(e){
        e.preventDefault();
        $.ajax({
          url: $(this).attr('action'),
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          method:"POST",
          crossDomain: true,
          data:new FormData(this),
          contentType: false,
          cache: false,
          processData:false,
          dataType:'json',
          beforeSend : function (){
            $("form#userForm").addClass('isProcess');
          },
          success: function(data){
            $("form#userForm").removeClass('isProcess');
            toastr.success(data.message);
            reloadPage(1000);
          },
          error: function(error) {
            $("form#userForm").removeClass('isProcess');
            console.log(error.responseJSON.errors);
          }
        });
      });
      $(document).on('click','a.edit', function(e){
        e.preventDefault();
        $('form#userForm').attr('id', 'userEditForm');
        $('input[name="image"]').prop('required', false);
        $('span.dynamic').text('Edit');
        $('div.add').css({'display':'none'});
        $('.box.box-primary').css({'border-top-color': '#ffc107'});
        $('button.update').css({'background-color': '#ffc107'});
        $('button.update').css({'border-color': '#ffc107'});
        $('div.update').css({'display':'block'});
        $('div.passField').remove();
        $('form#userEditForm').attr('action', '{{URL::to('users/update')}}');
        edit($(this).attr('data-userId'));
      });

      $(document).on('click','a.delete', function(e){
        e.preventDefault();
        if (confirm("Are you sure?")) {
          $(this).parent().parent().hide('slow');
          deleteItem($(this).attr('data-userId'));
        }
        return false;
      });

      $('form#userEditForm').on('submit', function(e){
        e.preventDefault();
        $.ajax({
          url: $(this).attr('action'),
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          method:"POST",
          crossDomain: true,
          data:new FormData(this),
          contentType: false,
          cache: false,
          processData:false,
          dataType:'json',
          beforeSend : function (){
            $(this).addClass('isProcess');
          },
          success: function(data){
            $(this).removeClass('isProcess');
            toastr.success(data.message);
            reloadPage(1000);
          },
          error: function(error) {
            $("form#userEditForm").removeClass('isProcess');
            console.log(error);
          }
        });
      });
      $('.portfolioListTbl').DataTable({
        searching: true,
        "lengthMenu": [[6, 25, 50, -1], [10, 25, 50, "All"]]
      });
    });
    function edit(id){
      $.ajax({
        url: "{{URL::to('users/edit')}}/"+id,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method:"GET",
        dataType:'json',
        beforeSend : function (){
          $("form#userForm").addClass('isProcess');
        },
        success: function(data){
          console.log(data);
          $("form#userForm").removeClass('isProcess');
          let statusHTML = '';
          if(data.singleUser[0].status == 1){
            statusHTML += `
            <option value="${data.singleUser[0].status}" selected>Active</option>
            <option value="0">Inactive</option>
            `;
          }else if(data.singleUser[0].status == 0){
            statusHTML += `
            <option value="${data.singleUser[0].status}" selected>Inactive</option>
            <option value="1">Active</option>
            `;
          }
          $('#status').html(statusHTML);

          let rollHTML = '';
          if(data.singleUser[0].role == 1){
            rollHTML += `
            <option value="${data.singleUser[0].role}" selected>Subscriber</option>
            <option value="${data.singleUser[0].role}">Administrator</option>
            <option value="${data.singleUser[0].role}">Admin</option>
            <option value="${data.singleUser[0].role}">Super Admin</option>
            `;
          }else if(data.singleUser[0].role == 2){
            rollHTML += `
            <option value="${data.singleUser[0].role}">Subscriber</option>
            <option value="${data.singleUser[0].role}" selected>Administrator</option>
            <option value="${data.singleUser[0].role}">Admin</option>
            <option value="${data.singleUser[0].role}">Super Admin</option>
            `;
          }else if(data.singleUser[0].role == 3){
            rollHTML += `
            <option value="${data.singleUser[0].role}">Subscriber</option>
            <option value="${data.singleUser[0].role}">Administrator</option>
            <option value="${data.singleUser[0].role}" selected>Admin</option>
            <option value="${data.singleUser[0].role}">Super Admin</option>
            `;
          }else if(data.singleUser[0].role == 4){
            rollHTML += `
            <option value="${data.singleUser[0].role}">Subscriber</option>
            <option value="${data.singleUser[0].role}">Administrator</option>
            <option value="${data.singleUser[0].role}">Admin</option>
            <option value="${data.singleUser[0].role}" selected>Super Admin</option>
            `;
          }

          $('#role').html(rollHTML);

          if(data.singleUser[0].image){
            $("#lableImage").html(`<img width="30%" class="upload-preview" src="{{asset('storage/images/users/user_')}}${data.singleUser[0].id}.${data.singleUser[0].image}" />`);
          }else{
            $("#lableImage").html(`<img width="30%" class="upload-preview" src="{{asset('storage/images/camera.png')}}" />`);
          }

          $('input[name="userId"]').val(data.singleUser[0].id);
          $('input[name="firstName"]').val(data.singleUser[0].first_name);
          $('input[name="lastName"]').val(data.singleUser[0].last_name);
          $('input[name="username"]').val(data.singleUser[0].username);
          $('input[name="contact"]').val(data.singleUser[0].contact);
          $('input[name="email"]').val(data.singleUser[0].email);

        },
        error: function(error) {
          $("form#userForm").removeClass('isProcess');
          console.log(error.responseJSON.errors);
        }
      });
    }

    function deleteItem(id){
      $.ajax({
        url: "{{URL::to('users/delete')}}/"+id,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method:"GET",
        dataType:'json',
        success: function(data){
            toastr.success(data.message);
            reloadPage(1000);
          },
          error: function(error) {
            console.log(error.status);
            if(error.status == 500){
              toastr.error('Something went wrong!');
              // reloadPage(1000);
            }else{
              toastr.error('Something went wrong!');
              // reloadPage(1000);
            }
          }
        });
    }

    function cancelForm(){
      $("form#userForm").addClass('isProcess');
      reloadPage(100)
    }
  </script>
  @endsection