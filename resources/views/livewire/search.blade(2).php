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
                                     <a wire:click="filterCategoryId({{ $cat->id }})" class="story-link" style="cursor:pointer">
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
                             <div class="form-col">
                                 <label for="">Age</label>

                             </div>
                             <div class="form-col">

                                 <select wire:model.live="pet_ages">
                                     <option value="">Select Age</option>
                                     <option value="Any Age">Any Age</option>
                                     <option value="0-6mnths">0-6mnths</option>
                                     <option value="6mths – 1 year">6mths – 1 year</option>
                                     <option value="1-3 years">1-3 years</option>
                                     <option value="3-5 years">3-5 years</option>
                                     <option value="5 years +">5 years +</option>
                                 </select>
                             </div>

                             <div class="form-col">
                                 <label for="">within</label>

                             </div>
                             <div class="form-col">
                                 <select wire:model.live="looking_for_states">
                                     <option value="">Select State</option>
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
                              <form class="filter-modal-form">
                                      <div class="filter-form-row">
                                          <label>Gender</label>
                                          <div class="genders">
                                              <div class="radio-box">
                                                  <input type="radio" name="gender" id="gender-man" value="male"
                                                      wire:model.live="pet_genders" />
                                                  <label class="gender-label" for="gender-man">
                                                      Male
                                                  </label>
                                              </div>
                                              <div class="radio-box">
                                                  <input type="radio" value="female" id="gender-women" name="gender"
                                                      wire:model.live="pet_genders" />
                                                  <label class="gender-label" for="gender-women"
                                                      name="gender">Female</label>
                                              </div>
                                              <div class="radio-box">
                                                  <input type="radio" value="mixed" id="gender-nonbinary"
                                                      name="gender" wire:model.live="pet_genders" />
                                                  <label class="gender-label" for="gender-nonbinary"
                                                      name="gender">Mixed</label>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="filter-form-row">
                                          <label>Interests</label>
                                          <div class="genders">
                                              @foreach ($categories as $cat)
                                                  <div class="radio-box" wire:model.live="looking_fors">
                                                      <input type="radio" name="gender"
                                                          id="radio-{{ $cat->name }}" value="{{ $cat->id }}" />
                                                      <label class="gender-label"
                                                          for="radio-{{ $cat->name }}">{{ $cat->name }}</label>
                                                  </div>
                                              @endforeach

                                          </div>
                                      </div>
                                      <div class="filter-form-row">
                                          <label>Age</label>
                                          <div class="age-range-container">
                                              <select wire:model.live="pet_ages">
                                                  <option value="">Select Age</option>
                                                  <option value="Any Age">Any Age</option>
                                                  <option value="0-6mnths">0-6mnths</option>
                                                  <option value="6mths – 1 year">6mths – 1 year</option>
                                                  <option value="1-3 years">1-3 years</option>
                                                  <option value="3-5 years">3-5 years</option>
                                                  <option value="5 years +">5 years +</option>
                                              </select>
                                          </div>
                                      </div>
                                      <div class="filter-form-row">
                                          <label>State/Providence</label>
                                          <select wire:model.live="looking_for_states">
                                              <option value="">Select State</option>
                                              @foreach ($states as $state)
                                                  <option value="{{ $state->id }}">{{ $state->state }}</option>
                                              @endforeach
                                          </select>
                                      </div>

                                      <!-- Advance search options -->
                                      <div id="advance-search-options">
                                          <div class="filter-form-row">
                                              <label>Sports</label>
                                              <div class="checkbox-items">
                                                  <div class="checkbox-item">
                                                      <input id="hiking" type="checkbox"
                                                          wire:model.live="pet_sportss" />
                                                      <label class="gender-label" for="hiking">Hiking</label>
                                                  </div>
                                                  <div class="checkbox-item">
                                                      <input id="basketball" type="checkbox"
                                                          wire:model.live="pet_sportss" />
                                                      <label class="gender-label" for="basketball"> Basketball</label>
                                                  </div>
                                                  <div class="checkbox-item">
                                                      <input id="badminton" type="checkbox"
                                                          wire:model.live="pet_sportss" />
                                                      <label class="gender-label" for="badminton">Badminton</label>
                                                  </div>
                                                  <div class="checkbox-item">
                                                      <input id="bowling" type="checkbox"
                                                          wire:model.live="pet_sportss" />
                                                      <label class="gender-label" for="bowling">Bowling</label>
                                                  </div>
                                                  <div class="checkbox-item">
                                                      <input id="ice-hockey"
                                                          type="checkbox"wire:model.live="pet_sportss" />
                                                      <label class="gender-label" for="ice-hockey">Ice hockey</label>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="filter-form-row">
                                              <label>Select Personality</label>
                                              <select wire:model.live="pet_personalitys">
                                                  <option>Select Personality</option>
                                                  <option value="All Personality Traits">All Personality Traits
                                                  </option>
                                                  <option value="Cat Friendly">Cat Friendly</option>
                                                  <option value="Child friendly">Child friendly</option>
                                                  <option value="Dog friendly">Dog friendly</option>
                                                  <option value="People friendly">People friendly</option>
                                              </select>
                                          </div>
                                          <div class="filter-form-row">
                                              <label>Select Size</label>
                                              <select wire:model.live="pet_ages">
                                                  <option>Select Size</option>
                                                  <option value="anysize">Any Size</option>
                                                  <option value="Giant">Giant</option>
                                                  <option value="Large">Large</option>
                                                  <option value="Medium">Medium</option>
                                                  <option value="Small">Small</option>
                                              </select>
                                          </div>
                                      </div>
                                  </form>
                             <!-- Advance Search -->
                             <div class="action-button-bottom">
                                 <button id="slide-toggle-btn" class="btn show-advanced" type="button">
                                     Advanced search
                                 </button>
                                 <button class="btn large Show-matches" type="submit">
                                     Show matches
                                 </button>
                             </div>
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

                     @foreach ($pets as $pet)
                         <div class="gallery-card">
                             <div class="gallery-thumb">
                                 <a href="{{ route('f.detail', $pet->slug) }}" wire:navigate> <img
                                         src="{{ asset('images') }}/{{ $pet->thumbnail }}" alt=""></a>


                                 <div class="button-action">
                                     <a href="{{ route('f.detail', $pet->slug) }}" wire:navigate class="sent-msg"><i
                                             class="jws-icon-chatcircledots"></i></a>
                                     <a href="{{ route('f.detail', $pet->slug) }}" wire:navigate
                                         class="like-heart"><i class="jws-icon-heart"></i></a>
                                 </div>
                             </div>
                             <div class="gallery-card-text">
                                 <a href="{{ route('f.detail', $pet->slug) }}" wire:navigate
                                     class="gallery-card-name">{{ $pet->name }}</a>
                                 <div class="member-info">
                                     <p>{{ $pet->state->state ?? '' }}</p>
                                     <span>{{ $pet->price }}</span>
                                 </div>
                             </div>
                         </div>
                     @endforeach

                 </div>
                 <!-- Begin pagination -->
                 {{ $pets->links('vendor.pagination.custom2') }}
             </div>
             <!-- End member gallery section -->
         </div>

     </div>


 </section>
 <!-- //End main content section -->
