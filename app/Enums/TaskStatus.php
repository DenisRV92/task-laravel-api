<?php

namespace App\Enums;

enum TaskStatus: int
{
    case Active = 1;
    case Resolved = 0;


    public static function fromString($type): TaskStatus
    {
        return match (strtolower($type)) {
            'active' => TaskStatus::Active,
            'resolved' => TaskStatus::Resolved,
            default => TaskStatus::Active
        };
    }
}
