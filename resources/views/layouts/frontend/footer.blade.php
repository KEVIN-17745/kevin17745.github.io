<?php
 use App\Section;
 $sections = Section::sections();
 //echo"<pre>";print_r($sections);die;
 
 ?>
<!--::footer_part start::-->
    <footer class="footer_part">
        <div class="container">
            <div class="row justify-content-around">
            @foreach($sections as $section)
                <div class="col-sm-6 col-lg-2">
                    <div class="single_footer_part">
                        <h4>{{ $section['name']}}</h4>
                        @foreach($section['categories'] as $category)
                        <ul class="list-unstyled">
                            <li><a href="{{'/category/'.$category['id']}}">{{$category['category_name']}}</a></li>
                            
                        </ul>
                        @endforeach
                    </div>
                </div>
                @endforeach
               
                
                
                <div class="col-sm-6 col-lg-4">
                    <div class="single_footer_part">
                        <h4>Contact Us</h4>
                         <p>customerserveice@sweetHome.com</p>
                        
                    </div>
                </div>
            </div>
            
        </div>
        <div class="copyright_part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="copyright_text">
                            <P><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
 &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved 
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></P>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="footer_icon social_icon">
                            <ul class="list-unstyled">
                                <li><a href="#" class="single_social_icon"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#" class="single_social_icon"><i class="fab fa-twitter"></i></a></li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--::footer_part end::-->