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
                                 <li><a href="{{ route('f.setting') }}" wire:navigate>General</a></li>
                                 {{--
                                 <li><a href="{{ route('f.social') }}" wire:navigate>Social</a></li>
                                  <li><a href="{{ route('f.interest') }}" wire:navigate>Interests & Hobbies</a></li>
                                 <li><a href="{{ route('f.sport') }}" wire:navigate>Sport</a></li>
                                 <li><a href="{{ route('f.lookingfor') }}" wire:navigate>What I'm looking for</a></li> --}}
                             </ul>
                         </div>
                         <div class="profile-tab-content">
                             <form wire:submit="updateProfile" method="post" class="form">
                                 <div class="form-row">
                                     @if (session('success'))
                                         <div
                                             class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                                             {{ session('success') }}
                                         </div>
                                     @endif
                                 </div>
                                 <div class="form-row">
                                     <label>Current Password (required to update email or change current
                                         password)</label>
                                     <input type="password" wire:model="current_password">
                                     @error('current_password')
                                         <span class="text-red-500 text-sm">{{ $message }}</span>
                                     @enderror
                                     <a href="{{ route('password.request') }}">Lost your password?</a>
                                 </div>
                                 <div class="form-row">
                                     <label>Account Email</label>
                                     <input type="email" placeholder="example@mail.com" wire:model="email">
                                     @error('email')
                                         <span class="text-red-500 text-sm">{{ $message }}</span>
                                     @enderror
                                 </div>
                                 <div class="form-row">
                                     <label>Change Password (leave blank for no change)</label>
                                     <input type="password" wire:model="password">
                                     @error('password')
                                         <span class="text-red-500 text-sm">{{ $message }}</span>
                                     @enderror
                                 </div>
                                 <div class="form-row">
                                     <label>Repeat New Password</label>
                                     <input type="password" wire:model="password_confirmation">
                                     @error('password_confirmation')
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
