<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductImage;

use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::getAllProduct();
        return view('backend.product.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand = Brand::get();
        $category = Category::where('is_parent', 1)->get();
        // dd($category);
        return view('backend.product.create')->with('categories', $category)->with('brands', $brand);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $this->validate($request, [
            'title' => 'string|required',
            'summary' => 'string|required',
            'description' => 'string|nullable',
            'video' => 'string|nullable',
            'size' => 'nullable',
            'stock' => 'required|numeric',
            'cat_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'is_featured' => 'sometimes|in:1',
            'status' => 'required|in:active,inactive',
            'condition' => 'required|in:default,new,hot',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'photos' => 'required|array',
            'photos.*' => 'string|url'
        ]);

        // Prepare data for product creation
        $data = $request->all();
        
        // Generate unique slug
        $slug = Str::slug($request->title);
        $count = Product::where('slug', $slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 999);
        }
        
        $data['slug'] = $slug;
        $data['is_featured'] = $request->input('is_featured', 0);
        
        // Handle size array
        $size = $request->input('size');
        $data['size'] = $size ? implode(',', $size) : '';
        
        // Handle video URL
        $data['video_url'] = $request->input('video');
        
        // Remove photos from product data as they'll be stored separately
        $photos = $request->input('photos');
        unset($data['photos']);
        
        // Create product
        try {
            $product = Product::create($data);
            
            // Store multiple photos
            foreach ($photos as $photoUrl) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $photoUrl
                ]);
            }
            
            request()->session()->flash('success', 'Product added successfully');
        } catch (\Exception $e) {
            request()->session()->flash('error', 'Error adding product: ' . $e->getMessage());
        }
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::get();
        $product = Product::findOrFail($id);
        $category = Category::where('is_parent', 1)->get();
        $items = Product::where('id', $id)->get();
        
        // Retrieve photos from ProductImage model and format as comma-separated string for compatibility with edit.blade.php
        $product->photo = $product->images()->pluck('image_url')->implode(',');
        // dd($product);
        return view('backend.product.edit')
            ->with('product', $product)
            ->with('brands', $brand)
            ->with('categories', $category)
            ->with('items', $items);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Validate the request
        $this->validate($request, [
            'title' => 'string|required',
            'summary' => 'string|required',
            'description' => 'string|nullable',
            'video' => 'string|nullable',
            'size' => 'nullable',
            'stock' => 'required|numeric',
            'cat_id' => 'required|exists:categories,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'is_featured' => 'sometimes|in:1',
            'brand_id' => 'nullable|exists:brands,id',
            'status' => 'required|in:active,inactive',
            'condition' => 'required|in:default,new,hot',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'photos' => 'required|array',
            'photos.*' => 'string|url'
        ]);

        // Prepare data for product update
        $data = $request->all();
        $data['is_featured'] = $request->input('is_featured', 0);

        // Handle size array
        $size = $request->input('size');
        $data['size'] = $size ? implode(',', $size) : '';

        // Handle video URL
        $data['video_url'] = $request->input('video');

        // Remove photos from product data as they'll be stored separately
        $photos = $request->input('photos');
        unset($data['photos']);

        // Update product
        try {
            // Update the product record
            $product->fill($data)->save();

            // Delete existing photos and store new ones
            $product->images()->delete();
            foreach ($photos as $photoUrl) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $photoUrl
                ]);
            }

            request()->session()->flash('success', 'Product updated successfully');
        } catch (\Exception $e) {
            request()->session()->flash('error', 'Error updating product: ' . $e->getMessage());
        }

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $status = $product->delete();
        
        if ($status) {
            request()->session()->flash('success', 'Product deleted');
        } else {
            request()->session()->flash('error', 'Error while deleting product');
        }
        return redirect()->route('product.index');
    }
}