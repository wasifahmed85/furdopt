<!-- Beginning main content section -->
<section class="main-content-wrap">
    <section class="profile-wrap">
        <div class="common-wrap clear">
            <div class="profile-grid">
                <x-sidebar></x-sidebar>
                <!-- Begin profile body -->
                <div class="profile-body">
                    <div class="profile-tab">
                        <x-notifysidebar></x-notifysidebar>
                        <div class="profile-tab-content">
                            <h5>Email notifications</h5>
                            <p>Notifications will be sent to this email address:</p>
                            <form class="form">
                                <div class="form-row save-email">
                                    <input type="email" id="email" value="{{ Auth::user()->email }}">
                                    {{-- <button type="button" class="edit"><i class="jws-icon-pencilline"></i></button>
                                    <button type="submit" class="save">Save</button> --}}
                                </div>
                                <div class="form-row">
                                    <h5>Choose notifications you would like to receive:</h5>
                                    <div class="toggle-checkbox">
                                        <div class="label-wrap">
                                            <label>Verification</label>
                                            <p>Be notified when the admin verifies your account.</p>
                                        </div>
                                        <div class="checkbox">
                                            <input type="checkbox" class="toggle-input" id="toggle-1"
                                                wire:click="toggleStatus('verification_status')"
                                                {{ $statuses['verification_status'] ? 'checked' : '' }}>
                                            <label for="toggle-1" class="toggle-label"></label>
                                        </div>
                                    </div>
                                </div>
                                {{--
                                <div class="form-row">
                                    <div class="toggle-checkbox">
                                        <div class="label-wrap">
                                            <label>New messages</label>
                                            <p>Be notified when someone send you a message</p>
                                        </div>
                                        <div class="checkbox">
                                            <input type="checkbox" class="toggle-input" id="toggle-2"
                                                wire:click="toggleStatus('new_message_status')"
                                                {{ $statuses['new_message_status'] ? 'checked' : '' }}>
                                            <label for="toggle-2" class="toggle-label"></label>
                                        </div>
                                    </div>
                                </div>
                                --}}
                                {{-- <div class="form-row">
                                    <div class="toggle-checkbox">
                                        <div class="label-wrap">
                                            <label>New visitors</label>
                                            <p>Find out when someone visit your profile page</p>
                                        </div>
                                        <div class="checkbox">
                                            <input type="checkbox" class="toggle-input" id="toggle-3" wire:click="toggleStatus('new_visitor_status')"
                                            {{ $statuses['new_visitor_status'] ? 'checked' : '' }}>
                                            <label for="toggle-3" class="toggle-label"></label>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="form-row">
                                    <div class="toggle-checkbox">
                                        <div class="label-wrap">
                                            <label>Likes</label>
                                            <p>Find out when someone likes you in real-time</p>
                                        </div>
                                        <div class="checkbox">
                                            <input type="checkbox" class="toggle-input" id="toggle-4" wire:click="toggleStatus('like_status')"
                                            {{ $statuses['like_status'] ? 'checked' : '' }}>
                                            <label for="toggle-4" class="toggle-label"></label>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="form-row">
                                    <div class="toggle-checkbox">
                                        <div class="label-wrap">
                                            <label>New matches</label>
                                            <p>Get updated when Pet matching with you</p>
                                        </div>
                                        <div class="checkbox">
                                            <input type="checkbox" class="toggle-input" id="toggle-5"
                                                wire:click="toggleStatus('match_status')"
                                                {{ $statuses['match_status'] ? 'checked' : '' }}>
                                            <label for="toggle-5" class="toggle-label"></label>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="form-row">
                                    <div class="toggle-checkbox">
                                        <div class="label-wrap">
                                            <label>Promotions</label>
                                            <p>Get discounts to subscriptions, features and more</p>
                                        </div>
                                        <div class="checkbox">
                                            <input type="checkbox" class="toggle-input" id="toggle-6"
                                                wire:click="toggleStatus('promotion_status')"
                                                {{ $statuses['promotion_status'] ? 'checked' : '' }}>
                                            <label for="toggle-6" class="toggle-label"></label>
                                        </div>
                                    </div>
                                </div> --}}
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
