@extends('layouts.app')

@section('content')
    <h1>Liste des clients</h1>
    <a href="{{ route('clients.create') }}" class="btn btn-primary mb-3">Ajouter un client</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Solde</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($clients as $client)
            <tr>
                <td>{{ $client->name }}</td>
                <td>{{ $client->phone }}</td>
                <td>{{ $client->email }}</td>
                <td>{{ $client->balance }}</td>
                <td>
                    <a href="{{ route('clients.edit', $client) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('clients.destroy', $client) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce client ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection