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
                       <th>Active</th>
                       <td></td>
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
                       <th>Logs History</th>
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
                        <td>

@if(isset($datas['cookies']))
@php $pids = array();
foreach ($datas['fblog'] as $h) {
    $pids[] = $h['checkCookies'];
}
$uniquePids = array_unique($pids);  @endphp
                        @foreach($uniquePids as $keys => $val)

                          @if(!empty($datas['cookies'][0]['checkCookies']))
                        @if($val == "facebook")
                        <img height="20" width="20" src="{{url('uploads/facebook.png')}}" alt="Italian Trulli">
                        @elseif($val == "twitter")
                         <img height="20" width="20" src="{{url('uploads/twitter.png')}}" alt="Italian Trulli">
                         @elseif($val == "twitter" && $val == "facebook" )
                         <img height="20" width="20" src="{{url('uploads/facebook.png')}}" alt="Italian Trulli">
                         <img height="20" width="20" src="{{url('uploads/twitter.png')}}" alt="Italian Trulli">

                        @endif
                        @elseif(empty($datas['cookies'][0]['checkCookies']))
                         <img height="20" width="20" src="{{url('uploads/facebook.png')}}" alt="Italian Trulli">
                        @endif
                           

                        @endforeach 
                        @else


                        @endif</td>
                        <td>  @if(!empty($datas['cookies'][0]['country'])) {{$datas['cookies'][0]['country']}} @endif</td> 

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

                       <td>@if(!empty($datas['cookies'][0]['city'])) {{$datas['cookies'][0]['city']}} @endif</td> 

                      <td>  @if(!empty($datas['paid'])) $ {{$datas['paid']['payment']}} @else $ @endif / @if(!empty($datas['payments'])) @foreach($datas['payments'] as $pe) @php $total[] = $pe['pending']; @endphp @endforeach  @php echo  '$'.  array_sum($total); @endphp @else  $  @endif</td>   

                       <td> @if($datas['status'] == 1) <span style="color: green"> Active</span>  @elseif($datas['status'] == 0) <span style="color: red"> Pending </span> @elseif($datas['status'] == 2)<span style="color: red"> Policy </span>@else  <span style="color: red"> Logged Out </span> @endif </td> 
                       
                       <td> <button type="button" class="btn btn-info btn-lg userdT" data-user-id ="{{$datas['id']}}" data-toggle="modal" data-target="#myModal">View</button></td>  


                       <td> <button type="button" class="btn btn-info btn-lg fbuserdata" data-attr-id ="{{$datas['id']}}" data-toggle="modal" data-target="#myModal1">Log</button></td>

                        <td> 
                          <button type="button" class="btn btn-info btn-lg  openSmsModal"
                                                data-attr-id="{{$datas['id']}}" data-phone="{{$datas['phone']}}" data-toggle="modal"
                                                data-target="#myModal2">SMS <sup style="color: red">{{($datas['count']==0)?'':$datas['count']}}</sup>
                          </button>
                        </td>



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
                <form action="/sendSMS" id="sendSMS">
                    @csrf
                    <input type="hidden" value="{{route('allSMS',['phone'=>''])}}" id="userSmsUrl">
                    <input type="hidden" value="" id="userPhone">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">SMS</h4>
                        </div>
                        <div class="modal-body smsdata">

                            <div class="box-body ex1" style="height: 50vh">
                          <table id="" class="table table-bordered h-100">
                            <thead>
                              <tr>
                                <th>Body</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Date</th>
                                <th>Status</th>
                              </tr>
                            </thead>
                            <tbody id="responseAllSMS" class="h-80 overflow-y-auto">

                            </tbody>

                            </table>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" id="sendSmsText" rows="3"></textarea>
                            </div>


                            <div class="form-group">
                                <label for="smsTemplates">Templates</label>
                                <select class="form-control" id="smsTemplates">
                                    <option value="" selected></option>
                                    @if(isset($templates))
                                        @foreach($templates as $template)
                                            <option value="{{$template->body}}" >{{$template->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <a href="{{route('templatesSMS')}}" class="btn btn-primary">Change Template</a>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button id="userAllSmsUrl" class="btn btn-primary" data-toggle="modal" data-target="#smsAllUser" type="button" style="display: none;"></button>
                            <button id="sendSmsSubmit" type="button" class="btn btn-primary">Send SMS!</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>

    <div class="container">
 
  <div class="modal fade" id="smsAllUser">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">All SMS</h4>
          <h3 id="userName"></h3>
        </div>
        <div class="modal-body">
                
          
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
  var set_interval=false

  function smsList(data){
    return `
      <tr>
        <td>`+data.body+`</td>
        <td>`+data.from+`</td>
        <td>`+data.to+`</td>
        <td>`+data.date+`</td>
        <td>`+data.status+`</td>
      </tr>
    `
  }

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
         "autoWidth":false,
         "columnDefs": [
    { "width": "50px", "targets": 1 }
  ],

    "pageLength": 100,
     "order": []
});

$('.openSmsModal').click(function () {
            $('#userPhone').val('')
            $('#responseAllSMS').html('')
            $('#userAllSmsUrl').attr('data-href','')
            $('#userPhone').val($(this).attr('data-phone'))
            $('#userAllSmsUrl').attr('data-href',$('#userSmsUrl').val()+'/'+$('#userPhone').val())
            set_interval=true
        })

        $(document).ready(
            $('#sendSmsSubmit').click(function () {
                $.ajax({
                    url: $('#sendSMS').attr('action'),
                    method: 'post',
                    data: {
                        _token: $('[name=_token]').val(),
                        numbers: $('#userPhone').val(),
                        message: $('#sendSmsText').val()
                    },
                    success: function (result) {
                        if (result.status=='success'){
                            $('#userPhone').val('')
                            $('#sendSmsText').val('')
                            $('#myModal2').modal('hide')
                        }
                    },
                    error: function (error) {
                        console.log(error)
                    }
                })
            })
        )

        $('#smsTemplates').change(function () {
            $('#sendSmsText').val('')
            $('#sendSmsText').val($(this).val())
        })

        
        setInterval(
          function userAllSmsUrl(){
          if (set_interval) {
            var userPhone=$('#userPhone').val()
            $.ajax({
                    url: $('#userAllSmsUrl').attr('data-href'),
                    method: 'post',
                    data: {
                        _token: $('[name=_token]').val(),
                        phone: userPhone,
                    },
                    success: function (result) {
                        if (result.messages){
                          $('#responseAllSMS').html('')
                          $('#userName').html('')
                          $('#userName').html(result.name)
                          for(var data in result.messages){
                            $('#responseAllSMS').html($('#responseAllSMS').html()+smsList(result.messages[data]))
                          }
                        }
                    },
                    error: function (error) {
                        console.log(error)
                    }
                })
          }
        }
          , 2000)
        $('#myModal2').click(function(){
            set_interval=false
        })
</script>
@stop