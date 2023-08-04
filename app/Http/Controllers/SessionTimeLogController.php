<?php

namespace App\Http\Controllers;

use App\Models\SessionTimeLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Livewire;

class SessionTimeLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessionTimeLogs = SessionTimeLog::all();
        return $sessionTimeLogs;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // se busca el id del usuario por el token recibido en Authorization
        $token = $request->header('Authorization');
        // si el token no es válido, o no es de un usuario autenticado, se devuelve un error
        if (!Auth::guard('sanctum')->check($token)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        // se valida start_time y end_time
        $request->validate([
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        if ($request->start_time > $request->end_time) {
            return response()->json([
                'message' => 'start_time must be before end_time'
            ], 422);
        }
    
        $user = Auth::guard('sanctum')->user();
        $userId = $user->id;
    
        // Calcula la duración en segundos
        $startTime = Carbon::parse($request->start_time);
        $endTime = Carbon::parse($request->end_time);
        $durationInSeconds = $endTime->diffInSeconds($startTime);
    
        SessionTimeLog::create([
            'user_id' => $userId,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'duration' => $durationInSeconds, // Almacena la duración en segundos
        ]);

        return response()->json([
            'message' => 'Session time metric was successfully created.'
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SessionTimeLog  $sessionTimeLog
     * @return \Illuminate\Http\Response
     */
    public function show(SessionTimeLog $sessionTimeLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SessionTimeLog  $sessionTimeLog
     * @return \Illuminate\Http\Response
     */
    public function edit(SessionTimeLog $sessionTimeLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SessionTimeLog  $sessionTimeLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SessionTimeLog $sessionTimeLog)
    {
        //
    }

    public function destroy($id)
    {
        // Buscar el registro por su ID y lanzar una excepción si no se encuentra
        try {
            $sessionTimeLog = SessionTimeLog::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Session time metric not found.'
            ], 404);
        }
    
        // Verificar si el usuario autenticado es el propietario del registro
        if (!Auth::guard('sanctum')->check() || Auth::guard('sanctum')->user()->id !== $sessionTimeLog->user_id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
    
        // Eliminar el registro de la base de datos
        $sessionTimeLog->delete();
    
        return response()->json([
            'message' => 'Session time metric was successfully deleted.'
        ], 200);
    }
}
