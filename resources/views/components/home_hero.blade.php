@push('styles')
	<style>
		.hero-section {
            background: linear-gradient(120deg, #0a0f1a, #1e293b);
            border-radius: 16px;
            overflow: hidden;
            position: relative;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }
        .hero-content {
            position: relative;
            z-index: 2;
            padding: 2.5rem;
        }
        .hero-badge {
            background: linear-gradient(45deg, #00f7ff, #8b5cf6);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 1rem;
            box-shadow: 0 4px 10px rgba(0, 247, 255, 0.3);
        }
        .hero-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            text-shadow: 0 0 10px #00f7ff;
        }
        .hero-subtitle {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            max-width: 600px;
        }
        .hero-cta {
            background: linear-gradient(45deg, #00f7ff, #8b5cf6);
            padding: 0.8rem 2rem;
            border-radius: 50px;
            font-weight: bold;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 247, 255, 0.4);
        }
        .hero-cta:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 247, 255, 0.6);
        }
        .hero-image {
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            width: 40%;
            background: linear-gradient(45deg, transparent, rgba(0, 247, 255, 0.1));
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
        }
        .hero-image-placeholder {
            width: 200px;
            height: 200px;
            background: rgba(30, 41, 59, 0.7);
            border: 2px dashed rgba(129, 140, 153, 0.5);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #00f7ff;
        }
        @media (max-width: 768px) {
            .hero-content {
                padding: 1.5rem;
            }
            .hero-title {
                font-size: 1.8rem;
            }
            .hero-subtitle {
                font-size: 1rem;
            }
            .hero-image {
                display: none;
            }
        }
	</style>
@endpush
<div class="hero-section neon-border">
	<div class="hero-content">
		<div class="hero-badge">LIMITED TIME OFFER</div>
		<h2 class="hero-title">SUMMER SALE UP TO 50% OFF</h2>
		<p class="hero-subtitle text-gray-300">Get the latest smartphones, tablets, and accessories at
			unbeatable prices. Don't miss out on our biggest sale of the year!</p>
		<a href="#" class="hero-cta text-white">
			<i class="fas fa-bolt mr-2"></i> SHOP NOW
		</a>
	</div>
	<div class="hero-image">
		<div class="hero-image-placeholder">
			<i class="fas fa-mobile-alt text-5xl"></i>
		</div>
	</div>
</div>
