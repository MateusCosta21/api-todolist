<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Http\Resources\TaskResource;
use App\Services\Tasks\TaskService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class TaskController extends Controller
{
    protected TaskService $service;

    public function __construct(TaskService $service)
    {
        $this->service = $service;
    }

    public function store(StoreTaskRequest $request)
    {
        $task = $this->service->storeTask($request->validated());
        return (new TaskResource($task))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
    public function update(UpdateTaskRequest $request, int $id){
        $task = $this->service->updateTask($id, $request->all());
        return(new TaskResource($task))
        ->response()
        ->setStatusCode(Response::HTTP_OK);
    }
    public function updateStatus(UpdateTaskStatusRequest $request, $id)
    {
        $task = $this->service->updateTaskStatus($id, $request->validated());
        return (new TaskResource($task))
        ->response()
        ->setStatusCode(Response::HTTP_OK);
    }
}
