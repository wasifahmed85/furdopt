<!-- Beginning main content section -->
<section class="main-content-wrap">
    <section class="discover-wrap">
        <div class="common-wrap clear">
            <div class="discover-grid">
                <div class="discover-content">
                    <div class="discover-filter">
                        <h6>discover</h6>
                        <div id="modal-toggle" class="filter-right">
                            <i class="jws-icon-sliders"></i>
                        </div>
                        <!-- filter modal -->
                        <div id="discover-filter-modal" class="filter-modal">
                            <div class="filter-modal-title">
                                <h6>Search for Your Matches</h6>
                                <a href="#" id="filter-reset" wire:click="resetSearch"> Reset </a>
                            </div>
                            <!--  filter modal form -->
                            <form class="filter-modal-form">
                                <div class="filter-form-row">
                                    <label>Gender</label>
                                    <div class="genders">
                                        <div class="radio-box">
                                            <input type="radio" name="gender" id="gender-man" value="male" wire:model.live="pet_genders" />
                                            <label class="gender-label" for="gender-man">
                                                Male
                                            </label>
                                        </div>
                                        <div class="radio-box">
                                            <input type="radio" value="female" id="gender-women" name="gender" wire:model.live="pet_genders"/>
                                            <label class="gender-label" for="gender-women" name="gender">Female</label>
                                        </div>
                                        <div class="radio-box">
                                            <input type="radio" value="mixed" id="gender-nonbinary"
                                                name="gender" wire:model.live="pet_genders"/>
                                            <label class="gender-label" for="gender-nonbinary"
                                                name="gender">Mixed</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-form-row">
                                    <label>Interests</label>
                                    <div class="genders">
                                        @foreach($categoreis as $cat)
                                        <div class="radio-box" wire:model.live="looking_fors">
                                            <input type="radio" name="gender" id="radio-{{$cat->name}}" value="{{$cat->id}}" />
                                            <label class="gender-label" for="radio-{{$cat->name}}">{{$cat->name}}</label>
                                        </div>
                                        @endforeach
                                    
                                    </div>
                                </div>
                                <div class="filter-form-row">
                                    <label>Age</label>
                                    <div class="age-range-container">
                                        <select  wire:model.live="pet_ages">
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
                                        @foreach($states as $state)
                                        <option value="{{$state->id}}">{{$state->state}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <!-- Advance search options -->
                                <div id="advance-search-options">
                                    <div class="filter-form-row">
                                        <label>Sports</label>
                                        <div class="checkbox-items">
                                            <div class="checkbox-item">
                                                <input id="hiking" type="checkbox" wire:model.live="pet_sportss" />
                                                <label class="gender-label" for="hiking">Hiking</label>
                                            </div>
                                            <div class="checkbox-item">
                                                <input id="basketball" type="checkbox" wire:model.live="pet_sportss"/>
                                                <label class="gender-label" for="basketball"> Basketball</label>
                                            </div>
                                            <div class="checkbox-item">
                                                <input id="badminton" type="checkbox" wire:model.live="pet_sportss"/>
                                                <label class="gender-label" for="badminton">Badminton</label>
                                            </div>
                                            <div class="checkbox-item">
                                                <input id="bowling" type="checkbox" wire:model.live="pet_sportss"/>
                                                <label class="gender-label" for="bowling">Bowling</label>
                                            </div>
                                            <div class="checkbox-item">
                                                <input id="ice-hockey" type="checkbox"wire:model.live="pet_sportss" />
                                                <label class="gender-label" for="ice-hockey">Ice hockey</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="filter-form-row">
                                        <label>Select Personality</label>
                                        <select  wire:model.live="pet_personalitys">
                                              <option>Select Personality</option>
                                            <option value="All Personality Traits">All Personality Traits</option>
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
                    @if($userd->looking_for != null)
                    <div class="gallery-wrap discover-gallery">

                      <div class="gallery-grid">

                          @foreach ($matchedPets as $pet)
                              <div class="gallery-card">
                                  <div class="gallery-thumb">
                                      <a href="{{ route('f.detail', $pet->slug) }}" wire:navigate> <img src="{{ asset('images/' . $pet->thumbnail) }}"
                                              alt=""></a>
                                      <!--<div class="members-active">-->
                                      <!--    <p> Offline</p>-->
                                      <!--</div>-->
                                      <div class="groups-admin">
                                          <button type="button" class="btn-dropdown">
                                              <i class="jws-icon-dotsthreeoutline"></i>
                                          </button>
                                          <div class="menu-dropdown">
                                              <ul>
                                                  <li><a href=""><i class="jws-icon-copysimple"></i> Copy Link
                                                          Profile
                                                      </a></li>
                                                  <li><a href=""><i class="jws-icon-eyeslash"></i> Hide in
                                                          search </a>
                                                  </li>
                                                  <li><a href=""><i class="jws-icon-prohibit"></i> Block and
                                                          report </a>
                                                  </li>
                                              </ul>
                                          </div>
                                      </div>
                                      <div class="button-action">
                                          <a href="#" class="sent-msg"><i
                                                  class="jws-icon-chatcircledots"></i></a>
                                          <a href="#" class="like-heart"><i class="jws-icon-heart"></i> 80%</a>
                                      </div>
                                  </div>
                                  <div class="gallery-card-text">
                                      <a href="#" class="gallery-card-name">{{ $pet->name }}</a>
                                      <div class="member-info">
                                          <p>{{ $pet->state->state ?? '' }}</p>
                                          <span>{{ $pet->price }}</span>
                                      </div>
                                  </div>
                              </div>
                          @endforeach

                      </div>
                      <!-- Begin pagination -->

                      {{ $matchedPets->links('vendor.pagination.custom2') }}
                     
                      
                  </div>
              </div>
          </div>
          <!-- End member section -->
                    
                    @else
                    <div class="discover-content-inner">
                        <img src="{{ asset('customer') }}/svgs/bring-Solutions.svg" alt="" />
                        <h4>Complete your profile to get more Matching</h4>
                        <p>Discover user.Keep adding info to attract your person.</p>
                        <a href="{{ route('f.setting') }}" class="btn medium" wire:navigate>Edit your profile</a>
                    </div>
                    @endif
                </div>
                @if($userd->looking_for != null)
                @else
                <aside class="user-profile">
                    <h5>Your Profile</h5>
                    <div class="user-profile-info">
                        <img src="{{asset('images')}}/{{Auth::user()->avatar ?? 'deafult.jpg'}}" alt="Profile" />
                        <h6>{{Auth::user()->name}}</h6>
                        <div class="members-info">
                            <p>{{Auth::user()->state->state ?? ''}}</p>

                        </div>
                    </div>
                    {{-- <div class="premium-card" style="background-image: url({{ asset('customer') }}/svgs/Banner.svg)"
                        ;>
                        <img src="{{ asset('customer') }}/svgs/premium-card.svg" />
                        <p>
                            View all private pictures of any person, chat without
                            restrictions, and see who like you!
                        </p>
                        <a href="#" class="btn large"> Get premium now</a>
                    </div> --}}
                </aside>
                @endif
            </div>
        </div>
    </section>
</section>
<!-- //End main content section -->
