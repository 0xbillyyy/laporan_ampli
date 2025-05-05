<table border="1" cellspacing="0" cellpadding="5">
    <tr>
        <th rowspan="2">NO</th>
        <th rowspan="2">NAMA</th>
        <th rowspan="2">PANGKAT, KORPS</th>
        <th colspan="{{ $platforms->count() }}" style="background-color: yellow;">BIDANG POSITIF TNI</th>
    </tr>
    <tr>
        @foreach ($platforms as $platform)
            <th>{{ strtoupper($platform->name) }}</th>
        @endforeach
    </tr>

    @php $no = 1; @endphp
    @foreach ($groupedLinks as $person)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $person['nama'] }}</td>
            <td>{{ $person['pangkat'] }}</td>
            @foreach ($platforms as $platform)
                <td>
                    @php
                        $link = $person['links'][$platform->name] ?? '-';
                    @endphp
                    @if ($link !== '-')
                        <a href="{{ $link }}" target="_blank">{{ $link }}</a>
                    @else
                        {{ $link }}
                    @endif
                </td>
            @endforeach
        </tr>
    @endforeach
</table>
