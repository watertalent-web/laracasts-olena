@props(['label' => false, 'name', 'type' => 'text', 'attributes' => '', 'value' => ''])

<div class="space-y-2">
    @if ($label)
        <label for="{{ $name }}" class="label">
            {{ $label }}
        </label>
    @endif

    @if ($type === 'textarea')
        <textarea name="{{ $name }}" id="{{ $name }}" class="textarea" {{ $attributes }}>{{ old($name, $value) }}</textarea>
    @else
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" class="input" value="{{ old($name, $value) }}" {{ $attributes }}>
    @endif
    
    @error($name)
        <p class="error">{{ $message }}</p>
    @enderror
</div>