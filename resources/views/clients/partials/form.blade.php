@csrf

<div class="mb-3">
    <label for="name" class="form-label">Nom</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $client->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $client->email ?? '') }}">
</div>

<div class="mb-3">
    <label for="phone" class="form-label">Téléphone</label>
    <input type="text" name="phone" class="form-control" value="{{ old('phone', $client->phone ?? '') }}">
</div>

<button type="submit" class="btn btn-primary">Enregistrer</button>
<a href="{{ route('clients.index') }}" class="btn btn-secondary">Annuler</a>