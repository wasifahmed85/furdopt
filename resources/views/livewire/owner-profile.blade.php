 <!-- Beginning main content section -->
 <section class="main-content-wrap">
    <section class="my-profile main-profile">
        <div class="common-wrap clear">
            <div class="my-profile-grid">
                <div class="my-profile-inner">
                    <div class="my-profile-row">

                        <div class="my-profile-content">
                            <div class="my-profile-thumb">
                                <a href="" class="my-proflile-image">


                                    @php
                                        $avatar = $owner->avatar;
                                        $gender = $owner->gender;
                                    @endphp

                                    <img src="{{ asset($avatar ? 'images/' . $avatar : ($gender == 'Female' ? 'images/female.jpg' : 'images/deafult.jpg')) }}"
                                        alt="User Avatar" class="mb-3">



                                </a>
                            </div>
                            <div class="my-profile-text">
                                <div class="my-profile-name">
                                    <h3>
                                      {{ $owner->name }}


                                    </h3>
                                    @if ($owner->verify_status == 1)
                                        <div class="check-mark-icon desk">
                                            <img src="{{ asset('customer') }}/svgs/check-mark.svg" alt="check mark">
                                        </div>
                                    @endif
                                </div>

                                <div class="members-info">
                                    @if(!empty($owner->Rehoming_centre_id))
                                    <p><strong>Charity ID:</strong>  {{ $owner->Rehoming_centre_id }}</p>
                                    @endif
                                     <p><strong>Phone Number:</strong> <dfn> {{ $owner->phone }}  </dfn></p> 
                                     <p><strong>Email:</strong> <dfn> {{ $owner->email }} </dfn></p> 

                                    <p><strong>Gender:</strong>

                                     {{ $owner->gender ??'' }}




                                   </p>
                                    <p><strong>Location:</strong>


                                     {{ $owner->state->state ?? '' }}, Uk


                                   </p>


                                </div>
                                <div class="my-profile-desc">
                                    <p> <strong>About Me: </strong>

                                    {{ $userdetail->bio ?? '' }}




                                   </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @if(empty($owner->role_id))
                    <div class="my-profile-row">
                        <div class="content-head">
                            <h4>My Basic Interests and Pet Preferences:</h4>
                        </div>

                        <ul class="profile-fields">
                            <li><strong>Looking for a:</strong> </li>
                            <li>

                                       {{ $userdetail->category->name ?? '' }}


                            </li>
                             <li><strong>Preferred Breed:</strong> </li>
                            <li>

                                       {{ $userdetail->subcategory->name ?? '' }}


                            </li>
                                      <li><strong>Preferred pet size:</strong></li>
                            <li>


                                   {{ $userdetail->size ?? '' }}





                            </li>

                            <li><strong>Preferred pet’s age:</strong></li>
                            <li>


                                     {{ $userdetail->pet_age ?? '' }}


                            </li>
                                <li><strong>Pet preference:</strong></li>
                            <li>

                                  {{ $userdetail->pet_personality ?? '' }}





                            </li>
                                <li><strong>Adopting pets with special needs:</strong></li>
                            <li>

                                    {{ $userdetail->special_need ?? '' }}

                                   @if($userdetail?->special_need == 'It depends')
                                   <br>
                                     {{ $userdetail->special_need_yes_details ?? '' }}
                                   @endif





                            </li>


                                         <li><strong>Specific traits or activities you’re looking for in a pet:</strong></li>
                             <li>{{ $userdetail->specific_trait_activities ?? '' }}</li>







                                         <li><strong>Available pet:</strong></li>
                             <li>{{ $userdetail->is_available_pet ?? '' }}</li>








                              @if ($userdetail?->is_available_pet == 'Yes')
                                <li><strong>My other pet include:</strong></li>
                                <li> {{ $userdetail->available_pet_inhouse ?? '' }} </li>
                                    @endif





                            <li><strong>Children in my home:</strong></li>
                            <li>

                                 {{ $userdetail->children_age_inhouse ?? '' }}





                            </li>


                            <li><strong>Available outdoor space:</strong></li>
                            <li>


                                 {{ $userdetail->pet_outdoor_space ?? '' }}




                            </li>

                            <li><strong>Home environment?:</strong></li>
                            <li>



                                 {{ $userdetail->best_fit_for_home ?? '' }}




                            </li>

                            <li><strong>Daily dedicated time for the pet:</strong></li>
                            <li>

                                   {{ $userdetail->dedicated_time ?? '' }}




                            </li>

                            <li><strong>Adoption reason:</strong></li>
                            <li>

                                   {{ $userdetail->adoption_reason ?? '' }}




                            </li>


                            <li><strong>Preferred pet’s gender:</strong></li>
                            <li>

                                    {{ $userdetail->pet_gender ?? '' }}




                            </li>

                            <li><strong>Looking for specific traits:</strong></li>
                            <li>



                                 {{ $userdetail->specific_activities ?? '' }}





                            </li>











                        </ul>

                    </div>
                    @endif

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
