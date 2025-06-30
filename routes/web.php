<?php

use App\Livewire\Base;
use App\Livewire\Chat;
use App\Livewire\About;
use App\Livewire\Login;
use App\Livewire\Sport;
use App\Livewire\Error;
use App\Livewire\Filter;
use App\Livewire\Search;
use App\Livewire\Billing;
use App\Livewire\Profile;
use App\Livewire\Setting;
use App\Livewire\Activity;
use App\Livewire\Discover;
use App\Livewire\Frontend;
use App\Livewire\Interest;
use App\Livewire\Register;
use App\Livewire\Dashboard;
use App\Livewire\MyListing;
use App\Livewire\LookingFor;
use App\Livewire\PetListing;
use App\Livewire\EditProfile;
use App\Livewire\Subscription;
use App\Livewire\FrontendMatch;
use App\Livewire\PaymentMethod;
use App\Livewire\RemoveProfile;
use App\Livewire\BlockedProfile;
use App\Livewire\PushNotification;
use App\Livewire\SubscriptionPlan;
use App\Livewire\EmailNotification;
use App\Livewire\ProfileVisibility;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Livewire\AddPetListing;
use App\Livewire\Detail;
use App\Livewire\OwnerProfile;
use App\Livewire\Advertise;
use App\Livewire\EditPetListing;
use App\Livewire\SingleChat;
use App\Livewire\SocialLink;
use App\Livewire\FilterOwner;
use App\Livewire\LookingForRegister;
use App\Http\Controllers\CommonController;
use App\Livewire\AboutUs;
use App\Livewire\Chat2;
use App\Livewire\ContactUs;
use App\Livewire\Faq;
use App\Livewire\Page;
use App\Livewire\PrivacyPolicy;
use App\Livewire\TermsCondition;
use App\Livewire\Favourite;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


Route::fallback(function () {
    return view('errors.404')->with('message', 'Page Not Found');
});

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');



Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $r) {
    $r->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $r) {

    $r->user()->sendEmailVerificationNotification();

    return back()->with('resent', 'Verification link sent ');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');



Route::middleware(['VisitorCount'])->group(function () {
    Route::get('/', Frontend::class)->name('f.index');
    Route::get('/frontend/login', Login::class)->name('f.login');
    Route::get('/frontend/register', Register::class)->name('f.register');
  
    Route::get('/advertise', Advertise::class)->name('f.advert');
    Route::get('/error', Error::class)->name('f.aboutus');
    Route::get('/aboutUs', AboutUs::class)->name('f.aboutus');
    Route::get('/contactUs', ContactUs::class)->name('f.contactus');
    Route::get('/faq', Faq::class)->name('f.faq');
    Route::get('/privacy-policy', PrivacyPolicy::class)->name('f.privacy');
    Route::get('/terms-condition', TermsCondition::class)->name('f.terms');
    Route::get('/page/{slug}', Page::class)->name('f.page');
    Route::get('/detail/{slug}', Detail::class)->name('f.detail');
    Route::get('/users/advert/{id}', FilterOwner::class)->name('f.owner.all');
    // Route::get('/{any}', Error::class)
    // ->where('any', '.*');
});


// Route::middleware(['user', 'verified'])->group(function () {
Route::middleware(['user'])->group(function () {
      Route::get('/filter', Filter::class)->name('f.filter');
    
    Route::get('/pet/listing', PetListing::class)->name('f.petlisting');
    Route::get('/pet/listing/add', AddPetListing::class)->name('f.petlisting.add');
    Route::get('/pet/listing/edit/{id}', EditPetListing::class)->name('f.petlisting.edit');
    Route::get('/dashboard', Dashboard::class)->name('f.dashboard');
    Route::get('/discover', Discover::class)->name('f.discover');
    Route::get('/match', FrontendMatch::class)->name('f.match');
    Route::get('/favourite', Favourite::class)->name('f.favourite');
    Route::get('/search', Search::class)->name('f.search');
    Route::get('/owner/profile/{id}', OwnerProfile::class)->name('f.ownerprofile');
    Route::get('/subscription/plan', SubscriptionPlan::class)->name('f.subscription');
    Route::get('/subscription/plan/stripe/{slug}', SubscriptionPlan::class)->name('stripe.subscription');

    Route::get('/chat/user/{userId}', SingleChat::class)->name('f.single.chat');
    Route::get('/chat', Chat::class)->name('f.chat');
    Route::get('/chat2', Chat2::class)->name('f.chat2');
    Route::get('/activity', Activity::class)->name('f.activity');
    Route::get('/profile', Profile::class)->name('f.profile');
    Route::get('/edit/profile', EditProfile::class)->name('f.edit.profile');
    Route::get('/setting', Setting::class)->name('f.setting');
    Route::get('/setting/about', About::class)->name('f.about');
    Route::get('/setting/base', Base::class)->name('f.base');
    Route::get('/setting/interest/hobbies', Interest::class)->name('f.interest');
    Route::get('/setting/sport', Sport::class)->name('f.sport');
    Route::get('/setting/looking-for', LookingFor::class)->name('f.lookingfor');
    Route::get('/setting/adopt-a-pet', LookingForRegister::class)->name('f.lookingforRegister');
    Route::get('/setting/billing', Billing::class)->name('f.billing');
    Route::get('/setting/subscription', Subscription::class)->name('f.subscription');
    Route::get('/setting/payment/method', PaymentMethod::class)->name('f.payment.method');
    Route::get('/setting/my/listing', MyListing::class)->name('f.my.listing');
    Route::get('/setting/visibility/status', ProfileVisibility::class)->name('f.visibility.status');
    Route::get('/setting/blocked/profile', BlockedProfile::class)->name('f.blocked.profile');
    Route::get('/setting/remove/profile', RemoveProfile::class)->name('f.remove.profile');
    Route::get('/setting/email/notification', EmailNotification::class)->name('f.email.notify');
    Route::get('/setting/push/notification', PushNotification::class)->name('f.push.notify');
    Route::get('/setting/social/link', SocialLink::class)->name('f.social');
    Route::post('checkout', [PaymentController::class, 'Checkout'])->name('checkout');
    Route::get('stripe/success', [PaymentController::class, 'successStripe'])->name('stripe.success');
    Route::get('stripe/cancel', [PaymentController::class, 'cancelStripe'])->name('stripe.cancel');
    Route::get('paypal/payment/success', [PaymentController::class, 'paymentSuccessPaypal'])->name('paypal.payment.success');
    Route::get('paypal/payment/cancel', [PaymentController::class, 'stripePaymentCancel'])->name('paypal.payment.cancel');
});




Route::get('/foo', function () {
    Artisan::call('storage:link');
});





Route::get('/login', function () {
    return view('backend.master');
});

Auth::routes();


Route::get('/cache', function () {


    Artisan::call('storage:link');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    // Artisan::call('optimize');
    return  'Cache is cleared.';
});

Route::get('/run-storage-link', function () {
    \Artisan::call('storage:link');
    return "Storage link created successfully!";
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/auth/{provider}/redirect', [SocialLoginController::class, 'redirect'])->name('social.redirect');
Route::get('/auth/{provider}/callback', [SocialLoginController::class, 'callback'])->name('social.callback');


Route::get('logout', function () {

    Auth::logout();
    return redirect('login');
})->name('logout');
Route::get('frontend/logout', function () {

    Auth::logout();
    return redirect('/');
})->name('f.logout');

Route::get('/get-subcategory', [CommonController::class, 'getSubcategoryFromAjax']);
