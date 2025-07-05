<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>{{ 'FurDopt |' . $title ?? 'FurDopt' }}</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,100..900;1,9..144,100..900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="{{ asset('favs/favicon.ico') }}">

    <link type="text/css" rel="stylesheet" href="{{ asset('customer/css/swiper-bundle.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('customer/css/selectric.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('customer/css/custom.css') }}">
   
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
     <link type="text/css" rel="stylesheet" href="{{ asset('customer/css/customer-style-v11.css') }}">

    <title>{{ $title ?? 'FurDopt' }}</title>

    @stack('meta')
    <style>
        .displayNone {

            display: none;

        }
    </style>
    <style>
        /* Overlay Background */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        /* Modal Box */
        .modal-content {
            background: white;
            padding: 20px;
            width: 400px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Close Button */
        .close-btn {
            background: red;
            color: white;
            border: none;
            padding: 8px 15px;
            margin-top: 10px;
            cursor: pointer;
        }

        /* Show Modal */
        .show {
            display: flex !important;
        }
    </style>
    
   <!-- Style for landing page-->
    <style>
        .landing-header .main-nav{
            padding-right: 70px; 
            margin: 0 auto;
            width: calc(100% - 161px);
        }
       .landing-header .user-profile-menu {
            margin-left: auto;
            width: 161px;
        }
        
       .landing-header .main-nav ul{
           width: 100%;
           text-align: center;
       }
       .landing-header .main-nav ul li{
           float: none;
       }
        
        
    @media only screen and (min-width: 280px) and (max-width: 991px){
          .landing-header .main-nav{
             width:100%;
             padding-right: 0;
         }
          .landing-header .main-nav ul{
              justify-content: center;
          }
         .landing-header .main-nav ul li:not(:nth-child(2)){
             display: none;
         }
          .landing-header .user-profile-menu{
              width:auto;
          }
     }
   
        
    </style>
    
    @stack('css')
    
    {{-- <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script> --}}
    @livewireStyles
</head>

<body>
 

    <main class="main-wrap">
        <!--  Beginning header section -->


        <header class="header-wrap">
            <div class="common-wrap clear">
                <div class="header-inner">
                    <div class="logo-wrap">
                        <div class="main-logo">
                            <a href="{{ route('f.index') }}"><img src="{{ asset('images') }}/{{ $setting->site_logo }}"
                                    alt="main-logo" /></a>
                        </div>
                        <div class="hamburger">
                            <div></div>
                        </div>
                    </div>
                    <div class="nav-wrap">
                        @auth
                            <nav class="main-nav desk">
                                <ul>
          
                                    <li>
                                        <a href="{{ route('f.search') }}">
                                            <div class="menu-icon">
                                                <i class="jws-icon-head-magnifying-glass"></i>
                                            </div>
                                            <div class="menu-text">Search</div>
                                        </a>
                                    </li>
                                    
                                
                                    
                                    <li>
                                        <a href="{{ route('f.petlisting.add') }}">
                                            <div class="menu-icon">
                                               <i class="plussmall-icon"></i>
                                            </div>
                                            <div class="menu-text">Rehome Your Pet</div>
                                        </a>

                                    <li>
                                        <a href="{{ route('f.match') }}">
                                          
                                            <div class="menu-icon">
                                                <i class="jws-icon-head-heart-child"></i>
                                            </div>
                                            <div class="menu-text">Your Pet Matching</div>
                                        </a>
                                    </li>
                                    <li>
                                        @if(Auth::check())
                                        @php
                                         $countMsg = App\Models\Chatmessage::where('receiver_id', Auth::user()->id)
            ->where('is_seen', 0)
            ->count();
                                        @endphp
                                        @endif
                                        <a href="{{ route('f.chat') }}">
                                            @if($countMsg > 0)
                                             <span class="messageCount">{{$countMsg}}</span>
                                             @endif
                                            <div class="menu-icon">
                                                <i class="jws-icon-chatcircle"></i>
                                            </div>
                                            <div class="menu-text">Messages</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('f.favourite') }}">
                                            <div class="menu-icon">
                                                <i class="jws-icon-heartbeat"></i>
                                            </div>
                                            <div class="menu-text">My favourite</div>
                                        </a>
                                    </li>
                                 

                                </ul>
                            </nav>
                    <nav class="main-nav mobi">
                                <ul>

                                    <li>
                                        <a href="{{ route('f.search') }}">
                                            <div class="menu-icon">
                                                <i class="jws-icon-head-magnifying-glass"></i>
                                            </div>
                                            <div class="menu-text">Search</div>
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="{{ route('f.petlisting.add') }}">
                                            <div class="menu-icon">
                                               <i class="plussmall-icon"></i>
                                            </div>
                                            <div class="menu-text">Rehome</div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('f.match') }}">
                                          
                                            <div class="menu-icon">
                                                <i class="jws-icon-head-heart-child"></i>
                                            </div>
                                            <div class="menu-text">Matching</div>
                                        </a>
                                    </li>
                                    <li>
                                        @if(Auth::check())
                                        @php
                                         $countMsg = App\Models\Chatmessage::where('receiver_id', Auth::user()->id)
            ->where('is_seen', 0)
            ->count();
                                        @endphp
                                        @endif
                                        <a href="{{ route('f.chat') }}">
                                            @if($countMsg > 0)
                                             <span class="messageCount">{{$countMsg}}</span>
                                             @endif
                                            <div class="menu-icon">
                                                <i class="jws-icon-chatcircle"></i>
                                            </div>
                                            <div class="menu-text">Messages</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('f.favourite') }}">
                                            <div class="menu-icon">
                                                <i class="jws-icon-heartbeat"></i>
                                            </div>
                                            <div class="menu-text">Favourite</div>
                                        </a>
                                    </li>

                                </ul>
                            </nav>
                        @endauth

                        <div class="mobile-nav">
                            <div class="mobile-nav-inner">
                                <div class="menu-close">
                                    <img src="svgs/cross.svg" alt="cross" />
                                </div>
                                <div class="nav-logo">
                                    <a href="#"><img src="svgs/Hori-Logo.svg" alt="logo" /></a>
                                </div>
                                <ul>
                                    <li><a href="#">Home</a></li>
                                    <li><a href="#">Category</a></li>
                                    <li><a href="#">Community</a></li>
                                    <li><a href="#">About Us</a></li>
                                </ul>
                            </div>
                        </div>
                        {{-- <div class="upgrade-btn">
                            <a href="{{ route('f.subscription') }}">Upgrade to Premium</a>
                        </div> --}}


                        <!-- User profile container -->
                        @auth
                            <div class="user-profile-menu">
                                <div class="profile-container">
                                    <!--@if (Auth::user()->avatar == null)
    -->
                                    <!--    <img class="profile-img" src="{{ asset('images/deafult.jpg') }}" alt="Profile" />-->
                                <!--@else-->
                                    <!--    <img class="profile-img" src="{{ asset('images') }}/{{ Auth::user()->avatar }}"-->
                                    <!--        alt="Profile" />-->
                                    <!--
    @endif-->
                                    @php
                                        $avatar = Auth::user()->avatar;
                                        $gender = Auth::user()->gender;
                                    @endphp

                                    <img class="profile-img"
                                        src="{{ asset($avatar ? 'images/' . $avatar : ($gender == 'Female' ? 'images/female.jpg' : 'images/deafult.jpg')) }}"
                                        alt="User Avatar">
                                    <div class="profile-menu-info desk">
                                        <h5 class="profile-name">{{ Auth::user()->name }}<i
                                                class="jws-icon-caretdown-1"></i></h5>

                                    </div>
                                </div>
                                <!-- User dropdown menu -->
                                <div class="dropdown-menu">
                                    <ul>
                                        <li class="dropdown-menu-item">
                                            <a href="{{ route('f.profile') }}"><i class="jws-icon-usercircle"></i> My
                                                Profile</a>
                                        </li>
                                        <li class="dropdown-menu-item">
                                            <a href="{{ route('f.petlisting') }}"><i class="jws-icon-usercircle"></i> My
                                                listing</a>
                                        </li>
                                        <li class="dropdown-menu-item">
                                            <a href="{{ route('f.setting') }}"><i class="jws-icon-gear"></i> Settings</a>
                                        </li>
                                         
                                        <li class="dropdown-menu-item">
                                            <a href="{{ route('f.chat') }}"><i class="jws-icon-chatcircledot"></i>
                                                Messages</a>
                                        </li>
                                        
                                     
                                        <li class="dropdown-menu-item">
                                            <a href="{{ route('f.subscription') }}"><i
                                                    class="jws-icon-crownsimple-m"></i>
                                                Buy Spotlight</a>
                                        </li>
                                        <li class="dropdown-menu-item">
                                            <a href="{{ route('f.payment.method') }}">
                                                <img src="{{ asset('customer') }}/svgs/spotlight2.svg" width="26">
                                                My Spotlight</a>
                                        </li>
                                        
                                      
                                        <li class="dropdown-menu-item">
                                            <a href="{{ route('f.logout') }}"><i class="jws-icon-export"></i>Log Out</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @else
                            
                            <div class="profile">
                                  @auth
                            
                        @else
                            
                        @endauth  @auth
                            
                        @else
                            <!--<a href="{{ route('f.login') }}" class="h-cta-link"><i class="messages-icon"></i></a>-->
                            <a href="{{ route('f.login') }}" class="h-cta-link"></a>
                        @endauth
                        <div class="user-menu-dropdown-wrap">
                            <button class="user-menu-dropdown-btn"><i class="icon-user"></i></button><span class="desk" style="color:white">My Account</span> <span class="mobi"> 
                            </span>
                        </div>
                            <div class="user-dropdown-menu">
                                <ul>
                                    @auth
                                    @else
                                        <li class="dropdown-menu-item">
                                            <a href="{{ route('f.login') }}" class="dropdown-menu-link">Log In</a>
                                        </li>
                                        <li class="dropdown-menu-item">
                                            <a href="{{ route('f.register') }}" class="dropdown-menu-link">Sign Up</a>
                                        </li>
                                    @endauth
                                </ul>
                            </div>
                            </div>
                        @endauth
                    </div>
                </div>
                 <div class="header-cta-group">
                    <a href="{{url('/')}}" class="home">Home</a>
                    <a href="{{ route('f.petlisting') }}" class="your-pets">Edit Your Pets</a>
                </div>

                <style>
                    header .header-cta-group {
                        width: 100%;
                        justify-content: space-between;
                        gap: 10px;
                        align-items: center;
                        margin-bottom: 20px;
                        display: none;
                    }

                    header .header-cta-group .home {
                        color: #ffffff;
                        padding: 2px 10px;
                        border-radius: 5px;
                        text-align: center;
                        border: 2px solid #ffffff;
                    }

                    header .header-cta-group .your-pets {
                        color: #ffffff;
                        padding: 2px 10px;
                        border-radius: 5px;
                        text-align: center;
                        border: 2px solid #ffffff;  
                    }
                    @media screen and (max-width: 1024px) {
                        header .header-cta-group {
                            display: flex;
                        }
                    }
                </style>
            </div>
        </header>
        <!-- //End header section -->
        <!-- //End header section -->

        <!-- Beginning main content section -->
        <section class="main-content-wrap">
            {{ $slot }}

        </section>
        <!-- //End main content section -->

        <!-- Beginning footer section -->
        <footer class="footer-wrap">
            <div class="footer-top">
                <div class="common-wrap clear">
                    <div class="footer-inner">
                        <div class="footer-logo">
                            <a href="#"><img src="{{ asset('images') }}/{{ $setting->site_logo }}"
                                    alt="main-logo" /></a>
                        </div>
                        <nav class="footer-nav">
                            <ul>
                                @foreach ($footermenus as $footer)
                                    <li><a href="{{ route('f.page', $footer->slug ?? '') }}">{{ $footer->name }}</a>
                                    </li>
                                @endforeach

                                {{-- <li><a href="{{ route('f.index') }}">Home</a></li>
                                <li><a href="{{ route('f.aboutus') }}">About Us</a></li>
                                <li><a href="{{ route('f.faq') }}">FAQs</a></li> --}}
                                <li><a href="{{ route('f.faq') }}">Faq</a></li>
                                <li><a href="{{ route('f.contactus') }}">Contact Us</a></li>
                                <li><a
                                        href="{{ !empty($privacy->slug) ? route('f.page', $privacy->slug) : route('f.index') }}">Privacy
                                        Policy</a></li>
                                <li><a
                                        href="{{ !empty($terms->slug) ? route('f.page', $terms->slug) : route('f.index') }}">Terms
                                        & Conditions</a></li>
                                <li> <a
                                        href="{{ !empty($cookie->slug) ? route('f.page', $cookie->slug) : route('f.index') }}">Cookie
                                        Policy</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="copyright-wrap">
                <p>Copyright &copy;2025 <span>FurDopt</span>. All Rights Reserved.</p>
            </div>
        </footer>
        <!-- //End main footer section -->
        <div class="close-area"></div>

    </main>

    <script type="text/javascript" src="{{ asset('customer/js/jquery-3.5.1.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('customer/js/jquery.selectric.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('customer/js/swiper-bundle.min.js') }}" defer></script>
    <script src="https://cdn.tiny.cloud/1/54r18qjv1tvr6bsdq72k408rot1v6s1lqye1og16q9ikzkvw/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@2/dist/tinymce-jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('customer/js/common-scripts-v3.js') }}" defer></script>
    {{-- @livewireScriptConfig --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    {{-- @livewireScriptConfig() --}}
   <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


    {{-- <script>
        window.onpageshow = function(event) {
            if (event.persisted) {
                window.location.reload();
            }
        };
    </script>

    <script>
        (function() {
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }

            window.addEventListener("popstate", function() {
                location.reload();
            });
        })();
    </script> --}}


    <script>
        //   tinymce.init({
        //     selector: 'textarea',
        //     plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        //     toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        //   });
    </script>

    @livewireScripts
      @stack('scripts')

</body>

</html>
