<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\services\Media;
use App\Models\Pharmacy;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=Product::with('pharmacies')->get();
        return $products;

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = new Product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;

        $newImageName = Media::uploadImage($request->file('image'), 'images');
        $product->image = $newImageName;
        $product->save();

       $pharmacies = $request->input('pharmacies');
       $product->pharmacies()->sync($pharmacies);

            return response()->json(['message'=>'Product created successfully','Product'=>$product],201);

    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $product=Product::find($id);
        if(is_null($product)){
            return response()->json(['message'=>'Product not found']);
        }else{
            $product->title = $request->title;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->quantity = $request->quantity;

            if ($product->image && file_exists(public_path("images/{$product->image}"))) {
                unlink(public_path("images/{$product->image}"));
            }
            $newImageName = Media::uploadImage($request->file('image'), 'images');
            $product->image = $newImageName;
            $product->save();

           $pharmacies = $request->input('pharmacies');
           $product->pharmacies()->sync($pharmacies);

                return response()->json(['message'=>'Product created successfully']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if ($product->image && file_exists(public_path("images/{$product->image}"))) {
            unlink(public_path("images/{$product->image}"));

        }
        $product->delete();
        return response()->json(['message'=>'Product deleted successfully']);
    }
}
