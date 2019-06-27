​<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <title> Lemonade Cash Club</title>
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="shortcut icon" href="{{ secure_asset('frontimages/favi.png') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ secure_asset('frontimages/apple-icon.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="secure_asset('frontimages/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="secure_asset('frontimages/favicon/apple-icon-114x114.png') }}">
    <!-- Bootstrap v3.3.4 Grid Styles-->

     <style>
          .logo img {
    width: 195%;
    height: 100px;
}
    </style>



    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="{{ secure_asset('front/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ secure_asset('front/style_yellow.css') }}">
    <link href="{{ secure_asset('front/gsdk-bootstrap-wizard.css') }}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{{ secure_asset('build/css/intlTelInput.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('build/css/demo.css') }}">

    <style>
        #browserMsg, #mobileMsg {
            display: none;
        }
       .logo img {
    width: 195%;
    height: 100px;
}
    </style>
   <!--  <link rel="stylesheet" href="secure_asset('front/intlTelInput.css') }}"> -->
    <style>
        /*.iti-flag {
            background-image: url("{{url('/frontimages/flags.png')}}");
        }*/

        .intl-tel-input {
            width: 100%;
        }

        .intl-tel-input .country-list {
            width: 350px;
        }

        .nav-pills > li.active > a, .nav-pills > li.active > a:focus, .nav-pills > li.active > a:hover {
     background-color: #2CA8FF !important; 
}

.nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover {
    /* color: #fff; */
    background-color: #2CA8FF !important;
}
.moving-tab {
    display: none;
}
input[type="checkbox"] {
    width: 15px;
    height: 15px;
    margin-top: 9px;
}

        @-webkit-keyframes pulse {
            0% {
                box-shadow: 0 0 0px #6c9ab0, inset 0 0 0px #ea4c89;
            }
            25% {
                box-shadow: 0 0 12px #6c9ab0, inset 0 0 12px #ea4c89;
            }
            50% {
                box-shadow: 0 0 30px #6c9ab0, inset 0 0 22px #ea4c89;
            }
            100% {
                box-shadow: 0 0 40px #6c9ab0, inset 0 0 40px #ea4c89;
            }
        }
    </style>

</head>





