<div class="flex flex-col gap-6">
    

    <x-auth-header :title="__('Log in to your account')" :description="__('Enter your email and password below to log in')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <!-- Validation Errors with live countdown for throttle -->
    @if ($errors->has('email') && str_contains($errors->first('email'), 'seconds'))
        @php
            preg_match('/\\d+/', $errors->first('email'), $matches);
            $seconds = $matches[0] ?? 0;
        @endphp
        <div 
            x-data="{ seconds: {{ $seconds }} }" 
            x-init="let interval = setInterval(() => { if (seconds > 0) seconds--; }, 1000);"
            class="mb-2 text-red-600 text-sm text-center"
        >
            Too many login attempts. Please try again in 
            <span x-text="seconds"></span> seconds.
        </div>
    @endif
    @if ($errors->any() && !($errors->has('email') && str_contains($errors->first('email'), 'seconds')))
        <div class="mb-2 text-red-600 text-sm text-center">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form wire:submit="login" class="flex flex-col gap-6">
        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Email or Username')"
            type="text"
            required
            autofocus
            autocomplete="username"
            placeholder="email@example.com or username"
        />

        <!-- Password -->
        <div class="relative">
            <flux:input
                wire:model="password"
                :label="__('Password')"
                type="password"
                required
                autocomplete="current-password"
                :placeholder="__('Password')"
                viewable
            />

            @if (Route::has('password.request'))
                <flux:link class="absolute end-0 top-0 text-sm" :href="route('password.request')" wire:navigate>
                    {{ __('Forgot your password?') }}
                </flux:link>
            @endif
        </div>

        <!-- Remember Me -->
        <flux:checkbox wire:model="remember" :label="__('Remember me')" />

        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit" class="w-full">{{ __('Log in') }}</flux:button>
        </div>
    </form>
</div>
