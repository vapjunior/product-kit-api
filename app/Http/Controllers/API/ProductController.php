<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductResource;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        $success['products'] = ProductResource::collection($products);
        $message = 'Products retrivied successfully';
        $code = 200;
        
        return $this->sendResponse($success, $message, $code);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:25',
            'description' => 'required|max:255',
            'price' => 'required',
        ]);

        if($validator->fails()) {
            $message = 'Validation Error.';
            return $this->sendError($message, $validator->errors());
        }

        $product = Product::create($data);

        $success['product'] = new ProductResource($product);
        $message = 'Product Created Successfully';
        $code = 201;

        return $this->sendResponse($success, $message, $code);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $success['product'] = new ProductResource($product);
        $message = 'Product Retrevied Successfully';
        $code = 200;

        return $this->sendResponse($success, $message, $code);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:25',
            'description' => 'required|max:255',
            'price' => 'required',
        ]);

        if($validator->fails()) {
            $message = 'Validation Error.';
            return $this->sendError($message, $validator->errors());
        }

        $product->update($data);
        
        $success['product'] = new ProductResource($product);
        $message = 'Product Updated Successfully';

        return $this->sendResponse($success, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        $message = 'Product Destroyed Successfully';

        return $this->sendResponse(null, $message);
    }
}
