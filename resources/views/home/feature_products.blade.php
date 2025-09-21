<div class="dashboard-content container mx-auto px-4 py-8">
    @include('components.home_hero')

    <!-- Page Title -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-white mb-2">Featured Products</h2>
        <p class="text-gray-400">Discover the latest smartphones and accessories</p>
    </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6">
        <!-- Product 1 -->
        <div class="product-card neon-border">
            <div class="product-image">
                <div
                    class="bg-gray-800 border-2 border-dashed rounded-xl w-32 h-32 flex items-center justify-center text-gray-500">
                    <i class="fas fa-mobile-alt text-4xl"></i>
                </div>
            </div>
            <div class="p-4">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="text-xl font-bold text-white">iPhone 15 Pro</h3>
                    <span class="price-tag">$1,199</span>
                </div>
                <p class="text-gray-400 mb-4">Latest flagship with A17 chip and titanium design</p>
                <div class="flex justify-between items-center">
                    <div class="flex items-center text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <span class="text-white ml-1">4.7</span>
                    </div>
                    <button class="cart-btn px-4 py-2 rounded-lg text-white">
                        <i class="fas fa-shopping-cart mr-2"></i> Add
                    </button>
                </div>
            </div>
        </div>
        <!-- Product 2 -->
        <div class="product-card neon-border">
            <div class="product-image">
                <div
                    class="bg-gray-800 border-2 border-dashed rounded-xl w-32 h-32 flex items-center justify-center text-gray-500">
                    <i class="fas fa-tablet-alt text-4xl"></i>
                </div>
            </div>
            <div class="p-4">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="text-xl font-bold text-white">Samsung Galaxy Tab S9</h3>
                    <span class="price-tag">$899</span>
                </div>
                <p class="text-gray-400 mb-4">11-inch tablet with S Pen and powerful performance</p>
                <div class="flex justify-between items-center">
                    <div class="flex items-center text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <span class="text-white ml-1">4.2</span>
                    </div>
                    <button class="cart-btn px-4 py-2 rounded-lg text-white">
                        <i class="fas fa-shopping-cart mr-2"></i> Add
                    </button>
                </div>
            </div>
        </div>
        <!-- Product 3 -->
        <div class="product-card neon-border">
            <div class="product-image">
                <div
                    class="bg-gray-800 border-2 border-dashed rounded-xl w-32 h-32 flex items-center justify-center text-gray-500">
                    <i class="fas fa-headphones text-4xl"></i>
                </div>
            </div>
            <div class="p-4">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="text-xl font-bold text-white">Sony WH-1000XM5</h3>
                    <span class="price-tag">$349</span>
                </div>
                <p class="text-gray-400 mb-4">Industry-leading noise canceling headphones</p>
                <div class="flex justify-between items-center">
                    <div class="flex items-center text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span class="text-white ml-1">4.9</span>
                    </div>
                    <button class="cart-btn px-4 py-2 rounded-lg text-white">
                        <i class="fas fa-shopping-cart mr-2"></i> Add
                    </button>
                </div>
            </div>
        </div>
        <!-- Product 4 -->
        <div class="product-card neon-border">
            <div class="product-image">
                <div
                    class="bg-gray-800 border-2 border-dashed rounded-xl w-32 h-32 flex items-center justify-center text-gray-500">
                    <i class="fas fa-gamepad text-4xl"></i>
                </div>
            </div>
            <div class="p-4">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="text-xl font-bold text-white">PlayStation 5</h3>
                    <span class="price-tag">$499</span>
                </div>
                <p class="text-gray-400 mb-4">Next-gen console with ultra-high speed SSD</p>
                <div class="flex justify-between items-center">
                    <div class="flex items-center text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <span class="text-white ml-1">4.6</span>
                    </div>
                    <button class="cart-btn px-4 py-2 rounded-lg text-white">
                        <i class="fas fa-shopping-cart mr-2"></i> Add
                    </button>
                </div>
            </div>
        </div>
        <!-- Product 5 -->
        <div class="product-card neon-border">
            <div class="product-image">
                <div
                    class="bg-gray-800 border-2 border-dashed rounded-xl w-32 h-32 flex items-center justify-center text-gray-500">
                    <i class="fas fa-mobile-alt text-4xl"></i>
                </div>
            </div>
            <div class="p-4">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="text-xl font-bold text-white">Google Pixel 8</h3>
                    <span class="price-tag">$799</span>
                </div>
                <p class="text-gray-400 mb-4">AI-powered camera and Tensor G3 chip</p>
                <div class="flex justify-between items-center">
                    <div class="flex items-center text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <span class="text-white ml-1">4.3</span>
                    </div>
                    <button class="cart-btn px-4 py-2 rounded-lg text-white">
                        <i class="fas fa-shopping-cart mr-2"></i> Add
                    </button>
                </div>
            </div>
        </div>
        <!-- Product 6 -->
        <div class="product-card neon-border">
            <div class="product-image">
                <div
                    class="bg-gray-800 border-2 border-dashed rounded-xl w-32 h-32 flex items-center justify-center text-gray-500">
                    <i class="fas fa-laptop text-4xl"></i>
                </div>
            </div>
            <div class="p-4">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="text-xl font-bold text-white">MacBook Air M2</h3>
                    <span class="price-tag">$1,099</span>
                </div>
                <p class="text-gray-400 mb-4">Supercharged by M2 chip with all-day battery</p>
                <div class="flex justify-between items-center">
                    <div class="flex items-center text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span class="text-white ml-1">4.8</span>
                    </div>
                    <button class="cart-btn px-4 py-2 rounded-lg text-white">
                        <i class="fas fa-shopping-cart mr-2"></i> Add
                    </button>
                </div>
            </div>
        </div>
        <!-- Product 7 -->
        <div class="product-card neon-border">
            <div class="product-image">
                <div
                    class="bg-gray-800 border-2 border-dashed rounded-xl w-32 h-32 flex items-center justify-center text-gray-500">
                    <i class="fas fa-watch text-4xl"></i>
                </div>
            </div>
            <div class="p-4">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="text-xl font-bold text-white">Apple Watch Series 9</h3>
                    <span class="price-tag">$399</span>
                </div>
                <p class="text-gray-400 mb-4">Double tap gesture and brighter display</p>
                <div class="flex justify-between items-center">
                    <div class="flex items-center text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <span class="text-white ml-1">4.5</span>
                    </div>
                    <button class="cart-btn px-4 py-2 rounded-lg text-white">
                        <i class="fas fa-shopping-cart mr-2"></i> Add
                    </button>
                </div>
            </div>
        </div>
        <!-- Product 8 -->
        <div class="product-card neon-border">
            <div class="product-image">
                <div
                    class="bg-gray-800 border-2 border-dashed rounded-xl w-32 h-32 flex items-center justify-center text-gray-500">
                    <i class="fas fa-camera text-4xl"></i>
                </div>
            </div>
            <div class="p-4">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="text-xl font-bold text-white">Sony Alpha 7 IV</h3>
                    <span class="price-tag">$2,499</span>
                </div>
                <p class="text-gray-400 mb-4">Full-frame mirrorless camera with 33MP sensor</p>
                <div class="flex justify-between items-center">
                    <div class="flex items-center text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <span class="text-white ml-1">4.4</span>
                    </div>
                    <button class="cart-btn px-4 py-2 rounded-lg text-white">
                        <i class="fas fa-shopping-cart mr-2"></i> Add
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-12 text-center">
        <button
            class="px-8 py-3 rounded-lg text-white bg-gradient-to-r from-purple-600 to-cyan-500 hover:from-purple-700 hover:to-cyan-600 transition-all">
            <i class="fas fa-sync-alt mr-2"></i> Load More Products
        </button>
    </div>
</div>
