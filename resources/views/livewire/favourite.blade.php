  <!-- Beginning main content section -->
  <section class="main-content-wrap">
      <div class="match-content">
          <div class="common-wrap clear">
              {{-- <div class="story">
                  <div class="story-admin">
                      <a href="#" class="story-admin-link">
                          <div class="story-admin-thumb">
                              <img src="{{ asset('images/' . Auth::user()->avatar) }}" alt="">
                              <button type="button" class="btn_upload_story">
                                  <i class="jws-icon-plus"></i>
                              </button>
                          </div>

                      </a>
                  </div>
                  <div class="story-list">
                      <div class="swiper story-carousel">
                          <div class="swiper-wrapper">

                              @foreach ($matchedPets as $match)
                                  <div class="story-item swiper-slide">
                                      <a href="{{ route('f.detail', $match->slug) }}" class="story-link">
                                          <div class="story-thumb">
                                              <img src="{{ asset('images/' . $match->thumbnail) }}">
                                          </div>
                                          <p>{{ $match->name }}</p>
                                      </a>
                                  </div>
                              @endforeach
                              
                          </div>
                          <div class="story-carousel-btn swiper-button-next">
                              <i class="jws-icon-caretleft"></i>
                          </div>
                          <div class="story-carousel-btn swiper-button-prev">
                              <i class="jws-icon-caretright"></i>
                          </div>
                      </div>
                  </div>
              </div> --}}
              <!-- Begin member section -->
              <div class="member-wrap">
                  <div class="matching-filter">
                      <div class="member-total">
                          <h5>Favourite <span>{{ $matchedPets->total() }}</span></h5>
                      </div>
                     
                  </div>


                  <div class="gallery-wrap">

                      <div class="gallery-grid">

                          @foreach ($matchedPets as $pet)
                              <div class="gallery-card">
                                  <div class="gallery-thumb">
                                      <a href="{{ route('f.detail', $pet->slug) }}"> <img
                                              src="{{ asset('images/' . $pet->images->first()->image ?? '') }}" alt=""></a>
                                      <!--<div class="members-active">-->
                                      <!--    <p> Offline</p>-->
                                      <!--</div>-->
                                      <!--<div class="groups-admin">-->
                                      <!--    <button type="button" class="btn-dropdown">-->
                                      <!--        <i class="jws-icon-dotsthreeoutline"></i>-->
                                      <!--    </button>-->
                                      <!--    <div class="menu-dropdown">-->
                                      <!--        <ul>-->
                                      <!--            <li><a href=""><i class="jws-icon-copysimple"></i> Copy Link-->
                                      <!--                    Profile-->
                                      <!--                </a></li>-->
                                      <!--            <li><a href=""><i class="jws-icon-eyeslash"></i> Hide in-->
                                      <!--                    search </a>-->
                                      <!--            </li>-->
                                      <!--            <li><a href=""><i class="jws-icon-prohibit"></i> Block and-->
                                      <!--                    report </a>-->
                                      <!--            </li>-->
                                      <!--        </ul>-->
                                      <!--    </div>-->
                                      <!--</div>-->
                                      <div class="button-action">
                                          @if($pet->owner_id == 201)
                                          <!--<a href="{{ route('f.detail', $pet->slug) }}" class="sent-msg"><i class="jws-icon-chatcircledots"></i>Message now!</a>-->
                                          @else
                                          <a href="{{ route('f.single.chat', $pet->owner_id) }}" class="sent-msg"><i class="jws-icon-chatcircledots"></i>Message now!</a>
                                          @endif
                                          
                                          <!--<a href="#" class="like-heart"><i class="jws-icon-heart"></i> 80%</a>-->
                                          

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
                                        <h6 class="seller-name">{{ $pet->user->name??'' }}</h6>
                                    </div>
                                                     <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
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
                                     <p>{{$pet->state->state ?? '' }}, Uk</p>
                                     </div>
                                     <span>{{ $pet->price == 0 ? '' : '£' . $pet->price }}</span>
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
      </div>




  </section>
  <!-- //End main content section -->
