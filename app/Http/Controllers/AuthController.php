<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\NewAccessToken;

class AuthController extends Controller
{
    
    public function signUp(Request $request)
    {
        try {
            
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|email',
                'password' => 'required|string'
            ]);

            $userVerify = User::where('name', $request->name)->get();
            if(count($userVerify)){
                return response()->json([
                    'error' => 'El nombre de usuario ya existe!',
                    'response' => $userVerify,                              
                    'name' => $request->name,
                    
                ], 400);
            }

            $emailVerify = User::where('email', $request->email)->get();
            if(count($emailVerify)){
                return response()->json([
                    'error' => 'El email ya está siendo utilizado!',                              
                    'email' => $request->email,
                    
                ], 400);
            }

            $user = User::create([
                'name' => $request->name,
                'role_id' => 2,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;
    
            return response()->json([
                'ok' => 'Se ha creado el usuario!',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
                
            ], 201);

        } catch (Exception $ex) {
            return response()->json([
                'error' => $ex
            ], 400);
        }
    }

    /**
     * Inicio de sesión y creación de token
     */
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
                'remember_me' => 'boolean'
            ]);
    
            $credentials = request(['email', 'password']);
    
            if (!Auth::attempt($credentials)){
                return response()->json([
                    'error' => 'Las credenciales no son válidas'
                ], 401);
            }

            $user = User::where('email', $request['email'])->firstOrFail();

            $user = $request->user();
            $token = $user->createToken('auth_token');
            
            
            if ($request->remember_me){
                $token->expires_at = Carbon::now()->addWeeks(1);
            }
            // $token->save();

            return response()->json([
                'access_token' => $token->plainTextToken,
                'token_type' => 'Bearer',
                'role' => $user->role_id
                // 'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString(),
                // 'token_info' => $token
            ]);
            
        } catch (Exception $ex) {
            return response()->json([
                'error' => $ex
            ], 400);
        }
    }

    /**
     * Cierre de sesión (anular el token)
     */
    public function logout(Request $request)
    {
        try {
            
            $request->user()->token()->revoke();
    
            return response()->json([
                'ok' => 'Se ha cerrado la sesión'
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'error' => $ex
            ], 400);
        }
    }

    /**
     * Obtener el objeto User como json
     */
    public function user(Request $request)
    {
        try {
            
            return response()->json($request->user());
        } catch (Exception $ex) {
            return response()->json([
                'error' => $ex
            ], 400);
        }
    }
}
