

 

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASSAD Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-gradient-to-b from-green-900 to-green-700 text-white p-6 space-y-8 shadow-2xl">
        
        <!-- Logo -->
        <div class="text-center">
            <h2 class="text-3xl font-extrabold tracking-wide">🦁 ASSAD</h2>
            <p class="text-sm text-green-200 mt-1">Admin Panel</p>
        </div>

        <!-- Navigation -->
        <nav class="flex flex-col gap-4 text-sm font-semibold">

            <a href="dashboard.php"
               class="flex items-center gap-3 bg-green-600 hover:bg-green-500 transition p-3 rounded-xl">
                🏠 <span>Dashboard</span>
            </a>

            <a href="user.php"
               class="flex items-center gap-3 hover:bg-green-600 transition p-3 rounded-xl">
                👥 <span>Utilisateurs</span>
            </a>

            <a href="animal.php"
               class="flex items-center gap-3 hover:bg-green-600 transition p-3 rounded-xl">
                🐾 <span>Animaux</span>
            </a>

            <a href="habitat.php"
               class="flex items-center gap-3 hover:bg-green-600 transition p-3 rounded-xl">
                🌍 <span>Habitats</span>
            </a>

            <a href="statistique.php"
               class="flex items-center gap-3 hover:bg-green-600 transition p-3 rounded-xl">
                📊 <span>Statistiques</span>
            </a>
              <a href="logout.php"
               class="flex items-center gap-3 hover:bg-green-600 transition p-3 rounded-xl">
               🚪 <span> Déconnexion</span>
            </a>
        </nav>

        <!-- Footer Sidebar -->
        <div class="pt-10 text-center text-green-200 text-xs">
            CAN 2025 • Maroc 🇲🇦 <br>
            © ASSAD Zoo
        </div>

    </aside>
    <!-- MAIN CONTENT -->
    <main class="flex-1 p-8">

        <!-- Top Header -->
        <header class="bg-white rounded-2xl shadow-md p-6 flex justify-between items-center mb-10">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Tableau de bord Administrateur</h1>
                <p class="text-gray-500 text-sm">Gestion du Zoo Virtuel ASSAD</p>
            </div>

            <a href="logout.php"
               class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-xl font-semibold transition">
                Déconnexion
            </a>
        </header>

        <!-- STATS CARDS -->
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">

            <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                <p class="text-gray-500 text-sm">Utilisateurs</p>
                <h3 class="text-4xl font-bold text-green-700 mt-2">245</h3>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                <p class="text-gray-500 text-sm">Animaux</p>
                <h3 class="text-4xl font-bold text-green-700 mt-2">68</h3>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                <p class="text-gray-500 text-sm">Habitats</p>
                <h3 class="text-4xl font-bold text-green-700 mt-2">12</h3>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                <p class="text-gray-500 text-sm">Visites réservées</p>
                <h3 class="text-4xl font-bold text-green-700 mt-2">189</h3>
            </div>

        </section>

        <!-- QUICK ACTIONS -->
        <section>
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Actions rapides</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-white rounded-2xl shadow-xl p-6 hover:-translate-y-1 transition text-center">
                    <h3 class="text-lg font-semibold text-green-700 mb-2">➕ Ajouter un animal</h3>
                    <p class="text-gray-600 text-sm">Créer une nouvelle fiche animal</p>
                </div>

                <div class="bg-white rounded-2xl shadow-xl p-6 hover:-translate-y-1 transition text-center">
                    <h3 class="text-lg font-semibold text-green-700 mb-2">🌍 Nouveau habitat</h3>
                    <p class="text-gray-600 text-sm">Ajouter une zone du zoo</p>
                </div>

                <div class="bg-white rounded-2xl shadow-xl p-6 hover:-translate-y-1 transition text-center">
                    <h3 class="text-lg font-semibold text-green-700 mb-2">👤 Gérer les rôles</h3>
                    <p class="text-gray-600 text-sm">Approuver les guides</p>
                </div>

            </div>
        </section>

    </main>

</div>

</body>
</html>
