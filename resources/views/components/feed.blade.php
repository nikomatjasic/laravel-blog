@props(['post'])

<item>
    <title><![CDATA[{{ $post->title }}]]></title>
    <link>{{ url($post->slug) }}</link>
    <description><![CDATA[{!! $post->body !!}]]></description>
    <category>{{ $post->category }}</category>
    <author><![CDATA[{{ $post->author->username }}]]></author>
    <guid>{{ $post->id }}</guid>
    <pubDate>{{ $post->created_at->toRssString() }}</pubDate>
</item>
