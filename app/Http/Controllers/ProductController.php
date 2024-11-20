<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getProducts();

        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);

        if (!$product) {
            abort(404, 'Product not found');
        }

        return view('products.show', compact('product'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $result = $this->productService->createProduct($data);

        if (!$result['status']) {
            return response()->json([
                'message' => 'Validation or API call failed',
                'errors' => $result['errors'] ?? $result['error'],
            ], 422);
        }

        return redirect()->route('product.index')->with('success', 'Product created successfully');
    }

    public function edit($id)
    {
        $product = $this->productService->getProductById($id);

        if (!$product) {
            abort(404, 'Product not found');
        }

        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $result = $this->productService->updateProduct($id, $data);

        if (!$result['status']) {
            return response()->json([
                'message' => 'Validation or API call failed',
                'errors' => $result['errors'] ?? $result['error'],
            ], 422);
        }

        return redirect()->route('product.show', $id)->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        $result = $this->productService->deleteProduct($id);

        if (!$result['status']) {
            return response()->json([
                'message' => 'Product deletion failed',
                'errors' => $result['errors'] ?? $result['error'],
            ], 422);
        }

        return redirect()->route('product.index')->with('success', 'Product deleted successfully');
    }
}
