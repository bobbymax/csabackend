<?php

namespace App\Providers;

use App\Events\RequisitionApproved;
use App\Events\RequisitionConfirmed;
use App\Events\TaskAssigned;
use App\Listeners\SendRequisitionApprovedMail;
use App\Listeners\SendRequisitionConfirmationMail;
use App\Listeners\SendTaskAssignedConfirmationEmail;
use App\Models\Booking;
use App\Models\LogisticsRequest;
use App\Models\Requisition;
use App\Observers\BookingObserver;
use App\Observers\LogisticsRequestObserver;
use App\Observers\RequisitionObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        TaskAssigned::class => [
            SendTaskAssignedConfirmationEmail::class,
        ],

        RequisitionApproved::class => [
            SendRequisitionApprovedMail::class,
        ],

        RequisitionConfirmed::class => [
            SendRequisitionConfirmationMail::class
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Requisition::observe(RequisitionObserver::class);
        LogisticsRequest::observe(LogisticsRequestObserver::class);
        Booking::observe(BookingObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
