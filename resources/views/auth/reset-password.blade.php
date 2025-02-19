<x-guest-layout>
    <x-sistem.menus.authentication-card>
        <x-slot name="logo">
            <x-sistem.menus.application-logo />
        </x-slot>

        <x-sistem.forms.validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block">
                <x-sistem.forms.label-form for="email" value="{{ __('Email') }}" />
                <x-sistem.forms.input-form id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-sistem.forms.label-form for="password" value="{{ __('Clave') }}" />
                <x-sistem.forms.input-form id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-sistem.forms.label-form for="password_confirmation" value="{{ __('Confirmar clave') }}" />
                <x-sistem.forms.input-form id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-sistem.buttons.primary-btn type="submit">
                    {{ __('Restablecer clave') }}
                </x-sistem.buttons.primary-btn>
            </div>
        </form>
    </x-sistem.menus.authentication-card>
</x-guest-layout>
