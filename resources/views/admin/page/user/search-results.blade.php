@foreach( $users as $key => $user)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->phone }}</td>
        <td>{{ $user->orders->count() ?? 0 }}</td>
    </tr>
@endforeach
