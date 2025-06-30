<?php

namespace App\Http\Controllers\Backend;

use Image;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('user_list_access');
        $users = User::with('role')->where('role_id', '!=', 9)->get();



        return view('backend.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('user_create');
        $roles = Role::all();

        return view('backend.users.form', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Gate::authorize('user_edit');
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email|unique:users',
            'role_id' => 'required',
            'password' => 'required|confirmed|string|min:8',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);
        $username = $this->generateUniqueUsername($request->email);
        $user = User::create([
            'role_id' => $request->role_id,
            'role' => 'admin',
            'name' => $request->name,
            'username' => $username,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);
        $manager = new ImageManager(new Driver());

        if ($request->hasFile('avatar')) {
            $photo_upload = $request->file('avatar');
            $imageName = time() . '.webp';

            $image = $manager->read($photo_upload);
            $image->resize(400, 400)
                ->toWebp()
                ->save(public_path('images/' . $imageName));

            User::find($user->id)->update([
                'avatar' => $imageName
            ]);
        }
        flash('User Successfully Added.');

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        Gate::authorize('user_list_access');

        return view('backend.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        Gate::authorize('user_edit');
        $roles = Role::all();
        return view('backend.users.form', compact('user', 'roles'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        Gate::authorize('user_edit');
        $manager = new ImageManager(new Driver());
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email|unique:users,email,' . $user->id,
            'role_id' => 'required',
            'password' => 'nullable|confirmed|string|min:8',
            'avatar' => 'nullable|image'
        ]);

        $user->update([
            'role_id' => $request->role_id,
            // 'role' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'password' => isset($request->password) ? Hash::make($request->password) : $user->password,
            'status' => $request->filled('status'),
        ]);


        // upload images

        if ($request->hasfile('avatar')) {

            $deleteoldphoto = $user->avatar;
            if ($deleteoldphoto) {
                $path = public_path('images/backend/') . $deleteoldphoto;
                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }

        if ($request->hasFile('avatar')) {
            $photo_upload = $request->file('avatar');
            $imageName = time() . '.webp';

            $image = $manager->read($photo_upload);
            $image->resize(400, 400)
                ->toWebp()
                ->save(public_path('images/' . $imageName));

            User::find($user->id)->update([
                'avatar' => $imageName
            ]);
        }
        flash('User Successfully Updated.');
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Gate::authorize('user_delete');
        if ($user->avatar) {
            $path = public_path('images/backend/') . $user->avatar;
            if (file_exists($path)) {
                unlink($path);
            }
        }
        $user->delete();
        flash('User Successfully Deleted.');
        return back();
    }


    protected function generateUniqueUsername($email)
    {
        $baseUsername = Str::before($email, '@');
        $username = $baseUsername;
        $counter = 1;

        while (User::where('username', $username)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }

        return $username;
    }
}
