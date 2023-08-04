<?php

namespace App\Http\Controllers;

use App\Models\SessionTimeLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

        // si todo ha ido bien, se devuelve un mensaje de éxito
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SessionTimeLog  $sessionTimeLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(SessionTimeLog $sessionTimeLog)
    {
        //
    }
}
