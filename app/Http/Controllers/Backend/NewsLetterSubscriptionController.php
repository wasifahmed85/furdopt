<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscription;
use Illuminate\Http\Request;

class NewsLetterSubscriptionController extends Controller
{
    public function index()
    {
        $newses = NewsletterSubscription::all();
        return view('backend.newsletters.index', compact('newses'));
    }

}
