<x-layout>
    <h1 class="text-red-500">RSS Feed Reader</h1>

    @if($feeds->count() > 0)
        <div>
            {{ $feeds->first()->title }} {{ $feeds->first()->subtitle }}
        </div>
    @else
        <div>No feeds. Please open a file to begin.</div>
    @endif

    <div>
        <a class="inline-block bg-blue-900 text-white rounded px-3 py-2" href="/open">Open file</a>
    </div>
</x-layou> 