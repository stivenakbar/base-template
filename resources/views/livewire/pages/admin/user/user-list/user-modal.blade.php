<div>
    <x-mollecules.modal id="add-user_modal" action="store" wire:ignore.self>
        <x-slot:title>Add User</x-slot:title>
        <div class="mb-6">
            <x-atoms.form-label required>Username</x-atoms.form-label>
            <x-atoms.input name="name" wire:model='name' />
        </div>
        <div class="mb-6">
            <x-atoms.form-label required>Email</x-atoms.form-label>
            <x-atoms.input name="email" wire:model='email' />
        </div>
        <div class="mb-6">
            <x-atoms.form-label required>Password</x-atoms.form-label>
            <x-atoms.input name="password" wire:model='password' />
        </div>
        <div class="mb-6">
            <x-atoms.form-label required>Role</x-atoms.form-label>
            <select wire:model="role" class="form-select " data-control="select2" data-hide-search="true"
                data-placeholder="Select Role" name="target_assign">
                <option value="">No Role</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <x-slot:footer>
            <button class="btn-primary btn" type="submit">Submit</button>
        </x-slot:footer>
    </x-mollecules.modal>
    <x-mollecules.modal id="edit-user_modal" action="update" wire:ignore.self>
        <x-slot:title>Edit User</x-slot:title>
        <div class="mb-6">
            <x-atoms.form-label required>Username</x-atoms.form-label>
            <x-atoms.input name="name" wire:model='name' />
        </div>
        <div class="mb-6">
            <x-atoms.form-label required>Email</x-atoms.form-label>
            <x-atoms.input name="email" wire:model='email' />
        </div>
        <div class="mb-6">
            <x-atoms.form-label required>Password</x-atoms.form-label>
            <x-atoms.input name="password" wire:model='password' />
        </div>
        <div class="mb-6">
            <x-atoms.form-label required>Role</x-atoms.form-label>
            <select wire:model="role" class="form-select " data-control="select2" data-hide-search="true"
                data-placeholder="Select Role" name="target_assign">
                <option value="">No Role</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
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
                window.LaravelDataTables['menus-table'].ajax.reload();
            };
            @this.on('user-added', () => {
                $('#add-user_modal').modal('hide');
                refreshTable();
            })
            @this.on('user-updated', () => {
                $('#edit-user_modal').modal('hide');
                refreshTable();
            })
            @this.on('user-edit', () => {
                $('#edit-user_modal').modal('show');
                refreshTable();
            })
            @this.on('user-deleted', () => {
                refreshTable();
            })
        })
    </script>
@endpush
