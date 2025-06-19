<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>GV App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @auth
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">GV App</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="{{ route('products.index') }}" class="nav-link">Produits</a></li>
                    <li class="nav-item"><a href="{{ route('clients.index') }}" class="nav-link">Clients</a></li>
                    <li class="nav-item"><a href="{{ route('sales.index') }}" class="nav-link">Ventes</a></li>
                </ul>
            </div>
        </div>
    </nav>
    @endauth

    <main class="container">
        @yield('content')
    </main>
</body>
</html>