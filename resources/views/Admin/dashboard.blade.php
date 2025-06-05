<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-900">
            Panel de Administrador
        </h2>
    </x-slot>

    <div class="flex min-h-screen bg-gray-50">
        <!-- Sidebar blanca -->
        <aside class="w-64 bg-white text-gray-800 min-h-screen px-4 py-6 space-y-6 border-r">
            <h2 class="text-xl font-semibold">Opciones de Admin</h2>
            <nav class="space-y-2">
                <a href="{{ route('Admin.users') }}" class="block px-3 py-2 rounded hover:bg-gray-100">👥 Gestionar Usuarios</a>
                <a href="{{ url('/admin/roles') }}" class="block px-3 py-2 rounded hover:bg-gray-100">🔐 Gestionar Roles</a>
                <a href="{{ url('/admin/tareas') }}" class="block px-3 py-2 rounded hover:bg-gray-100">🗂️ Gestionar Tareas</a>
                <a href="{{ url('/') }}" class="block px-3 py-2 rounded hover:bg-gray-100">🏠 Ir al sitio principal</a>
            </nav>

            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="mt-6 w-full bg-red-600 hover:bg-red-700 px-3 py-2 rounded text-white font-semibold">
                    🚪 Cerrar Sesión
                </button>
            </form>
        </aside>

        <!-- Contenido principal -->
        <main class="flex-1 p-8">
            <div class="bg-white shadow-xl rounded-2xl p-6">
                <h3 class="text-xl font-semibold text-indigo-700 mb-6">📈 Visitas Recientes</h3>
                <table class="w-full table-auto text-sm border border-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Página</th>
                            <th class="px-4 py-2">Fecha de Creación</th>
                            <th class="px-4 py-2">Fecha de Actualización</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600">
                        @foreach ($visits as $visit)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $visit->id }}</td>
                                <td class="px-4 py-2">{{ $visit->page }}</td>
                                <td class="px-4 py-2">{{ $visit->created_at }}</td>
                                <td class="px-4 py-2">{{ $visit->updated_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h3 class="text-xl font-semibold text-indigo-700 mt-10 mb-6">🧾 Logs de Visitas</h3>
                <table class="w-full table-auto text-sm border border-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Página</th>
                            <th class="px-4 py-2">IP</th>
                            <th class="px-4 py-2">Fecha</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600">
                        @foreach ($visitLogs as $log)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $log->id }}</td>
                                <td class="px-4 py-2">{{ $log->page }}</td>
                                <td class="px-4 py-2">{{ $log->ip_address }}</td>
                                <td class="px-4 py-2">{{ $log->visited_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</x-app-layout>
