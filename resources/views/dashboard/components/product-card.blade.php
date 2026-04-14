<div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:-translate-y-1 hover:shadow-lg">
    <div class="h-48 bg-gray-200 flex items-center justify-center">
        <span class="text-gray-400">Product Image</span>
    </div>
    <div class="p-4">
        <h3 class="text-lg font-semibold text-gray-800">{{ $name ?? 'Product Name' }}</h3>
        <p class="text-gray-500 text-sm mt-1">Short description here.</p>
        <div class="mt-4 flex items-center justify-between">
            <span class="text-indigo-600 font-bold">${{ $price ?? '0.00' }}</span>
            <button class="bg-indigo-600 text-white px-3 py-1 rounded text-sm hover:bg-indigo-700">Add to Cart</button>
        </div>
    </div>
</div>