<body>

    <input type="hidden" name="login_id" id = "login_id" value="@if(!empty(Auth::id())) 
                        {{Auth::id()}} @endif">
   <!--  <p style="display:none">https://chrome.google.com/webstore/detail/the-bucks-club/dkanffljhjlldkmeinnhgfijicjkihho</p> -->
    <header>
        <div class="container">
            <div class="header-top-wrapper">
                <div class="row">
                    <div class="col-xs-12 col-sm-5 col-md-3 col-lg-3 text-center">
                        <div class="logo">
                            <a href="javascript:void(0)">
                                <img src="{{url('frontimages/logo_fbd.png')}}" alt=" Lemonade Cash Club">
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-7 col-md-9 col-lg-9">
                        <ul class="menu">
                            <li><a href="javascript:void(0)">Home</a>
                            </li>
                            <li><a class="page-scroll _mPS2id-h" href="#section-about">About</a>
                            </li>
                            <li><a class="page-scroll _mPS2id-h" href="#section-how-it-work">How it works</a>
                            </li>

                            <li>@if(Auth::id() and Auth::user()->is_admin == 0) <a href="{{url('/dashboard')}}" class="active">Dashboard</a> @elseif(Auth::id() and Auth::user()->is_admin == 1)
                                <a href="{{url('/home')}}" class="active">Dashboard </a>
                            @else 
                                <a href="#section-register" class="active">Register</a>@endif
                            </li>
                        


                            @if(Auth::id())

                            <li class="logoutlog">  <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                                    Logout</a>
                                     <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                            @else
                             <li> <a href="{{url('login')}}">Login</a> </li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
        </div>


        



        <div class="container">
            <div class="">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div>
                            <img src="{{url('frontimages/image-1.png')}}" class="img-responsive">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h1 class="sec-title">
                            Earn<span class="text-money"> Money</span> from <br>
                            your <span class="text-fba">Facebook Account</span>
                        </h1>
                            <div class="spacer10"></div>
                            <div class="steps-devider"></div>
                            <br>
                            <div class="spacer10"></div>
                            <p class="head-desc">We’re a social media marketing company that specializes in Facebook Advertising. We’ve developed a Google Chrome extension that allows you to make up to $500/month with your Facebook account. The extension allows us to rent the business side of your Facebook, without affecting your personal Facebook use. Your first payment will be deposited within 24 hours of submitting your application.</p>
                            <div class="spacer10"></div> <a href="#section-how-it-work" class="m-btn btn page-scroll">Know More</a>
                            <div class="spacer10"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>


    
    <div class="container-fluid no-padd _mPS2id-t" id="section-about">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-padd text-center">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 no-padd step1">
                <p>
                    <img src="{{url('frontimages/step1.png')}}">
                </p>
                <p>Submit the Form</p>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 no-padd step2">
                <p>
                    <img src="{{url('frontimages/step2.png')}}">
                </p>
                <p>Confirm Eligibility</p>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 no-padd step3">
                <p>
                    <img src="{{url('frontimages/step3.png')}}">
                </p>
                <p>Receive Payment</p>
            </div>
        </div>
    </div>
    <div class="container qualif _mPS2id-t" id="section-how-it-work">
        <div class="row">
            <div class="col-sm-12">
                <div class="qualif-title">
                    @if(Auth::id())
                     <h2>Before you <span class="text-primary"><a href="{{url('dashboard')}}">Dashboard</a></span>, </h2>
                    @else
                    <h2>Before you <span class="text-primary">register</span>, you must meet the following qualifications:</h2>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="qualif-wrapp">
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="qualif-item">
                                <div class="qualif-img">
                                    <img src="{{url('frontimages/qu-icon-1.png')}}" alt="">
                                </div>
                                <div class="qualif-text">
                                    <h4>100 Friends on Facebook</h4>
                                    <p>You must have a minimum of 100 friends on Facebook</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="qualif-item">
                                <div class="qualif-img">
                                    <img src="{{url('frontimages/qu-icon-2.png')}}" alt="">
                                </div>
                                <div class="qualif-text">
                                    <h4>Genuine Facebook Account</h4>
                                    <p>The Facebook account must be YOURS</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="qualif-item">
                                <div class="qualif-img">
                                    <img src="{{url('frontimages/padlock-70.png')}}" alt="">
                                </div>
                                <div class="qualif-text">
                                    <h4>Age Restriction</h4>
                                    <p>You must be over 21 in order to take part in our program</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="qualif-item">
                                <div class="qualif-img">
                                    <img src="{{url('frontimages/qu-icon-4.png')}}" alt="">
                                </div>
                                <div class="qualif-text">
                                    <h4>1 Year Old Account</h4>
                                    <p>Your Facebook account must be at least 1 year old</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="qualif-item">
                                <div class="qualif-img">
                                    <img src="{{url('frontimages/qu-icon-5.png')}}" alt="">
                                </div>
                                <div class="qualif-text">
                                    <h4>Untouched Ad Account</h4>
                                    <p>You have never used your Facebook Ad Account/ Business Account</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="qualif-item">
                                <div class="qualif-img">
                                    <img src="{{url('frontimages/paypal.png')}}" alt="" width="70" height="70">
                                </div>
                                <div class="qualif-text">
                                    <h4>PayPal Account</h4>
                                    <p>In order to receive payments</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>












<div class="container _mPS2id-t mPS2id-target mPS2id-target-first mPS2id-target-last" id="section-register">

                                                                        
        <div class="wizard-container" style="margin-bottom: 50px;">
            <div class="card wizard-card" data-color="azzure" id="wizard">
                <div class="wizard-header">
                    <h3>
                        <b>Register</b> and set your account up!<br>
                        <small>2 simple steps to start earning money</small>
                    </h3>
                </div>
                <div class="wizard-navigation">
                    <ul class="nav nav-pills">
                        <li class="active" style="width: 50%;"><a href="#register" data-toggle="tab" id="register_tab" aria-expanded="true">1. Register</a></li>
                        <li style="width: 50%;"><a href="#setup" data-toggle="tab" id="setup_tab">2. Setup</a></li>
                    </ul>
               </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="register">                       


