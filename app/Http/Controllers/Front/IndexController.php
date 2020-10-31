<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;

class IndexController extends Controller
{
    public function index(){
          $featuredItemCount = Product::where('is_featured','Yes')->count();
          
    $featuredItems = Product::where('is_featured','Yes')->get()->toArray();
   $featuredItemsChunk = array_chunk($featuredItems,8);
        

        //display category
         $categoryItemCount = Category::count(); 
        $categoryItems = Category::get()->toArray();

        //unfeatured products

        $NonfeaturedItemCount = Product::where('is_featured','No')->count();
          
    $NonfeaturedItems = Product::where('is_featured','No')->get()->toArray();
   $NonfeaturedItemsChunk = array_chunk($NonfeaturedItems,8);
        

        
        

        

        return view('index')->with(compact('featuredItemsChunk','featuredItemCount','categoryItemCount','categoryItems','NonfeaturedItemsChunk','NonfeaturedItemCount'));

    }

    public function contact(){

        return view('front.contact');

    }

}

