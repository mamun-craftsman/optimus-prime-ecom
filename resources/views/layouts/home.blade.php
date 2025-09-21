<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OPTIMUS PRIME - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700;900&family=Exo+2:wght@300;400;600;700&display=swap"
        rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0f172a',
                        secondary: '#1e293b',
                        accent: '#00f7ff',
                        neon: '#00f7ff',
                        purple: '#8b5cf6',
                        dark: '#0c111b',
                        sidebar: '#0a0f1a'
                    },
                    fontFamily: {
                        'orbitron': ['Orbitron', 'sans-serif'],
                        'exo': ['Exo 2', 'sans-serif']
                    },
                    animation: {
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'float': 'float 6s ease-in-out infinite',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                        'slide-in': 'slideIn 0.5s ease-out forwards',
                        'slide-out': 'slideOut 0.5s ease-out forwards',
                        'sidebar-in': 'sidebarIn 0.3s ease-out forwards',
                        'sidebar-out': 'sidebarOut 0.3s ease-out forwards',
                        'fade-in': 'fadeIn 0.3s ease-out forwards',
                        'mega-slide-in': 'megaSlideIn 0.3s ease-out forwards',
                        'mega-slide-out': 'megaSlideOut 0.3s ease-out forwards'
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0)'
                            },
                            '50%': {
                                transform: 'translateY(-10px)'
                            }
                        },
                        glow: {
                            '0%': {
                                boxShadow: '0 0 5px #00f7ff, 0 0 10px #00f7ff'
                            },
                            '100%': {
                                boxShadow: '0 0 20px #00f7ff, 0 0 30px #00f7ff'
                            }
                        },
                        slideIn: {
                            '0%': {
                                transform: 'translateX(100%)',
                                opacity: '0'
                            },
                            '100%': {
                                transform: 'translateX(0)',
                                opacity: '1'
                            }
                        },
                        slideOut: {
                            '0%': {
                                transform: 'translateX(0)',
                                opacity: '1'
                            },
                            '100%': {
                                transform: 'translateX(100%)',
                                opacity: '0'
                            }
                        },
                        sidebarIn: {
                            '0%': {
                                transform: 'translateX(-100%)'
                            },
                            '100%': {
                                transform: 'translateX(0)'
                            }
                        },
                        sidebarOut: {
                            '0%': {
                                transform: 'translateX(0)'
                            },
                            '100%': {
                                transform: 'translateX(-100%)'
                            }
                        },
                        fadeIn: {
                            '0%': {
                                opacity: '0'
                            },
                            '100%': {
                                opacity: '1'
                            }
                        },
                        megaSlideIn: {
                            '0%': {
                                transform: 'translateX(-10px)',
                                opacity: '0'
                            },
                            '100%': {
                                transform: 'translateX(0)',
                                opacity: '1'
                            }
                        },
                        megaSlideOut: {
                            '0%': {
                                transform: 'translateX(0)',
                                opacity: '1'
                            },
                            '100%': {
                                transform: 'translateX(-10px)',
                                opacity: '0'
                            }
                        }
                    }
                }
            }
        }
    </script>
    <style>
        html,
        body {
            overflow-x: hidden;
            max-width: 100vw;
        }

        body {
            background: linear-gradient(135deg, #0c111b 0%, #1e293b 100%);
            min-height: 100vh;
            font-family: 'Exo 2', 'sans-serif';
            display: flex;
            flex-direction: column;
        }

        .main-content-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .dashboard-content {
            flex: 1;
        }

        * {
            transition-property: transform, opacity, background-color, border-color;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        }

        .logo-text {
            font-family: 'Orbitron', 'sans-serif';
            letter-spacing: 2px;
        }

        .glow-text {
            text-shadow: 0 0 10px #00f7ff, 0 0 20px #00f7ff;
        }

        .pulse-glow {
            animation: glow 2s ease-in-out infinite alternate;
        }

        .neon-border {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
        }

        .neon-border::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 12px;
            padding: 2px;
            background: linear-gradient(45deg, #00f7ff, #8b5cf6, #00f7ff);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            z-index: -1;
        }

        .sidebar {
            background: rgba(10, 15, 26, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .sidebar-categories {
            flex: 1;
            overflow-y: hidden;
            transition: all 0.3s ease;
        }

        .sidebar:hover .sidebar-categories {
            overflow-y: auto;
        }

        .sidebar-categories::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-categories::-webkit-scrollbar-track {
            background: rgba(15, 23, 42, 0.3);
            border-radius: 3px;
        }

        .sidebar-categories::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #00f7ff, #8b5cf6);
            border-radius: 3px;
        }

        .sidebar-fixed-footer {
            flex-shrink: 0;
        }

        .category-item {
            position: relative;
        }

        .category-btn {
            transition: all 0.3s ease;
            width: 100%;
            text-align: left;
            display: block;
        }

        .category-btn:hover {
            background: rgba(0, 247, 255, 0.2);
            border-color: #00f7ff;
        }

        .category-btn.active {
            background: linear-gradient(45deg, #00f7ff, #8b5cf6);
            color: white;
        }

        .toggle-mega-btn {
            background: rgba(30, 41, 59, 0.5);
            border: none;
            color: #94a3b8;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-left: 2px;
            padding: 8px;
        }

        .toggle-mega-btn:hover {
            background: rgba(0, 247, 255, 0.3);
            color: #00f7ff;
        }

        .toggle-mega-btn.active {
            background: rgba(0, 247, 255, 0.5);
            color: #00f7ff;
            transform: rotate(90deg);
        }

        .sidebar-overlay {
            background: rgba(0, 0, 0, 0.7);
            z-index: 45;
        }

        .nav-btn {
            background: rgba(30, 41, 59, 0.7);
            border: 1px solid rgba(129, 140, 153, 0.3);
            transition: all 0.3s ease;
        }

        .nav-btn:hover {
            background: rgba(0, 247, 255, 0.2);
            border-color: #00f7ff;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .sidebar-categories {
                overflow-y: auto;
            }
        }

        .brand-btn {
            background: rgba(30, 41, 59, 0.7);
            border: 1px solid rgba(129, 140, 153, 0.3);
            transition: all 0.3s ease;
        }

        .brand-btn:hover {
            background: rgba(0, 247, 255, 0.2);
            border-color: #00f7ff;
            transform: translateY(-2px);
        }

        .brand-btn.active {
            background: rgba(0, 247, 255, 0.2);
            border-color: #00f7ff;
        }

        .product-card {
            background: rgba(15, 23, 42, 0.8);
            border-radius: 12px;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .product-image {
            height: 200px;
            background: linear-gradient(45deg, #1e293b, #0f172a);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .product-image::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(0, 247, 255, 0.1), transparent);
            transform: rotate(45deg);
            transition: all 0.5s ease;
        }

        .product-card:hover .product-image::before {
            transform: rotate(45deg) translate(20%, 20%);
        }

        .price-tag {
            background: linear-gradient(45deg, #00f7ff, #8b5cf6);
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: bold;
            display: inline-block;
        }

        .cart-btn {
            background: linear-gradient(45deg, #00f7ff, #8b5cf6);
            transition: all 0.3s ease;
        }

        .cart-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 247, 255, 0.4);
        }

        .search-container {
            background: rgba(15, 23, 42, 0.8);
            border-radius: 50px;
            border: 1px solid rgba(129, 140, 153, 0.3);
        }

        .search-container:focus-within {
            border-color: #00f7ff;
            box-shadow: 0 0 0 3px rgba(0, 247, 255, 0.2);
        }

        .floating-element {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.4;
            z-index: -1;
            will-change: transform;
            transform: translateZ(0);
        }

        .floating-1 {
            width: 300px;
            height: 300px;
            background: #00f7ff;
            top: 10%;
            left: 5%;
            animation: float 8s ease-in-out infinite;
        }

        .floating-2 {
            width: 200px;
            height: 200px;
            background: #8b5cf6;
            bottom: 10%;
            right: 5%;
            animation: float 10s ease-in-out infinite;
        }

        .floating-3 {
            width: 150px;
            height: 150px;
            background: #00f7ff;
            top: 40%;
            right: 20%;
            animation: float 12s ease-in-out infinite;
        }

        .mega-menu-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 9999;
        }

        .mega-menu {
            position: absolute;
            background: rgba(15, 23, 42, 0.98);
            backdrop-filter: blur(15px);
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.6);
            border: 1px solid rgba(129, 140, 153, 0.3);
            opacity: 0;
            visibility: hidden;
            transform: translateX(-15px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            pointer-events: auto;
            width: 420px;
            max-height: 80vh;
            overflow-y: auto;
            overflow-x: hidden; 
            z-index: 10000;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .mega-menu::-webkit-scrollbar {
            display: none;
        }

        .mega-menu.active {
            opacity: 1;
            visibility: visible;
            transform: translateX(0);
        }

        .mega-menu-header {
            background: linear-gradient(45deg, #00f7ff, #8b5cf6);
            padding: 1rem 1.5rem;
            border-radius: 12px 12px 0 0;
            margin: -1px -1px 0 -1px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .close-mega-btn {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .close-mega-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        .mega-menu-content {
            padding: 1.5rem;
        }

        .mega-menu-content::-webkit-scrollbar {
            width: 4px;
        }

        .mega-menu-content::-webkit-scrollbar-track {
            background: rgba(30, 41, 59, 0.3);
            border-radius: 2px;
        }

        .mega-menu-content::-webkit-scrollbar-thumb {
            background: rgba(0, 247, 255, 0.5);
            border-radius: 2px;
        }

        .brand-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
        }

        .brand-item {
            padding: 0.75rem 1rem;
            background: rgba(30, 41, 59, 0.4);
            border: 1px solid rgba(129, 140, 153, 0.2);
            border-radius: 8px;
            color: #e2e8f0;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
        }

        .brand-item:hover {
            background: rgba(0, 247, 255, 0.15);
            border-color: #00f7ff;
            color: #00f7ff;
            transform: translateY(-2px);
        }

        .brand-icon {
            width: 20px;
            height: 20px;
            background: rgba(0, 247, 255, 0.2);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            color: #00f7ff;
        }
    </style>
    @stack('styles')
</head>

<body>
    <div class="floating-element floating-1"></div>
    <div class="floating-element floating-2"></div>
    <div class="floating-element floating-3"></div>
    
    <div id="megaMenuContainer" class="mega-menu-container hidden">
        <div id="activeMegaMenu" class="mega-menu">
            <div class="mega-menu-header">
                <h3 class="text-lg font-bold text-white" id="megaMenuTitle">Category Brands</h3>
                <button class="close-mega-btn" onclick="closeMegaMenu()">
                    <i class="fas fa-times text-xs"></i>
                </button>
            </div>
            <div class="mega-menu-content" id="megaMenuContent">
            </div>
        </div>
    </div>

    <div class="main-content-wrapper">
        <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-70 z-45 hidden" onclick="toggleSidebar()">
        </div>

        <div id="categorySidebar"
            class="sidebar fixed top-0 left-0 w-64 z-50 transform -translate-x-full md:translate-x-0">
            <div class="flex-shrink-0 p-6 border-b border-gray-700">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold logo-text text-white glow-text">CATEGORIES</h2>
                    <button class="md:hidden text-white" onclick="toggleSidebar()" aria-label="Close categories menu">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>

            <div class="sidebar-categories p-4">
                <ul class="space-y-2" role="menu">
                    @if (isset($globalCategories) && $globalCategories->count() > 0)
                        @foreach ($globalCategories as $category)
                            <li class="category-item">
                                <div class="flex items-center">
                                    <a href="{{ route('category.show', $category->slug) }}"
                                        class="category-btn px-4 py-3 rounded-lg text-white transition-all hover:bg-gray-800/50 {{ $loop->first ? 'active' : '' }}"
                                        role="menuitem">
                                        <div class="flex items-center gap-3">
                                            @if ($category->icon)
                                                <img src="{{ asset('storage/' . $category->icon) }}"
                                                    alt="{{ $category->name }}" class="w-6 h-6 object-contain">
                                            @else
                                                <i class="fas fa-tag text-neon"></i>
                                            @endif
                                            <span>{{ $category->name }}</span>
                                        </div>
                                    </a>
                                    
                                    @if ($category->subcategories && $category->subcategories->count() > 0)
                                        <button class="toggle-mega-btn" 
                                                data-category-id="{{ $category->id }}"
                                                data-category-name="{{ $category->name }}"
                                                onclick="toggleMegaMenu(this)">
                                            <i class="fas fa-chevron-right text-xs"></i>
                                        </button>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    @else
                        <li class="category-item">
                            <a href="#"
                                class="category-btn px-4 py-3 rounded-lg text-white block active"
                                role="menuitem">
                                <i class="fas fa-mobile-alt mr-3 text-neon"></i>
                                <span>No Categories Available</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="sidebar-fixed-footer p-4 border-t border-gray-700">
                <a href="{{ route('cart.index') }}"
                    class="w-full block py-3 text-center rounded-lg text-white bg-gradient-to-r from-purple-600 to-cyan-500 hover:from-purple-700 hover:to-cyan-600 transition-all">
                    <i class="fas fa-shopping-cart mr-2"></i> View Cart
                </a>
            </div>
        </div>

        <div class="md:ml-64">
            @yield('content')
        </div>
        @include('components.home_footer')
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('categorySidebar');
            const overlay = document.getElementById('sidebarOverlay');
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                closeMegaMenu();
            }
        }

        function toggleMegaMenu(button) {
            const container = document.getElementById('megaMenuContainer');
            const megaMenu = document.getElementById('activeMegaMenu');
            const title = document.getElementById('megaMenuTitle');
            const content = document.getElementById('megaMenuContent');
            
            const categoryId = button.getAttribute('data-category-id');
            const categoryName = button.getAttribute('data-category-name');
            
            const isActive = button.classList.contains('active');
            
            document.querySelectorAll('.toggle-mega-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            
            if (isActive) {
                closeMegaMenu();
                return;
            }
            
            button.classList.add('active');
            
            const sidebar = document.getElementById('categorySidebar');
            const sidebarRect = sidebar.getBoundingClientRect();
            const buttonRect = button.getBoundingClientRect();
            
            megaMenu.style.left = sidebarRect.right + 16 + 'px';
            megaMenu.style.top = buttonRect.top + 'px';
            
            const viewportHeight = window.innerHeight;
            const menuHeight = 400;
            
            if (buttonRect.top + menuHeight > viewportHeight) {
                megaMenu.style.top = Math.max(10, viewportHeight - menuHeight - 10) + 'px';
            }
            
            title.textContent = categoryName + ' Brands';
            
            let html = '<div class="brand-grid">';
            
            @if (isset($globalCategories) && $globalCategories->count() > 0)
                @foreach ($globalCategories as $category)
                    if (categoryId == "{{ $category->id }}") {
                        @foreach ($category->subcategories as $subcategory)
                            html += `
                                <a href="{{ route('subcategory.show', $subcategory->slug) }}" class="brand-item">
                                    <div class="brand-icon">
                                        @if ($subcategory->icon)
                                            <img src="{{ asset('storage/' . $subcategory->icon) }}" alt="{{ $subcategory->name }}" class="w-4 h-4 object-contain">
                                        @else
                                            <i class="fas fa-cube text-xs"></i>
                                        @endif
                                    </div>
                                    {{ $subcategory->name }}
                                </a>
                            `;
                        @endforeach
                    }
                @endforeach
            @endif
            
            html += '</div>';
            content.innerHTML = html;
            
            container.classList.remove('hidden');
            setTimeout(() => {
                megaMenu.classList.add('active');
            }, 10);
        }

        function closeMegaMenu() {
            const container = document.getElementById('megaMenuContainer');
            const megaMenu = document.getElementById('activeMegaMenu');
            
            document.querySelectorAll('.toggle-mega-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            
            megaMenu.classList.remove('active');
            
            setTimeout(() => {
                container.classList.add('hidden');
            }, 300);
        }

        document.addEventListener('click', function(event) {
            const megaMenu = document.getElementById('activeMegaMenu');
            const toggleButtons = document.querySelectorAll('.toggle-mega-btn');
            const isClickInsideMegaMenu = megaMenu.contains(event.target);
            const isClickOnToggleButton = Array.from(toggleButtons).some(btn => btn.contains(event.target));
            
            if (!isClickInsideMegaMenu && !isClickOnToggleButton && !megaMenu.classList.contains('hidden')) {
                closeMegaMenu();
            }
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeMegaMenu();
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.body.style.overflowX = 'hidden';
        });

        const style = document.createElement('style');
        style.innerHTML = `
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    `;
        document.head.appendChild(style);
    </script>
    @stack('scripts')
</body>

</html>