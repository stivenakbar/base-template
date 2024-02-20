@props([
    'lists' => [],
])

<div class="radio-group">
  @if(count($lists) > 0)
    @foreach ($lists as $list)
      <x-atoms.radio wire:model="{{ $attributes->get('wire:model') }}" value="{{ $list['value'] }}">
        {{ $list['label'] }}
      </x-atoms.radio>
    @endforeach
  @else
    {{ $slot }}
  @endif
</div>
