@extends('adminlte::page')

@section('title', 'Products')
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
.pagination {
    float: right;
    margin: 0 0 5px;
}
.pagination li a {
    border: none;
    font-size: 95%;
    width: 30px;
    height: 30px;
    color: #999;
    margin: 0 2px;
    line-height: 30px;
    border-radius: 30px !important;
    text-align: center;
    padding: 0;
}
.pagination li a:hover {
    color: #666;
}   
.pagination li.active a {
    background: #03A9F4;
}
.pagination li.active a:hover {        
    background: #0397d6;
}
.pagination li.disabled i {
    color: #ccc;
}
.pagination li i {
    font-size: 16px;
    padding-top: 6px
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
  $('products').DataTable();
});

    

</script>
</head>

@section('content_header')   

                    
<a href="{{url('admin/products')}}" style="color:black;" > <h1>Products</h1> </a>

@stop

@section('content')

@section('plugins.Datatables', true)

<body>
@if(Session::has('success_message'))
<div class="alert alert-success" role="alert">
   {{Session::get('success_message')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
<div class="col-sm-12">
                        <a href="{{url('admin/add-edit-product')}}" style="max-width:150px; float:right; display:inline-block;" class="btn btn-block btn-success">Add Product</a>                    </div>
                </div>
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
        <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Product <b>Details</b></h2></div>
                    <div class="col-sm-4">
                    
                        <div class="search-box">
                        <form class="form-inline d-flex justify-content-center md-form form-sm"action="{{ url('admin/search-products') }}" method="post"> {{ csrf_field() }}
                            <i class="material-icons">&#xE8B6;</i>
                             
                            
                            <input type="text"  name="product" class="form-control" placeholder="Search&hellip;">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <table id="products" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th> Product Name</th>
                    <th> Section</th>
                    <th> Category</th>
                    <th> Product Code</th>
                    <th> Product Color</th>
                    <th> Product Image</th>
                    <th> product Price</th>
                    
                    
                  <!--  <th> product status</th>-->
                    
                    <th>Actions</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  
                      @foreach($products as $product)
                  <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->category['category_name'] }}</td>
                    <td>{{ $product->section->name }}</td>
                    <td>{{ $product->product_code }}</td>
                    <td>{{ $product->product_color }}</td>
                    <td>
                    <?php $product->image_path = "images/product_images/small/".$product->main_image;  ?>
                    @if(!empty($product->main_image) && file_exists($product->image_path) )
                    <img style="width:100px;" src="{{asset('images/product_images/small/'.$product->main_image)}}">
                    @else
                    <img style="width:100px;" src="{{asset('images/product_images/small/no_image.png')}}">
                    @endif
                    </td>
                    <td>{{ $product->product_price}}</td>
                   
                  <!--  <td>
                    @if($product->status==1)
                    <a class="UpdateProductStatus" id="product-{{$product->id}}" product_id="{{$product->id}}"
                    href="javascript:void(0)">Active</a>
                    @else
                    <a class="UpdateProductStatus" id="product-{{$product->id}}" product_id="{{$product->id}}"
                    href="javascript:void(0)">Inactive</a>
                    @endif
                    </td>-->
                    
                   
                    <td>
                            
                            <a href="{{url('admin/add-edit-product/'.$product->id)}}" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a  class ="confirmDelete delete" name="Product" href="{{url('admin/delete-product/'.$product->id)}}" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
                   
                    @endforeach
                  </tr>
                  
                </table>
                

                
            <div class="clearfix">
                <div class="hint-text">Showing <b>10</b>  entries</div>
                <ul class="pagination">
                    
                    {{ $products->links() }}
                    
                </ul>
            </div>
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
//update product status

 /* $(".updateProductStatus").click(function(){
    var status = $(this).text();
    var product_id = $(this).attr("product_id");
    alert(status);
    alert(product_id);
  $.ajax({
        type:'post';
        url:'admin/update-product-status',
        data:{status:status,product_id:product_id},
        success:function(resp){
            if(resp['status']==0){
                $("#product-"+product_id).html("<a class ='updateProductStatus' href="">")
            }
            else if(resp['status']==1){
                $("#product-"+product_id).html("<a class ='updateProductStatus' href="">")
            }
        },error:function(){
            alert("Error");
        }
    }); 
});*/




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