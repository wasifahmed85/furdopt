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
                                <li><a href="{{ route('f.payment.method') }}" wire:navigate>Payment
                                        Method</a></li>
                                <li><a href="{{ route('f.billing') }}" wire:navigate class="curent">Billing</a></li>
                            </ul>
                        </div>
                        <div class="profile-tab-content">
                            <div class="pmpro-content">
                                <h5>Billing address</h5>
                            </div>
                            <form wire:submit="updateBilling" class="form form-divider">
                                <div class="form-row">
                                    <div class="form-col">
                                        <div class="form-item">
                                            <label>First name <abbr class="required" title="required">*</abbr></label>
                                            <input type="text" 
                                                value="{{ Auth::user()->billing->first_name ?? '' }}"
                                                wire:model="first_name" />
                                            @error('first_name')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-item">
                                            <label>Last name <abbr class="required" title="required">*</abbr></label>
                                            <input type="text" 
                                                value="{{ Auth::user()->billing->last_name ?? '' }}"
                                                wire:model="last_name" />
                                            @error('last_name')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <label>Company name (optional)</label>
                                    <input type="text" placeholder="Write your company name"
                                        value="{{ Auth::user()->billing->company_name ?? '' }}""
                                        wire:model="company_name" />
                                </div>
                                <div class="form-row">
                                    <label>Country<abbr class="required" title="required">*</abbr></label>
                                    <select name="country_id" wire:model="country_id" readonly>
                                        <option value="104">United Kingdom</option>
                                        
                                    </select>
                                    @error('country_id')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-row">
                                    <label>Street address <abbr class="required" title="required">*</abbr></label>
                                    <input type="text"  wire:model="street_address1" />
                                    @error('street_address1')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-row">
                                <label>Street address 2 <label>
                                    <input type="text"  wire:model="street_address2" />
                                </div>
                                <div class="form-row">
                                    <label>Town / City <abbr class="required" title="required">*</abbr></label>
                                    <input type="text"  wire:model="city" />
                                    @error('city')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-row">
                                    <label>County <abbr class="required" title="required">*</abbr></label>
                                    <input type="text" wire:model="state" />
                                    @error('state')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-row">
                                    <label>Postcode<abbr class="required"
                                            title="required">*</abbr></label>
                                    <input type="text"  wire:model="post_code" />
                                    @error('post_code')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-row">
                                    <label>Phone <abbr class="required" title="required">*</abbr></label>
                                    <input type="text"  wire:model="phone" />
                                    @error('phone')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-row">
                                    <label>Email address <abbr class="required" title="required">*</abbr></label>
                                    <input type="text"  wire:model="email"
                                        value="{{ Auth::user()->billing->email ?? '' }}" />
                                    @error('email')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
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
