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
                        <a href="{{ route('f.petlisting.add') }}" wire:navigate class="btn black"><i
                                class="plussmall-icon"></i> Rehome Your Pet</a>
                    </div>
                    <div class="no-data-found">

                        <table class="my-listing-table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <!--<th>Expires On</th>-->
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @if ($errors)
                                <p>{{ $errors }} <a href="{{ route('f.subscription') }}"><strong> > Buy
                                            Spotlight</strong></a> </p>
                            @endif
                            <tbody>
                                @foreach ($pets as $pet)
                                    <tr>
                                        <td>
                                            <div class="listing-thumb">
                                                <a href="{{ route('f.detail', $pet->slug) }}"><img
                                                        src="{{ asset('images') }}/{{ $pet->images->first()->image ?? '' }}"
                                                        alt=""></a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="ad-details">
                                                <a class="listing-title"
                                                    href="{{ route('f.detail', $pet->slug) }}">{{ $pet->name }} </a>

                                                <ul class="meta-list">

                                                    <li>
                                                        @if ($pet->spotlight->isNotEmpty())
                                                            <span class="pending"> Spotligt </span>
                                                        @else
                                                        @endif
                                                    </li>
                                                    <li>
                                                        <img src="{{ asset('customer') }}/svgs/my-listing/eye.svg"
                                                            alt="">
                                                        {{ $pet->views }} Views
                                                    </li>

                                                    <li>
                                                        <img src="{{ asset('customer') }}/svgs/my-listing/tele.svg"
                                                            alt="">{{ $pet->like }} Favourite
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="price-amount">{{ $pet->price }}</span>
                                        </td>
                                        <!--<td class="expires-on"></td>-->
                                        <td>
                                            <span
                                                class="pending">{{ $pet->isPublished == 1 ? 'live' : 'Pending' }}</span>
                                        </td>
                                        <td>
                                            <div class="actions-wrap">
                                                <div class="actions-dot">
                                                    <svg width="18" height="4" viewBox="0 0 18 4" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
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
                                                        @if ($pet->spotlight->isNotEmpty())
                                                        @else
                                                            <li>
                                                                <a style="cursor: pointer"
                                                                    wire:click="addToSpotLight({{ $pet->id }})">
                                                                    <img src="{{ asset('customer') }}/svgs/my-listing/promote.svg"
                                                                        alt="">
                                                                    <span>Add To Spotligt</span>
                                                                </a>
                                                            </li>
                                                        @endif

                                                        @if ($pet->is_promote == 1)
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                    @if ($pet->promotePayments->isEmpty() || $pet->promotePayments->first()->status !== 'COMPLETED') wire:click="promotePayment({{ $pet->id }})" @endif>
                                                                    <img src="{{ asset('customer') }}/svgs/my-listing/check-mark.svg"
                                                                        alt="">
                                                                    <span>Promote</span>
                                                                    {{-- Also update the text to reflect the actual status --}}
                                                                    <strong>({{ $pet->promotePayments->isNotEmpty() ? ($pet->promotePayments->first()->status === 'COMPLETED' ? 'Paid' : 'Pending/Other') : 'UnPaid' }})</strong>
                                                                </a>
                                                            </li>
                                                        @endif

                                                        <li>
                                                            <a href="{{ route('f.petlisting.edit', $pet->id) }}"
                                                                wire:navigate>
                                                                <img src="{{ asset('customer') }}/svgs/my-listing/edit.svg"
                                                                    alt="">
                                                                <span>Edit</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                wire:click="petDelete({{ $pet->id }})">
                                                                <img src="{{ asset('customer') }}/svgs/my-listing/delete.svg"
                                                                    alt="">
                                                                <span>Delete</span>
                                                            </a>
                                                        </li>

                                                    </ul>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                {{ $pets->links() }}
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

<!--@script-->
<!--    <script>
    -- >
    <
    !--$('.actions-dot').click(function(e) {
        -- >
        <
        !--
        let menuElement = e.currentTarget.nextElementSibling;
        -- >

        <
        !--
        if (menuElement.classList.contains('open')) {
            -- >
            <
            !--menuElement.classList.remove('open');
            -- >
            <
            !--
        } else {
            -- >
            <
            !--$('.actions-dropdown').removeClass('open');
            -- >
            <
            !--menuElement.classList.add('open');
            -- >
            <
            !--
        }-- >
        <
        !--
    });
    -- >
    <
    !--
</script>-->
<!--@endscript-->
