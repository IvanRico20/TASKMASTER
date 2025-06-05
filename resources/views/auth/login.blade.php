<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-100 to-indigo-100 py-12 px-6 sm:px-8">
        <div class="max-w-md w-full bg-white shadow-xl rounded-2xl p-8 space-y-6">
            
            {{-- Logo personalizado --}}
            <div class="flex justify-center">
                <img src="{{ asset('images/TaskMaster-logo.png') }}" alt="Logo TaskMaster" class="h-20 mb-2 drop-shadow-md">
            </div>

            {{-- Título --}}
            <h2 class="text-2xl font-bold text-center text-gray-800">Inicia Sesión en TaskMaster</h2>

            {{-- Errores de validación --}}
            <x-validation-errors class="mb-4" />

            {{-- Mensaje de estado --}}
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Formulario --}}
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                </div>

                <div class="flex items-center justify-between">
                    <label for="remember_me" class="flex items-center">
                        <input id="remember_me" type="checkbox" name="remember" class="rounded text-indigo-600 focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-gray-600">Recuérdame</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-600 hover:underline" href="{{ route('password.request') }}">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>

                <div>
                    <button type="submit"
                        class="w-full bg-indigo-600 text-white font-semibold py-2.5 rounded-lg hover:bg-indigo-700 transition-all shadow-lg hover:shadow-xl">
                        Iniciar Sesión
                    </button>
                </div>
            </form>

            {{-- Enlace a registro --}}
            <div class="text-center">
                <a href="{{ route('register') }}" class="text-sm text-blue-600 hover:underline">
                    ¿No tienes cuenta? Regístrate
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
