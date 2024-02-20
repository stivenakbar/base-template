<div>
    <x-mollecules.modal id="add-role_modal" action="store" wire:ignore.self>
        <x-slot:title>Add Role</x-slot:title>
        <div class="mb-6">
            <x-atoms.form-label required>Name</x-atoms.form-label>
            <x-atoms.input name="name" wire:model='name' />
        </div>
        <div class="mb-6">
            <x-atoms.form-label required>Guard Name</x-atoms.form-label>
            <x-atoms.input name="guard_name" wire:model='guard_name' />
        </div>
        <x-slot:footer>
            <button class="btn-primary btn" type="submit">Submit</button>
        </x-slot:footer>
    </x-mollecules.modal>
    <x-mollecules.modal id="edit-role_modal" action="update" wire:ignore.self>
        <x-slot:title>edit Role</x-slot:title>
        <div class="mb-6">
            <x-atoms.form-label required>Name</x-atoms.form-label>
            <x-atoms.input name="name" wire:model='name' />
        </div>
        <div class="mb-6">
            <x-atoms.form-label required>Guard Name</x-atoms.form-label>
            <x-atoms.input name="guard_name" wire:model='guard_name' />
        </div>
        <x-slot:footer>
            <button class="btn-primary btn" type="submit">Submit</button>
        </x-slot:footer>
    </x-mollecules.modal>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            function refreshTable() {
                window.LaravelDataTables['role-table'].ajax.reload();
            };
            @this.on('role-added', () => {
                $('#add-role_modal').modal('hide');
                refreshTable();
            })
            @this.on('role-updated', () => {
                $('#edit-role_modal').modal('hide');
                refreshTable();
            })
            @this.on('role-edit', () => {
                $('#edit-role_modal').modal('show');
                refreshTable();
            })

        })
    </script>
@endpush
