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
                              <h5>Your Profile is Visible</h5>
                              <p>Setting visible here</p>
                              <form class="form">
                                  <div class="form-row">
                                      <div class="toggle-checkbox">
                                          <div class="label-wrap">
                                              <label>Setting visible here</label>
                                              <p>Profile Visibility</p>
                                          </div>
                                          <div class="checkbox">
                                              <input type="checkbox" class="toggle-input" id="toggle-1" wire:click="toggleStatus('profile_visible_status')" {{ $statuses['profile_visible_status'] ? 'checked' : '' }}>
                                              <label for="toggle-1" class="toggle-label"></label>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-row">
                                      <div class="toggle-checkbox">
                                          <div class="label-wrap">
                                              <label>“Online right now”</label>
                                              <p>Display</p>
                                          </div>
                                          <div class="checkbox">
                                              <input type="checkbox" class="toggle-input" id="toggle-2" wire:click="toggleStatus('profile_online_status')" {{ $statuses['profile_online_status'] ? 'checked' : '' }}>
                                              <label for="toggle-2" class="toggle-label"></label>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-row">
                                      <input type="submit" name="submit" value="Save Changes" id="submit"
                                          class="btn medium submit-btn" />
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
