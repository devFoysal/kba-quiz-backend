@extends('backend.master')
@section("title", "Dashboard")
@section('content')
<section class="content-header">
  @if(Session::has('message'))
  <div class="alert alert-success" role="alert">
    <strong>{{Session::get('message')}}</strong>
  </div>
  @endif
</section>

<section class="content">
  <div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="box-header">
        <h3 class="box-title">
          Color Palette
        </h3>
        <a href="#" class="btn btn-primary push-right"><i class="fa fa-plus"></i></a>
      </div>
    </div>
  </div>
</section>
@endsection