@extends('adminlte::page')

@section('title', 'Sections')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
body {
    color: #566787;
    background: #f5f5f5;
    font-family: 'Roboto', sans-serif;
}
.table-responsive {
    margin: 30px 0;
}
.table-wrapper {
    min-width: 1000px;
    background: #fff;
    padding: 20px;
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.table-title {
    padding-bottom: 10px;
    margin: 0 0 10px;
    min-width: 100%;
}
.table-title h2 {
    margin: 8px 0 0;
    font-size: 22px;
}
.search-box {
    position: relative;        
    float: right;
}
.search-box input {
    height: 34px;
    border-radius: 20px;
    padding-left: 35px;
    border-color: #ddd;
    box-shadow: none;
}
.search-box input:focus {
    border-color: #3FBAE4;
}
.search-box i {
    color: #a0a5b1;
    position: absolute;
    font-size: 19px;
    top: 8px;
    left: 10px;
}
table.table tr th, table.table tr td {
    border-color: #e9e9e9;
}
table.table-striped tbody tr:nth-of-type(odd) {
    background-color: #fcfcfc;
}
table.table-striped.table-hover tbody tr:hover {
    background: #f5f5f5;
}
table.table th i {
    font-size: 13px;
    margin: 0 5px;
    cursor: pointer;
}
table.table td:last-child {
    width: 130px;
}
table.table td a {
    color: #a0a5b1;
    display: inline-block;
    margin: 0 5px;
}
table.table td a.view {
    color: #03A9F4;
}
table.table td a.edit {
    color: #FFC107;
}
table.table td a.delete {
    color: #E34724;
}
table.table td i {
    font-size: 19px;
}    

.hint-text {
    float: left;
    margin-top: 6px;
    font-size: 95%;
}    
</style>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
</head>

@section('content_header')
<a href="{{url('admin/sections')}}" style="color:black;" > <h1>Sections</h1> </a>
    
@stop

@section('content')



<body>
@if(Session::has('success_message'))
<div class="alert alert-success" role="alert">
   {{Session::get('success_message')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
          
                <div class="row">
                    <div class="col-sm-8"><h2>Sections</h2> <b>details</b></div>
                    <div class="col-sm-4">
                        <a href="{{url('admin/add-edit-section')}}" style="max-width:150px; float:right; display:inline-block;" class="btn btn-block btn-success">Add Section</a>                    </div>
                </div>
            </div>
            <table id="sections" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                        <th>ID</th>
                        <th>Name <i class="fa fa-sort"></i></th>
                        
                        <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($sections as $section)
                    <tr>
                        <td>{{ $section->id }}</td>
                        <td>{{ $section->name }}</td>
                    <td>
                            
                            <a href="{{url('admin/add-edit-section/'.$section->id)}}" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a  class ="confirmDelete delete" name="Section" href="{{url('admin/delete-section/'.$section->id)}}"  title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
                    @endforeach
                  </tr>
                  
                </table>
           
        </div>
    </div>  
</div>   
</body>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


@section('js')

    <script> console.log('Hi!'); </script>
<script>
//condirm delete of message
$(".confirmDelete").click(function(){
   var name = $(this).attr("name");
   if(confirm("Are you sure to delete this"+name+"?")){
       return true;
   }
    return false;

});
</script>
@stop