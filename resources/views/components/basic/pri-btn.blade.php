<button {{ $attributes->merge(['class' => 'transition-colors duration-300 bg-blue-500 hover:bg-blue-600 rounded-full text-xs font-semibold text-white uppercase py-3 px-8']) }}>
    @if ($slot->isEmpty())
        Submit
    @else
        {{ $slot }}
    @endif
</button>
