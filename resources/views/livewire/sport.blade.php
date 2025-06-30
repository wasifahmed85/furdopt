 <!-- Beginning main content section -->
 <section class="main-content-wrap">
     <section class="profile-wrap">
         <div class="common-wrap clear">
             <div class="profile-grid">
                 <!-- Begin sidebar  -->
                 <x-sidebar></x-sidebar>
                 <!-- End sidebar -->
                 <!-- Begin profile body -->
                 <div class="profile-body">
                     <h5>Editing 'Sports' Profile Group</h5>
                     <form wire:submit="updateData" class="form">
                         <div class="form-row">
                             <label>Sports</label>
                             <div class="checkbox-container">

                                 @foreach (['Bowling', 'Badminton', 'Basketball', 'Hiking', 'Cycling', 'Ice hockey', 'Ultimate frisbee', 'Other'] as $index => $sport)
                                     <div class="checkbox-row">
                                         <input type="checkbox" id="checked-{{ $sport }}" wire:model="sports"
                                             value="{{ $sport }}">
                                         <label for="checked-{{ $sport }}">{{ $sport }}</label><br>
                                     </div>
                                 @endforeach
                                 {{-- <div class="checkbox-row">
                                     <input type="checkbox" id="checked-1" name="vehicle1" value="Bike">
                                     <label for="checked-1">Bowling</label><br>
                                 </div>
                                 <div class="checkbox-row">
                                     <input type="checkbox" id="checked-2" name="vehicle1" value="Bike">
                                     <label for="checked-2">Badminton</label><br>
                                 </div>
                                 <div class="checkbox-row">
                                     <input type="checkbox" id="checked-3" name="vehicle1" value="Bike">
                                     <label for="checked-3">Basketball</label><br>
                                 </div>
                                 <div class="checkbox-row">
                                     <input type="checkbox" id="checked-4" name="vehicle1" value="Bike">
                                     <label for="checked-4">Hiking</label><br>
                                 </div>
                                 <div class="checkbox-row">
                                     <input type="checkbox" id="checked-5" name="vehicle1" value="Bike">
                                     <label for="checked-5">Cycling</label><br>
                                 </div>
                                 <div class="checkbox-row">
                                     <input type="checkbox" id="checked-6" name="vehicle1" value="Bike">
                                     <label for="checked-6">Ice hockey</label><br>
                                 </div>
                                 <div class="checkbox-row">
                                     <input type="checkbox" id="checked-7" name="vehicle1" value="Bike">
                                     <label for="checked-7">Ultimate frisbee</label><br>
                                 </div>
                                 <div class="checkbox-row">
                                     <input type="checkbox" id="checked-9" name="vehicle1" value="Bike">
                                     <label for="checked-9">Other</label><br>
                                 </div> --}}
                                 {{-- <div class="settings-toggle">
                                     <small>This field can be seen by: <span>Only Me</span></small>
                                     <button type="type" class="btn black visibility-toggle">change</button>
                                 </div> --}}
                                 {{-- <div class="visibility-settings">
                                     <p>Who can see this field?</p>
                                     <div class="radio-item">
                                         <input type="radio" id="everyone" name="person" value="HTML">
                                         <label for="everyone"> Every one</label>
                                     </div>
                                     <div class="radio-item">
                                         <input type="radio" id="only-Me" name="person" value="HTML">
                                         <label for="only-Me">Only Me</label>
                                     </div>
                                     <div class="radio-item">
                                         <input type="radio" id="all-members" name="person" value="HTML">
                                         <label for="all-members">All Members</label>
                                     </div>
                                     <button type="type" class="visibility-close">close</button>
                                 </div> --}}
                                 <input type="submit" name="submit" value="Save Changes" id="submit"
                                     class="btn medium submit-btn">
                             </div>

                         </div>
                     </form>
                 </div>
             </div>
             <!-- End profile body -->
         </div>
         </div>
     </section>
 </section>
 <!-- //End main content section -->
