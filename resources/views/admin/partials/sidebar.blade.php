<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dist/img/avatar04.png')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->name }}</p>
                <!-- Status -->
                {{--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>--}}
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="hidden" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
              {{--<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>--}}
              {{--</button>--}}
            </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">            

            <li class="active"><a href="{{url('/home')}}"><i class="fa fa-user"></i> <span>Home</span></a></li>
           <!--  <li class="active"><a href="{{url('terms')}}"><i class="fa fa-user"></i> <span>Terms</span></a></li>     -->
          <!--   <li class="active"><a href="{{url('/user/index')}}"><i class="fa fa-user"></i> <span>User</span></a></li>  -->    



              


        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>