 <?php

 session_start();

require_once 'classes/database.php';
require_once 'classes/utilisateur.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    $nom = trim($_POST['nom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $role = $_POST['role'] ?? '';

    if (empty($nom)) $errors['nom'] = "Le nom est obligatoire";
    if (empty($email)) $errors['email'] = "L'email est obligatoire";
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = "Format invalide";
    
    if ($password !== $confirm_password) $errors['confirm_password'] = "Les mots de passe ne correspondent pas";
    
    $password_regex = "/^(?=.*[A-Z])(?=.*\d).{8,}$/";
    if (!preg_match($password_regex, $password)) {
        $errors['password'] = "8 caractères, 1 Majuscule, 1 Chiffre minimum.";
    }

    if (empty($errors)) {
        $user = new utilisateur();
        if ($user->trouverParEmail($email)) {
            $errors['email'] = "Email déjà utilisé";
        } else {
            $user->setNom($nom);
            $user->setEmail($email);
            $user->setRole($role);
            $user->setApprouve($role === 'guide' ? 0 : 1);
            $user->setMotPasshash(password_hash($password, PASSWORD_DEFAULT));

            if ($user->cree()) {
            
    $success_msg = "Votre compte a été créé avec succès !"; 

            } else {
                $errors['global'] = "Erreur base de données.";
            }
        }
    }
}


 


$logerrur = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {

    
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    
    if (empty($email) || empty($password)) {
        $logerrur[] = "Veuillez remplir tous les champs.";
    } else {
        $userlg = new utilisateur();
        $user = $userlg->trouverParEmail($email);

        if ($user) {
            
            if (password_verify($password, $user->getMotPasshash())) {
                
                
                if ($user->getRole() === 'guide' && $user->getApprouve() == 0) {
                    $logerrur[] = "Votre compte est en attente d'approbation.";
                } else {
                    
                    $_SESSION['user_id'] = $user->getId();
                    $_SESSION['nom'] = $user->getNom();
                    $_SESSION['role'] = $user->getRole();

                    
                    if ($user->getRole() === 'admin') {
                        header("Location: admin/dashboard_admin.php");
                    } elseif ($user->getRole() === 'guide') {
                        header("Location: guide/dashboard_guide.php");
                    } else {
                        header("Location: visiteur/dashboard_visiteur.php");
                    }
                    exit();
                }
            } else {
                $logerrur[] = "Email ou mot de passe incorrect.";
            }
        } else {
            $logerrur[] = "Email ou mot de passe incorrect.";
        }
    }
}











?>




 
 
 

 
 
 
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
        <button onclick="openSignup()" class="px-4 py-2 bg-green-500 text-white rounded-xl font-semibold hover:bg-green-600 transition">S'inscrire</button>
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
        <form action="index.php" method="POST" class="space-y-4">
            <?php if (!empty($logerrur)): ?>
    <div class="bg-red-100 text-red-700 p-2 rounded mb-4 text-sm">
        <?php foreach ($logerrur as $err) echo $err . "<br>"; ?>
    </div>
<?php endif; ?>
    <input type="email" name="email" placeholder="Email" class="w-full border rounded-lg p-2" required>
    <input type="password" name="password" placeholder="Mot de passe" class="w-full border rounded-lg p-2" required>
    <button type="submit" name="login" class="w-full bg-green-700 text-white p-2 rounded-lg font-semibold">Se connecter</button>
</form>

    </div>
</div>
<!-- sign up-->
<div id="signupModal" class="fixed inset-0 bg-black bg-opacity-60 <?php echo isset($_POST['signup']) ? 'flex' : 'hidden'; ?> items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 relative">
        <button onclick="closeSignup()" class="absolute top-3 right-4 text-gray-500 hover:text-red-600 text-lg font-bold">✕</button>
        <h2 class="text-2xl font-bold text-green-700 mb-4 text-center">Créer un compte</h2>
        <?php if(isset($success_msg)): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
        <?php echo $success_msg; ?>
    </div>
<?php endif; ?>
        <form method="POST" action="index.php" class="space-y-4">
            
            <div>
                <input type="text" name="nom" placeholder="Nom complet" 
                       value="<?php echo $_POST['nom'] ?? ''; ?>" 
                       class="w-full border rounded-lg p-2 <?php echo isset($errors['nom']) ? 'border-red-500' : 'border-gray-300'; ?>">
                <?php if(isset($errors['nom'])): ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo $errors['nom']; ?></p>
                <?php endif; ?>
            </div>

            <div>
                <input type="email" name="email" placeholder="Email" 
                       value="<?php echo $_POST['email'] ?? ''; ?>" 
                       class="w-full border rounded-lg p-2 <?php echo isset($errors['email']) ? 'border-red-500' : 'border-gray-300'; ?>">
                <?php if(isset($errors['email'])): ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo $errors['email']; ?></p>
                <?php endif; ?>
            </div>

            <div>
                <input type="password" name="password" placeholder="Mot de passe" 
                       class="w-full border rounded-lg p-2 <?php echo isset($errors['password']) ? 'border-red-500' : 'border-gray-300'; ?>">
                <?php if(isset($errors['password'])): ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo $errors['password']; ?></p>
                <?php endif; ?>
            </div>

            <div>
                <input type="password" name="confirm_password" placeholder="Confirmer mot de passe" 
                       class="w-full border rounded-lg p-2 <?php echo isset($errors['confirm_password']) ? 'border-red-500' : 'border-gray-300'; ?>">
                <?php if(isset($errors['confirm_password'])): ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo $errors['confirm_password']; ?></p>
                <?php endif; ?>
            </div>

            <select name="role" class="w-full border rounded-lg p-2" required>
                <option value="visiteur">Visiteur</option>
                <option value="guide">Guide</option>
            </select>
            
            <button type="submit" name="signup" class="w-full bg-green-500 text-white p-2 rounded-lg font-semibold hover:bg-green-600 transition">S'inscrire</button>
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