@props([
  "lists" =>[]
])

<select {{ $attributes->merge(["class" => "form-select"]) }}>
  @if(count($lists) > 0)
    @foreach($lists as $i => $list)
      <option value="{{ $list["value"] }}" wire:key='{{ $i }}'>{{ $list["label"] }}</option>
    @endforeach
  @else 
    {{ $slot }}
  @endif 
</select>
@error($attributes->get('wire:model'))
  <small class="text-danger"> {{ $message }} </small>
@enderror