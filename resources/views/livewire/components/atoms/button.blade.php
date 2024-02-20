<div>
    <button class="btn {{ $class }}" type="{{ $type }}" id="{{ $id }}"
        {{ $disabled ? 'disabled' : '' }} wire:loading.attr="disabled">
        @if ($icon && $iconPosition === 'left')
            <i class="{{ $icon }}"></i>
        @endif
        <span wire:loading.remove>
            {{ $text }}
        </span>
        <span wire:loading>
            <i class="fa fa-spinner" aria-hidden="true"></i>
        </span>
        @if ($icon && $iconPosition === 'right')
            <i class="{{ $icon }}"></i>
        @endif
    </button>
</div>
