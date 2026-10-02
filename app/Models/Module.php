<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
        'code',
        'name',
        'phase_id',
        'strand_id',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function phase()
    {
        return $this->belongsTo(Phase::class);
    }

    public function strand()
    {
        return $this->belongsTo(Strand::class);
    }

    public function batchModules()
    {
        return $this->hasMany(BatchModule::class);
    }
}