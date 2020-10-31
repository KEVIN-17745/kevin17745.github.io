@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<a href="{{url('admin/categories')}}" style="color:black;" > <h1>Categories</h1> </a>
    
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
          <form name="categoryForm" id="CategoryForm"   @if(empty($categorydata['id'])) action="{{url('admin/add-edit-category')}}"
          @else action="{{url('admin/add-edit-category/'.$categorydata['id'])}}" @endif method ="post" enctype="multipart/form-data">{{csrf_field()}}
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
              <div class="form-group">
                    <label for="name">Category name</label>
                    <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Enter category name" @if(!empty($categorydata['category_name']))
                     value="{{$categorydata['category_name']}}" @else value="{{old('category_name')}}" @endif>
                  </div>
                <!-- /.form-group -->
                <div class="form-group">
                <label>Sections</label>
                  <select class="form-control select2" style="width: 100%;" name="section_id" id="section_id">
                    <option value ="">Select</option>
                    @foreach($getSections as $section)
                    <option value ="{{$section->id}}" @if(!empty($categorydata['section_id']) && $categorydata['section_id'] == $section->id) selected @endif>{{$section->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                    <label for="name">Category discount</label>
                    <input type="text" class="form-control" name="category_discount" id="category_discount" placeholder="Enter category discount"@if(!empty($categorydata['category_discount']))
                     value="{{$categorydata['category_discount']}}" @else value="{{old('category_discount')}}" @endif>
                  </div>
                </div>
                
                <!-- /.form-group -->
             
              <div class="col-md-6">
                 <div class="form-group">
                    <label for="exampleInputFile">category image</label>
                    <div class="input-group">
                     <!-- <div class="custom-file">
                        <input type="file" class="custom-file-input "  name="category_image" id="category_image" >
                        <label class="custom-file-label" for="category_image" class="form-control">Choose file</label>
                      </div> -->
                      <div>
                      <input type="file"   name="category_image" id="category_image" > </div>
                      
                    </div>
                    @if(!empty($categorydata['category_image']))
                        <div style="height: 100px;"><img style="width:50px;" src="{{asset('images/category_images/'.$categorydata['category_image'])}}">
                         &nbsp;
                         <a href="{{url('admin/delete-category-image/'.$categorydata['id'])}}">Delete Image</a>
                        </div>
                    @endif
                  </div>
               
                <div class="form-group">
                        <label>Category description</label>
                        <textarea class="form-control" id="description" name ="description" rows="3" placeholder="Enter ...">@if(!empty($categorydata['description']))
                     {{$categorydata['description']}} @else {{old('description')}} @endif</textarea>
                      </div>

             <!--   <div class="form-group">
                    <label for="name">Category url</label>
                    <input type="text" class="form-control" name="url" id="url" placeholder="Enter category url"@if(!empty($categorydata['url']))
                     value="{{$categorydata['url']}}" @else value="{{old('url')}}" @endif>
                  </div> -->
            </div>
            
              
              
             
            </div>
         
            
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
    <script> console.log('Hi!'); </script>
@stop