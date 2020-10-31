@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<a href="{{url('admin/products')}}" style="color:black;" > <h1>Products</h1> </a>
    
@stop

@section('content')
   

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       

        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">{{$title}}</h3>
            @if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
    @endif
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <form name="productForm" id="ProductForm"   @if(empty($productdata['id'])) action="{{url('admin/add-edit-product')}}"
          @else action="{{url('admin/add-edit-product/'.$productdata['id'])}}" @endif method ="post" enctype="multipart/form-data">{{csrf_field()}}
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
              <div class="form-group">
                    <label for="name">product name</label>
                    <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Enter product name" @if(!empty($productdata['product_name']))
                     value="{{$productdata['product_name']}}" @else value="{{old('product_name')}}" @endif>
                  </div>
                <!-- /.form-group -->
                
          
                <div class="form-group">
                <label> Select Category</label>
                  <select class="form-control select2" style="width: 100%;" name="category_id" id="category_id">
                    <option value ="">Select</option>
                    @foreach($categories as $section)
                    <optgroup label="{{$section['name']}}">
                    @foreach($section['categories'] as $category)
                    <option value="{{$category['id']}}" @if(!empty(@old('category_id')) && $category['id']==@old('category_id')) selected=""
                    @elseif(!empty($productdata['category_id']) && $productdata['category_id']==$category['id']) selected="" @endif>{{ $category['category_name'] }}</option>
                    @endforeach
                    </optgroup>
                    @endforeach
                  </select>
                </div>
              
                <div class="form-group">
                    <label for="name">product code</label>
                    <input type="text" class="form-control" name="product_code" id="product_code" placeholder="Enter product code"@if(!empty($productdata['product_code']))
                     value="{{$productdata['product_code']}}" @else value="{{old('product_code')}}" @endif>
                  </div>
                
                <div class="form-group">
                    <label for="name">product color</label>
                    <input type="text" class="form-control" name="product_color" id="product_color" placeholder="Enter product color"@if(!empty($productdata['product_color']))
                     value="{{$productdata['product_color']}}" @else value="{{old('product_color')}}" @endif>
                  </div>
                  <div class="form-group">
                        <label>product description</label>
                        <textarea class="form-control" id="description" name ="description" rows="3" placeholder="Enter ...">@if(!empty($productdata['description']))
                     {{$productdata['description']}} @else {{old('description')}} @endif</textarea>
                </div>
                  </div>

                <div class="col-md-6">
                <div class="form-group">
                    <label for="name">product price</label>
                    <input type="text" class="form-control" name="product_price" id="product_price" placeholder="Enter product price"@if(!empty($productdata['product_price']))
                     value="{{$productdata['product_price']}}" @else value="{{old('product_price')}}" @endif>
                  </div>
                

                <div class="form-group">
                    <label for="name">product discount</label>
                    <input type="text" class="form-control" name="product_discount" id="product_discount" placeholder="Enter product discount"@if(!empty($productdata['product_discount']))
                     value="{{$productdata['product_discount']}}" @else value="{{old('product_discount')}}" @endif>
                  </div>
                  <div class="form-group">
                    <label for="name">product diamensions</label>
                    <input type="text" class="form-control" name="product_diamensions" id="product_diamensions" placeholder="Enter product diamensions"@if(!empty($productdata['product_diamensions']))
                     value="{{$productdata['product_diamensions']}}" @else value="{{old('product_diamensions')}}" @endif>
                  </div>
            

            <div class="form-group">
                    <label for="name">product material</label>
                    <input type="text" class="form-control" name="product_material" id="product_material" placeholder="Enter product material"@if(!empty($productdata['product_material']))
                     value="{{$productdata['product_material']}}" @else value="{{old('product_material')}}" @endif>
                  </div>
                 
                  
                 <div class="form-group">
                    <label for="exampleInputFile">product main image</label>
                    <div class="input-group">
                     <!-- <div class="custom-file">
                        <input type="file" class="custom-file-input"  name="main_image" id="main_image" >
                        <label class="custom-file-label" for="main_image">Choose file</label>
                      </div> -->
                      <input type="file"   name="main_image" id="main_image" >
                     
                     
                    </div> <div>Recommended Image size: Width:1040px, height:1200px </div>
                    <div>
                    @if(!empty($productdata['main_image']))
                        <div style="height: 100px;"><img style="width:50px;" src="{{asset('images/product_images/small/'.$productdata['main_image'])}}">
                         &nbsp;
                         <a href="{{url('admin/delete-product-image/'.$productdata['id'])}}">Delete Image</a>
                        </div>
                    @endif
                  </div>
                  
                     
                   
              
                
                <div class="form-group">
                        <label>Featured</label>
                        <input type="checkbox" name="is_featured" id="is_featured" value="Yes"
                        @if(!empty($productdata['is_featured']) && $productdata['is_featured'] =="Yes") checked ="" @endif >
                </div>

                </div> <!-- /.end column-->
                       
                
            </div>  <!-- /.end row-->
          
            
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                @csrf
              </form>
            </div>
        </div>
        

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
      
       
  
        
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); 
    </script>
    
@stop