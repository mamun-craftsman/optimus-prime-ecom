<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Carbon\Exceptions\Exception;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLogin(Request $request)
    {
        if (Auth::check()) {
            return $this->roleBasedRedirect();
        }

        return view('home.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->except('password'));
        }

        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginField => $request->login,
            'password' => $request->password,
            'status' => 'active'
        ];

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            if ($request->has('intended_url') && $request->intended_url) {
                return redirect($request->intended_url)->with('success', 'Welcome back!');
            }

            $intendedUrl = session('url.intended');

            if ($intendedUrl) {
                session()->forget('url.intended');
                return redirect($intendedUrl)->with('success', 'Welcome back!');
            }

            return redirect($this->getDefaultRedirectUrl())->with('success', 'Login successful!');
        }

        return back()->withErrors([
            'login' => 'Invalid credentials or account is inactive.',
        ])->withInput($request->except('password'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }

    private function roleBasedRedirect()
    {
        $user = Auth::user();

        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.orders.index');
            case 'customer':
                return redirect()->route('home.index');
            default:
                return redirect()->route('home.index');
        }
    }

    private function getDefaultRedirectUrl()
    {
        $user = Auth::user();

        switch ($user->role) {
            case 'admin':
                return route('admin.orders.index');
            case 'customer':
                return route('home.index');
            default:
                return route('home');
        }
    }


    public function showSignup()
    {
        if (Auth::check()) {
            return $this->roleBasedRedirect();
        }

        return view('home.signup');
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'required|string|max:20|unique:users,phone',
            'password' => 'required|string|min:6|confirmed',
            'permanent_addr' => 'required|string|max:1000',
            'shipping_addr' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->except('password', 'password_confirmation'));
        }

        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
                'role' => 'customer',
                'status' => 'active',
            ]);

            Customer::create([
                'user_id' => $user->id,
                'permanent_addr' => $request->permanent_addr,
                'shipping_addr' => $request->shipping_addr ?? $request->permanent_addr,
            ]);

            DB::commit();

            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->route('home.index')->with('success', 'Account created and logged in successfully!');
        } catch (Exception $e) {
            DB::rollBack();

            return back()->withErrors([
                'error' => 'Registration failed. Please try again.'
            ])->withInput($request->except('password', 'password_confirmation'));
        }
    }
}
