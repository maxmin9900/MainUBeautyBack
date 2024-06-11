<?php

namespace App\Observers;

use App\Models\Service\ServiceProvider;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Support\Facades\Log;

class ServiceProviderObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the ServiceProvider "created" event.
     */
    public function created(ServiceProvider $serviceProvider): void
    {
        Log::info("DAs");
        $serviceProvider->User()->increment('serviceCount');
        $serviceProvider->Service()->increment('providersCount');
    }

    /**
     * Handle the ServiceProvider "updated" event.
     */
    public function updated(ServiceProvider $serviceProvider): void
    {
        //
    }

    /**
     * Handle the ServiceProvider "deleted" event.
     */
    public function deleted(ServiceProvider $serviceProvider): void
    {
        $serviceProvider->User()->decrement('serviceCount');
        $serviceProvider->Service()->decrement('providersCount');
    }

    /**
     * Handle the ServiceProvider "restored" event.
     */
    public function restored(ServiceProvider $serviceProvider): void
    {
        //
    }

    /**
     * Handle the ServiceProvider "force deleted" event.
     */
    public function forceDeleted(ServiceProvider $serviceProvider): void
    {
        //
    }
}
