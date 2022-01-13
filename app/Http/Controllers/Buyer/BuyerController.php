<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Buyer;
use App\Models\User;
use Illuminate\Http\Request;

class BuyerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $buyers = Buyer::has('transactions')->get();
        return $this->showall($buyers);
    }

    public function show($id)
    {
        $buyers = Buyer::has('transactions')->findOrFail($id);
        return $this->showOne($buyers);
    }
}
