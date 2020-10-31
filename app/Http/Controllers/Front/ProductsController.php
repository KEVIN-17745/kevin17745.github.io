<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Section;
use App\User;
use App\DeliveryAddress;
use App\Order;
use App\OrdersProduct;
use DB;
use Session;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
   

    public function product($id = null){

        //get product details

        $productDetails = Product::where('id',$id)->first();
       // $categories = Category::where('id',$id)->first();

       //show featured product
       $featuredItemCount = Product::where('is_featured','Yes')->count();
        
       $featuredItems = Product::where('is_featured','Yes')->get()->toArray();
      $featuredItemsChunk = array_chunk($featuredItems,8);

        return view('front.detail')->with(compact('productDetails','featuredItemsChunk','featuredItemCount'));
     }

     public function showCategory($id){

        //get product details
       $category_products = Product::where('category_id',$id)->paginate(6);
       $id_ = $id;

       $categName = Category::get();

       //show featured products
       $featuredItemCount = Product::where('is_featured','Yes')->count();
        
       $featuredItems = Product::where('is_featured','Yes')->get()->toArray();
      $featuredItemsChunk = array_chunk($featuredItems,8);

       return view('front.category_products')->with(compact('category_products','id_','categName','featuredItemsChunk','featuredItemCount'));
        
     }
 


