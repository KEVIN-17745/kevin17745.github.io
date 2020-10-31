@extends('layouts.frontend.layout')

@section('content')

<!-- banner part start-->
<section class="banner_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="banner_slider owl-carousel">
                        <div class="single_banner_slider">
                        <div class="row">
                                <div class="col-lg-5 col-md-8">
                                    <div class="banner_text">
                                        <div class="banner_text_iner">
                                            <h1>Bring the modern look to your Home</h1>
                                            <p></p>
                                            <a href="{{url('/')}}" class="btn_2">buy now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="banner_img d-none d-lg-block">
                                    <img src="{{asset('frontend/img/f1.png')}}" alt="">
                                </div>
                            </div>
                        </div>
                        
                        <!-- <div class="single_banner_slider">
                            <div class="row">
                                <div class="col-lg-5 col-md-8">
                                    <div class="banner_text">
                                        <div class="banner_text_iner">
                                            <h1>Cloth $ Wood Sofa</h1>
                                            <p>Incididunt ut labore et dolore magna aliqua quis ipsum
                                                suspendisse ultrices gravida. Risus commodo viverra</p>
                                            <a href="#" class="btn_2">buy now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="banner_img d-none d-lg-block">
                                    <img src="img/banner_img.png" alt="">
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <div class="slider-counter"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner part start-->

    <!-- feature_part start-->
    <section class="feature_part padding_top">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section_tittle text-center">
                        <h2>Featured Category</h2>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-between">
            @foreach($categoryItems as $item)
                
                <div class=" col-sm-4">
                
                    <div class="single_feature_post_text">
                        <p>Premium Quality</p>
                        <h3>{{$item['category_name']}}</h3>
                        <a href="{{'/category/'.$item['id']}}" class="feature_btn">EXPLORE NOW <i class="fas fa-play"></i></a>
                        
                        <?php $category_image_path = 'images/category_images/'.$item['category_image']; ?>
                            @if(!empty($item['category_image']) && file_exists($category_image_path))
                        
                            <img src="{{asset('images/category_images/'.$item['category_image'])}}" style=" height:290px;" alt="">
                            
                            @else
                            <img src="{{asset('images/category_images/no_image.png')}}" style=" height:290px;" alt="">
                            @endif
                            
                    </div>
                    
                </div>
                
                @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- upcoming_event part start-->

    <!-- product_list start-->
    <section class="product_list section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section_tittle text-center">
                        <h2>Featured product<span>shop</span></h2>
                    </div>
                </div>
            </div>
            
            <div class="row">
            
                <div class="col-lg-12">
                
                    <div class="product_list_slider owl-carousel">
                    
                        <div class="single_product_list_slider">
                        @foreach($featuredItemsChunk as $key => $featuredItems )
                            <div class="row align-items-center justify-content-between">
                            @foreach($featuredItems as $item)
                                <div class="col-lg-3 col-sm-6">

                               
                                    <div class="single_product_item">
                                    <?php $product_image_path = 'images/product_images/small/'.$item['main_image']; ?>
                            @if(!empty($item['main_image']) && file_exists($product_image_path))
                        
                            <a  href="{{'/product/'.$item['id']}}">   <img src="{{asset('images/product_images/small/'.$item['main_image'])}}" alt=""> </a>

                            @else
                            <a  href="{{'/product/'.$item['id']}}">    <img src="{{asset('images/product_images/small/no_image.png')}}" alt=""> </a>
                            @endif
                                        <div class="single_product_text">
                                        <h4>{{$item['product_name']}} </h4>
                                <h3>Rs.{{$item['product_price']}}</h3> 
                                
                                            <a href="{{'product/'.$item['id']}}" class="add_cart"> View product</a>
                                            

                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                
                                
        
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                    
                </div>
                
            </div>
            
        </div>
    </section>
    <!-- product_list part start-->

  

    <!-- product_list part start-->
    <section class="product_list best_seller section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section_tittle text-center">
                        <h2>Best Sellers <span>shop</span></h2>
                    </div>
                </div>
            </div>
            
            <div class="row align-items-center justify-content-between">
            
                <div class="col-lg-12">
                
               
                    <div class="best_product_slider owl-carousel">
                    @foreach($featuredItemsChunk as $key => $featuredItems )
                    @foreach($featuredItems as $item)
                        <div class="single_product_item"> 
                        <?php $product_image_path = 'images/product_images/small/'.$item['main_image']; ?>
                            @if(!empty($item['main_image']) && file_exists($product_image_path))
                        
                            <img src="{{asset('images/product_images/small/'.$item['main_image'])}}" alt="">

                            @else
                            <img src="{{asset('images/product_images/small/no_image.png')}}" alt="">
                            @endif
                            
                            <div class="single_product_text">
                                <h4>{{$item['product_name']}}</h4>
                                <h3>Rs.{{$item['product_price']}}</h3>
                                <h4> <a  href="{{'product/'.$item['id']}}">View product </a></h4>
                            </div>
                            
                        </div>
                       
                        @endforeach
                        
                        @endforeach
                        
                    </div>
                   
                    
                </div>
                
            </div>
            
        </div>
    </section>
    <!-- product_list part end-->

     <!-- product_list part start-->
     <section class="product_list best_seller section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section_tittle text-center">
                        <h2>Other collections <span>shop</span></h2>
                    </div>
                </div>
            </div>
            
            <div class="row align-items-center justify-content-between">
            
                <div class="col-lg-12">
                
               
                    <div class="best_product_slider owl-carousel">
                    @foreach($NonfeaturedItemsChunk as $key => $NonfeaturedItems )
                    @foreach($NonfeaturedItems as $item)
                        <div class="single_product_item"> 
                        <?php $product_image_path = 'images/product_images/small/'.$item['main_image']; ?>
                            @if(!empty($item['main_image']) && file_exists($product_image_path))
                        
                            <img src="{{asset('images/product_images/small/'.$item['main_image'])}}" alt="">

                            @else
                            <img src="{{asset('images/product_images/small/no_image.png')}}" alt="">
                            @endif
                            
                            <div class="single_product_text">
                                <h4>{{$item['product_name']}}</h4>
                                <h3>Rs.{{$item['product_price']}}</h3>
                                <h4> <a  href="{{'product/'.$item['id']}}">View product </a></h4>
                            </div>
                            
                        </div>
                       
                        @endforeach
                        
                        @endforeach
                        
                    </div>
                   
                    
                </div>
                
            </div>
            
        </div>
    </section>
    <!-- product_list part end-->
   

    

   
    
    @endsection
 