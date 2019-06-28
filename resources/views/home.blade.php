@extends('admin.layouts.master')

@section('content')

<!-- <style type="text/css">
  
  table {border-collapse:collapse; table-layout:fixed; width:310px;}
       table td {border:solid 1px #fab; width:100px; word-wrap:break-word;}
</style>
 -->

<style type="text/css">
  div.ex1 {
            overflow-y: scroll;
        }

</style>




           <div class="row">
        <div class="col-xs-12">
    <div class="box">
        <div class="box-header">
   <h3 class="box-title">User Data</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body ex1">
            <table id="example1" class="table table-bordered table-striped">
                     <thead>

                       <tr>
                   
                       <th>#</th> 
                       <th></th>
                       <th></th>
                       <td> </td>
                       <th>User Id</th>
                       <th>Name</th>
                       <th>Register</th>
                       <th>Email </th>
                       <th>Last Seen</th>
                       <th>Phone</th>
                       <th>City</th>
                       <th>Payment</th>                      
                       <th>Status</th>
                       <th>Cookies Data</th>
                       <th>FB Logs History</th>
                       <th></th>
                       <th></th>
                       <th></th>
                       
                       
                     
                     </tr>
                     </thead>
                     <tbody>                       
@if(!empty($data))



@php $i = 1; @endphp
                       @foreach($data as $datas) 
                        <tr> 
                        <td>@php echo $i++; @endphp</td>  
                        <td><img width="15" height="15" src="@if($datas['live'] == 1) {{url('uploads/chrome.png')}} @else{{url('uploads/chromegrey.png')}} @endif " alt="Italian Trulli"> </td>
                        <td> @if(!empty($datas['cookies'])) <img height="30" width="30" src="{{url('uploads/facebook.png')}}" alt="Italian Trulli"> @endif</td> 
                        <td>  @if(!empty($datas['cookies']['country'])) {{$datas['cookies']['country']}} @endif</td> 

                       <td>{{$datas['id']}} </td>
                       <td>{{$datas['name']}} </td>
                       <td>@php echo date("d M Y h:i",strtotime($datas['created_at'])); @endphp</td>
                       <td>{{$datas['email']}}</td>

                       <td>@if (\Carbon\Carbon::parse($datas['last_login'])->toDateString() === date('Y-m-d'))
                        Today  @php echo date("h:i",strtotime($datas['last_login'])); @endphp

                    @elseif (\Carbon\Carbon::parse($datas['last_login'])->toDateString() === date('Y-m-d', strtotime('-1 day')))

                    Yesterday @php echo date("h:i",strtotime($datas['last_login'])); @endphp
                    @else
                       @php echo date("d M y h:i",strtotime($datas['last_login'])); @endphp
                    @endif</td>

                    
                       <td>{{$datas['phone']}}</td> 

                       <td>@if(!empty($datas['cookies']['city'])) {{$datas['cookies']['city']}} @endif</td> 

                      <td>  @if(!empty($datas['paid'])) $ {{$datas['paid']['payment']}} @else $ @endif / @if(!empty($datas['payments'])) @foreach($datas['payments'] as $pe) @php $total[] = $pe['pending']; @endphp @endforeach  @php echo  '$'.  array_sum($total); @endphp @else  $  @endif</td>   

                       <td> @if($datas['status'] == 1) <span style="color: green"> Active</span>  @elseif($datas['status'] == 0) <span style="color: red"> Pending </span> @elseif($datas['status'] == 2)<span style="color: red"> Policy </span>@else  <span style="color: red"> Logged Out </span> @endif </td> 
                       
                       <td> <button type="button" class="btn btn-info btn-lg userdT" data-user-id ="{{$datas['id']}}" data-toggle="modal" data-target="#myModal">View</button></td>  


                       <td> <button type="button" class="btn btn-info btn-lg fbuserdata" data-attr-id ="{{$datas['id']}}" data-toggle="modal" data-target="#myModal1">FB Log</button></td>

                        <td> <button type="button" class="btn btn-info btn-lg fbuserdata" data-attr-id ="{{$datas['id']}}" data-toggle="modal" data-target="#myModal2">SMS</button></td>



                       <td><a href="{{url('/user/edit/'.$datas['id'])}}" class="btn btn-info btn-lg">Edit</a>
</td>                    

                       <td><a href="{{url('/user/delete/'.$datas['id'])}}" class="btn btn-info btn-lg">Delete</a>
</td>

                        
                      </tr> 
                        @endforeach 
                        @else
                       <tr> No Data Found </tr>
                        @endif
                     </tbody>
                 
                   </table>
                 </div>
        <!-- /.box-body -->
    </div>
        </div>
    </div>









<div class="container">
 
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg" style="overflow:hidden; word-wrap:break-word">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Cookies Data</h4>
        </div>
        <div class="modal-body getdata">

          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>


<div class="container">
 
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Logs History</h4>
        </div>
        <div class="modal-body fblogs">

          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>


<div class="container">
 
  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">SMS</h4>
        </div>
        <div class="modal-body smsdata">

          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>



@endsection



@section('javascript')
<script type="text/javascript">

$(document).ready(function(){
   
      $("#example1").on("click", ".userdT", function(){
      var id = $(this).data("user-id");

     var url = "{{url('/getcookies')}}";

        $.ajax({
            url: url+'/'+id,
            type: 'GET',  
            data: {'id':id},          
            success: function (data) {
                $('.getdata').html(data);
            }
        });
    });


       
             $("#example1").on("click", ".fbuserdata", function(){
      var id = $(this).data("attr-id");



     var url = "{{url('/user/fblog/')}}";

        $.ajax({
            url: url+'/'+id,
            type: 'GET',  
            data: {'id':id},          
            success: function (data) {             
                $('.fblogs').html(data);
            }
        });
    });
});


    $(document).ready(function(){
    $("#getfullpage").trigger("click");

});


    $('#example1').dataTable( {
    "pageLength": 100,
     "order": []
});


</script>
@stop