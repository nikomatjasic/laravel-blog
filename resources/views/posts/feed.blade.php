<?=
'<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL
?>
<rss version="2.0">
    <channel>
        <title><![CDATA[ My blog ]]></title>
        <link>
        <![CDATA[ https://{{ request()->httpHost() }}/feed ]]></link>
        <description><![CDATA[ Blog page feed ]]></description>
        <language>en</language>
        <pubDate>{{ now() }}</pubDate>
        @foreach($posts as $post)
            <x-feed :$post></x-feed>
        @endforeach
    </channel>
</rss>
