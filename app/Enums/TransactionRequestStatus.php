<?php

namespace App\Enums;

enum TransactionRequestStatus: string
{
    case Pending = "pending";
    case Accepted = "accepted";
    case Rejected = "rejected";
}
