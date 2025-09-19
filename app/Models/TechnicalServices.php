<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicalServices extends Model
{
 use HasFactory;

    protected $table = 'technical_services';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'technical_services',
        'added_at',
        'updated_at'
    ];
}
