<?php

namespace App\Repositories;

use App\Services\Musicas\Dto\ListaMusicasDto;

use App\Models\Task;
use App\Services\Tasks\Dto\ListTaskDto;

class TaskRepository
{

    protected Task $model;

    public function __construct(Task $model ){
        $this->model = $model;
    }

    public function getPaginate(ListTaskDto $dto)
    {
        $query = $this->model->query();

        $sortColumn = $dto->sort_column ?? 'id';
        $sortDirection = $dto->sort_direction ?? 'asc';

        if (in_array($sortColumn, ['id', 'title', 'description', 'status', 'user_id', 'created_at', 'updated_at'])) {
            $query->orderBy($sortColumn, $sortDirection);
        }

        $limit = $dto->limit ?? 10;
        $page = $dto->page ?? 1;

        return $query->paginate($limit, ['*'], 'page', $page);
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
