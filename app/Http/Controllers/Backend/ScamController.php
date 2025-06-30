<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreScamRequest;
use App\Http\Requests\UpdateScamRequest;
use App\Models\Category;
use App\Models\Scam;
use Illuminate\Support\Facades\Gate;

class ScamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        Gate::authorize('scam_access');
        $scams = Scam::all();
        return view('backend.scams.index', compact('scams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('scam_create');
        $categories = Category::all();
        return view('backend.scams.form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreScamRequest $request)
    {
        Gate::authorize('scam_create');
        $store = Scam::create($request->validated());
        flash('Avoid Scam Created Successfully.');
        return to_route('admin.scams.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Scam $scam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Scam $scam)
    {
        Gate::authorize('scam_edit');
        $categories = Category::all();
        return view('backend.scams.form', compact('categories', 'scam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateScamRequest $request, Scam $scam)
    {
        Gate::authorize('scam_edit');
        $scam->update($request->validated());
        flash('Avoid Scam Updated Successfully.');
        return to_route('admin.scams.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Scam $scam)
    {
        Gate::authorize('scam_delete');
        $scam->delete();
        flash('Avoid Scam Deleted Successfully.');
        return to_route('admin.scams.index');
    }
}
