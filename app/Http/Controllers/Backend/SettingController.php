<?php

namespace App\Http\Controllers\Backend;

use Image;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Drivers\Gd\Driver;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        Gate::authorize('setting_access');
        $setting = Setting::where('id', 1)->first();
        return view('backend.settings.index', compact('setting'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {

        Gate::authorize('setting_view');
        $this->validate($request, [

            'site_name' => 'string|nullable',

            'copyright' => 'string|nullable',
            'slogan' => 'string|nullable',
            'meta_description' => 'string|nullable',
            'meta_keywords' => 'string|nullable',
            'about_site' => 'string|nullable',
            'facebook' => 'string|nullable',
            'google' => 'string|nullable',
            'google_plus' => 'string|nullable',
            'twiter' => 'string|nullable',
            'contact' => 'string|nullable',
            'email' => 'string|nullable',
            'address' => 'string|nullable',

        ]);

        $setting = Setting::where('id', 1)->update([
            'site_name' => $request->site_name,
            'copyright' => $request->copyright,
            'slogan' => $request->slogan,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'about_site' => $request->about_site,
            'facebook' => $request->facebook,
            'google' => $request->google,
            'google_plus' => $request->google_plus,
            'twiter' => $request->twiter,
            'youtube' => $request->youtube,
            'instagram' => $request->instagram,
            'contact' => $request->contact,
            'email' => $request->email,
            'webmail' => $request->webmail,
            'address' => $request->address,
        ]);


        flash('User Successfully Updated.');
        return redirect()->route('admin.settings.index');
    }

    public function sitelogo(Request $request)
    {
        Gate::authorize('setting_access');
        $manager = new ImageManager(new Driver());

        if ($request->hasfile('site_logo')) {

            $sitelogo = Setting::find(1);
            $deleteoldphoto = Setting::find($sitelogo->site_logo);
            if ($deleteoldphoto) {
                $path = public_path('images/') . $deleteoldphoto;
                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }

        if ($request->hasFile('site_logo')) {
            $photo_upload = $request->file('site_logo');
            $imageName = time() . '.webp';

            $image = $manager->read($photo_upload);
            $image->toWebp()
                ->save(public_path('images/' . $imageName));

            $setting = Setting::find(1);

            $setting->update([
                'site_logo' => $imageName

            ]);
        }
        flash('User Successfully Updated.');

        return redirect()->route('admin.settings.index');
    }
}
