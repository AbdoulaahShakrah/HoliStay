<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LoginRequest;
use App\Http\Requests\V1\StoreClientRequest;
use App\Http\Requests\V1\StoreHostRequest;
use App\Http\Requests\V1\StoreUserRequest;
use App\Models\Client;
use App\Models\Host;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {

        $credentials = $request->only('email', 'password');
        //AINDA NÃO FUNCIONA BEM, TEM PROBLEMA AO VERIFICAR A PASS
        if (Auth::attempt($credentials)){
            $user = Auth::user();
            $user = User::where('email', $credentials['email'])->first();
            $role = UserRole::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->first();

            $permissions = $role->role === 'host' ? 'total' : 'restricted';

            $token = $user->createToken($role->role, [$permissions])->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'role' => $role->role,
            ]);
        }
        return response()->json(['error' => 'Credenciais inválidas', 'credentials' => Hash::check('pavlovic', $credentials['password'])], 401);
    }

    public function clientRegister(StoreUserRequest $userRequest, StoreClientRequest $clientRequest)
    {
        $userData = $userRequest->validated();
        $clientData = $clientRequest->validated();

        $user = User::create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => $userData['password'],
        ]);

        Client::create([
            'user_id' => $user->id,
            'client_name' => $clientData['client_name'],
            'phone_number' => $clientData['phone_number'],
            'languages' => $clientData['languages'] ?? null,
        ]);

        UserRole::create([
            'user_id' => $user->id,
            'role' => 'client',
        ]);

        return response()->json(['message' => 'Client registered successfully', 'user' => $userData['password']]);
    }


    public function hostRegister(StoreHostRequest $hostRequest)
    {
        $validatedHost = $hostRequest->validated();

        $client = Client::where('user_id', $validatedHost['client_id'])->first();

        if (!$client) {
            return response()->json(['message' => 'Client does not exist'], 404);
        }

        Host::create([
            'user_id' => $client->user_id,
            'host_description' => $validatedHost['host_description'],
            'job' => $validatedHost['job'],
            'iban' => $validatedHost['iban'],
            'nif' => $validatedHost['nif'],
            'rate' => $validatedHost['rate'],
        ]);

        UserRole::create([
            'user_id' => $client->user_id,
            'role' => 'host',
        ]);

        return response()->json(['message' => 'Host registered successfully'], 201);
    }
}
