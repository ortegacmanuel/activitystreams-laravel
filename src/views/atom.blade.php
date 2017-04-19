{!! '<'.'?'.'xml version="1.0" encoding="UTF-8" ?>' !!}
<feed xml:lang="en-US" xmlns="http://www.w3.org/2005/Atom" xmlns:thr="http://purl.org/syndication/thread/1.0" xmlns:georss="http://www.georss.org/georss" xmlns:activity="http://activitystrea.ms/spec/1.0/" xmlns:media="http://purl.org/syndication/atommedia" xmlns:poco="http://portablecontacts.net/spec/1.0" xmlns:ostatus="http://ostatus.org/schema/1.0" xmlns:statusnet="http://status.net/schema/api/1/">
    <title type="text">{{$channel->title}}</title>
    <subtitle type="html"><![CDATA[{!!$channel->description!!}]]></subtitle>
    <link href="{{$channel->link}}"></link>
    <id>{{$channel->link}}</id>
    <link rel="alternate" type="text/html" href="{{$channel->link}}" ></link>
    <link rel="self" type="application/atom+xml" href="{{$channel->link}}" ></link>
@if (!empty($channel->logo))
        <logo>{{$channel->logo}}</logo>
@endif
@if (!empty($channel->icon))
        <icon>{{$channel->icon}}</icon>
@endif
<updated>{{$channel->pubdate}}</updated>
@foreach($items as $item)
    {!! $item->asActivityObjectAtom() !!}
@endforeach
</feed>