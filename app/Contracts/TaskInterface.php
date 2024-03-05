<?php

namespace App\Contracts;

use App\Http\Requests\TaskRequest;
use App\Models\Api\Task;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

interface TaskInterface
{
    public function create(TaskRequest $request): Task;

    public function update(TaskRequest $request, Task $task): bool;

    public function getAll(): Collection;

    public function delete(Task $task): bool;

    public function getFilterStatus(string $status): Collection;

    public function getFilterDate(string $date): Collection;
}
