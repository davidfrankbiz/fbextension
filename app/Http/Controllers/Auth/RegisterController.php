<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Twilio\Rest\Client;
use App\Templates;



class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }


    public function registeruser(Request $request)
    {
      
  

       $validator = Validator::make($request->all(), [
           'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:register_user'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],

        ]);

        if ($validator->fails()) {
           return response()->json(['errors'=>$validator->errors()->all()]);
        } else {
               //echo "<pre>"; print_r($request->all()); die();
        	$pass = $request['password'] ;
            $request['password'] = bcrypt($request['password']);
            $request['status'] = 0;

            $request['phone'] = '+'.$request['code'].$request['phone'];

          
           
            
                $data = $this->guard()->login(User::create($request->all()));
                $user = User::where('email', $request['email'])->first();
                User::where('email',$request['email'])->update(['live' => 1]);

                $datanew['email'] = $request['email'];

        Mail::send('emails.email', ['email'=>$datanew['email'] , 'name' =>$request['name'],'password'=>$pass], function ($message) use ($datanew) {         
         $message->subject("Welcome to site name");
         $message->to($datanew['email']);
        });

                        $this->sendSms($request['phone']);


                return response()->json(['id'=> $user['id'] , 'status' => $user['status']]);     
                return redirect($this->redirectPath());      
               }

    }



     public function sendSms($phone)
    {
        $accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
        $authToken  = config('app.twilio')['TWILIO_AUTH_TOKEN'];
       
        $client = new Client($accountSid, $authToken);

        $mess=Templates::where('status','welcome')->first()->body;
        if (!$mess) {
            $mess='Thanks for downloading Lemonade Cash Club. Our reps will make sure your account is verified, and we will update you within 24 hours';
        }
            

        try
        {
            // Use the client to do fun stuff like send text messages!
            $client->messages->create(
            // the number you'd like to send the message to
                $phone,
           array(
                 // A Twilio phone number you purchased at twilio.com/console
                 'from' => '+12029309758',
                 // the body of the text message you'd like to send
                 'body' => $mess
             )
         );
   }
        catch (Exception $e)
        {
            echo "Error: " . $e->getMessage();
        }
    }


   

  /* public function email()
   {
   	return view('emails.email');
   }*/




}
