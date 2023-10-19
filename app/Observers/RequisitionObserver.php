<?php

namespace App\Observers;

use App\Models\Department;
use App\Models\Requisition;
use App\Models\Task;
use App\Traits\TaskLoad;

class RequisitionObserver
{
    use TaskLoad;
    /**
     * Handle the Requisition "created" event.
     */
    public function created(Requisition $requisition): void
    {
        //
    }

    /**
     * Handle the Requisition "updated" event.
     */
    public function updated(Requisition $requisition): void
    {
        if ($requisition->status === "registered") {
            $this->loadTask($requisition, "Handle request with code " . $requisition?->code, "requisition");
        }
    }

    /**
     * Handle the Requisition "deleted" event.
     */
    public function deleted(Requisition $requisition): void
    {
        //
    }

    /**
     * Handle the Requisition "restored" event.
     */
    public function restored(Requisition $requisition): void
    {
        //
    }

    /**
     * Handle the Requisition "force deleted" event.
     */
    public function forceDeleted(Requisition $requisition): void
    {
        //
    }
}
