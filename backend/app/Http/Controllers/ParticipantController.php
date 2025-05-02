<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Participant;
use App\Mail\TicketMail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class ParticipantController extends Controller
{
    // Inscription à un événement
    public function store(Request $request, Event $event)
    {
        // Vérifier si l'événement est actif
        if ($event->status !== 'actif') {
            return response()->json(['message' => 'Événement non actif'], 400);
        }

        // Vérifier le nombre de participants
        if ($event->participants()->count() >= $event->max_participants) {
            return response()->json(['message' => 'Événement complet'], 400);
        }

        $validated = $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email|unique:participants,email,NULL,id,event_id,' . $event->id,
        ]);

        $validated['event_id'] = $event->id;
        $validated['ticket_uuid'] = Str::uuid();

        $participant = Participant::create($validated);

        // Envoi du ticket par email
        Mail::to($participant->email)->send(new TicketMail($participant));

        return response()->json(['message' => 'Inscription réussie'], 201);
    }
}
