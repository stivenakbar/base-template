<div>
    <a href="{{ $href }}"
        class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100"
        disables="{{ $disabled }}">{{ $iconPosition == 'right' ? $text : '' }}
        <img alt="Logo" src="{{ asset($logo) }}" class="h-15px me-3" />
        {{ $iconPosition == 'left' ? $text : '' }}</a>
</div>
