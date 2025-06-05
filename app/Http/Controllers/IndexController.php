<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\VisitLog; // <- Modelo adicional para logs por IP
use Carbon\Carbon;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $ip = $request->ip();
        $page = 'landing';
        $today = Carbon::today();

        // Verifica si esta IP ya visitó hoy
        $alreadyVisited = VisitLog::where('page', $page)
            ->where('ip_address', $ip)
            ->whereDate('visited_at', $today)
            ->exists();

        if (!$alreadyVisited) {
            // Crea o actualiza el registro de la página
            $visit = Visit::firstOrCreate(['page' => $page]);
            $visit->increment('count');

            // Registra la visita de esta IP
            VisitLog::create([
                'page' => $page,
                'ip_address' => $ip,
                'visited_at' => now(),
            ]);
        } else {
            // Solo recupera el contador actual si ya visitó
            $visit = Visit::where('page', $page)->first();
        }

        return view('auth.index', ['visits' => $visit->count ?? 0]);
    }
}
