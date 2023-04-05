@props(['items', 'name', 'selected' => '', 'label' => ''])

<x-form.field.group class="field--{{ $name }}">
    @if($label !== false)
        <x-form.label />
    @endif
    <select id="{{ $name }}" name="{{ $name }}" {{ $attributes->merge(['class' => 'rounded-lg border border-gray-300 py-3 px-4 w-full']) }}>
        @foreach($items as $item)
            <option value="{{ $item->id }}" @selected(old($name, $selected) === $item->id)>
                {{ $item->name }}
            </option>
        @endforeach
    </select>
    <x-form.error.message />
</x-form.field.group>
