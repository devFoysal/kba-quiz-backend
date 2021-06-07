@extends('backend.master')
@section("title", "Add new question")
@section('content')

<section class="content">
  <div class="row">
    <section class="col-md-8 col-md-offset-2">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Add new question</h3>
        </div>
        <form role="form" id="portfolioCategoryForm" method="post" action="{{URL::to('management/question/add')}}"
          enctype="multipart/form-data">
          @csrf
          <div class="box-body">
            {{-- <div class="form-group">
              <div class="row">
                <div class="col-md-6 text-center">
                  <label for="title" style="display: block; text-align: left">Thumbnail</label>
                  <div class="file-upload">
                    <label for="thumbnail" class="file-upload__label" id="lableImage1">
                      <img src="{{asset('storage/images/camera.png')}}" alt="">
            </label>
            <input type="file" name="thumbnail" accept=".png,.jpg,.jpeg,.gif"
              class="form-control file-upload__input @if($errors->has('thumbnail')) {{'is-invalid'}} @endif"
              id="thumbnail" onChange="showPreviewImage1(this);">
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
            class="form-control file-upload__input @if($errors->has('thumbnail_bn')) {{'is-invalid'}} @endif"
            id="thumbnail_bn" onChange="showPreviewImage2(this);">
          @if ($errors->has('thumbnail_bn'))
          <p class="text-danger">{{ $errors->first('thumbnail_bn') }}</p>
          @endif
          <small id="thumbnailHelp" class="form-text text-muted">Image size: (758x397)</small>
        </div>
      </div>

  </div>
  </div> --}}

  <div class="form-group">
    <label for="status">Quiz <sup class="required">*</sup></label>
    <select name="quiz" id="quiz" class="form-control" required>
      @if (count($quizzes) > 0)
      @foreach ($quizzes as $quiz)
      <option value="{{$quiz->id}}">{{$quiz->titleEn}}</option>
      @endforeach
      @endif
    </select>
    @if ($errors->has('quiz'))
    <p class="text-danger">{{ $errors->first('quiz') }}</p>
    @endif
  </div>
  <div id="question-list">
    <div class="row align-items-center">
      <div class="col-md-6">
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
      </div>
      {{-- <div class="col-md-2"><button class="btn btn-info btn-sm add-more-question">Add more
                    question</button></div> --}}
      <div class="col-md-12">
        <div class="answer-list">
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
            <div class="col-md-2"><button class="btn btn-success btn-sm add-more-answer">Add more
                answer</button></div>
          </div>
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
  <div class="box-footer add">
    <button type="submit" class="btn btn-primary add" style="float: right;">Add</button>
  </div>
  </form>
  </div>
</section>
</div>
</section>
<script>
  $(document).ready(function(){
    let answerCount = 0;
    $('.add-more-question').on('click', function(e){
      answerCount ++;
      e.preventDefault();
      $('#question-list').append(`              
      <div class="row align-items-center">
              <div class="col-md-5">
                <div class="form-group">
                  <label for="titleEn">Question (en)</label>
                  <textarea type="text" name="titleEn" class="form-control titleEn"></textarea>
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label for="titleBn">Question (bn)</label>
                  <textarea type="text" name="titleBn" class="form-control titleBn"></textarea>
                </div>
              </div>
              <div class="col-md-2"><button class="btn btn-danger btn-sm remove-question">Remove question</button></div>
            </div>

                          <div class="answer-list">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="answerEn">Answer (en)</label>
                      <input type="text" name="_${answerCount}_answerEn[]" class="form-control" id="answerEn" placeholder="Answer (en)"
                        value="{{old('answerEn')}}">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="answerBn">Answer (bn)</label>
                      <input type="text" name="_${answerCount}_answerBn[]" class="form-control" id="answerBn" placeholder="Answer (bn)"
                        value="{{old('answerBn')}}">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="answerBn">Right Answer</label>
                      <select name="_${answerCount}_right_answer[]" class="form-control">
                        <option value="1">Yes</option>
                        <option value="0" selected>No</option>
                      </select>
                    </div>
                  </div>
                    <div class="col-md-2"><button class="btn btn-success btn-sm add-more-answer">Add more
                        answer</button></div>
                </div>
              </div>
  `)


    })

    $(document).on('click', '.add-more-answer',function(e){
      e.preventDefault();
      $(this).parents('.answer-list').append(
        `<div class="row">
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

    $(document).on('click', '.remove-question', function(e){
      e.preventDefault();
       $(this).parent().parent().remove(); //Remove field html
       answerCount --;
    })     
    $(document).on('click', '.remove-answer', function(e){
      e.preventDefault();
       $(this).parent().parent().remove(); //Remove field html
    })     

  })


</script>
@endsection