<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class DashboardControler extends Controller
{
    public function index()
    {
        Gate::authorize('dashboard_access');

        $data['subscriptions'] = Subscription::count();
        $data['visitors'] = DB::table('visitors')->value('count');
        $data['payments'] = Payment::sum('amount');
        $data['users'] = User::where('userrole', 'owner')->count();
        $data['pendings'] = Pet::where('isPublished', '0')->count();
        $data['lusers'] = User::latest()->take(10)->get();
        $data['salesData'] = Payment::selectRaw('DATE_FORMAT(created_at, "%Y-%m-01") as month, SUM(amount) as total_amount')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();
        $data['sales'] = Payment::with(['user', 'subcription'])->latest()->take(10)->get();
        return view('backend.dashboard', $data);
    }
}
