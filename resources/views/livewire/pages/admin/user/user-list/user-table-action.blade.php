<div class="d-flex justify-content-center align-items-center gap-2">
    <a href="/admin/impersonate/{{ $user->id }}" class="btn btn-light btn-active-light-primary p-3 btn-center btn-sm">
        <i class="ki-outline ki-eye fs-2"></i></a>
    @can('admin-user-update')
        <button wire:click="$dispatchTo('pages.admin.user.user-list.user-modal','edit', { id: {{ $user->id }} })"
            class="btn btn-light btn-active-light-primary p-3 btn-center btn-sm">
            <i class="ki-outline ki-pencil fs-2"></i>
        </button>
    @endcan
    @can('admin-user-delete')
        <button data-action-params='{{ json_encode(['id' => $user->id]) }}' data-livewire-instance="@this" data-action="delete"
            data-action-receiver="pages.admin.user.user-list.user-modal" data-action-delete
            class="btn btn-light btn-active-light-primary p-3 btn-center btn-sm">
            <i class="ki-outline ki-trash fs-2"></i>
        </button>
    @endcan
</div>
