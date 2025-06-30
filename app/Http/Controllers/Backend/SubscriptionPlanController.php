<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreSubscriptionPlanRequest;
use App\Http\Requests\UpdateSubscriptionPlanRequest;

class SubscriptionPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        Gate::authorize('subscription_plan_access');
        $subscriptionPlans = SubscriptionPlan::all();

        return view('backend.subscription_plans.index', compact('subscriptionPlans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('subscription_plan_create');
        return view('backend.subscription_plans.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubscriptionPlanRequest $request)
    {
        Gate::authorize('subscription_plan_create');
        $store = SubscriptionPlan::create($request->validated());

        flash('Subscription Plan Created Successfully.');
        return to_route('admin.subscriptionPlans.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubscriptionPlan $subscriptionPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubscriptionPlan $subscriptionPlan)
    {
        Gate::authorize('subscription_plan_edit');
        return view('backend.subscription_plans.form', compact('subscriptionPlan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubscriptionPlanRequest $request, SubscriptionPlan $subscriptionPlan)
    {
        Gate::authorize('subscription_plan_edit');
        $subscriptionPlan->update($request->validated());
        flash('Subscription Plan Updated Successfully.');
        return to_route('admin.subscriptionPlans.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubscriptionPlan $subscriptionPlan)
    {
        Gate::authorize('subscription_plan_delete');
        $subscriptionPlan->delete();
        flash('Subscription Plan Deleted Successfully.');
        return to_route('admin.subscriptionPlans.index');
    }
}
