<?php

namespace App\Contracts;

use App\Models\Api\Task;
use Illuminate\Database\Eloquent\Collection;

interface TaskRepositoryInterface
{
    public function getAll(): Collection;

    public function create(array $data): Task;

    public function update(Task $task, array $data): bool;

    public function getFilterStatus(string $status): Collection;

    public function getFilterDate(string $date): Collection;

    public function delete(Task $task): bool;

}
