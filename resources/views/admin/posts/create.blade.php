<x-layout>
    <x-panel.settings heading="Publish new post">
        <form method="POST" action="/admin/posts/create" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <x-form.field.input name="title" />
            <x-form.field.input name="thumbnail" type="file" />
            <x-form.field.textarea name="body" />
            <x-form.field.textarea name="excerpt" />
            <x-form.field.select name="category_id" :items="$categories" label="Category"/>

            <x-form.field.input name="is_published" type="checkbox"/>
            <x-form.button type="submit">Publish</x-form.button>
        </form>
    </x-panel.settings>
</x-layout>
