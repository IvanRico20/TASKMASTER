<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-900">
                {{ __('📋 Dashboard de Tareas') }}
            </h2>

            {{-- Botón "Mis Tareas" --}}
            <a href="{{ route('mis-tareas') }}"
               class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-sm font-semibold rounded-xl shadow-md hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
               🔙 Volver
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-2xl sm:rounded-2xl p-8 transition-all duration-300 hover:shadow-xl">

                {{-- Mensaje de éxito --}}
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg shadow-sm">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                {{-- Título --}}
                <h3 class="text-xl font-semibold text-indigo-700 mb-6 flex items-center gap-2">
                    ✍️ Agregar Nueva Tarea
                </h3>

                {{-- Formulario de agregar tarea --}}
                <form action="{{ route('tareas.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="titulo" class="block text-sm font-medium text-gray-700">Título de la tarea</label>
                        <input type="text" name="titulo" id="titulo" required
                               class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition-all" />
                    </div>

                    <div>
                        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea name="descripcion" id="descripcion" rows="4" required
                                  class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition-all"></textarea>
                    </div>

                    <div>
                        <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
                        <input type="date" name="fecha" id="fecha" required
                               class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition-all" />
                    </div>

                    {{-- Selector de Prioridad --}}
                    <div>
                        <label for="prioridad" class="block text-sm font-medium text-gray-700">Prioridad</label>
                        <select name="prioridad" id="prioridad" required
                                class="mt-1 block w-full bg-white border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                            <option value="" disabled selected>Selecciona una prioridad</option>
                            <option value="Alta">🔥 Alta</option>
                            <option value="Media">⚖️ Media</option>
                            <option value="Baja">🌿 Baja</option>
                        </select>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-6 rounded-lg shadow-lg transition-all duration-200 transform hover:scale-105">
                            💾 Guardar Tarea
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
