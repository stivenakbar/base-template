<input type="radio"  {{ $attributes }}>
<label for="{{ $attributes->get("id") }}" class="radio">
  {{ $slot }}
</label>
