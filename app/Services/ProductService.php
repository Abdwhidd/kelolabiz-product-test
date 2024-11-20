<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ProductService
{
    public function getProducts()
    {
        $response = Http::get('https://api.sugity.kelola.biz/api/product');
        if ($response->successful()) {
            $data = $response->json();
            return $data['data'] ?? [];
        }
        return [];
    }

    public function getProductById($id)
    {
        $response = Http::get("https://api.sugity.kelola.biz/api/product/{$id}");

        if ($response->successful()) {
            $product = $response->json()['data'] ?? null;

            if ($product) {
                $meta = isset($product['meta']) ? json_decode($product['meta'], true) : [];
                $tagColors = [];
                foreach ($product['tags'] ?? [] as $tag) {
                    if ($tag === 'beauty') {
                        $tagColors[] = 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300';
                    } elseif ($tag === 'mascara') {
                        $tagColors[] = 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300';
                    } else {
                        $tagColors[] = 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
                    }
                }

                $product['meta'] = [
                    'qrCode' => isset($meta['qrCode']) ? $meta['qrCode'] : 'https://placehold.co/300x300.png?text=No+QR+Code',
                    'createdAt' => $meta['createdAt'] ?? 'Created At not available',
                    'updatedAt' => $meta['updatedAt'] ?? 'Updated At not available',
                    'barcode' => $meta['barcode'] ?? 'Barcode not found',
                    'tagColors' => $tagColors,
                ];

                return $product;
            }
        }

        return null;
    }

    public function createProduct($data)
    {
        $validator = Validator::make($data, [
            'title' => 'required|string',
            'description' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|numeric',
            'discountPercentage' => 'required|numeric',
            'stock' => 'required|numeric',
            'brand' => 'required|string',
            'sku' => 'required|string',
            'weight' => 'required|numeric',
            'warrantyInformation' => 'nullable|string',
            'shippingInformation' => 'nullable|string',
            'availabilityStatus' => 'nullable|string',
            'returnPolicy' => 'nullable|string',
            'minimumOrderQuantity' => 'required|numeric',
            'tags' => 'nullable|array',
            'tags.*' => 'string',
            'thumbnail' => 'required|url',
            'dimensions' => 'nullable|array',
            'dimensions.width' => 'required_with:dimensions|numeric',
            'dimensions.height' => 'required_with:dimensions|numeric',
            'dimensions.depth' => 'required_with:dimensions|numeric',
            'meta' => 'required|array',
            'meta.barcode' => 'required|string',
            'meta.qrCode' => 'required|url',
        ]);

        if ($validator->fails()) {
            return [
                'status' => false,
                'errors' => $validator->errors(),
            ];
        }

        $response = Http::post('https://api.sugity.kelola.biz/api/product', $data);

        if ($response->successful()) {
            return [
                'status' => true,
                'data' => $response->json()['data'] ?? null,
            ];
        }

        return [
            'status' => false,
            'error' => [
                'message' => $response->json()['message'] ?? 'Unknown error',
                'status_code' => $response->status(),
            ],
        ];
    }

    public function updateProduct($id, $data)
    {
        $validator = Validator::make($data, [
            'title' => 'required|string',
            'description' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|numeric',
            'discountPercentage' => 'required|numeric',
            'stock' => 'required|numeric',
            'brand' => 'required|string',
            'sku' => 'required|string',
            'weight' => 'required|numeric',
            'warrantyInformation' => 'nullable|string',
            'shippingInformation' => 'nullable|string',
            'availabilityStatus' => 'nullable|string',
            'returnPolicy' => 'nullable|string',
            'minimumOrderQuantity' => 'required|numeric',
            'tags' => 'nullable|array',
            'tags.*' => 'string',
            'thumbnail' => 'required|url',
            'dimensions' => 'nullable|array',
            'dimensions.width' => 'required_with:dimensions|numeric',
            'dimensions.height' => 'required_with:dimensions|numeric',
            'dimensions.depth' => 'required_with:dimensions|numeric',
            'meta' => 'required|array',
            'meta.barcode' => 'required|string',
            'meta.qrCode' => 'required|url',
        ]);

        if ($validator->fails()) {
            return [
                'status' => false,
                'errors' => $validator->errors(),
            ];
        }

        $response = Http::put("https://api.sugity.kelola.biz/api/product/{$id}", $data);

        if ($response->successful()) {
            return [
                'status' => true,
                'data' => $response->json()['data'] ?? null,
            ];
        }

        return [
            'status' => false,
            'error' => [
                'message' => $response->json()['message'] ?? 'Unknown error',
                'status_code' => $response->status(),
            ],
        ];
    }

    public function deleteProduct($id)
    {
        $response = Http::delete("https://api.sugity.kelola.biz/api/product/{$id}");

        if ($response->successful()) {
            return [
                'status' => true,
                'message' => 'Product deleted successfully',
            ];
        }

        return [
            'status' => false,
            'error' => [
                'message' => $response->json()['message'] ?? 'Unknown error',
                'status_code' => $response->status(),
            ],
        ];
    }
}
