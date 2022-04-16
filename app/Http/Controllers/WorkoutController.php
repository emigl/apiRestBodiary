<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    
    /**
     * Store a newly created workout register in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createWorkoutRegister(Request $request)
    {
        // TODO: Hay que hacer un algoritmo que recoja la ID del usuario que cree el registro. Después en la request debe de ir lo siguiente: Músculo(muscle en training_exercises), sets, reps, peso.
        $user = User::where('id', 2)->firstOrFail();
        
        // TODO: la Lógica del algoritmo es el siguiente: usa el ID del usuario para introducirlo en progress_weight. Hace una consulta a Training_exercises para ver que ID tiene el ejercicio que se ha puesto, para después ponerlo en la foreign key de progress_weight. Una vez hecho esto, se hace una consulta de crear un registro en progress_weight con la información que tenemos, ya que tenemos la ID del usuario y el ID del ejercicio de training_exercises.
    }

    /**
     * Display a listing of workout register.
     *
     * @return \Illuminate\Http\Response
     */
    public function getWorkoutRegister()
    {
        
    }

    

    /**
     * Store a newly created Body weight in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createBodyWeightRegister(Request $request)
    {
        
    }

    /**
     * Display a listing of body weight register.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBodyWeightRegister()
    {
        
    }
    

    /**
     * Store a newly created IMC in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createImcRegister(Request $request)
    {
        
    }

    /**
     * Display a listing of the IMC register.
     *
     * @return \Illuminate\Http\Response
     */
    public function getImcRegister()
    {
        
    }

    


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
