@props(['comment'])
<article class="flex bg-gray-100 border border-gray-200 rounded-xl p-6 space-x-4">
    <div class="flex-shrink-0">
        <img src="https://i.pravatar.cc/100"
             alt=""
             style="width: 100px;"
             class="rounded-xl"
        >
    </div>
    <div>
        <header class="mb-4">
            <strong>
                <h3 class="font-bold">
                    {{ $comment->author->username }}
                </h3>
                <p class="text-xs">
                    Posted
                    <time> {{ $comment->created_at }}</time>
                </p>
            </strong>
        </header>
        <p>
           {{ $comment->body }}
        </p>
    </div>
</article>
