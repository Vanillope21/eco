<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Failed;
use App\Models\Log;

class LogFailedLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Failed $event)
    {
        Log::create([
            'user_id'     => $event->user ? $event->user->id : null,
            'action'      => 'login_failed',
            'description' => 'Failed login attempt for username: ' . ($event->credentials['username'] ?? 'unknown'),
            'ip_address'  => request()->ip(),
            'user_agent'  => request()->userAgent(),
            'status'      => 'failed',
            'performed_at'=> now(),
            'log_type'    => 'auth',
        ]);
    }
}
