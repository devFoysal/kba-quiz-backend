@extends('backend.master')
@section("title", "Question")
@section('content')


<section class="content-header">
  @if( Session::has('message') )
  <div class="callout {{Session::get('class')}}">
    <h4>{{Session::get('message')}}</h4>
  </div>
  @endif


  <div class="row">
    <div class="col-lg-12">
      <div class="box">
        <div class="box-header ui-sortable-handle" style="cursor: move;">
          <h3 class="box-title text-uppercase">Question ({{$totalQuestion}})
            <a href="{{URL::to('management/question/add')}}" class="btn btn-primary pull-right"><i
                class="fa fa-plus"></i></a>
          </h3>
        </div>
      </div>
    </div>
  </div>
</section>
{{-- {{dd($questions)}} --}}
<section class="content">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Question list</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table id="list" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Sr.</th>
                  <th width='10%'>Quiz (en)</th>
                  <th width='10%'>Quiz (bn)</th>
                  <th>Question (en)</th>
                  <th>Question (bn)</th>
                  <th>Answer</th>
                  <th>Status</th>
                  <th>Register At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @if(count($questions) > 0)
                @foreach($questions as $key => $question)
                <tr>
                  <td>{{$key + 1}}</td>
                  <td>
                    {{$question->Quiz->titleEn}}
                  </td>
                  <td>
                    {{$question->Quiz->titleBn}}
                  </td>
                  {{-- <td>
                    @if($question->thumbnail !== '')
                    <img width="50" src="{{asset("storage/images/question/thumbnail")}}/{{$question->thumbnail}}"
                  alt="">
                  @else
                  {{'No thumbnail'}}
                  @endif

                  </td>
                  <td>
                    @if($question->thumbnail !== '')
                    <img width="50" src="{{asset("storage/images/question/thumbnail_bn")}}/{{$question->thumbnail_bn}}"
                      alt="">
                    @else
                    {{'No thumbnail'}}
                    @endif

                  </td> --}}
                  <td>{!!$question->titleEn!!}</td>
                  <td>{!!$question->titleBn!!}</td>
                  <td>
                    @foreach($question->answers as $ans)
                    @if ($ans->rightAnswer == 1)
                      <p>{{$ans->titleBn}} - {{'Right'}}</p>
                    @endif

                    @endforeach
                  </td>
                  <td>
                    {{$question->status}}
                  </td>
                  <td>
                    {{date('d F Y', strtotime($question->created_at))}}
                  </td>
                  <td>
                    <a class="edit btn btn-primary" id="{{$question->id}}"><i class="fa fa-edit"></i></a>
                    <a class="delete btn btn-danger" id="{{$question->id}}"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
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

