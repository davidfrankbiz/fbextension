<footer>
    <div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <span>© Copyright @php echo date('Y'); @endphp All Rights Reserved | The Bucks Club</span><a href="{{url('terms')}}" class="terms"><span class="terms-icon"></span>Terms
                    & Conditions</a></div>
        </div>
    </div>
</div>
</footer>
<div class="hidden"></div>
<script type="text/javascript" src="{{ asset('users/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('users/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('users/jquery.app.js') }}"></script>
<script type="text/javascript">
	$(document).on('click','ul.menu li.logoutlog', function (){
	
	    var url = "{{url('/live')}}";
        var id = "{{Auth::id()}}";
        $.ajax({
            url: url+'/'+id,
            type: 'GET',  
                   
            success: function (data) { 

            console.log(data);            

            }
        });
	});
</script>
</body>
</html>
