@extends('admin.layouts.master')

@section('content')


        
                <div class="" id="register">






                   <style>


/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>



<div class="tab">
  <button class="tablinks active" onclick="openCity(event, 'London')">Profile</button>
  <button class="tablinks" onclick="openCity(event, 'Paris')">Payment</button>
  
</div>


@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif

<div id="London" class="tabcontent active" style="display: block";>

   <form action="{{url('/user/edit/'.$data['id'])}}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}
">
            <div class="form-group">
              <label for="register-name">Name</label>
              <input type="text" class="form-control" id="register-name" name="name" value="{{$data['name']}}">
            </div>
            <div class="form-group">
              <label for="register-email">Email address</label>
              <input type="email" class="form-control" id="register-email" name="email" value="{{$data['email']}}">
            </div>

             <div class="form-group">
              <label for="register-email">Refered by</label>
              <input type="text" class="form-control" id="register-email" value="{{$data['refer_by']}}" readonly>
            </div>


             <div class="form-group">
              <label for="register-email">Phone</label>
              <input type="text" class="form-control" id="register-email" name="phone" value="{{$data['phone']}}">
            </div>

            <div class="form-group">
              <label for="register-email">Paypal Email</label>
              <input type="text" class="form-control" id="register-email" name="paypal_email" value="{{$data['paypal_email']}}">
            </div>

           
            
<div class="form-group">
              <label for="register-email">Status</label>
              <select name="status" class="form-control"> 
                <option value="1" @if($data['status'] ==1) selected @endif> Active</option>
                <option value="0" @if($data['status'] ==0 ) selected @endif>Pending</option>
                <option value="2" @if($data['status'] ==2 ) selected @endif>Policy</option>
                <option value="3" @if($data['status'] ==3 ) selected @endif>Logged Out</option>
 
               </select>
            </div>
           

           <div class="form-group">
              <label for="register-email">Registred On</label>
              <input type="text" class="form-control" id="register-email" value="@php echo  date("d M y", strtotime($data['created_at'])); ;@endphp" readonly>
            </div>

            
            <div class="error-box text-danger"></div>
            <button type="submit" id ="hideUpdate" class="btn btn-primary btn-block register">Update</button>
           
            </div>
            
          </form>
        </div>






<div id="Paris" class="tabcontent">


   <form action="{{url('updatepending')}}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}
">
            <div class="form-group">
              <label for="register-name">Name</label>
              <input type="text" class="form-control" id="register-name" value="{{$data['name']}}">
            </div>


<input type="hidden" name="ids" class="form-control" id="register-name" value="@if(!empty($data['payment'])) {{$data['payment'][0]['id']}}  @endif">

             
            <div class="form-group">
              <label for="register-email">Payment</label>
              <input type="text" class="form-control" id="register-email" name="payment" >
            </div>

             <div class="form-group">
              <label for="register-email">Pending</label>
              <input type="text" class="form-control" id="register-email" name="pending" value="@if(!empty($data['payment'])) @foreach($data['payment'] as $pending) @php $pen[] = $pending['pending'];  @endphp  @endforeach  @php echo array_sum($pen); @endphp     @endif">
            </div>

            

            <div class="form-group">
              <label for="register-email">Total Earning</label>
              <input type="text" class="form-control" id="register-email" name="totalearning" value="@if(!empty($data['payment'])) {{$data['payment'][0]['totalearning']}} @else 0 @endif">
            </div>

           
            
<div class="form-group">
              <label for="register-email">Status</label>
              <select name="status" class="form-control"> 
                    <option value="0" @if(isset($data['payment']['status']) and $data['payment']['status'] ==0) selected  @endif> Pending</option>

                     <option value="1" @if(isset($data['payment']['status']) and $data['payment']['status'] ==1) selected  @endif> Paid</option>
                   
              </select>
            </div>
           


            
            
           <div class="error-box text-danger"></div>
            <button type="submit" class="btn btn-primary btn-block register">Pay</button>
            </div>
            
          </form>
 
</div>


</div>
@endsection



@section('javascript')

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>

@stop