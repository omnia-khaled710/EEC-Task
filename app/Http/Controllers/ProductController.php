<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\services\Media;
use App\Models\Pharmacy;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product, Request $request)
    {
        $products = Product::with('pharmacies')->paginate(10);
        return view("products.list", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pharmacies = Pharmacy::all();
        return view("products.create", compact('pharmacies'));
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

        if ($request->has('pharmacies')) {
            $pharmacies = Pharmacy::whereIn('id', $request->pharmacies)->get();
            $product->pharmacies()->sync($pharmacies);
            return redirect()->route('products.index')->with('success', 'Product created successfully');
        } else {
            $product->delete();
            return redirect()->back()->with('error', 'Pharmacy not found');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

        //    $product= Product::find($id);
        return view('products.productDetails', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $pharmacies = Pharmacy::all();
        return view('products.edit', ['product' => $product, 'pharmacies' => $pharmacies]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $product = Product::findOrFail($id);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        unlink(public_path("images/{$product->image}"));
        $newImageName = Media::uploadImage($request->file('image'), 'images');
        $product->image = $newImageName;
        $product->save();

        if ($request->has('pharmacies')) {
            $pharmacies = Pharmacy::whereIn('id', $request->pharmacies)->get();
            $product->pharmacies()->sync($pharmacies);
            return redirect()->route('products.index')->with('success', 'Product updated successfully');
        } else {
            $product->pharmacies()->detach();

            return redirect()->back()->with('error', 'Pharmacy not found');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        unlink(public_path("images/{$product->image}"));
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('title', 'like', "{$query}%")->get();

        return view('products.search', compact('products', 'query'));
    }
}