/// cart


      public function addtocart(Request $request){
      
        $data = $request->all();
       // echo"<pre";print_r($data);die;
      

       if(empty($data['user_email'])){
         $data['user_email'] = '';
       }
       
       $session_id = Session::get('session_id');
      if(empty($session_id)){
             $session_id = Str::random(20);
             Session::put('session_id',$session_id);    
     }


     $countProducts = DB::table('cart')->where(['product_id'=>$data['product_id'],
     'product_name'=>$data['product_name'],
     'product_code'=>$data['product_code'],
     'product_color'=>$data['product_color'],
     'product_price'=>$data['product_price'],
     'quantity'=>$data['quantity'],
     'user_email'=>$data['user_email'],
     'session_id'=>$session_id])->count();

     if($countProducts > 0){
      return redirect()->back()->with('success_message','Product already exist in Cart!!');
     }

else{






       DB::table('cart')->insert(['product_id'=>$data['product_id'],
       'product_name'=>$data['product_name'],
       'product_code'=>$data['product_code'],
       'product_color'=>$data['product_color'],
       'product_price'=>$data['product_price'],
       'quantity'=>$data['quantity'],
       'user_email'=>$data['user_email'],
       'session_id'=>$session_id]);  }
         
       session::flash('success_message','Product added to cart successfully');

         return redirect('cart');
      }

   public function cart(Request $request){
     
    $user_email = $request->user()->email;
    
     
    $session_id = Session::get('session_id');
    DB::table('cart')->where(['session_id'=>$session_id])->update(['user_email'=>$user_email]);
    $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();
     
    //DB::table('cart')->where(['session_id'=>$session_id])->update(['user_email'=>$user_email]);
    //$userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();
   // $session_id =Session::get('session_id');
    //$userCart = DB::table('cart')->where(['session_id' =>$session_id])->get();
     
    //get image
     foreach($userCart as $key => $product){
       $productDetails = Product::where('id',$product->product_id)->first();
       $userCart[$key]->main_image = $productDetails->main_image;
     }

   // echo"<pre>"; print_r($userCart);



     return view('front.cart')->with(compact('userCart'));   

   }

    public function deleteCartProduct($id = null){

      DB::table('cart')->where('id',$id)->delete();

      return redirect('cart')->with('success_message','Product has beed deleted successfully');
    }
   
   public function updateCartQuantity($id=null,$quantity=null){

      DB::table('cart')->where('id',$id)->increment('quantity',$quantity);

      return redirect('cart')->with('success_message','Product quantity updated successfully');
   }
    
   //search function
   public function search(Request $request){
       
   // $search_text = $_GET['searchData'];
   if($request->isMethod('post')){
      $data = $request->all();
      $search_text = $data['searchData'];
      
     $products = Product::where('product_name','like','%'.$search_text.'%')->orwhere('product_code',$search_text)->orwhere('product_color',$search_text)->get();
     //$products = Product::where('product_code','like','%'.$search_text.'%')->get();
     //$productsDe = Product::where('id','like','%'.$search.'%')->orwhere('product_code',$search) ->get();
    // $products = Product::where('id','like','%'.$search_text.'%')->get();
      
     $featuredItemCount = Product::where('is_featured','Yes')->count();
        
     $featuredItems = Product::where('is_featured','Yes')->get()->toArray();
    $featuredItemsChunk = array_chunk($featuredItems,8);
      

    

     return view('front.search')->with(compact('products','featuredItemsChunk','featuredItemCount')); 
    
    } 
   }
    
   //checkout
   public function checkout(Request $request){
     
    $user_id = $request->user()->id;
    $user_email = $request->user()->email;
    $userDetails = User::find($user_id);

    $shippingDetails = array();

    //check if shipping address exists
    $shippingCount = DeliveryAddress::where('user_id',$user_id)->count();
    
   if($shippingCount>0){
      $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
    }
      //update cart table with user email
      $session_id = Session::get('session_id');
      //DB::table('cart')->where(['session_id'=>$session_id])->update(['user_email'=>$user_email]);
      
    if($request->isMethod('post')){

      $data = $request->all();
     // echo "<pre>";print_r($data);die;
     $rules =[
        
      'billing_name' => 'required',
      'billing_number' => 'required|digits:10|numeric',
      'email' => 'required|email',
      'city' => 'required',
      'district' => 'required',
      'postcode' => 'required|regex:/^[\w-]*$/',
      'shipping_name' => 'required',
      'shipping_phone_number' => 'required|digits:10|numeric',
      'shipping_address' => 'required',
      'shipping_city' => 'required',
      'shipping_district' => 'required',
      'shipping_postcode' => 'required|regex:/^[\w-]*$/',
      'address' => 'required',  
      
  ];
  $customMessages =[
      'address.required' => 'address is reqired',
      'shipping_address.required' => ' shipping address is required',
      'billing_name.required' => ' billing_name is required',
      'billing_name.regex' => ' valid billing_name is reqired',
      'shipping_name.required' => ' shipping name is required',
      'shipping_name.regex' => ' valid shipping name is reqired',
      'postcode.required' => 'postcode name is required',
      'postcode.regex' => ' valid postcode code Name is reqired',
      'shipping_postcode.required' => 'shipping postcode is required',
      'shipping_postcode.regex' => ' valid shipping postcode is reqired',
      'city.required' => ' city is required',
      'city.regex' => ' valid city is reqired',
      'shipping_city.required' => ' shipping city is required',
      'shipping_city.regex' => ' valid shipping city is reqired',
      'district.required' => ' district is required',
      'district.regex' => ' valid district is reqired',
      'shipping_district.required' => ' shipping district is required',
      'shipping_district.regex' => ' valid shipping district is reqired',
      'billing_number.required' => ' phone number is required',
      'billing_number.min' => ' valid phone_number is reqired',
      'shipping_phone_number.required' => ' phone number is required',
      'shipping_phone_number.min' => ' valid phone_number is reqired',
      'email.required' => ' email is required',
      'email.regex' => ' valid email is required',

      
     
  ];

   $this->validate($request,$rules,$customMessages);

     

     //update user details
    User::where('id',$user_id)->update(['name'=>$data['billing_name'] , 'address'=>$data['address'] ,'city'=> $data['city'],
    'district'=>$data['district'], 'postcode'=>$data['postcode'],'phone_number'=>$data['billing_number']]);
    

    if($shippingCount>0){
      //update shipping address
     DeliveryAddress::where('user_id',$user_id)->update(['name'=>$data['shipping_name'] , 'address'=>$data['shipping_address'] ,'city'=> $data['shipping_city'],
     'district'=>$data['shipping_district'], 'postcode'=>$data['shipping_postcode'],'phone_number'=>$data['shipping_phone_number']]);
     
    }
    else{
        // Add new shipping address
      $shipping = new DeliveryAddress;
      $shipping->user_id = $user_id;
      $shipping->user_email = $user_email;
      $shipping->name = $data['shipping_name'];
      $shipping->address = $data['shipping_address'];
      $shipping->city = $data['shipping_city'];
      $shipping->district = $data['shipping_district'];
      $shipping->postcode = $data['shipping_postcode'];
      $shipping->phone_number = $data['shipping_phone_number'];

      $shipping->save();

    } 
    return redirect()->to('/order-review'); 
  }

    return view('front.checkout')->with(compact('userDetails','shippingDetails'));
   }
   
   //order review
  
   public function orderReview(Request $request){
    $user_id = $request->user()->id;
    $user_email = $request->user()->email;
    $userDetails = User::where('id',$user_id)->first();
    $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();

    $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();

    foreach($userCart as $key =>$product){
      $productDetails = Product::where('id',$product->product_id)->first();
      $userCart[$key]->image = $productDetails->main_image;
    }
    

    // echo "<pre>";print_r($userCart);die; 


    return view('front.order_review')->with(compact('userDetails','shippingDetails','userCart'));
   }

   //for direct order
   

   public function placeOrder(Request $request){

      if($request->isMethod('post')){

        $data = $request->all();
        $user_id = $request->user()->id;
      $user_email = $request->user()->email;

        //get Shipping  address of user

        $shippingDetails = DeliveryAddress::where(['user_email'=>$user_email])->first();
       
//echo "<pre>"; print_r($shippingDetails); die;
     
        $order = new Order;
        $order->user_id = $user_id;
        $order->user_email = $user_email;
        $order->name = $shippingDetails->name;
        $order->address = $shippingDetails->address;
        $order->city = $shippingDetails->city;
        $order->district = $shippingDetails->district;
        $order->postcode = $shippingDetails->postcode;
        $order->phone_number = $shippingDetails->phone_number;
        $order->shipping_charges = 0.0;
        $order->discount = 0.0;
        $order->order_status = "New";
        $order->grand_total = $data['grand_total'];
        $order->save();  

        $order_id = DB::getPdo()->lastInsertId(); //to save order id

        $cartProducts = DB::table('cart')->where(['user_email'=>$user_email])->get();
        foreach($cartProducts as $pro){
          $cartPro = new OrdersProduct;
          $cartPro->order_id = $order_id;
          $cartPro->user_id = $user_id;
          $cartPro->product_id = $pro->product_id;
          $cartPro->product_code = $pro->product_code;
          $cartPro->product_name = $pro->product_name;
          $cartPro->product_color = $pro->product_color;
          $cartPro->product_price = $pro->product_price;
          $cartPro->product_qty = $pro->quantity;
          $cartPro->save();

        }

         Session::put('order_id',$order_id);
         Session::put('grand_total',$data['grand_total']);
         

         return redirect('/thanks');


      }
        
   }
    
   public function thanks(Request $request){

    return view('front.thanks');
   }

}
