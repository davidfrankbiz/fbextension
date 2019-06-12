<footer>
    <div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <span>© Copyright @php echo date('Y'); @endphp All Rights Reserved | Lemonade Cash Club</span><a href="{{url('terms')}}" class="terms"><span class="terms-icon"></span>Terms
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
    $(document).on('click','ul.menu li.logoutlog', function (e){      
       
        var url = "{{url('/live')}}";       
        $.ajax({
            url: url,
            type: 'GET',  
                   
            success: function (data) { 

            console.log(data);  
            return false; 
            alert('sdf');         

            }
        });


    });


var userstatus = "@if(isset(Auth::user()->status)) {{Auth::user()->status}} @endif";
var authId = "{{Auth::id()}}";

         document.cookie = "authId="+authId;
           document.cookie = "userstatus="+userstatus;



/*
             var getNameCookies = getCookie('authId');
 alert(getNameCookies);


function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}*/




</script>
</body>
</html>
