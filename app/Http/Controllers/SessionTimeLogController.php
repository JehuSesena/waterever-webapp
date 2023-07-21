<?php

namespace App\Http\Controllers;

use App\Models\SessionTimeLog;
use Illuminate\Http\Request;

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
        //
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
