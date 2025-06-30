<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PetReport;
use App\Models\Pet;
use App\Models\PetImage;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        Gate::authorize('page_access');
        $pets = PetReport::latest()->get();
        return view('backend.reports.index', compact('pets'));
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
    public function destroy(Request $request )
    {
        
    
        Gate::authorize('pet_delete');
        $report = PetReport::where('pet_id',$request->pet_id)->first();
        $pet = Pet::where('id',$request->pet_id)->first();
        
        $images = PetImage::where('pet_id', $request->pet_id)->get();
        
        foreach ($images as $oldi) {
            $path = public_path('images/') . $oldi->image;
            if (file_exists($path)) {
                unlink($path);
            }
            $oldi->delete();
        }

      
        $pet->delete();
        $report->delete();
        flash('Pet Listing Successfully Deleted.');

        return redirect()->route('admin.reports.index');
    }
}
