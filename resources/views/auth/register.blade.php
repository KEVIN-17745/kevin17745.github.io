@extends('layouts.frontend.layout')

@section('content')

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>RegistrationForm</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="{{asset('/log/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css')}}">

		<!-- STYLE CSS -->
		<link rel="stylesheet" href="{{asset('/log/css/style.css')}}">
	</head>

	<body>

		<div class="wrapper" style="background-color: 	#FFEFD5 ;">
			<div class="inner">
				<div class="image-holder">
					<img src="{{asset('/log/images/fur7.jpg')}}" alt="">
				</div>
				<form method="POST" action="{{ route('register') }}">
                        @csrf

					<h3>{{ __('Register') }}</h3>
					<div class="form-wrapper">
						<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder=" Name"  autofocus>
						
						@error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
						
					</div>
					
					<div class="form-wrapper">
						<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address">
						<i class="zmdi zmdi-email"></i>
						@error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

					</div>

										<div class="form-wrapper">
						<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
						<i class="zmdi zmdi-lock"></i>

						@error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

					</div>

					<div class="form-wrapper">
						<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"placeholder="Confirm Password">
						<i class="zmdi zmdi-lock"></i>
					</div>
					
					<button>{{ __('Register') }}
						<i class="zmdi zmdi-arrow-right"></i>

					</button>
					<br>
					
					<div class="form-wrapper">
						<p>Already Have account?     <a href="{{ route('login') }}" style="text-decoration:none; color: black; font-size: 15px;">Login</a></p>
					</div>
				</form>
			</div>
		</div>
		
	</body>
</html>
@endsection
