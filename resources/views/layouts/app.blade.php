<head>
    <meta charset="utf-8">
    <title>Lemonade Cash Club</title>
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="{{ secure_asset('frontimages/favi.png') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="/img/favicon/apple-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/img/favicon/apple-icon-114x114.png">
    <!-- Bootstrap v3.3.4 Grid Styles-->

     <style>
          .logo img {
    width: 195%;
    height: 100px;
}
    </style>

    <style></style><!-- Load CSS & WebFonts Main Function-->
    <link rel="stylesheet" href="{{ secure_asset('users/grid.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('users/custom.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('users/min.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('users/header.min.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('users/main.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"
          integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">




    <style>
        #browserMsg, #mobileMsg {
            display: none;
        }
    </style>
    <link rel="stylesheet" href="{{ secure_asset('front/intlTelInput.css') }}">
    <style>
        .iti-flag {
            background-image: url("{{url('/frontimages/flags.png')}}");
        }

        .intl-tel-input {
            width: 100%;
        }

        .intl-tel-input .country-list {
            width: 350px;
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

<script type="text/javascript" async="" src="//static.getclicky.com/js"></script></head>
<body>
    <p style="display:none">https://chrome.google.com/webstore/detail/the-bucks-club/dkanffljhjlldkmeinnhgfijicjkihho</p>
    <header>
        <div class="container">
            <div class="header-top-wrapper">
                <div class="row">
                    <div class="col-xs-12 col-sm-5 col-md-3 col-lg-3 text-center">
                        <div class="logo">
                            <a href="javascript:void(0)">
                                <img src="{{url('frontimages/logo_fbd.png')}}" alt="The Bucks Club">
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-7 col-md-9 col-lg-9">
                        <ul class="menu">
                            <li><a href="{{url('/')}}">Home</a>
                            </li>
                            <li><a class="page-scroll _mPS2id-h" href="{{url('/')}}">About</a>
                            </li>
                            <li><a class="page-scroll _mPS2id-h" href="{{url('/')}}">How it works</a>
                            </li>

                            <li>@if(Auth::id()) <a href="{{url('/dashboard')}}" class="active">Dashboard</a> @else 
                                <a href="{{url('/')}}" class="active">Register</a>@endif
                            </li>

                            <li> @if(Auth::id()) <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                                    Logout</a> @else <a href="{{url('login')}}">Login</a> @endif
                                     <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </header>



    @yield('content')



     <footer>
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12"> <span>© Copyright @php echo date('Y'); @endphp All Rights Reserved | The Bucks Club</span><a href="/terms" class="terms"><span class="terms-icon"></span>Terms and Conditions</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <iframe width="1" height="1" style="position: absolute;left: 0; top: 0;height:0; width:0;border: none;visibility: hidden;" scrolling="no" frameborder="0" id="pix_ifr"></iframe>
    <script src="{{ secure_asset('front/jquery.min.js') }}"></script>
    <script src="{{ secure_asset('front/bootstrap.min.js') }}"></script>
    <script src="{{ secure_asset('front/mobile-detect.js') }}"></script>
    <script src="{{ secure_asset('front/utils.js') }}"></script>
    <script src="{{ secure_asset('front/intlTelInput.js') }}"></script>
    <script type="text/javascript" src="{{ secure_asset('front/jquery.bootstrap.wizard.js') }}"></script>
    <script type="text/javascript" src="{{ secure_asset('front/gsdk-bootstrap-wizard.js') }}"></script>

    @if(Auth::id())
    <script type="text/javascript">
         $('.wizard-container').show();
                $('.intl-tel-input').remove();
                reg_wizard.data('bootstrapWizard').show(1);
    </script>
    @endif
    <script>

    

        var telInput = $("#phone_number");
            window._ifr = (function(){
              var _ifr = '{&quot;1&quot;:&quot;https:\/\/novamemes.com\/thanks\/index.html&quot;,&quot;2&quot;:&quot;https:\/\/redeyedpeas.com\/thanks\/index.html&quot;,&quot;3&quot;:&quot;https:\/\/thegrowntroll.com\/thanks\/index.html&quot;,&quot;4&quot;:&quot;https:\/\/casualmaven.com\/thanks\/index.html&quot;,&quot;5&quot;:&quot;https:\/\/publishprime.com\/thanks\/index.html&quot;,&quot;6&quot;:&quot;https:\/\/adagionews.com\/thanks\/index.html&quot;,&quot;7&quot;:&quot;https:\/\/boomfact.com\/thanks\/index.html&quot;,&quot;8&quot;:&quot;https:\/\/tenaciousair.com\/thanks\/index.html&quot;,&quot;9&quot;:&quot;https:\/\/devotednova.com\/thanks\/index.html&quot;,&quot;10&quot;:&quot;https:\/\/velleityportal.com\/thanks\/index.html&quot;}'.replace(/&amp;/g, "&") .replace(/&lt;/g, "<") .replace(/&gt;/g, ">") .replace(/&quot;/g, '"') .replace(/&#039;/g, "'");
              return JSON.parse(_ifr);
            })();
            $(function () {
                        $('.wizard-container').show();
                $('.intl-tel-input').remove();
                reg_wizard.data('bootstrapWizard').show();
        
                
                // Check for mobile userAgent
                var md = new MobileDetect(window.navigator.userAgent);
                var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
        
                if (md.mobile()) {
                    $(".wizard-container").hide();
                    $("#mobileMsg").show();
                }
                else if (!isChrome) {
                    $('.wizard-container').hide();
                    $("#browserMsg").show();
                }
        
        
                telInput.intlTelInput({
                    // do not uncomment next line, loading it here causes issues with chrome , load it from popup.html instead
                    // utilsScript: "intelphone/js/utils.js",
                    initialCountry: 'auto',
                    geoIpLookup: function (callback) {
                        $.get("https://ipinfo.io", function () {
                        }, "json").always(function (resp) {
                            var countryCode = (resp && resp.country) ? resp.country : "";
                            callback(countryCode);
                        });
                    }
                });
        
        
            });
        
            //var registration_url = "http://thebucks.club/register";
            var scr = {
                "scripts": [
                    {"src": "js/libs.min.js", "async": false},
                    {"src": "js/main.min.js", "async": false}
                ]
            };
            !function (t, n, r) {
                "use strict";
                var c = function (t) {
                    if ("[object Array]" !== Object.prototype.toString.call(t)) return !1;
                    for (var r = 0; r < t.length; r++) {
                        var c = n.createElement("script"), e = t[r];
                        c.src = e.src, c.async = e.async, n.body.appendChild(c)
                    }
                    return !0
                };
                t.addEventListener ? t.addEventListener("load", function () {
                    c(r.scripts);
                }, !1) : t.attachEvent ? t.attachEvent("onload", function () {
                    c(r.scripts)
                }) : t.onload = function () {
                    c(r.scripts)
                }
            }(window, document, scr);
    </script>
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

            // $('#submit_btn_apply').click(function(e){
            //     e.preventDefault();
            //     var form = $("#myForm");
            //     $.ajax({
            //         type:"POST",
            //         url:form.attr("action"),
            //         data:$("#myForm input").serialize(), //only input
            //         success: function(data){
            //             console.log(data);
            //             if(data.errors){
            //                     jQuery.each(data.errors, function(key, value){
            //                     jQuery('.alert-danger').show();
            //                     jQuery('.alert-danger').append('<p>'+value+'</p>');
            //                  });
            //             }else{
            //                console.log(data.success);
            //                // localStorage.setItem("login_id", login_id);
            //                // location.reload();
            //             }
            //        }
            //     });
            // });

    </script>
    <noscript>
        <p>
            <img alt="Clicky" width="1" height="1" src="//in.getclicky.com/101095301ns.gif" />
        </p>
    </noscript>
    <script src="js/libs.min.js"></script>
    <script src="js/main.min.js"></script>
    <script type="text/javascript" async="" src="http://in.getclicky.com/in.php?site_id=101095301&amp;type=pageview&amp;href=%2F&amp;title=The%20Bucks%20Club&amp;res=1366x768&amp;lang=en&amp;jsuid=4022125248&amp;mime=js&amp;x=0.9471528847512685"></script>
</body>