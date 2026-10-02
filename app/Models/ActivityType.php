<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityType extends Model
{
    protected $table = 'activity_types';

    protected $fillable = [
        'code',
        'name',
        'requires_lecturer',
        'is_group_activity',
        'is_active',
    ];

    protected $casts = [
        'requires_lecturer' => 'boolean',
        'is_group_activity' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function classes()
    {
        return $this->hasMany(ClassModel::class, 'activity_type_id');
    }
}