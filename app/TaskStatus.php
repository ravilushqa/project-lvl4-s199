<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'status_id');
    }
}
