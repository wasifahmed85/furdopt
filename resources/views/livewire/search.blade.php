 <!-- Beginning main content section -->
 <section class="main-content-wrap">
     <div class="search-content">
         <div class="common-wrap clear">
             <!-- Beign story carousel -->
             <div class="story">
                 <!--<div class="story-admin">-->
                 <!--    <a href="#" class="story-admin-link">-->
                 <!--        <div class="story-admin-thumb">-->
                 <!--            <img src="{{ asset('images') }}/{{ Auth::user()->avatar ?? '' }}" alt="">-->
                 <!--            <button type="button" class="btn_upload_story">-->
                 <!--                <i class="jws-icon-plus"></i>-->
                 <!--            </button>-->
                 <!--        </div>-->
                 <!--        <p>Add story</p>-->
                 <!--    </a>-->
                 <!--</div>-->
                 <div class="story-list">
                     <div class="swiper story-carousel">
                         <div class="swiper-wrapper">

                             @foreach ($categories as $cat)
                                 <div class="story-item">
                                     <a wire:click="filterCategoryId({{ $cat->id }})" class="story-link"
                                         style="cursor:pointer">
                                         <div class="story-thumb">
                                             <img src="{{ asset('images') }}/{{ $cat->image ?? 'love2.jpg' }}">
                                         </div>
                                         <p>{{ $cat->name }}</p>
                                     </a>
                                 </div>
                             @endforeach





                         </div>

                     </div>
                 </div>
             </div>
             <!-- End story carousel -->
             <!-- Begin matching-filter section -->
             <div class="matching-filter-wrap">
                 <div class="matching-filter-top">
                     <form action="#" method="post" class="matching-filter">
                         <div class="address-inputs">

                            <!-- <div class="form-col">
                                 {{-- <label for="">Age</label> --}}

                             </div>-->

                             <div class="form-col">

                                 <select wire:model.live="pet_ages">
                                     <option value="">Select Pet Age</option>
                                     <option value="Baby">Baby</option>
                                     <option value="Young">Young</option>
                                     <option value="Adult">Adult</option>
                                     <option value="Senior">Senior</option>
                                     <option value="Age unknown">Age unknown</option>
                                 </select>
                             </div>

                             <!--<div class="form-col">
                                 {{-- <label for="">Location </label> --}}

                             </div>-->

                             <div class="form-col search-select">
                                 <select wire:model.live="looking_for_states" id="select2">
                                     <option value=""> Select Location</option>
                                     @foreach ($states as $state)
                                         <option value="{{ $state->id }}">{{ $state->state }}</option>
                                     @endforeach
                                 </select>
                             </div>
                             <div class="form-col">
                                 <label>Keyword</label>
                                 <input type="search" wire:model.live="name"
                                     placeholder="Start typing, then select a location" />
                             </div>
                             <div class="form-col">
                                 <label class="search-reset" wire:click="resetSearch">Clear</label>

                             </div>
                             <!--<span>icon</span>-->
                         </div>
                     </form>
                     <!-- Begin filter-modal -->
                     <div class="filter-modal-wrap">
                         <a href="#" id="modal-toggle" class="filter-icon"><i class="jws-icon-sliders"></i></a>
                         <div id="discover-filter-modal" class="filter-modal">
                             <div class="filter-modal-title">
                                 <h6>Search for Your Matches</h6>
                                 <a href="#" id="filter-reset" wire:click="resetSearch"> Reset </a>
                             </div>
                             <!-- discover filter form -->
                             <form wire:submit.prevent="searchMatch" class="filter-modal-form">
                                 <div class="filter-form-row">
                                     <label>Gender</label>
                                     <div class="genders">
                                         <div class="radio-box">
                                             <input type="radio" name="gender" id="gender-man" value="Male"
                                                 wire:model="pet_genders" />
                                             <label class="gender-label" for="gender-man">
                                                 Male
                                             </label>
                                         </div>
                                         <div class="radio-box">
                                             <input type="radio" value="Female" id="gender-women" name="gender"
                                                 wire:model="pet_genders" />
                                             <label class="gender-label" for="gender-women"
                                                 name="gender">Female</label>
                                         </div>
                                         <div class="radio-box">
                                             <input type="radio" value="Unknown" id="gender-nonbinary" name="gender"
                                                 wire:model="pet_genders" />
                                             <label class="gender-label" for="gender-nonbinary"
                                                 name="gender">Unknown</label>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="filter-form-row">
                                     <label>Interests</label>
                                     <div class="genders">
                                         @foreach ($categories as $cat)
                                             <div class="radio-box" wire:model="looking_fors">
                                                 <input type="radio" name="interest" id="radio-{{ $cat->name }}"
                                                     value="{{ $cat->id }}" />
                                                 <label class="gender-label"
                                                     for="radio-{{ $cat->name }}">{{ $cat->name }}</label>
                                             </div>
                                         @endforeach

                                     </div>
                                 </div>
                                 <div class="filter-form-row">
                                     <label>Age</label>
                                     <div class="age-range-container">
                                         <select wire:model="pet_ages">
                                             <option value="">Select Age</option>
                                             <option value="Baby">Baby</option>
                                             <option value="Young">Young</option>
                                             <option value="Adult">Adult</option>
                                             <option value="Senior">Senior</option>
                                             <option value="Age unknown">Age unknown</option>
                                   
                                         </select>
                                     </div>
                                 </div>
                                 <div class="filter-form-row">
                                     <label>Location</label>
                                     <select wire:model="looking_for_states" id="select22">
                                         <option value="">Select Location</option>
                                         @foreach ($states as $state)
                                             <option value="{{ $state->id }}">{{ $state->state }}</option>
                                         @endforeach
                                     </select>
                                 </div>

                                 <!-- Advance search options -->
                                 <div id="advance-search-options">
                                
                                     <div class="filter-form-row">
                                         <label>Select Personality</label>
                                         <select wire:model="pet_personalitys">
                                             <option value="">Select Pet's Personality</option>
                                            <option   value="Couch Potato">🛋️ Couch Potato: Prefers lounging and relaxing; minimal activity needs.</option>
                                    <option value="Energetic">⚡ Energetic: Always on the go; loves playtime and adventures.</option>
                                    <option value="Adaptable">⚖️ Adaptable: Comfortable with both playtime and relaxation; displays a balanced temperament.</option>
                                    <option value="No preference">❓ No preference</option>
                                         </select>
                                     </div>
                                     <div class="filter-form-row">
                                         <label>Select Size</label>
                                         <select wire:model="size">
                                             <option value="">Select Pet Size</option>
                                                <option value="Small">🐾 Small
                                </option>
                                <option value="Medium">🐕 Medium</option>
                                <option value="Large">🐕‍🦺 Large</option>
                                
                                <option value="No preference">❓ No preference
                                </option>
                                         </select>
                                     </div>
                                     <div class="filter-form-row">
                                         <label>Select Colour</label>
                                         <select wire:model="colour">
                                             <option>Select Pet colour</option>
                                             <option value="Black">Black</option>
                                             <option value="White">White</option>
                                             <option value="Brown">Brown</option>
                                             <option value="Grey">Grey</option>
                                             <option value="Golden">Golden</option>
                                             <option value="Red">Red</option>
                                             <option value="Cream">Cream</option>
                                             <option value="Tan">Tan</option>
                                             <option value="Blue ">Blue (Grayish-Blue)</option>
                                             <option value="Orange">Orange</option>
                                             <option value="Yellow">Yellow</option>
                                             <option value="Green ">Green </option>
                                             <option value="Multicolor">Multicolor / Mixed</option>
                                             <option value="Unknown ">Unknown </option>
                                         </select>
                                     </div>
                                        <div class="filter-form-row">
                                         <label>Pet Price</label>
                                         <div class="price-box">
                                             <input type="text" wire:model="price_from" placeholder="Price From" >
                                             <input type="text" wire:model="price_to"placeholder="Price To" >
                                         </div>
                                       
                                     </div>
                                        <div class="filter-form-row">
                                         <label>Pet weight</label>
                                         
                                         <input type="text" wire:model="weight" placeholder="Enter your desire pet weight like 5">
                                       
                                       
                                     </div>
                                 </div>
                                 <div class="action-button-bottom">
                                     <button id="slide-toggle-btn" class="btn show-advanced" type="button">
                                         Advanced search
                                     </button>
                                     <button class="btn large Show-matches" type="submit">
                                         Show matches
                                     </button>
                                 </div>
                             </form>
                         </div>
                     </div>
                     <!-- End filter-modal -->
                 </div>
                 <!--<div class="matching-filter">-->
                 <!--    <div class="member-total">-->
                 <!--        <h5>Matches <span>0</span></h5>-->
                 <!--    </div>-->
                 <!--    <div class="filter-right">-->
                 <!--        <div class="order-select">-->
                 <!--            <select class="filter-selectric">-->
                 <!--                <option value="min">Newest Registered</option>-->
                 <!--                <option value="18">Sort by</option>-->
                 <!--                <option value="18">last active</option>-->
                 <!--                <option value="18">Alphabetical</option>-->
                 <!--            </select>-->
                 <!--            <div class="selection-arrow"></div>-->
                 <!--        </div>-->

                 <!--    </div>-->
                 <!--</div>-->

             </div>
             <!-- End matching-filter section -->
             <!-- Begin member gallery section -->
             <div class="gallery-wrap">
                 <!--<div class="pag-count">-->
                 <!--    <p>Viewing 1 - 18 of 32 members</p>-->
                 <!--</div>-->
                 <div class="gallery-grid">

                     @foreach ($searchpets as $pet)
                         <div class="gallery-card">
                             <div class="gallery-thumb">
                                 <a href="{{ route('f.detail', $pet->slug) }}"> <img
                                         src="{{ asset('images') }}/{{ $pet->images->first()->image ?? '' }}" alt=""></a>


                                 <div class="button-action">
                                      @if($pet->owner_id == 201)
                                     <!--<a href="{{ route('f.detail', $pet->slug) }}" class="sent-msg"><i-->
                                     <!--        class="jws-icon-chatcircledots"></i>Message now!</a>-->
                                             @else
                                              <a href="{{ route('f.single.chat', $pet->owner_id) }}" class="sent-msg"><i
                                             class="jws-icon-chatcircledots"></i>Message now!</a>
                                             @endif

                                     @if (Auth::check())
                                         @if ($pet->likes()->where('user_id', auth()->user()->id)->exists())
                                             <a wire:click="petLikes({{ $pet->id }})" class="like-heart"><i
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
                                 <div class="seller-info charity-wrap-info">
                                     <div class="seller-info-head">
                                     <div class="seller-icon-wrap">
                                         <i class="seller-icon"></i>
                                     </div>
                                     <h6 class="seller-name">{{ $pet->user->name ?? '' }}</h6>
                                     <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
                                    </div> 
                                                          
                                @if(!empty($pet->charity_name_admin))
                                 <div class="charity-wrap">
                                     <div class="seller-icon-wrap">
                                             <i class="seller-icon"></i>
                                         </div>
                                      
                                      <h6 class="seller-name charity-name">{{ $pet->charity_name_admin  }}</h6>
                                      
                                  </div>
                                  @endif            

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
                                     <span>{{ $pet->price == 0 ? '' : '£' . $pet->price }}</span>
                                 </div>
                             </div>
                         </div>
                     @endforeach

                 </div>
                 <!-- Begin pagination -->
                 {{$searchpets->links()}}
               
             </div>
             <!-- End member gallery section -->
             
         </div>

     </div>


 </section>
 <!-- //End main content section -->
 @push('scripts')
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

            @this.set('looking_for_states', data);

        });

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

        $('#select22').on('change', function (e) {

            var data = $('#select22').select2("val");

            @this.set('looking_for_states', data);

        });
      

    });

</script>
@endpush
 
