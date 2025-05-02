<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use Carbon\Carbon;

class ExpireEvents extends Command
{
    protected $signature = 'events:expire';
    protected $description = 'Met à jour le statut des événements expirés';

    public function handle()
    {
        $now = Carbon::now();

        $events = Event::where('status', 'actif')
            ->whereDate('end_date', '<=', $now->toDateString())
            ->get();

        foreach ($events as $event) {
            $event->update(['status' => 'expiré']);
        }

        $this->info('Statut des événements mis à jour.');
    }
}

