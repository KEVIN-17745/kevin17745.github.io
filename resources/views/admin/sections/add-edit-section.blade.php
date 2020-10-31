@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<a href="{{url('admin/sections')}}" style="color:black;" > <h1>Sections</h1> </a>
    
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
          <form name="sectionForm" id="sectionForm"   @if(empty($sectiondata['id'])) action="{{url('admin/add-edit-section')}}"
          @else action="{{url('admin/add-edit-section/'.$sectiondata['id'])}}" @endif method ="post" >@csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
              <div class="form-group">
                    <label for="name">section name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter section name" @if(!empty($sectiondata['name']))
                     value="{{$sectiondata['name']}}" @else value="{{old('name')}}" @endif>
                  </div>
                
                
                
                
             
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