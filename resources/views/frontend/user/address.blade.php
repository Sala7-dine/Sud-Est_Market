@extends('frontend.layouts.master')


@section('content')

<!-- Breadcumb Area -->
<div class="breadcumb_area">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <h5>My Account</h5>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">My Account</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Breadcumb Area -->

<!-- My Account Area -->
<section class="my-account-area section_padding_100_50">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="my-account-navigation mb-50">
                    @include("frontend.user.sidebar")
                </div>
            </div>
            <div class="col-12 col-lg-9">
                <div class="my-account-content mb-50">
                    <p>The following addresses will be used on the checkout page by default.</p>

                    <div class="row">
                        <div class="col-12 col-lg-6 mb-5 mb-lg-0">
                            <h6 class="mb-3">Billing Address</h6>
                            <address>
                                {{$user->address}} <br>
                                {{$user->state}} , {{$user->city}} <br>
                                {{$user->country}} <br>
                                {{$user->postcode}}
                            </address>
                            <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editAddress">Edit Address</a>

                            <!-- Address Modal -->
                            <div class="modal fade" id="editAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false" style="background:rgb(0,0,0,0.5);z-index:9999999">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('billing.address' , $user->id)}}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="">Address</label>
                                                    <textarea name="address" class="form-control" placeholder="Address">{{$user->address}}</textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Country</label>
                                                    <input type="text" name="country" class="form-control" placeholder="country" value="{{$user->country}}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Postcode</label>
                                                    <input type="text" name="postcode" class="form-control" placeholder="postcode" value="{{$user->postcode}}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="">State</label>
                                                    <input type="text" name="state" class="form-control" placeholder="state" value="{{$user->state}}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="">City</label>
                                                    <input type="text" name="city" class="form-control" placeholder="city" value="{{$user->city}}">
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <h6 class="mb-3">Shipping Address</h6>
                            <address>
                                {{$user->saddress}} <br>
                                {{$user->sstate}} , {{$user->scity}} <br>
                                {{$user->scountry}} <br>
                                {{$user->spostcode}}
                            </address>
                            <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editSAddress">Edit Shipping Address</a>

                            <!-- Shipping Address Modal -->
                            <div class="modal fade" id="editSAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false" style="background:rgb(0,0,0,0.5);z-index:9999999">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('shipping.address' , $user->id)}}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="">Shipping Address</label>
                                                    <textarea name="saddress" class="form-control" placeholder="Address">{{$user->saddress}}</textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Shipping Country</label>
                                                    <input type="text" name="scountry" class="form-control" placeholder="country" value="{{$user->scountry}}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Shipping Postcode</label>
                                                    <input type="text" name="spostcode" class="form-control" placeholder="postcode" value="{{$user->spostcode}}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Shipping State</label>
                                                    <input type="text" name="sstate" class="form-control" placeholder="state" value="{{$user->sstate}}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Shipping City</label>
                                                    <input type="text" name="scity" class="form-control" placeholder="city" value="{{$user->scity}}">
                                                </div>


                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- My Account Area -->

@endsection


@section("styles")

<style>
    .footer_area{
        z-index: -1;
    }
</style>

@endsection