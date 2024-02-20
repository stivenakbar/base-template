@props(['value'])

<label {{ $attributes->merge(['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}>
    {{ $value ?? $slot }}
</label>
