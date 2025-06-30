<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('category_access');
        $categories = Category::all();

        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('category_create');
        return view('backend.categories.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        Gate::authorize('category_create');
        $store = Category::create($request->validated());

        $manager = new ImageManager(new Driver());

        if ($request->hasFile('image')) {
            $photo_upload = $request->file('image');
            $imageName = time() . '.webp';

            $image = $manager->read($photo_upload);
            $image->resize(60, 60)
                ->toWebp()
                ->save(public_path('images/' . $imageName));

            Category::find($store->id)->update([
                'image' => $imageName
            ]);
        }
        flash('Category Created Successfully.');
        return to_route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        Gate::authorize('category_edit');
        return view('backend.categories.form', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        Gate::authorize('category_edit');
        $manager = new ImageManager(new Driver());
        $category->update($request->validated());
        if ($request->hasFile('image')) {
            $deleteoldphoto = $category->image;
            if ($deleteoldphoto) {
                $path = ('images/') . $deleteoldphoto;
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            $photo_upload = $request->file('image');
            $imageName = time() . '.webp';

            $image = $manager->read($photo_upload);
            $image->resize(60, 60)
                ->toWebp()
                ->save(public_path('images/' . $imageName));

            $category->update([
                'image' => $imageName
            ]);
        }
        flash('Category Updated Successfully.');
        return to_route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Gate::authorize('category_delete');
        $category->delete();
        flash('Category Deleted Successfully.');
        return to_route('admin.categories.index');
    }
}
