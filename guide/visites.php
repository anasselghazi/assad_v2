<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Accueil Visiteur</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex">

<!-- SIDEBAR -->

<aside class="w-64 bg-green-800 text-white p-6 min-h-screen">
  <h1 class="text-2xl font-bold mb-8">🦁 ASSAD Zoo</h1>
  <nav class="space-y-4">
    <a href="dashboard_guide.php" class="block hover:bg-green-700 p-2 rounded">Accueil</a>
    <a href="animal.php" class="block hover:bg-green-700 p-2 rounded">Animaux</a>
    <a href="lion.php" class="block hover:bg-green-700 p-2 rounded">Lion de l’Atlas</a>
    <a href="visites.php" class="block hover:bg-green-700 p-2 rounded">Visites guidées</a>
    <a href="reservation.php" class="block hover:bg-green-700 p-2 rounded">Mes réservations</a>
    <a href="deconnexion.php" class="block hover:bg-green-700 p-2 rounded">Mes réservations</a>
  </nav>
</aside>

<main class="flex-1 p-10">
  <h2 class="text-2xl font-bold mb-6">Visites guidées disponibles</h2>

  <div class="bg-white p-6 rounded shadow mb-4">
    <p><b>Titre :</b> Découverte de la Savane</p>
    <p><b>Date :</b> 15/06/2025 – 10:00</p>
    <p><b>Langue :</b> Français</p>
    <p><b>Prix :</b> 50 MAD</p>
    <a href="reservation.html" class="inline-block mt-2 bg-green-600 text-white px-4 py-2 rounded">
      Réserver
    </a>
  </div>
</main>
</body>
</html>