<?php

namespace App\Console\Commands;

use App\Models\Application;
use App\Models\ApplicationStatusHistory;
use Illuminate\Console\Command;

class BackfillStatusHistories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status:backfill 
                            {--dry-run : Run without making changes}
                            {--force : Skip confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backfill status histories for existing applications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dryRun = $this->option('dry-run');
        $force = $this->option('force');

        // ✅ Find applications without status histories
        $applicationsWithoutHistory = Application::doesntHave('statusHistories')->get();
        
        $this->info("Found {$applicationsWithoutHistory->count()} applications without status histories.");

        if ($applicationsWithoutHistory->isEmpty()) {
            $this->info("✅ All applications already have status histories!");
            return 0;
        }

        // ✅ Show preview of what will be created
        $this->table(
            ['App ID', 'User', 'Grant', 'Status', 'Created At'],
            $applicationsWithoutHistory->map(function ($app) {
                return [
                    $app->id,
                    $app->user->name ?? 'N/A',
                    $app->grant->grant_name ?? 'N/A',
                    $app->status->status_name ?? 'N/A',
                    $app->created_at->format('Y-m-d H:i:s'),
                ];
            })
        );

        if ($dryRun) {
            $this->warn("🔍 DRY RUN: No changes made. Remove --dry-run to apply changes.");
            return 0;
        }

        // ✅ Confirm before proceeding
        if (!$force && !$this->confirm('Do you want to create status histories for these applications?', true)) {
            $this->info("❌ Operation cancelled.");
            return 1;
        }

        // ✅ Create status histories
        $bar = $this->output->createProgressBar($applicationsWithoutHistory->count());
        $bar->start();

        $created = 0;
        $errors = 0;

        foreach ($applicationsWithoutHistory as $application) {
            try {
                // ✅ Create status history with the application's created_at timestamp
                ApplicationStatusHistory::create([
                    'application_id' => $application->id,
                    'status_id' => $application->status_id,
                    'created_at' => $application->created_at,
                    'updated_at' => $application->created_at,
                ]);
                $created++;
            } catch (\Exception $e) {
                $this->error("\n❌ Error creating history for application #{$application->id}: {$e->getMessage()}");
                $errors++;
            }
            
            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        $this->info("✅ Successfully created {$created} status histories!");
        
        if ($errors > 0) {
            $this->error("❌ {$errors} errors occurred.");
        }

        return 0;
    }
}
