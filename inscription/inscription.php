  













  <!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ASSAD Zoo | Accueil</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-green-900 to-green-700 font-sans">

<!-- HEADER -->
<header class="flex justify-between items-center p-6 bg-white shadow-xl">
    <h1 class="text-3xl font-bold text-green-700">🦁 ASSAD Zoo</h1>
    <div class="space-x-4">
        <button onclick="openLogin()" class="px-4 py-2 bg-green-700 text-white rounded-xl font-semibold hover:bg-green-800 transition">Connexion</button>
        <button onclick="openSignup()" class="px-4 py-2 bg-green-500 text-white rounded-xl font-semibold hover:bg-green-600 transition">S’inscrire</button>
    </div>
</header>

<!-- MAIN -->
<main class="text-white text-center py-16 px-4">
    <h2 class="text-4xl font-bold mb-6">Bienvenue au Zoo Virtuel ASSAD</h2>
    <p class="text-lg mb-12">Découvrez nos animaux et explorez leurs habitats tout en suivant les statistiques du zoo !</p>

    <!-- STATISTIQUES -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
        <div class="bg-white text-green-700 rounded-2xl p-8 shadow-lg">
            <h3 class="text-2xl font-bold">120+</h3>
            <p>Animaux</p>
        </div>
        <div class="bg-white text-green-700 rounded-2xl p-8 shadow-lg">
            <h3 class="text-2xl font-bold">15</h3>
            <p>Habitats</p>
        </div>
        <div class="bg-white text-green-700 rounded-2xl p-8 shadow-lg">
            <h3 class="text-2xl font-bold">5000+</h3>
            <p>Visiteurs par mois</p>
        </div>
    </div>
</main>

<!-- LOGIN POPUP -->
<div id="loginModal" class="fixed inset-0 bg-black bg-opacity-60 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 relative">
        <button onclick="closeLogin()" class="absolute top-3 right-4 text-gray-500 hover:text-red-600 text-lg font-bold">✕</button>
        <h2 class="text-2xl font-bold text-green-700 mb-4 text-center">Connexion</h2>
        <form action="inscription.php" method="POST" class="space-y-4">
    <input type="email" name="email" placeholder="Email" class="w-full border rounded-lg p-2" required>
    <input type="password" name="password" placeholder="Mot de passe" class="w-full border rounded-lg p-2" required>
    <button type="submit" name="login" class="w-full bg-green-700 text-white p-2 rounded-lg font-semibold">Se connecter</button>
</form>

    </div>
</div>

<!-- SIGNUP POPUP -->
<div id="signupModal" class="fixed inset-0 bg-black bg-opacity-60 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 relative">
        <button onclick="closeSignup()" class="absolute top-3 right-4 text-gray-500 hover:text-red-600 text-lg font-bold">✕</button>
        <h2 class="text-2xl font-bold text-green-700 mb-4 text-center">Créer un compte</h2>
       <form method="POST" action="inscription.php" class="space-y-4">
    <input type="text" name="nom" placeholder="Nom complet" class="w-full border rounded-lg p-2" required>
    <input type="email" name="email" placeholder="Email" class="w-full border rounded-lg p-2" required>
    <input type="password" name="motpasse" placeholder="Mot de passe" class="w-full border rounded-lg p-2" required>
    <input type="password" name="confirm_motpasse" placeholder="Confirmer mot de passe" class="w-full border rounded-lg p-2" required>
    <input type="text" name="pays" placeholder="Pays" class="w-full border rounded-lg p-2" required>
    <select name="role" class="w-full border rounded-lg p-2" required>
        <option value="">Sélectionnez le rôle</option>
        <option value="visiteur">Visiteur</option>
        <option value="guide">Guide</option>
    </select>
    <button type="submit" name="signup" class="w-full bg-green-500 text-white p-2 rounded-lg font-semibold">S’inscrire</button>
</form>



    </div>
</div>

<script>
const loginModal = document.getElementById('loginModal');
const signupModal = document.getElementById('signupModal');

function openLogin(){
    loginModal.classList.remove('hidden');
    loginModal.classList.add('flex');
    signupModal.classList.add('hidden');
}

function closeLogin(){
    loginModal.classList.add('hidden');
    loginModal.classList.remove('flex');
}

function openSignup(){
    signupModal.classList.remove('hidden');
    signupModal.classList.add('flex');
    loginModal.classList.add('hidden');
}

function closeSignup(){
    signupModal.classList.add('hidden');
    signupModal.classList.remove('flex');
}
</script>

</body>
</html>
