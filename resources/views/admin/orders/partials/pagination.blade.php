<div class="flex justify-between items-center">
    <p class="text-gray-400">
        Showing {{ $orders->firstItem() ?? 0 }} to {{ $orders->lastItem() ?? 0 }} of {{ $orders->total() }} orders
    </p>
    
    @if($orders->hasPages())
    <div class="flex space-x-2">
        @if ($orders->onFirstPage())
            <button class="px-3 py-1 rounded bg-gray-700 text-gray-500 cursor-not-allowed">
                <i class="fas fa-chevron-left"></i>
            </button>
        @else
            <a href="{{ $orders->appends(request()->query())->previousPageUrl() }}" class="px-3 py-1 rounded bg-gray-700 text-white hover:bg-gray-600">
                <i class="fas fa-chevron-left"></i>
            </a>
        @endif

        @foreach ($orders->appends(request()->query())->getUrlRange(1, $orders->lastPage()) as $page => $url)
            @if ($page == $orders->currentPage())
                <button class="px-3 py-1 rounded bg-neon text-black font-bold">{{ $page }}</button>
            @else
                <a href="{{ $url }}" class="px-3 py-1 rounded bg-gray-700 text-white hover:bg-gray-600">{{ $page }}</a>
            @endif
        @endforeach

        @if ($orders->hasMorePages())
            <a href="{{ $orders->appends(request()->query())->nextPageUrl() }}" class="px-3 py-1 rounded bg-gray-700 text-white hover:bg-gray-600">
                <i class="fas fa-chevron-right"></i>
            </a>
        @else
            <button class="px-3 py-1 rounded bg-gray-700 text-gray-500 cursor-not-allowed">
                <i class="fas fa-chevron-right"></i>
            </button>
        @endif
    </div>
    @endif
</div>
