@extends('backend.master')
@section("title", "Leaderboard")
@section('content')


<section class="content-header">
  @if( Session::has('message'))
  <div class="callout {{Session::get('class')}}">
    <h4>{{Session::get('message')}}</h4>
  </div>
  @endif

  @if( $errors->has('thumbnail'))
  <div class="callout callout-danger">
    <h4>{{$errors->first('thumbnail')}}</h4>
  </div>
  @endif

  <section class="content">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Leaderboard</h3>
          </div>
          <!-- /.box-header -->
          @php
          $monthName = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
          @endphp
          <div class="box-body">
            <div class="table-responsive">
              <table id="list" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Avater</th>
                    <th>Participant</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Correct Answer</th>
                    <th>Time</th>
                    <th width="20%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if (count($finalResult))
                  @foreach ($finalResult as $key=>$leaderboards)
                  <tr>
                    <td colspan="7">
                      <h2><strong>{{$monthName[(int)$key - 1]}}</strong></h2>
                    </td>
                  </tr>
                  @foreach ($leaderboards as $leaderboard)
                  <tr>
                    <td>
                      @if (count(explode(':', $leaderboard['participantAvater'])) > 1)
                      <img width="50" src="{{$leaderboard['participantAvater']}}" alt="" />
                      @else
                      <img width="50" src="{{asset("images/user/")}}/{{$leaderboard['participantAvater']}}" alt="" />
                      @endif
                    </td>
                    <td>{{$leaderboard['participant']}}</td>
                    <td>{{$leaderboard['participantEmail']}}</td>
                    <td>{{$leaderboard['participantContactNumber']}}</td>
                    <td>{{$leaderboard['correctAnswer']}}</td>
                    <td>{{$leaderboard['time']}}</td>
                    <td>
                      <a target="_blank" href="{{route('getCertificate', [$leaderboard['participantId']])}}"
                        class="btn btn-primary">Get Certificate</a>

                      @if (count(explode(':', $leaderboard['participantAvater'])) > 1)
                      <a target="_blank" download href="{{$leaderboard['participantAvater']}}"
                        class="btn btn-primary">Download Image</a>
                      @else
                      <a target="_blank" download href="{{asset("images/user/")}}/{{$leaderboard['participantAvater']}}"
                        class="btn btn-primary">Download Image</a>
                      @endif
                    </td>
                  </tr>
                  @endforeach

                  @endforeach
                  @endif

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  @endsection


  @push('script')
  <script>

  </script>
  @endpush