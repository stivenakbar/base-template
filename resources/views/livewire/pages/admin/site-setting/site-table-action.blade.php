<div class="d-flex justify-content-center align-items-center gap-2">
    @can('admin-site-setting-update')
        <button wire:click="$dispatchTo('pages.admin.site-setting.site-setting-modal','edit', { id: {{ $site->id }} })"
            class="btn btn-light btn-active-light-primary p-3 btn-center btn-sm">
            <i class="ki-outline ki-pencil fs-2"></i>
        </button>
    @endcan
</div>
