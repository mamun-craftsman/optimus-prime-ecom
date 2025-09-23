@push('styles')
    <style>
        .hero-section {
            background: linear-gradient(135deg, #0a0f1a 0%, #1e293b 50%, #0f172a 100%);
            border-radius: 24px;
            overflow: hidden;
            position: relative;
            margin-bottom: 3rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.8);
            border: 1px solid rgba(0, 247, 255, 0.2);
            min-height: 320px;
        }
        
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 50%, rgba(0, 247, 255, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }
        
        .hero-content {
            position: relative;
            z-index: 3;
            padding: 3rem 2.5rem;
            width: 60%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 320px;
        }
        
        .hero-badge {
            background: linear-gradient(45deg, #00f7ff, #8b5cf6);
            padding: 0.4rem 1.2rem;
            border-radius: 25px;
            font-weight: 700;
            font-size: 0.75rem;
            letter-spacing: 1px;
            display: inline-block;
            width: fit-content;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 247, 255, 0.4);
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { box-shadow: 0 4px 15px rgba(0, 247, 255, 0.4); }
            50% { box-shadow: 0 4px 25px rgba(0, 247, 255, 0.7); }
        }
        
        .hero-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.5rem;
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 1rem;
            background: linear-gradient(45deg, #ffffff, #00f7ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 30px rgba(0, 247, 255, 0.5);
        }
        
        .hero-subtitle {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 2.5rem;
            color: #cbd5e1;
            font-weight: 400;
        }
        
        .hero-cta {
            background: linear-gradient(45deg, #00f7ff 0%, #8b5cf6 100%);
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            width: fit-content;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 25px rgba(0, 247, 255, 0.4);
            position: relative;
            overflow: hidden;
        }
        
        .hero-cta::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s;
        }
        
        .hero-cta:hover::before {
            left: 100%;
        }
        
        .hero-cta:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 15px 35px rgba(0, 247, 255, 0.6);
        }
        
        .hero-image {
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            width: 40%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
            background: radial-gradient(circle at center, rgba(0, 247, 255, 0.05) 0%, transparent 70%);
        }
        
        .hero-image-container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }
        
        .hero-image-glow {
            position: absolute;
            width: 350px;
            height: 350px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(0, 247, 255, 0.1) 0%, transparent 70%);
            animation: glow 3s ease-in-out infinite alternate;
        }
        
        @keyframes glow {
            from { 
                box-shadow: 0 0 20px rgba(0, 247, 255, 0.3);
                transform: scale(1);
            }
            to { 
                box-shadow: 0 0 40px rgba(0, 247, 255, 0.5);
                transform: scale(1.05);
            }
        }
        
        .hero-product-image {
            position: relative;
            z-index: 3;
            max-width: 300px;
            max-height: 280px;
            object-fit: contain;
            filter: drop-shadow(0 10px 30px rgba(0, 247, 255, 0.3));
            animation: float 4s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            25% { transform: translateY(-10px) rotate(1deg); }
            50% { transform: translateY(-5px) rotate(0deg); }
            75% { transform: translateY(-15px) rotate(-1deg); }
        }
        
        .hero-decorative-elements {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 1;
            opacity: 0.3;
        }
        
        .hero-decorative-dot {
            width: 4px;
            height: 4px;
            background: #00f7ff;
            border-radius: 50%;
            margin: 8px;
            animation: twinkle 2s infinite;
        }
        
        @keyframes twinkle {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 1; }
        }
        
        @media (max-width: 1024px) {
            .hero-content {
                width: 55%;
                padding: 2.5rem 2rem;
            }
            .hero-image {
                width: 45%;
            }
            .hero-title {
                font-size: 2rem;
            }
        }
        
        @media (max-width: 768px) {
            .hero-section {
                min-height: 250px;
            }
            .hero-content {
                width: 100%;
                padding: 2rem 1.5rem;
                text-align: center;
                min-height: 250px;
            }
            .hero-title {
                font-size: 1.8rem;
            }
            .hero-subtitle {
                font-size: 1rem;
                margin-bottom: 2rem;
            }
            .hero-image {
                display: none;
            }
        }
    </style>
@endpush

<div class="hero-section neon-border">
    <div class="hero-overlay"></div>
    
    <!-- Decorative Elements -->
    <div class="hero-decorative-elements">
        <div class="hero-decorative-dot"></div>
        <div class="hero-decorative-dot" style="animation-delay: 0.5s;"></div>
        <div class="hero-decorative-dot" style="animation-delay: 1s;"></div>
        <div class="hero-decorative-dot" style="animation-delay: 1.5s;"></div>
    </div>
    
    <!-- Content Section -->
    <div class="hero-content">
        <div class="hero-badge">🍏 SHOWING UP SOON</div>
        <h2 class="hero-title">iPHONE 17<br>JUST LANDED</h2>
        <p class="hero-subtitle">
            Now with 0.0001mm thinner design, 3 extra cameras you’ll never use,  
            and a charging cable that’s still sold separately.  
            Get ready to sell a kidney… again!
        </p>

        <a href="#featured-products" class="hero-cta text-white cursor-not-allowed">
            <i class="fas fa-bolt mr-2"></i>
            HOLD TIGHT
            <i class="fas fa-arrow-right ml-2"></i>
        </a>
    </div>
    
    <!-- Image Section -->
    <div class="hero-image">
        <div class="hero-image-container">
            <div class="hero-image-glow"></div>
            <img src="{{ asset('iphone17.png') }}" 
                 alt="iPhone 17" 
                 class="hero-product-image">
        </div>
    </div>
</div>
