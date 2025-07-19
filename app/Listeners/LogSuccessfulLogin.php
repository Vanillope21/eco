<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Log;
use Illuminate\Auth\Events\Login;

class LogSuccessfulLogin
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
    public function handle(login $event)
    {
        Log::create([
            'user_id'     => $event->user->id,
            'action'      => 'login',
            'description' => 'User logged in',
            'ip_address'  => request()->ip(),
            'user_agent'  => request()->userAgent(),
            'status'      => 'success',
            'performed_at'=> now(),
            'log_type'    => 'auth',
        ]);
    }
}
