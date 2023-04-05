@props(['src', 'alt' => '', 'title' => '', 'width' => '', 'height' => ''])
<div {{ $attributes }}>
    {{ $slot }}
    <img src="{{ $src }}"
         alt="{{ $alt }}"
         title="{{ $title }}"
         width="{{ $width }}"
         height="{{ $height }}"
         class="rounded-xl"/>
</div>
