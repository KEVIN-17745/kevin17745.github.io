 <?php
 use App\Section;
 $sections = Section::sections();
 //echo"<pre>";print_r($sections);die;
 
 ?>
 
 
 <!--::header part start::-->
 <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="{{ url('/') }}"> <img src="{{asset('frontend/img/logo6.png')}}" alt="logo" > </a>
                        

                        <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                                </li>
                                @foreach($sections as $section)
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_1"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ $section['name']}}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown_1">
                                    @foreach($section['categories'] as $category)
                                        <a class="dropdown-item" href="{{'/category/'.$category['id']}}">{{$category['category_name']}}</a>
                                        
                                        @endforeach
                                    </div>
                                </li>
                                @endforeach
                                
                             
                                
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/contact')}}">Contact</a>
                                </li>

                                
                            </ul>
                        </div>
                        <div class="hearer_icon d-flex" >
 
                                 <!-- Search form -->
                           <form class="form-inline d-flex justify-content-center md-form form-sm"action="{{ url('/search') }}" method="post"> @csrf 
                               <input class="form-control form-control-sm mr-3 w-75" type="text" placeholder="Search"
                                    aria-label="Search"name="searchData">
                               <i class="fas fa-search" aria-hidden="true"></i>

                                </form> 
            
                     <!--  <form action="{{ url('/search') }}" type="get"class="form-inline d-flex justify-content-center md-form form-sm"> {{csrf_field()}}
                          <input type="text" name="searchData">
                          <a id="search_1"  > <img src="{{asset('frontend/img/search.png')}}"></a> 
                              </form>  -->
                              <!-- Search form -->
                            <div class="dropdown cart">
                                <a class="dropdown-toggle"  id="navbarDropdown3" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <a href="{{url('cart')}}">  <img src="{{asset('frontend/img/cart.png')}}">  </a>
                                </a>
                         
                            </div>
                            <!-- login register-->
                             <div class="dropdown cart" >
                                <a class="dropdown-toggle" href="#" id="navbarDropdown3" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   
                                </a>
                                  <img src="{{asset('frontend/img/user.png')}}" >
                                  <div class="dropdown-menu" aria-labelledby="navbarDropdown_2">
                                   <!-- Authentication Links -->
                                   @guest
                                        <a class="dropdown-item" href="{{ route('login') }}" >login</a>

                                        @if (Route::has('register'))

                                        <a class="dropdown-item" href="{{ route('register') }}">Sign Up</a>
                                        
                                        @endif
                                        
                                    </div>
                                        
                            </div>
                              @else
                                    
                        </div>
                        <!--logout-->
                        {{ Auth::user()->name }}
                        <ul class="navbar-nav">
                                <li class="nav-item">
                                
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown_1">
                                <a class="dropdown-item" href=""> my orders
                                       
                                    </a>
                                <a class="dropdown-item" href="{{url('/account')}}"> profile
                                       
                                    </a>
                                        
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                        
                                    </div>
                                </li>
                                @endguest
                                </ul>

                    </nav>
                </div>
            </div>
        </div>
        <div class="search_input" id="search_input_box">
            <div class="container ">
                <form class="d-flex justify-content-between search-inner">
                    <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                    <button type="submit" class="btn"></button>
                    <span class="ti-close" id="close_search" title="Close Search"></span>
                </form>
            </div>
        </div>
    </header>
    <!-- Header part end-->