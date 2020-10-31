@extends('layouts.frontend.layout')


@section('content')
<?php
 use App\Section;
 $sections = Section::sections();
 //echo"<pre>";print_r($sections);die;

 ?>

    <!--================Home Banner Area =================-->
    <!-- breadcrumb start-->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                        <?php $categoryName =DB::table('categories')->select('category_name')->where('id',$id_)->get();?>
                            
                            @foreach($categoryName as $cate) 
                            
                            <h2>{{$cate->category_name}}</h2>
                            <p>Home <span>-</span> Shop Category</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->

    <!--================Side bar =================-->
    <section class="cat_product_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="left_sidebar_area">
                        <aside class="left_widgets p_filter_widgets">
                            <div class="l_w_title">
                                <h3>Browse Categories</h3>
                            </div>
                            @foreach($sections as $section)
                            <div class="widgets_inner">
                             <h4>{{ $section['name']}}</h4>
                                <ul class="list">
                                @foreach($section['categories'] as $category)
                                    <li>
                                        <a href="{{'/category/'.$category['id']}}">{{$category['category_name']}}</a>
                                        
                                    </li>
                                    @endforeach
                                    
                                </ul>
                            </div>
                            @endforeach

                            
                           
                        </aside>

                        

                        

                        
                    </div>
                </div>
                <div class="col-lg-9">
                   

                    <div class="row align-items-center latest_product_inner">
                    @foreach($category_products as $item)
                        <div class="col-lg-4 col-sm-6">

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
                                <a href="{{'/product/'.$item['id']}}" class="add_cart"> View product</a>
                                        </div>
                                    </div>

                                    
                        </div>
                        
                        @endforeach
                        
                        
                       
                        <div class="col-lg-12">
                            <div class="pageination">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Previous">
                                                <i class="ti-angle-double-left"></i>
                                            </a>
                                        </li>
                                        {{ $category_products->links() }}
                                            <a class="page-link" href="#" aria-label="Next">
                                                <i class="ti-angle-double-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Category Product Area =================-->

    <!-- product_list part start-->
    <section class="product_list best_seller section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section_tittle text-center">
                        <h2>Featured products <span>shop</span></h2>
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

@endsection