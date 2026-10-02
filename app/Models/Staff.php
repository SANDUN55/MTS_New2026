<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
        'staff_code',
        'title',
        'first_name',
        'last_name',
        'email',
        'department_id',
        'staff_type',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function classes()
    {
        return $this->belongsToMany(ClassModel::class, 'class_staff', 'staff_id', 'class_id')
                    ->withPivot('is_primary')
                    ->withTimestamps();
    }

    public function getFullNameAttribute()
    {
        return trim("{$this->title} {$this->first_name} {$this->last_name}");
    }
}