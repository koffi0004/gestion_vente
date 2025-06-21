@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Clients</h1>

    <a href="{{ route('clients.create') }}" class="btn btn-success mb-3">+ Nouveau client</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
                <tr>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->phone }}</td>
                    <td>
                        <a href="{{ route('clients.edit', $client) }}" class="btn btn-sm btn-warning">Modifier</a>

                        <form action="{{ route('clients.destroy', $client) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Supprimer ce client ?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection