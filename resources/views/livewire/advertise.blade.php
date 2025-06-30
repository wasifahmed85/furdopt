<div class="main-content advertise-content">
    <!-- Begin Hero section -->
    <section class="hero-wrap"
        style="background-image: url({{ asset('frontendAssets/img/home/advertise-hero-bg.png') }});">
        <div class="common-wrap clear">
            <div class="hero-inner">
                <div class="hero-text">
                    <h1>Advertise your pets on FurDopt</h1>
                    <p>The opportunity for you to ask the matched user as many questions as you like, to find out if
                        their pet is the FurDopt match for yours</p>
                    @auth
                        <a href="{{ route('f.petlisting') }}" class="btn btn-primary large">Sign up and create your ad</a>
                    @else
                        <a href="{{ route('f.login') }}" class="btn btn-primary large">Sign up and create your ad</a>
                    @endauth

                </div>
            </div>
        </div>
    </section>
    <!-- End Hero section -->
    <!--  Begin advertise section -->
    <section class="advertise">
        <div class="common-wrap clear">
            <h2>Advertise your pets with us</h2>
            <div class="advertise-card-wrap">
                <div class="advertise-card">
                    <div class="advertise-card-icon">
                        <i class="ti-icon ti-heart"></i>
                    </div>
                    <h4>Pet safety first</h4>
                    <p>Strong pet welfare, licence checks, 24/7 moderation, ID verified users, and much more!</p>
                </div>
                <div class="advertise-card">
                    <div class="advertise-card-icon">
                        <i class="ti-icon ti-control-forward"></i>
                    </div>
                    <h4>Rehome quickly</h4>
                    <p>FurDopt is the number one place for pet buyers in the UK. Need to rehome faster? Boost your
                        adverts!</p>
                </div>
                <div class="advertise-card">
                    <div class="advertise-card-icon">
                        <i class="ti-icon ti-face-smile"></i>
                    </div>
                    <h4>Simple to use</h4>
                    <p>Upload ads in minutes, vet buyers through chat, and accept seamless payments on-site</p>
                </div>
            </div>

        </div>
    </section>
    <!-- End advertise section -->

</div>
