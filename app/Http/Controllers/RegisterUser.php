<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\RegisteruserModel;

class RegisterUser extends Controller
{

	public function index()
	{
		return view('registeruser');
	}

	public function create(Request $request)
	{

		 $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],            

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

        	RegisteruserModel::create($request->all());


        }
	}
    
}
