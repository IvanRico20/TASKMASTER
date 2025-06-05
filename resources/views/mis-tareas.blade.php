<x-app-layout> 
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-900">
                {{ __('🗂️ Mis Tareas') }}
            </h2>

            <div class="flex space-x-3">
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-sm font-semibold rounded-xl shadow-md hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                   ➕ Agregar Nueva Tarea
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-2xl rounded-2xl p-6">

                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg shadow-sm">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                <h3 class="text-xl font-semibold text-indigo-700 mb-8 flex items-center gap-2">
                    📌 Tablero Kanban
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {{-- Columna Alta --}}
                    <div class="kanban-column" data-prioridad="Alta" ondrop="drop(event)" ondragover="allowDrop(event)">
                        <h4 class="text-lg font-bold text-red-600 mb-4 text-center">🔥 Prioridad Alta</h4>
                        @forelse ($tareas->where('prioridad', 'Alta') as $tarea)
                            <div id="tarea-{{ $tarea->id }}"
                                 class="kanban-card mb-5 p-4 bg-red-50 border border-red-200 rounded-xl shadow"
                                 draggable="true"
                                 ondragstart="drag(event)">
                                <h5 class="text-md font-semibold text-red-800">{{ $tarea->titulo }}</h5>
                                <p class="text-sm text-gray-600 mt-1">{{ $tarea->descripcion }}</p>
                                <p class="text-xs text-gray-500 mt-2">📅 {{ $tarea->fecha }}</p>
                                <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST" class="mt-2 text-right">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Eliminar esta tarea?')" class="text-sm text-red-600 hover:text-red-800">
                                        🗑️ Eliminar
                                    </button>
                                </form>
                            </div>
                        @empty
                            <p class="text-center text-gray-400 italic">Sin tareas urgentes</p>
                        @endforelse
                    </div>

                    {{-- Columna Media --}}
                    <div class="kanban-column" data-prioridad="Media" ondrop="drop(event)" ondragover="allowDrop(event)">
                        <h4 class="text-lg font-bold text-yellow-600 mb-4 text-center">⚖️ Prioridad Media</h4>
                        @forelse ($tareas->where('prioridad', 'Media') as $tarea)
                            <div id="tarea-{{ $tarea->id }}"
                                 class="kanban-card mb-5 p-4 bg-yellow-50 border border-yellow-200 rounded-xl shadow"
                                 draggable="true"
                                 ondragstart="drag(event)">
                                <h5 class="text-md font-semibold text-yellow-800">{{ $tarea->titulo }}</h5>
                                <p class="text-sm text-gray-600 mt-1">{{ $tarea->descripcion }}</p>
                                <p class="text-xs text-gray-500 mt-2">📅 {{ $tarea->fecha }}</p>
                                <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST" class="mt-2 text-right">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Eliminar esta tarea?')" class="text-sm text-red-600 hover:text-red-800">
                                        🗑️ Eliminar
                                    </button>
                                </form>
                            </div>
                        @empty
                            <p class="text-center text-gray-400 italic">Sin tareas de prioridad media</p>
                        @endforelse
                    </div>

                    {{-- Columna Baja --}}
                    <div class="kanban-column" data-prioridad="Baja" ondrop="drop(event)" ondragover="allowDrop(event)">
                        <h4 class="text-lg font-bold text-green-600 mb-4 text-center">🌿 Prioridad Baja</h4>
                        @forelse ($tareas->where('prioridad', 'Baja') as $tarea)
                            <div id="tarea-{{ $tarea->id }}"
                                 class="kanban-card mb-5 p-4 bg-green-50 border border-green-200 rounded-xl shadow"
                                 draggable="true"
                                 ondragstart="drag(event)">
                                <h5 class="text-md font-semibold text-green-800">{{ $tarea->titulo }}</h5>
                                <p class="text-sm text-gray-600 mt-1">{{ $tarea->descripcion }}</p>
                                <p class="text-xs text-gray-500 mt-2">📅 {{ $tarea->fecha }}</p>
                                <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST" class="mt-2 text-right">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Eliminar esta tarea?')" class="text-sm text-red-600 hover:text-red-800">
                                        🗑️ Eliminar
                                    </button>
                                </form>
                            </div>
                        @empty
                            <p class="text-center text-gray-400 italic">Sin tareas de baja prioridad</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Kanban Script --}}
    <script>
        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        }

        function drop(ev) {
            ev.preventDefault();
            const cardId = ev.dataTransfer.getData("text");
            const card = document.getElementById(cardId);
            const nuevaPrioridad = ev.currentTarget.getAttribute('data-prioridad');

            ev.currentTarget.appendChild(card);

            const tareaId = cardId.replace('tarea-', '');

            fetch(`/tareas/${tareaId}/cambiar-prioridad`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ prioridad: nuevaPrioridad })
            })
            .then(res => res.json())
            .then(data => console.log('Tarea actualizada:', data))
            .catch(err => console.error('Error:', err));
        }
    </script>

    <style>
        .kanban-column {
            min-height: 400px;
            background-color: #f9fafb;
            border: 2px dashed #e5e7eb;
            border-radius: 1rem;
            padding: 1rem;
        }

        .kanban-card {
            background-color: white;
            cursor: grab;
            transition: transform 0.2s ease;
        }

        .kanban-card:hover {
            transform: scale(1.02);
        }
    </style>
</x-app-layout>
