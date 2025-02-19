<x-guest-layout>
    <x-pages.menus.authentication-card>
        <x-slot name="logo">
            <x-pages.menus.application-logo />
        </x-slot>

        <x-pages.forms.validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-pages.forms.label-form for="name" value="{{ __('Nombre') }}" />
                <x-pages.forms.input-form id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-pages.forms.label-form for="email" value="{{ __('Email') }}" />
                <x-pages.forms.input-form id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>


            <div class="mt-4">
                <x-pages.forms.label-form for="password" value="{{ __('Clave') }}" />
                <x-pages.forms.input-form id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-pages.forms.label-form for="password_confirmation" value="{{ __('Confirmar clave') }}" />
                <x-pages.forms.input-form id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            {{-- @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-pages.forms.label-form for="terms">
                        <div class="flex items-center">
                            <x-pages.forms.checkbox-form name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-pages.forms.label-form>
                </div>
            @endif --}}

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Ya esta registrado?') }}
                </a>

                <x-pages.buttons.primary-btn type="submit" class="ms-4">
                    {{ __('Registrar') }}
                </x-pages.buttons.primary-btn>
            </div>
        </form>
    </x-pages.menus.authentication-card>
</x-guest-layout>
