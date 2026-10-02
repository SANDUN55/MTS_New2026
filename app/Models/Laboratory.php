<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    protected $fillable = [
        'code', 'name', 'department_id', 'capacity', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function reservations()
    {
        return $this->hasMany(LabReservation::class);
    }
}