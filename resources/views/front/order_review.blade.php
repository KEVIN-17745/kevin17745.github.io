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
              <h2>order review</h2>
              <p>Home <span>-</span>order review</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- breadcrumb start-->

  <!--================Cart Area =================-->
 
  <section class="confirmation_part padding_top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
         <!-- <div class="confirmation_tittle">
            <span>Thank you. Your order has been received.</span>
          </div> -->
        </div>
        
        <div class="col-lg-6 col-lx-4">
          <div class="single_confirmation_details">
            <h4>Billing Address</h4>
            <ul>
            <li>
                <p>Name</p><span>: {{$userDetails['name']}}</span>
              </li>
            <li>
                <p>Phone number</p><span>: {{$userDetails['phone_number']}}</span>
              </li>
              <li>
                <p>Address</p><span>: {{$userDetails['address']}}</span>
              </li>
              <li>
                <p>city</p><span>: {{$userDetails['city']}}</span>
              </li>
              <li>
                <p>District</p><span>: {{$userDetails['district']}}</span>
              </li>
              <li>
                <p>postcode</p><span>: {{$userDetails['postcode']}}</span>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-6 col-lx-4">
          <div class="single_confirmation_details">
            <h4>shipping Address</h4>
            <ul>
            <li>
                <p>Name</p><span>: {{$shippingDetails['name']}}</span>
              </li>
            <li>
                <p>Phone number</p><span>: {{$shippingDetails['phone_number']}}</span>
              </li>
              <li>
                <p>Address</p><span>: {{$shippingDetails['address']}}</span>
              </li>
              <li>
                <p>city</p><span>: {{$shippingDetails['city']}}</span>
              </li>
              <li>
                <p>District</p><span>: {{$shippingDetails['district']}}</span>
              </li>
              <li>
                <p>postcode</p><span>: {{$shippingDetails['postcode']}}</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="order_details_iner">
            <h3>Order Details</h3>
            <table class="table table-borderless">
              <thead>
                <tr>
                  <th scope="col" colspan="2">Product</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Total</th>
                </tr>
              </thead>
              <tbody>
              <?php $grand_total = 0; ?>
            @foreach($userCart as $cart) 
                <tr>
                  <td colspan="2">
                  
                      <img src="{{asset('images/product_images/small/'.$cart->image)}}"  alt="" style="height:100px;" />
                    
                  <span>{{$cart->product_name}}</span>
                  </td>

                  <td>{{$cart->quantity}}</td>

                  <td> <span>Rs.{{$cart->product_price*$cart->quantity}}</span></td>
                </tr>
                <?php $grand_total = $grand_total + ($cart->product_price*$cart->quantity) ;?>
               @endforeach
                <tr>
                  <th colspan="3">Subtotal</th>
                  <th> <span>Rs.<?php echo $grand_total; ?></span></th>
                  
                </tr>
                <tr>
                  <th colspan="3">shipping</th>
                  <th><span>free</span></th>
                </tr>
              </tbody>
              <tfoot>
              <tr>
                  <th colspan="3">Total</th>
                  <th> Rs.<?php echo $grand_total; ?></th>
                  
                </tr>
              </tfoot>
            </table>
            <div class="col-lg-12">
            <form name="PaymentForm" id="paymentForm" action="{{url('/place-order')}}" method="post"> {{csrf_field()}}
            <input type="hidden"  name="grand_total" value="{{$grand_total}}">
            <div class="order_box">
              
              <h3>Check payments<h3>
              
              <div class="payment_item">
               
              <div class="payment_item active">
                <div >
                  <input type="radio"  name="payment" id="paypal" class="paypal"/>
                  <label for="paypal" style="font-size:14px;">Paypal </label>
                  <img src="{{asset('frontend/img/card.jpg')}}" alt="" />
                  <div class="check"></div>
                </div>
                
              </div>
            <button type="submit" class="btn_3" onclick="return selectPaymentMethod();"> Place order </button> 
             <!-- <a class="btn_3" href="{{url('/place-order')}}" onclick="return selectPaymentMethod();">place order</a> -->
            </div>
            </form>
          </div>
          </div>
          
        </div>
      </div>
    </div>
  </section>
      <script>
      function selectPaymentMethod(){
        if($('#paypal').is(':checked')){

        }
        else{
          alert("Please select paymanet method");
          return false;
        }
      }
      </script>      
              

@endsection