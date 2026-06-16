<?php

  namespace App\Http\Controllers\Api;

  use App\Http\Controllers\Controller;
  use App\Http\Resources\ProductResource;
  use App\Models\Product;

  class ProductController extends Controller
  {
      public function index()
      {
          $products = Product::with('category')->paginate(10);

          return ProductResource::collection($products);
      }

      public function show(Product $product)
      {
          $product->load('category');

          return new ProductResource($product);
      }
  }