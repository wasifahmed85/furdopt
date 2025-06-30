<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Support\Facades\Gate;

use App\Http\Requests\StoreFaqRequest;
use App\Http\Requests\UpdateFaqRequest;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        Gate::authorize('faq_access');
        $faqs = Faq::all();
        return view('backend.faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('faq_create');
        return view('backend.faqs.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFaqRequest $request)
    {
        Gate::authorize('faq_create');
        $store = Faq::create($request->validated());
        flash('Faw Created Successfully.');
        return to_route('admin.faqs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faq $faq)
    {
        Gate::authorize('faq_edit');
        return view('backend.faqs.form', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFaqRequest $request, Faq $faq)
    {
        Gate::authorize('faq_edit');
        $faq->update($request->validated());
        flash('Faq Updated Successfully.');
        return to_route('admin.faqs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq)
    {
        Gate::authorize('faq_delete');
        $faq->delete();
        flash('Faq Deleted Successfully.');
        return to_route('admin.faqs.index');
    }
}
