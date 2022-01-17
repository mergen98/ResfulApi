<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Models\Buyer;
use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;

class ProductBuyerTransactionController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Product $product, User $buyer)
    {   

        $rules = [
          'quantity' => 'required|integer|min:1'
        ];
            
        $this->validate($request,$rules);

        if($buyer->id == $product->seller_id) {
            return $this->errorResponse('The buyer must be different from the seller',409);
        }

        if(!$buyer->isVerified()) {
            return $this->errorResponse('The Buyer must be verified user',409);
        }

        if(!$buyer->seller->isVerified()) {
            return $this->errorResponse('The Seller must be verified user',409);
        }

        if(!$product->isavailable()) {
            return $this->errorResponse('The product is not available',409);
        }

        if($product->quantity < $request->quantity){
            return $this->errorResponse('The Product does not have enough units for this transactio',409);
        }

        
    }
}
