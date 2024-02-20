<div class="d-flex justify-content-center align-items-center gap-2">
    @can('admin-role-updaete')
        <button wire:click="$dispatchTo('pages.admin.user.role.role-modal','edit', { id: {{ $role->id }} })"
            class="btn btn-light btn-active-light-primary p-3 btn-center btn-sm">
            <i class="ki-outline ki-pencil fs-2"></i>
        </button>
    @endcan

    <a href="/admin/permission?q={{ $role->name }}"
        class="btn btn-light btn-active-light-primary p-3 btn-center btn-sm">
        <i class="ki-outline ki-eye fs-2"></i>
    </a>

</div>
