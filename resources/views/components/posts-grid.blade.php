@props(['posts'])
<div class="md:grid lg:grid-cols-6 md:grid-cols-4">
    @foreach($posts->skip(1) as $post)
        <x-post-card
            :post="$post"
            class="{{ $loop->iteration < 3 ? 'col-span-3' : 'col-span-2' }}"></x-post-card>
    @endforeach
</div>
