<?php

namespace App\Services;

use App\Contracts\TaskInterface;
use App\Enums\TaskStatus;
use App\Http\Requests\TaskRequest;
use App\Models\Api\Task;
use App\Repositories\TaskRepository;
use Illuminate\Database\Eloquent\Collection;

class TaskService implements TaskInterface
{
    public function __construct(public TaskRepository $taskRepository)
    {

    }

    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        try {
            return $this->taskRepository->getAll();
        } catch (\Exception $e) {
            throw $e;
        }

    }

    public function create(TaskRequest $request): Task
    {
        try {
            return $this->taskRepository->create([
                'text' => $request->text,
                'status' => TaskStatus::fromString($request->status)->value,
            ]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function update(TaskRequest $request, Task $task): bool
    {
        try {
            $task->fill($request->toArray());
            $task->status = TaskStatus::fromString($request->status)->value;
            return $this->taskRepository->update($task, $task->toArray());

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function delete(Task $task): bool
    {
        try {
            return $this->taskRepository->delete($task);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getFilterStatus(string $status): Collection
    {
        try {
            return $this->taskRepository->getFilterStatus($status);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getFilterDate(string $date): Collection
    {
        try {
            return $this->taskRepository->getFilterDate($date);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
