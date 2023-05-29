@extends("backend.layouts.master")

@section("content")

<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Banners
                
                    <a href="{{route('banner.create')}}" class="btn btn-sm btn-outline-secondary"><i class="icon-plus"></i> Create Banner</a>
                </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Banner</li>
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
                        <h2><strong>Banner</strong> List</h2>
                        <p class="mt-2 float-left">Total Banners : {{\App\Models\Banner::count()}}</p>

                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Photo</th>
                                        <th>Conditions</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($banners as $item)

                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->title}}</td>
                                        <td>{!! html_entity_decode($item->description) !!}</td>
                                        <td><img src="{{$item->photo}}" alt="banner image" style="max-height:80px;max-width:110px"></td>
                                        <td>
                                            @if($item->condition == "banner") 
                                            <span class="badge badge-success">{{$item->condition}}</span>
                                            @else
                                            <span class="badge badge-primary">{{$item->condition}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <input type="checkbox" data-toggle="switchbutton" name="toggle" value="{{$item->id}}" {{$item->status=="active" ? "checked" : '' }} data-onlabel="active" data-offlabel="inactive" data-size="sm" data-onstyle="success" data-offstyle="danger">
                                        </td>
                                        <td>
                                            <a href="{{route('banner.edit' , $item->id )}}" data-toggle="tootltip" title="edit" data-placement="bottom" class="float-left btn btn-sm btn-outline-warning"> <i class="fas fa-edit"></i> </a>

                                            <form class="float-left" action="{{route('banner.destroy' , $item->id)}}" method="post">
                                                @csrf
                                                @method("delete")
                                                <a href="" data-toggle="tootltip" title="delete" data-id="{{$item->id}}" data-placement="bottom" class="dltBtn btn btn-sm btn-outline-danger"> <i class="fas fa-trash-alt"></i> </a>
                                            </form>
                                        </td>
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
            url: "{{route('banner.status')}}",
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