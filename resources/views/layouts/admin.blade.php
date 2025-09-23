<!-- Save as subcategory.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>OPTIMUS PRIME - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700;900&family=Exo+2:wght@300;400;600;700&display=swap" rel="stylesheet">
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
                        'fade-in': 'fadeIn 0.3s ease-out forwards'
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' }
                        },
                        glow: {
                            '0%': { boxShadow: '0 0 5px #00f7ff, 0 0 10px #00f7ff' },
                            '100%': { boxShadow: '0 0 20px #00f7ff, 0 0 30px #00f7ff' }
                        },
                        slideIn: {
                            '0%': { transform: 'translateX(100%)', opacity: '0' },
                            '100%': { transform: 'translateX(0)', opacity: '1' }
                        },
                        slideOut: {
                            '0%': { transform: 'translateX(0)', opacity: '1' },
                            '100%': { transform: 'translateX(100%)', opacity: '0' }
                        },
                        sidebarIn: {
                            '0%': { transform: 'translateX(-100%)' },
                            '100%': { transform: 'translateX(0)' }
                        },
                        sidebarOut: {
                            '0%': { transform: 'translateX(0)' },
                            '100%': { transform: 'translateX(-100%)' }
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' }
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background: linear-gradient(135deg, #0c111b 0%, #1e293b 100%);
            min-height: 100vh;
            overflow-x: hidden;
            font-family: 'Exo 2', sans-serif;
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
        
        .glow-text {
            text-shadow: 0 0 10px #00f7ff, 0 0 20px #00f7ff;
        }
        
        .pulse-glow {
            animation: glow 2s ease-in-out infinite alternate;
        }
        
        .sidebar {
            background: rgba(10, 15, 26, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.5);
        }
        
        .admin-card {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        }
        
        .floating-element {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.6;
            z-index: -1;
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
        
        .logo-text {
            font-family: 'Orbitron', sans-serif;
            letter-spacing: 2px;
        }
        
        .section-title {
            font-family: 'Orbitron', sans-serif;
            letter-spacing: 1px;
        }
        
        .input-field {
            background: rgba(30, 41, 59, 0.7);
            border: 1px solid rgba(129, 140, 153, 0.3);
            transition: all 0.3s ease;
        }
        
        .input-field:focus {
            border-color: #00f7ff;
            box-shadow: 0 0 0 3px rgba(0, 247, 255, 0.2);
        }
        
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
        
        .btn-primary:active {
            transform: translateY(0);
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
        
        .nav-item {
            transition: all 0.3s ease;
        }
        
        .nav-item:hover {
            background: rgba(0, 247, 255, 0.2);
            border-color: #00f7ff;
        }
        
        .nav-item.active {
            background: linear-gradient(45deg, #00f7ff, #8b5cf6);
            color: white;
        }
        
        .table-container {
            max-height: 500px;
            overflow-y: auto;
        }
        
        /* Custom scrollbar */
        .table-container::-webkit-scrollbar {
            width: 8px;
        }
        
        .table-container::-webkit-scrollbar-track {
            background: rgba(30, 41, 59, 0.5);
        }
        
        .table-container::-webkit-scrollbar-thumb {
            background: #00f7ff;
            border-radius: 4px;
        }
        
        .table-container::-webkit-scrollbar-thumb:hover {
            background: #8b5cf6;
        }
        
        .category-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(45deg, #1e293b, #0f172a);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
        
        .modal {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(129, 140, 153, 0.3);
        }
        
        .modal-overlay {
            background: rgba(0, 0, 0, 0.7);
            z-index: 50;
        }
        
        .modal-header {
            border-bottom: 1px solid rgba(129, 140, 153, 0.3);
        }
        
        .close-btn {
            transition: all 0.3s ease;
        }
        
        .close-btn:hover {
            transform: rotate(90deg);
            color: #ef4444;
        }
    </style>
	@stack('styles')
</head>
<body class="font-sans">
    <div class="floating-element floating-1"></div>
    <div class="floating-element floating-2"></div>
    <div class="floating-element floating-3"></div>
    
    <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-70 z-40 hidden" onclick="toggleSidebar()"></div>
    
    <div id="adminSidebar" class="sidebar fixed top-0 left-0 h-full w-64 z-50 transform -translate-x-full md:translate-x-0">
        <div class="p-6 border-b border-gray-700">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold logo-text text-white glow-text">ADMIN PANEL</h2>
                <button class="md:hidden text-white" onclick="toggleSidebar()">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>
        
        <div class="p-4">
            <ul class="space-y-2">
                <li>
                    <a href="{{route('home.index')}}">
                        <button class="nav-item w-full text-left px-4 py-3 rounded-lg text-white">
                            <i class="fa fa-globe mr-3"></i> Visit Site
                        </button>
                    </a>
                </li>
                <li>
                    <button class="nav-item w-full text-left px-4 py-3 rounded-lg text-white" onclick="toggleProductSubmenu()">
                        <i class="fas fa-box mr-3"></i> Products
                        <i class="fas fa-chevron-down float-right mt-1 transition-transform" id="productChevron"></i>
                    </button>
                    <ul class="ml-8 mt-2 space-y-2 hidden" id="productSubmenu">
                        <li>
                            <a href="{{ route('admin.products.index') }}">
                                <button class="nav-item w-full text-left px-4 py-2 rounded-lg text-white text-sm">
                                    <i class="fas fa-list mr-2"></i> All Products
                                </button>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.products.create') }}">
                                <button class="nav-item w-full text-left px-4 py-2 rounded-lg text-white text-sm">
                                    <i class="fas fa-plus mr-2"></i> Create Product
                                </button>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.attributes.index') }}">
                                <button class="nav-item w-full text-left px-4 py-2 rounded-lg text-white text-sm">
                                    <i class="fas fa-cogs mr-2"></i> Attributes
                                </button>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('admin.customers.index')}}">
                        <button class="nav-item w-full text-left px-4 py-3 rounded-lg text-white">
                            <i class="fas fa-users mr-3"></i> Customers
                        </button>
                    </a>
                </li>
                <li>
                    <button class="nav-item w-full text-left px-4 py-3 rounded-lg text-white" onclick="toggleOrderSubmenu()">
                        <i class="fas fa-shopping-cart mr-3"></i> Orders
                        <i class="fas fa-chevron-down float-right mt-1 transition-transform" id="orderChevron"></i>
                    </button>
                    <ul class="ml-8 mt-2 space-y-2 hidden" id="orderSubmenu">
                        <li>
                            <a href="{{ route('admin.orders.index') }}">
                                <button class="nav-item w-full text-left px-4 py-2 rounded-lg text-white text-sm">
                                    <i class="fas fa-list mr-2"></i> All Orders
                                </button>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}">
                                <button class="nav-item w-full text-left px-4 py-2 rounded-lg text-white text-sm">
                                    <i class="fas fa-clock mr-2"></i> Pending Orders
                                </button>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.orders.index', ['status' => 'completed']) }}">
                                <button class="nav-item w-full text-left px-4 py-2 rounded-lg text-white text-sm">
                                    <i class="fas fa-check-circle mr-2"></i> Completed Orders
                                </button>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.orders.index', ['status' => 'cancelled']) }}">
                                <button class="nav-item w-full text-left px-4 py-2 rounded-lg text-white text-sm">
                                    <i class="fas fa-times-circle mr-2"></i> Cancelled Orders
                                </button>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <button class="nav-item w-full text-left px-4 py-3 rounded-lg text-white active" onclick="toggleCategorySubmenu()">
                        <i class="fas fa-tags mr-3"></i> Categories
                        <i class="fas fa-chevron-down float-right mt-1 transition-transform" id="categoryChevron"></i>
                    </button>
                    <ul class="ml-8 mt-2 space-y-2 hidden" id="categorySubmenu">
                        <li>
                            <a href="{{ route('admin.categories.index') }}">
                                <button class="nav-item w-full text-left px-4 py-2 rounded-lg text-white text-sm">
                                    <i class="fas fa-layer-group mr-2"></i> Main Categories
                                </button>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.subcategories.index') }}">
                                <button class="nav-item w-full text-left px-4 py-2 rounded-lg text-white text-sm">
                                    <i class="fas fa-sitemap mr-2"></i> Sub Categories
                                </button>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('admin.analytics')}}">
                        <button class="nav-item w-full text-left px-4 py-3 rounded-lg text-white">
                            <i class="fas fa-chart-line mr-3"></i> Analytics
                        </button>
                    </a>
                </li>
                <li>
                    <a href="settings.html">
                        <button class="nav-item w-full text-left px-4 py-3 rounded-lg text-white">
                            <i class="fas fa-cog mr-3"></i> Settings
                        </button>
                    </a>
                </li>
            </ul>
        </div>

        
        <div class="absolute bottom-0 w-full p-4 border-t border-gray-700">
			<form action="{{ route('logout') }}" method="POST" id="logout-form">
				@csrf
				<button type="submit" class="w-full py-3 rounded-lg text-white bg-gradient-to-r from-purple-600 to-cyan-500 hover:from-purple-700 hover:to-cyan-600 transition-all duration-300">
					<i class="fas fa-sign-out-alt mr-2"></i> Logout
				</button>
			</form>
		</div>

    </div>
    
    <div class="md:ml-64">
 
        @yield('content')
       
    </div>
    

    
    <script>
        // Toggle sidebar on mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('animate-sidebar-in');
                overlay.classList.remove('hidden');
            } else {
                sidebar.classList.remove('animate-sidebar-in');
                sidebar.classList.add('animate-sidebar-out');
                overlay.classList.add('hidden');
                
                // Reset animation classes after animation completes
                setTimeout(() => {
                    sidebar.classList.remove('animate-sidebar-out');
                    sidebar.classList.add('-translate-x-full');
                }, 300);
            }
        }
        
        // Toggle order submenu
        function toggleOrderSubmenu() {
            const submenu = document.getElementById('orderSubmenu');
            const chevron = document.getElementById('orderChevron');
            
            if (submenu.classList.contains('hidden')) {
                submenu.classList.remove('hidden');
                chevron.classList.add('rotate-180');
            } else {
                submenu.classList.add('hidden');
                chevron.classList.remove('rotate-180');
            }
        }
        
        // Toggle category submenu
        function toggleCategorySubmenu() {
            const submenu = document.getElementById('categorySubmenu');
            const chevron = document.getElementById('categoryChevron');
            
            if (submenu.classList.contains('hidden')) {
                submenu.classList.remove('hidden');
                chevron.classList.add('rotate-180');
            } else {
                submenu.classList.add('hidden');
                chevron.classList.remove('rotate-180');
            }
        }
        function toggleProductSubmenu() {
            const submenu = document.getElementById('productSubmenu');
            const chevron = document.getElementById('productChevron');
            
            if (submenu.classList.contains('hidden')) {
                submenu.classList.remove('hidden');
                chevron.classList.add('rotate-180');
            } else {
                submenu.classList.add('hidden');
                chevron.classList.remove('rotate-180');
            }
        }

        
        // Delete sub category function
        function deleteSubCategory(subcategoryId) {
            if (confirm(`Are you sure you want to delete sub category ${subcategoryId}?`)) {
                // In a real application, this would make an API call to delete the sub category
                alert(`Sub Category ${subcategoryId} has been deleted.`);
                // Here you would remove the row from the table
            }
        }
        
        // Open modal for adding sub category
        function openAddModal() {
            document.getElementById('subcategoryForm').reset();
            document.getElementById('subcategoryId').value = '';
            document.querySelector('.modal h3').textContent = 'Add Sub Category';
            document.getElementById('subcategoryModal').classList.remove('hidden');
        }
        
        // Open modal for editing sub category
        function openEditModal(id, name, category) {
            document.getElementById('subcategoryId').value = id;
            document.getElementById('subcategoryName').value = name;
            document.getElementById('parentCategory').value = category.toLowerCase();
            document.querySelector('.modal h3').textContent = 'Edit Sub Category';
            document.getElementById('subcategoryModal').classList.remove('hidden');
        }
        
        // Close modal
        function closeModal() {
            document.getElementById('subcategoryModal').classList.add('hidden');
        }
        
        // Update icon preview
        function updateIconPreview() {
            const iconSelect = document.getElementById('subcategoryIcon');
            const iconPreview = document.getElementById('iconPreview');
            const selectedIcon = iconSelect.value;
            iconPreview.innerHTML = `<i class="fas ${selectedIcon}"></i>`;
        }
        
        // Handle form submission
        document.getElementById('subcategoryForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form values
            const id = document.getElementById('subcategoryId').value;
            const name = document.getElementById('subcategoryName').value;
            const category = document.getElementById('parentCategory').value;
            const icon = document.getElementById('subcategoryIcon').value;
            const status = document.getElementById('subcategoryStatus').value;
            
            if (id) {
                // Editing existing sub category
                alert(`Sub Category ${id} updated successfully!\nName: ${name}\nCategory: ${category}\nStatus: ${status}`);
            } else {
                // Adding new sub category
                alert(`New sub category added successfully!\nName: ${name}\nCategory: ${category}\nStatus: ${status}`);
            }
            
            // Close modal
            closeModal();
        });
        
        // Close modal when clicking outside
        document.getElementById('subcategoryModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
        
        // Navigation item active state
        document.querySelectorAll('.nav-item').forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all nav items
                document.querySelectorAll('.nav-item').forEach(btn => {
                    btn.classList.remove('active');
                });
                
                // Add active class to clicked item
                this.classList.add('active');
            });
        });
        
        // Add pulse animation to buttons on hover
        document.querySelectorAll('.btn-primary, .btn-secondary, .nav-btn').forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.classList.add('pulse-glow');
            });
            
            button.addEventListener('mouseleave', function() {
                this.classList.remove('pulse-glow');
            });
        });
        
        // Initialize category submenu as open
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('categorySubmenu').classList.remove('hidden');
            document.getElementById('categoryChevron').classList.add('rotate-180');
        });
    </script>
	@stack('scripts')
</body>
</html>