<div class="bg-gray-900 bg-opacity-80 backdrop-blur-sm border-b border-gray-800 sticky top-0 z-30">
    <div class="container mx-auto px-2 sm:px-4 py-2">
        <div class="flex flex-col gap-2">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <a href="{{ route('home.index') }}">
                        <h1
                            class="text-xl sm:text-2xl lg:text-3xl font-bold logo-text text-white glow-text truncate px-2">
                            OPTIMUS PRIME
                        </h1>
                    </a>

                </div>
                <div class="search-container relative flex items-center px-3 py-2 flex-grow max-w-md mx-4">
                    <i class="fas fa-search text-gray-400 mr-2 text-sm"></i>
                    <input type="text" id="searchInput" placeholder="Search products..."
                        class="bg-transparent text-white w-full focus:outline-none text-sm placeholder:text-gray-400"
                        autocomplete="off">

                    <!-- Search Results Dropdown -->
                    <div id="searchResults"
                        class="absolute top-full left-0 right-0 bg-gray-800 border border-gray-700 rounded-lg shadow-xl mt-1 max-h-96 overflow-y-auto hidden z-50">
                        <div id="searchResultsContent" class="py-2">
                            <!-- Results will be populated here -->
                        </div>
                        <div id="searchLoading" class="hidden p-4 text-center text-gray-400 text-sm">
                            <i class="fas fa-spinner fa-spin mr-2"></i>
                            Searching...
                        </div>
                        <div id="noResults" class="hidden p-4 text-center text-gray-400 text-sm">
                            No products found
                        </div>
                    </div>
                </div>

                <div class="flex items-center space-x-2 md:hidden">
                    <button id="menuButton" class="mobile-menu-btn p-2 rounded-lg" onclick="toggleMenuPopup()"
                        aria-label="Open menu">
                        <i class="fas fa-ellipsis-v text-base"></i>
                    </button>
                    <button class="mobile-menu-btn p-2 rounded-lg" onclick="toggleSidebar()"
                        aria-label="Open categories menu">
                        <i class="fas fa-bars text-base"></i>
                    </button>
                </div>
                <div class="hidden md:flex items-center space-x-2">
                    <div class="relative">
                        <button id="userMenuBtn"
                            class="nav-btn px-2 lg:px-3 py-2 rounded-lg text-white text-xs lg:text-sm whitespace-nowrap"
                            onclick="toggleUserMenu()" aria-label="Open user menu">
                            <i class="fas fa-user mr-1"></i>
                            <span class="hidden lg:inline">Account</span>
                        </button>

                        <div id="userMenuDropdown"
                            class="absolute right-0 mt-2 w-48 bg-gray-800 border border-gray-700 rounded-lg shadow-lg hidden z-50">
                            <div class="py-1">
                                <a href="{{ route('profile.index') }}"
                                    class="flex items-center px-4 py-2 text-sm text-white hover:bg-gray-700">
                                    <i class="fas fa-user mr-2"></i>
                                    Profile
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center w-full px-4 py-2 text-sm text-white hover:bg-gray-700">
                                        <i class="fas fa-sign-out-alt mr-2"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative">
                <button id="scrollLeft"
                    class="absolute left-0 top-1/2 transform -translate-y-1/2 z-10 bg-white hover:bg-gray-700 p-2 rounded-full shadow-lg w-10 h-10">
                    <i class="fas fa-chevron-left text-base"></i>
                </button>
                <div id="categoryScroll" class="flex overflow-x-auto hide-scrollbar scroll-smooth">
                    <div class="flex space-x-1 px-8 mt-1">
                        @if (isset($globalCategories) && $globalCategories->count() > 0)
                            @foreach ($globalCategories as $category)
                                <a href="{{ route('subcategory.show', $category->slug) }}"
                                    class="brand-btn px-4 py-2 rounded-full text-white whitespace-nowrap {{ $loop->first ? 'active' : '' }} text-xs sm:text-sm min-w-fit">
                                    <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->name }}"
                                        class="w-4 h-4 inline mr-1 rounded object-contain object-center">
                                    <span class="hidden sm:inline">{{ $category->name }}</span>
                                    <span class="sm:hidden">{{ Str::limit($category->name, 4) }}</span>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
                <button id="scrollRight"
                    class="absolute right-0 top-1/2 transform -translate-y-1/2 z-10 bg-white hover:bg-gray-700 p-2 rounded-full shadow-lg w-10 h-10">
                    <i class="fas fa-chevron-right text-base"></i>
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.getElementById('scrollLeft').addEventListener('click', function() {
            document.getElementById('categoryScroll').scrollBy({
                left: -200,
                behavior: 'smooth'
            });
        });

        document.getElementById('scrollRight').addEventListener('click', function() {
            document.getElementById('categoryScroll').scrollBy({
                left: 200,
                behavior: 'smooth'
            });
        });

        let searchTimeout;
        const searchInput = document.getElementById('searchInput');
        const searchResults = document.getElementById('searchResults');
        const searchResultsContent = document.getElementById('searchResultsContent');
        const searchLoading = document.getElementById('searchLoading');
        const noResults = document.getElementById('noResults');

        searchInput.addEventListener('input', function() {
            const query = this.value.trim();

            clearTimeout(searchTimeout);

            if (query.length < 2) {
                hideSearchResults();
                return;
            }

            showLoading();

            searchTimeout = setTimeout(() => {
                performSearch(query);
            }, 300);
        });

        function performSearch(query) {
            fetch(`{{ route('products.search') }}?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(products => {
                    hideLoading();
                    displayResults(products);
                })
                .catch(error => {
                    console.error('Search error:', error);
                    hideLoading();
                    showNoResults();
                });
        }

        function displayResults(products) {
            if (products.length === 0) {
                showNoResults();
                return;
            }

            let html = '';
            products.forEach(product => {
                html += `
            <a href="/product/${product.slug}" class="flex items-center p-3 hover:bg-gray-700 transition-colors duration-200 border-b border-gray-700 last:border-b-0">
                <div class="flex-shrink-0 w-12 h-12 mr-3">
                    <img 
                        src="${product.primary_image ? '/storage/' + product.primary_image : '/images/no-image.png'}" 
                        alt="${product.name}" 
                        class="w-full h-full object-cover rounded"
                        onerror="this.src='/images/no-image.png'"
                    >
                </div>
                <div class="flex-grow min-w-0">
                    <div class="text-white text-sm font-medium truncate">${product.name}</div>
                    <div class="text-blue-400 text-xs font-semibold mt-1">৳${parseFloat(product.price).toFixed(2)}</div>
                </div>
            </a>
        `;
            });

            searchResultsContent.innerHTML = html;
            showSearchResults();
        }

        function showLoading() {
            hideNoResults();
            searchResultsContent.innerHTML = '';
            searchLoading.classList.remove('hidden');
            showSearchResults();
        }

        function hideLoading() {
            searchLoading.classList.add('hidden');
        }

        function showNoResults() {
            searchResultsContent.innerHTML = '';
            noResults.classList.remove('hidden');
            showSearchResults();
        }

        function hideNoResults() {
            noResults.classList.add('hidden');
        }

        function showSearchResults() {
            searchResults.classList.remove('hidden');
        }

        function hideSearchResults() {
            searchResults.classList.add('hidden');
            hideLoading();
            hideNoResults();
            searchResultsContent.innerHTML = '';
        }

        // Hide search results when clicking outside
        document.addEventListener('click', function(event) {
            if (!searchInput.contains(event.target) && !searchResults.contains(event.target)) {
                hideSearchResults();
            }
        });

        function toggleUserMenu() {
            const dropdown = document.getElementById('userMenuDropdown');
            dropdown.classList.toggle('hidden');
        }

        document.addEventListener('click', function(event) {
            const userMenuBtn = document.getElementById('userMenuBtn');
            const userMenuDropdown = document.getElementById('userMenuDropdown');

            if (!userMenuBtn.contains(event.target) && !userMenuDropdown.contains(event.target)) {
                userMenuDropdown.classList.add('hidden');
            }
        });
    </script>
@endpush
