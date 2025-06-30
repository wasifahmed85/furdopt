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
                        <div class="profile-tab-list">
                            <ul>
                                <li><a href="{{ route('f.subscription') }}" wire:navigate class="curent">Subscription</a>
                                </li>
                                <li><a href="{{ route('f.payment.method') }}" wire:navigate>Payment Method</a></li>
                                <li><a href="{{ route('f.billing') }}" wire:navigate>Billing</a></li>
                            </ul>
                        </div>
                        <div class="profile-tab-content">
                            <div class="pmpro-content">
                                <h5>Remain Spotlight: {{ Auth::user()->spotlight }}</h5>
                               

                                <div class="pmpro-level">
                                    @foreach ($plans as $plan)
                                        <div class="pmpro-card">
                                            <h5>{{ $plan->name }}</h5>
                                            <div class="price">
                                                <h2>£{{ $plan->price }}</h2>
                                                <span>/ {{ $plan->duration }} {{$plan->type}}</span>
                                            </div>
                                            <div class="pmpro-list">
                                                
                                                    {!! $plan->descriptions !!}
                                                
                                                <!--<ul>-->
                                                <!--    <li><i class="d-inline-block jws-icon-checkcircle"-->
                                                <!--            style="color: #5bbb7b;"></i> {{ $plan->max_pets_allowed }}-->
                                                <!--        Pet Listing Allowed</li>-->
                                                <!--    <li><i class="d-inline-block jws-icon-checkcircle"-->
                                                <!--            style="color: #5bbb7b;"></i> See who’s viewed you</li>-->
                                                <!--    <li><i class="d-inline-block jws-icon-minuscircle"-->
                                                <!--            style="color: #999999;"></i> Send unlimited messages</li>-->
                                                <!--</ul>-->
                                                <a href="#" class="btn black"
                                                    wire:click.prevent="openModal({{ $plan->id }})">Buy Spotlights</a>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{-- <div class="pmpro-card">
                                        <h5>Premium Gold</h5>
                                        <div class="price">
                                            <h2>£24</h2>
                                            <span>/Month</span>
                                        </div>
                                        <div class="pmpro-list">
                                            <ul>
                                                <li><i class="d-inline-block jws-icon-checkcircle"
                                                        style="color: #5bbb7b;"></i> See who liked you</li>
                                                <li><i class="d-inline-block jws-icon-checkcircle"
                                                        style="color: #5bbb7b;"></i> See who’s viewed you</li>
                                                <li><i class="d-inline-block jws-icon-checkcircle"
                                                        style="color: #5bbb7b;"></i> See who’s viewed you</li>
                                            </ul>
                                            <a href="#" class="btn black">Your Level</a>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End profile body -->
            </div>
        </div>
        <!-- Modal -->
        @if ($selectedPlan)
            <div class="modal-overlay {{ $showModal ? 'show' : '' }}">
                <div class="modal-content">
                    <h2>{{ $selectedPlan->name }}</h2>
                    <p>Duration: {{ $selectedPlan->duration }} {{$plan->type}}</p>
                    <p>Price: £{{ $selectedPlan->price }}</p>
                    <!--<p>Ad: {{ $selectedPlan->max_pets_allowed }}</p>-->

                    <form action="{{ route('checkout') }}" method="post">
                        @csrf
                        <input type="hidden" name="plan_id" value="{{ $selectedPlan->id }}">
                        <input type="radio" id="stripe" name="payment_method" value="stripe"> 
                        <label for="stripe">Stripe</label>
                        <input type="radio" id="paypal" name="payment_method" value="paypal"> 
                        <label for="paypal">Paypal</label>
                        <button type="submit">Checkout</button>
                    </form>
                    <button class="close-btn" wire:click="closeModal">Close</button>
                </div>
            </div>
        @endif
    </section>
</section>
<!-- //End main content section -->
