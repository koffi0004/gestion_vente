<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center h-screen">
        <form method="POST" action="{{ route('custom.login') }}" class="bg-white p-6 rounded shadow-md w-80">
            @csrf
            <h2 class="text-2xl font-bold mb-4 text-center">Connexion</h2>

            @if(session('error'))
                <div class="bg-red-200 text-red-800 p-2 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <label for="email" class="block mb-2">Email</label>
            <input type="email" name="email" id="email" class="border w-full p-2 mb-4" required>

            <label for="password" class="block mb-2">Mot de passe</label>
            <input type="password" name="password" id="password" class="border w-full p-2 mb-4" required>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full">
                Se connecter
            </button>
        </form>
    </div>
</body>
</html>