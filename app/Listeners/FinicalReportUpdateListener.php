<?php

namespace App\Listeners;

use App\Jobs\FinicalReportUpdateJob;
use Bavix\Wallet\Internal\Events\TransactionCreatedEventInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class FinicalReportUpdateListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TransactionCreatedEventInterface $event): void
    {
        FinicalReportUpdateJob::dispatch()->delay(5);
    }
}
