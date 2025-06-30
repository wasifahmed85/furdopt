<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChecklistRequest;
use App\Http\Requests\UpdateChecklistRequest;
use App\Models\Category;
use App\Models\Checklist;
use Illuminate\Support\Facades\Gate;

class ChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        Gate::authorize('checklist_access');
        $checklists = Checklist::latest()->get();
        return view('backend.checklists.index', compact('checklists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('checklist_create');
        $categories = Category::all();
        return view('backend.checklists.form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChecklistRequest $request)
    {
        Gate::authorize('checklist_create');
        $store = Checklist::create($request->validated());
        flash('Checklist Created Successfully.');
        return to_route('admin.checklists.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Checklist $checklist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Checklist $checklist)
    {
        Gate::authorize('checklist_edit');
        $categories = Category::all();
        return view('backend.checklists.form', compact('categories', 'checklist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChecklistRequest $request, Checklist $checklist)
    {
        Gate::authorize('checklist_edit');
        $checklist->update($request->validated());
        flash('Checklist Updated Successfully.');
        return to_route('admin.checklists.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Checklist $checklist)
    {
        Gate::authorize('checklist_delete');
        $checklist->delete();
        flash('Checklist Deleted Successfully.');
        return to_route('admin.checklists.index');
    }
}
