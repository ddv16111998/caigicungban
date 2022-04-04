<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller{
    public function search(Request $request)
    {
        if ($request->has('search') && $request->query('search')) {
            $categories = Category::search($request->query('search'))->get();
        } else {
            $categories = Category::all();
        }
        return view('customer.categories.index', compact('categories'));
    }
}
