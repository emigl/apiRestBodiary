<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a list of users.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsers()
    {

        try {
            
            $users = User::all()->except(Auth::id());

            return response()->json($users);
        } catch (Exception $ex) {
            return response()->json([
                'error' => $ex
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createUser(Request $request)
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
     * Display the user details
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUserDetails($id)
    {
        try {
            $user = User::where('id', $id)->get();
            return response()->json($user);
        } catch (Exception $ex) {
            return response()->json([
                'error' => $ex
            ], 400);
        }
    }


    /**
     * Update the specified User.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'isActive' => 'required'
        ]);
        try {
            
            $userVerify = User::where('name', $request->name)->get();
            if(count($userVerify)){
            $userVerifyId = User::where('id', $request->id)->get();
                if($userVerify == $userVerifyId){
                    
                    
                }else{

                    return response()->json([
                        'error' => 'El nombre de usuario ya existe!',                   
                        'name' => $request->name,
                        
                    ], 400);

                }
            }
    
           
            User::where('id', $id)->update([
                'name' => $request->name,
                'isActive' => $request->isActive
            ]);
            return response()->json([
                
                'ok'=> 'El usuario ha sido actualizado con éxito',
                
            ], 201);
           
            
        } catch (Exception $ex) {
            return response()->json([
                'ex' =>$ex,
                'error'=> 'Ha ocurrido un error al actualizar el usuario',
                
            ], 201);
        }
    }

     /**
     * Soft Delete the specified user from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteUser($id)
    {
        try {
            $user = User::where('id', $id)->delete();
            if($user == 1){
                return response()->json([
                    'ok' => 'El usuario ha sido borrado con éxito',
                ]);

            }
            else {
                return response()->json([
                    
                    'error' => 'No se ha encontrado el usuario',
                ]);

            }
        } catch (Exception $ex) {
            return response()->json([
                'user' => $user,
                'error' => 'Ha ocurrido un error al intentar borrar el usuario',
                'exception' => $ex
            ], 400);
        }
    }

    /**
     * Soft Delete the specified user from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function disableUser($id)
    {
        try {
            $user = User::where('id', $id)->update([
                'isActive' => 0
            ]);
            if($user == 1){
                return response()->json([
                    'ok' => 'El usuario ha sido desactivado con éxito',
                ]);

            }
            else {
                return response()->json([
                    
                    'error' => 'No se ha encontrado el usuario',
                ]);

            }
        } catch (Exception $ex) {
            return response()->json([
                'error' => 'Ha ocurrido un error al intentar desactivado el usuario',
                'exception' => $ex
            ], 400);
        }
    }

    /**
     * Active the specified user from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activeUser($id)
    {
        try {
            
            $user = User::where('id', $id)->update([
                'isActive' => 1
            ]);
            if($user == 1){
                return response()->json([
                    'user' => $user,
                    'ok' => 'El usuario ha sido activado con éxito',
                ]);

            }
            else {
                return response()->json([
                    
                    'error' => 'No se ha encontrado el usuario',
                ]);

            }
            
        } catch (Exception $ex) {
            return response()->json([
                'user' => $user,
                'error' => 'Ha ocurrido un error al intentar activar el usuario',
                'exception' => $ex,

            ], 400);
        }
    }
}
