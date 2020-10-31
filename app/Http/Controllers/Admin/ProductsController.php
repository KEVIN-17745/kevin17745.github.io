<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Section;
use App\Order;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Response;

use Image;
use Session;


class ProductsController extends Controller
{
      public function products(){
           $products = Product::get();
           $products = Product::with(['category'=>function($query){
                 $query->select('id','category_name');
           },'section'=>function($query){
                 $query->select('id','name');
           }])->paginate(10);

          
           //$products = json_decode(json_encode($products));
           //echo"<pre>";print_r($products);die;

           return view('admin.products.products')->with(compact('products'));

      }

      public function updateProductStatus(Request $request){

            if($request->ajax()){
                  $data = $request->all();
                  if($data['status']=="Active"){
                        $status = 0;
                  }
                  else{
                        $status = 1;  
                  }

                  Product::where('id',$data['product_id'])->update(['status'=>$status]);
                  return response()->json(['sttaus'=>$status,'product_id'=>$data['product_id']]);
            }
      }

      public function deleteProduct($id){

            Product::where('id',$id)->delete();
    
            $message = 'Product deleted successfully';
            session::flash('success_message',$message);
            return redirect()->back(); 
      }
     

        public function addEditProduct(Request $request,$id=null){
        
            if($id==""){
                $title = "Add Product";
                $product = new Product;
                $productdata = array();
                $message = "Product added successfully";
                
            }
            else{
                $title = "Edit Product";
                $productdata = Product::find($id);
                $productdata = json_decode(json_encode($productdata),true);
                $product = Product::find($id);
                $message = "Product updated successfully";
                
            }

          if($request->isMethod('post')){
                $data = $request->all();
                //echo"<pre>";print_r($data);die;
          
   
          //Product validation  
          $rules =[
            'category_id' => 'required',
            'product_name' => 'required',
            'product_code' => 'required|regex:/^[\w-]*$/',
            'product_price' => 'required',
            'product_color' => 'required|regex:/^[\pL\s-]+$/u',
            'main_image' =>'mimes:jpeg,jpg,png,gif|max:10000',
              
            
        ];
        $customMessages =[
            'category_id.required' => 'Category is reqired',
            'product_name.required' => 'Product name is required',
            'product_name.regex' => ' valid product Name is reqired',
            'product_code.required' => 'Product code name is required',
            'product_code.regex' => ' valid product code Name is reqired',
            'product_price.required' => 'Product price is required',
            'product_price.regex' => ' valid product price is reqired',
            'product_color.required' => 'Product color is required',
            'product_color.regex' => ' valid product color is reqired',
            'main_image.image' => 'Valid category image is required', 
           
        ];

        $this->validate($request,$rules,$customMessages);  

        if(empty($data['is_featured'])){
              $is_featured = "No";
        }
        else{
            $is_featured = "Yes";
        }

        if(empty($data['main_image'])){
            $data['main_image'] = "";
      }
      if(empty($data['product_material'])){
            $data['product_material'] = "";
      }
       

      if(empty($data['description'])){
            $data['description'] = "";
      }
      if(empty($data['product_discount'])){
            $data['product_discount'] = 0;
      }
       //$product->main_image = $data['main_image'];
       
       /*if($request->hasFile('main_image'));
       {
            $image_file = $request->file('main_image');
            $img_extension = $image_file->getClientOriginalExtension();
            $img_filename = rand(111,99999).'.'.$img_extension;
            $image_file->move('images/product_images',$img_filename);
            $product->main_image = $img_filename;
            
       }*/
     
        
      
      
      
      //save product details in products table
        $categoryDetails = Category::find($data['category_id']);
        //echo"<pre>";print_r($categoryDetails);die;
       
        $product->section_id = $categoryDetails['section_id'];
        $product->category_id = $data['category_id'];
        $product->product_name = $data['product_name'];
        $product->product_code = $data['product_code'];
        $product->product_color = $data['product_color'];
      
       //upload product image
     if($request->hasFile('main_image')){
      $image_tmp = $request->file('main_image'); 
      if($image_tmp->isValid()){

         //upload image
         $image_name = $image_tmp->getClientOriginalName();
         $extension  = $image_tmp->getClientOriginalExtension();
         $imageName = $image_name.'-'.rand(111,99999).'.'.$extension;
         $large_image_path ='images/product_images/large/'.$imageName;
         $medium_image_path ='images/product_images/medium/'.$imageName;
         $small_image_path ='images/product_images/small/'.$imageName;

         Image::make($image_tmp)->save($large_image_path);
         Image::make($image_tmp)->resize(520,600)->save($medium_image_path);
         Image::make($image_tmp)->resize(520,600)->save($small_image_path);
         $product->main_image = $imageName;
      }
  }


        $product->description = $data['description'];
        $product->product_price = $data['product_price'];
        $product->product_discount = $data['product_discount'];
        $product->product_diamensions = $data['product_diamensions']; 
        $product->product_material = $data['product_material'];
        $product->is_featured = $is_featured;
        $product->status = 1;
        $product->save();
        session::flash('success_message',$message);
        return redirect('admin/products');


          
          
         




          }
         //section with categories
         $categories = Section::with('categories')->get();
         $categories = json_decode(json_encode($categories),true);
        // echo"<pre>";print_r($categories);die;
         

            return view('admin.products.add-edit-product')->with(compact('title','categories','productdata'));
                  
        }

        public function deleteProductImage($id){

            $productImage = Product::select('main_image')->where('id',$id)->first();
     
            $product_image_path ='images/product_images/large/';
            $product_image_path ='images/product_images/medium/';
            $product_image_path ='images/product_images/small/';
     
            //delete from  folder
            if(file_exists($product_image_path.$productImage->main_image)){
                unlink($product_image_path.$productImage->main_image);
            }
          //delete db
          Product::where('id',$id)->update(['main_image'=>'']);
            return redirect()->back()->with('flash_message_success','image deleted successfully');
         }

         public function searchPro(Request $request){
                
           // $search = $_GET['product'];
            if($request->isMethod('post')){
                 $data = $request->all();
              $search = $data['product'];
              
              //$productsDe = Product::where('product_name','like','%'.$search.'%')->get();
              //$productsDe = Product::where('product_price','like','%'.$search.'%')->get();
             $productsDe = Product::where('id','like','%'.$search.'%')->orwhere('product_code',$search)->orwhere('product_color',$search)->orwhere('category_id',$search) ->get();
             //$productsDe = Product::where('category_id','like','%'.$search.'%')->get();
            // $productsDe = Product::where('product_code','like','%'.$search.'%')->get();
             //$productsDe = Product::where('product_name','like','%'.$search.'%')->get();
             //$productsDe = Product::where('product_color','like','%'.$search.'%')->get();
              
             
             return view('admin.searchPro')->with(compact('productsDe')); 
            
                }
            } 
        
      
    public function password(Request $request){
     
   if($request->isMethod('post')){
       $data = $request->all();

       $old_pwd = User::where('id',$request->user()->id)->first();
       $current_pwd = $data['current_password'];

      

       if(Hash::check($current_pwd,$old_pwd->password)){
               
           $request->validate([
               'current_password' =>'required',
           'new_password' => ['required', 'string', 'min:6'],
          'password_confirmation' => 'required|same:new_password'
           ]);

           $new_pwd = bcrypt($data['new_password']);

           User::where('id',$request->user()->id)->update(['password' => $new_pwd]);
           return redirect()->back()->with('success_message','password changed successfully!!');
       }
       else{
           return redirect()->back()->with('error','Your current passoword does not match with provided password ');
       }
   }



       return view('admin.changePassword');
   }
         

        
}
