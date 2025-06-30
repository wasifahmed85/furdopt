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
                     <div class="profile-tab">
                         <div class="profile-tab-list">
                             <ul>
                                 <li><a href="{{ route('f.setting') }}"
                                         class="{{ Route::is('f.setting') ? 'curent' : '' }}">General</a></li>
                                         {{--
                                 <li><a href="{{ route('f.social') }}"
                                         class="{{ Route::is('f.social') ? 'curent' : '' }}">Social</a></li>
                                <li><a href="{{ route('f.interest') }}" wire:navigate>Interests & Hobbies</a></li>
                                 <li><a href="{{ route('f.sport') }}" wire:navigate>Sport</a></li>
                                 <li><a href="{{ route('f.lookingfor') }}" wire:navigate>What I'm looking for</a></li> --}}
                             </ul>
                         </div>
                         <div class="profile-tab-content">
                             <form wire:submit="updateData" method="post" class="form">
                                 <div class="form-row">
                                     @if (session('success'))
                                         <div
                                             class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                                             {{ session('success') }}
                                         </div>
                                     @endif
                                 </div>
                                 <div class="form-row">
                                     <label>Facebook</label>
                                     <input type="url" wire:model="facebook">
                                     @error('facebook')
                                         <span class="text-red-500 text-sm">{{ $message }}</span>
                                     @enderror

                                 </div>
                                 <div class="form-row">
                                     <label>Google</label>
                                     <input type="url" wire:model="google">
                                     @error('google')
                                         <span class="text-red-500 text-sm">{{ $message }}</span>
                                     @enderror

                                 </div>

                                 <div class="form-row">
                                     <input type="submit" name="submit" value="Save Changes" id="submit"
                                         class="btn medium submit-btn">
                                 </div>
                             </form>
                         </div>
                     </div>
                 </div>
                 <!-- End profile body -->
             </div>
         </div>
     </section>
 </section>
 <!-- //End main content section -->
