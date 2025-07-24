@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-customIT']) }}>
    {{ $value ?? $slot }}
</label>
