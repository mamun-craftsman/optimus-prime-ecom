<div class="dashboard-content container mx-auto px-4 py-8">
    @include('components.home_hero')

    <div class="mb-8">
        <h2 class="text-3xl font-bold text-white mb-2">Featured Products</h2>
        <p class="text-gray-400">Discover the latest smartphones and accessories</p>
    </div>

    <div id="products-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6">
        @include('partials.product_cards', ['products' => $featuredProducts])
    </div>

    @php
        $nextPage = $featuredProducts->currentPage() < $featuredProducts->lastPage()
            ? $featuredProducts->currentPage() + 1
            : null;
    @endphp

    <div class="mt-12 text-center">
        @if($nextPage)
            <button id="load-more"
                class="px-8 py-3 rounded-lg text-white bg-gradient-to-r from-purple-600 to-cyan-500 hover:from-purple-700 hover:to-cyan-600 transition-all"
                data-url="{{ route('home.index') }}"
                data-next="{{ $nextPage }}">
                <i class="fas fa-sync-alt mr-2"></i> Load More Products
            </button>
        @else
            <span class="text-gray-400">No more products</span>
        @endif
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const grid = document.getElementById('products-grid');
    const loadBtn = document.getElementById('load-more');
    if (!loadBtn) return;

    let loading = false;

    loadBtn.addEventListener('click', async function () {
        if (loading) return;
        loading = true;

        const url = loadBtn.dataset.url;
        const page = loadBtn.dataset.next;
        const original = loadBtn.innerHTML;

        loadBtn.disabled = true;
        loadBtn.innerHTML = '<i class="fas fa-sync-alt mr-2 animate-spin"></i> Loading...';

        try {
            const resp = await fetch(`${url}?page=${encodeURIComponent(page)}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
            });

            const data = await resp.json();
            if (data.html) {
                const tmp = document.createElement('div');
                tmp.innerHTML = data.html;
                while (tmp.firstChild) grid.appendChild(tmp.firstChild);
            }

            if (data.hasMore && data.nextPage) {
                loadBtn.dataset.next = data.nextPage;
                loadBtn.disabled = false;
                loadBtn.innerHTML = original;
            } else {
                loadBtn.remove();
            }
        } catch (e) {
            loadBtn.disabled = false;
            loadBtn.innerHTML = original;
            console.error(e);
        } finally {
            loading = false;
        }
    });
});
</script>
@endpush
