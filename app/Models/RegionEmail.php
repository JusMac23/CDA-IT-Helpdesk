<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionEmail extends Model
{
 use HasFactory;

    protected $table = 'region_email';

    protected $primaryKey = 'area_id';

    protected $fillable = [
        'region',
        'email',
        'added_at',
        'date_updated',
    ];
}
