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
                             <h5>Removed profiles</h5>
                             <p>Manage who shows up in your search and who does not.</p>
                             <div class="gallery-card">
                                 <div class="gallery-thumb">
                                     <a href="#"> <img
                                             src="{{ asset('customer') }}/img/activities/member-img-9.jpg"
                                             alt=""></a>
                                     <div class="members-active">
                                         <p> Offline</p>
                                     </div>
                                     <div class="groups-admin">
                                         <button type="button" class="btn-dropdown">
                                             <i class="jws-icon-dotsthreeoutline"></i>
                                         </button>
                                         <div class="menu-dropdown">
                                             <ul>
                                                 <li><a href="#"><i class="jws-icon-copysimple"></i> Copy Link
                                                         Profile </a></li>
                                                 <li><a href="#"><i class="jws-icon-eye"></i> Show in search </a>
                                                 </li>
                                             </ul>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="gallery-card-text">
                                     <a href="#" class="gallery-card-name">Kai</a>
                                     <div class="member-info">
                                         <p>Alice</p>
                                         <span>29</span>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <!-- End profile body -->
             </div>
         </div>
     </section>
 </section>
 <!-- //End main content section -->
