<div>
    <div class="signup-hero-wrap" style="background-image: url({{ asset('frontend/img/sign-up/signup-bg.png') }});">
        <div class="common-wrap clear">
            <div class="signup-hero-inner">
                <div class="signup-form">
                    <h3>Sign up for free!</h3>

                    <form wire:submit.prevent="submit">

                        {{-- form step 1 --}}
                        <div class="{{ $currentStep != 1 ? 'displayNone' : '' }}">


                           
                            <div class="signup-input-raw">
                                <h4>Full name <span>*</span></h4>

                                <input type="text" placeholder="Enter Your Name" wire:model.blur="name" required>

                                @error('name')
                                    <span class="error">{{ $message }}</span>
                                @enderror

                                <input type="hidden" id="username" wire:model="username" value="{{ $username }}">
                            </div>
                            <div class="signup-input-raw">
                                <h4>Select Gender: </h4>
                                <div class="radio-button">
                                    <input type="radio" id="male" name="gender" value="Male" class="radio"
                                        wire:model="gender">

                                    <label class="radio-label" for="male">Male</label>

                                    <input type="radio" id="female" name="gender" value="Female" class="radio"
                                        wire:model="gender">
                                    <label class="radio-label" for="female">Female</label>
                                    <input type="radio" id="Other" name="gender" value="Other" class="radio"
                                        wire:model="gender">
                                    <label class="radio-label" for="Other">Other</label>
                                    @error('gender')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="signup-input-raw">
                                <h4>Location <span>*</span></h4>
                                <select wire:model="city" id="select2">
                                    <option value="">Select Location
                                    </option>
                                    @foreach ($cities as $country)
                                        <option value="{{ $country->id }}">{{ $country->state }}
                                        </option>
                                    @endforeach


                                </select>
                                @error('city')
                                    <span class="error">{{ $message }}</span>
                                @enderror

                            </div>
                            
                            
                            <div class="signup-input-raw">
                                <h4>Phone <span>*</span></h4>

                                <input type="text" placeholder="Enter your phone number" wire:model="phone" required>

                                @error('phone')
                                    <span class="error">{{ $message }}</span>
                                @enderror


                            </div>
                            <div class="signup-input-raw">
                                <h4>Email <span>*</span></h4>
                                <input type="email" placeholder="mail@example.com" wire:model="email" required>
                                @error('email')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="signup-input-raw">
                                <h4>Password <span>*</span></h4>
                                <input type="{{ $showPassword ? 'text' : 'password' }}" placeholder="Password"
                                    wire:model="password">
                                <div class="eye-icon">
                                    <img src="{{ asset('customer') }}/svgs/mage_eye-off.svg" alt="eye"
                                        wire:click="togglePasswordVisibility">
                                </div>
                                @error('password')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="signup-input-raw">
                                <h4>Confirmed Password <span>*</span></h4>
                                <input type="{{ $showPassword ? 'text' : 'password' }}" placeholder="Confirm Password"
                                    wire:model="password_confirmation">
                                <div class="eye-icon">
                                    <img src="{{ asset('customer') }}/svgs/mage_eye-off.svg" alt="eye"
                                        wire:click="togglePasswordVisibility">
                                </div>
                                @error('password')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="signup-input-raw">
                                <button type="button" class="btn btn-primary" wire:click="firstStepSubmit">Next
                                    Step</button>
                                     <div wire:loading>
                                    Wait .....
                                </div>

                            </div>
                        </div>
                        {{-- end form step 1 --}}

                        {{-- form step 2 --}}
                        <div class="{{ $currentStep != 2 ? 'displayNone' : '' }}">

                            
                           {{-- 
                            
                            <div class="signup-input-raw">
                                <h4>Do you prefer the size of the pet you are looking to adopt?
                                </h4>
                                <div class="radio-button">
                                    <input type="radio" id="Small" name="size" value="Small"
                                        class="radio" wire:model="size">

                                    <label class="radio-label" for="Small">Small</label>

                                    <input type="radio" id="Medium" name="gender" value="Medium"
                                        class="radio" wire:model="size">
                                    <label class="radio-label" for="Medium">Medium</label>
                                    <input type="radio" id="Large" name="size" value="Large"
                                        class="radio" wire:model="size">
                                    <label class="radio-label" for="Large">Large</label>
                                    <input type="radio" id="No preference" name="size" value="No preference"
                                        class="radio" wire:model="size">
                                    <label class="radio-label" for="No preference">No preference</label>
                                    @error('gender')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="signup-input-raw">
                                <h4>Do you currently have any pets in your household?
                                </h4>
                                <div class="radio-button">
                                    <input type="radio" id="isyes" name="is_available_pet" value="Yes"
                                        class="radio" wire:model.live="is_available_pet">

                                    <label class="radio-label" for="isyes">Yes</label>

                                    <input type="radio" id="No" name="gender" value="No"
                                        class="radio" wire:model.live="is_available_pet">
                                    <label class="radio-label" for="No">No</label>

                                    @error('gender')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @if ($is_available_pet == 'Yes')
                                <div class="signup-input-raw">
                                    <h4>What type of pets?</h4>
                                    <input type="text" placeholder="Dog" wire:model="availablePetInhouse"
                                        required>
                                    @error('availablePetInhouse')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif


                            <div class="signup-input-raw age-input">
                                <h4>Please select the age range(s) of children living in your home</h4>
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



                                @error('children_age_inhouse')
                                    <span class="error">{{ $message }}</span>
                                @enderror


                            </div>

                            <div class="signup-input-raw age-input">
                                <h4>Do you have any preferences for the pet’s personality?
                                </h4>
                                <select wire:model="pet_personality">
                                    <option value="">Select pet’s personality</option>

                                    <option value="Couch Potato">Couch Potato</option>
                                    <option value="A Bundle of Energy">A Bundle of Energy</option>
                                    <option value="Balanced">Balanced</option>
                                    <option value="Playful">Playful</option>
                                    <option value="Friendly">Friendly </option>
                                    <option value="Affectionate">Affectionate</option>
                                    <option value="Loyal">Loyal</option>
                                    <option value="Calm">Calm</option>
                                    <option value="Shy">Shy</option>
                                    <option value="Curious">Curious</option>
                                    <option value="Intelligent">Intelligent</option>
                                </select>



                                @error('pet_personality')
                                    <span class="error">{{ $message }}</span>
                                @enderror


                            </div>

                            <div class="signup-input-raw">
                                <h4>Do you have a secure outdoor space for the pet?
                                </h4>
                                <div class="radio-button">
                                    <input type="radio" id="outYes" name="pet_outdoor_space" value="Yes"
                                        class="radio" wire:model.live="pet_outdoor_space">

                                    <label class="radio-label" for="outYes">Yes</label>

                                    <input type="radio" id="outNo" name="pet_outdoor_space" value="No"
                                        class="radio" wire:model.live="pet_outdoor_space">
                                    <label class="radio-label" for="outNo">No</label>

                                    @error('pet_outdoor_space')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="signup-input-raw">
                                <h4>
                                    Are there specific
                                    activities or traits you’re looking for in a pet? </h4>

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

                            </div>



                            <div class="signup-input-raw age-input">
                                <h4>How much time can you dedicate to your pet daily?

                                </h4>
                                <select wire:model="dedicated_time">
                                    <option value="">Select dedicated Time</option>

                                    <option value="Less than 1 hour">Less than 1 hour</option>
                                    <option value="1–3 hours">1–3 hours</option>
                                    <option value="More than 3 hours">More than 3 hours</option>
                                    <option value="As much as they need">As much as they need</option>

                                </select>



                                @error('pet_personality')
                                    <span class="error">{{ $message }}</span>
                                @enderror


                            </div>


                            <div class="signup-input-raw">
                                <h4>Are you open to adopting pets with special needs or medical conditions?
                                </h4>
                                <div class="radio-button">
                                    <input type="radio" id="ssYes" name="special_need" value="Yes"
                                        class="radio" wire:model="special_need">

                                    <label class="radio-label" for="ssYes">Yes</label>

                                    <input type="radio" id="sNo" name="special_need" value="No"
                                        class="radio" wire:model="special_need">
                                    <label class="radio-label" for="sNo">No</label>

                                    @error('special_need')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="signup-input-raw age-input">
                                <h4>Do you have a preference for the pet’s age?
                                </h4>
                                <select wire:model="pet_age">
                                    <option value="">Select Pet Age</option>

                                    <option value="Baby">Baby</option>
                                    <option value="Young">Young</option>
                                    <option value="Adult">Adult</option>
                                    <option value="Senior">Senior</option>



                                </select>
                                @error('pet_age')
                                    <span class="error">{{ $message }}</span>
                                @enderror


                            </div>
                            <div class="signup-input-raw age-input">
                                <h4>Do you have a preference for the pet’s gender?
                                </h4>
                                <select wire:model="pet_gender">
                                    <option value="">Select Pet Gender</option>

                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                
                                    <option value="Unknown">Unknown</option>



                                </select>
                                @error('pet_age')
                                    <span class="error">{{ $message }}</span>
                                @enderror


                            </div>

--}}


  <div class="signup-input-raw">
                                <h4>Are you looking to: <span>*</span></h4>
                               <div class="radio-button">
                                    <input type="radio" id="Individual_owner" name="ad_type"
                                        value="Rehome a Pet" class="radio" wire:model.live="ad_type" required="">

                                    <label class="radio-label" for="Individual_owner">Rehome Your Pet</label>

                                    <input type="radio" id="Rehoming_centre" name="ad_type"
                                        value="Adopt a Pet" class="radio" wire:model.live="ad_type">
                                    <label class="radio-label" for="Rehoming_centre">Adopt a Pet</label>
                                    @error('pet_owner_type')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                            </div>
                             @if($ad_type== 'Rehome a Pet')
                            
  <div class="signup-input-raw">
                                <h4>Are you an: <span>*</span></h4>
                               <div class="radio-button">
                                    <input type="radio" id="Individual_owner_rx" name="rehome_type"
                                        value="Individual" class="radio" wire:model.live="rehome_type">

                                    <label class="radio-label" for="Individual_owner_rx">👤 Individual</label>

                                    <input type="radio" id="Rehoming_centre_r" name="rehome_type"
                                        value="Rehome center" class="radio" wire:model.live="rehome_type">
                                    <label class="radio-label" for="Rehoming_centre_r">🏢 Rehoming Center</label>
                                    @error('pet_owner_type')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                            </div>
                            @endif
                            
                            
                            
                            @if($rehome_type== 'Rehome center')
                             <div class="signup-input-raw">
                                <h4>Please provide Charity Name <span>*</span></h4>
                                <input type="text" placeholder="Enter Charity Name"
                                    wire:model="rehoming_centre" required="">
                               
                                @error('password')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                             <div class="signup-input-raw">
                                <h4>Registration Number<span>*</span></h4>
                                <input type="text" placeholder="Registration Number"
                                    wire:model="Rehoming_centre_id" required="">
                               
                                @error('password')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            @endif


                            <div class="signup-input-raw">
                                <input class="btn-register" wire:click="submitForm" value="Register">
                                <div wire:loading>
                                    Wait .....
                                </div>
                            </div>

                        </div>
                        {{-- end form step 2 --}}


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:init', () => {
        // Function to initialize Select2
        function initializeSelect2() {
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

            // Dispatch Livewire event on change
            $('#select2').on('change', function () {
                const selectedValue = $(this).val();

                @this.set('city', selectedValue);
            });
        } 

        initializeSelect2();

        Livewire.hook('morphed',  ({ el, component }) => {
            // Runs after all child elements in `component` are morphed
            console.log($('#select2').html());
            initializeSelect2();
        })
    });
</script>
@endpush