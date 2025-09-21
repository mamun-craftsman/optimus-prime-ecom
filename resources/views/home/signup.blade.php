@extends('layouts.auth')
@section('content')
<div class="w-full max-w-4xl form-container neon-border p-8 animate-slide-in">
    <h2 class="text-3xl font-bold text-center mb-2 form-title text-white">SIGN UP</h2>
    <p class="text-center text-gray-400 mb-8 form-subtitle">Create your account</p>
    
    @if ($errors->any())
        <div class="bg-red-500/20 border border-red-500/30 text-red-200 px-4 py-3 rounded-lg mb-6">
            @foreach ($errors->all() as $error)
                <p class="text-sm">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @if (session('success'))
        <div class="bg-green-500/20 border border-green-500/30 text-green-200 px-4 py-3 rounded-lg mb-6">
            <p class="text-sm">{{ session('success') }}</p>
        </div>
    @endif
    
    <form method="POST" action="{{ route('signup.submit') }}" id="signupForm">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-300 mb-2 form-subtitle" for="signup-name">Full Name *</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="fas fa-user text-gray-400"></i>
                    </div>
                    <input type="text" name="name" id="signup-name" value="{{ old('name') }}" class="input-field w-full pl-10 pr-3 py-3 rounded-lg text-white focus:outline-none @error('name') border-red-500 @enderror" placeholder="Nahid Islam" required>
                </div>
            </div>
            
            <div>
                <label class="block text-gray-300 mb-2 form-subtitle" for="signup-email">Email *</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </div>
                    <input type="email" name="email" id="signup-email" value="{{ old('email') }}" class="input-field w-full pl-10 pr-3 py-3 rounded-lg text-white focus:outline-none @error('email') border-red-500 @enderror" placeholder="your@email.com" required>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-300 mb-2 form-subtitle" for="signup-phone">Phone Number *</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="fas fa-phone text-gray-400"></i>
                    </div>
                    <input type="tel" name="phone" id="signup-phone" value="{{ old('phone') }}" class="input-field w-full pl-10 pr-3 py-3 rounded-lg text-white focus:outline-none @error('phone') border-red-500 @enderror" placeholder="+880 123 456 7890" required>
                </div>
            </div>

            <div>
                <label class="block text-gray-300 mb-2 form-subtitle" for="signup-password">Password *</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                    <input type="password" name="password" id="signup-password" class="input-field w-full pl-10 pr-3 py-3 rounded-lg text-white focus:outline-none @error('password') border-red-500 @enderror" placeholder="••••••••" required>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-300 mb-2 form-subtitle" for="signup-confirm">Confirm Password *</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="fas fa-lock text-gray-400"></i>
                </div>
                <input type="password" name="password_confirmation" id="signup-confirm" class="input-field w-full pl-10 pr-3 py-3 rounded-lg text-white focus:outline-none @error('password_confirmation') border-red-500 @enderror" placeholder="••••••••" required>
            </div>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-300 mb-2 form-subtitle" for="permanent-address">Permanent Address *</label>
            <div class="relative">
                <div class="absolute top-3 left-0 flex items-start pl-3 pointer-events-none">
                    <i class="fas fa-home text-gray-400"></i>
                </div>
                <textarea name="permanent_addr" id="permanent-address" rows="3" class="input-field w-full pl-10 pr-3 py-3 rounded-lg text-white focus:outline-none resize-none @error('permanent_addr') border-red-500 @enderror" placeholder="Enter your permanent address..." required>{{ old('permanent_addr') }}</textarea>
            </div>
        </div>
        
        <div class="mb-6">
			<label class="block text-gray-300 mb-1 form-subtitle" for="shipping-address">Shipping Address</label>
			<div class="relative">
				<div class="absolute top-3 left-0 flex items-start pl-3 pointer-events-none">
					<i class="fas fa-shipping-fast text-gray-400"></i>
				</div>
				<textarea name="shipping_addr" id="shipping-address" rows="3" class="input-field w-full pl-10 pr-3 py-3 rounded-lg text-white focus:outline-none resize-none @error('shipping_addr') border-red-500 @enderror" placeholder="Enter your shipping address...">{{ old('shipping_addr') }}</textarea>
			</div>
            <div class="flex items-center mb-2">
                <input type="checkbox" id="sameAddress" class="w-3 h-3 text-purple-600 rounded focus:ring-purple-500 mr-1">
                <label for="sameAddress" class="text-gray-300 text-sm form-subtitle italic">
                    Same as Permanent Address
                </label>
            </div>
        </div>
        
        <button type="submit" class="btn-primary w-full py-3 rounded-lg text-white font-bold form-subtitle mb-6">CREATE ACCOUNT</button>
        
        <div class="text-center">
            <p class="text-gray-400 form-subtitle">Already have an account? <a href="{{ route('login') }}" class="switch-form font-bold text-purple-400 hover:text-purple-300">Login</a></p>
        </div>
    </form>
</div>
@endsection
@push('scripts')
	
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sameAddressCheckbox = document.getElementById('sameAddress');
    const permanentAddress = document.getElementById('permanent-address');
    const shippingAddress = document.getElementById('shipping-address');

    function updateShippingAddress() {
        if (sameAddressCheckbox.checked) {
            shippingAddress.value = permanentAddress.value;
            shippingAddress.disabled = true;
            shippingAddress.classList.add('opacity-50');
        } else {
            shippingAddress.disabled = false;
            shippingAddress.classList.remove('opacity-50');
        }
    }

    sameAddressCheckbox.addEventListener('change', updateShippingAddress);
    
    permanentAddress.addEventListener('input', function() {
        if (sameAddressCheckbox.checked) {
            shippingAddress.value = this.value;
        }
    });

    permanentAddress.addEventListener('keyup', function() {
        if (sameAddressCheckbox.checked) {
            shippingAddress.value = this.value;
        }
    });

    permanentAddress.addEventListener('blur', function() {
        if (sameAddressCheckbox.checked) {
            shippingAddress.value = this.value;
        }
    });
});
</script>
@endpush
