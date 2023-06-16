@extends("frontend.layouts.master")
    
@section("content")

    <!-- Breadcumb Area -->
    <div class="breadcumb_area h-25">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Login &amp; Register</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    
    <div class="bigshop_reg_log_area">
        <div class="container auth-body">
            {{-- <div class="row">
                <!-- Login Area -->
                <div class="col-12 col-md-6">
                    <div class="login_form mb-50">
                        <h5 class="mb-3">Login</h5>

                        <form action="{{route('login.submit')}}" method="post">
                            @csrf
                            <div class="form-group col col-12">
                                <input type="email" class="form-control" name="email" id="username" placeholder="Email or Username">
                                @error('email')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                @error('password')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-check">
                                <div class="custom-control custom-checkbox mb-3 pl-1">
                                    <input type="checkbox" class="custom-control-input" id="customChe">
                                    <label class="custom-control-label" for="customChe">Remember me for this computer</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Login</button>
                        </form>
                        <!-- Forget Password -->
                        <div class="forget_pass mt-15">
                            <a href="#">Forget Password?</a>
                        </div>
                    </div>
                </div>
                <!-- Login Area End -->

                <!-- Register Area -->
                <div class="col-12 col-md-6">
                    <div class="login_form mb-50">
                        <h5 class="mb-3">Register</h5>

                        <form action="{{route('register.submit')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="text" class="form-control" name="full_name" id="username" placeholder="Full Name" value="{{old('full_name')}}">
                                @error('full_name')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="{{old('username')}}">
                                @error('username')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="username" placeholder="Email" value="{{old('email')}}">
                                @error('email')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="{{old('password')}}">
                                @error('password')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password_confirmation" id="password" placeholder="Repeat Password" value="{{old('confirm_password')}}">
                                @error('confirm_password')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Register</button>
                        </form>
                    </div>
                </div>
                <!-- Register Area End-->
            </div> --}}
            <div class="main col col-12 col-md-6 col-lg-4">
                <input type="checkbox" id="chk" aria-hidden="true">
            
                <div class="signup col col-12">
                    <form class="col col-12" action="{{route('register.submit')}}" method="post">
                        @csrf
                        <label class="text-dark" for="chk" aria-hidden="true">Sign up</label>
                        <div class="form-group col col-12">
                            <input type="text" class="form-control" name="full_name" id="username" placeholder="Full Name" value="{{old('full_name')}}">
                            @error('full_name')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="form-group col col-12">
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="{{old('username')}}">
                            @error('username')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="form-group col col-12">
                            <input type="email" class="form-control" name="email" id="username" placeholder="Email" value="{{old('email')}}">
                            @error('email')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        
                        <div class="form-group col col-12">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="{{old('password')}}">
                            @error('password')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group col col-12">
                            <input type="password" class="form-control" name="password_confirmation" id="password" placeholder="Repeat Password" value="{{old('confirm_password')}}">
                            @error('confirm_password')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col col-8 m-auto">
                            <button type="submit" class="btn btn-primary btn-sm w-100">Register</button>
                        </div>
                    </form>
                </div>
            
                <div class="login col col-12">
                    <form class="col col-12" action="{{route('login.submit')}}" method="post">
                        @csrf
                        <label class="text-dark" for="chk" aria-hidden="true">Log in</label>
                        <div class="form-group col col-12">
                            <input type="email" class="form-control" name="email" id="username" placeholder="Email or Username">
                            @error('email')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group col col-12">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            @error('password')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="custom-control-input" id="customChe">
                            <label class="custom-control-label" for="customChe"><h6>Remember me for this computer</h6></label>
                        </div>
                        <div class="col col-8 m-auto">
                            <button type="submit" class="btn btn-primary btn-sm w-100">Login</button>
                        </div>
                    </form>
                    <!-- Forget Password -->
                    <div class="forget_pass mt-15">
                        <a href="#">Forget Password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('styles')
<style>
    .footer_area{
        display: none;
    }
</style>