@error($attributes->get('wire:model'))
  <input {{ $attributes->merge(['class' => 'form-control is-invalid']) }}>
@else
  <input {{ $attributes->merge(['class' => 'form-control']) }}>
@enderror

@error($attributes->get('wire:model'))
  <small class="text-danger"> {{ $message }} </small>
@enderror
