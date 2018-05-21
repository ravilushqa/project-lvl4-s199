<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Filters
{
    protected $request;
    /**
     * @var Builder
     */
    protected $builder;
    protected $filters = [];
    /**
     * ThreadFilters constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * @param $builder
     * @return mixed
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;
        foreach ($this->getFilters() as $filter => $value) {
            if ($value === null) {
                continue;
            }
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }
        return $this->builder;
    }
    public function getFilters()
    {
        return $this->request->only($this->filters);
    }
}
