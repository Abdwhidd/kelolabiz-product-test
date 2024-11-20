<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Products</h1>

        <!-- Search and Add Product Buttons -->
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center space-x-2">
                <input
                    type="text"
                    id="search"
                    placeholder="Search products..."
                    class="border p-2 rounded-md w-64"
                >
                <button
                    type="button"
                    onclick="searchProduct()"
                    class="bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600"
                >
                    Search
                </button>
            </div>

            <a href="{{ route('product.create') }}" class="bg-green-500 text-white p-2 rounded-md hover:bg-green-600">
                Add Product
            </a>
        </div>

        <!-- Product List -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse($products as $product)
                <a href="{{ route('product.show', $product['_id']) }}" class="border rounded-lg shadow-lg p-4 block">
                    <img src="{{ $product['thumbnail'] }}" alt="{{ $product['title'] }}" class="w-full h-40 object-cover mb-4">
                    <h2 class="text-lg font-semibold">{{ $product['title'] }}</h2>
                    <p class="text-gray-700 text-sm">{{ $product['description'] }}</p>
                    <p class="text-green-600 font-bold mt-2">${{ $product['price'] }}</p>
                </a>
            @empty
                <p class="text-gray-500">No products available.</p>
            @endforelse
        </div>
    </div>

    <script>
        // Function to handle the search
        function searchProduct() {
            let query = document.getElementById('search').value;
            if (query) {
                // Redirect to the search results page with query parameter
                window.location.href = `/products/search?query=${query}`;
            }
        }
    </script>
</x-app-layout>
