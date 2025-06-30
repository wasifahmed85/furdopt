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
                    <h5>Editing 'About' Profile Group</h5>
                    <form wire:submit="updateAbout" method="post" class="form">
                        <div class="form-row">
                            <label>Age</label>
                            {{-- <select class="filter-selectric">
                                <option value="min">Newest Registered</option>
                                <option value="18">Sort by</option>
                                <option value="18">last active</option>
                                <option value="18">Alphabetical</option>
                            </select> --}}
                            <input type="text" placeholder="age" wire:model="age"
                                value="{{ Auth::user()->userdetails->age ?? '' }}">
                            
                            <div class="visibility-settings">
                                <p>Who can see this field?</p>
                                <div class="radio-item">
                                    <input type="radio" id="aeveryone" name="person" value="2"
                                        wire:model="age_status">
                                    <label for="aeveryone"> Every one</label>
                                </div>
                                <div class="radio-item">
                                    <input type="radio" id="aonly-Me" name="person" value="1"
                                        wire:model="age_status">
                                    <label for="aonly-Me">Only Me</label>
                                </div>
                                <div class="radio-item">
                                    <input type="radio" id="aall-members" name="person" value="3"
                                        wire:model="age_status">
                                    <label for="aall-members">All Members</label>
                                </div>
                                <button type="type" class="visibility-close">close</button>
                            </div>
                        </div>
                        <div class="form-row">
                            <label>Country (required)</label>
                            <select class="filter-selectric" wire:model="country_id">
                                <option value="min">Select...</option>
                                @foreach ($countries as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach


                            </select>
                           
                            <div class="visibility-settings">
                                <p>Who can see this field?</p>
                                <select class="filter-selectric" wire:model="country_id">
                                    <option value="2"> Every one</option>
                                    <option value="1">Only Me</option>
                                    <option value="3">All Members</option>



                                </select>
                                {{-- <div class="radio-item">
                                    <input type="radio" id="coeveryone" name="person" value="1"
                                        wire:model="country_status">
                                    <label for="coeveryone"> Every one</label>
                                </div> --}}
                                {{-- <div class="radio-item">
                                    <input type="radio" id="coonly-Me" name="person" value="1"
                                        wire:model="country_status">
                                    <label for="coonly-Me">Only Me</label>
                                </div>
                                <div class="radio-item">
                                    <input type="radio" id="coall-members" name="person" value="3">
                                    <label for="coall-members" wire:model="country_status">All Members</label>
                                </div> --}}
                                <button type="type" class="visibility-close">close</button>
                            </div>
                        </div>
                        <div class="form-row">
                            <label>City</label>
                            <input type="text" placeholder="Kigali" wire:model="city"
                                {{ Auth::user()->userdetails->city ?? '' }}>
                            <!--<div class="settings-toggle">-->
                            <!--    <small>This field can be seen by:-->
                                  
                            <!--    <button type="type" class="btn black visibility-toggle">change</button>-->
                            <!--</div>-->
                            <div class="visibility-settings">
                                <p>Who can see this field?</p>
                                <div class="radio-item">
                                    <input type="radio" id="ceveryone" name="person" value="2"
                                        wire:model="city_status">
                                    <label for="ceveryone"> Every one</label>
                                </div>
                                <div class="radio-item">
                                    <input type="radio" id="conly-Me" name="person" value="1"
                                        wire:model="city_status">
                                    <label for="conly-Me">Only Me</label>
                                </div>
                                <div class="radio-item">
                                    <input type="radio" id="call-members" name="person" value="3"
                                        wire:model="city_status">
                                    <label for="call-members">All Members</label>
                                </div>
                                <button type="type" class="visibility-close">close</button>
                            </div>
                        </div>
                        {{-- <div class="form-row">
                            <label>Change Password (leave blank for no change)</label>
                            <input type="password">
                        </div>
                        <div class="form-row">
                            <label>Repeat New Password</label>
                            <input type="password">
                        </div> --}}
                        <div class="form-row">
                            <input type="submit" name="submit" value="Save Changes" id="submit"
                                class="btn medium submit-btn">
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
