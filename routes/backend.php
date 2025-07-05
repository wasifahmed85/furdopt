<?php

use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChatController;
use App\Http\Controllers\Backend\ChecklistController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\DashboardControler;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\PetController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\PromotionController;
use App\Http\Controllers\Backend\ScamController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SubscriptionController;
use App\Http\Controllers\Backend\SubscriptionPlanController;
use App\Http\Controllers\Backend\NewsLetterSubscriptionController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\MessageController;
use App\Http\Controllers\Backend\CityController;
use App\Http\Controllers\Backend\PromotePetsController;
use App\Models\Payment;
use Illuminate\Support\Facades\Route;




Route::get('dashboard', [DashboardControler::class, 'index'])->name('dashboard');
Route::post('logoupdate', [SettingController::class, 'sitelogo'])->name('logoupdate');
Route::resource('users', UserController::class);
Route::resource('settings', SettingController::class);
Route::resource('messages', MessageController::class);
Route::post('customer/status/change', [CustomerController::class, 'verifyStatusChange'])->name('customer.statuschange');
Route::post('pet/status/change', [PetController::class, 'publishedStatusChange'])->name('pet.statuschange');
Route::resource('customers', CustomerController::class);
Route::resource('categories', CategoryController::class);
Route::resource('subCategories', SubCategoryController::class);
Route::resource('subscriptionPlans', SubscriptionPlanController::class);
Route::get('promote-pets', [PromotePetsController::class, 'index'])->name('promote-pets.index');
Route::resource('subscriptions', SubscriptionController::class);
Route::resource('pages', PageController::class);
Route::get('pet/delete/image/{id}', [PetController::class, 'imageDelete'])->name('image.delete');
Route::resource('pets', PetController::class);
Route::resource('banners', BannerController::class);
Route::resource('scams', ScamController::class);
Route::resource('checklists', ChecklistController::class);
Route::resource('promotions', PromotionController::class);
Route::resource('faqs', FaqController::class);
Route::resource('reports', ReportController::class);
Route::resource('cities', CityController::class);

// routes/web.php (inside the admin group)

// routes/web.php
Route::post('/admin/pets/featured-change', [PetController::class, 'featuredChange'])
    ->name('pet.featuredchange');


Route::post('pets/reorder', [PetController::class, 'reorder'])->name('pets.reorder');


Route::get('ro', [RoleController::class, 'per']);
Route::resource('roles', RoleController::class);

Route::get('newsletter/subscriptions', [NewsLetterSubscriptionController::class, 'index'])->name('newsletters.index');
// Profile
Route::get('profile/', [ProfileController::class, 'index'])->name('profile.index');
Route::post('profile/', [ProfileController::class, 'update'])->name('profile.update');

// Security
Route::get('chat', [ChatController::class, 'chat'])->name('chat');
Route::get('chat/conversetion', [ChatController::class, 'index'])->name('chat.index');
Route::get('chat/details/{user1}/{user2}', [ChatController::class, 'viewConversation'])->name('chat.details');
Route::get('profile/security', [ProfileController::class, 'changePassword'])->name('profile.password.change');
Route::post('profile/security', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
