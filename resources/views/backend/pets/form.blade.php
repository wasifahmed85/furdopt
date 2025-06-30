@extends('backend.master')
@push('css')
    <!-- summernote -->
    {{-- <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.min.css')}}"> --}}
@endpush



@section('content')

    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Create Pet Listing</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Pet Listings</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pet Listing Create</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>


    <!-- Main content -->
    <div class="app-content">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add New Pet</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pets.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">


                            {{-- <div class="col-md-6 mb-3">
                                <label for="ad_type" class="form-label">Ad Type</label>
                                <select name="ad_type" id="ad_type"
                                    class="form-select @error('ad_type') is-invalid @enderror" required>
                                    <option value="">Select Ad Type</option>

                                    <option value="rehome">Rehome</option>
                                    <option value="adopt">Adpot</option>

                                </select>
                                @error('ad_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> --}}



                            <!-- Category Selection -->
                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" id="category_id"
                                    class="form-select @error('category_id') is-invalid @enderror" required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Breed/Sub Category Selection -->
                            {{-- <div class="col-md-6 mb-3">
                                <label for="sub_category_id" class="form-label">Breed</label>
                                <select name="sub_category_id" id="sub_category_id"
                                    class="form-select @error('sub_category_id') is-invalid @enderror" required>
                                    {{-- <option value="">Select Breed</option>
                                    @foreach ($subCategories as $breed)
                                        <option value="{{ $breed->id }}">{{ $breed->name }}</option>
                                    @endforeach 
                            </select>
                            @error('sub_category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}
                            <div class="col-md-6 mb-3">
                                <label for="sub_category_id" class="form-label">Breed</label>
                                <select name="sub_category_id" id="subCategoryID"
                                    class="form-select @error('sub_category_id') is-invalid @enderror" required>

                                </select>
                                @error('sub_category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Pet Name -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Pet Name <span>*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Charity Name <span></span></label>
                                <input type="text" class="form-control @error('charity_name_admin') is-invalid @enderror"
                                    id="name" name="charity_name_admin" required>
                                @error('charity_name_admin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                             <!-- Gender -->
                            <div class="col-md-6 mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select name="gender" id="gender"
                                    class="form-select @error('gender') is-invalid @enderror" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Unknown">Unknown</option>
                                </select>

                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Age -->
                            <div class="col-md-6 mb-3">
                                <label for="age" class="form-label">Pet Age <span>*</span></label>
                                <!--<input type="text" class="form-control @error('age') is-invalid @enderror" id="age"-->
                                <!--    name="age" required>-->
                                <select name="age" id="age" class="form-select @error('age') is-invalid @enderror"
                                    required>
                                    <option value="">Select Pet Age</option>

                                    <option value="Baby">Baby</option>
                                    <option value="Young">Young</option>
                                    <option value="Adult">Adult</option>
                                    <option value="Senior">Senior</option>
                                    <option value="Age unknown">Age unknown</option>
                                </select>
                                @error('age')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

   <!-- Pet Name -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">DOB </label>
                                <input type="date" class="form-control @error('dob') is-invalid @enderror"
                                    id="name" name="dob" >
                                @error('dob')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                              <!-- Size -->
                            <div class="col-md-6 mb-3">
                                <label for="size" class="form-label">Size<span>*</span></label>
                                <!--<input type="text" class="form-control @error('size') is-invalid @enderror"-->
                                <!--    id="age" name="size">-->
                                <select name="size" id="size"
                                    class="form-select @error('size') is-invalid @enderror" required>
                                    <option value="null">Select Size</option>
                                    <option value="Small">Small</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Large">Large</option>
                                    <option value="Unknown">Unknown</option>
                                </select>
                                @error('size')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                      
                            
                        <div class="col-md-6 mb-3">
                               
                                     <label>
                                     How would you describe your pet’s personality? (Select one)
                                      </label>
                              
                                  

                                <select name="personality"  class="form-select @error('size') is-invalid @enderror" required>
                                    <option value="">Select pet personality</option>
                                    <option value="Couch Potato">🛋️ Couch Potato: Prefers lounging and relaxing; minimal activity needs.</option>
                                    <option value="Energetic">⚡ Energetic: Always on the go; loves playtime and adventures.</option>
                                    <option value="Adaptable">⚖️ Adaptable: Comfortable with both playtime and relaxation; displays a balanced temperament.</option>
                                    

                                </select>

                                @error('personality')
                                    <small class="errors-msg">{{ $message }}</small>
                                @enderror

                            </div>
                            
                            
                                      <div class="col-md-6 mb-3">
                                <div class="type-selection-label">
                                    <label>Does your pet have any special needs or medical conditions?
                                        <span>*</span>
                                    </label>
                                </div>
                                <div class="form-group @error('iscomportable_other_pet') has-error @enderror radio-row">
                                    <label>
                                        <input type="radio" name="special_need" value="Yes"
                                            onclick="toggleDetailsMedical(true)">
                                        Yes
                                    </label>

                                    <label>
                                        <input type="radio" name="special_need" value="No"
                                            onclick="toggleDetailsMedical(false)">
                                        No
                                    </label>

                                    

                                    @error('special_need')
                                        <small class="errors-msg">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="type-selection-row" id="detailsBoxMedical" style="display: none;">
                                    <div class="type-selection-label">
                                        <label>Details
                                        </label>
                                    </div>
                                    <div class="form-group @error('name') has-error @enderror">
                                        <textarea name="special_details"></textarea>

                                        @error('special_need')
                                            <small class="errors-msg">{{ $message }}</small>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            <div class="col-md-6 mb-3">
                                <div class="type-selection-label">
                                    <label>Is your pet comfortable around other dog?
                                        <span>*</span>
                                    </label>
                                </div>
                                <div class="form-group @error('iscomportable_other_pet') has-error @enderror radio-row">
                                    <label>
                                        <input type="radio" name="iscomportable_other_pet" value="Yes"
                                            onclick="toggleDetails(false)">
                                        Yes
                                    </label>

                                    <label>
                                        <input type="radio" name="iscomportable_other_pet" value="No"
                                            onclick="toggleDetails(false)">
                                        No
                                    </label>

                                    <label>
                                        <input type="radio" name="iscomportable_other_pet" value="Unsure"
                                            onclick="toggleDetails(true)">
                                        Unsure (Please specify details in the text box, e.g., which types of pets
                                        they’ve interacted with).

                                    </label>


                                    @error('iscomportable_other_pet')
                                        <small class="errors-msg">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="type-selection-row" id="detailsBox" style="display: none;">
                                    <div class="type-selection-label">
                                        <label>Details
                                        </label>
                                    </div>
                                    <div class="form-group @error('name') has-error @enderror">
                                        <textarea name="iscomportable_details"></textarea>

                                        @error('iscomportable_details')
                                            <small class="errors-msg">{{ $message }}</small>
                                        @enderror

                                    </div>
                                </div>
                            </div>



                            <div class="col-md-6 mb-3">
                                <div class="type-selection-label">
                                    <label>Is your pet comfortable around other cat?
                                        <span>*</span>
                                    </label>
                                </div>
                                <div
                                    class="form-group @error('iscomportable_other_pet_cat') has-error @enderror radio-row">
                                    <label>
                                        <input type="radio" name="iscomportable_other_pet_cat" value="Yes"
                                            onclick="toggleDetailsCat(false)">
                                        Yes
                                    </label>

                                    <label>
                                        <input type="radio" name="iscomportable_other_pet_cat" value="No"
                                            onclick="toggleDetailsCat(false)">
                                        No
                                    </label>

                                    <label>
                                        <input type="radio" name="iscomportable_other_pet_cat" value="Unsure"
                                            onclick="toggleDetailsCat(true)">
                                        Unsure (Please specify details in the text box, e.g., which types of pets
                                        they’ve interacted with).

                                    </label>


                                    @error('iscomportable_other_pet')
                                        <small class="errors-msg">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="type-selection-row" id="detailsBoxCat" style="display: none;">
                                    <div class="type-selection-label">
                                        <label>Details
                                        </label>
                                    </div>
                                    <div class="form-group @error('name') has-error @enderror">
                                        <textarea name="iscomportable_other_pet_cat_details"></textarea>

                                        @error('iscomportable_other_pet_cat_details')
                                            <small class="errors-msg">{{ $message }}</small>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                            
                               <div class="col-md-6 mb-3">
                                <div class="type-selection-label">
                                    <label>Is your pet comfortable around other pets? (Rabbits, Birds, etc?)
                                        <span>*</span>
                                    </label>
                                </div>
                                <div
                                    class="form-group @error('iscomportable_other_pet_cat') has-error @enderror radio-row">
                                    <label>
                                        <input type="radio" name="iscomportable_others_pets" value="Yes"
                                            onclick="toggleDetailsPetOther(false)">
                                        Yes
                                    </label>

                                    <label>
                                        <input type="radio" name="iscomportable_others_pets" value="No"
                                            onclick="toggleDetailsPetOther(false)">
                                        No
                                    </label>

                                    <label>
                                        <input type="radio" name="iscomportable_others_pets" value="Unsure"
                                            onclick="toggleDetailsPetOther(true)">
                                        Unsure (Please specify details in the text box, e.g., which types of pets
                                        they’ve interacted with).

                                    </label>


                                    @error('iscomportable_other_pet')
                                        <small class="errors-msg">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="type-selection-row" id="detailsBoxOtherPet" style="display: none;">
                                    <div class="type-selection-label">
                                        <label>Details
                                        </label>
                                    </div>
                                    <div class="form-group @error('name') has-error @enderror">
                                        <textarea name="iscomportable_others_pet_details"></textarea>

                                        @error('iscomportable_others_pet_details')
                                            <small class="errors-msg">{{ $message }}</small>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            <div class="col-md-6 mb-3">
                                <label for="colour" class="form-label">Is your pet comfortable around children?
                                    <span>*</span></label>
                                <select name="iscomportable_children" id="colour"
                                    class="form-select @error('iscomportable_children') is-invalid @enderror" required>

                                   
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
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            
                               <div class="col-md-6 mb-3">
                                <div class="type-selection-label">
                                    <label>What kind of home do you believe would be the best fit for this pet?
                                        <span>*</span></label>
                                </div>



                                <div class="form-group @error('best_fit_for_home') has-error @enderror radio-row">
                                    <label>
                                        <input type="radio" name="best_fit_for_home" value="Active household"
                                            onclick="toggleDetailsBest(false)">Active
                                        household
                                    </label>
                                    <label>
                                        <input type="radio" name="best_fit_for_home" value="Quiet household"
                                            onclick="toggleDetailsBest(false)">
                                        Quiet household
                                    </label>

                                    <label>
                                        <input type="radio" name="best_fit_for_home" value="Experienced pet owner"
                                            onclick="toggleDetailsBest(false)">
                                        Experienced pet owner
                                    </label>
                                    <label>
                                        <input type="radio" name="best_fit_for_home" value="Other"
                                            onclick="toggleDetailsBest(true)">
                                        Other: (Please specify in the text box).

                                    </label>

                                    @error('best_fit_for_home')
                                        <small class="errors-msg">{{ $message }}</small>
                                    @enderror




                                </div>
                                <div class="type-selection-row" id="detailsBoxBest" style="display: none;">
                                    <div class="type-selection-label">
                                        <label>Details
                                        </label>
                                    </div>
                                    <div class="form-group @error('best_fit_for_home_deatils') has-error @enderror">
                                        <textarea name="best_fit_for_home_deatils"></textarea>

                                        @error(' best_fit_for_home_deatils')
                                            <small class="errors-msg">{{ $message }}</small>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <div class="type-selection-label">
                                    <label>Does your pet require a secure outdoor space? <span>*</span>
                                    </label>
                                </div>



                                <div class="form-group @error('need_outdoor_space') has-error @enderror radio-row">
                                    <label>
                                        <input type="radio" name="need_outdoor_space" value="Yes">Yes
                                    </label>
                                    <label>
                                        <input type="radio" name="need_outdoor_space" value="No">
                                        No
                                    </label>


                                    @error('need_outdoor_space')
                                        <small class="errors-msg">{{ $message }}</small>
                                    @enderror



                                </div>
                            </div>

                            
                            <div class="col-md-6 mb-3">
                                <label for="dedicated_time" class="form-label">How much time does your pet typically require each day for companionship? (Helps us match them with a home that can meet their needs.)</label>
                                <select name="dedicated_time" id="colour"
                                    class="form-select @error('colour') is-invalid @enderror" >
                                  
                                      <option value="">-- Select --</option>
                            <option value="Less than 1 hour">🕒 Less than 1 hour</option>
                            <option value="1–3 hours">🕒 1–3 hours
                            </option>
                            <option value="More than 3 hours">🕒 More than 3 hours
                            </option>
                                </select>

                                @error('colour')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Pet Name -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Weight</label>
                                <input type="number" step="any" class="form-control @error('weight') is-invalid @enderror"
                                    id="name" name="weight" placeholder="kg">
                                @error('weight')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                          

                           

                            <div class="col-md-6 mb-3">
                                <label for="colour" class="form-label">Pet Colour</label>
                                <select name="colour" id="colour"
                                    class="form-select @error('colour') is-invalid @enderror" required>
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
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                         

                    




                            <!-- Price -->
                            
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Adoption fee </label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror"
                                    id="price" name="price" >
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- health -->
                            <div class="col-md-6 mb-3">
                                <label for="location" class="form-label">Pre-adoption checks<span>*</span></label>
                                <fieldset class="row mb-3">

                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="microchipped_status"
                                                id="microchipped_status" value="1">

                                            <label class="form-check-label" for="microchipped_status"> Microchipped by
                                                collection
                                                date</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="neutered_status"
                                                id="neutered_status" value="1">
                                            <label class="form-check-label" for="neutered_status"> Neutered </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="vaccinations_status"
                                                id="vaccinations_status" value="1">
                                            <label class="form-check-label" for="vaccinations_status"> Vaccinations up to
                                                date </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="worm_status"
                                                id="worm_status" value="1">
                                            <label class="form-check-label" for="worm_status"> Worm and flea
                                                treated</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="health_checked"
                                                id="health_checked" value="1">
                                            <label class="form-check-label" for="health_checked"> Health
                                                Checked</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="special_medical_care"
                                                id="special_medical_care" value="1">
                                            <label class="form-check-label" for="special_medical_care"> Special medical
                                                care required</label>
                                        </div>
                                    </div>

                                </fieldset>
                            </div>



                            <div class="col-md-6 mb-3">
                                <label for="uk_state_id" class="form-label">locations</label>
                                <select name="uk_state_id" id="uk_state_id"
                                    class="form-select @error('uk_state_id') is-invalid @enderror" required>
                                    <option value="">Select Location</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->state }}</option>
                                    @endforeach
                                </select>
                                @error('uk_state_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>








                            <div class="col-md-6 mb-3">
                                <label for="description" class="form-label">Why are you looking to rehome this
                                    pet?</label>
                                <textarea class="form-control @error('why_rehome') is-invalid @enderror" name="why_rehome" rows="3"></textarea>
                                @error('why_rehome')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                         





                            <!-- Description -->
                            <div class="col-md-12 mb-3">
                                <label for="description" class="form-label">Pet description<span>*</span></label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3" required=""></textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- About -->

                            <div class="row">



                                <div class="col-md-6 mb-3">
                                    <label for="description" class="form-label">Gallery Images</label>
                                    <div class="input-group mb-3">

                                        <input type="file" class="form-control" id="inputGroupFile03" name="images[]"
                                            multiple>
                                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                    </div>
                                        <div id="image-preview" class="mt-3 d-flex flex-wrap gap-2"></div>

                                    @error('images')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Meta Title -->
                            {{-- <div class="col-md-12 mb-3">
                                <label for="meta_title" class="form-label">Meta Title</label>
                                <input type="text" class="form-control @error('meta_title') is-invalid @enderror"
                                    id="meta_title" name="meta_title" required>
                                @error('meta_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> --}}

                            <!-- Meta Description -->
                            {{-- <div class="col-md-12 mb-3">
                                <label for="meta_description" class="form-label">Meta Description</label>
                                <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description"
                                    name="meta_description" rows="3" required></textarea>
                                @error('meta_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> --}}

                            <!-- Meta Keywords -->
                            {{-- <div class="col-md-12 mb-3">
                                <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror"
                                    id="meta_keywords" name="meta_keywords" required>
                                @error('meta_keywords')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> --}}
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                                <label class="form-check-label" for="exampleCheck1">I have read and agree to the website
                                    terms and conditions.</label>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('admin.pets.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


    </div>




@endsection
@push('js')

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


    <script type="text/javascript">
        // $(document).ready(function() {
        //     $("#category_id").change(function() {
        //         let categoryId = $(this).val();

        //         if (categoryId) {
        //             $.get("{{ url('/get-subcategory') }}", {
        //                 category_id: categoryId
        //             }, function(data) {
        //                 $('#subCategoryID').html(data.html);
        //             });
        //         } else {
        //             $('#sub_category_id').html('<option value="">Select Subcategory</option>');
        //         }
        //     });
        // });

        $("#category_id").change(function() {
            $.ajax({
                url: "{{ url('/get-subcategory') }}?category_id=" + $(this).val(),
                method: 'GET',
                success: function(data) {
                    $('#subCategoryID').html(data.html);
                }
            });
        });
    </script>

    <script>
        function toggleDetails(show) {
            document.getElementById("detailsBox").style.display = show ? "block" : "none";
        }
        function toggleDetailsMedical(show) {
            document.getElementById("detailsBoxMedical").style.display = show ? "block" : "none";
        }
        function toggleDetailsPetOther(show) {
            document.getElementById("detailsBoxOtherPet").style.display = show ? "block" : "none";
        }

        function toggleDetailsCat(show) {
            document.getElementById("detailsBoxCat").style.display = show ? "block" : "none";
        }

        function toggleDetailsBest(show) {
            document.getElementById("detailsBoxBest").style.display = show ? "block" : "none";
        }
    </script>
@endpush
