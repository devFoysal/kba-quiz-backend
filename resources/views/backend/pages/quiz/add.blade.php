@extends('backend.master')
@section("title", "Add new quiz")
@section('content')

<section class="content">
  <div class="row">
    <section class="col-md-8 col-md-offset-2">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Add new quiz</h3>
        </div>
        <form role="form" id="portfolioCategoryForm" method="post" action="{{URL::to('management/quiz/add')}}"
          enctype="multipart/form-data">
          @csrf
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
                  <input type="text" name="titleEn" class="form-control" id="titleEn" placeholder="Quiz title (en)"
                    value="{{old('titleEn')}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="titleBn">Title (bn)</label>
                  <input type="text" name="titleBn" class="form-control" id="titleBn" placeholder="Quiz title (bn)"
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


            {{-- <div class="row">
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
          <div class="box-footer add">
            <button type="submit" class="btn btn-primary add" style="float: right;">Add</button>
          </div>
        </form>
      </div>
    </section>
  </div>
</section>
@endsection