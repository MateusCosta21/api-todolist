<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Http\Resources\TaskResource;
use App\Services\Tasks\TaskService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\ResponseAPI;
use App\Services\Tasks\Dto\ListTaskDto;

class TaskController extends Controller
{
    protected TaskService $service;

    public function __construct(TaskService $service)
    {
        $this->service = $service;
    }

    public function list(Request $request)
    {
        $inputDto = new ListTaskDto(
            $request->get('filter', ''),
            $request->get('sort_column', 'name'),
            $request->get('sort_direction', 'DESC'),
            (int) $request->get('page', 1),
            (int) $request->get('limit', 10)
        );

        $paginatedFolders = $this->service->listTasks($inputDto);
        $paginatedFolders->appends(request()->query());

        return TaskResource::collection($paginatedFolders);
    }

    public function show(string $id)
    {

        $task = $this->service->getTaskById($id);

        return (new TaskResource($task))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function store(StoreTaskRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->id();

        $task = $this->service->storeTask($validatedData);

        return (new TaskResource($task))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
    public function update(UpdateTaskRequest $request, int $id)
    {
        $task = $this->service->updateTask($id, $request->all());
        return (new TaskResource($task))
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

    public function destroy(string $id)
    {
        $this->service->deleteTask($id);
        return response()->noContent();
    }
}
