 <!-- Beginning main content section -->
 <section class="main-content-wrap">
     <section class="my-profile main-profile">
         <div class="common-wrap clear">
             <div class="my-profile-grid">
                 <div class="my-profile-inner">
                     <div class="my-profile-row">

                         <div class="cta-group my-profile-head">
                             <a href="{{ route('f.search') }}" wire:navigate class="search">Explore Pets</a>
                             <a href="{{ route('f.match') }}" wire:navigate class="match">Match Now</a>
                         </div>

                         <style>
                             .my-profile-inner .cta-group {
                                 justify-content: space-between;
                                 gap: 10px;
                                 align-items: center;
                                 margin-bottom: 20px;
                                 display: none;
                             }
                             .my-profile-inner .cta-group .search {
                                 background-color: #020202;
                                 color: #ffffff;
                                 padding: 10px 15px;
                                 border-radius: 5px;
                                 flex-grow: 1;
                                 text-align: center;
                             }
                             .my-profile-inner .cta-group .match {
                                 background-color: transparent;
                                 color: #020202;
                                 border: 2px solid #020202;
                                 padding: 10px 15px;
                                 border-radius: 5px;
                                 flex-grow: 1;
                                 text-align: center;
                             }

                             @media screen and (max-width: 1024px) {
                                 .my-profile-inner .cta-group {
                                     display: flex;
                                 }
                             }
                         </style>

                         <div class="my-profile-head">
                             <h3>FurDopt Profile</h3>
                             @if($editdata)
                             <button class="profile-btn" wire:click="save">Save</button>
                             @else
                             <button class="profile-btn" wire:click="edit">Edit</button>
                             @endif
                         </div>
                         <div class="my-profile-content">
                             <div class="my-profile-thumb">
                                 <a href="" class="my-proflile-image">

                                     {{-- <img src="{{ asset('images') }}/{{ Auth::user()->avatar ?? 'deafult.jpg' }}"
                                         alt=""> --}}
                                     {{-- @if (Auth::user()->avatar == null)
                                         @if (Auth::user()->gender == 'Male')
                                             <img src="{{ asset('images/deafult.jpg') }}" alt="">
                                         @elseif(Auth::user()->gender == 'Female')
                                             <img src="{{ asset('images/female.jpg') }}" alt="">
                                         @else
                                             <img src="{{ asset('images/' . Auth::user()->avatar) }}" alt="">
                                         @endif
                                     @else
                                         <img src="{{ asset('images') }}/{{ Auth::user()->avatar }}" alt="">
                                     @endif --}}
                                     @php
                                         $avatar = Auth::user()->avatar;
                                         $gender = Auth::user()->gender;
                                     @endphp

                                     <img src="{{ asset($avatar ? 'images/' . $avatar : ($gender == 'Female' ? 'images/female.jpg' : 'images/deafult.jpg')) }}"
                                         alt="User Avatar" class="mb-3">
                                         @if($editdata)
                                         <input type="file" id="gallery-upload" wire:model="avatar" >
                                          @endif


                                 </a>
                             </div>
                             <div class="my-profile-text">
                                 <div class="my-profile-name">
                                     <h3> @if($editdata)
                                      <input type="text" value="" wire:model="username">
                                     @else
                                       {{ Auth::user()->name }}
                                     @endif
                                     
                                     </h3>
                                     @if (Auth::user()->verify_status == 1)
                                         <div class="check-mark-icon desk">
                                             <img src="{{ asset('customer') }}/svgs/check-mark.svg" alt="check mark">
                                         </div>
                                     @endif
                                 </div>

                                 <div class="members-info">
                                     @if(!empty(Auth::user()->Rehoming_centre_id))
                                     <p><strong>Charity ID:</strong>  {{ Auth::user()->Rehoming_centre_id }}</p> 
                                     @endif
                                     <p><strong>Phone Number:</strong> @if($editdata)<input type="tel" wire:model="phone" value="{{ Auth::user()->phone }}"> @else {{ Auth::user()->phone }} @endif</p> 
                                     <p><strong>Email:</strong> {{ Auth::user()->email }}</p> 
                                     <p><strong>Gender:</strong>
                                     @if($editdata)
                                      <select wire:model="gender">
                                          
                                            <option value="">Select gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select> 
                                     @else
                                      {{ Auth::user()->gender }} 
                                     @endif
                                     
                                    
                                       
                                    </p> 
                                     <p><strong>Location:</strong> 
                                     
                                      @if($editdata)
                                      <select wire:model="city" id="city">
                                          <option >Select location</option>
                                              @foreach ($cities as $country)
                                        <option value="{{ $country->id }}">{{ $country->state }}
                                        </option>
                                    @endforeach
                                        </select> 
                                     @else
                                      {{ Auth::user()->state->state ?? '' }}, Uk 
                                     @endif
                                     
                                    </p>


                                 </div>
                                 <div class="my-profile-desc">
                                     <p> <strong>About Me:</strong>
                                      @if($editdata)
                                      <textarea wire:model="bio"></textarea>
                                     @else
                                     {{ Auth::user()->userdetails->bio ?? '' }}
                                     @endif
                                     
                                              
                                       
                                    </p>
                                 </div>
                             </div>
                         </div>
                     </div>
                      
                     <div class="my-profile-row">
                         <div class="content-head">
                             <h4>My Basic Interests and Pet Preferences:</h4>
                         </div>

                         <ul class="profile-fields">
                             <li><strong>Looking for a:</strong> </li>
                             <li>
                                   @if($editdata)
                                      <select wire:model.live="looking_for">
                                         
                                          @foreach($categories as $cat)
                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                                            @endforeach
                                        </select> 
                                     @else
                                        {{ $userdetail->category->name ?? '' }}
                                     @endif
                               
                             </li>
                              <li><strong>Preferred Breed:</strong> </li>
                             <li>
                                   @if($editdata)
                                      <select wire:model="looking_for_breed">
                                            <option value="">Select Looking For Breed</option>
                                            @foreach ($subCategories as $subCategory)
                                            <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                        @endforeach
                                        </select> 
                                     @else
                                        {{ $userdetail->subcategory->name ?? '' }}
                                     @endif
                               
                             </li>
                                       <li><strong>Preferred pet size:</strong></li>
                             <li>
                                 
                                   @if($editdata)
                                       <select wire:model="size">
                                            <option value="">Select size</option>
                                                <option @if ($size = 'Small') selected @endif value="Small">🐾 Small
                                </option>
                                <option @if ($size = 'Medium') selected @endif value="Medium">🐕 Medium</option>
                                <option @if ($size = 'Large') selected @endif value="Large">🐕‍🦺 Large</option>
                                
                                <option @if ($size = 'No preference') selected @endif value="No preference">❓ No preference
                                </option>
                               
                                        </select> 
                                     @else
                                    {{ $userdetail->size ?? '' }}
                                     @endif
                                 
                                 
                                 
                                 
                             </li>
                             
                             <li><strong>Preferred pet’s age:</strong></li>
                             <li>
                                 
                                 @if($editdata)
                                       <select wire:model="pet_age">
                                    <option value="">Select Pet Age</option>

                                    <option @if ($pet_age = 'Baby') selected @endif  value="Baby">Baby</option>
                                    <option @if ($pet_age = 'Young') selected @endif value="Young">Young</option>
                                    <option @if ($pet_age = 'Adult') selected @endif value="Adult">Adult</option>
                                    <option @if ($pet_age = 'Senior') selected @endif value="Senior">Senior</option>



                                </select>
                                     @else
                                      {{ $userdetail->pet_age ?? '' }}
                                     @endif
                               
                             </li>
                                 <li><strong>Pet preference:</strong></li>
                             <li>
                                   @if($editdata)
                                           <select wire:model="pet_personality">
                                  

                                     <option value="">Select Personality</option>
                                <option  @if ($pet_personality = 'Couch Potato') selected @endif value="Couch Potato">🛋️ Couch Potato: Prefers lounging and relaxing; minimal activity needs.</option>
                                    <option  @if ($pet_personality = 'Energetic') selected @endif value="Energetic">⚡ Energetic: Always on the go; loves playtime and adventures.</option>
                                    <option  @if ($pet_personality = 'Adaptable') selected @endif value="Adaptable">⚖️ Adaptable: Comfortable with both playtime and relaxation; displays a balanced temperament.</option>
                                    <option  @if ($pet_personality = 'No preference') selected @endif value="No preference">❓ No preference</option>
                                    
                                </select>
                                     @else
                                   {{ $userdetail->pet_personality ?? '' }}
                                     @endif
                                 
                                 
                                 
                                
                             </li>
                                 <li><strong>Adopting pets with special needs:</strong></li>
                             <li>
                                   @if($editdata)
                                      <input type="radio" id="ssYes" name="special_need" value="Yes"
                                        class="radio" wire:model.live="special_need">

                                    <label class="radio-label" for="ssYes">Yes</label>

                                    <input type="radio" id="sNo" name="special_need" value="No"
                                        class="radio" wire:model.live="special_need">
                                    <label class="radio-label" for="sNo">No</label>
                                    
                                    <input type="radio" id="iNo" name="special_need" value="It depends"
                                        class="radio" wire:model.live="special_need">
                                    <label class="radio-label" for="iNo">It depends</label>
                                    
                                    @if($special_need == 'It depends')
                            <textarea wire:model="special_need_yes_details"></textarea>
                            @endif
                                    
                                     @else
                                     {{ $userdetail->special_need ?? '' }}
                                    
                                    @if($userdetail->special_need == 'It depends')
                                    <br>
                                      {{ $userdetail->special_need_yes_details ?? '' }}
                                    @endif
                                     
                                     @endif
                                 
                                 
                                
                             </li>
                             
                             @if($editdata)
                                    <li><strong>Specific traits or activities you’re looking for in a pet:</strong></li>
                                     <li>
                                         <input type="text" placeholder="(e.g., “Loves outdoor activities,” “Good with other pets,” “Low-maintenance”)" wire:model="specific_trait_activities">

                                    </li>
                                    @else
                                          <li><strong>Specific traits or activities you’re looking for in a pet:</strong></li>
                              <li>{{ $userdetail->specific_trait_activities ?? '' }}</li>
                                   
                                    
                                     @endif
                             
                             
                           
                                   @if($editdata)
                                    <li><strong>Available pet:</strong></li>
                                     <li>
                                        <input type="radio" id="isyes" name="is_available_pet" value="Yes"
                                        class="radio" wire:model.live="is_available_pet">

                                    <label class="radio-label" for="isyes">Yes</label>

                                    <input type="radio" id="No"  value="No"
                                        class="radio" wire:model.live="is_available_pet">
                                    <label class="radio-label" for="No">No</label>
                                    </li>
                                    @else
                                          <li><strong>Available pet:</strong></li>
                              <li>{{ $userdetail->is_available_pet ?? '' }}</li>
                                   
                                    
                                     @endif
                                     
                                      @if($editdata)
                                      <li><strong>My other pet include:</strong></li>
                                 <li>
                                      
                               
                                    
                                    <input type="text" placeholder="Dog" wire:model="availablePetInhouse"
                                        required>
                                    @error('availablePetInhouse')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                
                            
                                       </li> 
                                      
                                      
                                        @else
                               @if ($userdetail->is_available_pet == 'Yes')
                                 <li><strong>My other pet include:</strong></li>
                                 <li> {{ $userdetail->available_pet_inhouse ?? '' }} </li>
                                     @endif
                                   
                                    
                                     @endif
                                     
                                       
                             <li><strong>Children in my home:</strong></li>
                             <li>
                                   @if($editdata) 
                                        <select wire:model="children_age_inhouse">
                                    <option value="">Select Children In house</option>

                                    <option value="Under 5 years old">Under 5 years old
                                    </option>
                                    <option value="6–10 years old">6–10 years old
                                    </option>
                                    <option value="11–15 years old">11–15 years old
                                    </option>
                                    <option value="16+ (Older, sensible children)">
                                        16+ (Older, sensible children)</option>
                                    <option value="No children in the home">No children in the home</option>



                                </select>
                                     @else
                                  {{ $userdetail->children_age_inhouse ?? '' }}
                                     @endif
                                 
                                 
                                 
                               
                             </li>
                             
                               
                             <li><strong>Available outdoor space:</strong></li>
                             <li>
                                  
                                   @if($editdata)
                                      <select wire:model="pet_outdoor_space">
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select> 
                                     @else
                                  {{ $userdetail->pet_outdoor_space ?? '' }}
                                     @endif
                                 
                                 
                               
                             </li>  
                             
                             <li><strong>Home environment?:</strong></li>
                             <li>
                                  
                                   @if($editdata)
                                       <select wire:model.live="best_fit_for_home">
                                  

                                    <option value="Active household">🏃‍♂️ Active household
                                    </option>
                                    <option value="Quiet household">🛋️ Quiet household
                                    </option>
                                    <option value="Experienced pet owner">🐾 Experienced pet owner
                                    </option>
                                  
                                    <option value="Other">❓ Other (Please specify):</option>



                                </select>
                                    @if($best_fit_for_home == 'Other')
                                        
                                      <textarea name="best_fit_for_home_deatils" wire:model="best_fit_for_home_deatils"></textarea>
                                      @endif
                                     @else
                                  {{ $userdetail->best_fit_for_home ?? '' }}
                                     @endif
                                 
                                 
                               
                             </li>                                    
                          
                             <li><strong>Daily dedicated time for the pet:</strong></li>
                             <li>
                                   @if($editdata) 
                                       <select wire:model="dedicated_time">
                                    <option value="">Select dedicated Time</option>

                                   <option value="Less than 1 hour">🕒 Less than 1 hour</option>
                                    <option value="1–3 hours">🕒  1–3 hours</option>
                                    <option value="More than 3 hours">🕒  More than 3 hours</option>

                                </select> 
                                     @else
                                    {{ $userdetail->dedicated_time ?? '' }}
                                     @endif
                                 
                                 
                                
                             </li>
                             
                             <li><strong>Adoption reason:</strong></li>
                             <li>
                                   @if($editdata) 
                                   <textarea wire:model="adoption_reason"></textarea>
                                     @else
                                    {{ $userdetail->adoption_reason ?? '' }}
                                     @endif
                                 
                                 
                                
                             </li>
                         
                                     
                             <li><strong>Preferred pet’s gender:</strong></li>
                             <li>
                                  @if($editdata)
                                      <select wire:model="pet_gender">
                                    <option value="">Select Pet Gender</option>

                                    <option @if ($pet_gender = 'Male') selected @endif value="Male">♂ Male</option>
                                    <option @if ($pet_gender = 'Female') selected @endif value="Female">♀ Female</option>
                                    <option @if ($pet_gender = 'Unknown') selected @endif value="Unknown">❓ Unknown</option>



                                </select>
                                     @else
                                     {{ $userdetail->pet_gender ?? '' }}
                                     @endif
                                 
                                 
                                
                             </li>
                         
                             <li><strong>Looking for specific traits:</strong></li>
                             <li>
                                 
                                   @if($editdata)
                                            <select wire:model="specific_activities">
                                    <option value="">--Select--</option>

                                    <option value="Loves outdoor activities">Loves outdoor activities</option>
                                    <option value="Good with other pets">Good with other pets</option>
                                    <option value="Low-maintenance">Low-maintenance</option>
                                    <option value="Highly trainable & intelligent">Highly trainable & intelligent
                                    </option>
                                    <option value="Affectionate & cuddly">Affectionate & cuddly </option>
                                    <option value="Calm & quiet temperament">Calm & quiet temperament</option>
                                    <option value="Good with children & families">Good with children & families
                                    </option>
                                    <option value="Playful & energetic">Playful & energetic</option>
                                    <option value="Requires minimal grooming">Requires minimal grooming</option>
                                    <option value="Independent & self-sufficient">Independent & self-sufficient
                                    </option>
                                    <option value="Protective & loyal">Protective & loyal</option>
                                    <option value="Social & people-friendly">Social & people-friendly</option>
                                    <option value="Therapy or emotional support potential
">Therapy or emotional
                                        support potential
                                    </option>
                                </select>
                                     @else
                                  {{ $userdetail->specific_activities ?? '' }} 
                                     @endif
                                 
                                 
                                 
                                
                             </li>
                   
                          
                             
                                
                                  
                     





                         </ul>
                        
                         <div class="btn-group-wrap">
                            <a href="{{ route('f.match') }}" class="btn btn-primary">Find your Perfect Match </a>
                          </div>
                     </div>


                     {{-- <div class="my-profile-row">
                         <div class="content-head">
                             <h5>Sport</h5>
                         </div>
                         
                         <ul class="profile-fields">
                         

                             {{ implode(', ', json_decode($userdetail->sports ?? '[]', true) ?? []) }}

                         </ul>
                     </div> --}}

                 </div>

             </div>
         </div>
     </section>
 </section>
 
@push('scripts')
<script>
    document.addEventListener('livewire:init', () => {
       
        function initializeSelect2() {
            $('#city').select2();
                
            // Dispatch Livewire event on change
            $('#city').on('change', function () {
                const selectedValue = $(this).val();

                @this.set('city', selectedValue);
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
