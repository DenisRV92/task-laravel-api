<?php

namespace App\Repositories;

use App\Contracts\TaskInterface;
use App\Contracts\TaskRepositoryInterface;
use App\Enums\TaskStatus;
use App\Models\Api\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Array_;

class TaskRepository implements TaskRepositoryInterface
{
    public function getAll(): Collection
    {
        return Task::all();
    }

    public function create(array $data): Task
    {
        return Task::create($data);
    }

    public function update(Task $task, array $data): bool
    {
        return $task->update($data);
    }

    public function getFilterStatus(string $status): Collection
    {
        return Task::where('status', TaskStatus::fromString($status)->value)->get();
    }

    public function getFilterDate(string $date): Collection
    {
        return Task::where('created_at', 'like', "$date%")->get();
    }

    public function delete(Task $task): bool
    {
        return $task->delete();
    }
}
