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
                    <h5>Editing 'Interests & Hobbies' Profile Group</h5>
                    <form wire:submit="updateData" class="form">
                        <div class="form-row">
                            <label>Interests</label>
                            <div class="checkbox-container">

                                @foreach (['Beaches', 'Cooking', 'Photography', 'Reading', 'Investment', 'Dogs', 'Fine Dining', 'Other'] as $index => $hobies)
                                    <div class="checkbox-row">
                                        <input type="checkbox" id="checked-{{ $hobies }}" name="vehicle1"
                                            wire:model="hobies" value="{{ $hobies }}"> <label
                                            for="checked-{{ $hobies }}">{{ $hobies }}</label><br>
                                    </div>
                                @endforeach


                                {{--
                                <div class="checkbox-row">
                                    <input type="checkbox" id="checked-1" name="vehicle1" wire:model="hobies"
                                        @if ($hobies == 'Beaches') checked @endif value="Beaches"> <label
                                        for="checked-1">Beaches</label><br>
                                </div>

                                <div class="checkbox-row">
                                    <input type="checkbox" id="checked-2" name="vehicle1" wire:model="hobies"
                                        @if ($hobies == 'Cooking') checked @endif value="Cooking"> <label
                                        id="ff" for="checked-2">Cooking</label><br>
                                </div>
                                <div class="checkbox-row">
                                    <input type="checkbox" id="checked-3" name="vehicle1" wire:model="hobies"
                                        @if ($hobies == 'Design') checked @endif value="Design">
                                    <label for="checked-3">Design</label><br>
                                </div>
                                <div class="checkbox-row">
                                    <input type="checkbox" id="checked-4" name="vehicle1" wire:model="hobies"
                                        @if ($hobies == 'Photography') checked @endif value="Photography">
                                    <label for="checked-4">Photography</label><br>
                                </div>
                                <div class="checkbox-row">
                                    <input type="checkbox" id="checked-5" name="vehicle1" wire:model="hobies"
                                        @if ($hobies == 'Dogs') checked @endif value="Dogs">
                                    <label for="checked-5">Dogs</label><br>
                                </div>
                                <div class="checkbox-row">
                                    <input type="checkbox" id="checked-6" name="vehicle1" wire:model="hobies"
                                        @if ($hobies == 'Reading') checked @endif value="Reading">
                                    <label for="checked-6">Reading</label><br>
                                </div>
                                <div class="checkbox-row">
                                    <input type="checkbox" id="checked-7" name="vehicle1" wire:model="hobies"
                                        @if ($hobies == 'Investment') checked @endif value="Investment">
                                    <label for="checked-7">Investment</label><br>
                                </div>
                                <div class="checkbox-row">
                                    <input type="checkbox" id="checked-8" name="vehicle1" wire:model="hobies"
                                        @if ($hobies == 'Fine Dining') checked @endif value="Fine Dining">
                                    <label for="checked-8">Fine Dining</label><br>
                                </div>
                                <div class="checkbox-row">
                                    <input type="checkbox" id="checked-9" name="vehicle1" wire:model="hobies"
                                        @if ($hobies == 'Other') checked @endif value="Other">
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
