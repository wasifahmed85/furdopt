<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\SubCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubCategoryRequest1;
use App\Http\Requests\UpdateSubCategoryRequest;
use Illuminate\Support\Facades\Gate;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('subcategory_access');
        $subcategories = SubCategory::with('category')->latest()->get();

        return view('backend.subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('subcategory_create');
        $categories = Category::where('status', 1)->get(['id', 'name']);
        return view('backend.subcategories.form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubCategoryRequest1 $request)
    {
        Gate::authorize('subcategory_create');
        // $store = SubCategory::create($request->validated());
        $check = SubCategory::where('category_id', $request->category_id)
            ->where('name', $request->name)
            ->exists();

        if ($check) {
            flash('This Category Already Has This Breed.');
            return back();
        } else {
            $store = SubCategory::create($request->validated());
        }
        flash('Sub Category Created Successfully.');
        return to_route('admin.subCategories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        Gate::authorize('subcategory_edit');
        $categories = Category::where('status', 1)->get(['id', 'name']);
        return view('backend.subcategories.form', compact('categories', 'subCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubCategoryRequest $request, SubCategory $subCategory)
    {
        Gate::authorize('subcategory_edit');
        // $subCategory->update($request->validated());
        // flash('Sub Category Updated Successfully.');
        $check = SubCategory::where('category_id', $request->category_id)
            ->where('name', $request->name)
            ->where('id', '!=', $subCategory->id) // Exclude the current subcategory
            ->exists();

        if ($check) {
            flash('This Category Already Has This Breed.');
            return back();
        } else {
            $subCategory->update($request->validated());
            flash('Breed Updated Successfully.');
            return back();
        }
        return to_route('admin.subCategories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        Gate::authorize('subcategory_delete');
        $subCategory->delete();
        flash('Sub Category Deleted Successfully.');
        return to_route('admin.subCategories.index');
    }
}
