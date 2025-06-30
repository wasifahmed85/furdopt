
<!-- Beginning main content section -->
<section class="main-content-wrap">
    <section class="profile-wrap">
        <div class="common-wrap clear">
            <div class="profile-grid">
                <!-- Begin sidebar  -->
                <!--<x-sidebar></x-sidebar>-->
                <!-- End sidebar -->
                <!-- Begin profile body -->
                <div class="profile-body whatiamlooking">
                    <h5>My Basic Interests and Pet Preferences:</h5>
                    <form wire:submit="updateData" class="form">
                        <div class="form-row">
                            <label>Interested in (required)</label>
                            <select id="sports" wire:model="looking_for">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        @if ($looking_for == $category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                           
                        
                        </div>
                        <div class="form-row">
                            <label>Looking For Pet Gender</label>

                            <select wire:model="pet_gender">
                                <option >Select Pet gender </option>

                             
                                    <
                                    <option @if ($pet_age = 'Male') selected @endif value="Male">Male</option>
                                    <option @if ($pet_age = 'Female') selected @endif value="Female">Female</option>
                                    <option @if ($pet_age = 'Unknown') selected @endif value="Unknown">Unknown</option>

                            </select>
                            @error('pet_gender')
                                <small class="errors-msg">{{ $message }}</small>
                            @enderror



                        </div>
                           <div class="form-row">
                            <label>Preferred Size:
</label>

                            <select wire:model="size">
                                <option >Select Pet Size</option>

                                <option @if ($size = 'Small') selected @endif value="Small">🐾 Small
                                </option>
                                <option @if ($size = 'Medium') selected @endif value="Medium">🐕 Medium</option>
                                <option @if ($size = 'Large') selected @endif value="Large">🐕‍🦺 Large</option>
                                <option @if ($size = 'No preference') selected @endif value="No preference">❓ No preference
                                </option>
                               


                            </select>
                            @error('age')
                                <small class="errors-msg">{{ $message }}</small>
                            @enderror



                        </div>
                        <div class="form-row">
                            <label>Preferred Age</label>

                            <select wire:model="pet_age">
                                <option >Select Pet Age </option>

                             
                                    <option @if ($pet_age = 'Baby') selected @endif value="Baby">Baby</option>
                                    <option @if ($pet_age = 'Young') selected @endif value="Young">Young</option>
                                    <option @if ($pet_age = 'Adult') selected @endif value="Adult">Adult</option>
                                    <option @if ($pet_age = 'Senior') selected @endif value="Senior">Senior</option>

                            </select>
                            @error('age')
                                <small class="errors-msg">{{ $message }}</small>
                            @enderror



                        </div>
                     
                        <div class="form-row">
                            <label>Preferred Personality and Needs:</label>

                            <select wire:model="pet_personality">
                            
                                {{--
                                <option @if ($pet_personality = 'Couch Potato') selected @endif
                                    value="Couch Potato">Couch Potato</option>
                                <option @if ($pet_personality = 'A Bundle of Energy') selected @endif value="A Bundle of Energy">A Bundle of Energy</option>
                                <option @if ($pet_personality = 'Balanced') selected @endif value="Balanced">Balanced</option>
                                <option @if ($pet_personality = 'Playful') selected @endif value="Playful">Playful</option>
                                <option @if ($pet_personality = 'Friendly') selected @endif value="Friendly">
                                    Friendly</option>
                                <option @if ($pet_personality = 'Affectionate') selected @endif value="Affectionate">
                                    Affectionate</option>
                                <option @if ($pet_personality = 'Loyal') selected @endif value="Loyal">
                                    Loyal</option>
                                <option @if ($pet_personality = 'Calm') selected @endif value="Calm">
                                    Calm</option>
                                <option @if ($pet_personality = 'Shy') selected @endif value="Shy">
                                    Shy</option>
                                <option @if ($pet_personality = 'Curious') selected @endif value="Curious">
                                    Curious</option>
                                <option @if ($pet_personality = 'Intelligent') selected @endif value="Intelligent">
                                    Intelligent</option>
                                    --}}
                                     <option value="">Select pet personality</option>
                                    <option  @if ($pet_personality = 'Couch Potato') selected @endif value="Couch Potato">🛋️ Couch Potato: Prefers lounging and relaxing; minimal activity needs.</option>
                                    <option  @if ($pet_personality = 'Energetic') selected @endif value="Energetic">⚡ Energetic: Always on the go; loves playtime and adventures.</option>
                                    <option  @if ($pet_personality = 'Adaptable') selected @endif value="Adaptable">⚖️ Adaptable: Comfortable with both playtime and relaxation; displays a balanced temperament.</option>
                                    
                            </select>
                            @error('pet_personality')
                                <small class="errors-msg">{{ $message }}</small>
                            @enderror



                        </div>
                        
                        
                            <div class="form-row">
                                <label>Are you open to adopting pets with special needs or medical conditions?</label>
                               
                                <div class="radiobox">
                                    <input type="radio" id="ssYes" name="special_need" value="Yes"
                                        class="radio" wire:model="special_need">

                                    <label  for="ssYes">✅ Yes</label>

                                    <input type="radio" id="sNo" name="special_need" value="No"
                                        class="radio" wire:model="special_need">
                                    <label  for="sNo">❌ No</label>

                                    @error('special_need')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                    
                   <div class=" form-row">
                         <hr>
                                <label>Compatibility </label>
                        <hr>
                    </div>

                            <div class=" form-row">
                                <label>Do you currently have any pets?</label>
                               
                                <div class="radiobox">
                                    <input type="radio" id="isyes" name="is_available_pet" value="Yes"
                                        class="radio" wire:model.live="is_available_pet">

                                    <label  for="isyes">Yes</label>

                                    <input type="radio" id="No" name="gender" value="No"
                                        class="radio" wire:model.live="is_available_pet">
                                    <label for="No">No</label>

                                    @error('gender')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @if ($is_available_pet == 'Yes')
                                <div class="form-row">
                                    <label>What type of pets?</label>
                                    <input type="text" placeholder="Dog" wire:model="availablePetInhouse"
                                        required>
                                    @error('availablePetInhouse')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                            
                                <div class="form-row">
                                <label>Please select the age range(s) of children living in your home</label>
                                <select wire:model="children_age_inhouse">
                                    <option value="">Select Children In house</option>

                                    
                                        <option @if ($children_age_inhouse = 'Under 5 years old') selected @endif value="Under 5 years old">👶 Under 5 years old</option>
                                        <option @if ($children_age_inhouse = '6–10 years old') selected @endif value="6–10 years old">🧒 6–10 years old
                                        </option>
                                        <option @if ($children_age_inhouse = '11–15 years old') selected @endif value="11–15 years old">🧑 11–15 years old
                                        </option>
                                        <option @if ($children_age_inhouse = '16+ years old') selected @endif value="16+ years old">
                                            🧑‍🎓 16+ years old</option>
                                        <option @if ($children_age_inhouse = 'No children in the home') selected @endif value="Not comfortable with children">❌ NNo children in the home  </option>
                                   
                                </select>



                                @error('children_age_inhouse')
                                    <span class="error">{{ $message }}</span>
                                @enderror

   <div class="form-row">
                                <label>Do you have a secure outdoor space?
</label>
                                <div class="radiobox">
                                    <input type="radio" id="outYes" name="pet_outdoor_space" value="Yes"
                                        class="radio" wire:model.live="pet_outdoor_space">

                                    <label  for="outYes">✅ Yes</label>

                                    <input type="radio" id="outNo" name="pet_outdoor_space" value="No"
                                        class="radio" wire:model.live="pet_outdoor_space">
                                    <label  for="outNo">❌ No</label>

                                    @error('pet_outdoor_space')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                         <div class=" form-row">
                         <hr>
                                <label>Home Recommendations </label>
                        <hr>
                    </div>  
                     <div class="form-row">
                                                     <label>How would you describe your home environment?
</label>
                                <div class="radiobox">
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
                                            
                            @if ($best_fit_for_home == 'Other')
                                <div class="form-row">
                                   
                                        <label>Details
                                        </label>
                          
                                    <div class="form-group @error('best_fit_for_home_deatils') has-error @enderror">
                                        <textarea name="best_fit_for_home_deatils" wire:model="best_fit_for_home_deatils"></textarea>

                                        @error(' best_fit_for_home_deatils')
                                            <small class="errors-msg">{{ $message }}</small>
                                        @enderror

                                    </div>
                                </div>
                            @endif
                        </div>
                            <div class="form-row">
                                <label>HHow much time can you dedicate to your pet daily?
</label>
                                <select wire:model="dedicated_time">
                                    <option value="">Select dedicated Time</option>

                                    <option value="Less than 1 hour">🕒 Less than 1 hour</option>
                                    <option value="1–3 hours">🕒  1–3 hours</option>
                                    <option value="More than 3 hours">🕒  More than 3 hours</option>
                                   

                                </select>



                                @error('pet_personality')
                                    <span class="error">{{ $message }}</span>
                                @enderror


                            </div>
                         
                            <div class=" form-row">
                         <hr>
                                <label>Home Recommendations </label>
                        <hr>
                    </div>
                       
                        <div class="form-row">
                            <label>Briefly explain why are you looking to adopt?</label>
                            <textarea wire:model="adoption_reason"></textarea>

                        </div>
                        <div class="form-row">
                            <label>Preferred location</label>
                            <select wire:model="looking_for_state">
                                <option value="">Select Pet Location</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}"
                                        @if ($looking_for_state == $state->id) selected @endif>{{ $state->state }}</option>
                                @endforeach


                            </select>

                        </div>
                <div class="form-row">
                            <label>My interest in pet:</label>
                            <div class="checkbox-container">

                                @foreach (['Companionship', 'Playfulness & Energy', 'Low Maintenance', 'Cuddly & Affectionate', 'Quiet & Calm', 'Intelligent & Trainable', 'Good with Other Pets', 'Unique & Exotic','Therapeutic & Emotional Support'] as $index => $hobies)
                                    <div class="checkbox-row">
                                        <input type="checkbox" id="checked-{{ $hobies }}" name="vehicle1"
                                            wire:model="hobies" value="{{ $hobies }}"> <label
                                            for="checked-{{ $hobies }}">{{ $hobies }}</label><br>
                                    </div>
                                @endforeach


                            </div>

                        </div>
                        
                         <div class="form-row">
                             <label>Pet sports and activity:</label>
                             <div class="checkbox-container">

                                 @foreach (['Walking', 'Running/Jogging', 'Hiking', 'Fetch/Frisbee', 'Agility Training', 'Obedience Training', 'Swimming', 'Hunting/Tracking','Herding Activities','Flyball','Dock Diving','Canicross (Running with a Dog)','Bikejoring (Biking with a Dog)','Therapy/Service Work','Trick Training','Interactive Play (Tug-of-War, Puzzle Toys)','Bird Watching & Training (for pet birds)','Socialization & Playdates','Small Animal Agility (for rabbits, rodents)'] as $index => $sport)
                                     <div class="checkbox-row">
                                         <input type="checkbox" id="checked-{{ $sport }}" wire:model="sports"
                                             value="{{ $sport }}">
                                         <label for="checked-{{ $sport }}">{{ $sport }}</label><br>
                                     </div>
                                 @endforeach

                            </div>

                        </div>
                       
                  


                       
                            </div>


                         
                            <div class="form-row">
                                <label>Are there specific
                                    activities or traits you’re looking for in a pet?</label>
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



                        



                         
                       
                        <div class="form-row">
                            <input type="submit" name="submit" value="Save Changes" id="submit"
                                class="btn medium submit-btn">
                            <div wire:loading>
                                Saving Data...
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End profile body -->
        </div>
        </div>
        <div class="pet-matching-btn mt-5 custom-pet-matching">
            <a href="{{ route('f.match') }}" class="btn btn-primary btn-md"> <div class="menu-icon">
                <i class="jws-icon-head-heart-child"></i>
            </div>
            Get Your Pet Matching Now
         </a>
        </div>
    </section>
</section>
<!-- //End main content section -->

@script
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            $('#sports').select2();
            $('#sports').on('change', function() {
                @this.set('selectedCategories', $(this).val());
            });
        });
    </script>
@endscript
