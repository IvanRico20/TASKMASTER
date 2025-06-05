<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TareasKanban extends Component
{
    public $tareas;

    public function mount()
    {
        $this->loadTareas();
    }

    public function loadTareas()
    {
        $this->tareas = Task::where('user_id', Auth::id())->get();
    }

    public function render()
    {
        return view('livewire.tareas-kanban');
    }
}
