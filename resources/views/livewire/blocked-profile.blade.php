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
                     </div>
                     <div class="profile-body my-listing-body">
                         <h5>Blocked profiles</h5>
                         <p>
                             Blocking prevents members from sending you messages and likes. Want to give them a
                             second chance? Unblock to start communicating with them
                         </p>

                         <div class="my-listings-search">
                             <form action="#" method="post" class="form scearch-form">
                                 <div class="search-box">
                                     <input type="search" placeholder="Search by title" wire:model.live="searchTerm">
                                     <button type="submit" class="scearch-icon"> <i aria-hidden="true"
                                             class="jws-icon-magnifying-glass"></i></button>
                                 </div>
                             </form>

                         </div>
                         <div class="no-data-found">

                             <table class="my-listing-table">
                                 <thead>
                                     <tr>
                                         <th>Avatar</th>
                                         <th>User name</th>
                                         <th>Block Date</th>
                                         <th>Action</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($users as $user)
                                         <tr>
                                             <td>
                                                 <div class="listing-thumb">
                                                     <a href="#"><img
                                                             src="{{ asset('images') }}/{{ $user->avatar ?? 'deafult.jpg' }}"
                                                             alt=""></a>
                                                 </div>
                                             </td>
                                             <td>
                                                 <div class="ad-details">
                                                     <a class="listing-title" href="#">{{ $user->user->name }}</a>

                                                 </div>
                                             </td>
                                             <td>
                                                 <span class="price-amount">{{ $user->created_at->format('d-M-y') }}
                                                 </span>
                                             </td>

                                             <td>
                                                 <div class="actions-wrap">
                                                     <div class="actions-dot">
                                                         <svg width="18" height="4" viewBox="0 0 18 4"
                                                             fill="none" xmlns="http://www.w3.org/2000/svg">
                                                             <circle cx="2" cy="2" r="2" fill="#646464">
                                                             </circle>
                                                             <circle cx="9" cy="2" r="2" fill="#646464">
                                                             </circle>
                                                             <circle cx="16" cy="2" r="2" fill="#646464">
                                                             </circle>
                                                         </svg>
                                                     </div>
                                                     <div class="actions-dropdown">
                                                         <ul>
                                                             <li>
                                                                 <a wire:click="unblockUser({{ $user->blocked_user_id }})"
                                                                     style="cursor: pointer"
                                                                     id="user({{ $user->id }})">
                                                                     <img src="svgs/my-listing/promote.svg"
                                                                         alt="">
                                                                     <span>Un Block</span>
                                                                 </a>
                                                             </li>

                                                         </ul>
                                                     </div>
                                                 </div>
                                             </td>
                                         </tr>
                                     @endforeach
                                 </tbody>
                             </table>
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
