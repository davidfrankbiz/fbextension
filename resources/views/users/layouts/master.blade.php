<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>


    @include('users.partials.header')

   <section>
        <div class="container">

              @yield('content')

        </div>
    </section>

    <!-- /.content-wrapper -->
    @include('users.partials.footer')
  

</div>





</body>
