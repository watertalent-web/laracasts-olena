@props(['field' => 'required'])

@error($field)
    <p class="text-red-500 text-sm">{{ $message }}</p>
@enderror