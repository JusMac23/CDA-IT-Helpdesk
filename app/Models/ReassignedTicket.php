<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReassignedTicket extends Model
{
    use HasFactory;

    protected $table = 'reassigned_tickets';
    protected $primaryKey = 'id';

    public $timestamps = false; 

    protected $fillable = [
        'ticket_number',
        'requested_by',
        'request',  
        'assigned_by',
        'previous_assigned',
        'assigned_to',
        'notes',
        'assigned_at',
        'status'
    ];
}
