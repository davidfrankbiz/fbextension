     
@extends('admin.layouts.master')

@section('content')


<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Update Profile</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
           <form method="POST" action="{{url('/admin/profile')}}" accept-charset="UTF-8">
              {{ csrf_field() }}

              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Email </label>
                  <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{Auth::user()->email}}">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1"> Paypal Email</label>
                  <input type="email" name="paypal_email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"   value="{{Auth::user()->paypal_email}}" name="paypal_email">
                </div>


               


                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label> 
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" >
                   @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert" style="color: red">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                  </div>


                   <div class="form-group">
                  <label for="exampleInputPassword1">Confirm
                     Password</label> 
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password_confirmation" >                
                  </div>
               
                

              
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->

          <!-- Form Element sizes -->
         

        </div>

     @endsection