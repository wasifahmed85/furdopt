<!-- Begin main content section -->
<div class="main-content faq-content">
    <!-- Begin Hero section -->
    <section class="hero-wrap"
        style="background-image: url({{ asset('frontendAssets/img/advertise/contact-hero-bg.jpg') }}">
        <div class="common-wrap clear">
            <div class="hero-inner">
                <div class="hero-text">
                    <h1>Faq</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero section -->
    <!-- Begin contact content section -->
    <section class="content">
        <div class="common-wrap clear">
            <div class="content-inner">
                <h4>Frequently Asked Questions</h4>
                <p>We created this section to answer the most frequently asked questions you may have when using our
                    platform. Whether you’re an individual user or a professional, we aim to make your experience as
                    simple and enjoyable as possible.</p>
                <p>Here, you’ll find information on account creation, posting ads, security rules, and tips to maximize
                    your chances of success. If you can’t find the answer to your question, feel free to contact us
                    directly through our support form or customer service.</p>
                <p>Your satisfaction is our priority, and we’re here to assist you every step of the way!</p>
                <div class="faq">
                    @foreach ($faqs as $faq)
                        <div class="faq-item">
                            <div class="faq-title">
                                <div class="faq-icon">
                                    <i class="fas fa-plus"></i>
                                    <i class="fas fa-minus"></i>
                                </div>
                                <h4>{{ $faq->title }}</h4>
                                <i class="fas fa-angle-right"></i>
                            </div>
                            <div class="faq-text">
                                <p>{!! $faq->description !!}</p>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- End contact content section -->


</div>
<!-- End main content section -->
