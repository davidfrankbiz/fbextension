<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>

    @include('admin.partials.header')

</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    @include('admin.partials.topbar')

    @include('admin.partials.sidebar')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @if(!empty(Request::segment(1)))
                {{  ucfirst(Request::segment(1)) }}
                @endif
                {{--<small>Optional description</small>--}}
            </h1>

              <span style="color: green"> TimeZone: @php echo config('app.timezone'); @endphp </span>
            <ol class="breadcrumb">
                <li><a href="{{url(''.'/'.Request::segment(1))}}"><i class="fa fa-dashboard"></i> @if(!empty(Request::segment(1)))
                            {{  ucfirst(Request::segment(1)) }}
                        @endif</a></li>


                {{--<li class="active">  @if(!empty(Request::segment(1))) {{  ucfirst(Request::segment(2)) }} @endif</li> --}}
            </ol>
        </section>

        <!-- Main content -->

            <section class="content">
            @yield('content')

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('admin.partials.footer')
    @include('admin.partials.rightside')

</div>


@include('admin.partials.javascripts')

@yield('javascript')


</body>
