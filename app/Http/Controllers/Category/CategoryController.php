<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use http\Env\Response;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $categories = Category::all();
        return $this->showall($categories);
    }

    public function store(Request $request)
    {
        $categories = [
            'name' => 'required',
            'description' => 'required'
        ];

        $this->validate($request,$categories);

        $newcategories = Category::create($request->all());
        return $this->showOne($newcategories,201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $categories = Category::findOrFail($id);
        return $this->showOne($categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrfail($id);
        $category->fill($request->only([
            'name',
            'description',
        ]));
        if($category->isClean()){
            return $this->errorResponse('You need specify any different value to update',422);
        }
        $category->save();
        return $this->showOne($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return $this->showOne($category);
    }
}
