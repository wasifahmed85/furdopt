 <!-- Begin main content section -->
 <div class="main-content">
     <!-- Begin Hero section -->
     <section class="hero-wrap hp-hero">
         <div class="common-wrap  clear">
             <div class="hero-inner">
                 <div class="hero-text">
                     <div class="hero-desc">
                         <h3>Adopt Your Perfect Pet!</h3>
                         <p>Find a Pet that Suits your Lifestyle and Give them a Second Chance at Love! Explore Rescue centres and Individuals who are Rehoming.</p>
                     </div>
                     <div class="search-container">
                         <form wire:submit.prevent="search">
                             <div class="search-items">
                                 <div class="search-item {{ $categoryId == 1 ? 'active' : '' }}" wire:click="selectCategoryCat({{1}})">
                                     <img src="{{ asset('frontendAssets/img/home/dogs.png') }}" alt="dogs-image">
                                     <!--<i class="dog-icon"></i>-->
                                     <span>Dogs</span>
                                 </div>
                                 <div class="search-item {{ $categoryId == 3 ? 'active' : '' }}" wire:click="selectCategoryCat({{3}})">
                                     <img src="{{ asset('frontendAssets/img/home/cats.png') }}" alt="cats-image">
                                     <!--<i class="cat-icon"></i>-->
                                     <span>Cats</span>
                                 </div>
                                 <div class="search-item {{ !in_array($categoryId, ['1', '3']) ? 'active' : '' }}" id="other-search" >
                                     <i class="categories-icon"></i>
                                     <span id="search-name">Other</span>
                                     <ul class="search-dropdown">
                                         
                                         @foreach ($categories as $cat)
                                             <li wire:click="selectCategoryCat({{ $cat->id }})">{{ $cat->name }}</li>
                                         @endforeach
                                         
                                     </ul>
                                 </div>
                             </div>
                             

   @if(count($breeds) > 0)
    <div>
        <select class="searchLocation select22" id="select22">
            <option value="" disabled selected>Select breed</option>
            @foreach ($breeds as $breed)
                <option value="{{ $breed->id }}">{{ $breed->name }}</option>
            @endforeach
        </select>
    </div>
