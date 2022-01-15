<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\ApiController;
use App\Models\Seller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Opis\Closure\SerializableClosure;

class TransactionSellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($id)
    {
        $transaction = Transaction::findOrFail($id);
        $seller = $transaction->product->seller;
        return $this->showOne($seller);
    }
}
