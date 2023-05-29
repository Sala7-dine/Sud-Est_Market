<!doctype html>
<html lang="en">

<head>
    <title>Login in | Marketplace</title>
    
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('backend/assets-login/css/style.css')}}">

</head>

<style>
    .container{
        border-radius: 10px;
        padding: 25px;
        width: 600px;
        background-color: #000;
        opacity: 0.7;
        margin-top: -22px;
}
</style>
<body class="img js-fullheight" style="background-image:url(backend/assets-login/images/bg1.jpg)">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-4">
                    <h2 class="heading-section">Sign in</h2>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-8">
                    <div class="login-wrap p-0">
                        <form class="signin-form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">

                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" id="signin-email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                            <div class="form-group">

                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" id="signin-password" placeholder="Password">
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary px-3">Login</button>
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-50">
                                    <label class="checkbox-wrap checkbox-primary">Remember Me
                                        <input type="checkbox" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="w-50 text-md-right">
                                    <a href="#" style="color: #fff">Forgot Password</a>
                                </div>
                            </div>
                        </form>
                        <h6 class="mb-4 text-center">Register here : <a href="#"> Sign Up</a></h6>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{asset('backend/assets-login/js/jquery.min.js')}}"></script>
    <script src="{{asset('backend/assets-login/js/popper.js')}}"></script>
    <script src="{{asset('backend/assets-login/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('backend/assets-login/js/main.js')}}"></script>

</body>

</html>