<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name',
        'description',
        'status_id',
        'creator_id',
        'assigned_id',
    ];

    public function creator ()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function assignedTo ()
    {
        return $this->belongsTo(User::class, 'assigned_id');
    }

    public function status ()
    {
        return $this->belongsTo(TaskStatus::class, 'status_id');
    }

    public function tags ()
    {
        return $this->belongsToMany(Tag::class);
    }
}
