<div>
    <x-mollecules.modal id="add-sitesetting_modal" action="store" wire:ignore.self>
        <x-slot:title>Add Site Setting</x-slot:title>
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
            <x-slot:footer>
                <button class="btn-primary btn" type="submit">Submit</button>
            </x-slot:footer>
        </div>
    </x-mollecules.modal>
    <x-mollecules.modal id="edit-sitesetting_modal" action="update" wire:ignore.self>
        <x-slot:title>Edit Site Setting</x-slot:title>
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
            <x-slot:footer>
                <button class="btn-primary btn" type="submit">Save</button>
            </x-slot:footer>
        </div>
    </x-mollecules.modal>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            function refreshTable() {
                window.LaravelDataTables['sitesetting-table'].ajax.reload();
            };
            @this.on('site-added', () => {
                $('#add-sitesetting_modal').modal('hide');
                refreshTable();
                location.reload();
            });
            @this.on('site-edit', () => {
                $('#edit-sitesetting_modal').modal('show');
                refreshTable();
            });
            @this.on('menu-updated', () => {
                $('#edit-menu_modal').modal('hide');
                refreshTable();
                location.reload();
            });

        });
    </script>
@endpush
