<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use Illuminate\Http\Request;

class TareasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Mostrar todas las tareas del usuario
    public function mis_tareas()
    {
        $tareas = Task::where('user_id', Auth::id())->get();
        return view('mis-tareas', compact('tareas'));
    }

    // Mostrar vista de agregar tarea
    public function tareas()
    {
        return view('dashboard');
    }

    // Guardar nueva tarea
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
        ]);

        Task::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
            'estado' => 'Pendiente', // Estado inicial para tablero Kanban
            'prioridad' => $request->prioridad ?? 'Baja',
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('mis-tareas')->with('success', '¡Tarea guardada correctamente!');
    }

    // Eliminar tarea
    public function destroy(Task $tarea)
    {
        if ($tarea->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para eliminar esta tarea.');
        }

        $tarea->delete();

        return redirect()->back()->with('success', 'Tarea eliminada correctamente');
    }

    // Cambiar prioridad de una tarea vía Kanban
    public function cambiarPrioridad(Request $request, $id)
    {
        $tarea = Task::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'prioridad' => 'required|in:Alta,Media,Baja',
        ]);

        $tarea->prioridad = $request->prioridad;
        $tarea->save();

        return response()->json([
            'success' => true,
            'mensaje' => 'Prioridad actualizada',
            'prioridad' => $tarea->prioridad,
        ]);
    }
}
