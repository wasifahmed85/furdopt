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
                        <x-notifysidebar></x-notifysidebar>
                        <div class="profile-tab-content">
                            <h5>Push notifications</h5>
                            <p>Setting push notifications here</p>
                            <form class="form">
                                <div class="form-row">
                                    <div class="toggle-checkbox">
                                        <div class="label-wrap">
                                            <label>Visible push notifications</label>
                                            <p>Visible for all push notifications</p>
                                        </div>
                                        <div class="checkbox">
                                            <input type="checkbox" class="toggle-input" id="toggle-1" wire:click="toggleAllStatuses"
                                            {{ $allStatusesEnabled ? 'checked' : '' }}>
                                            {{-- <input type="checkbox" class="toggle-input" id="toggle-1" wire:click="togglePushNotificationAll"> --}}
                                            <label for="toggle-1" class="toggle-label"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="toggle-checkbox">
                                        <div class="label-wrap">
                                            <label>New messages</label>
                                            <p>Visible for push notifications of new messages</p>
                                        </div>
                                        <div class="checkbox">
                                            <input type="checkbox" class="toggle-input" id="toggle-2" wire:click="toggleStatus('new_message_status')"
                                            {{ $statuses['new_message_status'] ? 'checked' : '' }}>
                                            <label for="toggle-2" class="toggle-label"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="toggle-checkbox">
                                        <div class="label-wrap">
                                            <label>New Matching</label>
                                            <p>Visible for push notifications of new match</p>
                                        </div>
                                        <div class="checkbox">
                                            <input type="checkbox" class="toggle-input" id="toggle-3" wire:click="toggleStatus('match_status')"
                                            {{ $statuses['match_status'] ? 'checked' : '' }}>
                                            <label for="toggle-3" class="toggle-label"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="toggle-checkbox">
                                        <div class="label-wrap">
                                            <label>New Like</label>
                                            <p>Visible for push notifications of new like</p>
                                        </div>
                                        <div class="checkbox">
                                            <input type="checkbox" class="toggle-input" id="toggle-4"  wire:click="toggleStatus('like_status')"
                                            {{ $statuses['like_status'] ? 'checked' : '' }}>
                                            <label for="toggle-4" class="toggle-label"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="toggle-checkbox">
                                        <div class="label-wrap">
                                            <label>New Visitor</label>
                                            <p>Visible for push notifications of new visitor</p>
                                        </div>
                                        <div class="checkbox">
                                            <input type="checkbox" class="toggle-input" id="toggle-5" wire:click="toggleStatus('new_visitor_status')"
                                            {{ $statuses['new_visitor_status'] ? 'checked' : '' }}>
                                            <label for="toggle-5" class="toggle-label"></label>
                                        </div>
                                    </div>
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
