<div class="d-flex justify-content-center align-items-center gap-2">
    @can('admin-system-setting-update')
        <button
            wire:click="$dispatchTo('pages.admin.system-setting.system-setting-modal','edit', { id: {{ $systemSetting->id }} })"
            class="btn btn-light btn-active-light-primary p-3 btn-center btn-sm">
            <i class="ki-outline ki-pencil fs-2"></i>
        </button>
    @endcan
    @can('admin-system-setting-delete')
        <button data-action-params='{{ json_encode(['id' => $systemSetting->id]) }}' data-livewire-instance="@this"
            data-action="delete" data-action-receiver="pages.admin.system-setting.system-setting-modal" data-action-delete
            class="btn btn-light btn-active-light-primary p-3 btn-center btn-sm">
            <i class="ki-outline ki-trash fs-2"></i>
        </button>
    @endcan
</div>
