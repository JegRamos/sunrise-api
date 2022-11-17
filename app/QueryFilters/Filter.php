<?php

namespace App\QueryFilters;

use Closure;
use Exception;
use Illuminate\Contracts\Database\Query\Builder;

abstract class Filter
{
    /**
     * @throws Exception
     */
    public function handle(Builder $request, Closure $next)
    {
        if (!request()->has($this->getFilterName())) {
            return $next($request);
        }

        /** @var Builder $builder */
        $builder = $next($request);

        return $this->applyFilter($builder);
    }

    abstract protected function getFilterName(): string;

    abstract protected function applyFilter(Builder $builder): Builder;
}
