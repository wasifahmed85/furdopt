<!-- Beginning main content section -->
<section class="main-content-wrap my-listing-page">
    <!-- Begin hero section -->
    <section class="banner">
        <img src="{{ asset('customer/img/my-listing/listing-hero-img.png') }}">
        <div class="common-wrap">
            <div class="banner-inner">
                <div class="banner-text">
                    <h1>Rehome a pet</h1>
                    <div class="listing-breadcrumbs">
                        <ul>
                            <li><a href="#">home</a><i class="rtcl-icon-angle-right"></i></li>
                            <li><a href="#">Rehome a pet</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End hero section -->
    <div class="my-listing-content">
        <form wire:submit.prevent="save" class="category-form">
            <div class="common-wrap clear">
                <div class="my-listing-content-inner">
                    <div class="my-listing-title">
                        <!--<h6>You have 9 free ads</h6>-->
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                    <div class="type-selection-wrap">
                        {{-- <div class="type-selection-item">
                            <div class="type-selection-head">
                                <div class="type-selection-title">
                                    <i class="rtcl-icon-tags"></i>
                                    <h5>Select Type</h5>
                                </div>
                            </div>
                            <div class="type-selection-row">
                                <div class="type-selection-label">
                                    <label>Ad Type <span>*</span></label>
                                </div>

                                <select wire:model="ad_type">
                                    <option>--Select Type--</option>
                                    <option value="rehome">Rehome</option>
                                    <option value="adopt">Adopt</option>

                                </select>
                                @error('ad_type')
                                    <small class="errors-msg">{{ $message }}</small>
                                @enderror
                            </div>
                        </div> --}}
                        <div class="type-selection-item category">
                            {{-- <div class="type-selection-head">
                                <i class="rtcl-icon-tags"></i>
                                <h5>Select Pet Category</h5>
                            </div> --}}
                            <div class="type-selection-row">
                                <div class="type-selection-label">
                                    <label>Select Pet Category <span>*</span></label>
                                </div>

                                {{-- <select class="filter-selectric" wire:model.live="category_id"> --}}
                                <select wire:model.live="category_id">
                                    <option value="">Select Pet Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <small class="errors-msg">{{ $message }}</small>
                                @enderror
                            </div>
                            @if (count($subCategories))
                                <div class="type-selection-row">
                                    <div class="type-selection-label">
                                        <label>Select Pet Breed <span>*</span></label>
                                    </div>

                                    <select wire:model="sub_category_id">
                                        <option value="">Select Pet Breed</option>
                                        @foreach ($subCategories as $subCategory)
                                            <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                            @endif
                        
                    </div>
                </div>
                <!-- Begin My listing info -->
                <div class="type-selection-wrap" id="listing-catagory">

                    <div class="type-selection-item">


                        <div class="type-selection-row">
                            <div class="type-selection-label">
                                <label>Pet Name <span>*</span></label>
                            </div>
                            <div class="form-group @error('name') has-error @enderror">
                                <input type="text" wire:model="name">
                                @error('name')
                                    <small class="errors-msg">{{ $message }}</small>
                                @enderror

                            </div>
                        </div>
                          <div class="type-selection-row">
                            <div class="type-selection-label">
                                <label>Pet Gender <span>*</span></label>
                            </div>
                            <div class="form-group has-error">
                                <select wire:model="gender">
                                    <option>Select Gender</option>
                                    <option value="Male">♂ Male</option>
                                    <option value="Female">♀ Female</option>
                                    <option value="Unknown">❓ Unknown</option>
                                </select>
                                @error('gender')
                                    <small class="errors-msg">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="type-selection-row">
                            <div class="type-selection-label">
                                <label>Pet Age <span>*</span></label>
                            </div>
                            <div class="form-group @error('age') has-error @enderror">

                                <select wire:model="age">
                                    <option value="">Select Pet Age</option>
                                    <option value="Baby">Baby</option>
                                    <option value="Young">Young</option>
                                    <option value="Adult">Adult</option>
                                    <option value="Senior">Senior</option>
                                    <option value="Age unknown">Age unknown</option>

                                </select>
                                @error('age')
                                    <small class="errors-msg">{{ $message }}</small>
                                @enderror

                            </div>
                        </div>
                         <div class="type-selection-row">
                            <div class="type-selection-label">
                                <label>Date of birth </label>
                            </div>
                            <div class="form-group @error('name') has-error @enderror">
                                <input type="date" wire:model="dob">
                                @error('dob')
                                    <small class="errors-msg">{{ $message }}</small>
                                @enderror

                            </div>
                        </div>
                            <div class="type-selection-row">
                            <div class="type-selection-label">
                                <label>Pet Size <span>*</span></label>
                            </div>
                            <div class="form-group class="form-group @error('size') has-error @enderror>

                                <select wire:model="size">
                                    <option value="">Select Pet Size</option>
                                    <option value="Small">🐾 Small</option>
                                    <option value="Medium">🐕 Medium</option>
                                    <option value="Large">🐕‍🦺 Large</option>
                                    <option value="Unknown">Unknown</option>

                                </select>

                                @error('size')
                                    <small class="errors-msg">{{ $message }}</small>
                                @enderror

                            </div>
                        </div>
                         <div class="type-selection-item">
                             
                             <div class="type-selection-head">
                                <div class="type-selection-title">
                                    <i class="rtcl-icon-s-tags"></i>
                                     <strong>Personality & Needs</strong> 
                                </div>
                            </div>
                            <div class="type-selection-row">
                                <div class="type-selection-label">
                               
                                     <label>
                                     How would you describe your pet’s personality? (Select one)
                                      </label>
                                </div>
                                   <div class="form-group class="form-group @error('personality') has-error @enderror>

                                <select wire:model="personality">
                                    <option value="">Select pet personality</option>
                                    <option value="Couch Potato">🛋️ Couch Potato: Prefers lounging and relaxing; minimal activity needs.</option>
                                    <option value="Energetic">⚡ Energetic: Always on the go; loves playtime and adventures.</option>
                                    <option value="Adaptable">⚖️ Adaptable: Comfortable with both playtime and relaxation; displays a balanced temperament.</option>
                                    

                                </select>

                                @error('personality')
                                    <small class="errors-msg">{{ $message }}</small>
                                @enderror

                            </div>
                            {{--
                                
                                <div class="form-group form-group @error('size') has-error @enderror personality">
                                    <input type="text" wire:model="size">
                                     @foreach (['Couch Potato', 'A Bundle of Energy', 'Balanced', 'Playful', 'Friendly', 'Affectionate', 'Loyal', 'Calm','Shy','Curious','Intelligent'] as $index => $personality)
                                    <div class="check-box-row">
                                        <input type="checkbox" id="checked-{{ $personality }}" name="vehicle1"
                                            wire:model="personality" value="{{ $personality }}"> <label
                                            for="checked-{{ $personality }}">{{ $personality }}</label><br>
                                    </div>
                                    
                                @endforeach
                                  
                            
                                    

                                    @error('size')
                                        <small class="errors-msg">{{ $message }}</small>
                                    @enderror

                                </div>
                                --}}
                        </div>
                        </div>
                        
                             <div class="type-selection-row">
                                <div class="type-selection-label">
                                    <label>Does your pet have any special needs or medical conditions?


                                    </label>
                                </div>
                                <div class="form-group @error('special_need') has-error @enderror radio-row">
                                    <label>
                                        <input type="radio" name="special_need" wire:model.live="special_need"
                                            value="Yes">
                                        ✅ Yes (Please specify in the text box)
                                    </label>

                                    <label>
                                        <input type="radio" name="special_need" wire:model.live="special_need"
                                            value="No">
                                       ❌ No
                                    </label>

                                    @error('special_need')
                                        <small class="errors-msg">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            @if ($special_need == 'Yes')
                                <div class="type-selection-row">
                                    <div class="type-selection-label">
                                        <label>Details
                                        </label>
                                    </div>
                                    <div class="form-group @error('name') has-error @enderror">
                                        <textarea name="special_details" wire:model="special_details"></textarea>

                                        @error('special_details')
                                            <small class="errors-msg">{{ $message }}</small>
                                        @enderror

                                    </div>
                                </div>
                            @endif
                            
                            <div class="type-selection-row">
                            <div class="type-selection-head">
                                <div class="type-selection-title">
                                    <i class="rtcl-icon-s-tags"></i>
                                     <strong>Compatibility</strong> 
                                </div>
                            </div>
                      
                          <div class="type-selection-row">
                                <div class="type-selection-label">
                                    <label>Is your pet comfortable around other dogs?

                                <span>*</span>
                                    </label>
                                </div>
                                <div
                                    class="form-group @error('iscomportable_other_pet') has-error @enderror radio-row">
                                    <label>
                                        <input type="radio" name="iscomportable_other_pet"
                                            wire:model="iscomportable_other_pet" value="Yes">
                                       ✅ Yes
                                    </label>

                                    <label>
                                        <input type="radio" name="iscomportable_other_pet"
                                            wire:model="iscomportable_other_pet" value="No">
                                       ❌ No
                                    </label>
                                 
                                    <label>
                                        <input type="radio" name="iscomportable_other_pet"
                                            wire:model="iscomportable_other_pet" value="Unsure">
                                      🤷 Unsure

                                    </label>
                                  

                                    @error('iscomportable_other_pet')
                                        <small class="errors-msg">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                          
                            @if ($iscomportable_other_pet == 'Unsure')
                                <div class="type-selection-row">
                                    <div class="type-selection-label">
                                        <label>Details
                                        </label>
                                    </div>
                                    <div class="form-group @error('name') has-error @enderror">
                                        <textarea name="iscomportable_details" wire:model="iscomportable_details"></textarea>

                                        @error('iscomportable_details')
                                            <small class="errors-msg">{{ $message }}</small>
                                        @enderror

                                    </div>
                                </div>
                            @endif
                            <div class="type-selection-row">
                                <div class="type-selection-label">
                                    <label>Is your pet comfortable around other cats?
                                 <span>*</span>
                                    </label>
                                </div>
                                <div
                                    class="form-group @error('iscomportable_other_pet_cat') has-error @enderror radio-row">
                                    <label>
                                        <input type="radio" name="iscomportable_other_pet_cat"
                                            wire:model="iscomportable_other_pet_cat" value="Yes">
                                       ✅ Yes
                                    </label>

                                    <label>
                                        <input type="radio" name="iscomportable_other_pet_cat"
                                            wire:model="iscomportable_other_pet_cat" value="No">
                                       ❌ No
                                    </label>
                                 
                                    <label>
                                        <input type="radio" name="iscomportable_other_pet_cat"
                                            wire:model="iscomportable_other_pet_cat" value="Unsure">
                                      🤷 Unsure

                                    </label>
                                  

                                    @error('iscomportable_other_pet')
                                        <small class="errors-msg">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="type-selection-row">
                                <div class="type-selection-label">
                                    <label>Is your pet comfortable around other pets? (Rabbits, Birds, etc?) 

                                 <span>*</span>
                                    </label>
                                </div>
                                <div
                                    class="form-group @error('iscomportable_other_pet') has-error @enderror radio-row">
                                    <label>
                                        <input type="radio" name="iscomportable_others_pets"
                                            wire:model="iscomportable_others_pets" value="Yes">
                                       ✅ Yes
                                    </label>

                                    <label>
                                        <input type="radio" name="iscomportable_others_pets"
                                            wire:model="iscomportable_others_pets" value="No">
                                       ❌ No
                                    </label>
                                 
                                    <label>
                                        <input type="radio" name="iscomportable_others_pets"
                                            wire:model="iscomportable_others_pets" value="Unsure">
                                      🤷 Unsure

                                    </label>
                                  

                                    @error('iscomportable_other_pet')
                                        <small class="errors-msg">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                          
                            @if ($iscomportable_other_pet_cat == 'Unsure')
                                <div class="type-selection-row">
                                    <div class="type-selection-label">
                                        <label>Details
                                        </label>
                                    </div>
                                    <div class="form-group @error('name') has-error @enderror">
                                        <textarea name="iscomportable_other_pet_cat_details" wire:model="iscomportable_other_pet_cat_details"></textarea>

                                        @error('iscomportable_other_pet_cat_details')
                                            <small class="errors-msg">{{ $message }}</small>
                                        @enderror

                                    </div>
                                </div>
                            @endif
  </div>
                            <div class="type-selection-row">
                                <div class="type-selection-label">
                                    <label>Is your pet comfortable around children? <span>*</span></label>
                                </div>
                                <div class="form-group class="form-group @error('size') has-error @enderror>

                                    <select wire:model="iscomportable_children">

                                        <option value="all">Select all</option>
                                        <option value="Under 5 years old">👶 Under 5 years old</option>
                                        <option value="6–10 years old">🧒 6–10 years old
                                        </option>
                                        <option value="11–15 years old">🧑 11–15 years old
                                        </option>
                                        <option value="16+ years old">
                                            🧑‍🎓 16+ years old</option>
                                        <option value="Not comfortable with children">❌ Not comfortable with children
                                        </option>

                                    </select>

                                    @error('iscomportable_children')
                                        <small class="errors-msg">{{ $message }}</small>
                                    @enderror

                                </div>
                            </div>
                            
                           <div class="type-selection-row">
                            <div class="type-selection-head">
                                <div class="type-selection-title">
                                    <i class="rtcl-icon-s-tags"></i>
                                     <strong>Home Recommendations</strong> 
                                </div>
                            </div> 
                            <div class="type-selection-row">
                                <div class="type-selection-label">
                                    <label>What kind of home would best suit your pet? (Select one)<span>*</span></label>
                                </div>



                                <div class="form-group @error('best_fit_for_home') has-error @enderror radio-row">
                                    <label>
                                        <input type="radio" name="best_fit_for_home"
                                            wire:model.live="best_fit_for_home" value="Active household">🏃‍♂️ Active household

                                    </label>
                                    <label>
                                        <input type="radio" name="best_fit_for_home"
                                            wire:model.live="best_fit_for_home" value="Quiet household">
                                        🛋️ Quiet household
                                    </label>

                                    <label>
                                        <input type="radio" name="best_fit_for_home"
                                            wire:model.live="best_fit_for_home" value="Experienced pet owner">
                                        🐾 Experienced pet owner
                                    </label>
                                    <label>
                                        <input type="radio" name="best_fit_for_home"
                                            wire:model.live="best_fit_for_home" value="Other">
                                      ❓ Other (Please specify):

                                    </label>

                                    @error('best_fit_for_home')
                                        <small class="errors-msg">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>


                            @if ($best_fit_for_home == 'Other')
                                <div class="type-selection-row">
                                    <div class="type-selection-label">
                                        <label>Details
                                        </label>
                                    </div>
                                    <div class="form-group @error('best_fit_for_home_deatils') has-error @enderror">
                                        <textarea name="best_fit_for_home_deatils" wire:model="best_fit_for_home_deatils"></textarea>

                                        @error(' best_fit_for_home_deatils')
                                            <small class="errors-msg">{{ $message }}</small>
                                        @enderror

                                    </div>
                                </div>
                            @endif

                            <div class="type-selection-row">
                                <div class="type-selection-label">
                                    <label>Does your pet require a secure outdoor space? <span>*</span>
                                    </label>
                                </div>



                                <div class="form-group @error('need_outdoor_space') has-error @enderror radio-row">
                                    <label>
                                        <input type="radio" name="need_outdoor_space"
                                            wire:model.live="need_outdoor_space" value="Yes">✅ Yes

                                    </label>
                                    <label>
                                        <input type="radio" name="need_outdoor_space"
                                            wire:model.live="need_outdoor_space" value="No">
                                        ❌ No
                                    </label>


                                    @error('need_outdoor_space')
                                        <small class="errors-msg">{{ $message }}</small>
                                    @enderror



                                </div>
                            </div>
                            
                             <div class="type-selection-row">
                                <div class="type-selection-label">
                                    <label>How much time does your pet typically require each day for companionship? (Helps us match them with a home that can meet their needs.) </label>
                                </div>
                                <div class="form-group class="form-group @error('size') has-error @enderror>

                                    <select wire:model="dedicated_time">

                                        <option value="">-- Select --</option>
                                        <option value="Less than 1 hour">🕒 Less than 1 hour</option>
                                        <option value="1–3 hours">🕒 1–3 hours
                                        </option>
                                        <option value="More than 3 hours">🕒 More than 3 hours
                                        </option>
                                       

                                    </select>

                                    @error('iscomportable_children')
                                        <small class="errors-msg">{{ $message }}</small>
                                    @enderror

                                </div>
                            </div>

                            
                        </div>   
                        
                        <div class="type-selection-row">
                            <div class="type-selection-head">
                                <div class="type-selection-title">
                                    <i class="rtcl-icon-s-tags"></i>
                                     <strong>Rehoming Reason</strong> 
                                </div>
                            </div> 
                              <div class="type-selection-row">
                                <div class="type-selection-label">
                                    <label>Why are you looking to rehome this pet?
                                    </label>
                                </div>
                                <div class="form-group @error('why_rehome') has-error @enderror">
                                    <textarea name="why_rehome" wire:model="why_rehome"></textarea>

                                    @error('why_rehome')
                                        <small class="errors-msg">{{ $message }}</small>
                                    @enderror

                                </div>
                            </div>
                        </div> 
                    
                        
                        <div class="type-selection-row">
                            <div class="type-selection-label">
                                <label>Pet Weight </label>
                            </div>
                            <div class="form-group @error('name') has-error @enderror">
                                <input type="number" step="any" wire:model.live="weight" placeholder="kg">
                                @if($weight)
                                <span>{{$weight}} kg</span>
                                @endif
                                @error('weight')
                                    <small class="errors-msg">{{ $message }}</small>
                                @enderror

                            </div>
                        </div>
                    
                      
                        <div class="type-selection-ro