<x-guest-layout> 
    <x-authentication-card>
        <x-slot name="logo">
            <img src="{{ asset('images/TaskMaster-logo.png') }}" alt="Logo TaskMaster" class="h-20 mb-2 drop-shadow-md">
        </x-slot>

        <style>
            .custom-container {
                font-family: 'Arial', sans-serif;
                background-color: #f5e9dc;
                padding: 2rem;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
            .custom-text {
                color: #003366;
                font-size: 1rem;
                margin-bottom: 1rem;
            }
            .custom-input {
                width: 100%;
                padding: 0.75rem;
                margin-bottom: 1rem;
                border: 1px solid #ccc;
                border-radius: 8px;
                font-size: 1rem;
            }
            .custom-button {
                background-color: #003366;
                color: white;
                padding: 0.75rem 1.5rem;
                font-size: 1rem;
                font-weight: bold;
                border: none;
                border-radius: 8px;
                transition: background-color 0.3s ease;
            }
            .custom-button:hover {
                background-color: #002244;
            }
            .custom-status, .custom-errors {
                font-size: 0.9rem;
                margin-bottom: 1rem;
                padding: 0.75rem;
                border-radius: 6px;
            }
            .custom-status {
                color: #155724;
                background-color: #d4edda;
                border: 1px solid #c3e6cb;
            }
        </style>

        <div class="custom-container">
            <div class="custom-text">
                {{ __('¿Olvidaste tu contraseña? No hay problema. Solo dinos tu correo electrónico y te enviaremos un enlace para restablecerla.') }}
            </div>

            @session('status')
                <div class="custom-status">
                    {{ $value }}
                </div>
            @endsession

            <x-validation-errors class="custom-errors" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <input type="email" name="email" required autofocus placeholder="Tu correo electrónico" class="custom-input">

                <button type="submit" class="custom-button">Enviar enlace de restablecimiento</button>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
