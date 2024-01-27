<?php

namespace App\Providers;

use App\Events\FurnitureRequestResolved;
use App\Events\RequisitionApproved;
use App\Events\RequisitionConfirmed;
use App\Events\SupportTicketCreated;
use App\Events\TaskAssigned;
use App\Listeners\SendFurnitureRequestResolutionMail;
use App\Listeners\SendRequisitionApprovedMail;
use App\Listeners\SendRequisitionConfirmationMail;
use App\Listeners\SendSupportTicketCreatedMail;
use App\Listeners\SendTaskAssignedConfirmationEmail;
use App\Models\Booking;
use App\Models\FurnitureRequest;
use App\Models\LogisticsRequest;
use App\Models\Requisition;
use App\Models\Ticket;
use App\Observers\BookingObserver;
use App\Observers\FurnitureRequestObserver;
use App\Observers\LogisticsRequestObserver;
use App\Observers\RequisitionObserver;
use App\Observers\TicketObserver;
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
        ],

        SupportTicketCreated::class => [
            SendSupportTicketCreatedMail::class
        ],

        FurnitureRequestResolved::class => [
            SendFurnitureRequestResolutionMail::class
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
        Ticket::observe(TicketObserver::class);
        FurnitureRequest::observe(FurnitureRequestObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
