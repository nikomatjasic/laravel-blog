<x-layout>
    <x-panel.settings heading="Edit post: {{ $post->title }}">
        <form method="POST" action="/admin/posts/{{ $post->id }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PATCH')
            <x-form.field.input name="title" :value="old('title', $post->title)"/>

            <x-rounded-img src="{{ asset('storage/' . $post->thumbnail) }}" class="flex space-x-2" width="150">
                <x-form.field.input name="thumbnail" type="file" :value="old('thumbnail', $post->thumbnail)" class="flex-1" />
            </x-rounded-img>

            <x-form.field.textarea name="body">{{ old('body', $post->body) }}</x-form.field.textarea>
            <x-form.field.textarea name="excerpt">{{ old('excerpt', $post->excerpt) }}</x-form.field.textarea>
            <x-form.field.select name="category_id" :items="$categories" :selected="$post->category->id" label="Category" />
            <x-form.field.select name="user_id" :items="$authors" :selected="$post->author->id" label="User" />
            <x-form.field.input name="published" type="checkbox" checked="{{ $post->is_published ? 'checked' : false }}" />

            <x-form.field.group class="flex items-center space-x-4">
                <x-basic.pri-btn>Update</x-basic.pri-btn>
                <a href="/admin/posts" class="hover:underline">Back to posts</a>
            </x-form.field.group>
        </form>
    </x-panel.settings>
</x-layout>
