@extends('layouts.frontend.layout')


@section('content')

 <!--================Home Banner Area =================-->
    <!-- breadcrumb start-->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                        
                            
                            
                            
                            <h2>profile</h2>
                            <p>Home  </p>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->
    <!--================Home Banner Area =================-->
   

    <section class="cat_product_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="left_sidebar_area">
                        <aside class="left_widgets p_filter_widgets">
                            <div class="l_w_title">
                                <h3>Profile</h3>
                            </div>
                            
                            <div class="widgets_inner">
                             <h4></h4>
                                <ul class="list">
                                
                                    
                                <li>
                                        <a href="{{url('/password')}}">change password</a>
                                        
                                    </li>
                                    <li>
                                        <a href="{{url('/account')}}">my account</a>
                                        
                                    </li>
                                    
                                    
                                </ul>
                            </div>
                            

                            
                           
                        </aside>

                        

                        

                        
                    </div>
                </div>
                <div class="col-lg-9">
                @if(Session::has('error'))
<div class="alert alert-danger" role="alert">
   {{Session::get('error')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger" >
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
    @endif

    @if(Session::has('success_message'))
<div class="alert alert-success" role="alert">
   {{Session::get('success_message')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

                    <div class="row align-items-center latest_product_inner">
                    
                        

                        
                        <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Change password</h3>
              </div>
                                
             <form role="form" action="{{ url('/password')}}" method="POST"> {{ @csrf_field()}}
            
                <div class="card-body">
                <div class="form-wrapper">
                
						

					</div>

										<div class="form-wrapper">
                                        <label for="exampleInputPassword1">current password</label>
						<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="current_password"  id="current_password" class="current_password">
						<i class="zmdi zmdi-lock"></i>

						

					</div>
                  
                    <div class="form-wrapper">
                                        <label for="exampleInputPassword1">new password</label>
						<input id="new_password" type="password" class="form-control @error('password') is-invalid @enderror" name="new_password" >
						<i class="zmdi zmdi-lock"></i>

						

					</div>

                    <div class="form-wrapper">
                                        <label for="exampleInputPassword1">confirm password</label>
						<input id="new_password" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" >
						<i class="zmdi zmdi-lock"></i>

						

					</div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                <button type="submit" class="genric-btn primary circle"> change Password </button>
                </div>
              </form>
                                   

                                    
                        
                        
                        
                        
                        
                       
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script> console.log('Hi!');

   
    </script>
      

@endsection