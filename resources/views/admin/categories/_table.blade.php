<div class="table-container" id="categories-table">
    <table class="w-full">
        <thead>
            <tr class="border-b border-gray-700">
                <th class="py-3 text-left text-gray-400">ID</th>
                <th class="py-3 text-left text-gray-400">Icon</th>
                <th class="py-3 text-left text-gray-400">Name</th>
                <th class="py-3 text-left text-gray-400">Slug</th>
                <th class="py-3 text-left text-gray-400">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr class="border-b border-gray-800 hover:bg-gray-800">
                    <td class="py-4 text-white">#{{ $category->id }}</td>
                    <td class="py-4">
                        <div class="w-12 h-12 rounded-lg overflow-hidden bg-gray-700 flex items-center justify-center">
                            @if($category->icon && file_exists(storage_path('app/public/' . $category->icon)))
                                <img src="{{ asset('storage/' . $category->icon) }}" class="w-full h-full object-cover" alt="{{ $category->name }}">
                            @else
                                <i class="fas fa-layer-group text-neon"></i>
                            @endif
                        </div>
                    </td>
                    <td class="py-4 text-gray-300">{{ $category->name }}</td>
                    <td class="py-4 text-gray-400">{{ $category->slug }}</td>
                    <td class="py-4">
                        <button class="text-neon hover:text-purple-400 mr-3" onclick="openEditModal('{{ $category->id }}', '{{ $category->name }}', '{{ $category->slug }}', '{{ $category->icon }}')">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="text-red-500 hover:text-red-400" onclick="deleteCategory('{{ $category->id }}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="py-8 text-center text-gray-400">No categories found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="flex justify-between items-center mt-6">
    <p class="text-gray-400">Showing {{ $categories->firstItem() ?? 0 }} to {{ $categories->lastItem() ?? 0 }} of {{ $categories->total() }} categories</p>
    <div class="flex space-x-2" id="pagination-links">
        {{ $categories->appends(request()->query())->links('partials._pagination') }}
    </div>
</div>
