<!-- Beginning main content section -->
<section class="main-content-wrap my-listing-page">
    <!-- Begin hero section -->
    <section class="banner">
        <img src="{{ asset('customer/img/my-listing/listing-hero-img.png') }}">
        <div class="common-wrap">
            <div class="banner-inner">
                <div class="banner-text">
                    <h1>Rehome Your Pet</h1>
                    <div class="listing-breadcrumbs">
                        <ul>
                            <li><a href="#">home</a><i class="rtcl-icon-angle-right"></i></li>
                            <li><a href="#">Rehome Your Pet</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End hero section -->
    <div class="my-listing-content">
        <form wire:submit.prevent="save" class="category-form" enctype="multipart/form-data">
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
                                        <option value="Large">🐕 Large</option>
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
                                            <option value="Couch Potato">🛋️ Couch Potato: Prefers lounging and
                                                relaxing; minimal activity needs.</option>
                                            <option value="Energetic">⚡ Energetic: Always on the go; loves playtime and
                                                adventures.</option>
                                            <option value="Adaptable">⚖️ Adaptable: Comfortable with both playtime and
                                                relaxation; displays a balanced temperament.</option>


                                        </select>

                                        @error('personality')
                                            <small class="errors-msg">{{ $message }}</small>
                                        @enderror

                                    </div>
                                    {{--

                                <div class="form-group form-group @error('size') has-error @enderror personality">
                                    <input type="text" wire:model="size">
                                     @foreach (['Couch Potato', 'A Bundle of Energy', 'Balanced', 'Playful', 'Friendly', 'Affectionate', 'Loyal', 'Calm', 'Shy', 'Curious', 'Intelligent'] as $index => $personality)
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
                                <div
                                    class="form-group @error('special_need') has-error has-error-abs @enderror radio-row">
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
                                        class="form-group @error('iscomportable_other_pet') has-error has-error-abs @enderror radio-row">
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
                                        class="form-group @error('iscomportable_other_pet_cat') has-error has-error-abs @enderror radio-row">
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


                                        @error('iscomportable_other_pet_cat')
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
                                        class="form-group @error('iscomportable_other_pet') has-error has-error-abs @enderror radio-row">
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


                                        @error('iscomportable_others_pets')
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
                                        <label>What kind of home would best suit your pet? (Select
                                            one)<span>*</span></label>
                                    </div>



                                    <div
                                        class="form-group @error('best_fit_for_home') has-error has-error-abs @enderror radio-row">
                                        <label>
                                            <input type="radio" name="best_fit_for_home"
                                                wire:model.live="best_fit_for_home" value="Active household">🏃‍♂️
                                            Active household

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
                                        <div
                                            class="form-group @error('best_fit_for_home_deatils') has-error @enderror">
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



                                    <div
                                        class="form-group @error('need_outdoor_space') has-error has-error-abs @enderror radio-row">
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
                                        <label>How much time does your pet typically require each day for companionship?
                                            (Helps us match them with a home that can meet their needs.) </label>
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

                                        @error('dedicated_time')
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
                                    @if ($weight)
                                        <span>{{ $weight }} kg</span>
                                    @endif
                                    @error('weight')
                                        <small class="errors-msg">{{ $message }}</small>
                                    @enderror

                                </div>
                            </div>


                            <div class="type-selection-row">
                                <div class="type-selection-label">
                                    <label>Pet Colour <span>*</span></label>
                                </div>
                                <div class="form-group has-error">
                                    <select wire:model="colour">
                                        <option>Select Pet Colour</option>
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
                                    @error('colour')
                                        <small class="errors-msg">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>



                            <div class="type-selection-row">
                                <div class="type-selection-label">
                                    <label>Adoption fee <span>*</span></label>
                                </div>
                                <div class="form-group @error('name') has-error @enderror">
                                    <input type="number" wire:model="price" placeholder="Price In Pound">
                                    <!--<span>Price In Pound</span>-->
                                    @error('price')
                                        <small class="errors-msg">{{ $message }}</small>
                                    @enderror

                                </div>
                            </div>




                            <div class="type-selection-row">
                                <div class="type-selection-label">
                                    <label>Pet description<span>*</span></label>
                                </div>
                                <textarea class="default-editor" wire:model="description"></textarea>
                                @error('description')
                                    <small class="errors-msg">{{ $message }}</small>
                                @enderror

                            </div>

                            <div class="type-selection-item features health-docs ">
                                <div class="type-selection-head">
                                    <div class="type-selection-title">
                                        <i class="rtcl-icon-s-tags"></i>
                                        <h5>Pre-adoption checks<span>*</span></h5>
                                    </div>
                                </div>
                                <div class="type-selection-row check-box-wrap">

                                    <div class="form-group">
                                        <div class="check-box-row">

                                            <input type="checkbox" wire:model="microchipped_status"
                                                id="microchipped_status" value="1">
                                            <label for="microchipped_status"> Microchipped by collection date</label>

                                        </div>
                                        <div class="check-box-row">

                                            <input type="checkbox" wire:model="neutered_status" id="neutered_status"
                                                value="1">
                                            <label for="neutered_status"> Neutered</label>

                                        </div>
                                        <div class="check-box-row">

                                            <input type="checkbox" wire:model="vaccinations_status"
                                                id="vaccinations_status" value="1">
                                            <label for="vaccinations_status"> Vaccinations up to date</label>

                                        </div>
                                        <div class="check-box-row">

                                            <input type="checkbox" wire:model="worm_status" id="worm_status"
                                                value="1">
                                            <label for="worm_status"> Worm and flea treated</label>

                                        </div>
                                        <div class="check-box-row">

                                            <input type="checkbox" wire:model="health_checked" id="health_checked"
                                                value="1">
                                            <label for="health_checked"> Health Checked</label>

                                        </div>
                                        <div class="check-box-row">

                                            <input type="checkbox" wire:model="special_medical_care"
                                                id="special_medical_care" value="1">
                                            <label for="special_medical_care">Special medical care required</label>

                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="type-selection-item">
                                <div class="type-selection-head">
                                    <div class="type-selection-title">
                                        <i class="rtcl-icon-s-tags"></i>
                                        <h5>Upload pet picture<span>*</span></h5>
                                    </div>
                                </div>

                                <div class="gallery-uploads thumbnail-add">
                                    <h4>Drop files here to add them.</h4>


                                    <!--<input type="file" id="gallery-upload" wire:model="images"   multiple required>-->
                                    <input type="file" wire:model="newImages" multiple
                                        accept="image/jpeg,image/png,image/jpg,image/gif/webp" required="">




                                </div>
                                <p>Maximum image upload size is 10 MB</p>
                                @error('newImages')
                                    <small class="errors-msg">{{ $message }}</small>
                                @enderror

                                @error('newImages')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                                @error('newImages.*')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror

                                @if ($images)
                                    <div class="uploads-alert mt-4">

                                        @foreach ($images as $index => $image)
                                            <div class="relative inline-block mr-2">
                                                <img src="{{ $image->temporaryUrl() }}" alt="Preview"
                                                    style="height: 50px; width: 50px;">
                                                <button type="button"
                                                    wire:click="removeImage({{ $index }})">X</button>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif


                            </div>

                            <div class="type-selection-item">

                                <div class="type-selection-row">
                                    <div class="type-selection-label">
                                        <label>Select Location<span>*</span></label>
                                    </div>
                                    <div class="form-group @error('uk_state_id') has-error @enderror">
                                        <select wire:model="uk_state_id" id="select2">
                                            <option value="">--Select Location--</option>
                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}">{{ $state->state }}</option>
                                            @endforeach


                                        </select>
                                        @error('uk_state_id')
                                            <small class="errors-msg">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>


                                @if ($errors->any())
                                    <div class="type-selection-item">

                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <small class="errors-msg">{{ $error }}</small> <br>
                                            @endforeach
                                        </ul>

                                    </div>
                                @endif

                                <div class="type-selection-row terms-conditions-wrap">

                                    <div class="form-group">
                                        <div class="checkbox-row ">
                                            <input type="checkbox" id="checked-2" wire:model="isPromoted">
                                            <label for="checked-1">Promote this pet on social media for $9.99</label>
                                        </div>

                                         <div class="checkbox-row ">
                                            <input type="checkbox" id="checked-2" wire:model="isPromoted">
                                            <label for="checked-1">Promote my pet on @FurDopt’s Instagram Story &
                                                Facebook Group (Optional)
                                                <br>
                                                Boost visibility by sharing your pet with our engaged adoption community
                                                across social media.</label>
                                        </div>

                                        <div class="checkbox-row terms-conditions">
                                            <input type="checkbox" id="checked-2" name="vehicle1" value="Bike">
                                            <label for="checked-1">I have read and agree to the website <a
                                                    href="{{ !empty($terms->slug) ? route('f.page', $terms->slug) : route('f.index') }}">Terms
                                                    and conditions</a>.</label>
                                        </div>

                                        <button type="submit" wire:loading.remove wire:target="save"
                                            class="submit-button">Submit for rehome </button>


                                        <!--                                 <div wire:loading wire:target="save"> -->
                                        <!--          ⏳Creating Listing.-->
                                        <!--</div>-->
                                        <!--                            </div>-->

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
        </form>
    </div>
</section>

@push('scripts')
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('fileUploaded', file => {
                @this.call('addImage', file);
            });
        });
    </script>
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

            $('#select2').on('change', function(e) {

                var data = $('#select2').select2("val");

                // @this.set('selCity', data);

            });


        });
    </script>
    <script>
        document.getElementById('inputGroupFile03').addEventListener('change', function(event) {
            const preview = document.getElementById('image-preview');
            preview.innerHTML = ''; // Clear previous previews

            const files = event.target.files;

            if (files) {
                Array.from(files).forEach(file => {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'rounded border';
                        img.style.maxWidth = '150px';
                        img.style.maxHeight = '150px';
                        preview.appendChild(img);
                    }

                    reader.readAsDataURL(file);
                });
            }
        });
    </script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.hook('component.upload-progress', (event) => {
                // Update progress bar value
                @this.set('uploadProgress', event.detail.progress);
            });
        });
    </script>
@endpush
