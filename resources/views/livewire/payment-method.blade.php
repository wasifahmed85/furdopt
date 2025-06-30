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
                                <li><a href="{{ route('f.subscription') }}" wire:navigate>Subscription</a></li>
                                <li><a href="{{ route('f.payment.method') }}" wire:navigate class="curent">Payment
                                        Method</a></li>
                                <li><a href="{{ route('f.billing') }}" wire:navigate>Billing</a></li>
                            </ul>
                        </div>
                        <div class="profile-tab-content">
                            <div class="payment-method-content">
                                <div class="paymen-method">
                                    <h5>Your Spotlight</h5>
                                    <div class="money">
                                        <!--<i class="jws-icon-money"></i>-->
                                        <img src="{{asset('customer')}}/svgs/spotlight2.svg" alt="cross"/>
                                        <h3>{{Auth::user()->spotlight}}</h3>
                                        <span>Spotlight</span>
                                    </div>
                                    <a href="{{route('f.subscription')}}" wire:navigate class="more-credits">Get more spotlight</a>
                                </div>
                                <div class="billing-address">
                                    <h5>Payment method</h5>
                                    <ul>
                                        <li><strong>Full
                                                Name:</strong>{{ Auth::user()->billing->first_name ?? '' }}{{ Auth::user()->billing->last_name ?? '' }}<a
                                                class="edit" href="{{route('f.billing')}}" wire:navigate><i class="jws-icon-pencilline"></i></a>
                                        </li>
                                        <li><strong>Address:</strong>{{ Auth::user()->billing->street_address1 ?? '' }}
                                            {{ Auth::user()->billing->street_address2 ?? '' }}
                                            <a class="edit" href="{{route('f.billing')}}" wire:navigate><i class="jws-icon-pencilline"></i></a>
                                        </li>
                                        <li><strong>Email:</strong>{{ Auth::user()->billing->email ?? 'Not Yet Setup' }}<a
                                                class="edit" href="{{route('f.billing')}}" wire:navigate><i class="jws-icon-pencilline"></i></a>
                                        </li>
                                        <li><strong>Phone:</strong> {{ Auth::user()->billing->phone ?? 'Not Yet Setup' }}<a class="edit" href="{{route('f.billing')}}" wire:navigate><i
                                                    class="jws-icon-pencilline"></i></a></li>
                                                     
                                    </ul>

                                </div>
                            </div>
                            <div class="purchase-history">
                                <h5 class="">Purchase history</h5>
                                <table>
                                    <thead>
                                        <tr class="table-heading">
                                            <th>Date</th>
                                            <th>Spotlight</th>
                                            <th>Payment method</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body">
                                        
                                        @foreach($payments as $payment)
                                        <tr>
                                            <td>{{$payment->created_at->format('Y m d')}}</td>
                                            <td>{{$payment->subcription->spotlight}}</td>
                                            <td>{{$payment->payment_gateway}}</td>
                                            <td>{{$payment->amount}}</td>
                                            <td>{{$payment->status}}</td>
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
