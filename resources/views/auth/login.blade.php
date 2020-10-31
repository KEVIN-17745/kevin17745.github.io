
@extends('layouts.frontend.layout')

@section('content')
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="{{asset('/log/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css')}}">

		<!-- STYLE CSS style="background-image: url('log/images/bg3.jpg'); -->
		<link rel="stylesheet" href="{{asset('/log/css/style.css')}}">
	</head>

	<body>
	
		<div class="wrapper" style="background-color: 	#FFEFD5 ;">
		
			<div class="inner">
		 
				<div class="image-holder">
					<img src="{{asset('/log/images/fur7.jpg')}}" alt="">
				</div>
			 

				<form method="POST" action="{{ route('login') }}">
                        @csrf

					<h3>{{ __('Login') }}</h3>
					@if(Session::has('flash'))
                   <div class="alert alert-danger" role="alert">
                    {{Session::get('flash')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    
                  </button>
              </div>
             @endif
					
					<div class="form-wrapper">
						<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address">
						<i class="zmdi zmdi-email"></i>
					<!--	@error('email')
                                    <span class="alert alert-success" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  -->

					</div> 
										
										<div class="form-wrapper">
						<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
						<i class="zmdi zmdi-lock"></i>
					<!--	@error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror -->

					</div>
					<div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
									
										<button type="submit" style="font-size: 12px; font-family:Poppins-Regular;"> {{ __('Login') }}
						<i class="zmdi zmdi-arrow-right"></i>

					</button>
					@if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            
					<br>
					
					<div class="form-wrapper">
						<p style="font-size: 12px; font-family:Poppins-Regular;">Don't Have account?     <a href="{{ route('register') }}" style="text-decoration:none; color: black; font-size: 12px;font-family:Poppins-Regular;">Register</a></p>
					</div>

					
				</form>
			</div>
		</div>
		
	</body>
</html>
@endsection