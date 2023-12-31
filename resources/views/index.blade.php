<x-layout>
    <h1 class="text-red-500">RSS Feed Reader</h1>

    <div class="grid grid-cols-12">
        <div class="col-span-4">
            @if($feeds->count() > 0)
                @foreach($feeds as $feed)
                    @if((!is_null($selected_feed) && $selected_feed->count() > 0) && $feed->id === $selected_feed->id) 
                        <div class="text-underline">
                    @else
                        <div>
                    @endif
                    <!-- <div class=""> -->
                        <a href="/?selected_feed={{ $feed->id }}">{{ $feed->title }}</a> - 
                        <a onclick="return confirm('Are you sure you want to delete the feed for {{ $feed->title }}');" href="/delete/{{ $feed->id }}">Delete</a>
                    </div>
                @endforeach
            @endif
            <div>
                <a class="inline-block bg-blue-900 text-white rounded px-3 py-2" href="/open">Add Feed From File</a>
            </div>
        </div>
        <div class="col-span-8">
        @if($feeds->count() > 0)
            @if(!is_null($selected_feed) && $selected_feed->count() > 0)
                <div>
                    Feed entries here...
                    <!-- {{ $feeds->first()->title }} {{ $feeds->first()->subtitle }} Feedd: {{ $feeds->first()->feed_id }} -->
                </div>
            @else
                <div>
                    No entries for this feed.
                </div>
            @endif
        @else
            <div>No feeds. Please open a file to begin.</div>
        @endif
        </div>
    </div>

    @if(Session::has('xml_error'))
        <script type="text/javascript">
            window.onload = function() {
                alert('{{Session::get("xml_error")}}');
            }
        </script>
    @endif
</x-layout> 