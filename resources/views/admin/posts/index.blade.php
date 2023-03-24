<x-layout>
    <x-setting heading="Manage posts">
        <div class="flex flex-col pt-6">
            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Title
                                </th>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Author
                                </th>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Status
                                </th>
                                <th scope="col" class="p-4">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @foreach($posts as $post)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 dark:text-white">
                                        <a href="/posts/{{ $post->slug }}"> {{ $post->title }} </a>
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <a href="/?author={{ $post->author->username }}"> {{ $post->author->username }} </a>
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium whitespace-nowrap">
                                        @if($post->is_published)
                                            <span class="bg-green-400 p-2 rounded-2xl text-white">Active</span>
                                        @else
                                            <span class="bg-yellow-400 p-2 rounded-2xl text-white">Draft</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                        <a href="/admin/posts/{{ $post->id }}/edit"
                                           class="text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                        <form method="POST" action="/admin/posts/{{ $post->id }}">
                                            @csrf
                                            @method('DELETE')

                                            <button class="text-xs">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="mt-4">
                {{ $posts->links() }}
            </div>

        </div>
    </x-setting>
</x-layout>
