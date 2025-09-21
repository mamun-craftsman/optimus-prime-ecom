<div class="bg-gray-900 bg-opacity-80 backdrop-blur-sm border-b border-gray-800 sticky top-0 z-30">
    <div class="container mx-auto px-2 sm:px-4 py-2">
        <div class="flex flex-col gap-2">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold logo-text text-white glow-text truncate px-2">
                        OPTIMUS PRIME
                    </h1>
                </div>
                <div class="search-container flex items-center px-3 py-2 flex-grow max-w-md mx-4">
                    <i class="fas fa-search text-gray-400 mr-2 text-sm"></i>
                    <input type="text" placeholder="Search products..." class="bg-transparent text-white w-full focus:outline-none text-sm placeholder:text-gray-400">
                </div>
                <div class="flex items-center space-x-2 md:hidden">
                    <button id="menuButton" class="mobile-menu-btn p-2 rounded-lg" onclick="toggleMenuPopup()" aria-label="Open menu">
                        <i class="fas fa-ellipsis-v text-base"></i>
                    </button>
                    <button class="mobile-menu-btn p-2 rounded-lg" onclick="toggleSidebar()" aria-label="Open categories menu">
                        <i class="fas fa-bars text-base"></i>
                    </button>
                </div>
                <div class="hidden md:flex items-center space-x-2">
                    <button id="userMenuBtn" class="nav-btn px-2 lg:px-3 py-2 rounded-lg text-white text-xs lg:text-sm whitespace-nowrap" onclick="toggleUserMenu()" aria-label="Open user menu">
                        <i class="fas fa-user mr-1"></i> 
                        <span class="hidden lg:inline">Account</span>
                    </button>
                </div>
            </div>
            <div class="relative">
                <button id="scrollLeft" class="absolute left-0 top-1/2 transform -translate-y-1/2 z-10 bg-white hover:bg-gray-700 p-2 rounded-full shadow-lg w-10 h-10">
                    <i class="fas fa-chevron-left text-base"></i>
                </button>
                <div id="categoryScroll" class="flex overflow-x-auto hide-scrollbar scroll-smooth">
                    <div class="flex space-x-1 px-8 mt-1">
                        @if(isset($globalCategories) && $globalCategories->count() > 0)
                            @foreach($globalCategories as $category)
                                <a href="{{ route('subcategory.show', $category->slug) }}" class="brand-btn px-4 py-2 rounded-full text-white whitespace-nowrap {{ $loop->first ? 'active' : '' }} text-xs sm:text-sm min-w-fit">
                                    <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->name }}" class="w-4 h-4 inline mr-1 rounded object-contain object-center">
                                    <span class="hidden sm:inline">{{ $category->name }}</span>
                                    <span class="sm:hidden">{{ Str::limit($category->name, 4) }}</span>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>


                <button id="scrollRight" class="absolute right-0 top-1/2 transform -translate-y-1/2 z-10 bg-white hover:bg-gray-700 p-2 rounded-full shadow-lg w-10 h-10">
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
</script>
@endpush
