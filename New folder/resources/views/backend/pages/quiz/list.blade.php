@extends('backend.master')
@section("title", "Quiz")
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


  <div class="row">
    <div class="col-lg-12">
      <div class="box">
        <div class="box-header ui-sortable-handle" style="cursor: move;">
          <h3 class="box-title text-uppercase">Quiz ({{$totalQuiz}})
            <a href="{{URL::to('management/quiz/add')}}" class="btn btn-primary pull-right"><i
                class="fa fa-plus"></i></a>
          </h3>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Quiz list</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="list" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Sr.</th>
                  <th>Title (en)</th>
                  <th>Title (bn)</th>
                  <th>Duration</th>
                  {{-- <th>Description (en)</th>
                  <th>Description (bn)</th> --}}
                  {{-- <th>Reference (en)</th>
                  <th>Reference (bn)</th> --}}
                  <th>Status</th>
                  <th>Date</th>
                  <th width="15%">Action</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Edit --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit quiz</h5>
      </div>

      <div class="modal-body">
        <form role="form" id="portfolioCategoryForm" method="post" action="{{URL::to('management/quiz/update')}}"
          enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="quizId">
          <div class="box-body">
            {{-- <div class="form-group">
              <div class="row">
                <div class="col-md-12 text-center">
                  <label for="title" style="display: block; text-align: left">Thumbnail</label>
                  <div class="file-upload">
                    <label for="thumbnail" class="file-upload__label" id="lableImage1">
                      <img src="{{asset('storage/images/camera.png')}}" alt="">
                    </label>
                    <input type="file" name="thumbnail" accept=".png,.jpg,.jpeg,.gif"
                      class="form-control file-upload__input" id="thumbnail" onChange="showPreviewImage1(this);">
                    @if ($errors->has('thumbnail'))
                    <p class="text-danger">{{ $errors->first('thumbnail') }}</p>
                    @endif
                    <small id="thumbnailHelp" class="form-text text-muted">Image size: (758x397)</small>
                  </div>
                </div>
              </div>
            </div> --}}


            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="titleEn">Title (en)</label>
                  <input type="text" name="titleEn" class="form-control" id="titleEn" placeholder="Slider title (en)"
                    value="{{old('titleEn')}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="titleBn">Title (bn)</label>
                  <input type="text" name="titleBn" class="form-control" id="titleBn" placeholder="Slider title (bn)"
                    value="{{old('titleBn')}}">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="duration">Duration</label>
                  <input type="text" name="duration" class="form-control" id="duration" placeholder="In Seconds"
                    value="{{old('duration')}}">
                </div>
              </div>

            </div>
{{-- 
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="shortDescriptionEn">Short description (en)</label>
                  <textarea type="text" name="shortDescriptionEn" class="form-control" id="shortDescriptionEn"
                    placeholder="Post short description (en)" value="{{old('shortDescriptionEn')}}"></textarea>
                </div>

              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="shortDescriptionBn">Short description (bn)</label>
                  <textarea type="text" name="shortDescriptionBn" class="form-control" id="shortDescriptionBn"
                    placeholder="Post short description (bn)" value="{{old('shortDescriptionBn')}}"></textarea>
                </div>
              </div>
            </div> --}}

            <div class="form-group">
              <label for="status">Status</label>
              <select name="status" id="status" class="form-control" required>
                <option value="1" selected>Active</option>
                <option value="0">Inactive</option>
              </select>
              @if ($errors->has('status'))
              <p class="text-danger">{{ $errors->first('status') }}</p>
              @endif
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
<style>
  .modal-dialog {
    width: 85% !important;
  }
</style>

@push('script')
<script>
  $(document).ready(function(){
         
    let tblList = $('#list').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url:"{{URL::to('management/quiz/list')}}",
        // success:function(res){
        //   console.log(res);
        // }
      },
      columns: [
          {
            data: "sr",
            name: "sr"
          },
          { 
            data: "titleEn",
            name: "Title En"
          },
          { 
            data: "titleBn",
            name: "Title Bn"
          },
          { 
            data: "duration",
            name: "duration" 
          },
          { 
            data: "status",
            name: "status" 
          },
    
          { 
            data: "created_at",
            name: "created_at" 
          },
          { 
            data: "action",
            name: "action",
            orderable:false
          }
      ],
      order: [ [0, 'desc'] ]
    });
  })
    var quizId;
    $(document).on('click', '.delete', function(){
      quizId = $(this).attr('id');
      if (confirm("Are you sure?")) {
        deleteItem()
      }
    });

    $(document).on('click', '.edit', function(){
      quizId = $(this).attr('id');
      $.ajax({
        url:"{{URL::to('management/quiz')}}/" + quizId + "/edit",
        dataType: 'json',
        beforeSend:function(){

        },
        success:function(data){
          if(data.success){
            $('input[name=quizId]').val(data.data.id);
            $('input[name=duration]').val(data.data.duration);

            $('input[name=titleEn]').val(data.data.titleEn);
            if(data.data.titleBn != null){
              $('input[name=titleBn]').val(data.data.titleBn);
            }else{
              $('input[name=titleBn]').val('');
            }
          
            if(! data.data.status == 1){
              $("select[name=status] option:contains('Active')").attr('selected', 'selected');
              $("select[name=status] option:contains('Active')").prop('selected', true);
            }else if(data.data.status == 0){
              $("select[name=status] option:contains('Inactive')").attr('selected', 'selected');
              $("select[name=status] option:contains('Inactive')").prop('selected', true);
            }
            $('#editModal').modal('show');
          }
        }
      })
    });

    function deleteItem(){
      $.ajax({
        url: "{{URL::to('management/quiz/delete')}}/" + quizId,
        beforeSend:function(){
        },
        success:function(data){
          if(data.success){
            setTimeout(function(){
              $('#list').DataTable().ajax.reload();
            },300)
          }
        }
      })
    }
</script>
@endpush