<x-guest-layout>
    <x-sistem.menus.authentication-card>
        <x-slot name="logo">
            <x-sistem.menus.application-logo />
        </x-slot>

        <div class="mb-4 text-lg text-gray-800">
            <p>El usuario o la empresa estan inhabilitados, cierre sesion e inicie con otra cuenta</p>

            <p class="italic text-sm text-gray-600 mt-10">Si no es su sitacion, comunicarse con Femaser</p>
        </div>

        <div class="mt-4 flex items-center justify-end">

            <div>
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
