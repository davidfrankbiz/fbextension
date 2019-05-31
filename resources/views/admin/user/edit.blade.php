@extends('admin.layouts.master')

@section('content')


        
                <div class="" id="register">
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
              <label for="register-email">Phone</label>
              <input type="text" class="form-control" id="register-email" name="phone" value="{{$data['phone']}}">
            </div>

            <div class="form-group">
              <label for="register-email">Paypal Email</label>
              <input type="text" class="form-control" id="register-email" name="paypal_email" value="{{$data['paypal_email']}}">
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
           
            
           
            </div>
            <div class="error-box text-danger"></div>
            <button type="submit" class="btn btn-primary btn-block register">Update</button>
          </form>
        </div>
    


@endsection



@section('javascript')

@stop