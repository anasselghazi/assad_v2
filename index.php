<?php
require_once "classes/database.php";



$db= new database();

$pdo = $db->getPdo();

echo "connexion good";


?>













<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Zoo ASSAD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white text-gray-800">


<nav class="bg-green-700 text-white px-6 py-4 flex justify-between items-center">
    <h1 class="text-xl font-semibold">🦁 Zoo ASSAD</h1>
    <div class="space-x-4 text-sm">
        <a href="index.php" class="hover:underline">Accueil</a>
        <a href="login.php" class="hover:underline">Connexion</a>
        <a href="signup.php" class="hover:underline">Inscription</a>
    </div>
</nav>


<main class="max-w-6xl mx-auto px-6 py-16">

    <h2 class="text-4xl font-bold text-green-700 mb-6">
        Bienvenue au Zoo ASSAD
    </h2>

    <p class="text-gray-600 max-w-3xl mb-10">
        Zoo ASSAD est une plateforme éducative virtuelle créée pour présenter
        les animaux, leurs habitats naturels et sensibiliser à la protection
        de la faune.
    </p>

    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="border rounded-lg p-6 hover:shadow-md transition">
            <h3 class="font-semibold text-lg mb-2">🐾 Animaux</h3>
            <p class="text-sm text-gray-600">
                Découvrez différentes espèces animales et leurs caractéristiques.
            </p>
        </div>

        <div class="border rounded-lg p-6 hover:shadow-md transition">
            <h3 class="font-semibold text-lg mb-2">🌍 Habitats</h3>
            <p class="text-sm text-gray-600">
                Explorez les habitats naturels et les zones du zoo.
            </p>
        </div>

        <div class="border rounded-lg p-6 hover:shadow-md transition">
            <h3 class="font-semibold text-lg mb-2">📊 Statistiques</h3>
            <p class="text-sm text-gray-600">
                Consultez les données et statistiques du Zoo ASSAD.
            </p>
        </div>

    </div>

</main>


<footer class="border-t mt-20">
    <div class="max-w-6xl mx-auto px-6 py-6 flex flex-col md:flex-row justify-between text-sm text-gray-500">
        <p>© 2025 Zoo ASSAD</p>
        <p>Projet académique — YouCode</p>
    </div>
</footer>

</body>
</html>
