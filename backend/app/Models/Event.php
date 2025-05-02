<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'status',
        'max_participants',
    ];

    protected $dates = ['start_date', 'end_date'];

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
}
