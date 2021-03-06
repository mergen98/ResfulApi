<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SellerProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($id)
    {
        $seller = Seller::findOrFail($id);
        $products = $seller->products;
        return $this->showall($products);
    }

    public function store(Request $request,User $seller)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required|integer|min:1',
            'image' => 'required|image',
        ];

        $this->validate($request,$rules);

        $data = $request->all();

        $data['status'] = Product::UNAVAILABLE_PRODUCT;
        $data['image'] = '1.jpg';
        $data['seller_id'] = $seller->id;

        $product = Product::create($data);
        return $this->showOne($product);
    }

    public function update(Request $request,Seller $seller,Product $product)
    {
        $rules = [
            'quantity' => 'integer|min:1',
            'status' => 'in:' . Product::UNAVAILABLE_PRODUCT . ',' . Product::AVAILABLE_PRODUCT,
            'image' => 'image'
        ];

        $this->validate($request,$rules);

        $this->checkSeller($seller,$product);

        $product->fill($request->only([
                'name',
                'description',
                'quantity'
            ]));
        if ($request->has('status')) {
            $product->status = $request->status;

            if ($product->isavailable() && $product->categories()->count() == 0){
                return $this->errorResponse('An active product must be at least one category',409);
            }
        }
        if ($product->isClean()){
            return $this->errorResponse('You need to specify a different value to update',422);
        }

        $product->save();
        return $this->showOne($product);
    }

    public function checkSeller(Seller $seller, Product $product)
    {
        if($seller->id != $product->seller_id)
        {
            throw new HttpException(422,'The specify seller is not   actual seller of the product');
        }
    }

    public function destroy(Seller $seller,Product $product)
    {
        $this->checkSeller($seller,$product);
        $product->delete();
        return $this->showOne($product);
    }

}
