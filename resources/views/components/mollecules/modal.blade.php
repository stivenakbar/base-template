@props([
    'size' => 'md',
    'id',
    'action',
    'center' => true,
    'hasCloseBtn' => true,
])

<div class="modal fade modal-{{ $size }}" id="{{ $id }}" tabindex="-1" wire:ignore.self {{ $attributes->except(["id"]) }}>
  <div class="modal-dialog modal-dialog-scrollable mw-750px {{ $center ? 'modal-dialog-centered' : '' }}">
      <form wire:submit="{{ $action }}" id="{{ $id }}-form" enctype="multipart/form-data" class="modal-content ">
        <div class="modal-header">
          <h4 class="modal-title">{{ $title }}</h4>
          <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="ki-outline ki-cross fs-2"></i>
          </div>
        </div>
        <div class="modal-body">
          {{ $slot }}
        </div>
        <div class="modal-footer">
          @if ($hasCloseBtn)
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
          @endif
          {{ $footer }}
        </div>
      </form>
  </div>

</div>
