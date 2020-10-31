<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




//Route::get('/', function () {

 //   return view('welcome');

///});
Route::get('/', function () {

    return view('index');

});

Route::namespace('Front')->group(function()
{
    Route::get('/','IndexController@index');
   // Route::get('category','ProductsController@listing');
   Route::get('/product/{id}','ProductsController@product'); //front
   Route::get('/category/{id}','ProductsController@showCategory');
   Route::match((['get','post']),'/add-cart','ProductsController@addtocart')->middleware('auth'); //cart
   Route::match((['get','post']),'/cart','ProductsController@cart')->middleware('auth');
   Route::get('/cart/delete-product/{id?}','ProductsController@deleteCartProduct');//delete
   Route::get('/cart/update-quantity/{id?}/{quantity}','ProductsController@updateCartQuantity');// update quantity
   
   Route::post('/search','ProductsController@search');//search
   //checkout
   Route::match((['get','post']),'/checkout','ProductsController@checkout')->middleware('auth'); //checkout
   //order review
   Route::match((['get','post']),'/order-review','ProductsController@orderReview')->middleware('auth');

   

   //place order
   Route::match((['get','post']),'/place-order','ProductsController@placeOrder')->middleware('auth');

 
   //Thanks page

   Route::get('/thanks','ProductsController@thanks');

  
   //contact page
   Route::get('/contact','IndexController@contact'); //front

});



Route::get('/newlogin', function () {

    return view('newlogin');

});




Auth::routes(['verify' => true]);


//verificationToken
Route::get('/verifytoken','Auth\VerificationTokenController@verifytoken')->name('verifytoken');
Route::post('/postveriftoken','Auth\VerificationTokenController@postveriftoken')->name('postveriftoken');

//forgot password
Route::post('/postforgot','Auth\ForgotPasswordController@postforgot')->name('postforgot');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('is_admin');
Route::match((['get','post']),'/account','ProfileController@account')->middleware('auth');  //account
//updatepassword
Route::match((['get','post']),'/password','ProfileController@password')->middleware('auth'); 
//Route::get('/password','ProfileController@updatePassword');

Route::prefix('/admin')->namespace('Admin')->group(function(){

    Route::group(['middleware' =>['is_admin']],function(){
        
        //sections
         Route::get('sections','SectionController@sections');
         Route::get('delete-section/{id?}','SectionController@deleteSection');
         Route::match(['get','post'],'add-edit-section/{id?}','SectionController@addEditSection');

         //categories
         Route::get('categories','CategoryController@categories');
         Route::match(['get','post'],'add-edit-category/{id?}','CategoryController@addEditCategory');

         
         Route::get('delete-category/{id?}','CategoryController@deleteCategory');
         Route::get('delete-category-image/{id?}','CategoryController@deleteCategoryImage');

          
         //products
         Route::get('products','ProductsController@products');
        // Route::post('update-product-status','ProductsController@updateProductStatus');
        Route::get('delete-product/{id?}','ProductsController@deleteProduct');
        Route::match(['get','post'],'add-edit-product/{id?}','ProductsController@addEditProduct');
        Route::get('delete-product-image/{id?}','ProductsController@deleteProductImage');
        Route::post('search-products','ProductsController@searchPro');

        Route::match((['get','post']),'changePassword','ProductsController@password')->middleware('auth'); 
//Route::get('/password','ProfileController@updatePassword');

     

        
       
    });

   

});



    



?>


