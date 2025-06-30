<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Models\Banner;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Gate;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        Gate::authorize('banner_access');
        $banners = Banner::all();
        return view('backend.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('banner_create');
        $categories = Category::where('status', 1)->get();
        return view('backend.banners.form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBannerRequest $request)
    {
        Gate::authorize('banner_create');
        $store = Banner::create($request->validated() + ['user_id' => Auth::user()->id]);
        $manager = new ImageManager(new Driver());

        if ($request->hasFile('banner')) {
            $photo_upload = $request->file('banner');
            $imageName = time() . '.webp';

            $image = $manager->read($photo_upload);
            $image->resize(400, 400)
                ->toWebp()
                ->save(public_path('images/' . $imageName));

            Banner::find($store->id)->update([
                'banner' => $imageName
            ]);
        }

        // if ($request->hasfile('banner')) {

        //     $photo_upload = $request->banner;
        //     $imageName = time() . '.' . $photo_upload->getClientOriginalExtension();
        //     $image = $manager->read($request->file('banner'));
        //     $image->toWebp(350, 350)->save(public_path('images/' . $imageName));

        //     Banner::find($store->id)->update([
        //         'banner' => $imageName
        //     ]);
        // }
        return to_route('admin.banners.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        Gate::authorize('banner_edit');
        $categories = Category::where('status', 1)->get();
        return view('backend.banners.form', compact('categories', 'banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        Gate::authorize('banner_edit');
        $manager = new ImageManager(new Driver());
        $banner->update($request->validated() + ['user_id' => Auth::user()->id]);

        if ($request->hasFile('banner')) {
            $deleteoldphoto = $banner->banner;
            if ($deleteoldphoto) {
                $path = ('images/backend/') . $deleteoldphoto;
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            $photo_upload = $request->file('banner');
            $imageName = time() . '.webp';

            $image = $manager->read($photo_upload);
            $image->resize(400, 400)
                ->toWebp()
                ->save(public_path('images/' . $imageName));

            $banner->update([
                'banner' => $imageName
            ]);
        }



        return to_route('admin.banners.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        Gate::authorize('banner_delete');
        $image = $banner->banner;

        if ($image) {
            $path = ('images/backend/') . $image;
            if (file_exists($path)) {
                unlink($path);
            }
        }
        $banner->delete();
        return back();
    }
}
