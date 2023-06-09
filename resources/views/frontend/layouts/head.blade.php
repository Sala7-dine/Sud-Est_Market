<meta charset="UTF-8">
<meta name="description" content="">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

<!-- Title  -->
<title>Sud-Est Market | Online Shopping </title>

<!-- Favicon  -->
<link rel="icon" href="img/core-img/favicon.ico">

<link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/classy-nav.min.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/nice-select.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/animate.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/jquery-ui.min.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/magnific-popup.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/fontawesome-all.min.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/icofont.min.css')}}">


<!-- Style CSS -->
<link rel="stylesheet" href="{{asset('frontend/assets/css/style.css')}}">


<style>

.auth-body  {
  display: flex;
  justify-content: center;
  align-items: center;
  font-family: "Jost", sans-serif;
}
.auth-body .main {
  width: 400px;
  height: 460px;
  padding: 0;
  margin: auto;
  overflow: hidden;
  border-radius: 10px;
}
#chk {
  display: none;
}
.auth-body .signup {
  position: relative;
  width: 100%;
  height: 100%;
}
.auth-body label {
  color: #fff;
  font-size: 2.3em;
  justify-content: center;
  display: flex;
  margin: 20px;
  font-weight: bold;
  cursor: pointer;
  transition: 0.5s ease-in-out;
}

.auth-body button {
  height: 40px;
  transition: 0.2s ease-in;
  cursor: pointer;
}
.auth-body .login {
  height: 460px;
  margin-top: -40px;
  background: #eee;
  border-radius: 60% / 10%;
  transform: translateY(-50px);
  transition: 0.5s ease-in-out;
}
.auth-body .login label {
  color: #573b8a;
  transform: scale(0.8);
}

#chk:checked ~ .login {
  transform: translateY(-380px);
}
#chk:checked ~ .login label {
  transform: scale(1);
}
#chk:checked ~ .signup label {
  transform: scale(0.8);
}
</style>


@yield("styles")