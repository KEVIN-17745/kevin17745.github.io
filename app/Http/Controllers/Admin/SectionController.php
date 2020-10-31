<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Section;
use Session;

class SectionController extends Controller
{
    //
    public function sections(){
        $sections= Section::get();
        return view('admin.sections.sections')->with(compact('sections'));
    }
    public function deleteSection($id){

        Section::where('id',$id)->delete();

        

        $message = 'Product deleted successfully';
        session::flash('success_message',$message);
        return redirect()->back(); 
    }
    public function addEditSection(Request $request,$id=null){
        
        if($id==""){
            $title = "Add Section";
            $section = new Section;
            $sectiondata = array();
            $message = " section added successfully";
           
        }
        else{
            $title = "Edit Section";
            $sectiondata = Section::find($id);
            $sectiondata = json_decode(json_encode($sectiondata),true);
            $section = Section::find($id);
            $message = " section updated successfully";
            
        }

     
        if($request->isMethod('post')){
            $data = $request->all();
         
               //Product validation  
               $request->validate([
                
                'name' => 'required|regex:/^[\pL\s-]+$/u',
                
            ]);

   
                $section->name = $data['name'];
                $section->save();  
              
              

                
              session::flash('success_message',$message);
             return redirect('admin/sections');
  }


        return view('admin.sections.add-edit-section')->with(compact('title','sectiondata'));      
    }
}
