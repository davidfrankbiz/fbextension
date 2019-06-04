<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\User;
use Auth;

class UsersController extends Controller
{
    public function index()
    {
    	return view('users.index');
    }

    public function profile()
    {
    	return view('users.profile');
    }


    public function update(Request $request)
    {

        if(empty($request['password']))
        {
          
              User::where('id', Auth::id())->update($request->except(['password','password_confirmation','_token']));
           
        }else{
                
             $validator = Validator::make($request->all(), [            
            'password' => ['required', 'string', 'min:4', 'confirmed'],  ]);

               if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput(); 
                }else{

                    $request['password'] = bcrypt($request['password']);

                   User::where('id', Auth::id())->update($request->except('_token'));
               
                }

            }


            return redirect()->back()->with(['message' => 'Update Sucessfully']);

    }


     
    public function terms()
    {
        return view('terms');
    }

      public function live($id)
    {       
        $data = User::where('id' , $id)->update(['live' => 0]);


    }

}
