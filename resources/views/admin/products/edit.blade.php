<x-layouts.admin title="Edit Product - Admin">
    <div class="max-w-2xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-black text-gray-900">Edit Product</h1>
            <a href="{{ route('admin.products.index') }}" class="text-gray-600 hover:text-gray-900">← Back</a>
        </div>

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 rounded-2xl p-4">
                <h3 class="font-bold text-red-900 mb-2">Please fix the following errors:</h3>
                <ul class="space-y-1 text-sm text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 space-y-6">
            @csrf
            @method('PUT')

            <!-- Product Name -->
            <div @class(['', 'border-2 border-red-300 rounded-xl p-3' => $errors->has('name')])>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Product Name *</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name"
                    value="{{ old('name', $product->name) }}" 
                    placeholder="e.g., Fresh Roma Tomatoes" 
                    class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary"
                    required
                >
                @error('name')
                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Product Slug -->
            <div @class(['', 'border-2 border-red-300 rounded-xl p-3' => $errors->has('slug')])>
                <label for="slug" class="block text-sm font-semibold text-gray-700 mb-2">URL Slug * <span class="text-xs text-gray-500">(must be unique)</span></label>
                <input 
                    type="text" 
                    name="slug" 
                    id="slug"
                    value="{{ old('slug', $product->slug) }}" 
                    placeholder="e.g., fresh-roma-tomatoes" 
                    class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary"
                    required
                >
                @error('slug')
                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div @class(['', 'border-2 border-red-300 rounded-xl p-3' => $errors->has('category_id')])>
                <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">Category *</label>
                <select 
                    name="category_id" 
                    id="category_id"
                    class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary"
                    required
                >
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div @class(['', 'border-2 border-red-300 rounded-xl p-3' => $errors->has('description')])>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description *</label>
                <textarea 
                    name="description" 
                    id="description"
                    rows="4"
                    placeholder="Detailed product description" 
                    class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary"
                    required
                >{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-6">
                <!-- Price -->
                <div @class(['', 'border-2 border-red-300 rounded-xl p-3' => $errors->has('price')])>
                    <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">Price (₦) *</label>
                    <input 
                        type="number" 
                        name="price" 
                        id="price"
                        value="{{ old('price', $product->price) }}" 
                        placeholder="0.00"
                        step="0.01"
                        min="0"
                        class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary"
                        required
                    >
                    @error('price')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Unit -->
                <div @class(['', 'border-2 border-red-300 rounded-xl p-3' => $errors->has('unit')])>
                    <label for="unit" class="block text-sm font-semibold text-gray-700 mb-2">Unit *</label>
                    <input 
                        type="text" 
                        name="unit" 
                        id="unit"
                        value="{{ old('unit', $product->unit) }}" 
                        placeholder="e.g., kg, pcs, liters" 
                        class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary"
                        required
                    >
                    @error('unit')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <!-- Stock -->
                <div @class(['', 'border-2 border-red-300 rounded-xl p-3' => $errors->has('stock')])>
                    <label for="stock" class="block text-sm font-semibold text-gray-700 mb-2">Stock Quantity *</label>
                    <input 
                        type="number" 
                        name="stock" 
                        id="stock"
                        value="{{ old('stock', $product->stock) }}" 
                        placeholder="0"
                        min="0"
                        class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary"
                        required
                    >
                    @error('stock')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image Upload -->
                <div @class(['', 'border-2 border-red-300 rounded-xl p-3' => $errors->has('image')])>
                    <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Product Image</label>
                    <input 
                        type="file" 
                        name="image" 
                        id="image"
                        accept="image/jpeg,image/png,image/gif,image/webp"
                        class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary"
                    >
                    <p class="text-xs text-gray-500 mt-2">JPG, PNG, GIF or WebP • Max 2MB</p>
                    @error('image')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Current Image Display -->
            @if ($product->image_url)
                <div class="p-4 bg-blue-50 border border-blue-200 rounded-xl">
                    <p class="text-sm font-semibold text-blue-900 mb-3">Current Image</p>
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover rounded-lg border border-blue-300">
                </div>
            @endif

            <!-- Image URL (Fallback) -->
            <div @class(['', 'border-2 border-red-300 rounded-xl p-3' => $errors->has('image_url')])>
                <label for="image_url" class="block text-sm font-semibold text-gray-700 mb-2">Or Image URL (if no file upload)</label>
                <input 
                    type="url" 
                    name="image_url" 
                    id="image_url"
                    value="{{ old('image_url', $product->image_url) }}" 
                    placeholder="https://..." 
                    class="w-full p-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary"
                >
                <p class="text-xs text-gray-500 mt-2">File upload takes priority over URL</p>
                @error('image_url')
                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Featured -->
            <div class="flex items-center space-x-3 p-4 bg-gray-50 rounded-xl">
                <input 
                    type="checkbox" 
                    name="is_featured" 
                    id="is_featured"
                    value="1"
                    @checked(old('is_featured', $product->is_featured))
                    class="w-4 h-4 text-primary rounded focus:ring-2 focus:ring-primary"
                >
                <label for="is_featured" class="text-sm font-semibold text-gray-700">Featured Product</label>
                <p class="text-xs text-gray-500">(Display on homepage)</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-4 pt-4 border-t">
                <button type="submit" class="flex-1 bg-primary hover:bg-secondary text-white font-bold px-6 py-3 rounded-xl transition">
                    Update Product
                </button>
                
                <button type="button" onclick="if(confirm('Delete this product? This cannot be undone.')) { document.getElementById('deleteForm').submit(); }" class="flex-1 bg-red-100 hover:bg-red-200 text-red-900 font-bold px-6 py-3 rounded-xl transition">
                    Delete
                </button>
                
                <a href="{{ route('admin.products.index') }}" class="flex-1 text-center bg-gray-200 hover:bg-gray-300 text-gray-900 font-bold px-6 py-3 rounded-xl transition">
                    Cancel
                </a>
            </div>
        </form>

        <!-- Delete Form (Hidden) -->
        <form id="deleteForm" action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:none;">
            @csrf
            @method('DELETE')
    </div>
</x-layouts.admin>
