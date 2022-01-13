<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Seller;
use Facade\FlareClient\Api;
use Illuminate\Http\Request;

class SellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $sellers = Seller::has('products')->get();
        return $this->showall($sellers);
    }

    public function show($id)
    {
        $seller = Seller::has('products')->findOrFail($id);
        return $this->showOne($seller);
    }

}
