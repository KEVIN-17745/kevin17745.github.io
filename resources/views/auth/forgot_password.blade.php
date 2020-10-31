
@extends('layouts.frontend.layout')

@section('content')
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Forgot password</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="{{asset('/log/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css')}}">

		<!-- STYLE CSS -->
		<link rel="stylesheet" href="{{asset('/log/css/style.css')}}">
	</head>

	<body>
	
		<div class="wrapper" style="background-image: url('log/images/bg3.jpg');">
		
			<div class="inner">
		 
				<div class="image-holder">
					<img src="{{asset('/log/images/fur7.jpg')}}" alt="">
				</div>
			 

				
					
					

             <form method="POST" id="forgotPasswordForm" name="forgotPasswordForm"  action="{{ url('/forgeot-password') }}">
                        {{csrf_field()}}
                        @if(Session::has('flash'))
                   <div class="alert alert-danger" role="alert">
                    {{Session::get('flash')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    
                  </button>
              </div>
             @endif
					
					<div class="form-wrapper">
						<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"  placeholder="Email Address">
						<i class="zmdi zmdi-email"></i>
					

					</div> 
										
									
                    <button type="submit" style="font-size: 12px; font-family:Poppins-Regular;"> submit
						<i class="zmdi zmdi-arrow-right"></i>

					</button>
				
					
					
				
				</form>
			</div>
		</div>
		
	</body>
</html>
@endsection