<div>
    <x-mollecules.modal id="add-token_modal" action="store" wire:ignore.self>
        <x-slot:title>Add Token</x-slot:title>
        <div class="mb-6">
            <x-atoms.form-label required>Role</x-atoms.form-label>
            <select wire:model="role_id" name="role_id" id="" class="form-control @error('role_id') is-invalid @enderror">
                <option value="">Select a role</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
            @error('role_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-6">
            <x-atoms.form-label required>Token Name</x-atoms.form-label>
            <x-atoms.input name="name" wire:model='name' placeholder="Token Name" />
        </div>
        <div class="mb-6">
            <x-atoms.form-label>Expired At</x-atoms.form-label>
            <x-atoms.input type="date" name="expires_at" wire:model='expires_at' />
        </div>

        <div class="mb-6">
            <x-atoms.form-label required>Abilities</x-atoms.form-label>
            <table class="table align-middle table-row-dashed fs-6 gy-5">
                <tbody class="text-gray-600 fw-semibold">
                    <tr>
                        <td class="text-gray-800">Administrator Access
                            <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true"
                                data-bs-content="Allows a full access to the system" data-kt-initialized="1">
                                <i class="ki-duotone ki-information fs-7">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </td>
                        <td>
                            <label class="form-check form-check-custom form-check-solid me-9">
                                <input class="form-check-input" type="checkbox" value="*" id="kt_roles_select_all"
                                    name="abilities" wire:model="selectAll">
                                <span class="form-check-label" for="kt_roles_select_all">Select all</span>
                            </label>
                        </td>
                    </tr>
                    @foreach ($abilities as $ability)
                        <tr>
                            <td class="text-gray-800">{{ $ability }}</td>

                            <td id="abilities-container">
                                <div class="d-flex">
                                    @foreach (['select', 'insert', 'update', 'delete'] as $action)
                                        <label
                                            class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                            <input class="form-check-input ability-checkbox" type="checkbox"
                                                value="{{ $ability . '-' . $action }}" name="abilities"
                                                wire:model="selectedAbilities.{{ $ability . '-' . $action }}">
                                            <span class="form-check-label">{{ ucfirst($action) }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <x-slot:footer>
            <button class="btn-primary btn" type="submit">Submit</button>
        </x-slot:footer>
    </x-mollecules.modal>

    <x-mollecules.modal id="edit-token_modal" action="update" wire:ignore.self>
        <x-slot:title>Edit User</x-slot:title>
        <div class="mb-6">
            <x-atoms.form-label required>Role</x-atoms.form-label>
            <x-atoms.input name="role" wire:model='role_id' readonly disabled/>
        </div>
        <div class="mb-6">
            <x-atoms.form-label required>Token Name</x-atoms.form-label>
            <x-atoms.input name="name" wire:model='name' placeholder="Token Name" />
        </div>
        <div class="mb-6">
            <x-atoms.form-label>Expired At</x-atoms.form-label>
            <x-atoms.input type="date" name="expires_at" wire:model='expires_at' />
        </div>

        <div class="mb-6">
            <x-atoms.form-label required>Abilities</x-atoms.form-label>
            <table class="table align-middle table-row-dashed fs-6 gy-5">
                <tbody class="text-gray-600 fw-semibold">
                    <tr>
                        <td class="text-gray-800">Administrator Access
                            <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true"
                                data-bs-content="Allows a full access to the system" data-kt-initialized="1">
                                <i class="ki-duotone ki-information fs-7">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </td>
                        <td>
                            <label class="form-check form-check-custom form-check-solid me-9">
                                <input class="form-check-input" type="checkbox" value="*"
                                    id="kt_roles_select_all-edit" name="abilities" wire:model="selectAllEdit">
                                <span class="form-check-label" for="kt_roles_select_all-edit">Select all</span>
                            </label>
                        </td>
                    </tr>

                    @foreach ($abilities as $ability)
                        <tr>
                            <td class="text-gray-800">{{ $ability }}</td>

                            <td id="abilities-container">
                                <div class="d-flex">
                                    @foreach (['select', 'insert', 'update', 'delete'] as $action)
                                        <label
                                            class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                            <input class="form-check-input ability-checkbox-edit" type="checkbox"
                                                value="{{ $ability . '-' . $action }}" name="abilities"
                                                wire:model="selectedAbilitiesEdit.{{ $ability . '-' . $action }}">
                                            <span class="form-check-label">{{ ucfirst($action) }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <x-slot:footer>
            <button class="btn-primary btn" type="submit">Submit</button>
        </x-slot:footer>
    </x-mollecules.modal>
</div>

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/select2/select2.bundle.css') }}">
@endpush

@push('script-plugins')
    <script src="{{ asset('assets/plugins/custom/select2/select2.bundle.js') }}"></script>
@endpush


@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            function refreshTable() {
                window.LaravelDataTables['token-table'].ajax.reload();
            };
            @this.on('token-added', () => {
                $('#add-token_modal').modal('hide');
                refreshTable();
            })
            @this.on('token-updated', () => {
                $('#edit-token_modal').modal('hide');
                refreshTable();
            })
            @this.on('token-edit', () => {
                $('#edit-token_modal').modal('show');
                refreshTable();
            })
            @this.on('token-deleted', () => {
                refreshTable();
            })
        })

        var selectAll = document.getElementById('kt_roles_select_all');
        var abilityCheckboxes = document.querySelectorAll('.ability-checkbox');
        var selectAllEdit = document.getElementById('kt_roles_select_all-edit');
        var abilityCheckboxesEdit = document.querySelectorAll('.ability-checkbox-edit');

        selectAll.addEventListener('change', function() {
            abilityCheckboxes.forEach(function(checkbox) {
                checkbox.checked = selectAll.checked;
            });

        });

        abilityCheckboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                if (!this.checked) {
                    selectAll.checked = false;
                }
            });
        });

        Livewire.on('selectAll', function(checked) {
            abilityCheckboxesEdit.forEach(function(checkbox) {
                checkbox.checked = checked;
            });
        });

        selectAllEdit.addEventListener('change', function() {
            abilityCheckboxesEdit.forEach(function(checkbox) {
                checkbox.checked = selectAllEdit.checked;
            });
        });

        abilityCheckboxesEdit.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                if (!this.checked) {
                    selectAllEdit.checked = false;
                }
            });
        });

        Livewire.on('selectAllEdit', function(checked) {
            abilityCheckboxesEdit.forEach(function(checkbox) {
                checkbox.checked = checked;
            });
        });
    </script>
@endpush
