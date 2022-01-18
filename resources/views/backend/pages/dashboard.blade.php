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

  @php
  $month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',
  'November', 'December']
  @endphp
  <div class="row" style="margin-top:15px">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <h3 class="">
        <strong>Leaderboard Statistics</strong>
      </h3>
    </div>
    @foreach ($leaderboard as $key => $item)
    <div class="col-md-3 col-sm-12 col-xs-12" style="padding:15px">
      <div style="background-color:#fff; padding:20px">
      <h3 style="margin-top:0; text-align:center;">
        {{$month[$key - 1]}}
      </h3>
      @foreach ($item as $lboard)
      <div class="box-header" style="flex-direction: column">

        <h1 style="    font-size: 50px;
  margin: 0;
  font-weight: 700;">{{$lboard->total}}</h1>
      </div>
      @endforeach

    </div>
  </div>
    @endforeach
  </div>
</section>
@endsection