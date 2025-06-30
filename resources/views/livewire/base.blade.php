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
                     <h5>Editing Basic profile information</h5>
                     <form wire:submit="updateData" class="form">
                         <div class="form-row upload-img">
                             <label>Profile Image</label>
                                 @if ($profileImage)
                                 <img src="{{ asset('images/' . $profileImage) }}" height="100" width="100"
                                     style="height: 50px;width:50px;">
                             @endif
                             @if ($avatar)
                                 <img src="{{ $avatar->temporaryUrl() }}" height="100" width="100"
                                     style="height: 50px;width:50px;">
                             @endif
                             <input type="file" id="gallery-upload" wire:model="avatar">
                         
                         </div>
                         <div class="form-row upload-img">
                             <label>Identity Verification (ID/Driving Licence)</label>
                              
                                @if($rehome_centre_p == null)
                                 <img src="{{ asset('images/verify.jpg') }}" height="100" width="100"
                                     style="height: 50px;width:50px;">
                                     @else
                                      <img src="{{ asset('images/' . $rehome_centre_p) }}" height="100" width="100"
                                     style="height: 50px;width:50px;">
                                     @endif
                            
                            
                             <input type="file" id="gallery-uploada" wire:model="rehome_centre_pic">
                             
                             
                         
                         </div>
                         <div class="form-row">
                             <label>Name (required)</label>
                             <input type="text" placeholder="John Smithe" wire:model="username" >
                            {{Auth::user()->id}}
                         </div>
                         <div class="form-row">
                             <label>Gender (required)</label>
                             <div class="radio-item">
                                 <input type="radio" id="radio-1" name="gender" value="Male" wire:model="gender"
                                     @if ($gender == 'Male') checked @endif>
                                 <label for="radio-1"> Male</label>
                             </div>
                             <div class="radio-item">
                                 <input type="radio" id="radio-2" name="gender" value="Female" wire:model="gender"
                                     @if ($gender == 'Female') checked @endif>
                                 <label for="radio-2">Female</label>
                             </div>
                             <div class="radio-item">
                                 <input type="radio" id="radio-3" name="gender" value="Other"
                                     wire:model="gender" @if ($gender == 'Other') checked @endif>
                                 <label for="radio-3">Other</label>
                             </div>
                            
                           
                         </div>



                       
                         <div class="form-row">
                             <label>Bio (Max 200 words)</label>
                             <textarea wire:model="bio"
                                 placeholder="Hello there! 🌟 Adventurous spirit with a penchant for laughter and meaningful connections. I believe in the magic of serendipity and am ready to embark on a journey of discovering shared passions and creating unforgettable moments."></textarea>
                            
                         </div>
                         <div class="form-row">
                             <input type="submit" value="Save Changes" id="submit" class="btn medium submit-btn" />
                             <div wire:loading>
                                 Saving Data...
                             </div>
                         </div>
                     </form>
                 </div>
                 <!-- End profile body -->
             </div>
         </div>
     </section>
 </section>
 <!-- //End main content section -->
