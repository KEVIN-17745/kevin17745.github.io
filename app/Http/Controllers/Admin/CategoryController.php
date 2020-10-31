<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Section;
use Illuminate\Support\Facades\Response;

use Image;
use Session;
class CategoryController extends Controller
{
    
    public function categories(){
       $categories = Category::get();
       $categories = Category::with(['section'=>function($query){
        $query->select('id','name');
  }])->get();
       return view('admin.categories.categories')->with(compact('categories'));

    }

    public function addEditCategory(Request $request,$id=null){
        
        if($id==""){
            $title = "Add Category";
            //add cetegory function
            $category = new Category;
            $categorydata = array();
            $message = "category added successfully";
        }
        else{
            $title = "Edit category";
            //edit category
            $categorydata = Category::where('id',$id)->first();
            $categorydata = json_decode(json_encode($categorydata),true);
            //echo"<pre>"; print_r($categorydata);die;
            $category = Category::find($id);
            $message = "category updated successfully";
        }
              
           if($request->isMethod('post')){
             
              $data = $request->all();
         //echo "<pre>"; print_r($data); die;

        
         /*
         //upload category image
         if($request->hasFile('category_image')){
            echo $image_tmp = $request->file('category_image');
            die;
            if($image_tmp->isValid()){
                
             
              //get image extension
             $extension =$image_tmp->getClientOriginalExtension();
 
              //genarate new image
 
              $imageName = rand(111,99999).'.'.$extension;
              $imagePath = 'images/category_images'.$imageName;
              
              //upload the image
              Image::make($image_tmp)->save($imagePath);
              //save category image
              $category->category_image = $imageName;
 
         }
 
         } 
      */
        //category validation  
         $rules =[
             'category_name' => 'required|regex:/^[\pL\s-]+$/u',
             'section_id' => 'required',
               
             'category_image' =>'mimes:jpeg,jpg,png,gif|required|max:10000',
         ];
         $customMessages =[
             'category_name.required' => 'Category Name is reqired',
             'category_name.regex' => ' valid Category Name is reqired',
             'section_id.required' => 'Section is required',
             'category_image.image' => 'Valid category image is required', 
         ];

         $this->validate($request,$rules,$customMessages);
          
               
           if(empty($data['description'])){
            $data['description'] = "";
           }
           
           if(empty($data['url'])){
             $data['url'] = "";
            }
            if(empty($data['category_discount'])){
                $data['category_discount'] = 0.0;
               }

             $category->category_name = $data['category_name'];
              $category->section_id = $data['section_id'];
              //$category->category_image = $data['category_image'];

              if($request->hasFile('category_image'));
              {
                   $image_file = $request->file('category_image');
                   $img_extension = $image_file->getClientOriginalExtension();
                   $img_filename = rand(111,99999).'.'.$img_extension;
                   $image_file->move('images/category_images',$img_filename);
                   $category->category_image = $img_filename;
                   
              }




              $category->category_discount = $data['category_discount'];
              $category->decsription = $data['description'];
              $category->url = $data['url'];

             
              $category->save();
                
              session::flash('success_message',$message);
             return redirect('admin/categories');

           }
         

        //get all sections
        $getSections = Section::get();
        return view('admin.categories.add-edit-category')->with(compact('title','getSections','categorydata'));
    }

    public function deleteCategory($id){

        Category::where('id',$id)->delete();

        $message = 'Category deleted successfully';
        session::flash('success_message',$message);
        return redirect()->back(); 
    }

    public function deleteCategoryImage($id){

       $categoryImage = Category::select('category_image')->where('id',$id)->first();

       $category_image_path ='images/category_images/';

       //delete from  folder
       if(file_exists($category_image_path.$categoryImage->category_image)){
           unlink($category_image_path.$categoryImage->category_image);
       }
     //delete db
       Category::where('id',$id)->update(['category_image'=>'']);
       return redirect()->back()->with('flash_message_success','image deleted successfully');
    }

}
