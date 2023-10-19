<?php

namespace App\Observers;

use App\Models\Department;
use App\Models\LogisticsRequest;
use App\Models\Task;
use App\Traits\TaskLoad;

class LogisticsRequestObserver
{
    use TaskLoad;
    /**
     * Handle the LogisticsRequest "created" event.
     */
    public function created(LogisticsRequest $logisticsRequest): void
    {
        $this->loadTask($logisticsRequest, "Handle request with code " . $logisticsRequest?->code, "logistics");
    }

    /**
     * Handle the LogisticsRequest "updated" event.
     */
    public function updated(LogisticsRequest $logisticsRequest): void
    {
        //
    }

    /**
     * Handle the LogisticsRequest "deleted" event.
     */
    public function deleted(LogisticsRequest $logisticsRequest): void
    {
        //
    }

    /**
     * Handle the LogisticsRequest "restored" event.
     */
    public function restored(LogisticsRequest $logisticsRequest): void
    {
        //
    }

    /**
     * Handle the LogisticsRequest "force deleted" event.
     */
    public function forceDeleted(LogisticsRequest $logisticsRequest): void
    {
        //
    }
}
