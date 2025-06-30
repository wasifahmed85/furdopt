<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

use App\Models\UkState;
use App\Models\User;
use App\Models\UserDetail;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {


        $cities = UkState::all();
        return view('backend.profile.index',compact('cities'));
    }

    public function update(Request $request)
    {

        if ($request->user_info == "user_info") {
            $user = Auth::user();
            $user->update([
                'name' => $request->user_name,
                'uk_state_id' => $request->cityId,
            ]);
            $userD = UserDetail::where('user_id', Auth::user()->id)->first();
            if($userD)
            {
                $userD->update(['bio'=>$request->bio]); 
            }else{
                UserDetail::create(['user_id'=> Auth::user()->id,'bio'=>$request->bio]);
            }
           
            
            flash('Profile Name Successfully Updated.');
            return redirect()->back();
        } else {


            $manager = new ImageManager(new Driver());


            if ($request->hasfile('avatar')) {
                $user = Auth::user();
                $deleteoldphoto = User::find(Auth::user()->id)->avatar;
                if ($deleteoldphoto) {
                    $path = public_path('images/') . $deleteoldphoto;
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
            }
            if ($request->hasFile('avatar')) {
                $photo_upload = $request->file('avatar');
                $imageName = time() . '.webp';

                // $image = $manager->read($photo_upload);
                // $image->resize(400, 400)
                //     ->toWebp()
                //     ->save(public_path('images/' . $imageName));

                    $image = $manager->read($photo_upload->getRealPath())
                        ->cover(870, 493) // Resize & crop to 600x600
                        ->toWebp(90); // Convert to WebP with 90% quality

                    Storage::disk('public')->put('images/' . $imageName, (string) $image);

                $user = Auth::user();

                $user->update([
                    'avatar' => $imageName
                ]);


            }

            flash('Profile Avatar Successfully Updated.');
            return back();
        }
    }
    public function changePassword()
    {

        return view('backend.profile.security');
    }

    //    public function updatePassword(UpdatePasswordRequest $request)
    public function updatePassword(Request $request)
    {
        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->current_password, $hashedPassword)) {
            if (!Hash::check($request->password, $hashedPassword)) {
                Auth::user()->update([
                    'password' => Hash::make($request->password)
                ]);
                Auth::logout();
                flash('Password Successfully Updated.');
                return redirect()->route('login');
            } else {
                flash('New password cannot be the same as old password.');
            }
        } else {
            flash('Current password not match.');
        }
        return redirect()->back();
    }
}
