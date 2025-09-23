@if ($paginator->hasPages())
    <nav class="flex items-center justify-center space-x-2">
        @if ($paginator->onFirstPage())
            <span class="px-3 py-2 bg-gray-800 text-gray-500 rounded-lg cursor-not-allowed">
                <i class="fas fa-chevron-left"></i>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-2 bg-gray-800 text-white hover:bg-neon/20 hover:text-neon rounded-lg transition">
                <i class="fas fa-chevron-left"></i>
            </a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-3 py-2 bg-gray-800 text-gray-500 rounded-lg">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-2 bg-neon text-black font-bold rounded-lg">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-2 bg-gray-800 text-white hover:bg-neon/20 hover:text-neon rounded-lg transition">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-2 bg-gray-800 text-white hover:bg-neon/20 hover:text-neon rounded-lg transition">
                <i class="fas fa-chevron-right"></i>
            </a>
        @else
            <span class="px-3 py-2 bg-gray-800 text-gray-500 rounded-lg cursor-not-allowed">
                <i class="fas fa-chevron-right"></i>
            </span>
        @endif
    </nav>
@endif
