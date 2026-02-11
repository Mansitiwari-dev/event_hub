@props(['headers' => []])

<table class="w-full">
    <thead>
        <tr>
            @foreach($headers as $h)
                <th>{{ $h }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        {{ $slot }}
    </tbody>
</table>
