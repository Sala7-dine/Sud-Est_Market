@extends("backend.layouts.master")

@section("content")

<div id="main-content">
  <div class="container-fluid">
    <div class="block-header">
      <div class="row">
        <div class="col-lg-6 col-md-8 col-sm-12">
          <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Edit Category</h2>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>
            <li class="breadcrumb-item">Category</li>
            <li class="breadcrumb-item active">Edit Categories</li>
          </ul>
        </div>
      </div>
    </div>

    <div class="row clearfix">
      <div class="col-md-12">
        @if($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $error)
            <li> {{$error}} </li>
            @endforeach
          </ul>
        </div>
        @endif
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
          <div class="body">

            <form action="{{route('category.update', $category->id)}}" method="post">
              @csrf
              @method("patch")
              <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                  <div class="form-group">
                    <label for="">Title <span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="title" value="{{$category->title}}" placeholder="Title">
                  </div>
                  <div class="form-group">
                    <label for="">url <span class="text-danger"> *</span></label>
                    <input type="text" class="form-control" name="slug" value="{{$category->slug}}" placeholder="slug">
                  </div>
                </div>


                <div class="col-lg-12 col-md-12">
                  <div class="form-group">
                    <label for="">Summary</label>
                    <textarea type="text" id="summary" class="form-control" placeholder="write some text ..." name="summary">{{$category->summary}}</textarea>
                  </div>
                </div>


                <div class="col-lg-12 col-md-12">
                  <div class="form-group">
                    <label for="">Is parent : </label>
                    <input id="is_parent" type="checkbox" name="is_parent" value="1" {{$category->is_parent==1 ? 'checked' : ''}}> Yes
                  </div>
                </div>

                <div class="col-lg-12 col-md-6 col-sm-12 {{$category->is_parent==1 ? 'd-none' : ''}}" id="parent_cat_dev">
                  <label for="">Parent Category</label>
                  <select name="parent_id" class="form-control show-tick">
                    <option value="">-- Parent Category --</option>
                    @foreach($parent_cats as $pcats)
                    <option value="{{$pcats->id}}" {{$pcats->id == $category->parent_id ? 'selected' :  ''}}>{{$pcats->title}}</option>
                    @endforeach
                  </select>
                </div>


                <div class="col-lg-12 col-md-12">
                  <div class="form-group">
                    <label for="">Photo</label>
                    <div class="input-group">
                      <span class="input-group-btn">
                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                          <i class="fa fa-picture-o"></i> Choose
                        </a>
                      </span>
                      <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$category->photo}}">
                    </div>
                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                  </div>
                </div>

                <div class="col-sm-12">
                  <button type="submit" class="btn btn-success">Update</button>
                  <button type="submit" class="btn btn-outline-info">Cancel</button>
                </div>
              </div>

            </form>


          </div>
        </div>
      </div>
    </div>




  </div>
</div>

@endsection


@section("scripts")

<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

<script>
  $('#lfm').filemanager('image');
</script>


<script>
  $(document).ready(function() {
    $('#summary').summernote();
  });
</script>

<script>
  $('#is_parent').change(function(e) {
    e.preventDefault();
    var is_checked = $('#is_parent').prop("checked");
    if (is_checked) {
      $("#parent_cat_dev").addClass("d-none");
      $("#parent_cat_dev").val("");
    } else {
      $("#parent_cat_dev").removeClass("d-none");

    }
  });
</script>
@endsection