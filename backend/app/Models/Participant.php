<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'event_id',
        'ticket_uuid',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}

