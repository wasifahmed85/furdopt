<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function getSubcategoryFromAjax(Request $request)
    {


        if (!$request->category_id) {
            $html = '<option value="">' . trans('global.pleaseSelect') . '</option>';
        } else {
            $html = '';
            $groups = SubCategory::where('category_id', $request->category_id)->get();
            foreach ($groups as $group) {
                $html .= '<option value="' . $group->id . '">' . $group->name . '</option>';
            }
        }

        return response()->json(['html' => $html]);
    }
}
