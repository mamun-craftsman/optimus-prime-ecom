@extends('layouts.home')

@push('styles')
    <style>
        .btn-primary {
            background: linear-gradient(45deg, #00f7ff, #8b5cf6);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 247, 255, 0.3);
        }

        .btn-primary::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -60%;
            width: 20px;
            height: 200%;
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(30deg);
            transition: all 0.6s;
        }

        .btn-primary:hover::after {
            left: 120%;
        }

        .btn-secondary {
            background: rgba(30, 41, 59, 0.7);
            border: 1px solid rgba(129, 140, 153, 0.3);
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: rgba(0, 247, 255, 0.2);
            border-color: #00f7ff;
            transform: translateY(-2px);
        }

        .product-slider {
            position: relative;
            overflow: hidden;
            border-radius: 16px;
        }

        .slider-wrapper {
            display: flex;
            transition: transform 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .slide {
            min-width: 100%;
            aspect-ratio: 1;
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.9), rgba(15, 23, 42, 0.95));
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 16px;
        }

        .slider-nav {
            position: absolute;
            width: 40px;
            height: 40px;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.7);
            border: none;
            color: white;
            padding: 12px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 10;
            backdrop-filter: blur(10px);
        }

        .slider-nav:hover {
            background: rgba(0, 247, 255, 0.8);
            transform: translateY(-50%) scale(1.1);
        }

        .prev {
            left: 20px;
        }

        .next {
            right: 20px;
        }

        .thumbnail-container {
            display: flex;
            gap: 6px;
            margin-top: 8px;
            overflow-x: auto;
            padding: 2px 0;
            height: 80px;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .thumbnail-container::-webkit-scrollbar {
            display: none;
        }

        .thumbnail {
            min-width: 75px;
            width: 75px;
            height: 75px;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid transparent;
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.9), rgba(15, 23, 42, 0.95));
            flex-shrink: 0;
        }

        .thumbnail:hover,
        .thumbnail.active {
            border-color: #00f7ff;
            box-shadow: 0 4px 15px rgba(0, 247, 255, 0.3);
        }

        .thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .storage-btn,
        .color-btn {
            transition: all 0.3s ease;
        }

        .storage-btn.active {
            background: linear-gradient(45deg, #00f7ff, #8b5cf6);
            transform: translateY(-2px);
        }

        .color-btn {
            position: relative;
            overflow: hidden;
        }

        .color-btn.active::after {
            content: '';
            position: absolute;
            inset: -3px;
            border: 3px solid #00f7ff;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.1);
                opacity: 0.7;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .quantity-btn {
            background: rgba(30, 41, 59, 0.7);
            border: 1px solid rgba(129, 140, 153, 0.3);
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            color: white;
        }

        .quantity-btn:hover {
            background: rgba(0, 247, 255, 0.2);
            border-color: #00f7ff;
            transform: scale(1.05);
        }

        .tab-btn {
            transition: all 0.3s ease;
            position: relative;
        }

        .tab-btn.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(45deg, #00f7ff, #8b5cf6);
            border-radius: 2px;
        }

        @media (max-width: 768px) {
            .thumbnail {
                min-width: 50px;
                width: 50px;
                height: 50px;
            }

            .thumbnail-container {
                height: 54px;
                gap: 4px;
            }

            .slider-nav {
                padding: 8px;
            }

            .prev {
                left: 10px;
            }

            .next {
                right: 10px;
            }
        }

        @media (max-width: 640px) {
            .thumbnail {
                min-width: 45px;
                width: 45px;
                height: 45px;
                border-radius: 6px;
            }

            .thumbnail-container {
                height: 49px;
                gap: 3px;
            }
        }

		        .attribute-btn {
            transition: all 0.3s ease;
        }
        
        .attribute-btn.active {
            background: linear-gradient(45deg, #00f7ff, #8b5cf6) !important;
            transform: translateY(-2px);
            border-color: #00f7ff !important;
        }
        
        .color-btn {
    position: relative;
    overflow: visible;
    transition: all 0.3s ease;
}

.color-btn.active::before {
    content: '';
    position: absolute;
    inset: -4px;
    border: 3px solid #00f7ff;
    border-radius: 50%;
    animation: pulse 2s infinite;
    pointer-events: none;
    z-index: 1;
}

.color-btn.active::after {
    content: '';
    position: absolute;
    inset: -8px;
    border: 1px solid rgba(0, 247, 255, 0.3);
    border-radius: 50%;
    animation: pulse-glow 2s infinite;
    pointer-events: none;
    z-index: 0;
}

@keyframes pulse {
    0% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(1.05);
        opacity: 0.8;
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

@keyframes pulse-glow {
    0% {
        transform: scale(1);
        opacity: 0.5;
    }
    50% {
        transform: scale(1.1);
        opacity: 0.2;
    }
    100% {
        transform: scale(1);
        opacity: 0.5;
    }
}
   }
        }
    </style>
@endpush
{{-- @dd($groupedAttributes) --}}

@section('content')
    <div class="container mx-auto px-4 py-4">
        <nav class="text-gray-400">
            <ol class="flex items-center space-x-2 text-sm">
                <li><a href="{{ route('home.index') }}" class="hover:text-neon transition">Home</a></li>
                <li><i class="fas fa-chevron-right text-xs"></i></li>
                <li><a href="#" class="hover:text-neon transition">{{ $product->category->name ?? 'Products' }}</a></li>
                <li><i class="fas fa-chevron-right text-xs"></i></li>
                <li class="text-neon">{{ $product->name }}</li>
            </ol>
        </nav>
    </div>

    <div class="container mx-auto px-2 py-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-6">
            <div class="space-y-3 md:space-y-6">
                <div class="product-slider neon-border" id="productSlider">
                    <div class="slider-wrapper" id="sliderWrapper">
                        @if ($product->primary_image)
                            <div class="slide">
                                <img src="{{ '/storage/' . $product->primary_image }}" alt="{{ $product->name }}"
                                    loading="lazy">
                            </div>
                        @endif
                        @if ($product->secondary_images)
                            @php
                                $secondaryImages = is_array($product->secondary_images)
                                    ? $product->secondary_images
                                    : json_decode($product->secondary_images, true);
                            @endphp
                            @foreach ($secondaryImages as $image)
                                <div class="slide">
                                    <img src="{{ '/storage/' . $image }}" alt="{{ $product->name }}" loading="lazy">
                                </div>
                            @endforeach
                        @endif
                        @if (!$product->primary_image && !$product->secondary_images)
                            <div class="slide">
                                <div class="text-gray-500 text-6xl">
                                    <i class="fas fa-image"></i>
                                </div>
                            </div>
                        @endif
                    </div>

                    <button class="slider-nav prev flex items-center justify-center" id="prevBtn">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="slider-nav next flex items-center justify-center" id="nextBtn">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <div class="thumbnail-container" id="thumbnailContainer">
                    @if ($product->primary_image)
                        <div class="thumbnail active" data-index="0">
                            <img src="{{ '/storage/' . $product->primary_image }}" alt="{{ $product->name }}">
                        </div>
                    @endif
                    @if ($product->secondary_images)
                        @php
                            $secondaryImages = is_array($product->secondary_images)
                                ? $product->secondary_images
                                : json_decode($product->secondary_images, true);
                        @endphp
                        @foreach ($secondaryImages as $index => $image)
                            <div class="thumbnail" data-index="{{ $index + 1 }}">
                                <img src="{{ '/storage/' . $image }}" alt="{{ $product->name }}">
                            </div>
                        @endforeach
                    @endif
                </div>

            </div>

            <div class="space-y-6">
                <div>
                    <h1 class="text-2xl md:text-4xl font-bold text-white mb-4">{{ $product->name }}</h1>
                    <div class="flex items-center gap-4 mb-4">
                        <div class="flex text-yellow-400 text-lg">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star{{ $i <= 4 ? '' : '-half-alt' }}"></i>
                            @endfor
                        </div>
                        <span class="text-gray-400">({{ rand(50, 200) }} Reviews)</span>
                    </div>

                    <div class="flex items-center gap-4 mb-6">
                        <div class="text-2xl md:text-3xl font-bold text-white">
                            ${{ is_numeric($product->price) ? number_format($product->price, 2) : $product->price }}
                        </div>
                        @if (rand(0, 1))
                            <div class="price-tag line-through text-lg">
                                ${{ is_numeric($product->price) ? number_format($product->price * 1.2, 2) : $product->price }}
                            </div>
                            <div class="px-3 py-1 bg-red-500 rounded-full text-white font-bold text-sm">
                                SAVE ${{ is_numeric($product->price) ? number_format($product->price * 0.2, 0) : '50' }}
                            </div>
                        @endif
                    </div>

                    @if ($product->stock > 0)
                        <div class="flex items-center gap-2 mb-6">
                            <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                            <span class="text-green-400 font-medium">In Stock ({{ $product->stock }} items)</span>
                        </div>
                    @else
                        <div class="flex items-center gap-2 mb-6">
                            <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                            <span class="text-red-400 font-medium">Out of Stock</span>
                        </div>
                    @endif
                </div>

				@if($groupedAttributes->isNotEmpty())
					@foreach($groupedAttributes as $attributeName => $attributeValues)
						<div>
							<h3 class="text-xl font-bold text-white mb-4">{{ $attributeName }}</h3>
							<div class="flex flex-wrap gap-3">
								@if(strtolower($attributeName) === 'color' || strtolower($attributeName) === 'colour')
									@foreach($attributeValues as $index => $attributeValue)
										@php
											$colorValue = strtolower($attributeValue->value);
											$gradientColors = [
												'black' => 'from-gray-900 to-black',
												'white' => 'from-gray-100 to-white border-gray-300',
												'red' => 'from-red-400 to-red-600',
												'blue' => 'from-blue-400 to-blue-600',
												'green' => 'from-green-400 to-green-600',
												'yellow' => 'from-yellow-400 to-yellow-600',
												'purple' => 'from-purple-400 to-purple-600',
												'pink' => 'from-pink-400 to-pink-600',
												'orange' => 'from-orange-400 to-orange-600',
												'gray' => 'from-gray-400 to-gray-600',
												'grey' => 'from-gray-400 to-gray-600',
												'brown' => 'from-amber-700 to-amber-900',
												'gold' => 'from-yellow-300 to-yellow-500',
												'silver' => 'from-gray-300 to-gray-500',
												'rose' => 'from-rose-400 to-rose-600',
												'cyan' => 'from-cyan-400 to-cyan-600',
												'lime' => 'from-lime-400 to-lime-600',
												'emerald' => 'from-emerald-400 to-emerald-600',
												'teal' => 'from-teal-400 to-teal-600',
												'indigo' => 'from-indigo-400 to-indigo-600',
												'violet' => 'from-violet-400 to-violet-600',
												'fuchsia' => 'from-fuchsia-400 to-fuchsia-600',
											];
											$gradient = $gradientColors[$colorValue] ?? 'from-gray-400 to-gray-600';
										@endphp
										<button class="color-btn w-12 h-12 rounded-full bg-gradient-to-r {{ $gradient }} border-2 border-white {{ $index === 0 ? 'active' : '' }} relative group"
												data-attribute="{{ $attributeName }}" 
												data-value="{{ $attributeValue->value }}"
												title="{{ ucfirst($attributeValue->value) }}">
											<span class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 text-xs text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">
												{{ ucfirst($attributeValue->value) }}
											</span>
										</button>
									@endforeach
								@else
									@foreach($attributeValues as $index => $attributeValue)
										<button class="attribute-btn px-4 py-2 rounded-lg text-white border border-gray-600 hover:border-neon transition-all {{ $index === 0 ? 'active bg-gradient-to-r from-neon/20 to-purple-500/20' : '' }}"
												data-attribute="{{ $attributeName }}" 
												data-value="{{ $attributeValue->value }}">
											{{ $attributeValue->value }}
										</button>
									@endforeach
								@endif
							</div>
						</div>
					@endforeach
				@endif



                <div class="flex items-center gap-4">
                    <div class="flex items-center border border-gray-600 rounded-lg overflow-hidden">
                        <button class="quantity-btn rounded-l-lg" id="decreaseQty">
                            <i class="fas fa-minus"></i>
                        </button>
                        <input type="text" value="1" id="quantity"
                            class="w-16 text-center bg-gray-800 text-white py-3 border-0 outline-none" readonly>
                        <button class="quantity-btn rounded-r-lg" id="increaseQty">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>

                    <button class="add-to-cart-btn btn-primary px-8 py-3 rounded-lg text-white font-bold flex-1" 
							data-product-id="{{ $product->id }}"
							{{ $product->stock <= 0 ? 'disabled' : '' }}>
						<i class="fas fa-shopping-cart mr-2"></i>
						{{ $product->stock > 0 ? 'Add to Cart' : 'Out of Stock' }}
					</button>

                </div>

                <div class="grid grid-cols-2 gap-4">
                    <button class="btn-secondary px-6 py-3 rounded-lg text-white font-semibold">
                        <i class="fas fa-heart mr-2"></i> Wishlist
                    </button>
                    <button class="btn-secondary px-6 py-3 rounded-lg text-white font-semibold">
                        <i class="fas fa-share-alt mr-2"></i> Share
                    </button>
                </div>

                <div class="border-t border-gray-700 pt-6 space-y-3">
                    <div class="flex items-center text-gray-400">
                        <i class="fas fa-truck mr-3 text-neon"></i>
                        <span>Free shipping on orders over $50</span>
                    </div>
                    <div class="flex items-center text-gray-400">
                        <i class="fas fa-undo mr-3 text-neon"></i>
                        <span>30-day return policy</span>
                    </div>
                    <div class="flex items-center text-gray-400">
                        <i class="fas fa-shield-alt mr-3 text-neon"></i>
                        <span>2-year warranty included</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-16">
            <div class="border-b border-gray-700 mb-8">
                <nav class="flex flex-wrap gap-6">
                    <button class="tab-btn px-6 py-3 text-white font-bold active" data-tab="description">
                        Description
                    </button>
                    <button class="tab-btn px-6 py-3 text-gray-400 hover:text-white" data-tab="specs">
                        Specifications
                    </button>
                    <button class="tab-btn px-6 py-3 text-gray-400 hover:text-white" data-tab="reviews">
                        Reviews
                    </button>
                </nav>
            </div>

            <div class="product-card neon-border p-6 md:p-8">
                <div id="description" class="tab-content">
                    <h2 class="text-2xl font-bold text-white mb-6">Product Description</h2>
                    @if ($product->description)
                        <div class="prose prose-invert max-w-none text-gray-300 mb-6">
                            {!! $product->description !!}
                        </div>
                    @endif

                    @if ($product->key_feature_left || $product->key_feature_right)
                        <h3 class="text-xl font-bold text-white mb-4 mt-8">Key Features</h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            @if ($product->key_feature_left)
                                <div class="prose prose-invert max-w-none text-gray-300">
                                    {!! $product->key_feature_left !!}
                                </div>
                            @endif
                            @if ($product->key_feature_right)
                                <div class="prose prose-invert max-w-none text-gray-300">
                                    {!! $product->key_feature_right !!}
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                <div id="specs" class="tab-content hidden">
                    <h2 class="text-2xl font-bold text-white mb-6">Specifications</h2>
                    <div class="grid md:grid-cols-2 gap-6 text-gray-300">
                        <div>
                            <h4 class="font-semibold text-white mb-2">General</h4>
                            <p>Brand: {{ $product->subcategory->name ?? 'N/A' }}</p>
                            <p>Model: {{ $product->name }}</p>
                            <p>Stock: {{ $product->stock }} items</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-white mb-2">Pricing</h4>
                            <p>Price: ${{ $product->price }}</p>
                            <p>Status: {{ ucfirst($product->status) }}</p>
                        </div>
                    </div>
                </div>

                <div id="reviews" class="tab-content hidden">
                    <h2 class="text-2xl font-bold text-white mb-6">Customer Reviews</h2>
                    <div class="space-y-6">
                        <div class="border-l-4 border-neon pl-6">
                            <div class="flex items-center gap-4 mb-2">
                                <div class="flex text-yellow-400">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                </div>
                                <span class="text-white font-semibold">Amazing Product!</span>
                            </div>
                            <p class="text-gray-300">Great quality and fast delivery. Highly recommended!</p>
                            <p class="text-gray-500 text-sm mt-2">- John Doe, 2 days ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    window.variationMap = @json($variationMap ?? []);
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.getElementById('productSlider');
        const wrapper = document.getElementById('sliderWrapper');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const thumbnails = document.querySelectorAll('.thumbnail');
        const quantityInput = document.getElementById('quantity');
        const decreaseBtn = document.getElementById('decreaseQty');
        const increaseBtn = document.getElementById('increaseQty');
        const tabButtons = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');

        let currentSlide = 0;
        const totalSlides = wrapper.children.length;

        function updateSlider() {
            wrapper.style.transform = `translateX(-${currentSlide * 100}%)`;
            thumbnails.forEach((thumb, index) => {
                thumb.classList.toggle('active', index === currentSlide);
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateSlider();
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            updateSlider();
        }

        prevBtn?.addEventListener('click', prevSlide);
        nextBtn?.addEventListener('click', nextSlide);

        thumbnails.forEach((thumb, index) => {
            thumb.addEventListener('click', () => {
                currentSlide = index;
                updateSlider();
            });
        });

        let autoSlideInterval = setInterval(nextSlide, 4000);

        slider?.addEventListener('mouseenter', () => clearInterval(autoSlideInterval));
        slider?.addEventListener('mouseleave', () => {
            autoSlideInterval = setInterval(nextSlide, 4000);
        });

        decreaseBtn?.addEventListener('click', () => {
            let value = parseInt(quantityInput.value);
            if (value > 1) quantityInput.value = value - 1;
        });

        increaseBtn?.addEventListener('click', () => {
            let value = parseInt(quantityInput.value);
            quantityInput.value = value + 1;
        });

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const targetTab = button.dataset.tab;

                tabButtons.forEach(btn => {
                    btn.classList.remove('active', 'text-white');
                    btn.classList.add('text-gray-400');
                });
                button.classList.add('active', 'text-white');
                button.classList.remove('text-gray-400');

                tabContents.forEach(content => {
                    content.classList.add('hidden');
                });
                document.getElementById(targetTab)?.classList.remove('hidden');
            });
        });

        updateSlider();

        const attributeButtons = document.querySelectorAll('.attribute-btn');
        const colorButtons = document.querySelectorAll('.color-btn');
        
        attributeButtons.forEach(button => {
            button.addEventListener('click', () => {
                const attributeName = button.dataset.attribute;
                
                attributeButtons.forEach(btn => {
                    if (btn.dataset.attribute === attributeName) {
                        btn.classList.remove('active', 'bg-gradient-to-r', 'from-neon/20', 'to-purple-500/20');
                    }
                });
                
                button.classList.add('active', 'bg-gradient-to-r', 'from-neon/20', 'to-purple-500/20');
            });
        });
        
        colorButtons.forEach(button => {
            button.addEventListener('click', () => {
                const attributeName = button.dataset.attribute;
                
                colorButtons.forEach(btn => {
                    if (btn.dataset.attribute === attributeName) {
                        btn.classList.remove('active');
                    }
                });
                
                button.classList.add('active');
            });
        });
        
        function initializeDefaultSelections() {
            const attributeGroups = {};
            
            document.querySelectorAll('.attribute-btn, .color-btn').forEach(btn => {
                const attribute = btn.dataset.attribute;
                if (!attributeGroups[attribute]) {
                    attributeGroups[attribute] = [];
                }
                attributeGroups[attribute].push(btn);
            });
            
            Object.entries(attributeGroups).forEach(([attrName, buttons]) => {
                const hasActiveButton = buttons.some(btn => btn.classList.contains('active'));
                
                if (!hasActiveButton && buttons.length > 0) {
                    const firstButton = buttons[0];
                    if (firstButton.classList.contains('attribute-btn')) {
                        firstButton.classList.add('active', 'bg-gradient-to-r', 'from-neon/20', 'to-purple-500/20');
                    } else if (firstButton.classList.contains('color-btn')) {
                        firstButton.classList.add('active');
                    }
                }
            });
        }
        
        initializeDefaultSelections();
    });
</script>
	<script>
document.addEventListener('click', function(e) {
    if (e.target.closest('.add-to-cart-btn')) {
        e.preventDefault();
        
        const selectedAttributes = {};
        
        document.querySelectorAll('.attribute-btn.active, .color-btn.active').forEach(btn => {
            const attribute = btn.dataset.attribute;
            const value = btn.dataset.value;
            console.log(`Found button: ${btn.textContent.trim()} | attribute: ${attribute} | value: ${value}`);
            if (attribute && value) {
                selectedAttributes[attribute] = value;
            }
        });
        
        console.log('Final selected:', selectedAttributes);
        
        const sortedAttributes = {};
        Object.keys(selectedAttributes).sort().forEach(key => {
            sortedAttributes[key] = selectedAttributes[key];
        });
        
        const signature = JSON.stringify(sortedAttributes);
        console.log('Signature:', signature);
        console.log('VariationMap:', window.variationMap);
        
        if (window.variationMap[signature]) {
            console.log('FOUND:', window.variationMap[signature]);
            // alert('Found variation: ' + window.variationMap[signature]);
        } else {
            console.log('NOT FOUND');
            // alert('No match for: ' + signature);
        }
        
        return false;
    }
});
</script>




	
@endpush
