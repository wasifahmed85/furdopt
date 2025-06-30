<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class BreedController extends Controller
{
    public function getBreeds(Category $category)
    {
        try {
            $breeds = SubCategory::where('category_id', $category->id)
                ->select('id', 'name')
                ->get();

            return response()->json($breeds);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch breeds',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
