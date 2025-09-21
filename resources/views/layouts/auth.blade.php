
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OPTIMUS PRIME - Login</title>
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
                        dark: '#0c111b'
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
                        'slide-out': 'slideOut 0.5s ease-out forwards'
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' }
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
        
        .form-container {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
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
        
        .switch-form {
            color: #00f7ff;
            transition: all 0.3s ease;
        }
        
        .switch-form:hover {
            color: #8b5cf6;
            text-shadow: 0 0 10px rgba(139, 92, 246, 0.5);
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
        
        .form-title {
            font-family: 'Orbitron', sans-serif;
            letter-spacing: 1px;
        }
        
        .form-subtitle {
            font-family: 'Exo 2', sans-serif;
        }
    </style>
</head>
<body class="font-sans">
    <div class="floating-element floating-1"></div>
    <div class="floating-element floating-2"></div>
    <div class="floating-element floating-3"></div>
    
    <div class="container mx-auto px-4 py-12 flex flex-col items-center justify-center min-h-screen">
        <div class="text-center mb-10 animate-float">
            <h1 class="text-5xl md:text-6xl font-bold logo-text text-white mb-2 glow-text">OPTIMUS PRIME</h1>
            <p class="text-xl text-gray-300 form-subtitle">Mobile Shop & Gaming Accessories</p>
        </div>
        
		@yield('content')
        
        <!-- Footer -->
        <footer class="mt-16 w-full max-w-4xl text-center text-gray-500">
            <div class="border-t border-gray-800 pt-6">
                <p>© 2023 OPTIMUS PRIME Mobile Shop. All rights reserved.</p>
                <div class="mt-2 flex justify-center space-x-4">
                    <a href="#" class="hover:text-neon transition">Privacy Policy</a>
                    <a href="#" class="hover:text-neon transition">Terms of Service</a>
                    <a href="#" class="hover:text-neon transition">Contact Us</a>
                </div>
            </div>
        </footer>
    </div>

    <script>
        
        document.querySelectorAll('.btn-primary').forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.classList.add('pulse-glow');
            });
            
            button.addEventListener('mouseleave', function() {
                this.classList.remove('pulse-glow');
            });
        });
    </script>
	@stack('scripts')
</body>
</html>