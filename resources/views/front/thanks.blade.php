@extends('layouts.frontend.layout')

<section class="breadcrumb breadcrumb_bg">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="breadcrumb_iner">
            <div class="breadcrumb_iner_item">
              <h2>Order Confirmation</h2>
              <p>Home <span>-</span> Order Confirmation</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- breadcrumb start-->

  <!--================ confirmation part start =================-->
  <section class="confirmation_part padding_top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="confirmation_tittle">
            <span>Thank you. Your order has been received.</span>
          </div>
        </div>
        <div class="col-lg-6 col-lx-4">
          <div class="single_confirmation_details">
            <h4>order info</h4>
            <ul>
              <li>
                <p>order number</p><span>: {{Session::get('order_id')}}</span>
              </li>
              
              <li>
                <p>total</p><span>: Rs.{{Session::get('grand_total')}}</span>
              </li>
              
            </ul>
          </div>
        </div>
        
       
      </div>
       <br>
       <br>
      <button type="submit" class="btn_3" > Pay now </button>
    </div>
    
  </section>
  <!--================ confirmation part end =================-->

@section('content')

@endsection
<?php
    Session::forget('grand_total');
    Session::forget('order_id');
    
    
?>