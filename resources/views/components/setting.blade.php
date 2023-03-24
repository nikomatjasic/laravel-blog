@props(['heading'])
<section class="py-8 max-w-4xl mx-auto">
    <div class="flex border-b pb-2 justify-between">
        <h1 class="text-lg font-bold">
            {{ $heading }}
        </h1>
        <p class="mt-0 mb-2">Active posts:
            <span
                class="text-bold font-semibold text-xl"> {{ \App\Models\Post::where('is_published',  1)->count() }}</span>
        </p>
    </div>
    <div class="flex space-x-4">
        <aside class="w-48 pt-6 flex-shrink-0">
            <h4 class="font-semibold mb-4">Links</h4>
            <ul>
                <li class="py-2 pl-1">
                    <a href="/admin/posts" class="{{ request()->is('admin/posts') ? 'border-blue-500 ' : '' }}border-b-4 border-transparent hover:border-gray-200 pb-1">
                        All posts
                    </a>
                </li>
                <li class="py-2 pl-1">
                    <a href="/admin/posts/create"
                       class="{{ request()->is('admin/posts/create') ? 'border-blue-500 ' : '' }}border-b-4 border-transparent hover:border-gray-200 pb-1">
                        New Post
                    </a>
                </li>
            </ul>
        </aside>
        <main class="flex-1">
            <x-panel class="mx-auto">
                {{ $slot }}
            </x-panel>
        </main>
    </div>

</section>
