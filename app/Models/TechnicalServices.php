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
        'low',
        'medium',
        'high',
        'critical',
        'added_at',
        'updated_at'
    ];

    private function formatSlaValue($value)
    {
        if (is_null($value) || trim((string)$value) === '' || strtoupper(trim((string)$value)) === 'N/A') {
            return 'N/A';
        }
        return $value;
    }

    public function getLowResolutionTimeAttribute($value)
    {
        return $this->formatSlaValue($value);
    }

    public function getMediumResolutionTimeAttribute($value)
    {
        return $this->formatSlaValue($value);
    }

    public function getHighResolutionTimeAttribute($value)
    {
        return $this->formatSlaValue($value);
    }

    public function getCriticalResolutionTimeAttribute($value)
    {
        return $this->formatSlaValue($value);
    }
}