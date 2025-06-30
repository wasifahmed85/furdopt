<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\EmailNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Mail;
use App\Mail\VerifyMail;

class CustomerController extends Controller
{
    public function index()
    {


        Gate::authorize('customer_access');
        $customers = User::where('userrole', '=', 'owner')->latest()->get();
        return view('backend.customers.index', compact('customers'));
    }
    public function show($id)
    {

       
        Gate::authorize('customer_access');
        $user = User::findorfail($id);
        $detail = UserDetail::where('user_id',$id)->first();
        return view('backend.customers.show', compact('user','detail'));
    }

    public function destroy()
    {
        // todo deleted lksdfjkasdjk
    }

    public function verifyStatusChange(Request $request)
    {

        $user = User::where('id', $request->user_id)->first();
        $email = EmailNotification::where('user_id', $request->user_id)->first();
        // if ($user->verify_status == 0) {
        //     $user->update(['verify_status' => 1]);
        //     if ($email) {
        //         if ($email->verification_status == 1) {
        //             Mail::to($user->email)->send(new VerifyMail($user));
        //         }
        //     }
        // } else {
        //     $user->update(['verify_status' => 0]);
        // }
        if ($user) {
            $user->update(['verify_status' => !$user->verify_status]); // Toggle status

            if ($user->verify_status == 1 && $email?->verification_status == 1) {
                Mail::to($user->email)->send(new VerifyMail($user));
            }
        }


        flash('Status Change Successfully.');
        return to_route('admin.customers.index');
    }
}
