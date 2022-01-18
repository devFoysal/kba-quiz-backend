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

    <div class="col-md-3 col-sm-12 col-xs-12">

      <div class="box-header" style="flex-direction: column">
        <h3 class="">
          Total Participants
        </h3>
        <h1 style="    font-size: 50px;
        margin: 0;
        font-weight: 700;">{{count($participants)}}</h1>
      </div>
    </div>
  </div>
</section>
@endsection