     
@extends('users.layouts.master')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-12">
                    </div>
    </div>
</div>

<div class="container">
   <div class="row">
      <div class="col-sm-12">
         <h4 class="page-title">Profile</h4>
         <p class="text-muted page-title-alt">Update your profile information</p>
         <div class="card-box clearfix">
             @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
            <form method="POST" action="{{url('/profile')}}" accept-charset="UTF-8">
              {{ csrf_field() }}
               <div class="col-sm-6">
                  <div class="input-box">
                     <label>Email</label><input type="email" value="{{Auth::user()->email}}" placeholder="johndavid@yahoomail.com" name="email" required="">
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="input-box"><label>PayPal
                     Email</label><input type="text" value="{{Auth::user()->paypal_email}}" placeholder="PayPal ID" name="paypal_email" required="">
                  </div>
               </div>
               <div class="col-sm-12" style="margin-top: 20px">
                  <h4>Change Password <br>
                     <small>(Leave it empty to keep your current password)</small>
                  </h4>
               </div>
               <div class="col-sm-6">
                  <div class="input-box">
                     <label>Password</label><input type="password" name="password" >
                     @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert" style="color: red">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="input-box"><label>Confirm
                     Password</label><input type="password" name="password_confirmation" >
                  </div>
               </div>
               <div class="col-sm-2 pull-right">
                  <button type="submit" class="button-submit">Update</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
</div>

     @endsection