<div class=".alert-danger"></div>
                        <div class="submit-form" style="margin-top: 0px">
                            <div class="row">
                                <form action="{{url('/user/register')}}" id="myForm">
                                      {{ csrf_field() }}

                                     


                                    <div class="col-sm-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-success active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                                                <span class="">50% Complete</span>
                                            </div>
                                        </div>

                                        <div class="alert alert-danger error_box" style="display:none;margin-top: 20px">
                                            <h4 style="background: url('/img/cancel.png') no-repeat left center; padding-left: 40px;line-height: 32px;">
                                                Registration Error(s)</h4>
                                            <div class="msg"></div>
                                        </div>
                                        <div class="alert alert-success success_box" style="display:none;">
                                            <strong>Thank you!</strong>
                                            <div class="msg">We will contact you with more information as soon as possible! You can navigate to your
                                                <a href="/dashboard">dashboard</a> to check your account status.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-box">
                                            <label>Name Shown on Facebook Profile</label>
                                            <input type="text" placeholder="Full Name" name="name" required="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-box">
                                            <label>Email</label>
                                            <input type="email" placeholder="i.e. john@gmail.com" name="email" required="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-box">
                                            <label>Password</label>
                                            <input type="password" name="password" minlength="6" required="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-box">
                                            <label>Confirm Password</label>
                                            <input type="password" name="password_confirmation" minlength="6" required="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-box">
                                            <label>PayPal Email</label>
                                            <input type="text" placeholder="Account to send your payments to" name="paypal_email" required="">
                                        </div>
                                    </div>

                                    @if(!empty( Request::segment(2) ))
                                    <input type="hidden" name="refer_by" value=" {{ Request::segment(2) }}">
                                    @endif


                          

                                    <div class="col-sm-6">
                                        <div class="input-box">
                                            <label>Mobile Phone (To have support and payment information delivered to you)</label>
                                      <input type="tel" id="phone" name="phone" placeholder="081234 56789" required>
                                        </div>
                                    </div>




                                    <div class="col-sm-12">

                                        <div class="" style="text-align: center">
                                            <input type="checkbox" name="tos">
                                            <span style="font-size: 17px;"> I agree to The  Lemonade Cash Club </span>
                                                <a href="{{url('terms')}}" target="_blank">Terms and Conditions</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <button type="submit" class="button-submit" id="submit_btn_apply">Apply Now</button>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                    <div class="tab-pane" id="setup">
                        <h4 class="info-text"><strong>Almost done</strong><br><br>Please install the extension below to complete account setup</h4>
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1 extensions">
                                <div class="col-sm-8 col-sm-offset-2" id="install_extension">
                                    <a href="https://chrome.google.com/webstore/detail/lemonade-cash-club/bpekabpoknfklnohkifakackdlhbgbch" target="_blank">
                                        <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="" data-original-title="Click to Install Chrome Extension">
                                            <img src=" {{url('frontimages/chrome256.png')}}" alt="" class="icon" style="-webkit-animation: pulse 1s linear 1s infinite;">

                                            <h6>Chrome Extension</h6>
                                        </div>
                                    </a>
                                </div>
                                                                                                                                                                                                                                                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    <section id="mobileMsg">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <div class="alert alert-warning" style="margin-top: 20px">
                        <h2 style="color:#C62828;">We currently support signing up via computers only.
