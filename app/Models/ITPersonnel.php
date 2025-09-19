<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ITPersonnel extends Model
{
 use HasFactory;

    protected $table = 'it_personnel';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'firstname',
        'middle_initial',
        'lastname',
        'it_area',
        'it_email',
        'date_added',
        'date_updated'
    ];
}