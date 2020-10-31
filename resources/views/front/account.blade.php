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
                   

         <div class="row align-items-center latest_product_inner">
                    
                        
         @if(Session::has('success_message'))
<div class="alert alert-success" role="alert">
   {{Session::get('success_message')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif 

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
    @endif
                        
                        
              
                                
          <div class="billing_details">
           <div class="row">
          <div class="col-lg-8">
            <h2>My account</h2>
            <form class="row contact_form" name="accountForm" action="{{url('/account')}}" method="post" novalidate="novalidate">
            {{ csrf_field() }}
              <div class="col-md-6 form-group p_star">
              <label for="exampleInputPassword1">Name</label>
                <input type="text" class="form-control" id="first" name="name" value="{{$userDetails['name']}}" />
                
              </div>
             
              
              <div class="col-md-6 form-group p_star">
              <label for="exampleInputPassword1">Phone number</label>
                <input type="text" class="form-control" id="number" name="phone_number" value="{{$userDetails['phone_number']}}"/>
                
              </div>
              <div class="col-md-12 form-group p_star">
              <label for="exampleInputPassword1">email</label>
                <input type="text" class="form-control" id="email" name="compemailany" value="{{$userDetails['email']}}" readonly/>
                
              </div>
             
              <div class="col-md-12 form-group p_star">
              <label for="exampleInputPassword1">Address</label>
                <input type="text" class="form-control" id="add1" name="address" value="{{$userDetails['address']}}" />
                
              </div>
              
              <div class="col-md-12 form-group p_star">
              <label for="exampleInputPassword1">Town/City</label>
                <input type="text" class="form-control" id="city" name="city" value="{{$userDetails['city']}}" />
                
              </div>
              <div class="col-md-12 form-group p_star">
              <label for="exampleInputPassword1">District</label>
                <input type="text" class="form-control" id="district" name="district" value="{{$userDetails['district']}}"/>
                
              </div>
              <div class="col-md-12 form-group">
              <label for="exampleInputPassword1">Postel code</label>
                <input type="text" class="form-control" id="zip" name="postcode" placeholder="Postcode/ZIP" value="{{$userDetails['postcode']}}"/>
                
              </div>
              <div class="col-md-12 form-group">
                
              </div>
              <div class="col-md-12 form-group">
              <div>
              <button type="submit" class="genric-btn primary circle" > update </button>
              
              </div>
                
              </div>
            </form>
            

          </div>
          
          
        </div>
      </div>
                                   

                                    
                        
                        
                        
                        
                        
                       
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

      

@endsection