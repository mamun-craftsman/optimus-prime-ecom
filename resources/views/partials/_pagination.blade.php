@if ($paginator->hasPages())
    @if ($paginator->onFirstPage())
        <button class="px-3 py-1 rounded bg-gray-700 text-gray-500 cursor-not-allowed">
            <i class="fas fa-chevron-left"></i>
        </button>
    @else
        <button class="px-3 py-1 rounded bg-gray-700 text-white hover:bg-gray-600" onclick="loadPage({{ $paginator->currentPage() - 1 }})">
            <i class="fas fa-chevron-left"></i>
        </button>
    @endif

    @foreach ($elements as $element)
        @if (is_string($element))
            <span class="px-3 py-1 rounded bg-gray-700 text-gray-500">{{ $element }}</span>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <button class="px-3 py-1 rounded bg-neon text-black">{{ $page }}</button>
                @else
                    <button class="px-3 py-1 rounded bg-gray-700 text-white hover:bg-gray-600" onclick="loadPage({{ $page }})">{{ $page }}</button>
                @endif
            @endforeach
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
        <button class="px-3 py-1 rounded bg-gray-700 text-white hover:bg-gray-600" onclick="loadPage({{ $paginator->currentPage() + 1 }})">
            <i class="fas fa-chevron-right"></i>
        </button>
    @else
        <button class="px-3 py-1 rounded bg-gray-700 text-gray-500 cursor-not-allowed">
            <i class="fas fa-chevron-right"></i>
        </button>
    @endif
@endif
