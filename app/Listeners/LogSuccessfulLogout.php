<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Logout;
use App\Models\Log;

class LogSuccessfulLogout
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
    public function handle(logout $event)
    {
        Log::create([
            'user_id'     => $event->user->id,
            'action'      => 'logout',
            'description' => 'User logged out',
            'ip_address'  => request()->ip(),
            'user_agent'  => request()->userAgent(),
            'status'      => 'success',
            'performed_at'=> now(),
            'log_type'    => 'auth',
        ]);
    }
}
