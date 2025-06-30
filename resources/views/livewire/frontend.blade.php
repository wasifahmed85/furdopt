@push('css')
    <style>
        /*How it work */
        .how-it-works {
            padding: 65px 0 0 0;
            background: #041325;
        }

        .how-it-works-inner {
            background-image: linear-gradient(to right, #1cc2d8, #fadd5b);
            border-radius: 30px;
            margin-top: 40px;
            padding: 30px 0;
        }

        .how-it-works h3 {
            font-size: 54px;
            line-height: 60px;
            color: #ffffff;
            text-align: center;
        }

        .how-it-works-inner {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 30px;
        }

        .how-it-work-item {
            text-align: center;
            padding: 20px;
        }

        .how-it-work-item img {
            width: 100px;
        }

        .how-it-work-item h4 {
            margin-top: 20px;
        }

        .how-it-work-item p {
            margin-top: 15px;
        }

        /* Message Modal CSS */
        .safety-icon {
            width: 60px;
            height: 60px;
            background: #dc3545;
            color: white;
            font-size: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .close-modal {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            color: gray;
        }

        /* Modal Styling */
        .modal-content {
            position: relative;
            background-color: #fffce6;
            border-radius: 1rem;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            width: 90%;
            max-width: 400px;
        }

        .modal-header .close-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* Modal Body */
        .modal-body {
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            color: #292929;
            padding: 1rem;
            text-align: center;
        }

        /* Modal Footer */
        .modal-footer {
            padding: 1rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .btn {
            padding: 0.5rem 1.5rem;
            border-radius: 999px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-primary {
            background-image: linear-gradient(to right, #1cc2d8, #fadd5b);
            color: white;
            border: none;
        }

        @media only screen and (min-width: 280px) and (max-width: 768px) {

            .how-it-works {
                padding: 40px 0 0 0;
            }

            .how-it-works-inner {
                display: block;
            }

            .how-it-work-item {
                padding: 20px 10px;
            }

            .how-it-work-item h4 {
                margin-top: 10px;
            }

            .how-it-work-item p {
                margin-top: 5px;
            }

            /*How it works*/

        }
    </style>
@endpush

<!-- Begin main content section -->
<div class="main-content">
    <!-- Begin Hero section -->
    <section class="hero-wrap hp-hero">
        <div class="common-wrap  clear">
            <div class="hero-inner">
                <div class="hero-text">
                    <div class="hero-desc">
                        <h3>Adopt Your Perfect Pet!</h3>
                        <p>Find a Pet that Suits your Lifestyle and Give them a Second Chance at Love! Explore Rescue
                            centres and Individuals who are Rehoming.</p>
                    </div>
                    <div class="search-container">
                        <form wire:submit.prevent="search">
                            <div class="search-items">
                                <div class="search-item {{ $categoryId == 1 ? 'active' : '' }}"
                                    wire:click="selectCategoryCat(1)">
                                    <img src="{{ asset('frontendAssets/img/home/dogs.png') }}" alt="dogs-image">
                                    <span>Dogs</span>
                                </div>
                                <div class="search-item {{ $categoryId == 3 ? 'active' : '' }}"
                                    wire:click="selectCategoryCat(3)">
                                    <img src="{{ asset('frontendAssets/img/home/cats.png') }}" alt="cats-image">
                                    <span>Cats</span>
                                </div>
                                <div class="search-item {{ !in_array($categoryId, ['1', '3']) ? 'active' : '' }}"
                                    id="other-search">
                                    <i class="categories-icon"></i>
                                    @if ($categoryId != 1 || $categoryId != 3)
                                        <span id="search-name">{{ $other }}</span>
                                    @else
                                        <span id="search-name">Other</span>
                                    @endif
                                    <ul class="search-dropdown">
                                        @foreach ($categories as $cat)
                                            <li wire:click="selectCategoryCat({{ $cat->id }})">{{ $cat->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>


                            <div>
                                <select class="searchLocation select22" wire:model="breedId" id="select22">
                                    <option value="" disabled selected>Select breed</option>
                                    @foreach ($breeds as $breed)
                                        <option value="{{ $breed->id }}">{{ $breed->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="location-container location" wire:ignore>
                                <select class="form-control" wire:model="location" id="select2">
                                    <option value="" disabled selected>Select Location</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->state }}</option>
                                    @endforeach
                                </select>
                                @if (Auth::check())
                                    <button class="search-button" type="submit">Find your match</button>
                                @else
                                    <a class="search-button" href="{{ route('f.login') }}">Find your match</a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
                <div class="hero-thumb">
                    <img src="{{ asset('frontendAssets/img/home/hero_img.png') }}" alt="hero-image">
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero section -->
    <seciton class="sign-up-wrap">
        <div class="common-wrap clear">
            <div class="dogs-wrap">
                <img src="{{ asset('frontend/img/home/Top-Pets.png') }}" alt="">
            </div>
            <div class="sign-up">
                <div class="sign-up-text">
                    <h2>I need to rehome my pet!</h2>
                    <p>Start the process. It's free to list your pet on FurDopt.</p>
                </div>

                @auth
                    <a href="{{ route('f.petlisting.add') }}" class="btn btn-secondary btn-md" style="font-size:18px"> <i
                            class="plussmall-icon"></i>
                        List your Pet up for Adoption</a>
                @else
                    <a href="{{ route('f.register') }}" class="btn btn-secondary btn-md" style="font-size:18px"> <i
                            class="plussmall-icon"></i> List your Pet up for Adoption</a>
                @endauth

            </div>
        </div>
    </seciton>
    <!-- Begin how it works section -->
    <section class="how-it-works">
        <div class="common-wrap clear">
            <h3>How it works</h3>
            <div class="how-it-works-inner">
                <div class="how-it-work-item">
                    <img src="{{ asset('frontendAssets/img/home/listing-2.png') }}" alt="hero-image">
                    <h4>Create a Listing</h4>
                    <p>Tell us about your pet</p>
                </div>
                <div class="how-it-work-item">
                    <img src="{{ asset('frontendAssets/img/home/smart-6.png') }}" alt="hero-image">
                    <h4>Smart Matching</h4>
                    <p>Our algorithm connects you with the best adopters.</p>
                </div>
                <div class="how-it-work-item">
                    <img src="{{ asset('frontendAssets/img/home/match-3.png') }}" alt="hero-image">
                    <h4>Meet the Perfect match</h4>
                    <p>Message adopters and browse their profiles.</p>
                </div>
                <div class="how-it-work-item">
                    <img src="{{ asset('frontendAssets/img/home/finalize-1.png') }}" alt="hero-image">
                    <h4>Finalize the Adoption</h4>
                    <p>Complete the process securely </p>
                </div>
                <div class="how-it-work-item">
                    <img src="{{ asset('frontendAssets/img/home/secure-5.png') }}" alt="hero-image">
                    <h4>Secure the Right Home</h4>
                    <p>Find the perfect match for your pet’s needs.</p>
                </div>
                <div class="how-it-work-item">
                    <img src="{{ asset('frontendAssets/img/home/safe-4.png') }}" alt="hero-image">
                    <h4>Safe & secure</h4>
                    <p>We ensure, your personal data is safe & secure. </p>
                </div>


            </div>
        </div>
    </section>
    <!-- End how it works section -->
    <!-- Begin sign-up section -->
    <!-- call to action -->
    <!-- End sign-up section -->
    <div class="gallery-wrap sport-light">
        <!-- Hidden by default -->
        <div class="modal-overlay" id="safetyModal">
            <div class="modal-content">
                <button type="button" class="close-modal" id="cancelModalBtn">
                    <i class="bi bi-x-lg"></i>
                </button>
                <div class="modal-header">
                    <div class="safety-icon">
                        <i class="bi bi-exclamation-triangle-fill text-white fs-3"></i>
                    </div>
                    <button type="button" class="close-btn" id="closeModalBtn">&times;</button>
                </div>
                <div class="modal-body">
                    Never send money upfront, avoid paying deposits, ask lots of questions, and always
                    request a video call to verify the person is genuine.
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-primary" id="proceedBtn" wire:navigate>Continue</a>
                </div>
            </div>
        </div>

        <div class="common-wrap clear">
            <h3>Spotlighted Pets</h3>

            <div class="gallery-grid">

                @foreach ($spots as $pet)
                    <div class="gallery-card">
                        <div class="gallery-thumb">
                            <a href="{{ route('f.detail', $pet->slug) }}"> <img
                                    src="{{ asset('images/' . $pet->images->first()->image ?? '') }}"
                                    alt=""></a>
                            <!--<a href="{{ route('f.detail', $pet->slug) }}"> <img-->
                            <!--src="{{ asset('images/' . $pet->thumbnail) }}" alt=""></a>-->

                            <div class="button-action">
                                @if ($pet->owner_id == 201)
                                    <a href="javascript:void(0);" class="sent-msg openSafetyModal"
                                        data-href="{{ route('f.detail', $pet->slug) }}">
                                        <i class="jws-icon-chatcircledots"></i>Message now!
                                    </a>
                                @else
                                    <a href="javascript:void(0);" class="sent-msg openSafetyModal"
                                        data-href="{{ route('f.single.chat', $pet->owner_id) }}">
                                        <i class="jws-icon-chatcircledots"></i>Message now!
                                    </a>
                                @endif
                                <!--<a href="#" class="like-heart"><i class="jws-icon-heart"></i> 80%</a>-->

                                @if (Auth::check())
                                    @if ($pet->likes()->where('user_id', auth()->user()->id)->exists())
                                        <a wire:click="petLikes({{ $pet->id }})" class="like-heart"><i
                                                class="jws-icon-heart jws-icon-heart-select"></i></a>
                                    @else
                                        <a wire:click="petLikes({{ $pet->id }})" class="like-heart"><i
                                                class="jws-icon-heart"></i></a>
                                    @endif
                                @else
                                    <a wire:click="petLikes({{ $pet->id }})" class="like-heart"><i
                                            class="jws-icon-heart"></i></a>
                                @endif

                            </div>
                        </div>
                        <div class="gallery-card-text">

                            <a href="{{ route('f.detail', $pet->slug) }}"
                                class="gallery-card-name">{{ $pet->name }}</a>
                            <div class="seller-info">
                                <div class="seller-icon-wrap">
                                    <i class="seller-icon"></i>
                                </div>
                                <h6 class="seller-name">{{ $pet->user->name ?? '' }}</h6>
                                @if (!empty($pet->charity_name_admin))
                                    <div class="seller-icon-wrap">
                                        <i class="seller-icon"></i>
                                    </div>
                                    <h6 class="seller-name">{{ $pet->charity_name_admin }}</h6>
                                @endif
                                <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->

                            </div>

                            <div class="gallery-card-time">
                                <i class="time-icon"></i>
                                <p>{{ $pet->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="member-info">
                                <div class="member-info-inner">
                                    <i class="locations-icon"></i>
                                    <p>{{ $pet->state->state ?? '' }}, Uk</p>
                                </div>
                                <span> {{ $pet->price == 0 ? '' : '£' . $pet->price }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!--  Begin Our Story section -->
    <section class="our-story">
        <div class="common-wrap clear">
            <div class="our-story-grid">
                <div class="our-story-text">
                    <P>FurDopt is a free, easy-to-use platform dedicated to helping pets find their perfect forever
                        homes. Whether a pet is in a rescue, shelter, or with an individual who can no longer care for
                        them, we believe every pet deserves a loving family that suits their needs and lifestyle.</P>
                    <P>We go beyond just rehoming—we focus on matching pets with adopters based on their lifestyle,
                        needs, and expectations. Whether it’s an energetic pup needing an active owner, a senior cat
                        looking for a quiet home, or a family searching for the perfect furry companion, FurDopt ensures
                        the right fit for both the pet and the adopter.</P>
                    <P>For individuals looking to rehome their beloved pet, we help connect them with a pawrent who
                        meets their pet’s unique needs—providing peace of mind that they are going to a home where they
                        will be loved and cared for.</P>
                    <P>With FurDopt, every pet’s journey is about finding not just a home, but the right home</P>
                    <a href="{{ route('f.filter') }}" class="btn btn-md btn-secondary">Adopt a pet today! </a>
                </div>
                <div class="our-story-thumb">
                    <img src="{{ asset('frontend/img/home/our-story-V1.jpg') }}" alt="">
                </div>
            </div>
        </div>
    </section>
    <!--  End Our Story section -->
    <!-- Beging newsletter section -->
    <section class="news-letter">
        <div class="common-wrap clear">
            <div class="dogs-wrap">
                <img src="{{ asset('frontend/img/home/Top-Subscribe.png') }}" alt="">
            </div>
            <div class="news-letter-inner">
                <div class="news-letter-text">
                    <h2>Stay updated with us!</h2>
                    <p> Register here for the latest updates regarding pet adoption & rehome.</p>
                </div>
                <div class="news-letter-form-wrap">
                    <div class="news-letter-arrow">
                        <img src="{{ asset('frontend/svgs/newsletter-arrow.svg') }}" alt="">
                    </div>
                    <form wire:submit="newSubcriber" class="form news-letter-form">
                        <div class="form-row">
                            <input type="email" placeholder="Enter full email address" wire:model="email">
                            <input type="submit" class="btn btn-secondary" value="Subscribe">
                            @error('email')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <p style="margin-top:10px">{{ $success }}</p>
                        <div class="news-letter-form-text">

                            <img src="{{ asset('frontend/svgs/newsletter-checkmark.svg') }}" alt="">
                            <p> Join the most trusted pet newsletter in the UK.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End newsletter section -->
</div>
<!-- End main content section -->



@push('scripts')
    <!--<script>
        -- >
        <
        !--document.addEventListener('livewire:load', function() {
            -- >
            <
            !--$('#select22').select2({
                -- >
                <
                !--placeholder: 'Select breed',
                -- >
                <
                !--allowClear: true-- >
                    <
                    !--
            });
            -- >

            <
            !--Livewire.on('breedUpdated', function() {
                -- >
                <
                !--$('#select22').select2('destroy');
                -- >
                <
                !--$('#select22').select2({
                    -- >
                    <
                    !--placeholder: 'Select breed',
                    -- >
                    <
                    !--allowClear: true-- >
                        <
                        !--
                });
                -- >
                <
                !--
            });
            -- >
            <
            !--
        });
        -- >
        <
        !--
    </script>-->

    <script>
        $(document).ready(function() {


            $('#select2').select2({
                matcher: function(params, data) {
                    // If there is no search term, return all data
                    if ($.trim(params.term) === '') {
                        return data;
                    }

                    // Check if the text starts with the typed term (case insensitive)
                    if (data.text.toLowerCase().startsWith(params.term.toLowerCase())) {
                        return data;
                    }

                    // Otherwise, return null (don't show the result)
                    return null;
                }
            });

            $('#select2').on('change', function(e) {

                var data = $('#select2').select2("val");

                @this.set('location', data);

            });


        });
    </script>
    <script>
        document.addEventListener('livewire:init', () => {

            function initializeSelect2() {
                $('#select22').select2({
                    matcher: function(params, data) {
                        // If there is no search term, return all data
                        if ($.trim(params.term) === '') {
                            return data;
                        }

                        // Check if the text starts with the typed term (case insensitive)
                        if (data.text.toLowerCase().startsWith(params.term.toLowerCase())) {
                            return data;
                        }

                        // Otherwise, return null (don't show the result)
                        return null;
                    }
                });

                // Dispatch Livewire event on change
                $('#select22').on('change', function() {
                    const selectedValue = $(this).val();

                    @this.set('breedId', selectedValue);
                });
            }

            initializeSelect2();

            Livewire.hook('morphed', ({
                el,
                component
            }) => {
                // Runs after all child elements in `component` are morphed
                // console.log($('#select22').html());
                initializeSelect2();


            })
        });
    </script>
    <script>
        $(document).ready(function() {
            let targetHref = '';

            $('.openSafetyModal').on('click', function() {
                targetHref = $(this).data('href');
                $('#safetyModal').css('display', 'flex');
            });
            $('#proceedBtn').on('click', function() {
                if (targetHref) {
                    window.location.href = targetHref;
                }
            });
            $('#closeModalBtn, #cancelModalBtn').on('click', function() {
                $('#safetyModal').hide();
            });
        });
    </script>
@endpush
