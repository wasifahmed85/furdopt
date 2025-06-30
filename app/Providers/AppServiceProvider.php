<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\Category;
use App\Models\Chatmessage;
use App\Models\Page;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $setting = Setting::where('id', 1)->first();
        $categories = Category::where('status', 1)->get(['id', 'slug', 'name']);
        $headermenus = Page::where('header_menu', 1)->orderBy('serial', 'ASC')->where('status', 1)->get(['id', 'slug', 'name']);
        $footermenus = Page::where('footer_menu', 1)->orderBy('serial', 'ASC')->where('status', 1)->get(['id', 'slug', 'name']);
        $terms = Page::select(['id', 'name', 'slug'])->where('terms_status', 1)->where('status', 1)->latest()->take(1)->first();
        $privacy = Page::select(['id', 'name', 'slug'])->where('privacy_status', 1)->where('status', 1)->latest()->take(1)->first();
        $cookie = Page::select(['id', 'name', 'slug'])->where('cookie_status', 1)->where('status', 1)->latest()->take(1)->first();



        \View::share('setting', $setting);
        \View::share('categories', $categories);
        \View::share('headermenus', $headermenus);
        \View::share('footermenus', $footermenus);
        \View::share('terms', $terms);
        \View::share('privacy', $privacy);
        \View::share('cookie', $cookie);
    }
}
