<x-layouts.app>
    <x-slot:title>Menus</x-slot:title>
    <livewire:pages.admin.menus.menu-modal />

    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <span class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></span>
                    <input type="text" data-kt-user-table-filter="search"
                        class="form-control form-control-solid w-250px ps-13" placeholder="Search user"
                        id="mySearchInput" />
                </div>
            </div>

            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <!--begin::Add user-->
                    @can('admin-menu-create')
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#add-menu_modal">
                            <i class="ki-duotone ki-plus fs-2"></i>
                            <span>Add Menus</span>
                        </button>
                    @endcan
                </div>
            </div>
        </div>

        <div class="card-body py-4">
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
    
    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}">
    @endpush

    @push('scripts')
        <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        {{ $dataTable->scripts() }}
    @endpush

</x-layouts.app>
