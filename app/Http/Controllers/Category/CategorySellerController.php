<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Models\Category;
use Illuminate\Http\Request;

class CategorySellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($id)
    {
        $category = Category::findOrFail($id);
        $seller = $category->products()
            ->with('seller')
            ->get()
            ->pluck('seller')
            ->unique($id)
            ->values();
        return $this->showall($seller);
    }
}
