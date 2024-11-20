<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Add Product</h1>

        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-4">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" id="title" name="title" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required></textarea>
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                    <input type="text" id="category" name="category" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" id="price" name="price" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                </div>

                <!-- Discount Percentage -->
                <div>
                    <label for="discountPercentage" class="block text-sm font-medium text-gray-700">Discount Percentage</label>
                    <input type="number" id="discountPercentage" name="discountPercentage" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                </div>

                <!-- Stock -->
                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                    <input type="number" id="stock" name="stock" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                </div>

                <!-- Brand -->
                <div>
                    <label for="brand" class="block text-sm font-medium text-gray-700">Brand</label>
                    <input type="text" id="brand" name="brand" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                </div>

                <!-- SKU -->
                <div>
                    <label for="sku" class="block text-sm font-medium text-gray-700">SKU</label>
                    <input type="text" id="sku" name="sku" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                </div>

                <!-- Weight -->
                <div>
                    <label for="weight" class="block text-sm font-medium text-gray-700">Weight</label>
                    <input type="number" id="weight" name="weight" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                </div>

                <!-- Warranty Information -->
                <div>
                    <label for="warrantyInformation" class="block text-sm font-medium text-gray-700">Warranty Information</label>
                    <textarea id="warrantyInformation" name="warrantyInformation" rows="2" class="mt-1 block w-full border border-gray-300 rounded-md p-2"></textarea>
                </div>

                <!-- Shipping Information -->
                <div>
                    <label for="shippingInformation" class="block text-sm font-medium text-gray-700">Shipping Information</label>
                    <textarea id="shippingInformation" name="shippingInformation" rows="2" class="mt-1 block w-full border border-gray-300 rounded-md p-2"></textarea>
                </div>

                <!-- Availability Status -->
                <div>
                    <label for="availabilityStatus" class="block text-sm font-medium text-gray-700">Availability Status</label>
                    <input type="text" id="availabilityStatus" name="availabilityStatus" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                </div>

                <!-- Return Policy -->
                <div>
                    <label for="returnPolicy" class="block text-sm font-medium text-gray-700">Return Policy</label>
                    <textarea id="returnPolicy" name="returnPolicy" rows="2" class="mt-1 block w-full border border-gray-300 rounded-md p-2"></textarea>
                </div>

                <!-- Minimum Order Quantity -->
                <div>
                    <label for="minimumOrderQuantity" class="block text-sm font-medium text-gray-700">Minimum Order Quantity</label>
                    <input type="number" id="minimumOrderQuantity" name="minimumOrderQuantity" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                </div>

                <!-- Tags -->
                <div>
                    <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
                    <input type="text" id="tags" name="tags[]" class="mt-1 block w-full border border-gray-300 rounded-md p-2" placeholder="Add tags (e.g., beauty, clothing)" required>
                </div>

                <!-- Thumbnail -->
                <div>
                    <label for="thumbnail" class="block text-sm font-medium text-gray-700">Thumbnail Image URL</label>
                    <input type="url" id="thumbnail" name="thumbnail" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                </div>

                <!-- Dimensions -->
                <div>
                    <label for="dimensions" class="block text-sm font-medium text-gray-700">Dimensions (Width, Height, Depth)</label>
                    <div class="grid grid-cols-3 gap-4">
                        <input type="number" id="dimensions_width" name="dimensions[width]" class="mt-1 block w-full border border-gray-300 rounded-md p-2" placeholder="Width" required>
                        <input type="number" id="dimensions_height" name="dimensions[height]" class="mt-1 block w-full border border-gray-300 rounded-md p-2" placeholder="Height" required>
                        <input type="number" id="dimensions_depth" name="dimensions[depth]" class="mt-1 block w-full border border-gray-300 rounded-md p-2" placeholder="Depth" required>
                    </div>
                </div>

                <!-- Meta Data (QR Code and Barcode) -->
                <div>
                    <label for="meta" class="block text-sm font-medium text-gray-700">Meta Information (QR Code & Barcode)</label>
                    <div class="grid grid-cols-2 gap-4">
                        <input type="text" id="meta_barcode" name="meta[barcode]" class="mt-1 block w-full border border-gray-300 rounded-md p-2" placeholder="Barcode" required>
                        <input type="url" id="meta_qrcode" name="meta[qrCode]" class="mt-1 block w-full border border-gray-300 rounded-md p-2" placeholder="QR Code URL" required>
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600">Add Product</button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
