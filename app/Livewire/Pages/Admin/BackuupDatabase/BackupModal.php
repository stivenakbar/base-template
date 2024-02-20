<?php

namespace App\Livewire\Pages\Admin\BackuupDatabase;

use App\Models\BackupHistoriesModel;
use DateTime;
use Livewire\Component;
use App\Models\BackupSettingsModel;
use Illuminate\Support\Facades\Storage;

class BackupModal extends Component
{
    public $tables;
    public $selectedTables = [];
    public $selectedTablesCount = 0;
    public $selectAll = false;
    public $backups;
    public $type;
    public $dayOfWeek = null;
    public $date = null;
    public $time = null;
    public $downloadBackup;

    public function mount()
    {
        // Fetch the backup settings from the database
        $backupSettings = BackupSettingsModel::first();
        if ($backupSettings != null) {
            $this->type = $backupSettings->type;
            $this->dayOfWeek = $backupSettings->day_of_week;
            $this->date = $backupSettings->day_of_month;
            $this->time = $backupSettings->time_of_day;
        }

        // Get the zip download
        $downloadPath = BackupHistoriesModel::latest()->take(5)->get();
        $this->downloadBackup = $downloadPath;

        // Fetch all the tables from the database
        $tables = \DB::select('SHOW TABLES');
        $this->tables = array_map(function ($table) {
            return current((array) $table);
        }, $tables);
        $this->backups = Storage::disk('backup')->files();
    }

    public function updateType()
    {
        $this->reset(['dayOfWeek', 'date', 'time']);
        $this->resetValidation();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedTables = $this->tables;
        } else {
            $this->selectedTables = [];
        }
    }

    public function selectTables()
    {
        $this->selectedTablesCount = count($this->selectedTables);
    }

    public function selectAllTables()
    {
        if ($this->selectAll) {
            $this->selectedTables = $this->tables;
        } else {
            $this->selectedTables = [];
        }
    }

    public function backupSelectedTables()
    {
        $dbHost = env('DB_HOST');
        $dbName = env('DB_DATABASE');
        $dbUser = env('DB_USERNAME');
        $dbPass = env('DB_PASSWORD');

        // Path and file name
        $backupDir = storage_path('Backup/Tables');
        $projectDir = base_path();
        $backupFile = $backupDir . '/dump-tables-' . now()->format('Y-m-d-H-i-s') . '.sql';

        // make the array [access,users] to access users ....
        $tables = implode(' ', $this->selectedTables);

        $command = "(mysqldump -u {$dbUser} -h {$dbHost} -p{$dbPass} {$dbName} {$tables} > {$backupFile} ) 2>&1";
        exec($command, $output, $code);
        if ($code == 0) {
            if (!file_exists($backupFile)) {
                return response('No backup file found.', 404);
            }
            return response()->download($backupFile);
        } else {
            return response('Backup failed, server error, '.$output[0], 500);
        }
    }

    public function downloadZipBackup($backupPath)
    {
        $backupDir = storage_path('Backup/Laravel/');
        $backupFile = $backupDir . $backupPath;

        // Redirect the user to the temporary URL
        return response()->download($backupFile);
    }

    public function saveSettings()
    {
        // Validate the form data
        $validated = $this->validateInputs();

        // Save the backup settings
        $schedule = BackupSettingsModel::updateOrCreate(
            ['id' => 1],
            [
                'type' => $validated['type'],
                'day_of_week' => $validated['type'] == 'weekly' ? $validated['dayOfWeek'] : null,
                'day_of_month' => $validated['type'] == 'monthly' ? $validated['date'] : null,
                'time_of_day' => (new DateTime($validated['time']))->format('H:i'),
            ]
        );

        // Show a success message
        if ($schedule) {
            $this->dispatch('backup-setting_saved', [
                "type" => 'success',
                "text" => 'Berhasil menyimpan pengaturan backup database',
            ]);
        }
    }

    private function validateInputs()
    {
        $rules = [
            'type' => 'required|in:daily,weekly,monthly',
            'dayOfWeek' => 'nullable|integer|between:0,6',
            'date' => 'nullable|date',
            'time' => 'nullable',
        ];

        if ($this->type == 'weekly') {
            $rules['dayOfWeek'] = 'required';
            $rules['time'] = 'required';
        } elseif ($this->type == 'monthly') {
            $rules['date'] = 'required';
        } elseif ($this->type == 'daily') {
            $rules['time'] = 'required';
        }

        return $this->validate($rules);
    }

    public function render()
    {
        return view('livewire.pages.admin.backuup-database.backup-modal');
    }
}
