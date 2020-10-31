<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class ProfileController extends Controller
{
    

    public function password(Request $request){
       /* if($request->isMethod('post')){
          
          if(!(Hash::check($request->get('current_password'), $request->user()->password))){
            return redirect()->back()->with('error','Your current passoword does not match with provided password ');
        }
        if(strcmp($request->get('current_password'),$request->get('password'))==0){
            return redirect()->back()->with('error','Your current passoword cannot be same with the new password'); 
        }

         

            $request->validate([
                'current_password' =>'required',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
           // 'password_confirmation' => 'required|same:new_password'
            ]);

           $user_id = $request->user()->id;
            $user = User::find($user_id);
           // $user->password = bcrypt($request->get('new_password'));
            $user->password = Hash::make($request->get('new_password'));
            $user->save();
            return redirect()->back()->with('success_message','password changed successfully!!');
            

    } */
    if($request->isMethod('post')){
        $data = $request->all();

        $old_pwd = User::where('id',$request->user()->id)->first();
        $current_pwd = $data['current_password'];

       

        if(Hash::check($current_pwd,$old_pwd->password)){
                
            $request->validate([
                'current_password' =>'required',
            'new_password' => ['required', 'string', 'min:6'],
           'password_confirmation' => 'required|same:new_password'
            ]);

            $new_pwd = bcrypt($data['new_password']);

            User::where('id',$request->user()->id)->update(['password' => $new_pwd]);
            return redirect()->back()->with('success_message','password changed successfully!!');
        }
        else{
            return redirect()->back()->with('error','Your current passoword does not match with provided password ');
        }
    }



        return view('front.updatePassword');
    }
 


    public function account(Request $request){
        $user_id = $request->user()->id;
        $userDetails = User::find($user_id);
       // $userDetails = User::where('id',$id)->first();
      // echo"<pre>";print_r($userDetails);die;

       if($request->isMethod('post')){
             
        $data = $request->all();

        //Product validation  
        $rules =[
            'address' => 'required',
            'name' => 'required',
            'city' => 'required',
            'district' => 'required',
            'postcode' => 'required|regex:/^[\w-]*$/',
            'phone_number' => 'required|digits:10|numeric',
            
              
            
        ];
        $customMessages =[
            'address.required' => 'address is reqired',
            'name.required' => ' name is required',
            'name.regex' => ' valid  Name is reqired',
            'postcode.required' => 'postcode is required',
            'postcode.regex' => ' valid postcode code  is reqired',
            'city.required' => ' city is required',
            'city.regex' => ' valid city is reqired',
            'district.required' => ' district is required',
            'district.regex' => ' valid district is reqired',
            'phone_number.required' => ' phone number is required',
            'phone_number.min' => ' valid phone_number is reqired',
            
            
            
           
        ];

        $this->validate($request,$rules,$customMessages);

        $user = User::find($user_id);
        $user->name = $data['name'];

        $user->address = $data['address'];
        $user->city = $data['city'];
        $user->district = $data['district'];
        $user->postcode = $data['postcode'];
        $user->phone_number = $data['phone_number'];
        $user->save();
        // echo"<pre>";print_r($user);die;
        return redirect()->back()->with('success_message',
        'Your account details has been updated successfully');
                
       }


        return view('front.account')->with(compact('userDetails'));
    }
}
