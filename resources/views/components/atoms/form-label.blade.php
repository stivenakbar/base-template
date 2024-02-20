<label {{ $attributes->merge(['class' => 'form-label']) }}>
  {{ $slot }} 
  @if($attributes->has("required"))<span class="required"></span> @endif
</label>
