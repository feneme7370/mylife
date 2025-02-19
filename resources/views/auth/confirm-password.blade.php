<x-guest-layout>
    <x-sistem.menus.authentication-card>
        <x-slot name="logo">
            <x-sistem.menus.application-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Esta es un area segura en la aplicacion, por favor confirme su clave.') }}
        </div>

        <x-sistem.forms.validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div>
                <x-sistem.forms.label-form for="password" value="{{ __('Clave') }}" />
                <x-sistem.forms.input-form id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" autofocus />
            </div>

            <div class="flex justify-end mt-4">
                <x-sistem.buttons.primary-btn type="submit" class="ms-4">
                    {{ __('Confirmar') }}
                </x-sistem.buttons.primary-btn>
            </div>
        </form>
    </x-sistem.menus.authentication-card>
</x-guest-layout>
