<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('role_list_access');
        $roles = Role::all();
        return view('backend.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('role_permission_create');
        $modules = Module::all();
        return view('backend.roles.form', compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('role_permission_create');

        // $this->validate($request, [
        //     'name' => 'required|unique:roles',
        //     'permissions' => 'required|array',
        //     'permissions.*' => 'integer',
        // ]);

        // return $request->all();
        $slug = Str::slug($request->name);
        $checkStoreRole = Role::where('slug', $slug)->first();
        if ($checkStoreRole != null) {
            return redirect()->route('roles.index')->with('error', 'Your Already define this role');
        } else {
            Role::create([
                'name' => $request->name,
                'slug' => $slug,
                'store_id' => Auth::user()->store,
            ])->permissions()->sync($request->input('permissions', []));

            return redirect()->route('admin.roles.index')->with('success', 'Role Successfully Added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {

        Gate::authorize('role_permission_edit');
        $modules = Module::all();
        return view('backend.roles.form', compact('role', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        Gate::authorize('role_permission_edit');

        //        $this->validate($request, [
        //            'name' => 'required|unique:roles',
        //            'permissions'=>'required|array',
        //            'permissions.*'=>'integer',
        //        ]);
        $role->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('admin.roles.index')->with('success', 'Role Successfully Updated');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {


        Gate::authorize('role_permission_delete');

        $user = User::where('role_id', $role->id)->first();


        if ($user == null) {
            if ($role->deletable) {
                $role->delete();

                return back()->with('success', 'Role Successfully Deleted');
            } else {

                return back()->with('error', 'You can\'t delete system role');
            }
        } else {


            return back()->with('error', 'This user role can not be deleted');
        }
        return back();
    }


    public function per()
    {


        // Gate::authorize('hr_admin_dashboard_');

        // $user = User::find(1);
        // $user->role;
        // return $user;

        // $moduleAppDashboard = Module::updateOrCreate(['name' => 'User Setup']);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'User List Access',
        //     'slug' => 'user_list_access',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'User Create',
        //     'slug' => 'user_create',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'User Edit',
        //     'slug' => 'user_edit',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'User Delete',
        //     'slug' => 'user_delete',
        // ]);


        // $moduleAppDashboard = Module::updateOrCreate(['name' => 'Role Permission']);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Role List Access',
        //     'slug' => 'role_list_access',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Role & Permission Create',
        //     'slug' => 'role_permission_create',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Role & Permission Edit',
        //     'slug' => 'role_permission_edit',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Role & Permission Delete',
        //     'slug' => 'role_permission_delete',
        // ]);

        // $moduleAppDashboard = Module::updateOrCreate(['name' => 'Dashboard']);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Dashboard',
        //     'slug' => 'dashboard_access',
        // ]);




        // $moduleAppDashboard = Module::updateOrCreate(['name' => 'Category Panel']);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'category List Access',
        //     'slug' => 'category_access',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'category Create',
        //     'slug' => 'category_create',
        // ]);
        // Permission::updateOrCreate([ 
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'category View',
        //     'slug' => 'category_view',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'category Edit',
        //     'slug' => 'category_edit',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'category Destroy',
        //     'slug' => 'category_delete',
        // ]);

        // $moduleAppDashboard = Module::updateOrCreate(['name' => 'Breed Panel']);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Subcategory List Access',
        //     'slug' => 'subcategory_access',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Subcategory Create',
        //     'slug' => 'subcategory_create',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Subcategory View',
        //     'slug' => 'subcategory_view',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Subcategory Edit',
        //     'slug' => 'subcategory_edit',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Subcategory Destroy',
        //     'slug' => 'subcategory_delete',
        // ]);


        // $moduleAppDashboard = Module::updateOrCreate(['name' => 'Pet Listing Panel']);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Pet List Access',
        //     'slug' => 'pet_access',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Pet Create',
        //     'slug' => 'pet_create',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Pet View',
        //     'slug' => 'pet_view',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Pet Edit',
        //     'slug' => 'pet_edit',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Pet Destroy',
        //     'slug' => 'pet_delete',
        // ]);



        // $moduleAppDashboard = Module::updateOrCreate(['name' => 'Customer Panel']);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Customer List Access',
        //     'slug' => 'customer_access',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Customer Create',
        //     'slug' => 'customer_create',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Customer View',
        //     'slug' => 'customer_view',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Customer Edit',
        //     'slug' => 'customer_edit',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Customer Destroy',
        //     'slug' => 'customer_delete',
        // ]);

        // $moduleAppDashboard = Module::updateOrCreate(['name' => 'Subscription Plan Panel']);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Subscription Plan List Access',
        //     'slug' => 'subscription_plan_access',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Subscription Plan Create',
        //     'slug' => 'subscription_plan_create',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Subscription Plan View',
        //     'slug' => 'subscription_plan_view',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Subscription Plan Edit',
        //     'slug' => 'subscription_plan_edit',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Subscription Plan Destroy',
        //     'slug' => 'subscription_plan_delete',
        // ]);

        // $moduleAppDashboard = Module::updateOrCreate(['name' => 'Subscriber Panel']);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Subscriber List Access',
        //     'slug' => 'subscriber_access',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Subscriber Create',
        //     'slug' => 'subscriber_create',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Subscriber View',
        //     'slug' => 'subscriber_view',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Subscriber Edit',
        //     'slug' => 'subscriber_edit',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Subscriber Destroy',
        //     'slug' => 'subscriber_delete',
        // ]);


        // $moduleAppDashboard = Module::updateOrCreate(['name' => 'Chat Panel']);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Chat List Access',
        //     'slug' => 'chat_list_access',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Chat Conversation view',
        //     'slug' => 'chat_conversation_view',
        // ]);


        // $moduleAppDashboard = Module::updateOrCreate(['name' => 'Setting Panel']);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Setting Access',
        //     'slug' => 'setting_access',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'General Settings',
        //     'slug' => 'setting_view',
        // ]);


        // $moduleAppDashboard = Module::updateOrCreate(['name' => 'Banner Panel']);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Banner List Access',
        //     'slug' => 'banner_access',
        // ]);
        // Permission::updateOrCreate([ 
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Banner Create',
        //     'slug' => 'banner_create',
        // ]);

        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Banner Edit',
        //     'slug' => 'banner_edit',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Banner Destroy',
        //     'slug' => 'banner_delete',
        // ]);

        // $moduleAppDashboard = Module::updateOrCreate(['name' => 'Page Panel']);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Page List Access',
        //     'slug' => 'page_access',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Page Create',
        //     'slug' => 'page_create',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Page View',
        //     'slug' => 'page_view',
        // ]);

        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Page Edit',
        //     'slug' => 'page_edit',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Page Destroy',
        //     'slug' => 'page_delete',
        // ]);


        // $moduleAppDashboard = Module::updateOrCreate(['name' => 'Scam List Panel']);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Scam List Access',
        //     'slug' => 'scam_access',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Scam Create',
        //     'slug' => 'scam_create',
        // ]);

        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Scam Edit',
        //     'slug' => 'scam_edit',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Scam Destroy',
        //     'slug' => 'scam_delete',
        // ]);

        // $moduleAppDashboard = Module::updateOrCreate(['name' => 'Check List Panel']);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Check List Access',
        //     'slug' => 'checklist_access',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Checklist Create',
        //     'slug' => 'checklist_create',
        // ]);

        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Checklist Edit',
        //     'slug' => 'checklist_edit',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Checklist Destroy',
        //     'slug' => 'checklist_delete',
        // ]);

        // $moduleAppDashboard = Module::updateOrCreate(['name' => 'Faq Panel']);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Faq List Access',
        //     'slug' => 'faq_access',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Faq Create',
        //     'slug' => 'faq_create',
        // ]);

        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Faq Edit',
        //     'slug' => 'faq_edit',
        // ]);
        // Permission::updateOrCreate([
        //     'module_id' => $moduleAppDashboard->id,
        //     'name' => 'Faq Destroy',
        //     'slug' => 'faq_delete',
        // ]);


    // $moduleAppDashboard = Module::updateOrCreate(['name' => 'Cities Panel']);
    //     Permission::updateOrCreate([
    //         'module_id' => $moduleAppDashboard->id,
    //         'name' => 'City List Access',
    //         'slug' => 'city_access',
    //     ]);
    //     Permission::updateOrCreate([
    //         'module_id' => $moduleAppDashboard->id,
    //         'name' => 'City Create',
    //         'slug' => 'city_create',
    //     ]);

    //     Permission::updateOrCreate([
    //         'module_id' => $moduleAppDashboard->id,
    //         'name' => 'City Edit',
    //         'slug' => 'city_edit',
    //     ]);
    //     Permission::updateOrCreate([
    //         'module_id' => $moduleAppDashboard->id,
    //         'name' => 'City Destroy',
    //         'slug' => 'city_delete',
    //     ]);






        return $moduleAppDashboard;
    }
}
