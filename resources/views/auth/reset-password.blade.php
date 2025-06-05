<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <style>
            .custom-container {
                font-family: 'Arial', sans-serif;
                background-color: #f5e9dc;
                padding: 2rem;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
            .custom-label {
                color: #003366;
                font-weight: bold;
                margin-bottom: 0.5rem;
                display: block;
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
            .custom-errors {
                font-size: 0.9rem;
                margin-bottom: 1rem;
                padding: 0.75rem;
                border-radius: 6px;
                background-color: #f8d7da;
                color: #721c24;
                border: 1px solid #f5c6cb;
            }
        </style>

        <div class="custom-container">
            <x-validation-errors class="custom-errors" />

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <label for="email" class="custom-label">{{ __('Correo electrónico') }}</label>
                <input id="email" type="email" name="email" class="custom-input"
                       value="{{ old('email', $email) }}" required autofocus autocomplete="username">

                <label for="password" class="custom-label">{{ __('Nueva contraseña') }}</label>
                <input id="password" type="password" name="password" class="custom-input"
                       required autocomplete="new-password">

                <label for="password_confirmation" class="custom-label">{{ __('Confirmar contraseña') }}</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="custom-input"
                       required autocomplete="new-password">

                <div class="flex justify-end">
                    <button type="submit" class="custom-button">
                        {{ __('Cambiar contraseña') }}
                    </button>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
