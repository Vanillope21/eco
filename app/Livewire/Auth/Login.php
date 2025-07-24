<?php

namespace App\Livewire\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Login extends Component
{
    #[Validate('required|string')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        // Determine if input is email or username
        $loginField = filter_var($this->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (! \Illuminate\Support\Facades\Auth::attempt([
            $loginField => $this->email,
            'password' => $this->password
        ], $this->remember)) {
            \Illuminate\Support\Facades\RateLimiter::hit($this->throttleKey());

            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        \Illuminate\Support\Facades\RateLimiter::clear($this->throttleKey());
        \Illuminate\Support\Facades\Session::regenerate();

        $user = \Illuminate\Support\Facades\Auth::user();
        $redirectTo = route('dashboard', absolute: false); // default
        if ($user->isSuperAdmin()) {
            $redirectTo = '/super-admin/dashboard';
        } elseif ($user->isAdmin()) {
            $redirectTo = '/admin/dashboard';
        } elseif ($user->isBarangayOfficial()) {
            $redirectTo = '/barangay/dashboard';
        } elseif ($user->isResident()) {
            $redirectTo = '/resident/home';
        }

        $this->redirectIntended(default: $redirectTo, navigate: true);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 3)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}
