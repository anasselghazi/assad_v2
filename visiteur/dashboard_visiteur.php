<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'visiteur') {
    header("Location: ../index.php"); 
    exit();
}
?>




<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>ASSAD | Accueil</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex">

<!-- SIDEBAR -->
<aside class="w-64 h-screen bg-green-800 text-white p-6">
    <h1 class="text-2xl font-bold mb-8">🦁 ASSAD Zoo</h1>

    <ul class="space-y-4">
        <li><a href="dashboard_visiteur.php" class="block hover:bg-green-700 p-2 rounded">Accueil</a></li>
        <li><a href="animal.php" class="block hover:bg-green-700 p-2 rounded">Animaux</a></li>
        <li><a href="lion.php" class="block hover:bg-green-700 p-2 rounded">Lion de l’Atlas</a></li>
        <li><a href="visites.php" class="block hover:bg-green-700 p-2 rounded">Visites guidées</a></li>
        <li><a href="reservation.php" class="block hover:bg-green-700 p-2 rounded">Mes réservations</a></li>
    </ul>

    <hr class="my-6 border-green-600">

    <!-- BOUTON LOGOUT -->
    <a href="../logout.php" class="w-full block text-center bg-red-600 py-2 rounded hover:bg-red-700">
        Déconnexion
    </a>
</aside>

<!-- MAIN CONTENT -->
<main class="flex-1 p-8">
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-bold text-green-800">Bienvenue sur ASSAD Zoo</h2>
        <!-- BOUTON LOGOUT DANS LE HEADER SI VOULU -->
        <a href="../logout.php" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Déconnexion</a>
    </div>

    <p class="mt-4 text-gray-700">
        Explorez les animaux, réservez vos visites guidées et consultez vos réservations.
    </p>

    <div class="grid grid-cols-3 gap-6 mt-8">
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-bold">Animaux</h3>
            <p>Voir tous les animaux</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-bold">Visites</h3>
            <p>Consulter les visites guidées disponibles</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-bold">Réservations</h3>
            <p>Vos réservations en cours</p>
        </div>
    </div>
</main>

</div>
</body>
</html>