@endif




                  
                  {{--
                               <select class="searchLocation" wire:model="breedId" id="select22">
                                  
                                 <option value="" disabled selected>Select breed</option>
                               
                                 @foreach ($breeds as $breed)
                                     <option value="{{ $breed->id }}">{{ $breed->name }}</option>
                                 @endforeach
                          
                             </select>
                          
                     --}}      
                             <!--<div class="search-box">-->
                             <!--    <input type="text" wire:model.live="searchBread">-->
                             <!--</div>-->
                            
                             
                             
                             <div class="location-container location" wire:ignore>
                               
                                  <select class="form-control" wire:model="location" id="select2">
                                 <option value="" disabled selected>Select Location</option>
                                 @foreach ($cities as $city)
                                     <option value="{{ $city->id }}">{{ $city->state }}</option>
                                 @endforeach
                             </select>
                             <!--<div class="search-box">-->
                             <!--    <input type="text" wire:model.live="searchCity">-->
                             <!--</div>-->
                             
                                 <!--<div class="location-icon">-->
                                 <!--    <i class="search-icon"></i>-->
                                 <!--</div>-->
                                 @if(Auth::check())
                                <button class="search-button" type="submit">Find your match</button>
                                 @else
                                 
                                 <a class="search-button" href="{{route('f.login')}}">Find your match</a></a>
                                 @endif
                             </div>
                         </form>
                     </div>
                 </div>
                 <div class="hero-thumb">
    				<img src="{{ asset('frontendAssets/img/home/hero_img.png') }}" alt="hero-image">
    			</div>
             </div>
         </div>
     </section>
     <!-- End Hero section -->
     <!-- Begin sign-up section -->
		 <seciton class="sign-up-wrap">
			<div class="common-wrap clear">
				<div class="dogs-wrap">
					<img src="{{ asset('frontend/img/home/Top-Pets.png') }}" alt="">
				</div>
				<div class="sign-up">
					<div class="sign-up-text">
						<h2>I need to rehome my pet!</h2>
						<p>Start the process. It's free to list your pet on MyPawrent.</p>
					</div>
					
					 @auth
                            <a href="{{ route('f.petlisting.add') }}" class="btn btn-secondary btn-md"> <i class="plussmall-icon"></i>
                               List Your Pet For Rehome</a>
                        @else
                           <a href="{{ route('f.register') }}" class="btn btn-secondary btn-md"> <i class="plussmall-icon"></i> List Your Pet For Rehome</a>
                        @endauth
					
				</div>
			</div>
		 </seciton>
		<!-- End sign-up section -->
		
		 <div class="gallery-wrap sport-light">
		        <div class="common-wrap clear">
		           <h3>Spotlighted Pets</h3>

                      <div class="gallery-grid">

                          @foreach ($spots as $pet)
                              <div class="gallery-card">
                                  <div class="gallery-thumb">
                                      <a href="{{ route('f.detail', $pet->slug) }}"> <img
                                              src="{{ asset('images/' . $pet->thumbnail) }}" alt=""></a>
                                    
                                      <div class="button-action">
                                          <a href="{{ route('f.single.chat', $pet->owner_id) }}" class="sent-msg"><i
                                                  class="jws-icon-chatcircledots"></i>Message now!</a>
                                          <!--<a href="#" class="like-heart"><i class="jws-icon-heart"></i> 80%</a>-->

                                          @if (Auth::check())
                                              @if ($pet->likes()->where('user_id', auth()->user()->id)->exists())
                                                  <a class="like-heart"><i
                                                          class="jws-icon-heart jws-icon-heart-select"></i></a>
                                              @else
                                                  <a wire:click="petLikes({{ $pet->id }})" class="like-heart"><i
                                                          class="jws-icon-heart"></i></a>
                                              @endif
                                          @else
                                              <a wire:click="petLikes({{ $pet->id }})" class="like-heart"><i
                                                      class="jws-icon-heart"></i></a>
                                          @endif

                                      </div>
                                  </div>
                                  <div class="gallery-card-text">

                                      <a href="{{ route('f.detail', $pet->slug) }}"
                                          class="gallery-card-name">{{ $pet->name }}</a>
                                      <div class="seller-info">
                                          <div class="seller-icon-wrap">
                                              <i class="seller-icon"></i>
                                          </div>
                                          <h6 class="seller-name">{{ $pet->user->name ?? '' }}</h6>
                                          <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->

                                      </div>
                                      <div class="gallery-card-time">
                                          <i class="time-icon"></i>
                                          <p>{{ $pet->created_at->diffForHumans() }}</p>
                                      </div>
                                      <div class="member-info">
                                          <div class="member-info-inner">
                                              <i class="locations-icon"></i>
                                              <p>{{ $pet->state->state ?? '' }}, Uk</p>
                                          </div>
                                          <span>£{{ $pet->price }}</span>
                                      </div>
                                  </div>
                              </div>
                          @endforeach

                      </div>
                      </div>
                  </div>
		<!--  Begin Our Story section -->
		  <section class="our-story">
			<div class="common-wrap clear">
				<div class="our-story-grid">
					<div class="our-story-text">
						<P>MyPawrent is a free, easy-to-use platform dedicated to helping pets find their perfect forever homes. Whether a pet is in a rescue, shelter, or with an individual who can no longer care for them, we believe every pet deserves a loving family that suits their needs and lifestyle.</P>
						<P>We go beyond just rehoming—we focus on matching pets with adopters based on their lifestyle, needs, and expectations. Whether it’s an energetic pup needing an active owner, a senior cat looking for a quiet home, or a family searching for the perfect furry companion, MyPawrent ensures the right fit for both the pet and the adopter.</P>
						<P>For individuals looking to rehome their beloved pet, we help connect them with a pawrent who meets their pet’s unique needs—providing peace of mind that they are going to a home where they will be loved and cared for.</P>
						<P>With MyPawrent, every pet’s journey is about finding not just a home, but the right home</P>
						<a href="{{ route('f.filter') }}" class="btn btn-md btn-secondary">Adopt a pet today!  </a>
					</div>
					<div class="our-story-thumb">
						<img src="{{ asset('frontend/img/home/our-story-V1.jpg')}}" alt="">
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
 

   <script>
    document.addEventListener('livewire:load', function () {
        $('#select22').select2({
            placeholder: 'Select breed',
            allowClear: true
        });

        Livewire.on('breedUpdated', function () {
            $('#select22').select2('destroy');
            $('#select22').select2({
                placeholder: 'Select breed',
                allowClear: true
            });
        });
    });
    </script>







<script>

    $(document).ready(function() {

        $('#select2').select2();

        $('#select2').on('change', function (e) {

            var data = $('#select2').select2("val");

            // @this.set('selCity', data);

        });
        // $('#select22').select2();

        // $('#select22').on('change', function (e) {

        //     var data = $('#select22').select2("val");

        //     // @this.set('selCity', data);

        // });

    });
    
    // document.addEventListener("livewire:initialized",function(){
    //   $(".select22").select2(); 
    // });
    
    // Choices js
    // document.addEventListener('DOMContentLoaded', function() {
    //     new Choices('#choices-select', { removeItemButton: false });
    // });
    
    //  document.addEventListener('DOMContentLoaded', function() {
    //     new TomSelect("#tom-select", { persist: false, createOnBlur: true, create: true });
    // });
    
    //  document.addEventListener('DOMContentLoaded', function() {
    //     new SlimSelect({ select: '#slim-select' });
    // });

</script>

@endpush
