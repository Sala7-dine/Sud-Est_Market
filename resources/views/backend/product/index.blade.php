@extends("backend.layouts.master")

@section("content")

<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Products

                        <a href="{{route('product.create')}}" class="btn btn-sm btn-outline-secondary"><i class="icon-plus"></i> Create Product</a>
                    </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Product</li>
                    </ul>

                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12">
                @include("backend.layouts.notification")
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Product </strong> List</h2>
                        <p class="mt-2 float-left">Total Products : {{\App\Models\Product::count()}}</p>

                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Title</th>
                                        <th>Photo</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Size</th>
                                        <th>Conditions</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($products as $item)

                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->title}}</td>
                                        <!-- <td>{!! html_entity_decode($item->description) !!}</td> -->
                                        <td><img src="{{$item->photo}}" alt="banner image" style="max-height:80px;max-width:110px"></td>

                                        <td>${{number_format($item->price,2)}}</td>
                                        <td>{{$item->discount}} %</td>
                                        <td>{{$item->size}}</td>
                                        <td>
                                            @if($item->conditions == "NEW")
                                            <span class="badge badge-success">{{$item->conditions}}</span>
                                            @elseif($item->conditions == "POPULAR")
                                            <span class="badge badge-warning">{{$item->conditions}}</span>
                                            @else
                                            <span class="badge badge-primary">{{$item->conditions}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <input type="checkbox" data-toggle="switchbutton" name="toggle" value="{{$item->id}}" {{$item->status=="active" ? "checked" : '' }} data-onlabel="active" data-offlabel="inactive" data-size="sm" data-onstyle="success" data-offstyle="danger">
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" title="view" data-placement="bottom" class="float-left btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#productID{{$item->id}}"> <i class="fas fa-eye"></i> </a>
                                            <a href="{{route('product.edit' , $item->id )}}" data-toggle="tootltip" title="edit" data-placement="bottom" class="float-left btn btn-sm btn-outline-warning"> <i class="fas fa-edit"></i> </a>

                                            <form class="float-left" action="{{route('product.destroy' , $item->id)}}" method="post">
                                                @csrf
                                                @method("delete")
                                                <a href="" data-toggle="tootltip" title="delete" data-id="{{$item->id}}" data-placement="bottom" class="dltBtn btn btn-sm btn-outline-danger"> <i class="fas fa-trash-alt"></i> </a>
                                            </form>
                                        </td>



                                        <div class="modal fade" id="productID{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                @php
                                                $product = \App\Models\Product::where("id" , $item->id)->first();
                                                @endphp
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">{{\Illuminate\Support\Str::upper($product->title)}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <strong>Summary : </strong>
                                                        <p>{!! html_entity_decode($product->summary) !!}</p>

                                                        <strong>Description : </strong>
                                                        <p>{!! html_entity_decode($product->description) !!}</p>


                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <strong>Price : </strong>
                                                                <p>$ {{number_format($product->price,2)}}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <strong>Offre Price : </strong>
                                                                <p>$ {{number_format($product->offre_price,2)}}</p>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                            <strong>Category : </strong>
                                                            <p>{{\App\Models\Category::where("id",$product->cat_id)->value("title") }}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <strong>Child Category : </strong>
                                                                <p>{{\App\Models\Category::where("id",$product->child_cat_id)->value("title") }}</p>
                                                            </div>
                                                        </div>


                                                        <div class="row">
                                                            <div class="col-md-6">
                                                            <strong>Brand : </strong>
                                                            <p>{{\App\Models\Brand::where("id",$product->brand_id)->value("title") }}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <strong>Size : </strong>
                                                                <p class="badge badge-success">{{$product->size}}</p>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                            <strong>Condition : </strong>
                                                            <p class="badge badge-primary">{{$product->conditions}}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <strong>Status : </strong>
                                                                <p class="badge badge-warning">{{$product->status}}</p>
                                                            </div>
                                                        </div>



                                                        


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@section("scripts")

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".dltBtn").click(function(e) {
        var form = $(this).closest("form");
        var dataId = $(this).data("id");
        e.preventDefault();
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to revover it!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                    swal("Poof! Your imaginary file has been deleted!", {
                        icon: "success",
                    });
                } else {
                    swal("Your imaginary file is safe!");
                }
            });
    });
</script>

<script>
    $('input[name=toggle]').change(function() {
        var mode = $(this).prop('checked');
        var id = $(this).val();

        $.ajax({
            url: "{{route('product.status')}}",
            type: "POST",
            data: {
                _token: '{{csrf_token()}}',
                mode: mode,
                id: id
            },
            success: function(response) {
                if (response.status) {
                    alert(response.msg);
                } else {
                    alert("please try again !!");
                }
            }

        })
    })
</script>

@endsection