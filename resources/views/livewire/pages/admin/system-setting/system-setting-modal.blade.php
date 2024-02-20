<div>
    <x-mollecules.modal id="edit-system-setting_modal" action="update" wire:ignore.self>
        <x-slot:title>Edit System Setting</x-slot:title>
        <div class="">
            <div class="mb-6">
                <x-atoms.form-label required>Name</x-atoms.form-label>
                <x-atoms.input name="name" wire:model='name' />
            </div>
            <div class="mb-6">
                <x-atoms.form-label required>Value</x-atoms.form-label>
                <x-atoms.input name="value" wire:model='value' />
            </div>
            <div class="mb-6">
                <x-atoms.form-label required>Description</x-atoms.form-label>
                <x-atoms.input name="description" wire:model='description' />
            </div>
            <div>
                <x-atoms.form-label required>Status</x-atoms.form-label>
                <x-atoms.radio-group>
                    <x-atoms.radio id="status-3" name="is_active_edit" value="1"
                        wire:model='is_active'>Active</x-atoms.radio>
                    <x-atoms.radio id="status-4" name="is_active_edit" value="0"
                        wire:model='is_active'>Process</x-atoms.radio>
                </x-atoms.radio-group>
            </div>
            <x-slot:footer>
                <x-atoms.button action="update" class="btn-primary">Submit</x-atoms.button>
            </x-slot:footer>
        </div>
    </x-mollecules.modal>
    <x-mollecules.modal id="add-system-setting_modal" action="submit" wire:ignore.self>
        <x-slot:title>Add System Setting</x-slot:title>
        <div class="">
            <div class="mb-6">
                <x-atoms.form-label required>Name</x-atoms.form-label>
                <x-atoms.input name="name" wire:model.status='name' />
            </div>
            <div class="mb-6">
                <x-atoms.form-label required>Value</x-atoms.form-label>
                <x-atoms.input name="value" wire:model='value' />
            </div>
            <div class="mb-6">
                <x-atoms.form-label required>Description</x-atoms.form-label>
                <x-atoms.input name="description" wire:model='description' />
            </div>
            <div>
                <x-atoms.form-label required>Status</x-atoms.form-label>
                <x-atoms.radio-group>
                    <x-atoms.radio id="status-1" name="status" value="1"
                        wire:model='is_active'>Active</x-atoms.radio>
                    <x-atoms.radio id="status-0" name="status" value="0"
                        wire:model='is_active'>Process</x-atoms.radio>
                </x-atoms.radio-group>
            </div>

            <x-slot:footer>
                <button type="submit" class="btn btn-primary">
                    <span class="indicator-label" wire:loading.remove>Submit</span>
                    <span class="indicator-progress" wire:loading>Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </x-slot:footer>
        </div>
    </x-mollecules.modal>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('system-setting-added', () => {
                $('#add-system-setting_modal').modal('hide');
                refreshTable();
            });
            @this.on('system-setting-updated', () => {
                $('#edit-system-setting_modal').modal('hide');
                refreshTable();
            });
            @this.on('system-setting-deleted', () => {
                refreshTable();
            });
            @this.on('system-setting-edit', () => {
                $('#edit-system-setting_modal').modal('show');
            });

            function refreshTable() {
                window.LaravelDataTables['systemsetting-table'].ajax.reload();
            };
        });
    </script>
@endpush
