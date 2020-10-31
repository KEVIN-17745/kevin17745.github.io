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
              <h2>Cart Products</h2>
              <p>Home <span>-</span>Cart Products</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- breadcrumb start-->

  <!--================Cart Area =================-->
 
  <section class="cart_area padding_top">
  
    <div class="container">
      <div class="cart_inner">
        <div class="table-responsive">
        @if(Session::has('success_message'))
<div class="alert alert-success" role="alert">
   {{Session::get('success_message')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif 
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Product</th>
                <th scope="col">Product Code</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
            <?php $total_amount = 0; ?>
            @foreach($userCart as $cart)
              <tr>
                <td>
                  <div class="media">
                    <div class="d-flex">
                      <img src="{{asset('images/product_images/small/'.$cart->main_image)}}"  alt="" style="height:100px;" />
                    </div>
                    <div class="media-body">
                      <p>{{$cart->product_name}}</p>
                    </div>
                  </div>
                </td>
                <td>
                <p>{{$cart->product_code}}</p>
                </td>
                <td>
                  <h5>Rs.{{$cart->product_price}}</h5>
                </td>
                <td>
                  <div class="product_count">
                  @if($cart->quantity>1)
                  
                    <span ><a href="{{url('/cart/update-quantity/'.$cart->id.'/-1')}}" class="input-number-decrement" > <i class="ti-angle-down"></i> <a></span>
                    @endif
                    <input class="input-number" type="text" name="quantity" value="{{$cart->quantity}}" >
                    <span ><a href="{{url('/cart/update-quantity/'.$cart->id.'/1')}}" class="input-number-increment" > <i class="ti-angle-up"></i> </a></span>
                   
                  </div>
                </td>
                <td>
                  <h5>Rs.{{$cart->product_price*$cart->quantity}}</h5>
                </td>
                <td>
                <button type="submit"  class="genric-btn danger-border circle"><a href="{{ url('/cart/delete-product/'.$cart->id)}}" style ="color:Red;">
              Remove  </a></button>
              
                </td>
              </tr>
              <?php $total_amount = $total_amount + ($cart->product_price*$cart->quantity) ;?>
              @endforeach
           <!--   <tr class="bottom_button">
                <td>
                  <a class="btn_1" href="#">Update Cart</a>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                  <div class="cupon_text float-right">
                    <a class="btn_1" href="#">Close Coupon</a>
                  </div>
                </td>
              </tr> -->
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                  <h5>Subtotal</h5>
                </td>
                <td>
                  <h5>Rs.<?php echo $total_amount; ?></h5>
                </td>
              </tr>
          <!--    <tr class="shipping_area">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                  <h5>Shipping</h5>
                </td>
                <td>
                  <div class="shipping_box">
                    <ul class="list">
                      <li>
                        <a href="#">Flat Rate: $5.00</a>
                      </li>
                      <li>
                        <a href="#">Free Shipping</a>
                      </li>
                      <li>
                        <a href="#">Flat Rate: $10.00</a>
                      </li>
                      <li class="active">
                        <a href="#">Local Delivery: $2.00</a>
                      </li>
                    </ul>
                    <h6>
                      Calculate Shipping
                      <i class="fa fa-caret-down" aria-hidden="true"></i>
                    </h6>
                    <select class="shipping_select">
                      <option value="1">Bangladesh</option>
                      <option value="2">India</option>
                      <option value="4">Pakistan</option>
                    </select>
                    <select class="shipping_select section_bg">
                      <option value="1">Select a State</option>
                      <option value="2">Select a State</option>
                      <option value="4">Select a State</option>
                    </select>
                    <input type="text" placeholder="Postcode/Zipcode" />
                    <a class="btn_1" href="#">Update Details</a>
                  </div>
                </td>
              </tr> -->
            </tbody>
          </table>
          <div class="checkout_btn_inner float-right">
          <a class="btn_1" href="{{ url('/') }}">Continue Shopping</a>
            <a class="btn_1 checkout_btn_1" href="{{url('/checkout')}}">Proceed to checkout</a>
          </div>
        </div>
      </div>
  </section>
  <!--================End Cart Area =================-->

@endsection