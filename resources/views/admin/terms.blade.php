@extends('admin.layouts.master')

@section('content')

    
        <div class="" id="register">
          <form action="#" method="POST">
          	<input type="hidden" name="_token" value="{{ csrf_token() }}
">
            <div class="form-group col-sm-6">
              <label for="register-name">Terms</label>            

              <textarea name="name" class="form-control" rows="4"> </textarea>

              <br>
       

                 <button type="submit" class="btn btn-primary btn-block register ">Save</button>
            </div>
           
           
            
           
            </div>
            <div class="error-box text-danger form-group col-sm-6"></div>
         
          </form>
        </div>




@endsection



@section('javascript')

@stop