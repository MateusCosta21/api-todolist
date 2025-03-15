<?php

namespace App\Repositories;

use App\Services\Musicas\Dto\ListaMusicasDto;

use App\Models\Task;

class TaskRepository
{

    protected Task $model;

    public function __construct(Task $model ){
        $this->model = $model;
    }

    public function create(array $dados)
    {
        return $this->model->create($dados);
    }


}
