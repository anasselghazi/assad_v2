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
<title>Accueil Visiteur</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex">

<!-- SIDEBAR -->

<aside class="w-64 bg-green-800 text-white p-6 min-h-screen">
  <h1 class="text-2xl font-bold mb-8">🦁 ASSAD Zoo</h1>
  <nav class="space-y-4">
    <a href="dashboard_visiteur.php" class="block hover:bg-green-700 p-2 rounded">Accueil</a>
    <a href="animal.php" class="block hover:bg-green-700 p-2 rounded">Animaux</a>
    <a href="lion.php" class="block hover:bg-green-700 p-2 rounded">Lion de l’Atlas</a>
    <a href="visites.php" class="block hover:bg-green-700 p-2 rounded">Visites guidées</a>
    <a href="reservation.php" class="block hover:bg-green-700 p-2 rounded">Mes réservations</a>
   </nav>
</aside>

<main class="flex-1 p-10">
  <h2 class="text-2xl font-bold mb-6">Animaux</h2>

  <div class="grid grid-cols-3 gap-6">
    <div class="bg-white p-4 rounded shadow">
      <img src="lion.jpg" class="h-40 w-full object-cover rounded">
      <p class="mt-2 font-bold">Lion</p>
      <p>Savane – Maroc</p>
    </div>

    <div class="bg-white p-4 rounded shadow">
      <img src="elephant.jpg" class="h-40 w-full object-cover rounded">
      <p class="mt-2 font-bold">Éléphant</p>
      <p>Savane – Afrique</p>
    </div>
  </div>
</main>
