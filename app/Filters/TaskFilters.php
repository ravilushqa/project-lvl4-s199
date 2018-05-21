<?php

namespace App\Filters;

use App\Tag;
use App\TaskStatus;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * @property  builder
 */
class TaskFilters extends Filters
{
    protected $filters = [
        'creator',
        'assigned',
        'status',
        'tag'
    ];

    /**
     * Filter a query by a given creator username.
     *
     * @param string $username
     * @return mixed
     */
    protected function creator($username)
    {
        $user = User::where('name', $username)->firstOrFail();
        return $this->builder->where('creator_id', $user->getKey());
    }

    /**
     * Filter a query by a given assigned username.
     *
     * @param string $username
     * @return mixed
     */
    protected function assigned($username)
    {
        $user = User::where('name', $username)->firstOrFail();
        return $this->builder->where('assigned_id', $user->getKey());
    }

    /**
     * Filter a query by a given status name.
     *
     * @param string $status
     * @return mixed
     */
    protected function status($statusName)
    {
        $status = TaskStatus::where('name', $statusName)->firstOrFail();
        return $this->builder->where('status_id', $status->getKey());
    }

    /**
     * Filter a query by a given status name.
     *
     * @param string $status
     * @return mixed
     */
    protected function tag($tagName)
    {
        return $this->builder->whereHas('tags', function (Builder $query) use ($tagName) {
            $query->where('name', $tagName);
        });
    }
}
