<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['code', 'name', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function staff()
    {
        return $this->hasMany(Staff::class);
    }

    public function laboratories()
    {
        return $this->hasMany(Laboratory::class);
    }
}