<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-100 to-indigo-100 py-12 px-6 sm:px-8">
        <div class="max-w-md w-full bg-white shadow-xl rounded-2xl p-8 space-y-6">

            {{-- Logo personalizado --}}
            <div class="flex justify-center">
                <img src="{{ asset('images/TaskMaster-logo.png') }}" alt="Logo TaskMaster" class="h-20 mb-2 drop-shadow-md">
            </div>

            {{-- Título --}}
            <h2 class="text-2xl font-bold text-center text-gray-800">Regístrate en TaskMaster</h2>

            {{-- Errores de validación --}}
            <x-validation-errors class="mb-4" />

            {{-- Formulario --}}
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name"
                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="username"
                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                    <input id="password" name="password" type="password" required autocomplete="new-password"
                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar contraseña</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="flex items-start">
                        <input id="terms" name="terms" type="checkbox" required class="rounded text-indigo-600 focus:ring-indigo-500 mt-1">
                        <div class="ml-2 text-sm text-gray-600">
                            {!! __('Acepto los :terms_of_service y la :privacy_policy', [
                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline hover:text-indigo-700">'.__('Términos de servicio').'</a>',
                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline hover:text-indigo-700">'.__('Política de privacidad').'</a>',
                            ]) !!}
                        </div>
                    </div>
                @endif

                <div class="flex items-center justify-between">
                    <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:underline">
                        ¿Ya tienes cuenta? Inicia sesión
                    </a>

                    <button type="submit"
                        class="bg-indigo-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-indigo-700 transition-all shadow-md hover:shadow-lg">
                        Registrarse
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
