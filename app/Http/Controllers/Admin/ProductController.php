<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'price_discount' => 'nullable|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        // Check if the product already exists
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/image/product'), $imageName);
            $validateData['image'] = 'storage/image/product/' . $imageName;
        }

        // Check if service_id is provided, if not set is_gem to true
        if ($request->service_id) {
            $request->validate([
                'service_id' => 'required|exists:services,id',
            ]);
            $validateData['service_id'] = $request->service_id;
        }else{
            $validateData['is_gem'] = true;     
        }

        // Create the product
        $product = Product::create($validateData);

        return redirect()->route('admin.product.index')->with('success', __('product created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'price_discount' => 'nullable|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/image/product'), $imageName);
            $validateData['image'] = 'storage/image/product/' . $imageName;
        }

        // Check if service_id is provided, if not set is_gem to true
        if ($request->service_id) {
            $request->validate([
                'service_id' => 'required|exists:services,id',
            ]);
            $validateData['service_id'] = $request->service_id;
        }else{
            $validateData['is_gem'] = true;     
        }

        // Update the product
        $product->update($validateData);

        return redirect()->route('admin.product.index')->with('success', __('product updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.product.index')->with('success', __('product deleted successfully'));
    }
}
