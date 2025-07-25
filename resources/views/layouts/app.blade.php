<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>GV App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
@media print {
    body * {
        visibility: hidden;
    }
    #receipt, #receipt * {
        visibility: visible;
    }
    #receipt {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
}
</style>
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
                    <li class="nav-item"><a href="{{ route('profile.edit') }}" class="nav-link">Mon Profil</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="dropdown">
        
        <ul class="dropdown-menu">
            <li><a href="{{ route('profile.edit') }}" title="Profil utilisateur" class="btn">
    <i class="fas fa-user-circle fa-lg"></i>
</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">Se déconnecter</button>
                </form>
            </li>
        </ul>
    </div>
    @endauth

    <main class="container">
        @yield('content')
    </main>
   <!-- Bootstrap JS (indispensable pour la modale) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        $('.select2').select2(); // Active la recherche
    });
</script>
</body>
</html>