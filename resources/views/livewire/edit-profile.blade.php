<div>
    <!-- Beginning main content section -->
    <section class="main-content-wrap">
        <section class="my-profile">
            <div class="common-wrap clear">
                <div class="my-profile-inner">
                    <div class="my-profile-row">
                        <div class="my-profile-head">
                            <h4>My Profile </h4>
                            <a href="{{ route('f.profile') }}" wire:navigate class="view-profile">View my profile</a>
                        </div>
                        <div class="my-profile-content">
                            <div class="my-profile-thumb">
                                <img src="{{ asset('storage/images/' . Auth::user()->avatar) }}"
                                    alt="Current profile photo" />

                                <a href="#" class="icon-camera">
                                    <i class="jws-icon-camera" wire:click="$set('showModal', true)"></i>
                                </a>
                            </div>
                            <div class="my-profile-text">
                                <div class="my-profile-name">
                                    <h3>{{ Auth::user()->name }}</h3>
                                    <a href="#">
                                        <i class="jws-icon-pencilline" wire:click="avatarDelete"></i>
                                    </a>
                                </div>
                                <div class="members-info">
                                    <p>Cameroon </p>

                                    <span>26</span>
                                    <a href="#" class="edit-icon">
                                        <i class="jws-icon-pencilline"></i>
                                    </a>
                                </div>
                                <div class="members-desc">
                                    <ul>
                                        <li>
                                            <p>Woman seeking Man 18-35</p>
                                            <a href="#" class="edit-icon">
                                                <i class="jws-icon-pencilline"></i>
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="my-profile-row">
                        <div class="content-head">
                            <h5>bio</h5>
                            <a href="#" class="edit-icon">
                                <i class="jws-icon-pencilline"></i>
                            </a>
                        </div>
                        <div class="bio-desc">
                            <p>Hello there! <img src="{{ asset('customer') }}/svgs/star-emoji.svg" alt="emoji">
                                Adventurous spirit with a
                                penchant for laughter and meaningful connections. I believe in the magic of serendipity
                                and am ready to embark on a journey of discovering shared passions and creating
                                unforgettable moments.</p>
                        </div>
                    </div>
                    <div class="my-profile-row">
                        <div class="content-head">
                            <h5>about</h5>
                            <a href="#" class="edit-icon">
                                <i class="jws-icon-pencilline"></i>
                            </a>
                        </div>
                        <ul class="profile-fields">
                            <li><a href="#">Single</a></li>
                            <li>Cameroon</li>
                            <li>Kigali</li>
                            <li>Dakar Region, Senegal</li>
                            <li><a href="#">Serious</a></li>
                            <li><a href="#">Associate, bachelor's, or master's degree</a></li>
                            <li><a href="#">Specialist</a></li>
                            <li><a href="#">No children</a></li>
                            <li><a href="#">Prefer not to say</a></li>
                            <li><a href="#">Prefer not to say</a></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="my-profile-row">
                        <div class="content-head">
                            <h5>Base</h5>
                            <a href="#" class="edit-icon">
                                <i class="jws-icon-pencilline"></i>
                            </a>
                        </div>
                        <ul class="profile-fields">
                            <li><a href="#">John Smithe</a></li>
                            <li><a href="#"></a>Man</li>
                            <li>1998-07-09</li>
                            <li>177 cm</li>
                            <li>227 kg</li>
                            <li>
                                <a href="#">Arabic,</a>
                                <a href="#">Chinese,</a>
                                <a href="#">Dutch,</a>
                                <a href="#">English,</a>
                                <a href="#">German,</a>
                                <a href="#">Hebrew,</a>
                                <a href="#">Hindi,</a>
                                <a href="#">Italian,</a>
                                <a href="#">Japanese,</a>
                                <a href="#">Korean,</a>
                                <a href="#">Norwegian,</a>
                                <a href="#">Spanish,</a>
                                <a href="#">Swedish,</a>
                                <a href="#">Tagalog</a>
                            </li>
                            <li><a href="#">Sports</a></li>
                            <li><a href="#">No children</a></li>
                            <li><a href="#">Prefer not to say</a></li>
                            <li><a href="#">Prefer not to say</a></li>
                            <li><a href="#">Buddhism</a></li>
                        </ul>
                    </div>
                    <div class="my-profile-row">
                        <div class="content-head">
                            <h5>Interests & Hobbies</h5>
                            <a href="#" class="edit-icon">
                                <i class="jws-icon-pencilline"></i>
                            </a>
                        </div>
                        <ul class="profile-fields">
                            <li>
                                <a href="#">Beaches,</a>
                                <a href="#">Cooking,</a>
                                <a href="#">Design,</a>
                                <a href="#"> Photography,</a>
                                <a href="#"> Dogs,</a>
                                <a href="#"> Reading,</a>
                                <a href="#">Investment,</a>
                                <a href="#">Fine Dining,</a>
                            </li>
                        </ul>
                    </div>
                    <div class="my-profile-row">
                        <div class="content-head">
                            <h5>Sport</h5>
                            <a href="#" class="edit-icon">
                                <i class="jws-icon-pencilline"></i>
                            </a>
                        </div>
                        <ul class="profile-fields">
                            <li>
                                <a href="#">Bowling,</a>
                                <a href="#">Badminton,</a>
                                <a href="#">Basketball,</a>
                                <a href="#">Hiking,</a>
                                <a href="#">Cycling ,</a>
                                <a href="#">Ice hockey ,</a>
                                <a href="#">Ultimate frisbee,</a>
                                <a href="#"> Other</a>
                            </li>
                        </ul>
                    </div>
                    <div class="my-profile-row">
                        <div class="content-head">
                            <h5>What I'm looking for</h5>
                            <a href="#" class="edit-icon">
                                <i class="jws-icon-pencilline"></i>
                            </a>
                        </div>
                        <ul class="profile-fields">
                            <li><a href="#">Woman</a></li>
                            <li>150–180 cm</li>
                            <li>40–80 kg</li>
                            <li><a href="#">Married</a></li>
                            <li><a href="#">Prefer not to say</a></li>
                            <li><a href="#">Prefer not to say</a></li>
                            <li><a href="#">Have children</a></li>
                            <li>France</li>
                            <li><a href="#">Atheism</a></li>
                            <li>
                                <a href="#">Arabic,</a>
                                <a href="#">Chinese,</a>
                                <a href="#">Dutch,</a>
                                <a href="#">English,</a>
                                <a href="#">German,</a>
                                <a href="#">Hebrew,</a>
                                <a href="#">Hindi,</a>
                                <a href="#">Italian,</a>
                                <a href="#">Japanese,</a>
                                <a href="#">Korean,</a>
                                <a href="#">Norwegian,</a>
                                <a href="#">Spanish,</a>
                                <a href="#">Swedish,</a>
                                <a href="#">Tagalog</a>
                            </li>
                            <li>
                                <a href="#">Associate,</a>
                                <a href="#">bachelor's,</a>
                                <a href="#">or master's degree</a>
                            </li>
                            <li>
                                <a href="#">Ghanaur,</a>
                                <a href="#">Punjab 140702,</a>
                                <a href="#">India</a>
                                <a href="#"></a>
                                <a href="#"></a>
                                <a href="#"></a>
                                <a href="#"></a>
                            </li>
                            <li>18to35</li>
                            <li><a href="#">doesn’t matter</a></li>
                        </ul>
                    </div>
                    <div class="my-profile-row">
                        <div class="content-head">
                            <h5>Photos</h5>
                            <a href="#" class="edit-icon">
                                <i class="jws-icon-pencilline"></i>
                            </a>
                        </div>
                        <div class="my-gallery">
                            <div class="my-gallery-card">
                                <a href="#" class="my-gallery-thumb">
                                    <img src="img/discover/my-gallery-1.png" alt="">
                                </a>
                                <a href="#" class="my-gallery-name">My Friends</a>
                            </div>
                            <div class="my-gallery-card">
                                <a href="#" class="my-gallery-thumb">
                                    <img src="img/discover/my-gallery-2.jpg" alt="">
                                </a>
                                <a href="#" class="my-gallery-name">My Galery 2 </a>
                            </div>
                            <div class="my-gallery-card">
                                <a href="#" class="my-gallery-thumb">
                                    <img src="img/discover/my-gallery-3.jpg" alt="">
                                </a>
                                <a href="#" class="my-gallery-name">My Galery</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <!-- //End main content section -->
    <!-- Begin edit profile modal -->
    {{-- <div class="profile-edit-modal-container">
        <div class="profile-edit-modal">
            <div class="profile-edit-header">
                <h2 class="profile-edit-title">Change Profile Photo</h2>
                <button class="profile-edit-close">&times;</button>
            </div>
            <div class="profile-edit-content">
                <div class="profile-photo-preview">

                    <img src="{{ asset('customer') }}/img/discover/profile-img.jpg" alt="Current profile photo" />

                </div>


                <div class="profile-photo-upload">
                    <form wire:submit="imageUpload">
                        <div class="profile-photo-dropzone">
                            <input type="file" >
                        </div>
                        <p class="profile-photo-help">
                            If you'd like to delete the existing profile photo but not upload a
                            new one, please use the delete tab.
                        </p>
                        <button type="submit" class="profile-photo-upload-btn">Upload</button>
                    </form>
                    <div class="profile-photo-actions">
                        <button class="profile-photo-action">Take Photo</button>
                        <button class="profile-photo-action" wire:click="avatarDelete">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- End edit profile modal -->

    @if ($showModal)
        <div class="modal-overlay">
            <div class="modal-content">
                <h2>Update Profile Photo</h2>

                <div class="upload-area">
                    @if ($avatar)
                        <img src="{{ $avatar->temporaryUrl() }}" alt="Preview" class="preview-image">
                    @endif

                    <label for="image-upload" class="upload-label">
                        Choose Image
                        <input type="file" id="image-upload" wire:model="avatar" accept="image/*"
                            class="hidden-input">
                    </label>
                </div>

                <div class="modal-actions">
                    <button wire:click="saveAvatar" class="save-button"
                        @if (!$avatar) disabled @endif>
                        Save Photo
                    </button>
                    <button wire:click="$set('showModal', false)" class="cancel-button">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>

@script
@endscript
