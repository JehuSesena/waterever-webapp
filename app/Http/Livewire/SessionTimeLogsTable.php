<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\SessionTimeLog;

class SessionTimeLogsTable extends Component
{
    public $sessionTimeLogs;
    protected $listeners = ['sessionTimeLogAdded' => 'loadSessionTimeLogs'];

    public function render()
    {
        return view('livewire.session-time-logs-table');
    }

    public function mount()
    {
        $this->loadSessionTimeLogs();
    }

    public function loadSessionTimeLogs()
    {
        $this->sessionTimeLogs = SessionTimeLog::all();
    }
}

