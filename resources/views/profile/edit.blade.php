@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Mon profil</h2>

    @if (session('status') === 'profile-updated')
        <div class="alert alert-success">Profil mis à jour avec succès.</div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Adresse e-mail</label>
            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                   class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>

    <hr>

    <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Supprimer votre compte ?');">
        @csrf
        @method('delete')

        <button type="submit" class="btn btn-danger mt-3">Supprimer mon compte</button>
    </form>
    <hr>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn btn-secondary mt-3">
        Se déconnecter
    </button>
</form>
</div>
@endsection