{{-- Edit --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit question</h5>
      </div>

      <div class="modal-body">
        <form role="form" id="portfolioCategoryForm" method="POST" action="{{URL::to('management/question/update')}}"
          enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="questionId">
          <div class="box-body">
            <div class="form-group">
              <div class="row">
                <div class="col-md-6 text-center">
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

                <div class="col-md-6 text-center">
                  <label for="title" style="display: block; text-align: left">Thumbnail Bn</label>
                  <div class="file-upload">
                    <label for="thumbnail_bn" class="file-upload__label" id="lableImage2">
                      <img src="{{asset('storage/images/camera.png')}}" alt="">
                    </label>
                    <input type="file" name="thumbnail_bn" accept=".png,.jpg,.jpeg,.gif"
                      class="form-control file-upload__input" id="thumbnail_bn" onChange="showPreviewImage2(this);">
                    @if ($errors->has('thumbnail_bn'))
                    <p class="text-danger">{{ $errors->first('thumbnail_bn') }}</p>
                    @endif
                    <small id="thumbnailHelp" class="form-text text-muted">Image size: (758x397)</small>
                  </div>
                </div>
              </div>
            </div>


            <div class="form-group">
              <label for="status">Quiz <sup class="required">*</sup></label>
              <select name="quiz" id="quiz" class="form-control" required>
                @if (count($quizzes) > 0)
                @foreach ($quizzes as $quiz)
                <option value="{{$quiz->id}}">{{$quiz->titleBn}}</option>
                @endforeach
                @endif
              </select>
              @if ($errors->has('quiz'))
              <p class="text-danger">{{ $errors->first('quiz') }}</p>
              @endif
            </div>



            <div id="question-list">
              <div class="row align-items-center">
                {{-- <div class="col-md-6">
                  <div class="form-group">
                    <label for="titleEn">Question (en)</label>
                    <textarea type="text" name="titleEn" class="form-control titleEn"></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="titleBn">Question (bn)</label>
                    <textarea type="text" name="titleBn" class="form-control titleBn"></textarea>
                  </div>
                </div> --}}
                <div class="col-md-12">
                  <div class="answer-list">

                  </div>
                </div>
              </div>

            </div>

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
    summerNote('.titleEn', ['Ubuntu'])
    summerNote('.titleBn', ['Ubuntu', 'Hind+Siliguri'])
    let tblList = $('#list').DataTable({
      // order: [ [0, 'desc'] ]
    });
  })
  let answer = 0;
  var questionId;
  $(document).on('click', '.delete', function(){
    questionId = $(this).attr('id');
    if (confirm("Are you sure?")) {
      deleteItem()
    }
  });

    $(document).on('click', '.add-more-answer',function(e){
      answer++ ;
        e.preventDefault();
        $(this).parents('.answer-list').append(
        `
        <input type="hidden" name="answerId[]" value="${answer}" />        
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="answerEn">Answer (en)</label>
              <input type="text" name="answerEn[]" class="form-control" id="answerEn" placeholder="Answer (en)"
                value="{{old('answerEn')}}">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="answerBn">Answer (bn)</label>
              <input type="text" name="answerBn[]" class="form-control" id="answerBn" placeholder="Answer (bn)"
                value="{{old('answerBn')}}">
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="answerBn">Right Answer</label>
              <select name="right_answer[]" class="form-control">
                <option value="1">Yes</option>
                <option value="0" selected>No</option>
              </select>
            </div>
          </div>
          <div class="col-md-2"><button class="btn btn-danger btn-sm remove-answer">remove answer</button></div>
        </div>`
        )
        })

        $(document).on('click', '.remove-answer', function(e){
          e.preventDefault();
            let answerId = $(this).attr('data-id');
            let _this = this;
            if(answerId > 0 && answerId !== undefined){
              $.ajax({
              url: "{{URL::to('management/question/answer/delete')}}/" + answerId,
              success:function(data){
                if(data.success) $(_this).parent().parent().remove();
              }
              })
            }else{
              $(this).parent().parent().remove(); //Remove field html
            }
            
            
        })

    $(document).on('click', '.edit', function(){
      $('.answer-list').html('');
      questionId = $(this).attr('id');
      $.ajax({
        url:"{{URL::to('management/question')}}/" + questionId + "/edit",
        dataType: 'json',
        beforeSend:function(){

        },
        success:function(response){
          // console.log(response.data.answers)
          if(response.success){
            $('input[name=questionId]').val(response.data.id);
           if(response.data.thumbnail){
            $('#lableImage1').children().attr('src', "{{URL::to("storage/images/question/thumbnail")}}/" + response.data.thumbnail)
           }else{
            $('#lableImage1').children().attr('src', "{{URL::to("storage/images/camera.png")}}")
           }

            $('input[name=titleEn]').val(response.data.titleEn);
            if(response.data.titleBn != null){
              $('.titleEn').summernote("code", response.data.titleEn)
            }else{
              $('.titleEn').summernote("code", "")
            }
            $('input[name=titleBn]').val(response.data.titleBn);
            if(response.data.titleBn != null){
              $('.titleBn').summernote("code", response.data.titleBn)
            }else{
              $('.titleBn').summernote("code", "")
            }
            // data.answers.forEach(function(answer){
            $.each(response.data.answers, function(key, answer){
              $('.answer-list').append(`
              <input type="hidden" name="answerId[]" value="${answer.id}"/>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="answerEn">Answer (en)</label>
                    <input type="text" name="answerEn[]" class="form-control" id="answerEn" placeholder="Answer (en)"
                      value="${answer.titleEn}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="answerBn">Answer (bn)</label>
                    <input type="text" name="answerBn[]" class="form-control" id="answerBn" placeholder="Answer (bn)"
                      value="${answer.titleBn}">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="answerBn">Right Answer</label>
                    <select name="right_answer[]" class="form-control">
                    ${
                      answer.rightAnswer == 1 ?
                        `<option value="1" selected>Yes</option>
                        <option value="0">No</option>`
                      :
                        `<option value="1">Yes</option>
                        <option value="0" selected>No</option>`
                    
                    }
                     
                    </select>
                  </div>
                </div>
                ${key === 0 ? `<div class="col-md-2"><button class="btn btn-success btn-sm add-more-answer">Add more
                    answer</button></div>`:`<div class="col-md-2"><button data-id="${answer.id}" class="btn btn-danger btn-sm remove-answer">remove answer</button></div>`}
                
              </div>
              `)
            })

            $("select[name=quiz] option:contains("+response.data.quiz.titleBn+")").attr('selected', 'selected');
            if(! response.data.status == 1){
              $("select[name=status] option:contains('Active')").attr('selected', 'selected');
              $("select[name=status] option:contains('Active')").prop('selected', true);
            }else if(response.data.status == 0){
              $("select[name=status] option:contains('Inactive')").attr('selected', 'selected');
              $("select[name=status] option:contains('Inactive')").prop('selected', true);
            }
      
            if(! response.data.status == 1){
              $("select[name=status] option:contains('Active')").attr('selected', 'selected');
              $("select[name=status] option:contains('Active')").prop('selected', true);
            }else if(response.data.status == 0){
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
        url: "{{URL::to('management/question/delete')}}/" + questionId,
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

    function summerNote(selector, fonts){
      $(selector).summernote({
      toolbar: [
      ['font', ['bold', 'italic', 'underline', 'clear','fontsize']],
      ['fontname', ['fontname']],
      ['color', ['color']],
      ],
      fontSizes: ['12', '14', '16','18', '24', '36', '48' , '64', '82', '150'],
      fontNames: fonts,
      })
      }
</script>
@endpush