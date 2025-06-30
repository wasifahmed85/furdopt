 <!-- Begin main content section -->
 <div class="main-content about-us">
     <!-- Begin Hero section -->
     <section class="hero-wrap" style="background-image: url({{ asset('frontendAssets/img/advertise/hero-bg.png') }});">
         <div class="common-wrap clear">
             <div class="hero-inner">
                 <div class="hero-text">
                     <h1>{{ $page->name }}</h1>
                 </div>
             </div>
         </div>
     </section>
     <!-- End Hero section -->
     <section class="info-content">
         <div class="common-wrap clear">
             {!! $page->descriptions !!}
         </div>
     </section>

 </div>
 <!-- End main content section -->
