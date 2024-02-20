@props([
  "action" => "",
  "loadingText" => "Please wait...",
])

<button {{ $attributes->merge(["class" => "btn btn-primary"]) }}>
  <span class="indicator-label" wire:loading.remove @if ($action != "" ) wire:target="{{ $action }}" @endif>
    {{ $slot ?? "Submit" }}
  </span>
  <span class="indicator-progress" wire:loading @if ($action != "" ) wire:target="{{ $action }}" @endif>
    {{ $loadingText }}
    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
  </span>
</button>