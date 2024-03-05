<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Api\Task;
use App\Services\TaskService;
use Exception;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    public function __construct(public TaskService $service)
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return TaskResource::collection($this->service->getAll());
        } catch (Exception $e) {
            return (new TaskResource(['error' => 'error']))
                ->response()
                ->setStatusCode(401);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        try {
            $this->service->create($request);
            return (new TaskResource(['message' => 'The task was created successfully']))
                ->response()
                ->setStatusCode(200);
        } catch (Exception $e) {
            logger($e);
            return (new TaskResource(['error' => 'Error creating task']))
                ->response()
                ->setStatusCode(401);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        try {
            $this->service->update($request, $task);
            return (new TaskResource(['message' => 'Task response sent successfully']))
                ->response()
                ->setStatusCode(200);
        } catch (Exception $e) {
            logger($e);
            return (new TaskResource(['error' => 'error in receiving application']))
                ->response()
                ->setStatusCode(401);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        try {
            $this->service->delete($task);
            return (new TaskResource(['message' => 'The task was successfully deleted']))
                ->response()
                ->setStatusCode(200);
        } catch (Exception $e) {
            return (new TaskResource(['message' => 'Error delete task']))
                ->response()
                ->setStatusCode(400);
        }
    }

    public function filterStatus(Request $request)
    {
        try {
            return TaskResource::collection($this->service->getFilterStatus($request->query('status')));
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function filterDate(Request $request)
    {
        try {
            $date = date('Y-m-d', strtotime($request->query('date')));;
            return TaskResource::collection($this->service->getFilterDate($date));
        } catch (\Exception $e) {
            return (new TaskResource(['message' => 'Error filters task']))
                ->response()
                ->setStatusCode(400);
        }
    }
}
