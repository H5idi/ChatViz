<x-guest-layout>
    <!-- État de la session -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Adresse e-mail -->
        <div>
            <x-input-label for="email" :value="__('Adresse e-mail')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Mot de passe -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Se souvenir de moi -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded bg-white/5 border-white/20 text-indigo-500 shadow-sm focus:ring-indigo-500 focus:ring-offset-slate-900" name="remember">
                <span class="ms-2 text-sm text-slate-400">{{ __('Se souvenir de moi') }}</span>
            </label>
        </div>

        <div class="flex flex-col items-center justify-center mt-8 gap-4">
            <x-primary-button class="w-full justify-center py-3">
                {{ __('Se connecter') }}
            </x-primary-button>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-slate-400 hover:text-indigo-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Mot de passe oublié ?') }}
                </a>
            @endif
        </div>
    </form>
</x-guest-layout>
