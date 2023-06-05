@extends("backend.layouts.master")

@section("content")

<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Users
                
                    <a href="{{route('user.create')}}" class="btn btn-sm btn-outline-secondary"><i class="icon-plus"></i> Create User</a>
                </h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">User</li>
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
                        <h2><strong>User</strong> List</h2>
                        <p class="mt-2 float-left">Total Users : {{\App\Models\User::count()}}</p>

                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Photo</th>
                                        <th>Full name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($users as $item)

                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td><img src="{{$item->photo}}" alt="banner image" style="height:60px;width:60px;border-radius:50%;max-height:80px;max-width:110px"></td>
                                        <td>{{$item->full_name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->role}}</td>
                                        <td>
                                            <input type="checkbox" data-toggle="switchbutton" name="toggle" value="{{$item->id}}" {{$item->status=="active" ? "checked" : '' }} data-onlabel="active" data-offlabel="inactive" data-size="sm" data-onstyle="success" data-offstyle="danger">
                                        </td>
                                        <td>
                                        <a href="javascript:void(0);" title="view" data-placement="bottom" class="float-left btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#userID{{$item->id}}"> <i class="fas fa-eye"></i> </a>
                                            <a href="{{route('user.edit' , $item->id )}}" data-toggle="tootltip" title="edit" data-placement="bottom" class="float-left btn btn-sm btn-outline-warning"> <i class="fas fa-edit"></i> </a>

                                            <form class="float-left" action="{{route('user.destroy' , $item->id)}}" method="post">
                                                @csrf
                                                @method("delete")
                                                <a href="" data-toggle="tootltip" title="delete" data-id="{{$item->id}}" data-placement="bottom" class="dltBtn btn btn-sm btn-outline-danger"> <i class="fas fa-trash-alt"></i> </a>
                                            </form>
                                        </td>

                                        <div class="modal fade" id="userID{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                @php
                                                $user = \App\Models\User::where("id" , $item->id)->first();
                                                @endphp
                                                <div class="modal-content">
                                                    <div class="text-center">   
                                                        <img src="{{$user->photo}}" style="height:100px;width:100px;border-radius:50%;margin:2% 0;" alt="">
                                                    </div>
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" text-center id="exampleModalLabel">{{$user->full_name}} </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <strong>Username : </strong>
                                                        <p>{{$user->username}}</p>



                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <strong>Email : </strong>
                                                                <p>{{$user->email}}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <strong>Phone : </strong>
                                                                <p>{{$user->phone}}</p>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <strong>Address : </strong>
                                                                <p>{{$user->address}}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <strong>Role : </strong>
                                                                <p>{{$user->role}}</p>
                                                            </div>
                                                        </div>


                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <strong>Status : </strong>
                                                                <p class="badge badge-warning">{{$user->status}}</p>
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
            url: "{{route('user.status')}}",
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