Please visit  Lemonade Cash Club from your PC or Mac.<br><br>Thank you!</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="browserMsg">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-danger" style="margin-top: 20px;padding:70px">
                        <h4 style="background:  {{url('frontimages/cancel.png')}} no-repeat left center; padding-left: 40px;line-height: 32px;">


                            Incompatible Browser</h4>
                        <p style="font-weight: bold">You need to have Google Chrome browser to be able to use our services.<br>Please visit <a target="_blank" href="https://www.google.com/chrome">www.google.com/chrome</a> to install Google Chrome and then visit this page again.<br><br>Thank you!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>



    <footer>
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12"> <span>© Copyright 2019 All Rights Reserved |  Lemonade Cash Club</span><a href="{{url('/terms')}}" class="terms"><span class="terms-icon"> <img src="{{url('frontimages/terms-icon.png')}}"/></span>Terms and Conditions</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
<!--     <iframe width="1" height="1" style="position: absolute;left: 0; top: 0;height:0; width:0;border: none;visibility: hidden;" scrolling="no" frameborder="0" id="pix_ifr"></iframe> -->
 <!--    <script src="secure_asset('front/jquery.min.js') }}"></script> -->
<!--   <script type="text/javascript" src="http://www.jqueryshare.net/cdn/jquery.1.12.4min.js"></script> -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="{{ secure_asset('build/js/intlTelInput.js') }}"></script>
    <script src="{{ secure_asset('front/bootstrap.min.js') }}"></script>
    <script src="{{ secure_asset('front/mobile-detect.js') }}"></script>
    <script src="{{ secure_asset('front/utils.js') }}"></script>  
    <script type="text/javascript" src="{{ secure_asset('front/jquery.bootstrap.wizard.js') }}"></script>
    <script type="text/javascript" src="{{ secure_asset('front/gsdk-bootstrap-wizard.js') }}"></script>


    <!-- Check Device -->







    <!-- Close -->




<script>
  var input = document.querySelector("#phone");
        intlTelInput(input, {
            initialCountry: "auto",
            geoIpLookup: function(success, failure) {
                $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "";
                    success(countryCode);                  
                });
            },
            utilsScript: "{{ secure_asset('build/js/utils.js') }}"
        }); 
</script>




</script>
    @if(Auth::id())
    <script type="text/javascript">
        $( document ).ready(function() {
         $('.wizard-container').show();
                // $('.intl-tel-input').remove();
                reg_wizard.data('bootstrapWizard').show(1);
            });
    </script>
    @endif






 
    <script type="text/javascript">
        var clicky_site_ids = clicky_site_ids || [];
            clicky_site_ids.push(101095301);
            (function() {
                var s = document.createElement('script');
                s.type = 'text/javascript';
                s.async = true;
                s.src = '//static.getclicky.com/js';
                ( document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0] ).appendChild( s );
            })();
            $('#submit_btn_apply').click(function(e){
                e.preventDefault();
            
             var code = $(".selected-flag").attr('title').split(' ').pop(-1) ;                   
                  

                  
                var form = $("#myForm");                
                $.ajax({
                        type:"POST",
                        url:form.attr("action"),
                        data:$("#myForm input").serialize() + "&code=" + code,//only input
                        success: function(data){
                            if(data.errors){
                            jQuery.each(data.errors, function(key, value){
                            jQuery('.alert-danger').show();
                            jQuery('.alert-danger').append('<p>'+value+'</p>');
                        }); 
                        }else{
                             document.cookie = "uid="+data['id'];
                            document.cookie = "ustatus="+data['status'];
                            /*  var login_id = data['id'];

                            localStorage.setItem("login_id", login_id);*/
                            location.reload();
                            
                        }
                       }
                });
            });

    </script>




   

    <script type="text/javascript">
    $(document).on('click','ul.menu li.logoutlog', function (e){      
       
        var url = "{{url('/live')}}";       
        $.ajax({
            url: url,
            type: 'GET',  
                   
            success: function (data) { 

            console.log(data);  
            return false;          

            }
        });


    });
        var userstatus = "@if(isset(Auth::user()->status)) {{Auth::user()->status}} @endif";
        var authId = "{{Auth::id()}}";

                 document.cookie = "authId="+authId;
                 document.cookie = "userstatus="+userstatus;         
                 var getNameCookies = getCookie('authId');



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
                }
</script>


@php
function isMobileDevice() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
@endphp
@if(isMobileDevice())

<script type="text/javascript">
     $( document ).ready(function() {
         $('.wizard-container').hide();
         $('#mobileMsg').show();
         

     });
</script>
   
@endif


</body>