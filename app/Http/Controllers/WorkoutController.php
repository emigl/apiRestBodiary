<?php

namespace App\Http\Controllers;

use App\Models\Body_imc;
use App\Models\Body_weight;
use App\Models\Progress_weight;
use App\Models\Training_exercise;
use App\Models\User;
use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        try {
            // usar esta variable cuando se pase el middleware de sanctum.
            $userId = Auth::id();
            // DE PRUEBA
            $user = User::where('id', 2)->firstOrFail();
    
            $trainingExercise = Training_exercise::where('name', $request->name)->firstOrFail();
            $registerWorkout = Progress_weight::create([
                                'training_exercise_id' => $trainingExercise->id,
                                'user_id' => $userId,
                                'weight' => $request->weight,
                                'sets' => $request->sets,
                                'reps' => $request->reps
                                ]);
    
            return response()->json($registerWorkout);

        } catch (Exception $ex) {
            return response()->json([
                'error' => $ex
            ], 400);
        }
    }

    /**
     * Display a listing of workout register.
     *
     * @return \Illuminate\Http\Response
     */
    public function getWorkoutRegister()
    {

        try{
            $userId = Auth::id();
           
            $registerWorkouts = DB::table('progress_weights')
            ->join('training_exercises', 'progress_weights.training_exercise_id', '=','training_exercises.id' )->select('progress_weights.weight', 'progress_weights.reps','progress_weights.sets', 'progress_weights.created_at','progress_weights.user_id','training_exercises.name')
            ->where('progress_weights.user_id', '=', $userId)
            ->orderBy('progress_weights.created_at', 'desc')->get();
            if(empty($registerWorkouts->count())){

                
                return response()->json(['empty'=> 'No hay registros todavía!']);

             }else{

                return response()->json($registerWorkouts);
             }
        

        } catch (Exception $ex) {
            return response()->json([
                'error' => $ex
            ], 400);
        }
    }

    /**
     * Display a listing of training exercises register for filter.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTrainingExercises()
    {
        try{
            $trainingExercises = Training_exercise::all();
            
            return response()->json($trainingExercises);

        } catch (Exception $ex) {
            return response()->json([
                'error' => $ex
            ], 400);
        }
    }

    

    /**
     * Store a newly created Body weight in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createBodyWeightRegister(Request $request)
    {

        try{
            // usar esta variable cuando se pase el middleware de sanctum.
            $userId = Auth::id();
           // DE PRUEBA
            $user = User::where('id', 2)->firstOrFail();
   
            $registerBodyWeight = Body_weight::create([
                                'user_id' => $userId,
                                'weight' => $request->weight,
                                ]);
            

            return response()->json($registerBodyWeight);

        } catch (Exception $ex) {
            return response()->json([
                'error' => $ex
            ], 400);
        }
    }

    /**
     * Display a listing of body weight registers.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBodyWeightRegister()
    {
        try{
            // usar esta variable cuando se pase el middleware de sanctum.
            $userId = Auth::id();
            // DE PRUEBA
            $user = User::where('id', 2)->firstOrFail();
     
             $trainingExercises = Body_weight::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
             if(empty($trainingExercises->count())){

                return response()->json(['empty'=> 'No has introducido tu peso todavía!']);
                
             }else{

                 return response()->json($trainingExercises);
             }

        } catch (Exception $ex) {
            return response()->json([
                'error' => $ex
            ], 400);
        }
    }
    

    /**
     * Store a newly created IMC in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createImcRegister(Request $request)
    {
        try{
            // usar esta variable cuando se pase el middleware de sanctum.
            $userId = Auth::id();
           // DE PRUEBA
            $user = User::where('id', 2)->firstOrFail();
   
            $registerImc = Body_imc::create([
                                'user_id' => $userId,
                                'imc' => $request->imc,
                                ]);
    
            return response()->json($registerImc);

        } catch (Exception $ex) {
            return response()->json([
                'error' => $ex
            ], 400);
        }
    }

    /**
     * Display a listing of the IMC register.
     *
     * @return \Illuminate\Http\Response
     */
    public function getImcRegister()
    {
        try{
            // usar esta variable cuando se pase el middleware de sanctum.
            $userId = Auth::id();
            // DE PRUEBA
            $user = User::where('id', 2)->firstOrFail();
     
             $imcRegister = Body_imc::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
             if(empty($imcRegister->count())){

                return response()->json(['empty'=> 'No hay datos para calcular tu imc todavía!']);
                
             }else{

                 return response()->json($imcRegister);

             }

        } catch (Exception $ex) {
            return response()->json([
                'error' => $ex
            ], 400);
        }
    }
}
