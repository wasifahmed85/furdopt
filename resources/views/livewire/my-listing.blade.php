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
                    <h5>my listings</h5>
                    <div class="my-listings-search">
                        <form action="#" method="post" class="form scearch-form">
                            <div class="search-box">
                                <input type="search" placeholder="Search by title" value="">
                                <button type="submit" class="scearch-icon"> <i aria-hidden="true"
                                        class="jws-icon-magnifying-glass"></i></button>
                            </div>
                        </form>
                        <a href="{{ route('f.petlisting.add') }}" wire:navigate class="btn black">Add Listing</a>
                    </div>
                    <div class="no-data-found">
                        <P>No listing found</P>
                        <table class="my-listing-table">
                            <thead>
                                <tr>
                                    <th>Thumbnail</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Expires On</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="listing-thumb">
                                            <a href="#"><img src="./img/my-listing/download.jpg"
                                                    alt=""></a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="ad-details">
                                            <a class="listing-title" href="#">sdfsdfs</a>
                                            <div class="badge-wrap">
                                                <span class="badge-new">New</span>
                                            </div>
                                            <ul class="meta-list">
                                                <li> <img src="{{asset('customer')}}/svgs/my-listing/clock.svg" alt="">15 minutes ago
                                                </li>
                                                <li>
                                                    <img src="{{asset('customer')}}/svgs/my-listing/food.svg" alt="">
                                                    foods
                                                    <!-- <a href="#">Foods<a> -->
                                                </li>
                                                <li>
                                                    <img src="{{asset('customer')}}/svgs/my-listing/eye.svg" alt=""> 0 Views
                                                </li>
                                                <li>
                                                    <img src="{{asset('customer')}}/svgs/my-listing/hand.svg" alt="">0 Reveals
                                                </li>
                                                <li>
                                                    <img src="{{asset('customer')}}/svgs/my-listing/tele.svg" alt=""> 0 Clicks
                                                </li>
                                                <li>
                                                    <img src="{{asset('customer')}}/svgs/my-listing/tele.svg" alt="">0 Clicks
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="price-amount">56Fr</span>
                                    </td>
                                    <td class="expires-on"></td>
                                    <td>
                                        <span class="pending">Pending</span>
                                    </td>
                                    <td>
                                        <div class="actions-wrap">
                                            <div class="actions-dot">
                                                <svg width="18" height="4" viewBox="0 0 18 4" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="2" cy="2" r="2" fill="#646464"></circle>
                                                    <circle cx="9" cy="2" r="2" fill="#646464"></circle>
                                                    <circle cx="16" cy="2" r="2" fill="#646464"></circle>
                                                </svg>
                                            </div>
                                            <div class="actions-dropdown">
                                                <ul>
                                                    <li>
                                                        <a href="subscription.html">
                                                            <img src="{{asset('customer')}}/svgs/my-listing/promote.svg" alt="">
                                                            <span>Promote</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <img src="{{asset('customer')}}/svgs/my-listing/edit.svg" alt="">
                                                            <span>Edit</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <img src="{{asset('customer')}}/svgs/my-listing/delete.svg" alt="">
                                                            <span>Delete</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <img src="{{asset('customer')}}/svgs/my-listing/check-mark.svg" alt="">
                                                            <span>Mark as sold</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <!-- End profile body -->
        </div>
        </div>
    </section>
</section>
<!-- //End main content section -->
