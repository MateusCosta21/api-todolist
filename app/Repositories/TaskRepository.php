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
    public function getById(int $id){
        return $this->model->find($id);
    }

    public function update(int $id, array $data){
        $this->model->where('id', $id)->update($data);
        return $this->model->find($id);
    }


}
