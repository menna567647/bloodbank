<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Governrate;
use App\Models\City;
use App\Models\Bloodtype;
use App\Models\Client;


class RegisterController extends Controller
{

    public function registerView()
    {
        $governrates = Governrate::all();
        $bloodTypes = Bloodtype::all();
        return view('website.auth.register', compact('governrates', 'bloodTypes'));
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        $client = Client::create($validated);
        Auth::guard('client')->login($client);
        return redirect()->route('website.page');
    }

    public function getCities($governrate_id)
    {
        $cities = City::where('governrate_id', $governrate_id)->get(['id', 'name']);
        return response()->json($cities);
    }
}
