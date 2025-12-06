 

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Al Masaood Auto | Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
 <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('fonts/ionicons.min.css') }}">
 
<link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">



</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <h1>Welcome to <br>
            AL Masaood Auto</h1>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <form method="POST" action="{{ route('loginauthenticate') }}">
                @csrf
                <div class="input-group mb-3">
                     <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text"> <span class="fas fa-envelope"></span> </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text"> <span class="fas fa-lock"></span> </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" align="right">
                        <button type="submit" class="btn btn-primary">Sign In</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <p class="mb-0 text-center"> <strong>Powered By</strong> <a href="#">Marka Communications</a> </p>
</div>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script> 
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> 

</body>
</html>
