 <!-- Begin main content section -->
 <div class="main-content">

     <!-- End Hero section -->
     <div class="sales-content">
         <div class="common-wrap clear">
             <div class="sales-content-grid">
                 <aside class="sidebar">
                     <div class="filter">
                         <div class="filter-head">
                             <h4>Apply Filter</h4>
                             <a class="filter-link" wire:click="clearAll" style="cursor: pointer">Clear all</a>
                         </div>
                         <div class="filter-category">
                             {{-- <a href="{{ route('f.index') }}" wire:navigate class="filter-link">Back to Pets</a> --}}
                             <form class="form">

                                 <label>Keyword</label>
                                 <div class="input-search">
                                     <input type="search" name="search" placeholder="Search (min. 3 characters)"
                                         wire:model.live="search">

                                 </div>
                             </form>
                             <!--<span>Type of listing</span>-->
                             <!--<input type="radio" value="rehome" wire:model.live="adType">Rehome-->
                             <!--<input type="radio" value="adopt" wire:model.live="adType">Adopt-->
                         </div>
                         <div class="filter-options">
                             <form action="#" method="post" class="form">
                                 <div class="form-row filter-options">
                                     <label>Pet category</label>
                                     <div class="input-search">
                                         <div class="search-icon"></div>
                                         <input type="search" name="search" placeholder="filter Category"
                                             wire:model.live="categoryName">

                                     </div>
                                     <div class="checkbox-container">
                                         @foreach ($categories as $category)
                                             <div class="checkbox-row">
                                                 <input type="checkbox" id="checked-{{ $category->id }}" name="vehicle1"
                                                     value="{{ $category->id }}" wire:model.live="selectedCategories">
                                                 <label for="checked-{{ $category->id }}">{{ $category->name }}</label>
                                                 <span class="checkmark"></span>
                                             </div>
                                         @endforeach

                                     </div>
                                 </div>
                                 <div class="form-row filter-options">
                                     <label>Pet breed</label>
                                     <div class="input-search">
                                         <div class="search-icon"></div>
                                         <input type="search" name="search" placeholder="filter breed"
                                             wire:model.live="breedName">

                                     </div>
                                     <div class="checkbox-container">
                                         @foreach ($breeds as $breed)
                                             <div class="checkbox-row">
                                                 <input type="checkbox" id="checked-{{ $breed->id }}" name="vehicle1"
                                                     value="{{ $breed->id }}" wire:model.live="selectedBreeds">
                                                 <label for="checked-{{ $breed->id }}">{{ $breed->name }}</label>
                                                 <span class="checkmark"></span>
                                             </div>
                                         @endforeach

                                     </div>
                                 </div>
                                 <div class="form-row location">
                                     {{-- <div class="input-search">
                                         <div class="search-icon"></div>
                                         <input type="search" name="search" placeholder="filter bread"
                                             wire:model.live="locationSearch">
                                     </div> --}}
                                     <label>Location</label>
                                     <select wire:model.live="selectState">
                                         <option>Select location</option>
                                         @foreach ($states as $state)
                                             <option value="{{ $state->id }}">{{ $state->state }}</option>
                                         @endforeach

                                     </select>

                                 </div>
                                 {{-- <div class="form-row">
                                     <label>Keyword</label>
                                     <div class="input-search">
                                         <input type="search" name="search" placeholder="Search (min. 3 characters)"
                                             wire:model.live="search">

                                         <span class="count-text">0/100 characters</span>
                                     </div>
                                 </div> --}}
                                 <div class="form-row">
                                     <label>Price</label>
                                     <div class="range">
                                         <div class="range-col">
                                             <span class="currency">£</span>
                                             <input type="number" wire:model.live="min_price" id="min_price">
                                         </div>
                                         <div class="range-col">
                                             <span class="currency">£</span>
                                             <input type="number" wire:model.live="max_price" id="max_price">
                                         </div>
                                     </div>
                                 </div>
                                 <div class="form-row">
                                     <label>Advertiser safety</label>
                                     <div class="checkbox-row">
                                         <input type="checkbox" id="checked-verifiedBreeders" name="vehicle1"
                                             value="1" wire:model.live="verifiedBreeders">
                                         <label for="checked-verifiedBreeders">Only ID Verified breeders</label>
                                         <span class="checkmark"></span>
                                     </div>
                                 </div>
                                 <div class="form-row">
                                     <label>Pet sex</label>
                                     <div class="checkbox-container">
                                         <div class="checkbox-row">
                                             <input type="checkbox" id="checked-female" name="vehicle1" value="female"
                                                 wire:model.live="gender">
                                             <label for="checked-female">Female</label>
                                             <span class="checkmark"></span>
                                         </div>
                                         <div class="checkbox-row">
                                             <input type="checkbox" id="checked-male" name="vehicle1" value="male"
                                                 wire:model.live="gender">
                                             <label for="checked-male">Male</label>
                                             <span class="checkmark"></span>
                                         </div>
                                         {{-- <div class="checkbox-row">
                                             <input type="checkbox" id="checked-mixed" name="vehicle1"
                                                 value="both" wire:model.live="gender">
                                             <label for="checked-mixed">Both</label>
                                             <span class="checkmark"></span>
                                         </div> --}}
                                     </div>

                                 </div>
                             </form>
                         </div>
                     </div>
                 </aside>
                 <div class="sales-content-inner">
                     <div class="breadcrumb">
                         <ul>
                             <li><a href="#">Home</a></li>

                         </ul>
                     </div>
                     <h3> Pets Available for Adoption</h3>
                     <div class="sales-content-head">
                         <h4>{{ $ads->total() }} Pets Available for Adoption</h4>
                         <div class="head-right">

                             <select wire:model.live="sortBy">
                                 <option value="newest">Date Published (Newest)</option>
                                 <option value="oldest">Date Published (Oldest)</option>
                                 <option value="lowest">Price (Lowest)</option>
                                 <option value="higest">Price (Highest)</option>
                             </select>
                         </div>
                     </div>

                     <!-- Beging search results -->
                     <div class="search-results-wrap">
                         <div class="search-results-item">
                             @if (count($spotlights))
                                 <div class="search-results-title">
                                     <span>Spotlight Adverts</span>
                                 </div>
                             @endif
                             @foreach ($spotlights as $spot)
                               
                                  <div class="card">
                                     <div class="card-thumb">
                                         <div class="premium">
                                             <a href="{{ route('f.detail', $spot->slug) }}" wire:navigate>
                                                 <!--<i class="premium-icon"></i>-->
                                                 <img src="{{ asset('frontendAssets/svgs/spotlight-1.svg') }}"
                                                     alt="">
                                             </a>
                                         </div>
                                         <!--<span class="licensed-breeder">Licensed Breeder</span>-->
                                         <img src="{{ asset('images') }}/{{ $spot->images->first()->image ?? '' }}" alt="">
                                         <div class="counters-wrap">
                                             <i class="picture-icon"></i>
                                             <span>{{ $spot->images_count ?? '' }}</span>
                                         </div>
                                     </div>
                                     <div class="card-text">
                                         {{-- <time class="card-time"><i class="time-icon"></i>{{ $spot->spotlight->created_at }}</time> --}}
                                         <time class="card-time"><i
                                                 class="time-icon"></i>{{ \Carbon\Carbon::parse($spot->latest_spotlight_created_at)->diffForHumans() }}</time>
                                         <div class="boosted-badge"> <img
                                                 src="{{ asset('frontendAssets/svgs/spotlight-2.svg') }}"
                                                 alt="">Spotlight</div>
                                         <h5> <a href="{{ route('f.detail', $spot->slug) }}"
                                                 wire:navigate>{{ $spot->name ?? '' }}</a> </h5>
                                         <span class="card-price">£{{ $spot->price ?? '' }}</span>
                                         <ul class="card-list">
                                             <li>Cockapoo</li>
                                             <li>Age: {{ $spot->age ?? '' }}</li>
                                             <li>{{ $spot->gender }}</li>
                                         </ul>
                                         <!--<p>{!! $spot->description !!}</p>-->
                                         <p>{!! Str::limit($spot->description, 200, '...') !!}</p>
                                         <div class="seller-wrap">
                                             
                                             <div class="seller-info">
                                                 <div class="seller-info-head">
                                                     <div class="seller-icon-wrap">
                                                 <i class="seller-icon"></i>
                                             </div>
                                                     <h6 class="seller-name">{{ $spot->user->name }}</h6>
                                                     @if ($spot->user->verify_status == 1)
                                                         <div class="idverified">
                                                             <i class="idverified-icon"></i>
                                                             <p>ID verified</p>
                                                         </div>
                                                     @endif

                                                 </div>
                                                 <div class="seller-locations">
                                                     <i class="locations-icon"></i>
                                                     <address>{{ $spot->user->state->state }}, UK</address>
                                                 </div>
                                                 <!--<span class="licensed-breeder">Licensed Breeder</span>-->
                                             </div>
                                             @if (Auth::check())
                                                 @if ($spot->likes()->where('user_id', auth()->user()->id)->exists())
                                                     <button type="button" class="favorite-btn">
                                                         <i class="favorite-icon favorite-icon-select"></i>
                                                     </button>
                                                 @else
                                                     <button wire:click="petLikes({{ $spot->id }})"
                                                         type="button" class="favorite-btn">
                                                         <i class="favorite-icon"></i>
                                                     </button>
                                                 @endif
                                             @else
                                                 <button wire:click="petLikes({{ $spot->id }})" type="button"
                                                     class="favorite-btn">
                                                     <i class="favorite-icon"></i>
                                                 </button>
                                             @endif

                                         </div>
                                     </div>
                                 </div>
                             @endforeach
                         </div>

                         <div class="search-results-item all-adverts">


                             <div class="search-results-title">
                                 <span>All Adverts</span>
                             </div>

                             @forelse ($ads as $ad)
                                
                                    <div class="card">
                                     <div class="card-thumb">
                                         <a href="{{ route('f.detail', $ad->slug) }}" wire:navigate>
                                             <!--<span class="licensed-breeder">Licensed Breeder</span>-->
                                             <img src="{{ asset('images') }}/{{ $ad->images->first()->image ?? '' ?? '' }}"
                                                 alt="">
                                         </a>
                                         <div class="counters-wrap">
                                             <i class="picture-icon"></i>
                                             <span>{{ $ad->images_count ?? '' }}</span>
                                         </div>
                                     </div>
                                     <div class="card-text">


                                         <h5> <a href="{{ route('f.detail', $ad->slug) }}"
                                                 wire:navigate>{{ $ad->name ?? '' }} </a></h5>
                                         <span class="card-price">£{{ $ad->price }}</span>
                                         <ul class="card-list">
                                             <li>{{ $ad->breed->name ?? '' }}</li>
                                             <li>Age: {{ $ad->age ?? '' }}</li>
                                             <li>{{ $ad->gender ?? '' }}</li>
                                         </ul>
                                         <p>{!! Str::limit($ad->description, 200, '...') !!}</p>
                                         <div class="seller-wrap">
                                             <div class="seller-icon-wrap">
                                                 <i class="seller-icon"></i>
                                             </div>
                                             <div class="seller-info">
                                                 <div class="seller-info-head">
                                                     <h6 class="seller-name">{{ $ad->user->name }}</h6>
                                                     @if ($ad->user->verify_status == 1)
                                                         <div class="idverified">
                                                             <i class="idverified-icon"></i>
                                                             <p>ID verified</p>
                                                         </div>
                                                     @endif
                                                     <!--<div class="rating">-->
                                                     <!--    <i class="rating-icon"></i>-->
                                                     <!--    <span>5.0</span>-->
                                                     <!--</div>-->
                                                 </div>
                                                 <div class="seller-locations">
                                                     <i class="locations-icon"></i>
                                                     <address>{{ $ad->user->state->state ?? '' }}, UK</address>
                                                 </div>
                                                 <!--<span class="licensed-breeder">Licensed Breeder</span>-->
                                             </div>
                                             @if (Auth::check())
                                                 @if ($ad->likes()->where('user_id', auth()->user()->id)->exists())
                                                     <button type="button" class="favorite-btn">
                                                         <i class="favorite-icon favorite-icon-select"></i>
                                                     </button>
                                                 @else
                                                     <button wire:click="petLikes({{ $ad->id }})"
                                                         type="button" class="favorite-btn">
                                                         <i class="favorite-icon"></i>
                                                     </button>
                                                 @endif
                                             @else
                                                 <button wire:click="petLikes({{ $ad->id }})" type="button"
                                                     class="favorite-btn">
                                                     <i class="favorite-icon"></i>
                                                 </button>
                                             @endif
                                         </div>
                                     </div>
                                 </div>
                             @empty
                                 <p style="text-align: center">No Data Found</p>
                             @endforelse
                         </div>
                     </div>
                     <!-- End search results -->
                     <!--  Begin Pagination -->

                     <div>
                         {{-- {{ $paginator->links('vendor.paginator.custom') }} --}}
                         {{ $ads->links('vendor.pagination.custom') }}
                     </div>


                     <!--  End Pagination -->
                     <!-- Begin Recommended section -->


                     {{-- <section class="recommend">
                         <div class="search-results-title">
                             <span>Recommended for you</span>
                         </div>
                         <div class="blog">

                             @foreach ($recomandded as $recom)
                                 <a href="{{ route('f.detail', $recom->slug) }}" wire:navigate class="blog-card">
                                     <div class="blog-card-thumb">
                                         <img src="{{ asset('images') }}/{{ $recom->images->first()->image ?? '' }}" alt="">
                                     </div>
                                     <div class="blog-card-text">
                                         <h6>{{ $recom->name }}</h6>
                                         <span>{{ $recom->breed->name }}</span>
                                         <p>{{ $recom->gender }}</p>
                                         <div class="price">
                                             <dfn>£</dfn>
                                             <p>{{ $recom->price }}</p>
                                         </div>
                                     </div>
                                 </a>
                             @endforeach

                         </div>
                     </section> --}}
                     <!-- End Recommended section -->
                 </div>
             </div>
         </div>
     </div>

     <!--  Begin Dynamic Links  -->
     {{--
     <div class="dynamic-link">
         <div class="common-wrap clear">
             <div class="dynamic-link-list">
                 <ul>
                     @foreach ($allBreeds as $breed)
                         <li><a wire:click="SelectedBreed({{ $breed->id }})"
                                 style="cursor: pointer">{{ $breed->name }}</a></li>
                     @endforeach
                 </ul>
             </div>
         </div>
     </div>
     --}}
     <!--  End Dynamic Links  -->
 </div>
 <!-- End main content section -->
 <!-- Beginning footer section -->


 @script
     <script>
         $wire.on('clear-query-string', () => {
             const url = new URL(window.location.href);
             url.search = ''; // Clear all query parameters
             history.replaceState({}, '', url); // Update the browser URL without reloading
         });
     </script>
 @endscript
