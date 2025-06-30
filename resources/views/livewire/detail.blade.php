@push('meta')
    <meta property="og:title" content="{{ $pet->name ?? 'My Pawrent' }}">
    <meta property="og:description" content="{{ $pet->description ?? 'Default Description' }}">
    <meta property="og:url" content="{{ request()->fullUrl() }}">
    <meta property="og:image" content="{{ asset('images/' . $pet->thumbnail ?? 'default.jpg') }}">
    <meta property="og:type" content="article">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pet->name ?? 'My Pawrent' }}">
    <meta name="twitter:description" content="{{ $pet->description ?? 'Default Description' }}">
    <meta name="twitter:image" content="{{ asset('images/' . $pet->thumbnail ?? 'default.jpg') }}">
@endpush

<div class="main-content">
    <div class="pdp">
        <div class="common-wrap clear">
            <!--  Begin breadcrumb  -->
            <div class="breadcrumb">
                <ul>
                    <li><a href="{{ route('f.index') }}">Home</a></li>
                    <li><a wire:click="searchCategory({{ $pet->category_id }})"
                            style="cursor: pointer">{{ $pet->category->name }}</a></li>
                    <li><a wire:click="search({{ $pet->sub_category_id }})"
                            style="cursor: pointer">{{ $pet->breed->name ?? '' }}</a></li>
                    {{-- <li><a>Labrador Retriever</a></li>
                    <li><a>Devon</a></li> --}}
                    <li><a>{{ $pet->name }}</a></li>
                </ul>
            </div>
            <!-- End breadcrumb  -->
            <!-- Begin product details section -->
            <div class="pdp-grid">
                <div class="pdp-content">
                    <!--  Begin Details section -->
                    <section class="details-section">
                        <div class="details-slider-wrap">
                            <div class="pdp-content-head">
                                <div class="pdp-content-head-text">
                                    <h4>{{ $pet->name }}</h4>
                                    <div class="location-info">
                                        <div class="location-info-item">
                                            <i class="address-location-icon"></i>
                                            <span>{{ $pet->state->state }}, UK</span>
                                        </div>
                                        <div class="location-info-item">
                                            <a href="{{ $pet->map_link }}" target="_blank" class="show-map-link">(show
                                                map)</a>
                                        </div>
                                        <div class="location-info-item">
                                            <i class="time-icon"></i>
                                            <span>{{ $pet->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="pdp-content-head-right">
                                    <div class="pdp-content-head-grid">
                                          @if($pet->price > 0 )
                                        <div class="price mobi"><span>{{ $pet->price == 0 ? '' : '£' . $pet->price }}</span></div>
                                        @endif
                                        <div class="button-group-mobi">
                                            @if (Auth::check())
                                                @if ($pet->likes()->where('user_id', auth()->user()->id)->exists())
                                                    <button class="favorite-button"><i
                                                            class="favorite-icon favorite-icon-select"></i>
                                                    </button>
                                                @else
                                                    <button class="favorite-button"
                                                        wire:click="petLikes({{ $pet->id }})"><i
                                                            class="favorite-icon"></i><span class="desk">Save</span>
                                                    </button>
                                                @endif
                                            @else
                                                <button class="favorite-button"><i
                                                        class="favorite-icon"></i><span class="desk">Save</span>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                    @if(empty($pet->user->role_id))
                                    <a href="{{ route('f.single.chat', $pet->owner_id) }}" class="btn blue-btn cta-msg-btn mobi">Message</a>
                                    @endif
                                </div>

                            </div>

                            <div class="pdp-slider-wrap">
                                <div class="swiper pdp-slider">
                                    <div class="swiper-wrapper">
                                        @foreach ($images as $img)
                                            <div class="swiper-slide pdp-slider-item">
                                                <button type="button" class="fullscreen-btn"><i
                                                        class="expand-icon"></i></button>
                                                <img src="{{ asset('images/' . $img->image) }}"
                                                    data-fancybox="gallery" />
                                            </div>
                                        @endforeach

                                    </div>
                                    <div class="pdp-pagination swiper-pagination"></div>
                                    <div class="swiper-arrow swiper-button-next"></div>
                                    <div class="swiper-arrow swiper-button-prev"></div>
                                </div>
                                <div class="swiper pdp-slider-thumbnail">
                                    <div class="swiper-wrapper">

                                        @foreach ($images as $image)
                                            <div class="swiper-slide">
                                                <img src="{{ asset('images/' . $image->image) }}" />
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="details-wrap">
                            <h4>Pet details information:</h4>
                            <div class="details-grid">
                                <div class="details-item">
                                    
                                    <ul class="deails-item-list">
                                        <li><label>Listing ID:</label><span>{{ Str::upper($pet->advert_id) }}</span></li>
                                        @if(!empty($pet->charity_name_admin))
                                        <li><label>Charity name:</label><span>{{ $pet->charity_name_admin }}</span></li>
                                        @endif
                                        <li><label>Location:</label><span>{{ $pet->state->state ?? '' }}, UK</span></li>
                                        <li><label>DOB:</label><span>{{ $pet->dob ?? '' }}</span></li>
                                        <li><label>Color:</label><span>{{ $pet->colour ?? '' }}</span></li>
                                        <li><label>Views:</label><span>{{ $pet->views }}</span></li>
                                        <li><label>Favourites:</label><span>{{ $pet->like }}</span></li>
                                        
                                    </ul>
                                </div>
                                <div class="details-item">
                                    
                                    <ul class="deails-item-list">
                                       
                                        <li><label>Breed:</label>{{ $pet->breed->name ?? '' }}
                                        </li>
                                        <li><label>Pet Gender:</label><span>{{ $pet->gender ?? '' }}</span></li>
                                        <li><label>Age:</label><span>{{ $pet->age ?? '' }}</span></li>
                                        <li><label>Size:</label><span>{{$pet->size}}</span></li>
                                        @if($pet->weight > 9)
                                        <li><label>Weight:</label><span>{{$pet->weight}}{{$pet->weight ? 'kgs':''}} </span></li>
                                        @else
                                        <li><label>Weight:</label><span>{{$pet->weight}}{{$pet->weight ? 'kg':''}} </span></li>
                                        @endif
                                         <li><label>Pet Personality:</label><span>{{$pet->personality}}</span></li>
                                      
                                    </ul>
                                </div>
                                <div class="details-item health-docs">
                                    <div class="details-item-head">
                                        <i class="health-docs-icon"></i>
                                        <h6>Pre-adoption checks
</h6>
                                    </div>
                                    <ul class="deails-item-list">
                                        <li>
                                            {!! $pet->microchipped_status == 1 ? '<i class="checkmark-icon"></i>' : '<i class="close-icon"></i>' !!}
                                            <span>Microchipped by collection date</span>
                                        </li>
                                        <li>
                                            {!! $pet->neutered_status == 1 ? '<i class="checkmark-icon"></i>' : '<i class="close-icon"></i>' !!}
                                            <span>Neutered</span>
                                        </li>
                                        <li>
                                            {!! $pet->vaccinations_status == 1 ? '<i class="checkmark-icon"></i>' : '<i class="close-icon"></i>' !!}
                                            <span>Vaccinations up to date</span>
                                        </li>
                                        <li>
                                            {!! $pet->worm_status == 1 ? '<i class="checkmark-icon"></i>' : '<i class="close-icon"></i>' !!}
                                            <span>Worm and flea treated</span>
                                        </li>
                                        <li>
                                            {!! $pet->health_checked == 1 ? '<i class="checkmark-icon"></i>' : '<i class="close-icon"></i>' !!}
                                            <span>Health Checked by a vet</span>
                                        </li>
                                        <li>
                                            {!! $pet->special_medical_care == 1 ? '<i class="checkmark-icon"></i>' : '<i class="close-icon"></i>' !!}
                                            <span>Special medical care required</span>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                              <div class="description-wrap">
                           
                            <h4>Additional information</h4>
                                
                                    
                                    <ul >
                                        <li><strong>Is your pet comfortable around other dogs?</strong></li>
                                        <li>{{$pet->iscomportable_other_pet}} </li>
                                        
                                           @if($pet->iscomportable_details !=null)
                                        <li>{{$pet->iscomportable_details}}</li>
                                        @endif
                                        
                                        
                                        <li><strong>Is your pet comfortable around other cats?</strong></li>
                                        <li>{{$pet->iscomportable_other_pet_cat}}</li>
                                        
                                          @if($pet->iscomportable_other_pet_cat_details !=null)
                                        <li>{{$pet->iscomportable_other_pet_cat_details}}</li>
                                        @endif
                                        
                                        <li><strong>Is your pet comfortable around children? </strong></li>
                                        <li>{{$pet->iscomportable_children}}</li>
                                        
                                        <li><strong>Why are you looking to rehome this pet? </strong></li>
                                        <li>{{$pet->why_rehome}}</li>
                                        
                                        <li><strong>Ideal home</strong></li>
                                        <li>{{$pet->best_fit_for_home}}</li>
                                            @if($pet->best_fit_for_home_deatils !=null)
                                        <li>{{$pet->best_fit_for_home_deatils}}</li>
                                        @endif
                                        
                                        <li><strong>Does your pet require a secure outdoor space?  </strong></li>
                                        <li>{{$pet->need_outdoor_space}}</li>
                                        
                                        
                                    </ul>
                              
                               
                           
                        </div>
                            
                      
                        <div class="description-wrap">
                            <h4>Description</h4>
                            <p>{!! $pet->description !!}</p>
                        </div>
                        <div class="buyers-checklist-blog">
                            <p><strong>{{ $setting->site_name ?? '' }} Safety Advice:</strong> You MUST read our
                                    buyer's checklist
                                before contacting the advertiser.</p>
                            <button class="btn btn-secondary large buyers-checklist-btn" id="buyers-checklist-btn"><i
                                        class="protection-icon"></i>
                                    Buyer's checklist</button>
                        </div>
                        <!-- Begin Buyer's checklist faq -->
                <section class="buyers-checklist" id="buyers-checklist">
                    <div class="checklist-head">
                        <i class="icon-protection"></i>
                        <h4>Buyer's checklist to avoid scams!</h4>
                    </div>
                    <div class="checklist-item">
                      
                        @foreach ($scams as $scam)
                            <div class="checklist-row">
                                <h6>{{ $scam->title }}</h6>
                            </div>
                        @endforeach

                    </div>
               
                </section>
                <!-- End Buyer's checklist faq -->
                    </section>
                    <!--  End Details section -->
                </div>
                <!--  Beign aside  -->
                <aside class="pdp-sidebar">
                     @if($pet->price > 0 )
                    <div class="price-box">
                       
                        <span>{{ $pet->price == 0 ? '' : '£' . $pet->price }}</span>
                     
                    </div>
                       @endif
                     @if($pet->owner_id == 201)
                     @else
                    <a href="{{ route('f.single.chat', $pet->owner_id) }}"
                        class="btn btn-secondary large cta-msg-btn"><i class="jws-icon-chatcircledots"></i>Message now!</a>
                        @endif
                    <div class="user-details-wrap">
                        <div class="user-details-info">
                            <div class="user-details-desc">
                                <span class="user-link" style="text-align:center">
                                    {{--
                                    @if($pet->user->rehoming_centre !=null)
                                    <a href="{{ route('f.owner.all', $pet->owner_id) }}" wire:navigate style="text-align:center">
                                     {{ $pet->user->rehoming_centre }}  </a>
                                     
                                    ( {{ $pet->user->Rehoming_centre_id }} )
                                    
                                    @else
                                    
                                       <a href="{{ route('f.owner.all', $pet->owner_id) }}" wire:navigate > {{ $pet->user->name }}  </a>
                                   
                                    @endif
                                    --}}
                                    
                                               @if($pet->user->rehoming_centre !=null)
                                    <a href="{{ route('f.ownerprofile', $pet->owner_id) }}"  style="text-align:center">
                                     {{ $pet->user->rehoming_centre }}  </a>

                                    ( {{ $pet->user->Rehoming_centre_id }} )

                                    @else

                                       <a href="{{ route('f.ownerprofile', $pet->owner_id) }}"  > {{ $pet->user->name }} </a>

                                    @endif
                                
                                
                                @if($pet->user->verify_status == 1)
                                <i class="idverified-icon"></i> 
                                @endif
                                </span>
                                <ul class="user-details-info-list">
                                    <li><i class="locations-icon"></i>{{ $pet->user->state->state ?? '' }}, UK</li>
                                    <li><i class="time-icon"></i>Member Since: {{ $pet->user->created_at->diffForHumans() }}</li>
                                    {{-- <li>Member since: 1 month</li> --}}
                                </ul>
                            </div>
                             @php
                                         $avatar = $pet->user->avatar;
                                         $gender = $pet->user->gender;
                                     @endphp

                                     <img class="user-details-link" src="{{ asset($avatar ? 'images/' . $avatar : ($gender == 'Female' ? 'images/female.jpg' : 'images/deafult.jpg')) }}"
                                         alt="User Avatar">
                                         {{--
                            <a href="#" class="user-details-link"><img
                                    src="{{ asset('images/' . $pet->user->avatar) }}" alt=""></a>
                                    --}}
                        </div>
                        <div class="verified-wrap">
                            <h5>Verified by:</h5>
                            <div class="verified-list">
                                <ul>
                                    <li><i class="verified-accept-icon"></i>Phone</li>
                                    <li><i class="verified-accept-icon"></i>Email</li>
                                   
                                </ul>
                            </div>
                        </div>
                        <div class="detaills-view-wrap">
                            <a href="{{ route('f.owner.all', $pet->owner_id) }}" wire:navigate
                                class="btn btn-secondary large">View all adverts ({{ $ownerAdCount }}) from this
                                user</a>
                            <div class="user-cta">
                                <button wire:click="toggleShare" class="user-cta-btn"><i class="share-iocn"></i>Share advert</button>
                                @if(Auth::check())
                                <button class="user-cta-btn report-btn" wire:click.prevent="openModal"><i class="report-icon"></i>Report
                                    advert</button>
                                @else
                                <a href="{{route('f.register')}}" class="user-cta-btn report-btn"><i class="report-icon"></i>Report
                                    advert</a>
                                @endif
                                
                                   
                            </div>
                            <p>{{$message}}</p> 
                            @php
    $postUrl = urlencode(url()->current());
    $postTitle = urlencode($pet->name);
    $postDescription = urlencode(strip_tags($pet->description)); 
    $postImage = urlencode(asset('images/' . $pet->thumbnail)); 
@endphp



                              <div x-show="$wire.showShare" class="share-options">
                                  <!-- Facebook -->
<a href="https://www.facebook.com/sharer/sharer.php?u={{ $postUrl }}" target="_blank">
    Share on Facebook
</a>

<!-- Twitter (X) -->
<a href="https://twitter.com/intent/tweet?text={{ $postTitle }}&url={{ $postUrl }}" target="_blank">
    Share on X
</a>

<!-- WhatsApp -->
<a href="https://api.whatsapp.com/send?text={{ $postTitle }}%20{{ $postUrl }}" target="_blank">
    Share on WhatsApp
</a>
                                    </div>
                            
                             <!-- Modal -->
                            @if ($selectReport ==1)
                                @if(Auth::check())
                                <div class="modal-overlay {{ $showModal ? 'show' : '' }} report-modal">
                                    <div class="modal-content">
                                        <h4>{{ $pet->name }}</h4>
                                       
                                      
                    
                                        <form wire:submit="perReport">
                                            @csrf
                                            <input type="hidden" wire:model="petId" name="pet_id" value="{{ $pet->id }}">
                                            <input type="hidden" wire:model="ownerId" name="owner_id" value="{{ $pet->owner_id }}">
                                            
                                            <textarea wire:model="details"></textarea>
                                            
                                            <button type="submit">Submit report</button>
                                        </form>
                                        <button class="close-btn" wire:click="closeModal">Close</button>
                                    </div>
                                </div>
                                @else
                                <div class="modal-overlay {{ $showModal ? 'show' : '' }}">
                                    <div class="modal-content">
                                        <h4>Login First </h4>
                                       
                                      <button class="close-btn" wire:click="closeModal">Close</button>
                    
                                    </div>
                                </div>
                                @endif
                            @endif
                        </div>
                    </div>
                    @if (!empty($banner))
                        <div class="welfare-card">
                            <div class="welfare-card-head">
                                <h5>{{ $banner->title ?? '' }}</h5>
                                @if (!empty($banner->banner))
                                    <img src="{{ asset('images') }}/{{ $banner->banner }}" alt="">
                                @endif
                            </div>
                            <div class="welfare-card-body">
                                {!! $banner->descriptions ?? '' !!}
                            </div>
                            <!--<div class="welfare-card-footer">-->
                            <!--    <a href="#" class="more-link">Find out more</a>-->
                            <!--</div>-->
                        </div>
                    @endif
                </aside>
            </div>
            <!-- End product details section -->
            <div class="pdp-info">
                <!-- Begin Similar adverts section -->
                
                <!-- End Similar adverts section -->
                <!-- Begin dynamic link -->
                {{--
                <div class="dynamic-link-list">
                    <ul>
                        @foreach ($allBreeds as $breed)
                            <li><a wire:click="search({{ $breed->id }})"
                                    style="cursor: pointer">{{ $breed->name }}</a></li>
                        @endforeach

                    </ul>
                </div>
                
                --}}
                <!-- Begin dynamic link -->
                <!-- Begin Related articles section -->

                <!-- End Related articles section -->
                
            </div>

        </div>

    </div>
</div>
