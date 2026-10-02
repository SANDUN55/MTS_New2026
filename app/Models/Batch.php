<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $fillable = [
        'code',
        'academic_year',
        'current_year',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function batchModules()
    {
        return $this->hasMany(BatchModule::class);
    }

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'batch_module')
                    ->withPivot(['start_date', 'end_date', 'chair_id', 'co_chair_id', 'status'])
                    ->withTimestamps();
    }
}