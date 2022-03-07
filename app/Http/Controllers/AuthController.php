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
    /**
     * TODO: Realizar la comprobación del si existe un usuario y un email y devolver feedback acerca del registro.
     */
    public function signUp(Request $request)
    {
        try {
            
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|email|unique:users',
                'password' => 'required|string'
            ]);
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;
    
            return response()->json([
                'message' => 'Successfully created user!',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
                
            ], 201);

        } catch (Exception $th) {
            return response()->json([
                'message' => $th
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
                    'message' => 'Las credenciales no son válidas'
                ], 401);
            }

            $user = User::where('email', $request['email'])->firstOrFail();
            $user = $request->user();

            $token = $user->createToken('auth_token');
    
            
            if ($request->remember_me){
                $token->expires_at = Carbon::now()->addWeeks(2);
            }
            // $token->save();
    
            return response()->json([
                'access_token' => $token->plainTextToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
            ]);
            
        } catch (Exception $th) {
            return response()->json([
                'message' => $th
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
                'message' => 'Successfully logged out'
            ]);
        } catch (Exception $th) {
            return response()->json([
                'message' => $th
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
        } catch (Exception $th) {
            return response()->json([
                'message' => $th
            ], 400);
        }
    }
}
