@extends('layouts.home')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-white mb-8">Edit Profile</h1>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div>
                <div class="product-card neon-border p-6 mb-6">
                    <h2 class="text-xl font-bold text-white mb-4">Profile Photo</h2>
                    <div class="text-center">
                        <img src="{{ $user->photo ? '/storage/' . $user->photo : asset('avatar.png') }}" 
                             alt="{{ $user->name }}" 
                             class="w-32 h-32 rounded-full object-cover mx-auto mb-4">
                        
                        <form action="{{ route('profile.photo') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="photo" accept="image/*" class="hidden" id="photoInput">
                            <label for="photoInput" class="btn-secondary cursor-pointer">
                                <i class="fas fa-camera mr-2"></i>Change Photo
                            </label>
                            @error('photo')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </form>
                    </div>
                </div>
                
                <div class="product-card neon-border p-6">
                    <h2 class="text-xl font-bold text-white mb-4">Change Password</h2>
                    <form action="{{ route('profile.password') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="block text-gray-300 mb-2">Current Password</label>
                            <input type="password" name="current_password" class="w-full px-4 py-3 bg-gray-800 border border-gray-600 rounded-lg text-white focus:border-neon focus:outline-none" required>
                            @error('current_password')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-gray-300 mb-2">New Password</label>
                            <input type="password" name="password" class="w-full px-4 py-3 bg-gray-800 border border-gray-600 rounded-lg text-white focus:border-neon focus:outline-none" required>
                            @error('password')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-6">
                            <label class="block text-gray-300 mb-2">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="w-full px-4 py-3 bg-gray-800 border border-gray-600 rounded-lg text-white focus:border-neon focus:outline-none" required>
                        </div>
                        
                        <button type="submit" class="btn-primary w-full">Update Password</button>
                    </form>
                </div>
            </div>
            
            <div>
                <div class="product-card neon-border p-6">
                    <h2 class="text-xl font-bold text-white mb-4">Personal Information</h2>
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="block text-gray-300 mb-2">Full Name</label>
                            <input type="text" name="name" value="{{ $user->name }}" class="w-full px-4 py-3 bg-gray-800 border border-gray-600 rounded-lg text-white focus:border-neon focus:outline-none" required>
                            @error('name')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-gray-300 mb-2">Phone Number</label>
                            <input type="text" name="phone" value="{{ $user->phone }}" class="w-full px-4 py-3 bg-gray-800 border border-gray-600 rounded-lg text-white focus:border-neon focus:outline-none" required>
                            @error('phone')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-gray-300 mb-2">Email (Cannot be changed)</label>
                            <input type="email" value="{{ $user->email }}" class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-gray-400" disabled>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-gray-300 mb-2">Permanent Address</label>
                            <textarea name="parmanent_addr" rows="3" class="w-full px-4 py-3 bg-gray-800 border border-gray-600 rounded-lg text-white focus:border-neon focus:outline-none resize-none">{{ $customer->permanent_addr ?? '' }}</textarea>
                            @error('parmanent_addr')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-6">
                            <label class="block text-gray-300 mb-2">Shipping Address</label>
                            <textarea name="shipping_addr" rows="3" class="w-full px-4 py-3 bg-gray-800 border border-gray-600 rounded-lg text-white focus:border-neon focus:outline-none resize-none">{{ $customer->shipping_addr ?? '' }}</textarea>
                            @error('shipping_addr')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn-primary w-full">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="mt-8 text-center">
            <a href="{{ route('profile.index') }}" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>Back to Profile
            </a>
        </div>
    </div>
</div>
@push('scripts')
	
<script>
document.getElementById('photoInput').addEventListener('change', function() {
    if (this.files[0]) {
        this.closest('form').submit();
    }
});
</script>
@endpush
@endsection
