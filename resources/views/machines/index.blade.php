<table>
@foreach ($machines as $machine)
    <tr>
        <td>{{ $machine['id'] }}</td>
        <td>{{ $machine['name'] }}</td>
    </tr>
@endforeach
</table>
