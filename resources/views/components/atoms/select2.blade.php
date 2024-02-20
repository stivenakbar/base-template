@props([
  "placeholder" => "Select And Option",
  "options" => [],
  "multiple" => false,
  "allowClear"=> true,
  "parent" => null
])

<select data-control="select2" placeholder="{{ $placeholder }}"  data-placeholder="{{ $placeholder }}" data-allow-clear="{{ $allowClear }}" data-dropwdown-parent="{{ $parent }}" {{ $attributes->merge(['class'=> 'form-select form-select-lg ']) }}>
  @if(count($options) > 0)
    @foreach($options as $i => $option)
      <option value="{{ $option["value"] }}">{{ $option["label"] }}</option>
    @endforeach
  @else
  {{ $slot}}
  @endif
</select>
