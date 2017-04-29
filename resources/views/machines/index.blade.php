<table>
@foreach ($machines as $machine)
    <tr>
        <td>{{ $machine['id'] }}</td>
        <td>
            {{ link_to_action('MachineController@show', $machine['name'], [$machine['id']]) }}
    </tr>
@endforeach
</table>
