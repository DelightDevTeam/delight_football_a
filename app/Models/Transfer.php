<?php

namespace App\Models;

use Bavix\Wallet\Models\Transfer as BavixTransfer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends BavixTransfer
{
    use HasFactory;
}
