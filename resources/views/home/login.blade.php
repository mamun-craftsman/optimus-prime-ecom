@extends('layouts.auth')
@section('content')
	<div class="w-full max-w-md form-container neon-border p-8 animate-slide-in">
    <h2 class="text-3xl font-bold text-center mb-2 form-title text-white">LOGIN</h2>
    <p class="text-center text-gray-400 mb-8 form-subtitle">Access your account</p>
    
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
    
    <form method="POST" action="{{ route('login.submit') }}" id="loginForm">
        @csrf
        
        @if(request('intended_url'))
            <input type="hidden" name="intended_url" value="{{ request('intended_url') }}">
        @endif
        
        <div class="mb-6">
            <label class="block text-gray-300 mb-2 form-subtitle" for="login-email">Email or Username</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="fas fa-envelope text-gray-400"></i>
                </div>
                <input type="text" name="login" id="login-email" value="{{ old('login') }}" class="input-field w-full pl-10 pr-3 py-3 rounded-lg text-white focus:outline-none @error('login') border-red-500 @enderror" placeholder="your@email.com or username" required>
            </div>
        </div>
        
        <div class="mb-6">
            <label class="block text-gray-300 mb-2 form-subtitle" for="login-password">Password</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="fas fa-lock text-gray-400"></i>
                </div>
                <input type="password" name="password" id="login-password" class="input-field w-full pl-10 pr-3 py-3 rounded-lg text-white focus:outline-none @error('password') border-red-500 @enderror" placeholder="••••••••" required>
            </div>
        </div>
        
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <input id="remember" name="remember" type="checkbox" class="w-4 h-4 text-purple-600 rounded focus:ring-purple-500">
                <label for="remember" class="ml-2 text-gray-300 form-subtitle">Remember me</label>
            </div>
            <a href="#" class="text-purple-400 hover:text-purple-300 form-subtitle">Forgot password?</a>
        </div>
        
        <button type="submit" class="btn-primary w-full py-3 rounded-lg text-white font-bold form-subtitle mb-6">LOGIN</button>
        
        <div class="text-center">
            <p class="text-gray-400 form-subtitle">Don't have an account? <a href="{{ route('signup') }}" class="switch-form font-bold">Sign up</a></p>
        </div>
    </form>
</div>

<div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl w-full">
    <div class="bg-gray-800 bg-opacity-50 p-6 rounded-xl neon-border text-center">
        <div class="text-3xl text-neon mb-3">
            <i class="fas fa-shield-alt"></i>
        </div>
        <h3 class="text-xl font-bold text-white mb-2">Secure Login</h3>
        <p class="text-gray-300">Your data is protected with industry-standard encryption</p>
    </div>
    
    <div class="bg-gray-800 bg-opacity-50 p-6 rounded-xl neon-border text-center">
        <div class="text-3xl text-neon mb-3">
            <i class="fas fa-mobile-alt"></i>
        </div>
        <h3 class="text-xl font-bold text-white mb-2">Latest Phones</h3>
        <p class="text-gray-300">Access to all the latest smartphone models and accessories</p>
    </div>
    
    <div class="bg-gray-800 bg-opacity-50 p-6 rounded-xl neon-border text-center">
        <div class="text-3xl text-neon mb-3">
            <i class="fas fa-gamepad"></i>
        </div>
        <h3 class="text-xl font-bold text-white mb-2">Gaming Gear</h3>
        <p class="text-gray-300">Specialized accessories for the ultimate gaming experience</p>
    </div>
</div>

@endsection