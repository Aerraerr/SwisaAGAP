<?php

namespace App\Observers;

use App\Models\Application;
use App\Models\ApplicationStatusHistory;

class ApplicationObserver
{
    /**
     * Handle the Application "created" event.
     * ✅ Log the initial status when application is created
     */
    public function created(Application $application): void
    {
        ApplicationStatusHistory::create([
            'application_id' => $application->id,
            'status_id' => $application->status_id,
            'notes' => 'Application created',
            'changed_by' => $application->user_id,
        ]);
    }

    /**
     * Handle the Application "updated" event.
     * ✅ Log status change when status_id changes
     */
    public function updated(Application $application): void
    {
        // Check if status_id has changed
        if ($application->isDirty('status_id')) {
            ApplicationStatusHistory::create([
                'application_id' => $application->id,
                'status_id' => $application->status_id,
                'notes' => 'Status changed from ' . $application->getOriginal('status_id') . ' to ' . $application->status_id,
                'changed_by' => auth()->id() ?? $application->user_id,
            ]);
        }
    }
}
