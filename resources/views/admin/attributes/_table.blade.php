<div class="table-container" id="attributes-table">
    <table class="w-full">
        <thead>
            <tr class="border-b border-gray-700">
                <th class="py-3 text-left text-gray-400">ID</th>
                <th class="py-3 text-left text-gray-400">Name</th>
                <th class="py-3 text-left text-gray-400">Values</th>
                <th class="py-3 text-left text-gray-400">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attributes as $attribute)
                <tr class="border-b border-gray-800 hover:bg-gray-800">
                    <td class="py-4 text-white">#{{ $attribute->id }}</td>
                    <td class="py-4 text-gray-300 font-medium">{{ $attribute->name }}</td>
                    <td class="py-4">
                        <div class="flex flex-wrap gap-2">
                            @forelse($attribute->values as $value)
                                <span class="bg-gray-700 text-gray-300 px-2 py-1 rounded text-sm">{{ $value->value }}</span>
                            @empty
                                <span class="text-gray-500 text-sm">No values</span>
                            @endforelse
                        </div>
                    </td>
                    <td class="py-4">
                        <button class="text-neon hover:text-purple-400 mr-3" onclick="openEditModal({{ $attribute->id }}, '{{ $attribute->name }}', {{ $attribute->values->toJson() }})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="text-red-500 hover:text-red-400" onclick="deleteAttribute({{ $attribute->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="py-8 text-center text-gray-400">No attributes found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="flex justify-between items-center mt-6">
    <p class="text-gray-400">Showing {{ $attributes->firstItem() ?? 0 }} to {{ $attributes->lastItem() ?? 0 }} of {{ $attributes->total() }} attributes</p>
    <div class="flex space-x-2" id="pagination-links">
        {{ $attributes->appends(request()->query())->links('partials._pagination') }}
    </div>
</div>
