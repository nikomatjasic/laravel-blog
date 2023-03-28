<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
            <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
                <div class="col-span-4 lg:text-center lg:pt-14 mb-10">
                    <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="" class="rounded-xl">
                    <div class="flex flex-col items-center lg:justify-center text-sm mt-4">
                        <img src="/images/lary-avatar.svg" alt="Lary avatar">

                        <div class="mt-4">
                            <h5 class="font-bold">
                                <a href="/?author={{ $post->author->username }}">
                                    {{ $post->author->name }}
                                </a>
                            </h5>
                        </div>

                        @auth
                            @if ($post->author->id !== Auth::user()->id)
                                <div class="mt-3">
                                    <button class="text-blue-400 font-bold" data-action="{{ $followingAction }}" data-id="{{ $post->author->id }}">
                                        <span class="capitalize" data-action-title>{{ $followingAction }}</span>
                                    </button>
                                </div>
                            @endif
                        @endauth

                    </div>
                    <div class="flex flex-col items-center mt-2 space-y-2">
                        <p class="block text-gray-400 text-xs">
                            Published
                            <time>{{ $post->created_at->diffForHumans() }}</time>
                        </p>
                        <p class="flex bg-blue-400 text-white text-xs rounded-3xl w-1.5 w-1/4 py-1 px-2 ml-4">
                            Views: {{ ($post->views_count === 0) ? '1' : $post->views_count }}
                        </p>
                    </div>
                </div>

                <div class="col-span-8">
                    <div class="hidden lg:flex justify-between mb-6">
                        <a href="/"
                           class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                            <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                                <g fill="none" fill-rule="evenodd">
                                    <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                                    </path>
                                    <path class="fill-current"
                                          d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                                    </path>
                                </g>
                            </svg>

                            Back to Posts
                        </a>

                        <div class="space-x-2">
                            <a href="?categories={{ $post->category->slug }}"
                               class="px-3 py-1 border border-blue-300 rounded-full text-blue-300 text-xs uppercase font-semibold"
                               style="font-size: 10px">
                                {{ $post->category->name }}
                            </a>
                        </div>
                    </div>

                    <h1 class="font-bold text-3xl lg:text-4xl mb-10">
                        {{ $post->title }}
                    </h1>

                    <div class="space-y-4 lg:text-lg leading-loose">
                        <p>
                            {!!  $post->body  !!}
                        </p>
                    </div>
                </div>

                <section class="col-span-8 col-start-5 mt-10 space-y-6">
                    @include('posts._add-comment-form')
                    @foreach($post->comments as $comment)
                        <x-post-comment :comment="$comment"></x-post-comment>
                    @endforeach
                </section>
            </article>
        </main>
    </section>
    <x-form.list-errors :errors="$errors->all()" />
</x-layout>
<x-script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });

        let $toggleFollow = $("[data-action]");

        if ($toggleFollow.length > 0) {
            $("[data-action]").click(function (event) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('toggle.follow') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        author_id: "{{ $post->author->id }}",
                        user_id: "{{ auth()->id() }}"
                    },
                    success: function (data) {
                        let newAction = data.action;
                        let element = event.currentTarget;
                        element.dataset.action = newAction;
                        element.querySelector("[data-action-title]").innerHTML = newAction;
                        // @todo: add/ remove the user from the array for Laravel.userFollowing.
                        let userID = element.querySelector("[data-id]");
                        console.log(userID);
                        console.log(newAction);
                        window.Laravel.userFollowing.forEach(element => {

                        });

                    },
                    error: function (data) {
                        let errors = data.responseJSON.errors;
                        for (let fieldName in errors) {
                            // Errors base on the field name.
                            let errorsForField = errors[fieldName];
                            for (let num in errorsForField) {
                                console.error(fieldName.toUpperCase() + ': ' + errorsForField[num]);
                            }
                        }
                    }
                });
            });
        }

    </script>
</x-script>
