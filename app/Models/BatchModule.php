<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BatchModule extends Model
{
    protected $table = 'batch_module';

    protected $fillable = [
        'batch_id',
        'module_id',
        'start_date',
        'end_date',
        'chair_id',
        'co_chair_id',
        'status',
        'published_at',
        'confirmed_at',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'published_at' => 'datetime',
        'confirmed_at' => 'datetime',
    ];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function chair()
    {
        return $this->belongsTo(Staff::class, 'chair_id');
    }

    public function coChair()
    {
        return $this->belongsTo(Staff::class, 'co_chair_id');
    }

    public function classes()
    {
        return $this->hasMany(ClassModel::class, 'batch_module_id');
    }
}