<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0, user-scalable=no" />
    <meta name="format-detection" content="telephone=no" />

    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,100..900;1,9..144,100..900&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('favs/favicon.ico') }}">
    <meta charset="utf-8">

    <meta name="format-detection" content="telephone=no">
    <title>FurDopt | {{ $title ?? 'Furdopt' }}</title>

    @stack('meta')

    <link type="text/css" rel="stylesheet" href="{{ asset('frontendAssets/css/selectric.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('frontendAssets/css/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />



    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link type="text/css" rel="stylesheet" href="{{ asset('frontendAssets/css/style-v21.css') }}" />
    <!--<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>-->
    <!--  <link-->
    <!--  rel="stylesheet"-->
    <!--  href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/base.min.css"-->
    <!--/>-->
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slim-select/dist/slimselect.min.css">-->
    <style>
        .displayNone {

            display: none;

        }

        .landing-header-wrap {
            position: absolute;
            width: 100%;
            left: 0;
            top: 0;
            z-index: 999;
            background-color: transparent;
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
            width: 600px;
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
    @stack('css')
    @livewireStyles
</head>

<body>

    <main class="main-wrap">
        <!--  Beginning header section -->

        <!-- //End header section -->
        <!--  Beginning header section -->
        <header class="header-wrap landing-header-wrap">
            <div class="common-wrap clear">
                <div class="header-inner">
                    <div class="header-left">
                        <!--<div class="menu-icon">
                            <i class="h-menu-icon"></i>
                        </div>-->
                        <div class="logo">
                            <a href="{{ route('f.index') }}"><img src="{{ asset('images') }}/{{ $setting->site_logo }}"
                                    alt="logo" /></a>
                        </div>
                        <!-- main navbar -->
                        <!-- <div class="main-nav-wrap">
                            <nav class="main-nav">
                                <span class="close-btn" id="closeBtn"><i class="nav-close-icon"></i></span>
                                <div class="nav-menu ">
                                    <div class="nav-menu-item">
                                        <ul>
                                            <li>
                                                <h6>category</h6>
                                                <ul class="sub-nav">
                                                    @foreach ($categories as $cat)
<li><a href="{{ route('f.filter', ['searchCategory' => $cat->id]) }}"
                                                                wire:navigate>{{ $cat->name }}</a>
                                                        </li>
@endforeach
                                                </ul>
                                            </li>

                                            @foreach ($headermenus as $header)
<li><a href="{{ route('f.page', $header->slug) }}"
                                                        wire:navigate>{{ $header->name }}</a></li>
@endforeach

                                            {{-- <li><a href="{{ route('f.faq') }}" wire:navigate>FAQ</a></li>
                                            <li><a href="#">Support</a></li>
                                            <li><a href="{{ route('f.advert') }}" wire:navigate>Why advertise with
                                                    us</a></li> --}}
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>-->
                    </div>
                    <div class="header-right landing-header">
                        @auth
                        @else
                            <a href="{{ route('f.login') }}" class="h-cta-link"><i class="messages-icon"></i></a>
                        @endauth
                        <div class="user-menu-wrap">
                            <button class="user-menu-dropdown-btn"><i class="icon-user"></i></button><span
                                class="desk" style="color:#2E5A88;">My Account</span> <span class="mobi"></span>

                            <div class="user-dropdown-menu">
                                <ul>
                                    @auth
                                        <li class="dropdown-menu-item">
                                            <a href="{{ route('f.profile') }}" class="dropdown-menu-link">Dashboard</a>
                                        </li>
                                        <li class="dropdown-menu-item">
                                            <a href="{{ route('f.logout') }}" class="dropdown-menu-link">Log out</a>
                                        </li>
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

                        @auth
                            <a href="{{ route('f.petlisting.add') }}" class="new-advert-btn"><i class="plussmall-icon"></i>
                                <span class="desk">Rehome Your Pet

                                </span> <span class="mobi">Rehome Your Pet
                                </span></a>
                        @else
                            <a href="{{ route('f.register') }}"class="new-advert-btn"><i class="plussmall-icon"></i>
                                <span class="desk">Rehome Your Pet
                                </span> <span class="mobi">Rehome Your Pet
                                </span></a>
                        @endauth
                    </div>
                </div>
            </div>
        </header>
        <!-- //End header section -->

        <!-- Begin main content section -->
        {{ $slot ?? '' }}
        <!-- End main content section -->
        <!-- Beginning footer section -->
        <footer class="footer-wrap">
            <div class="common-wrap clear">
                <div class="footer-logo">
                    <a href="#"><img src="{{ asset('images') }}/{{ $setting->site_logo }}" alt="logo"></a>
                </div>
                <!--<div class="footer-widget">-->
                <!--	<div class="footer-widget-item">-->
                <!--		<ul>-->
                <!--			<li><a href="#">Dogs and Puppies For Sale</a></li>-->
                <!--			<li><a href="#">Cocker Spaniel for sale</a></li>-->
                <!--			<li><a href="#">Cockapoo for sale</a></li>-->
                <!--			<li><a href="#">Labrador Retriever for sale</a></li>-->
                <!--			<li><a href="#">German Shepherd for sale</a></li>-->
                <!--			<li><a href="#">French Bulldog for sale</a></li>-->
                <!--			<li><a href="#">Dachshund for sale</a></li>-->
                <!--			<li><a href="#">Cavapoo for sale</a></li>-->
                <!--		</ul>-->
                <!--	</div>-->
                <!--	<div class="footer-widget-item">-->
                <!--		<ul>-->
                <!--			<li><a href="#">Cats and Kittens For Sale</a></li>-->
                <!--			<li><a href="#">Maine Coon for sale</a></li>-->
                <!--			<li><a href="#">British Shorthair for sal</a></li>-->
                <!--			<li><a href="#">Ragdoll for sale</a></li>-->
                <!--			<li><a href="#">Bengal for sale</a></li>-->
                <!--			<li><a href="#">Sphynx for sale</a></li>-->
                <!--			<li><a href="#">Persian for sale</a></li>-->
                <!--			<li><a href="#">Savannah for sale</a></li>-->
                <!--		</ul>-->
                <!--	</div>-->
                <!--	<div class="footer-widget-item">-->
                <!--		<h6>Other Popular Pages</h6>-->
                <!--		<ul>-->
                <!--			<li><a href="#">Dogs For Sale In London</a></li>-->
                <!--			<li><a href="#">Dogs For Sale In Manchester</a></li>-->
                <!--			<li><a href="#">Dogs For Sale In Birmingham</a></li>-->
                <!--			<li><a href="#">Cats For Sale In London</a></li>-->
                <!--			<li><a href="#">Cats For Sale In Manchester</a></li>-->
                <!--			<li><a href="#">Cats For Sale In Birmingham</a></li>-->
                <!--			<li><a href="#">Dog Adoption In The UK</a></li>-->
                <!--		</ul>-->
                <!--	</div>-->
                <!--	<div class="footer-widget-item">-->
                <!--		<h6>Information</h6>-->
                <!--		<ul>-->
                <!--			<li><a href="#">About us</a></li>-->
                <!--			<li><a href="#">Privacy Policy</a></li>-->
                <!--			<li><a href="#">Support</a></li>-->
                <!--			<li><a href="#">Press</a></li>-->
                <!--			<li><a href="#">Terms & Conditions</a></li>-->
                <!--			<li><a href="#">Why advertise with us</a></li>-->
                <!--			<li><a href="#">Sell your dogs</a></li>-->
                <!--			<li><a href="#">Sell your kittens</a></li>-->
                <!--		</ul>-->
                <!--	</div>-->
                <!--	<div class="footer-widget-item">-->
                <!--		<div class="social-wrap">-->
                <!--			<a href="#" class="social-icon"><i class="facebook-icon"></i></a>-->
                <!--			<a href="#" class="social-icon"><i class="instagram-icon"></i></a>-->
                <!--		</div>-->
                <!--	</div>-->
                <!--</div>-->
                <div class="footerbrands">
                    <h6>Information:</h6>
                    <div class="footer-brands-nav">
                        <ul>
                            @foreach ($footermenus as $footer)
                                <li><a href="{{ route('f.page', $footer->slug ?? '') }}">{{ $footer->name }}</a>
                                </li>
                            @endforeach

                            {{-- <li><a href="{{ route('f.aboutus') }}" wire:navigate>About us</a></li>
                            <li><a href="{{ route('f.faq') }}" wire:navigate>FAQ</a></li>
                            <li><a href="{{ route('f.contactus') }}" wire:navigate>Support</a></li>
                            <li><a href="{{ route('f.advert') }}" wire:navigate>Why advertise with us</a></li> --}}

                            <li><a href="{{ route('f.faq') }}">Faq</a></li>
                            <li><a href="{{ route('f.contactus') }}">Contact Us</a></li>


                        </ul>
                    </div>
                </div>
                <div class="footer-desc">
                    <p>{{ $setting->site_name ?? '' }} use cookies on this site to enhance your user experience. Use of
                        this website and other services constitutes acceptance of the {{ $setting->site_name ?? '' }}
                        <a href="{{ !empty($terms->slug) ? route('f.page', $terms->slug) : route('f.index') }}"
                            wire:navigate>Terms of Conditions</a> and
                        <a href="{{ !empty($privacy->slug) ? route('f.page', $privacy->slug) : route('f.index') }}"
                            wire:navigate>Privacy</a> and
                        <a href="{{ !empty($cookie->slug) ? route('f.page', $cookie->slug) : route('f.index') }}">Cookie
                            Policy</a> . You can at any time.
                    </p>

                </div>
                <div class="copyright-wrap">
                    <p>Copyright &copy;2025 <span>{{ $setting->site_name ?? '' }}</span>. All Rights Reserved.
                        Developed by <a href="https://websgoal.com/" target="_blank" style="color:#fff">Websgoal</a>
                    </p>
                    <div class="social-wrap">
                        <a href="{{ $setting->facebook }}" target="_blank" class="social-icon"><i
                                class="facebook-icon"></i></a>
                        <a href="{{ $setting->instagram }}" target="_blank" class="social-icon"><i
                                class="instagram-icon"></i></a>
                    </div>
                </div>
            </div>

        </footer>
        <!-- //End main footer section -->
    </main>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <!--<script type="text/javascript" src="{{ asset('frontendAssets/js/jquery-3.5.1.min.js') }}"></script>-->
    <script type="text/javascript" src="{{ asset('frontendAssets/js/jquery.selectric.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('frontendAssets/js/swiper-bundle.min.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
    <script type="text/javascript" src="{{ asset('frontendAssets/js/common-script-v2.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <!-- Include Choices JavaScript (latest) -->
    <!--<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>-->

    <!--<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>-->

    <!--<script src="https://cdn.jsdelivr.net/npm/slim-select/dist/slimselect.min.js"></script>-->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Fancybox.bind("[data-fancybox]", {
                Toolbar: {
                    display: ["counter", "fullscreen", "close"]
                }
            });
        });
    </script>
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
    @livewireScripts
    @stack('scripts')

</body>

</html>
