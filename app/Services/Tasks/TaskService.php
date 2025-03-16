<?php

namespace App\Services\Tasks;

use App\Repositories\TaskRepository;
use App\Services\Tasks\Dto\ListTaskDto;
use Exception;

use Illuminate\Support\Facades\DB;

class TaskService
{
    protected TaskRepository $repository;
    public function __construct(TaskRepository $repository
    ) {
        $this->repository = $repository;
    }

    public function listTasks(ListTaskDto $dto)
    {
        return $this->repository->getPaginate($dto);
    }


    public function storeTask(array $data)
    {
        DB::beginTransaction();
        $task = $this->repository->create($data);
        DB::commit();
        return $task;
    }

    public function getTaskById(string $id){
        $task = $this->repository->getById($id);
        if(!$task){
            DB::rollBack();
            throw new Exception("O id não existe");
        }
        return $task;
    }

    public function updateTask($id, array $data){
        DB::beginTransaction();
        $task = $this->repository->getById($id);
        if(!$task){
            DB::rollBack();
            throw new Exception("O id não existe");
        }
        DB::commit();
        return $this->repository->update($task->id, $data);
    }

    public function updateTaskStatus($id, array $data){
        DB::beginTransaction();
        $task = $this->repository->getById($id);
        if(!$task){
            DB::rollBack();
            throw new Exception("O id não existe");
        }
        DB::commit();
        return $this->repository->update($task->id, $data);
    }

    public function deleteTask(string $id): void
    {
        DB::beginTransaction();

        $task = $this->repository->getById($id);

        if(!$task){
            DB::rollBack();
            throw new Exception("O id não existe");
        }

        $task->delete();

        DB::commit();
    }
    
}
