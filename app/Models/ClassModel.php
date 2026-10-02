<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassModel extends Model
{
    use SoftDeletes;

    protected $table = 'classes';

    protected $fillable = [
        'batch_module_id',
        'activity_type_id',
        'topic',
        'group_name',
        'class_date',
        'start_time',
        'end_time',
        'laboratory_id',
        'venue',
        'status',
        'remarks',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'class_date' => 'date',
    ];

    public function batchModule()
    {
        return $this->belongsTo(BatchModule::class);
    }

    public function activityType()
    {
        return $this->belongsTo(ActivityType::class);
    }

    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class);
    }

    public function staff()
    {
        return $this->belongsToMany(Staff::class, 'class_staff', 'class_id', 'staff_id')
                    ->withPivot('is_primary')
                    ->withTimestamps();
    }

    public function histories()
    {
        return $this->hasMany(ClassHistory::class, 'class_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}