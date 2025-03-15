<?php

namespace App\Services\Tasks;

use App\Repositories\TaskRepository;
use Exception;

use Illuminate\Support\Facades\DB;

class TaskService
{
    protected TaskRepository $repository;
    public function __construct(TaskRepository $repository
    ) {
        $this->repository = $repository;
    }

    
    public function storeTask(array $data)
    {
        DB::beginTransaction();
        $meeting = $this->repository->create($data);
        DB::commit();
        return $meeting;
    }

}
