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
                        <div class="cart-table">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Order</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">
                                                #2257
                                            </th>
                                            <td>
                                                30 August 2019
                                            </td>
                                            <td>
                                                Pending
                                            </td>
                                            <td>$9</td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm m-2">Pay</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                #2256
                                            </th>
                                            <td>
                                                28 August 2019
                                            </td>
                                            <td>
                                                Completed
                                            </td>
                                            <td>$11</td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm m-2">View</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                #2255
                                            </th>
                                            <td>
                                                27 August 2019
                                            </td>
                                            <td>
                                                Completed
                                            </td>
                                            <td>$6</td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm m-2">View</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                #2254
                                            </th>
                                            <td>
                                                25 August 2019
                                            </td>
                                            <td>
                                                Completed
                                            </td>
                                            <td>$17</td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm m-2">View</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                #2253
                                            </th>
                                            <td>
                                                22 August 2019
                                            </td>
                                            <td>
                                                Cancelled
                                            </td>
                                            <td>$13</td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm m-2">View</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- My Account Area -->

@endsection 