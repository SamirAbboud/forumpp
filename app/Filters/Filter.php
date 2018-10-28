<?php
/**
 * Created by PhpStorm.
 * User: Samir
 * Date: 27/10/2018
 * Time: 23:33
 */

namespace Forum\Filters;

use Illuminate\Http\Request;


abstract class Filter
{
    protected $request, $builder;

    protected $filters = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function apply($builder)
    {
        $this->builder = $builder;

        foreach ($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }

    }

    public function getFilters()
    {
        return $this->request->only($this->filters);
    }
}