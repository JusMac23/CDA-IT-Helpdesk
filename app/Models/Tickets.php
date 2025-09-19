<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory;

    protected $table = 'tickets';
    protected $primaryKey = 'ticket_id';

    public $timestamps = false; 

    protected $fillable = [
        'ticket_number',
        'firstname',
        'lastname',
        'status',
        'date_created',
        'division',
        'it_area',
        'email',
        'device',
        'service',
        'request',
        'action_taken',
        'photo',
        'it_personnel',
        'it_email',
        'date_resolved',
        'assigned_to',
        'assigned_it_email',
        'notes'
    ];
}
