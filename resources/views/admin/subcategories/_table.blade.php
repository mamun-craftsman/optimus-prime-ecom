<div class="table-container" id="subcategories-table">
    <table class="w-full">
        <thead>
            <tr class="border-b border-gray-700">
                <th class="py-3 text-left text-gray-400">ID</th>
                <th class="py-3 text-left text-gray-400">Icon</th>
                <th class="py-3 text-left text-gray-400">Name</th>
                <th class="py-3 text-left text-gray-400">Category</th>
                <th class="py-3 text-left text-gray-400">Slug</th>
                <th class="py-3 text-left text-gray-400">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($subcategories as $subcategory)
                <tr class="border-b border-gray-800 hover:bg-gray-800">
                    <td class="py-4 text-white">#{{ $subcategory->id }}</td>
                    <td class="py-4">
                        <div class="w-12 h-12 rounded-lg overflow-hidden bg-gray-700 flex items-center justify-center">
                            @if($subcategory->icon && file_exists(storage_path('app/public/' . $subcategory->icon)))
                                <img src="{{ asset('storage/' . $subcategory->icon) }}" class="w-full h-full object-cover" alt="{{ $subcategory->name }}">
                            @else
                                <i class="fas fa-layer-group text-neon"></i>
                            @endif
                        </div>
                    </td>
                    <td class="py-4 text-gray-300">{{ $subcategory->name }}</td>
                    <td class="py-4 text-gray-400">{{ $subcategory->category->name ?? 'N/A' }}</td>
                    <td class="py-4 text-gray-400">{{ $subcategory->slug }}</td>
                    
                    <td class="py-4">
                        <button class="text-neon hover:text-purple-400 mr-3" onclick="openEditModal('{{ $subcategory->id }}', '{{ $subcategory->name }}', '{{ $subcategory->slug }}', '{{ $subcategory->category_id }}', '{{ $subcategory->icon }}')">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="text-red-500 hover:text-red-400" onclick="deleteSubcategory('{{ $subcategory->id }}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="py-8 text-center text-gray-400">No subcategories found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="flex justify-between items-center mt-6">
    <p class="text-gray-400">Showing {{ $subcategories->firstItem() ?? 0 }} to {{ $subcategories->lastItem() ?? 0 }} of {{ $subcategories->total() }} subcategories</p>
    <div class="flex space-x-2" id="pagination-links">
        {{ $subcategories->appends(request()->query())->links('partials._pagination') }}
    </div>
</div>
