<?php

namespace App\Observers;

use App\Events\FurnitureRequestResolved;
use App\Models\FurnitureRequest;
use App\Traits\TaskLoad;

class FurnitureRequestObserver
{
    use TaskLoad;
    /**
     * Handle the FurnitureRequest "created" event.
     */
    public function created(FurnitureRequest $furnitureRequest): void
    {
        $this->loadTask($furnitureRequest, $furnitureRequest->description, "furniture-request", "staff", "AFM");
    }

    /**
     * Handle the FurnitureRequest "updated" event.
     */
    public function updated(FurnitureRequest $furnitureRequest): void
    {
        if ($furnitureRequest->status !== "pending") {
            FurnitureRequestResolved::dispatch($furnitureRequest, $furnitureRequest->staff);
        }
    }

    /**
     * Handle the FurnitureRequest "deleted" event.
     */
    public function deleted(FurnitureRequest $furnitureRequest): void
    {
        //
    }

    /**
     * Handle the FurnitureRequest "restored" event.
     */
    public function restored(FurnitureRequest $furnitureRequest): void
    {
        //
    }

    /**
     * Handle the FurnitureRequest "force deleted" event.
     */
    public function forceDeleted(FurnitureRequest $furnitureRequest): void
    {
        //
    }
}
