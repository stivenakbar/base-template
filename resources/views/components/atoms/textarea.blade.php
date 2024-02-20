@props([
  "autosize" => true
])
<textarea @if($autosize) data-kt-autosize="true" @endif {{ $attributes->merge(["class" => "form-control"]) }}>
  {{ $slot }}
</textarea>