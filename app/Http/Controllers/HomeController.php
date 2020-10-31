<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;

use App\Product;
use App\Category;
 
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $featuredItemCount = Product::where('is_featured','Yes')->count();
        
  $featuredItems = Product::where('is_featured','Yes')->get()->toArray();
 $featuredItemsChunk = array_chunk($featuredItems,8);
      

      //display category
       $categoryItemCount = Category::count(); 
      $categoryItems = Category::get()->toArray();

      $NonfeaturedItemCount = Product::where('is_featured','No')->count();
          
      $NonfeaturedItems = Product::where('is_featured','No')->get()->toArray();
     $NonfeaturedItemsChunk = array_chunk($NonfeaturedItems,8);
      

      

      return view('home')->with(compact('featuredItemsChunk','featuredItemCount','categoryItemCount','categoryItems','NonfeaturedItemCount','NonfeaturedItemsChunk'));

  }
/**
     * Show the application dashboard for admin.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        return view('adminHome');
    }
}
?>

