@extends('layouts.frontend.layout')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

@section('content')
 
 <!--================Home Banner Area =================-->
  <!-- breadcrumb start-->
  <section class="breadcrumb breadcrumb_bg">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="breadcrumb_iner">
            <div class="breadcrumb_iner_item">
              <h2>Producta Checkout</h2>
              <p>Home <span>-</span> Shop Single</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- breadcrumb start-->

  <!--================Checkout Area =================-->
  <section class="checkout_area padding_top">
    <div class="container">
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
          <div class="col-lg-6">
            <h3>Billing Details</h3>
            <form class="row contact_form" name="accountForm"  method="post" novalidate="novalidate">
            {{ csrf_field() }}
              <div class="col-md-6 form-group p_star">
              <label for="exampleInputPassword1">Name</label>
                <input type="text" class="form-control" id="billing_name" name="billing_name" 
                @if(!empty($userDetails['name'])) value="{{$userDetails['name']}}" @endif />
                
              </div>
             
              
              <div class="col-md-6 form-group p_star">
              <label for="exampleInputPassword1">Phone number</label>
                <input type="text" class="form-control" id="billing_number" name="billing_number" 
                @if(!empty($userDetails['phone_number'])) value="{{$userDetails['phone_number']}}" @endif/>
                
              </div>
              <div class="col-md-12 form-group p_star">
              <label for="exampleInputPassword1">email</label>
                <input type="text" class="form-control" id="email" name="email" 
                @if(!empty($userDetails['email'])) value="{{$userDetails['email']}}" @endif readonly />
                
              </div>
             
              <div class="col-md-12 form-group p_star">
              <label for="exampleInputPassword1">Address</label>
                <input type="text" class="form-control" id="billing_address" name="address"
                @if(!empty($userDetails['address'])) value="{{$userDetails['address']}}" @endif />
                
              </div>
              
              <div class="col-md-12 form-group p_star">
              <label for="exampleInputPassword1">Town/City</label>
                <input type="text" class="form-control" id="billing_city" name="city"
                @if(!empty($userDetails['city'])) value="{{$userDetails['city']}}" @endif />
                
              </div>
              <div class="col-md-12 form-group p_star">
              <label for="exampleInputPassword1">District</label>
                <input type="text" class="form-control" id="billing_district" name="district"
                @if(!empty($userDetails['district'])) value="{{$userDetails['district']}}" @endif/>
                
              </div>
              <div class="col-md-12 form-group">
              <label for="exampleInputPassword1">Postel code</label>
                <input type="text" class="form-control" id="billing_code" name="postcode" placeholder="Postcode/ZIP" 
                @if(!empty($userDetails['postcode'])) value="{{$userDetails['postcode']}}" @endif/>
                
              </div>
              <div class="col-md-12 form-group">
                
              </div>
              <div class="col-md-12 form-group">
              
                
              </div>
           
              <div class="col-md-12 form-group">
                
              </div>
              </div>
              <div class="col-lg-6">
              <div class="col-md-12 form-group">
                <div class="creat_account">
                  <h3>Shipping Details</h3>
                  <input type="checkbox" id="copyaddress" name="selector" class="copyaddress" />
                  <label for="copyaddress">Ship to a billing address?</label>
                </div>
                
              </div>
            
            
              <div class="col-md-6 form-group p_star">
              <label for="exampleInputPassword1">Shipping Name</label>
                <input type="text" class="form-control" id="shipping_name" name="shipping_name"
                @if(!empty($shippingDetails['name'])) value="{{$shippingDetails['name']}}" @endif />
                
              </div>
             
              
              <div class="col-md-4 form-group p_star">
              <label for="exampleInputPassword1">Phone number</label>
                <input type="text" class="form-control" id="phone_number" name="shipping_phone_number"
                @if(!empty($shippingDetails['phone_number'])) value="{{$shippingDetails['phone_number']}}"@endif />
                
              </div>
              
             
              <div class="col-md-12 form-group p_star">
              <label for="exampleInputPassword1">Shipping Address</label>
                <input type="text" class="form-control" id="shipping_address" name="shipping_address"
                @if(!empty($shippingDetails['address'])) value="{{$shippingDetails['address']}}" @endif  />
                
              </div>
              
              <div class="col-md-12 form-group p_star">
              <label for="exampleInputPassword1">Town/City</label>
                <input type="text" class="form-control" id="city" name="shipping_city" 
                @if(!empty($shippingDetails['city']))   value="{{$shippingDetails['city']}}" @endif />
                
              </div>
              <div class="col-md-12 form-group p_star">
              <label for="exampleInputPassword1">District</label>
                <input type="text" class="form-control" id="district" name="shipping_district"
                @if(!empty($shippingDetails['district']))  value="{{$shippingDetails['district']}}" @endif/>
                
              </div>
              <div class="col-md-12 form-group">
              <label for="exampleInputPassword1">Postel code</label>
                <input type="text" class="form-control" id="code" name="shipping_postcode"
                @if(!empty($shippingDetails['postcode'])) value="{{$shippingDetails['postcode']}}" @endif  />
                
              </div>
              <div class="col-md-12 form-group">
                
              </div>
             
           
              
              <div class="col-md-12 form-group">
                <div>
                <button type="submit" class="genric-btn primary circle" > Checkout </button>
                
                
                </div>
                
              </div>
              </div>
            </form>

          </div>
          
          
        </div>
      </div>
    </div>
  </section>
  <!--================End Checkout Area =================-->
  


    <script> console.log('Hi!');
    
    
    $("#copyaddress").click(function(){
       // console.log('Hoo!');
        if(this.checked){
          $("#shipping_name").val($("#billing_name").val());
          $("#phone_number").val($("#billing_number").val());
          $("#shipping_address").val($("#billing_address").val());
          $("#city").val($("#billing_city").val());
          $("#district").val($("#billing_district").val());
          $("#code").val($("#billing_code").val());
          

          
        }
        else{
            $("#shipping_name").val('');
          $("#phone_number").val('');
          $("#shipping_address").val('');
          $("#city").val('');
          $("#district").val('');
          $("#code").val('');

        }
});
    
     </script>

@endsection


