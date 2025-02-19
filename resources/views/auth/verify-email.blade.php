<x-guest-layout>
    <x-sistem.menus.authentication-card>
        <x-slot name="logo">
            <x-sistem.menus.application-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Puede hacer click en el boton para enviar un mail a su correo electronico para que pueda verificar su cuenta, en caso que no lo llegue, puede reintentarlo nuevamente.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('Se ha enviado un email a su correo electronico, confirme su email.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-sistem.buttons.primary-btn type="submit">
                        {{ __('Enviar verificacion por mail') }}
                    </x-sistem.buttons.primary-btn>
                </div>
            </form>

            <div>
                <a
                    href="{{ route('profile.show') }}"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    {{ __('Editar perfil') }}</a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf

                    <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ms-2">
                        {{ __('Cerrar sesion') }}
                    </button>
                </form>
            </div>
        </div>
    </x-sistem.menus.authentication-card>
</x-guest-layout>
