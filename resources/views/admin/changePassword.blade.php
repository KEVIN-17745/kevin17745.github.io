@extends('adminlte::page')

@section('title', 'change password')

@section('content_header')   

                    
<a href="{{url('admin/changePassword')}}" style="color:black;" > <h1>Change Password</h1> </a>


@stop

@section('content')

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
                <button type="submit" class="btn btn-warning"> change Password </button>
                </div>
              </form>
                                   

                                    
                        
                        
                        
                        
                        
                       
                        
                    </div>

@stop