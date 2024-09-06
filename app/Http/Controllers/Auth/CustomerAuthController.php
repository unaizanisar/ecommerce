<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;

class CustomerAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('frontend.auth.customer_login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $email = strtolower(trim($request->email));
        $password = trim($request->password);
        $customer = Customer::where('email', $email)->first();
    
        if ($customer) {
            if (Hash::check($password, $customer->password)) {
                Auth::guard('customer')->login($customer);
                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'redirect' => route('home') 
                    ]);
                }
                return redirect()->intended(route('home'));
            } else {
                if ($request->ajax()) {
                    return response()->json([
                        'errors' => ['password' => ['The provided password is incorrect.']]
                    ], 422);
                }
                return back()->withErrors([
                    'password' => 'The provided password is incorrect.',
                ]);
            }
        } else {
            if ($request->ajax()) {
                return response()->json([
                    'errors' => ['email' => ['No account found for this email.']]
                ], 422);
            }
            return back()->withErrors([
                'email' => 'No account found for this email.',
            ]);
        }
    }
    public function showRegistrationForm()
    {
        return view('frontend.auth.customer_register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $customer = new Customer([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'postal_code' => $request->input('postal_code'),
            'country' => $request->input('country'),
            'gender' => $request->input('gender'),
            'status' => 1,
        ]);
        $customer->save();
        // Auth::guard('customer')->login($customer);
        return redirect()->route('customer.login');
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->forget('customer_data');
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
