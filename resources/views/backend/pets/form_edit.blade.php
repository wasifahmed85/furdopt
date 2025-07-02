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
                    <h3 class="mb-0">Edit Pet Listing </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.pets.index') }}">Pet Listings</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pet Listing Edit</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>


    <!-- Main content -->
    <div class="app-content">
        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
        {{-- ========================= Start Errors  ========================= --}}
        {{-- Put this at the very top of form_edit.blade.php (or your layout file) --}}
        @php
            // Check if $errors is currently a string (due to controller's `with('errors', '...')`)
if (is_string($errors)) {
    // Temporarily store the string message
    $customErrorMessage = $errors;

    // Create a new empty ViewErrorBag
    $errors = new \Illuminate\Support\ViewErrorBag();

    // Add the custom error message to the default bag
    // You can assign it to a 'general' key or any key you prefer
    $errors->add('general', $customErrorMessage);
            }
        @endphp

        {{-- NOW, your existing error display logic will work correctly --}}

        {{-- This block will now work for both validation errors AND your custom string error --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- ========================= End Errors  ========================= --}}
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Pet Listing</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pets.update', $pet->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">





                            <!-- Category Selection -->
                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" id="category_id"
                                    class="form-select @error('category_id') is-invalid @enderror" required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $pet->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
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
                                    @foreach ($subCategories as $breed)
                                        <option value="{{ $breed->id }}"
                                            {{ $pet->sub_category_id == $breed->id ? 'selected' : '' }}>
                                            {{ $breed->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('sub_category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Pet Name -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Pet Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" required value="{{ $pet->name }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Charity Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="charity_name_admin" value="{{ $pet->charity_name_admin }}">
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
                                    <option value="Male" {{ $pet->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ $pet->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Unkonwn" {{ $pet->gender == 'Unkonwn' ? 'selected' : '' }}>Unkonwn
                                    </option>
                                </select>

                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Age -->
                            <div class="col-md-6 mb-3">
                                <label for="age" class="form-label">Pet Age</label>
                                <select name="age" id="age" class="form-select @error('age') is-invalid @enderror"
                                    required>


                                    <option {{ $pet->age == 'Baby' ? 'selected' : '' }} value="Baby">Baby</option>
                                    <option {{ $pet->age == 'Young' ? 'selected' : '' }} value="Young">Young</option>
                                    <option {{ $pet->age == 'Adult' ? 'selected' : '' }} value="Adult">Adult</option>
                                    <option {{ $pet->age == 'Senior' ? 'selected' : '' }} value="Senior">Senior</option>
                                    <option {{ $pet->age == 'Age unknown' ? 'selected' : '' }} value="Age unknown">Age
                                        unknown</option>
                                </select>
                                @error('age')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">DOB </label>
                                <input type="date" class="form-control @error('dob') is-invalid @enderror" id="name"
                                    name="dob" value="{{ $pet->dob }}">
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
                                    <option>Select Size</option>
                                    <option {{ $pet->size == 'Small' ? 'selected' : '' }} value="Small">Small
                                    </option>
                                    <option {{ $pet->size == 'Medium' ? 'selected' : '' }} value="Medium">Medium</option>
                                    <option {{ $pet->size == 'Large' ? 'selected' : '' }} value="Large">Large</option>
                                    <option {{ $pet->size == 'Unknown' ? 'selected' : '' }} value="Unknown">Unknown
                                    </option>

                                </select>
                                @error('size')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="colour" class="form-label">Pet Colour</label>
                                <select name="colour" id="colour"
                                    class="form-select @error('colour') is-invalid @enderror" required>
                                    <option>Select Pet Colour</option>
                                    <option {{ $pet->colour == 'Black' ? 'selected' : '' }} value="Black">Black</option>
                                    <option {{ $pet->colour == 'White' ? 'selected' : '' }} value="White">White</option>
                                    <option {{ $pet->colour == 'Brown' ? 'selected' : '' }} value="Brown">Brown</option>
                                    <option {{ $pet->colour == 'Grey' ? 'selected' : '' }} value="Grey">Grey</option>
                                    <option {{ $pet->colour == 'Golden' ? 'selected' : '' }} value="Golden">Golden
                                    </option>
                                    <option {{ $pet->colour == 'Red' ? 'selected' : '' }} value="Red">Red</option>
                                    <option {{ $pet->colour == 'Cream' ? 'selected' : '' }} value="Cream">Cream</option>
                                    <option {{ $pet->colour == 'Tan' ? 'selected' : '' }} value="Tan">Tan</option>
                                    <option {{ $pet->colour == 'Blue' ? 'selected' : '' }} value="Blue ">Blue
                                        (Grayish-Blue)</option>
                                    <option {{ $pet->colour == 'Orange' ? 'selected' : '' }} value="Orange">Orange
                                    </option>
                                    <option {{ $pet->colour == 'Yellow' ? 'selected' : '' }} value="Yellow">Yellow
                                    </option>
                                    <option {{ $pet->colour == 'Green' ? 'selected' : '' }} value="Green ">Green </option>
                                    <option {{ $pet->colour == 'Multicolor' ? 'selected' : '' }} value="Multicolor">
                                        Multicolor / Mixed</option>
                                    <option {{ $pet->colour == 'Unknown' ? 'selected' : '' }} value="Unknown ">Unknown
                                    </option>
                                </select>

                                @error('colour')
                                    <div class="invalid-feedback">{{ $message }}</div>
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
                                        <input type="radio" {{ $pet->special_need == 'Yes' ? 'checked' : '' }}
                                            name="special_need" value="Yes" onclick="toggleDetailsMedical(true)">
                                        Yes
                                    </label>

                                    <label>
                                        <input type="radio" {{ $pet->special_need == 'No' ? 'checked' : '' }}
                                            name="special_need" value="No" onclick="toggleDetailsMedical(false)">
                                        No
                                    </label>



                                    @error('special_need')
                                        <small class="errors-msg">{{ $message }}</small>
                                    @enderror
                                </div>
                                @if ($pet->special_details != null)
                                    <div class="type-selection-row" id="detailsBoxMedical" style="display: none;">
                                        <div class="type-selection-label">
                                            <label>Details
                                            </label>
                                        </div>
                                        <div class="form-group @error('name') has-error @enderror">
                                            <textarea name="special_details">{{ $pet->special_details }}</textarea>

                                            @error('special_need')
                                                <small class="errors-msg">{{ $message }}</small>
                                            @enderror

                                        </div>
                                    </div>
                                @endif
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

                                <label>
                                    How would you describe your pet’s personality? (Select one)
                                </label>



                                <select name="personality" class="form-select @error('size') is-invalid @enderror"
                                    required>
                                    <option value="">Select pet personality</option>
                                    <option {{ $pet->personality == 'Couch Potato' ? 'selected' : '' }}
                                        value="Couch Potato">🛋️ Couch Potato: Prefers lounging and relaxing; minimal
                                        activity needs.</option>
                                    <option {{ $pet->personality == 'Energetic' ? 'selected' : '' }} value="Energetic">⚡
                                        Energetic: Always on the go; loves playtime and adventures.</option>
                                    <option {{ $pet->personality == 'Adaptable' ? 'selected' : '' }} value="Adaptable">⚖️
                                        Adaptable: Comfortable with both playtime and relaxation; displays a balanced
                                        temperament.</option>


                                </select>

                                @error('personality')
                                    <small class="errors-msg">{{ $message }}</small>
                                @enderror

                            </div>


                            <!-- Pet Name -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Weight</label>
                                <input type="text" class="form-control @error('weight') is-invalid @enderror"
                                    id="name" name="weight" placeholder="in /kg" value="{{ $pet->weight }}">
                                @error('weight')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Price -->
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Adoption fee</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror"
                                    id="price" name="price" value="{{ $pet->price }}">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- health -->
                            <div class="col-md-6 mb-3">
                                <label for="location" class="form-label">Pre-adoption checks*</label>
                                <fieldset class="row mb-3">

                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="microchipped_status"
                                                id="microchipped_status" value="1"
                                                {{ $pet->microchipped_status == 1 ? 'checked' : '' }}>

                                            <label class="form-check-label" for="microchipped_status"> Microchipped by
                                                collection
                                                date</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="neutered_status"
                                                id="neutered_status" value="1"
                                                {{ $pet->neutered_status == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="neutered_status"> Neutered </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="vaccinations_status"
                                                id="vaccinations_status" value="1"
                                                {{ $pet->vaccinations_status == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="vaccinations_status"> Vaccinations up
                                                to
                                                date </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="worm_status"
                                                id="worm_status" value="1"
                                                {{ $pet->worm_status == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="worm_status"> Worm and flea
                                                treated</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="health_checked"
                                                id="health_checked" value="1"
                                                {{ $pet->health_checked == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="health_checked"> Health
                                                Checked</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="special_medical_care"
                                                id="special_medical_care" value="1"
                                                {{ $pet->special_medical_care == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="special_medical_care"> Special medical
                                                care required</label>
                                        </div>
                                    </div>

                                </fieldset>
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
                                            onclick="toggleDetails(false)"
                                            {{ $pet->iscomportable_other_pet == 'Yes' ? 'checked' : '' }}>
                                        Yes
                                    </label>

                                    <label>
                                        <input type="radio" name="iscomportable_other_pet" value="No"
                                            onclick="toggleDetails(false)"
                                            {{ $pet->iscomportable_other_pet == 'No' ? 'checked' : '' }}>
                                        No
                                    </label>

                                    <label>
                                        <input type="radio" name="iscomportable_other_pet" value="Unsure"
                                            onclick="toggleDetails(true)"
                                            {{ $pet->iscomportable_other_pet == 'Unsure' ? 'checked' : '' }}>
                                        Unsure (Please specify details in the text box, e.g., which types of pets
                                        they’ve interacted with).

                                    </label>


                                    @error('iscomportable_other_pet')
                                        <small class="errors-msg">{{ $message }}</small>
                                    @enderror
                                </div>
                                @if ($pet->iscomportable_other_pet == 'Unsure')
                                    <div class="type-selection-row" id="detailsBox">
                                        <div class="type-selection-label">
                                            <label>Details
                                            </label>
                                        </div>
                                        <div class="form-group @error('name') has-error @enderror">
                                            <textarea name="iscomportable_details" class="form-control">{{ $pet->iscomportable_details }}</textarea>

                                            @error('iscomportable_details')
                                                <small class="errors-msg">{{ $message }}</small>
                                            @enderror

                                        </div>
                                    </div>
                                @else
                                    <div class="type-selection-row" id="detailsBox" style="display: none;">
                                        <div class="type-selection-label">
                                            <label>Details
                                            </label>
                                        </div>
                                        <div class="form-group @error('name') has-error @enderror">
                                            <textarea name="iscomportable_details" class="form-control">{{ $pet->iscomportable_details }}</textarea>

                                            @error('iscomportable_details')
                                                <small class="errors-msg">{{ $message }}</small>
                                            @enderror

                                        </div>
                                    </div>
                                @endif
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
                                            onclick="toggleDetailsCat(false)"
                                            {{ $pet->iscomportable_other_pet == 'Yes' ? 'checked' : '' }}>
                                        Yes
                                    </label>

                                    <label>
                                        <input type="radio" name="iscomportable_other_pet_cat" value="No"
                                            onclick="toggleDetailsCat(false)"
                                            {{ $pet->iscomportable_other_pet == 'No' ? 'checked' : '' }}>
                                        No
                                    </label>

                                    <label>
                                        <input type="radio" name="iscomportable_other_pet_cat" value="Unsure"
                                            onclick="toggleDetailsCat(true)"
                                            {{ $pet->iscomportable_other_pet == 'Unsure' ? 'checked' : '' }}>
                                        Unsure (Please specify details in the text box, e.g., which types of pets
                                        they’ve interacted with).

                                    </label>


                                    @error('iscomportable_other_pet')
                                        <small class="errors-msg">{{ $message }}</small>
                                    @enderror
                                </div>
                                @if ($pet->iscomportable_other_pet == 'Unsure')
                                    <div class="type-selection-row" id="detailsBoxCat">
                                        <div class="type-selection-label">
                                            <label>Details
                                            </label>
                                        </div>
                                        <div class="form-group @error('name') has-error @enderror">
                                            <textarea class="form-control" name="iscomportable_other_pet_cat_details">{{ $pet->iscomportable_other_pet_cat_details }}</textarea>

                                            @error('iscomportable_other_pet_cat_details')
                                                <small class="errors-msg">{{ $message }}</small>
                                            @enderror

                                        </div>
                                    </div>
                                @else
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
                                @endif
                            </div>


                            <div class="col-md-6 mb-3">
                                <label for="colour" class="form-label">Is your pet comfortable around children?
                                    <span>*</span></label>
                                <select name="iscomportable_children" id="colour"
                                    class="form-select @error('iscomportable_children') is-invalid @enderror" required>

                                    <option value="">--Select--</option>
                                    <option value="Comfortable with all children"
                                        {{ $pet->iscomportable_children == 'Comfortable with all children' ? 'selected' : '' }}>
                                        Comfortable with all
                                        children
                                    </option>

                                    <option value="Under 5 years old"
                                        {{ $pet->iscomportable_children == 'Under 5 years old' ? 'selected' : '' }}>Under 5
                                        years old
                                    </option>
                                    <option value="6–10 years old"
                                        {{ $pet->iscomportable_children == '6–10 years old' ? 'selected' : '' }}>6–10 years
                                        old
                                    </option>
                                    <option value="11–15 years old"
                                        {{ $pet->iscomportable_children == '11–15 years old' ? 'selected' : '' }}>11–15
                                        years old
                                    </option>
                                    <option value="16+ (Older, sensible children)"
                                        {{ $pet->iscomportable_children == '16+ (Older, sensible children)' ? 'selected' : '' }}>
                                        16+ (Older, sensible children)</option>
                                    <option value="Not comfortable with children"
                                        {{ $pet->iscomportable_children == 'Not comfortable with children' ? 'selected' : '' }}>
                                        Not comfortable with children
                                    </option>
                                </select>

                                @error('iscomportable_children')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="description" class="form-label">Why are you looking to rehome this
                                    pet?</label>
                                <textarea class="form-control @error('why_rehome') is-invalid @enderror" name="why_rehome" rows="3">{{ $pet->why_rehome }}</textarea>
                                @error('why_rehome')
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
                                            onclick="toggleDetailsBest(false)"
                                            {{ $pet->best_fit_for_home == 'Active household' ? 'checked' : '' }}>Active
                                        household
                                    </label>
                                    <label>
                                        <input type="radio" name="best_fit_for_home" value="Quiet household"
                                            onclick="toggleDetailsBest(false)"
                                            {{ $pet->best_fit_for_home == 'Quiet household' ? 'checked' : '' }}>
                                        Quiet household
                                    </label>

                                    <label>
                                        <input type="radio" name="best_fit_for_home" value="Experienced pet owner"
                                            onclick="toggleDetailsBest(false)"
                                            {{ $pet->best_fit_for_home == 'Experienced pet owner' ? 'checked' : '' }}>
                                        Experienced pet owner
                                    </label>
                                    <label>
                                        <input type="radio" name="best_fit_for_home" value="Other"
                                            onclick="toggleDetailsBest(true)"
                                            {{ $pet->best_fit_for_home == 'Other' ? 'checked' : '' }}>
                                        Other: (Please specify in the text box).

                                    </label>

                                    @error('best_fit_for_home')
                                        <small class="errors-msg">{{ $message }}</small>
                                    @enderror




                                </div>

                                @if ($pet->best_fit_for_home == 'Other')
                                    <div class="type-selection-row" id="detailsBoxBest">
                                        <div class="type-selection-label">
                                            <label>Details
                                            </label>
                                        </div>
                                        <div class="form-group @error('best_fit_for_home_deatils') has-error @enderror">
                                            <textarea name="best_fit_for_home_deatils">{{ $pet->best_fit_for_home_deatils }}</textarea>

                                            @error(' best_fit_for_home_deatils')
                                                <small class="errors-msg">{{ $message }}</small>
                                            @enderror

                                        </div>
                                    </div>
                                @else
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
                                @endif

                            </div>


                            <div class="col-md-6 mb-3">
                                <div class="type-selection-label">
                                    <label>Does your pet require a secure outdoor space? <span>*</span>
                                    </label>
                                </div>



                                <div class="form-group @error('need_outdoor_space') has-error @enderror radio-row">
                                    <label>
                                        <input type="radio" name="need_outdoor_space" value="Yes"
                                            {{ $pet->need_outdoor_space == 'Yes' ? 'checked' : '' }}>Yes
                                    </label>
                                    <label>
                                        <input type="radio" name="need_outdoor_space" value="No"
                                            {{ $pet->need_outdoor_space == 'No' ? 'checked' : '' }}>
                                        No
                                    </label>


                                    @error('need_outdoor_space')
                                        <small class="errors-msg">{{ $message }}</small>
                                    @enderror



                                </div>
                            </div>



                            <div class="col-md-6 mb-3">
                                <label for="dedicated_time" class="form-label">How much time does your pet typically
                                    require each day for companionship? (Helps us match them with a home that can meet their
                                    needs.)</label>
                                <select name="dedicated_time" id="colour"
                                    class="form-select @error('dedicated_time') is-invalid @enderror">

                                    <option value="">-- Select --</option>
                                    <option {{ $pet->dedicated_time == 'Less than 1 hour' ? 'selected' : '' }}
                                        value="Less than 1 hour">🕒 Less than 1 hour</option>
                                    <option {{ $pet->dedicated_time == '1–3 hours' ? 'selected' : '' }}
                                        value="1–3 hours">🕒 1–3 hours
                                    </option>
                                    <option {{ $pet->dedicated_time == 'More than 3 hours' ? 'selected' : '' }}
                                        value="More than 3 hours">🕒 More than 3 hours
                                    </option>
                                </select>

                                @error('dedicated_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="uk_state_id" class="form-label">Locations</label>
                                <select name="uk_state_id" id="uk_state_id"
                                    class="form-select @error('uk_state_id') is-invalid @enderror" required>
                                    <option value="">Select Location</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}"
                                            {{ $pet->uk_state_id == $state->id ? 'selected' : '' }}>
                                            {{ $state->state }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('uk_state_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>



                            <!-- Description -->
                            <div class="col-md-12 mb-3">
                                <label for="description" class="form-label">Pet Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3">{!! $pet->description !!}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- About -->

                            <div class="row">



                                <div class="col-md-12 mb-3">
                                    <label for="description" class="form-label">Upload pet picture</label>
                                    <div class="input-group mb-3">

                                        <input type="file" class="form-control" id="inputGroupFile03" name="images[]"
                                            multiple>
                                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                        @if (session('errors'))
                                            <div class="alert alert-success">
                                                {{ session('errors') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div id="image-preview" class="mt-3 d-flex flex-wrap gap-2"></div>
                                    @foreach ($petimages as $img)
                                        <img src="{{ asset('images/') }}/{{ $img->image }}" alt=""
                                            style="height: 50px;width:50px;">

                                        <a href="{{ route('admin.image.delete', $img->id) }}"><i
                                                class="fas fa-trash-alt"></i>x</a>
                                    @endforeach

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
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" checked>
                                <label class="form-check-label" for="exampleCheck1">I have read and agree to the
                                    website
                                    terms and conditions.</label>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Updates</button>
                                <a href="{{ route('admin.pets.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


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

        function toggleDetailsCat(show) {
            document.getElementById("detailsBoxCat").style.display = show ? "block" : "none";
        }

        function toggleDetailsBest(show) {
            document.getElementById("detailsBoxBest").style.display = show ? "block" : "none";
        }
    </script>
@endpush
