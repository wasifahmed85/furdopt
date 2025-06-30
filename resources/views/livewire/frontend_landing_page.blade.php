@push('css')
 
 <style>
 .landing-header-wrap .logo img{
     width:180px;
 }
 .landing .hero-text{
     max-width: 700px;
 }
    .landing{
        padding-top: 95px;
    }
   .landing .btn {
        margin-top: 30px;
        align-items: center;
        display: flex;
        grid-gap: 5px;
        justify-content: center;
    }
     .landing .btn  .plussmall-icon::before{
        color:#ffffff;
    }
   .landing .btn:hover .plussmall-icon::before{
       color:#2E5A88;
   }
 
     .landing .hero-text{
         background-color: transparent;
         text-align: center;
     }
     .landing .hero-text{
         text-align: left;
     }
     
     .our-story-text .btn:hover .btn .plussmall-icon::before{
         color:#2E5A88;
     }
     
     /*How it work */
     .how-it-works{
         padding: 65px 0;
         background: #041325;
     }
    .how-it-works-inner{
       background-image: linear-gradient(to right, #1cc2d8, #fadd5b);
       border-radius: 30px;
       margin-top:40px;
       padding:30px 0;
    }
     .how-it-works h3{
         color: #ffffff;
         text-align: center;
     }
     .how-it-works-inner{
         display: grid;
         grid-template-columns: repeat(3, 1fr);
         grid-gap: 30px;
     }
     .how-it-work-item{
         text-align: center;
         padding:20px;
     }
     .how-it-work-item img{
         width: 100px;
     }
     
    .how-it-work-item h4{
        margin-top:20px;
    }
    .how-it-work-item p{
        margin-top: 15px;
    }
     
     @media only screen and (min-width: 280px) and (max-width: 768px){
         
          .landing .hero-inner{
         grid-gap: 10px;
     }
     .sign-up-text, .our-story-text, .news-letter-inner, .news-letter-form input:not([type="submit"]){
         text-align: center;
     }
     .news-letter-form-text{
         justify-content: center;
     }
     
    .how-it-works-inner{
        display: block;
    }
    .how-it-work-item{
        padding:20px 10px;
    }
    .how-it-work-item h4{
        margin-top:10px;
    }
    .how-it-work-item p{
        margin-top:5px;
    }
     /*How it works*/
     
    .landing .hero-inner .btn-md {
        font-size: 18px;
        padding: 18px 30px;
    }
     
     
    }
 </style>
 
@endpush
 
 <!-- Begin main content section -->
 <div class="main-content">
     <!-- Begin Hero section -->
     <section class="hero-wrap hp-hero landing">
         <div class="common-wrap  clear">
             <div class="hero-inner">
                 <div class="hero-text">
                     <div class="hero-desc">
                         <h3 class="desk">Need to Find a New Home for Your Pet?</h3>
                         <h3 class="mobi">Need to Find <br>a New Home for Your Pet?</h3>
                         <p>Create your pet’s profile and start finding their perfect match — FREE! Click below to get started.</p>
                         <a href="{{ route('f.petlisting.add') }}" class="btn btn-md btn-secondary"> <i class="plussmall-icon"></i> Give Up a Pet for Adoption </a>
                     </div>
                 </div>
                 <div class="hero-thumb">
    				<img src="{{ asset('frontendAssets/img/home/hero-img-v3.png') }}" alt="hero-image">
    			</div>
             </div>
         </div>
     </section>
     <!-- End Hero section -->
      <!-- Begin how it works section -->
     <section class="how-it-works">
         <div class="common-wrap clear">
             <h3>How it works</h3>
             <div class="how-it-works-inner">
                 <div class="how-it-work-item">
                     <img src="{{ asset('frontendAssets/img/home/listing-2.png') }}" alt="hero-image">
                     <h4>Create a Listing</h4>
                     <p>Tell us about your pet</p>
                 </div>
                 <div class="how-it-work-item">
                     <img src="{{ asset('frontendAssets/img/home/smart-6.png') }}" alt="hero-image">
                     <h4>Smart Matching</h4>
                     <p>Our algorithm connects you with the best adopters.</p>
                 </div>
                 <div class="how-it-work-item">
                     <img src="{{ asset('frontendAssets/img/home/match-3.png') }}" alt="hero-image">
                     <h4>Meet the Perfect match</h4>
                     <p>Message adopters and browse their profiles.</p>
                 </div>
                 <div class="how-it-work-item">
                     <img src="{{ asset('frontendAssets/img/home/finalize-1.png') }}" alt="hero-image">
                     <h4>Finalize the Adoption</h4>
                     <p>Complete the process securely </p>
                 </div>
                 <div class="how-it-work-item">
                     <img src="{{ asset('frontendAssets/img/home/secure-5.png') }}" alt="hero-image">
                     <h4>Secure the Right Home</h4>
                     <p>Find the perfect match for your pet’s needs.</p>
                 </div>
                 <div class="how-it-work-item">
                     <img src="{{ asset('frontendAssets/img/home/safe-4.png') }}" alt="hero-image">
                     <h4>Safe & secure</h4>
                     <p>We ensure, your personal data is safe & secure. </p>
                 </div>
                 
                 
             </div>
         </div>
     </section>
     <!-- End how it works section -->
     <!-- Begin sign-up section -->
		 <seciton class="sign-up-wrap landing-sign-up-wrap">
			<div class="common-wrap clear">
				<div class="dogs-wrap">
					<img src="{{ asset('frontend/img/home/Top-Pets.png') }}" alt="">
				</div>
				<div class="sign-up landing-sign-up">
					<div class="sign-up-text">
						<h2>🚀 We are launching soon. <br> Start the journey today, <br> It’s free to list your pet on FurDopt.</h2>
						<p>We know it’s never an easy decision - but finding the perfect fit can make all the difference.</p>
					</div>
					
					 @auth
                            <a href="{{ route('f.petlisting.add') }}" class="btn btn-secondary btn-md"> <i class="plussmall-icon"></i>
                               List Your Pet For Rehome</a>
                        @else
                           <a href="{{ route('f.register') }}" class="btn btn-secondary btn-md"> <i class="plussmall-icon"></i> List Your Pet for Rehome Free</a>
                        @endauth
					
				</div>
			</div>
		 </seciton>
		<!-- End sign-up section -->
		
		
		<!--  Begin Our Story section -->
		  <section class="our-story landing-our-story">
			<div class="common-wrap clear">
				<div class="our-story-grid">
					<div class="our-story-text">
						<P>We know how much your pet means to you — and finding them the right home is everything.</P>
						<P>We’re building a kind, trusted space to help you gently rehome your pet to someone who’s truly the right fit.</P>
						<P>Whether you’re rehoming a dog, cat, rabbit, hamster or any other pet, you’re welcome here.</P>
						<P>Submit your pet’s details today and join our early access list. Once we launch, your listing will be among the first seen by loving adopters looking for a perfect match!</P>
						<a href="{{ route('f.petlisting.add') }}" class="btn btn-md btn-secondary"> <i class="plussmall-icon"></i> I Need to Rehome my Pet! </a>
					</div>
					<div class="our-story-thumb">
						<img src="{{ asset('frontendAssets/img/home/our-story-v5.png')}}" alt="">
					</div>
				</div>
			</div>
		  </section>
		<!--  End Our Story section -->
		  <!-- Beging newsletter section -->
		   <section class="news-letter">
			<div class="common-wrap clear">
				<div class="dogs-wrap">
					<img src="{{ asset('frontend/img/home/Top-Subscribe.png')}}" alt="">
				</div>
				<div class="news-letter-inner">
					<div class="news-letter-text">
						<h2>Stay updated with us!</h2>
						<p> Register here for the latest updates regarding pet adoption & rehome.</p>
					</div>
					<div class="news-letter-form-wrap">
						<div class="news-letter-arrow">
							<img src="{{ asset('frontend/svgs/newsletter-arrow.svg')}}" alt="">
						</div>
						<form wire:submit="newSubcriber" class="form news-letter-form">
							<div class="form-row">
								<input type="email" placeholder="Enter full email address" wire:model="email">
								<input type="submit" class="btn btn-secondary" value="Subscribe">
								 @error('email') <span class="error">{{ $message }}</span> @enderror 
							</div>
							 <p style="margin-top:10px">{{$success}}</p>
							<div class="news-letter-form-text">
							   
								<img src="{{ asset('frontend/svgs/newsletter-checkmark.svg')}}" alt="">
								<p> Join the most trusted pet newsletter in the UK.</p>
							</div>
						</form>
					</div>
				</div>
			</div>
		   </section>
		  <!-- End newsletter section -->
 </div>
 <!-- End main content section -->


 
@push('scripts')
 

   <!--<script>-->
   <!-- document.addEventListener('livewire:load', function () {-->
   <!--     $('#select22').select2({-->
   <!--         placeholder: 'Select breed',-->
   <!--         allowClear: true-->
   <!--     });-->

   <!--     Livewire.on('breedUpdated', function () {-->
   <!--         $('#select22').select2('destroy');-->
   <!--         $('#select22').select2({-->
   <!--             placeholder: 'Select breed',-->
   <!--             allowClear: true-->
   <!--         });-->
   <!--     });-->
   <!-- });-->
   <!-- </script>-->







<script>

    $(document).ready(function() {
        

           $('#select2').select2({
            matcher: function(params, data) {
                // If there is no search term, return all data
                if ($.trim(params.term) === '') {
                    return data;
                }

                // Check if the text starts with the typed term (case insensitive)
                if (data.text.toLowerCase().startsWith(params.term.toLowerCase())) {
                    return data;
                }

                // Otherwise, return null (don't show the result)
                return null;
            }
        });

        $('#select2').on('change', function (e) {

            var data = $('#select2').select2("val");

            @this.set('location', data);

        });
       

    });
    
  

</script>
<script>
    document.addEventListener('livewire:init', () => {
       
        function initializeSelect2() {
          $('#select22').select2({
            matcher: function(params, data) {
                // If there is no search term, return all data
                if ($.trim(params.term) === '') {
                    return data;
                }

                // Check if the text starts with the typed term (case insensitive)
                if (data.text.toLowerCase().startsWith(params.term.toLowerCase())) {
                    return data;
                }

                // Otherwise, return null (don't show the result)
                return null;
            }
        });
                
            // Dispatch Livewire event on change
            $('#select22').on('change', function () {
                const selectedValue = $(this).val();

                @this.set('breedId', selectedValue);
            });
        }

        initializeSelect2();

        Livewire.hook('morphed',  ({ el, component }) => {
            // Runs after all child elements in `component` are morphed
            // console.log($('#select22').html());
            initializeSelect2();
             
            
        })
    });
</script>

@endpush
