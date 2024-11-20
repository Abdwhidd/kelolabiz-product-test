<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="flex flex-wrap justify-between gap-8">

            <div class="w-full lg:w-7/12">
                <div class="border rounded-lg shadow-lg p-6">
                    <!-- Thumbnail Image -->
                    <img src="{{ $product['thumbnail'] }}" alt="{{ $product['title'] }}" class="w-full h-96 object-cover mb-4">

                    <!-- Product Title and Description -->
                    <h2 class="text-3xl font-semibold mb-4">{{ $product['title'] }}</h2>
                    <p class="text-gray-700 text-lg mb-4">{{ $product['description'] }}</p>
                    <p class="text-green-600 font-bold text-xl">${{ $product['price'] }}</p>

                    <!-- Tags Section with Predefined Colors -->
                    <div class="mt-6">
                        <h3 class="text-xl font-semibold mb-2">Tags:</h3>
                        <div class="flex flex-wrap">
                            @foreach($product['tags'] as $index => $tag)
                                <span class="{{ $product['meta']['tagColors'][$index] }} text-xs font-medium me-2 px-2.5 py-0.5 rounded">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Reviews Section with Star Rating -->
                    <div class="mt-6">
                        <h3 class="text-xl font-semibold mb-2">Reviews:</h3>
                        @foreach($product['reviews'] as $review)
                            <div class="border-t pt-4">
                                <p><strong>{{ $review['reviewerName'] }}</strong> ({{ $review['date'] }})</p>

                                <!-- Star Rating -->
                                <p><strong>Rating:</strong>
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $review['rating'])
                                            <span class="text-yellow-500">★</span>
                                        @else
                                            <span class="text-gray-300">★</span>
                                        @endif
                                    @endfor
                                </p>

                                <p><strong>Comment:</strong> {{ $review['comment'] }}</p>
                            </div>
                        @endforeach
                    </div>

                    <!-- Edit and Delete Buttons -->
                    <div class="mt-6 flex justify-between">
                        <a href="{{ route('product.edit', $product['_id']) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Edit
                        </a>
                        <form action="{{ route('product.delete', $product['_id']) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-4/12">
                <div class="border rounded-lg shadow-lg p-6">
                    <!-- QR Code -->
                    <h3 class="text-xl font-semibold mb-4">QR Code:</h3>
                    <img src="{{ $product['meta']['qrCode'] }}" alt="QR Code" class="w-full h-80 object-contain mx-auto">

                    <!-- Meta Information Section -->
                    <div class="mt-6">
                        <h3 class="text-xl font-semibold mb-2">Meta Information:</h3>
                        <ul class="text-gray-700">
                            <li><strong>Created At:</strong> {{ $product['meta']['createdAt'] }}</li>
                            <li><strong>Updated At:</strong> {{ $product['meta']['updatedAt'] }}</li>
                            <li><strong>Barcode:</strong> {{ $product['meta']['barcode'] }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
