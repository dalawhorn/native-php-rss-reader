<x-layout>
    <h1>
        {{ $feed['title'] }}
    </h1>
    @isset($feed['subtitle'])
        <h2>
            {{ $feed['subtitle'] }}
        </h2>
    @endisset

    @foreach($entries as $entry)
        <h3>
            {{ $entry['title'] }}
        </h3>
        <div>{{ $entry['author']['name'] }}</div>
        <div>
            {{ $entry['summary'] }}
        </div>
    @endforeach
</x-layout>