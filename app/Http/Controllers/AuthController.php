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
     * Metodo que registra a un usuario
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signUp(Request $request)
    {
        try {
            
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|email',
                'password' => 'required|string'
            ]);

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
                $token->expires_at = Carbon::now()->addCentury();
            }
            

            return response()->json([
                'access_token' => $token->plainTextToken,
                'token_type' => 'Bearer',
                'role' => $user->role_id,
                'user' => $user
            ]);
            
        } catch (Exception $ex) {
            return response()->json([
                'error' => $ex
            ], 400);
        }
    }

    /**
     * Cierre de sesión (anular el token)
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
    
            return response()->json([
                'ok' => 'Se ha cerrado la sesión con éxito.',
                $request->user()
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'error' => $ex,
                $request->user()
            ], 400);
        }
    }

    /**
     * Obtener el objeto User como json
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
