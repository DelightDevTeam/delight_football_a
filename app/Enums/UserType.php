<?php

namespace App\Enums;

enum UserType: string
{
    case Admin = "admin";
    case Master = "master";
    case Agent = "agent";
    case User = "user";

    public function rankPoint(): string
    {
        return match ($this) {
            self::Admin => 10,
            self::Master => 20,
            self::Agent => 30,
            self::User => 40,
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Admin => "Admin",
            self::Master => 'Master',
            self::Agent => "Agent",
            self::User => "User",
        };
    }
}
