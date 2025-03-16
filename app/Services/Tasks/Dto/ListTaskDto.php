<?php

namespace App\Services\Tasks\Dto;

class ListTaskDto
{
    public $filter;
    public $sort_column;
    public $sort_direction;
    public $page;
    public $limit;

    public function __construct(
        $filter = '',
        $sort_column = 'name',
        $sort_direction = 'desc',
        $page = 1,
        $limit = 10
    ) {
        $this->filter = $filter;
        $this->sort_column = $sort_column;
        $this->sort_direction = $sort_direction;
        $this->page = $page;
        $this->limit = $limit;
    }
}
