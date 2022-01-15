<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Models\Buyer;
use Illuminate\Http\Request;

class BuyerSellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($id)
    {
        $buyer = Buyer::findOrFail($id);
        $sellers = $buyer->transactions()->with('product.seller')->get()->pluck('product.seller')->unique('id')->values();
        return $this->showall($sellers);
    }
}
