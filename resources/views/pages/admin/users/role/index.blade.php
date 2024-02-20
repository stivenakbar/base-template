<x-layouts.app>
    <x-slot:title>System Setting</x-slot>
    <livewire:pages.admin.user.role.role-modal />
    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <span class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></span>
                    <input type="text" class="form-control form-control-solid w-250px ps-13" placeholder="Search user"
                        id="systemsetting-table_search" data-table-id="systemsetting-table" data-action-search />
                </div>
            </div>
            <div class="card-toolbar" x-data="{}">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <!--begin::Add user-->
                    <button type="button" class="btn btn-primary" @click.prevent="$('#add-role_modal').modal('show')">
                        <i class="ki-duotone ki-plus fs-2"></i>
                        <span>Add Role</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body py-4">
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
    {{-- @dd($dataTable->scripts()) --}}
    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}">
    @endpush
    @push('scripts')
        {{ $dataTable->scripts() }}
    @endpush


</x-layouts.app>
