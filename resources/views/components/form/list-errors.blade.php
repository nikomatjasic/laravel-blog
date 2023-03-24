@props(['errors'])
<ul>
    @foreach($errors as $error)
        <li class="text-red-400 text-xs"> {{ $error }} </li>
    @endforeach
</ul>
