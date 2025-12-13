<?php

namespace App\Http\Controllers\Website\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{

    public function loginView()
    {
        return view('website.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->guard('client')->attempt($credentials)) {
            return redirect()->route('website.page')->with('user_message', __('messages.login_success'));
        }

        return redirect()->route('website.login.view')->withErrors([
            'email' => __('messages.login_failed'),
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::guard('client')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('website.page');
    }
}
