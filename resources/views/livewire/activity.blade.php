<section class="main-content-wrap">
    <div class="activities-content">
        <div class="common-wrap clear">
            <!-- Begin tab section -->
            <div class="activities-tab-wrap">
                <div class="activities-tab-nav">
                    <div class="activities-tab-nav">
                        <ul class="activities-tab-list">
                            <li><a href="#"><span>Likes me</span> <dfn class="count">{{count($likeMe)}}</dfn></a></li>
                            <li><a href="#"><span>You like</span> <dfn class="count">{{count($youLikes)}}</dfn></a></li>
                            <li><a href="#"><span>Who's viewed me</span> <dfn class="count">0</dfn></a></li>
                            <li><a href="#"><span>Suitable</span> <dfn class="count">0</dfn></a></li>
                        </ul>
                    </div>
                    <!-- Begin filter-modal -->
                    <div class="filter-modal-wrap">
                        <a href="#" id="modal-toggle" class="filter-icon"><i class="jws-icon-sliders"></i></a>
                        <!-- filter modal -->
                        <div id="discover-filter-modal" class="filter-modal">
                            <div class="filter-modal-title">
                                <h6>Search for Your Matches</h6>
                                <a href="#" id="filter-reset"> Reset </a>
                            </div>
                            <!--  filter modal form -->
                            <form class="filter-modal-form">
                                <div class="filter-form-row">
                                    <label>Gender</label>
                                    <div class="genders">
                                        <div class="radio-box">
                                            <input type="radio" name="gender" id="gender-man" value="man" />
                                            <label class="gender-label" for="gender-man">
                                                Man
                                            </label>
                                        </div>
                                        <div class="radio-box">
                                            <input type="radio" value="women" id="gender-women" name="gender" />
                                            <label class="gender-label" for="gender-women" name="gender">Women</label>
                                        </div>
                                        <div class="radio-box">
                                            <input type="radio" value="nonbinary" id="gender-nonbinary"
                                                name="gender" />
                                            <label class="gender-label" for="gender-nonbinary"
                                                name="gender">Nonbinary</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-form-row">
                                    <label>Age</label>
                                    <div class="age-range-container">
                                        <select class="filter-selectric">
                                            <option value="min">Min</option>
                                            <option value="18">18</option>
                                            <option value="18">19</option>
                                            <option value="18">20</option>
                                        </select>
                                        <div>
                                            <span>-</span>
                                        </div>
                                        <select class="filter-selectric">
                                            <option value="max">Max</option>
                                            <option value="18">18</option>
                                            <option value="18">19</option>
                                            <option value="18">20</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="filter-form-row">
                                    <label>Country</label>
                                    <select class="filter-selectric">
                                        <option value="min">Country</option>
                                        <option value="France">France</option>
                                    </select>
                                </div>
                                <div class="filter-form-row">
                                    <label>Address <span>is within</span></label>
                                    <div class="address-inputs">
                                        <input type="number" id="quantity" name="quantity" min="1"
                                            max="5" />
                                        <select class="filter-selectric">
                                            <option value="km">km</option>
                                            <option value="miles">miles</option>
                                        </select>
                                        <span>of</span>
                                        <input type="search" placeholder="Start typing here to search..." />
                                        <!--<span>icon</span>-->
                                    </div>
                                </div>
                                <div class="filter-form-row options">
                                    <div class="options-head">
                                        <label>More options</label>
                                    </div>
                                    <div class="toggle-checkbox-wrap">
                                        <div class="toggle-checkbox">
                                            <label>Show Online</label>
                                            <div class="checkbox">
                                                <input type="checkbox" class="toggle-input" id="toggle-1" />
                                                <label for="toggle-1" class="toggle-label"></label>
                                            </div>
                                        </div>
                                        <div class="toggle-checkbox">
                                            <label>Verification</label>
                                            <div class="checkbox">
                                                <input type="checkbox" class="toggle-input" id="toggle-2" />
                                                <label for="toggle-2" class="toggle-label"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Advance search options -->
                                <div id="advance-search-options">
                                    <div class="filter-form-row">
                                        <label>Sports</label>
                                        <div class="checkbox-items">
                                            <div class="checkbox-item">
                                                <input id="bowling" type="checkbox" />
                                                <label for="bowling">Bowling</label>
                                            </div>
                                            <div class="checkbox-item">
                                                <input id="other-sports" type="checkbox" />
                                                <label for="other-sports">Other</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="filter-form-row">
                                        <label>Interests</label>
                                        <div class="checkbox-items">
                                            <div class="checkbox-item">
                                                <input id="beaches" type="checkbox" />
                                                <label for="beaches">Beaches</label>
                                            </div>
                                            <div class="checkbox-item">
                                                <input id="other-interests" type="checkbox" />
                                                <label for="other-interests">Other</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="filter-form-row">
                                        <label>Relationship Status *</label>
                                        <div>
                                            <select class="filter-selectric">
                                                <option value="relationship">Relationship Status *</option>
                                                <option value="single">single</option>
                                                <option value="single">Living together</option>
                                                <option value="single">Married </option>
                                                <option value="single">Separated </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="filter-form-row">
                                        <label>Alcohol</label>
                                        <div>
                                            <select class="filter-selectric">
                                                <option value="alcohol">Alcohol</option>
                                                <option value="no-alcohol">
                                                    alcohol
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="filter-form-row">
                                        <label>Smoking</label>
                                        <div class="checkbox-items">
                                            <div class="checkbox-item">
                                                <input id="smoking" type="checkbox" />
                                                <label for="smoking"> Don't smoke</label>
                                            </div>
                                            <div class="checkbox-item">
                                                <input id="other-smoking" type="checkbox" />
                                                <label for="other-smoking"> Smoke regularly</label>
                                            </div>
                                            <div class="checkbox-item">
                                                <input id="other-smoking" type="checkbox" />
                                                <label for="other-smoking">Smoke occasionally</label>
                                            </div>
                                            <div class="checkbox-item">
                                                <input id="other-smoking" type="checkbox" />
                                                <label for="other-smoking"> Prefer not to say</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- Advance Search -->
                            <div class="action-button-bottom">
                                <button id="slide-toggle-btn" class="btn show-advanced" type="button">
                                    Advanced search
                                </button>
                                <button class="btn large Show-matches" type="submit">
                                    Show matches
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="activities-tab-content">
                    <div class="activities-tab-item active">
                        <div class="activities-item-desc">
                            <img src="./svgs/likestage.svg" alt="">
                            <h4>Someone likes you!</h4>
                            <p>They saw your profile and liked you. Get Premium to see everyone who likes you.</p>
                            <a href="{{route('f.subscription')}}" wire:navigate class="btn btn-primary"><i class="jws-icon-diamond"></i>Upgrade Now</a>
                        </div>
                    </div>
                    <div class="activities-tab-item">
                        <div class="activities-card-wrap">
                            @foreach($youLikes as $youl)
                            <div class="activities-card">
                                <div class="activities-card-thumb">
                                    <a href="#"><img src="{{asset('images')}}/{{$youl->pet->thumbnail ?? ''}}"
                                            alt="member"></a>
                                    <a href="#" class="match-like">
                                        <i class="jws-icon-heart"></i>
                                    </a>
                                </div>
                                <div class="activities-card-text">
                                    <a href="{{ route('f.detail', $youl->pet->slug ?? '') }}" class="activities-card-name">{{$youl->pet->name ?? ''}}</a>
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
                    <div class="activities-tab-item">
                        <div class="activities-item-desc">
                            <img src="./svgs/Video-Conference.svg" alt="">
                            <h4>Not found</h4>
                            <p>Discover user.</p>
                            <a href="#" class="btn btn-primary"><i class="jws-icon-diamond"></i>Discover</a>
                        </div>
                    </div>
                    <div class="activities-tab-item">
                        <div class="activities-item-desc">
                            <img src="./svgs/Video-Conference.svg" alt="">
                            <h4>Someone likes you!</h4>
                            <p>They saw your profile and liked you. Get Premium to see everyone who likes you.</p>
                            <a href="{{route('f.subscription')}}" wire:navigate class="btn btn-primary"><i class="jws-icon-diamond"></i>Upgrade Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End tab section -->
        </div>
    </div>


</section>
