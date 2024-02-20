<?php

namespace App\Console;

use App\Models\PersonalTokenModel;
use App\Models\BackupSettingsModel;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $this->scheduleBackup($schedule);
        $schedule->call(function () {
            $this->deleteExpiredTokens();
        })->everySecond();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }

    public function scheduleBackup($schedule)
    {
        // Fetch the backup settings from the table
        $backupSettings = BackupSettingsModel::first();

        if ($backupSettings) {

            // Schedule the backup:clean and backup:run command 5 minutes before backup run
            if ($backupSettings->type == 'daily') {
                $schedule->command('backup:clean')->dailyAt($backupSettings->time_of_day);
                $schedule->command('backup:run-and-store-path')->dailyAt($backupSettings->time_of_day)->after(function () {
                    // This command will be scheduled to run after the 'backup:clean' command
                });
            } elseif ($backupSettings->type == 'weekly' && $backupSettings->day_of_week) {
                $schedule->command('backup:clean')->weeklyOn($backupSettings->day_of_week, $backupSettings->time_of_day);
                $schedule->command('backup:run-and-store-path')->weeklyOn($backupSettings->day_of_week, $backupSettings->time_of_day)->after(function () {
                    // This command will be scheduled to run after the 'backup:clean' command
                });
            } elseif ($backupSettings->type == 'monthly' && $backupSettings->day_of_month) {
                $schedule->command('backup:clean')->monthlyOn($backupSettings->day_of_month, $backupSettings->time_of_day);
                $schedule->command('backup:run-and-store-path')->monthlyOn($backupSettings->day_of_month, $backupSettings->time_of_day)->after(function () {
                    // This command will be scheduled to run after the 'backup:clean' command
                });
            }
        }
    }

    protected function deleteExpiredTokens()
    {
        PersonalTokenModel::where(function ($query) {
            $query->whereNotNull('expires_at')
                ->where('expires_at', '<', now());
        })
            ->orWhere(function ($query) {
                $query->whereNull('expires_at')
                    ->where('created_at', '<', now()->subDay());
            })
            ->delete();
    }
}
