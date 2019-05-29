@extends('admin.layouts.master')

@section('content')

           <div class="row">
        <div class="col-xs-12">
    <div class="box">
        <div class="box-header">
   <h3 class="box-title">User Data</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example2" class="table table-bordered table-striped">
                     <thead>

                       <tr>
                   
                       <th>#</th>
                       <th>Name</th>
                       <th>Register</th>
                       <th>Email </th>
                       <th>Last Seen</th>
                       <th>Phone</th>
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

                       <td><a href="{{url('user/edit/'.$datas['id'])}}" class="btn btn-info btn-lg">Edit</a>
</td>                    

                       <td><a href="{{url('user/delete/'.$datas['id'])}}" class="btn btn-info btn-lg">Delete</a>
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










@endsection



@section('javascript')

@stop