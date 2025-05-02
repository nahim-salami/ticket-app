<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Liste des événements
    public function index()
    {
        return Event::all();
    }

    // Créer un nouvel événement
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'max_participants' => 'required|integer|min:1',
        ]);

        $validated['status'] = 'actif';

        $event = Event::create($validated);

        return response()->json($event, 201);
    }

    // Afficher un événement spécifique
    public function show(Event $event)
    {
        return $event;
    }

    // Mettre à jour un événement
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
            'start_date' => 'sometimes|required|date',
            'end_date' => 'sometimes|required|date|after_or_equal:start_date',
            'max_participants' => 'sometimes|required|integer|min:1',
            'status' => 'sometimes|required|in:actif,expiré',
        ]);

        $event->update($validated);

        return response()->json($event);
    }

    // Supprimer un événement (soft delete)
    public function destroy(Event $event)
    {
        $event->delete();

        return response()->json(['message' => 'Événement supprimé'], 200);
    }

    // Liste des participants d'un événement
    public function participants(Event $event)
    {
        return $event->participants;
    }
}
