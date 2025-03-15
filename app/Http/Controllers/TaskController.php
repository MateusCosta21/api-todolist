<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
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
}
