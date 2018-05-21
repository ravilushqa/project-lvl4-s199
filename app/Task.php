<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($task) {

            $task->creator_id = \Auth::user()->getKey();
        });
    }

    protected $fillable = [
        'name',
        'description',
        'status_id',
        'creator_id',
        'assigned_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_id');
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class, 'status_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * @param $query
     * @param $filters
     * @return mixed
     */
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
