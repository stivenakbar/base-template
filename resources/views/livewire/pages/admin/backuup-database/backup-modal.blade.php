<div>
    <h4>Schedule Settings</h4>
    <form wire:submit.prevent="saveSettings" class="container w-75 d-flex justify-content-around mb-11">
        <div class="mb-6">
            <x-atoms.form-label required>Backup Type</x-atoms.form-label>
            <select id="type" wire:model="type" wire:change="updateType" class="form-select">
                <option value="">Select a type</option>
                <option value="daily">Daily</option>
                <option value="weekly">Weekly</option>
                <option value="monthly">Monthly</option>
            </select>
            @error('type')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        @if ($type == 'weekly')
            <div class="mb-6" id="week-container">
                <x-atoms.form-label required>Day of Week (for weekly backup)</x-atoms.form-label>
                <select id="dayOfWeek" wire:model="dayOfWeek" class="form-select">
                    <option value="">Select a day</option>
                    <option value="1">Monday</option>
                    <option value="2">Tuesday</option>
                    <option value="3">Wednesday</option>
                    <option value="4">Thursday</option>
                    <option value="5">Friday</option>
                    <option value="6">Saturday</option>
                    <option value="0">Sunday</option>
                </select>
                @error('dayOfWeek')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        @endif
        @if ($type == 'monthly')
            <div>
                <x-atoms.form-label required>Date (for monthly backup)</x-atoms.form-label>
                <select class="form-select" name="date" wire:model="date">
                    <option value="">Select a date</option>
                    @for ($i = 1; $i <= 31; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                @error('date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        @endif
        @if ($type == 'monthly' || $type == 'weekly' || $type == 'daily')
            <div>
                <x-atoms.form-label required>Time</x-atoms.form-label>
                <input class="form-control" type="time" name="time" wire:model="time">
                @error('time')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        @endif
        <div class="d-flex align-items-center justify-content-center">
            @if ($type == '')
                <button type="submit" class="btn btn-primary fw-bold" disabled>Save Settings</button>
            @else
                <button type="submit" class="btn btn-primary fw-bold">Save Settings</button>
            @endif
        </div>
    </form>

    <div class="d-flex justify-content-between">
        <div class="backup-manual w-50">
            <h4>Backup Tables</h4>
            <div class="form-check form-check-sm form-check-custom form-check-solid me-4 me-lg-7 mb-5">
                <label>
                    <input id="backup-select-all" class="form-check-input" type="checkbox" wire:model="selectAll"
                        wire:click="selectAllTables"> Select All
                </label>
            </div>

            <div class="container mb-5" style="max-height: 300px; overflow-y: auto;">
                @foreach ($tables as $table)
                    <div class="form-check form-check-sm form-check-custom form-check-solid me-4 me-lg-7 mb-2">
                        <label>
                            <input class="backup-row-checkbox form-check-input" type="checkbox"
                                wire:model="selectedTables" wire:click="selectTables" value="{{ $table }}">
                            {{ ucfirst($table) }}
                        </label>
                    </div>
                @endforeach
            </div>

            <button class="btn btn-primary fw-bold" wire:click="backupSelectedTables" wire:loading.attr="disabled"
                @if (empty($selectedTables)) disabled @endif>
                Export
            </button>
        </div>


        <div class="download-zip ms-5">
            <h4>Backup Histories</h4>
            @forelse ($downloadBackup as $backup)
                <div class="d-flex mt-6">
                    <div>
                        <i class="ki-outline ki-file fs-4 text-dark">
                            <span>{{ $backup->name }}</span>
                        </i>
                        <p>Backupted at: {{ $backup->created_at }}</p>
                    </div>
                    <div class="ms-11">
                        <a wire:click="downloadZipBackup('{{ $backup->name }}')"
                            class="btn btn-primary fw-bold">Download Backup</a>
                    </div>
                </div>
            @empty
                <p>No backup history</p>
            @endforelse
        </div>
    </div>
</div>


@push('scripts')
    <script>
        // Define your backup "Select All" checkbox and backup row checkboxes.
        const $backupSelectAll = $('#backup-select-all');
        const $backupTable = $('#backup-table');

        document.addEventListener('livewire:initialized', function() {
            // Listen to "backup-setting_saved" event from the backend.
            @this.on('backup-setting_saved', function() {
                @this.dispatch('swal', [{
                    type: 'success',
                    text: 'Backup settings saved successfully.',
                }])
            });
        })

        $backupSelectAll.on('change', function() {
            // Check or uncheck all row checkboxes based on "select-all".
            $('.backup-row-checkbox').prop('checked', this.checked);
        });

        // Attach change event to individual row checkboxes.
        $backupTable.on('change', '.backup-row-checkbox', function() {
            if (!this.checked) {
                // Uncheck "select-all" if any row checkbox is unchecked.
                $backupSelectAll.prop('checked', false);
            }
        });
    </script>
@endpush
