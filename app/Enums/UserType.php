<?php

namespace App\Enums;

enum UserType: string
{
    case Admin = "admin";
    case Master = "master";
    case Agent = "agent";
    case User = "user";
}
