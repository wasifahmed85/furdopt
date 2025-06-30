<?php

namespace App\Http\Controllers\Backend;

use App\Models\UkState;
use App\Models\SubCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('city_access');
        $cities = UkState::orderBy('state','ASC')->get();

        return view('backend.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('city_create');
        
        return view('backend.cities.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCityRequest $request)
    {
        Gate::authorize('city_create');
       
            $store = UkState::create($request->validated());
        
        flash('City Created Successfully.');
        return to_route('admin.cities.index');
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
    public function edit($id)
    {
        Gate::authorize('city_edit');
        $city = UkState::findorfail($id);
        return view('backend.cities.form', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        Gate::authorize('city_edit');
        
     $city = UkState::findOrFail($request->city_id); 

            $request->validate([
                'state' => 'required|max:255|unique:uk_states,state,' . $city->id . ',id',
            ]);
            
            $city->update($request->only('state'));
            flash('City Updated Successfully.');
        
        return to_route('admin.cities.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Gate::authorize('city_delete');
        $city = UkState::findOrFail($request->city_id); 
        $city->delete();
        flash('City Deleted Successfully.');
        return to_route('admin.cities.index');
    }
}
