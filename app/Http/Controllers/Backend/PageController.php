<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        Gate::authorize('page_access');
        $pages = Page::latest()->get();
        return view('backend.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('page_create');
        return view('backend.pages.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePageRequest $request)
    {
        Gate::authorize('page_create');
        $store = Page::create($request->validated());

        flash('Page Created Successfully.');
        return to_route('admin.pages.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        Gate::authorize('page_view');
        return view('backend.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        Gate::authorize('page_edit');
        return view('backend.pages.form', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        Gate::authorize('page_edit');
        $page->update($request->validated());
        flash('Page Updated Successfully.');
        return to_route('admin.pages.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        Gate::authorize('page_delete');
        $page->delete();
        flash('Pade Deleted Successfully.');
        return to_route('admin.page.index');
    }
}
