@props(['errors'])
<ul class="error-list">
    @foreach($errors as $error)
        <li class="text-red-400 text-xs"> {{ $error }} </li>
    @endforeach
</ul>
