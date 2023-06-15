@extends("backend.layouts.master")

@section("content")

<div id="main-content">
  <div class="container-fluid">
    <div class="block-header">
      <div class="row">
        <div class="col-lg-6 col-md-8 col-sm-12">
          <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Edit Product</h2>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>
            <li class="breadcrumb-item">Product</li>
            <li class="breadcrumb-item active">Edit Product</li>
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

            <form action="{{route('product.update' , $product->id)}}" method="post">
            @csrf
            @method('patch')
            <div class="row clearfix">

              <div class="col-lg-12 col-md-12">
                <div class="form-group">
                  <label for="">Title <span class="text-danger"> *</span></label>
                  <input type="text" class="form-control" name="title" value="{{$product->title}}" placeholder="Title">
                </div>
              </div>


              <div class="col-lg-12 col-md-12">
                <div class="form-group">
                  <label for="">Summary <span class="text-danger"> *</span></label>
                  <textarea class="form-control" name="summary" id="summary"  placeholder="summary ...">
                  {{$product->summary}}</textarea>
                </div>
              </div>


              <div class="col-lg-12 col-md-12">
                <div class="form-group">
                  <label for="">Description</label>
                  <textarea type="text" id="description" class="form-control" placeholder="write some text ..." name="description">{{$product->description}}</textarea>
                </div>
              </div>

              <div class="col-lg-12 col-md-12">
                <div class="form-group">
                  <label for="">Stock <span class="text-danger"> *</span></label>
                  <input type="number" class="form-control" name="stock" value="{{$product->stock}}" placeholder="stock">
                </div>
              </div>

              <div class="col-lg-12 col-md-12">
                <div class="form-group">
                  <label for="">Price <span class="text-danger"> *</span></label>
                  <input type="number" step="any" class="form-control" name="price" value="{{$product->price}}" placeholder="price">
                </div>
              </div>

              <div class="col-lg-12 col-md-12">
                <div class="form-group">
                  <label for="">Discount </label>
                  <input type="number" step="any" class="form-control" name="discount" value="{{$product->discount}}" placeholder="discount">
                </div>
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
                    <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$product->photo}}">
                  </div>
                  <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                </div>
              </div>
            
              <div class="col-lg-12 col-md-6 col-sm-12">
                <label for="">Brands</label>
                <select name="brand_id" class="form-control show-tick">
                  <option value="">-- Brands --</option>
                  @foreach(\App\Models\Brand::get() as $brand)
                  <option value="{{$brand->id}}" {{$brand->id == $product->brand_id ? 'selected' : ''}}>{{$brand->title}}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-lg-12 col-md-6 col-sm-12">
                <label for="">Category</label>
                <select id="cat_id" name="cat_id" class="form-control show-tick">
                  <option value="">-- Category --</option>
                  @foreach(\App\Models\Category::where('is_parent' ,1)->get() as $cat)
                  <option value="{{$cat->id}}" {{$cat->id == $product->cat_id ? 'selected' : ''}}>{{$cat->title}}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-lg-12 col-md-6 col-sm-12 d-none" id="child_cat_div">
                <label for="">Child Category</label>
                <select id="child_cat_id" name="child_cat_id" class="form-control show-tick">
                  <option value="">-- Child Category --</option>
                </select>
              </div>

              <div class="col-lg-12 col-md-6 col-sm-12">
                <label for="">Size</label>
                <select name="size" class="form-control show-tick">
                  <option value="">-- Size --</option>
                  <option value="S" {{$product->size == 'S' ? 'selected' : ''}}>Small</option>
                  <option value="M" {{$product->size == 'M' ? 'selected' : ''}}>Meduim</option>
                  <option value="L" {{$product->size == 'L' ? 'selected' : ''}}>Large</option>
                  <option value="XL" {{$product->size == 'XL' ? 'selected' : ''}}>Extra Large</option>
                </select>
              </div>

              <div class="col-lg-12 col-md-6 col-sm-12">
                <label for="">Condition</label>
                <select name="conditions" class="form-control show-tick">
                  <option value="">-- Conditions --</option>
                  <option value="NEW" {{$product->conditions == 'NEW' ? 'selected' : ''}}>New</option>
                  <option value="POPULAR" {{$product->conditions == 'POPULAR' ? 'selected' : ''}}>Popular</option>
                  <option value="WINTER" {{$product->conditions == 'WINTER' ? 'selected' : ''}}>winter</option>
                </select>
              </div>

              <div class="col-lg-12 col-md-6 col-sm-12">
                <label for="">Vendors</label>
                <select name="vendor_id" class="form-control show-tick">
                  <option value="">-- Vendors --</option>
                  @foreach(\App\Models\User::where('role' , "vendor")->get() as $vendor)
                  <option value="{{$vendor->id}}" {{$vendor->id == $product->vendor_id ? 'selected' : ''}}>{{$vendor->full_name}}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-lg-12 col-sm-12">
                <label for="">Status </label>
                <select name="status" class="form-control show-tick">
                  <option value="">-- Status --</option>
                  <option value="active" {{$product->status == 'active' ? 'selected' : ''}}>Active</option>
                  <option value="inactive" {{$product->status == 'inactive' ? 'selected' : ''}}>Inactive</option>
                </select>
              </div>
              
              <button type="submit" class="btn btn-primary">Update</button>
                <button type="submit" class="btn btn-outline-secondary">Cancel</button>
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
    $('#description').summernote();
  });
</script>

<script>
  $(document).ready(function() {
    $('#summary').summernote();
  });
</script>



<script>
  
  var child_cat_id = <?php echo $product->child_cat_id; ?>;
  $('#cat_id').change(function() {
    var cat_id = $(this).val();
    if(cat_id != null){
      $.ajax({
        url: "/admin/category/"+cat_id+"/child",
        type : "POST", 
        data : {
          _token : "{{csrf_token()}}",
          cat_id : cat_id,
        },
        success : function(response){
          var html_option =  "<option value=''>-- Child Category --</option>";
          if(response.status)
          {
            $("#child_cat_div").removeClass("d-none");
            $.each(response.data, function(id,title){
              html_option += `<option value='${id}' ${child_cat_id=id ? 'selected' : ''}>${title}</option>` 
             
            });
          }else{
            $("#child_cat_div").addClass("d-none");
          }
          $("#child_cat_id").html(html_option);
        }
      })
    }
  });

  if(child_cat_id != null)
  {
    $("#cat_id").change();
  }
</script>
@endsection