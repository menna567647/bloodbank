<?php

namespace App\Http\Controllers\Api\v1;

use App\Traits\ApiResponse;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    use ApiResponse;

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        $client = Client::create($validated);
        $token = $client->createToken('ApiToken');

        if ($request->filled('fcm_token')) {
            $token->accessToken->fcm_token = $request->fcm_token;
            $token->accessToken->save();
        }

        $data = [
            'client' => $client,
            'token' => $token->plainTextToken,
        ];
        return $this->apiSuccessMessage('client created successfully', $data);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $client = Client::where('email', $credentials['email'])->first();

        if (!$client || !Hash::check($credentials['password'], $client->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $client->createToken('ApiToken');

        if ($request->filled('fcm_token')) {
            $token->accessToken->fcm_token = $request->fcm_token;
            $token->accessToken->save();
        }

        return response()->json([
            'access_token' => $token->plainTextToken,
            'token_type' => 'Bearer',
            'client' => $client,
        ]);
    }

    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken();
        $token->delete();

        return response()->json([
            'message' => 'Logged out successfully',
            'deleted_token_id' => $token->id,
        ]);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:clients,email',
        ]);

        $status = Password::broker('clients')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => __($status)])
            : response()->json(['message' => __($status)], 400);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:clients,email',
            'token' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $status = Password::broker('clients')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($client, $password) {
                $client->password = Hash::make($password);
                $client->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(['message' => 'Password reset successful'])
            : response()->json(['message' => __($status)], 400);
    }
}