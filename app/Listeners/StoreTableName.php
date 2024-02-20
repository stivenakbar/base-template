<?php

namespace App\Listeners;

use App\Models\TablesNameModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Events\MigrationsEnded;

class StoreTableName
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
    public function handle(MigrationsEnded $event)
    {
        $lastMigration = DB::table('migrations')->orderBy('id', 'desc')->first();

        if ($lastMigration) {
            $tables = DB::select('SHOW TABLES');

            foreach ($tables as $table) {
                $tableName = $table->{'Tables_in_' . env('DB_DATABASE')};        
                TablesNameModel::create([
                    'name' => $tableName,
                ]);
            }
        }
    }

    private function getTableNameFromMigration($migrationName)
    {
        // Extract the table name from the migration name. This is a basic example and might need to be adjusted based on your migration naming convention.
        return Str::snake(Str::pluralStudly(class_basename($migrationName)));
    }
}
