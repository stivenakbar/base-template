<div class="d-flex justify-content-center align-items-center gap-2">
    <button class="btn btn-light btn-active-light-primary p-3 btn-center btn-sm">
        <i class="ki-outline ki-pencil fs-2"></i>
    </button>
    <button wire:click="$dispatchTo('add-menu-modal', 'destroy', { id: {{ $val->id }} })"
        class="btn btn-light btn-active-light-primary p-3 btn-center btn-sm">
        <i class="ki-outline ki-trash fs-2"></i>
    </button>
</div>
