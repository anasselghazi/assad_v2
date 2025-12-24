 <?php
require_once "../classes/database.php";
require_once "../classes/utilisateur.php";

$erreurs = [];
$messageSucces = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données
    $nom = trim($_POST['nom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $motDePasse = $_POST['motDePasse'] ?? '';
    $confirmMotDePasse = $_POST['confirmMotDePasse'] ?? '';
    $role = $_POST['role'] ?? '';

    // ÉTAPE 1 : Vérification champs vides
    if (empty($nom)) {
        $erreurs['nom'] = "Le nom est requis";
    }
    if (empty($email)) {
        $erreurs['email'] = "L'email est requis";
    }
    if (empty($motDePasse)) {
        $erreurs['motDePasse'] = "Le mot de passe est requis";
    }
    if (empty($confirmMotDePasse)) {
        $erreurs['confirmMotDePasse'] = "La confirmation est requise";
    }
    if (empty($role)) {
        $erreurs['role'] = "Le rôle est requis";
    }

    // ÉTAPE 2 : Format email
    if (!empty($email)) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erreurs['email'] = "Format email incorrect (ex: nom@test.com)";
        }
    }

    // ÉTAPE 3-4 : Mot de passe fort
    if (!empty($motDePasse)) {
        if (strlen($motDePasse) < 8) {
            $erreurs['motDePasse'] = "Mot de passe trop court (8 caractères minimum)";
        } else if (!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $motDePasse)) {
            $erreurs['motDePasse'] = "1 majuscule + 1 chiffre requis (ex: Mot12345)";
        }
    }

    // ÉTAPE 5 : Confirmation identique
    if (!empty($motDePasse) && !empty($confirmMotDePasse)) {
        if ($motDePasse !== $confirmMotDePasse) {
            $erreurs['confirmMotDePasse'] = "Les mots de passe ne correspondent pas";
        }
    }

    // ÉTAPE 6-7 : Hash + Création utilisateur
    if (empty($erreurs)) {
        $motPasseHash = password_hash($motDePasse, PASSWORD_DEFAULT);
        $approuve = ($role === 'GUIDE') ? 0 : 1;
        
        $user = new utilisateur(null, $nom, $email, $role, $motPasseHash, 1, $approuve);
        
        if ($user->cree()) {
            $messageSucces = "✅ INSCRIPTION RÉUSSIE ! ID: " . $user->getId();
        } else {
            $erreurs['general'] = "Erreur création utilisateur";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Inscription Visiteur/Guide</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            max-width: 500px; 
            margin: 50px auto; 
            padding: 20px;
            background: #f8f9fa;
        }
        .form-group { 
            margin-bottom: 20px; 
        }
        label { 
            display: block; 
            margin-bottom: 5px; 
            font-weight: bold; 
            color: #333;
        }
        input, select { 
            width: 100%; 
            padding: 12px; 
            border: 1px solid #ddd; 
            border-radius: 5px; 
            box-sizing: border-box;
            font-size: 16px;
        }
        input:focus, select:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0,123,255,0.3);
        }
        .erreur { 
            color: #dc3545; 
            font-size: 14px; 
            margin-top: 5px; 
            display: block;
        }
        .succes { 
            background: #d4edda; 
            color: #155724; 
            padding: 15px; 
            border: 1px solid #c3e6cb; 
            border-radius: 5px; 
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }
        button { 
            background: #28a745; 
            color: white; 
            padding: 15px 30px; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            font-size: 16px;
            width: 100%;
        }
        button:hover { 
            background: #218838; 
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .general-error {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>📝 Inscription Visiteur/Guide</h1>

    <?php if ($messageSucces): ?>
        <div class="succes"><?= $messageSucces ?></div>
    <?php endif; ?>

    <?php if (isset($erreurs['general'])): ?>
        <div class="general-error"><?= $erreurs['general'] ?></div>
    <?php endif; ?>

    <?php if (!empty($erreurs) && empty($messageSucces)): ?>
        <div style="background: #fff3cd; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            <strong>⚠️ Veuillez corriger les erreurs ci-dessous :</strong>
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label for="nom">Nom complet :</label>
            <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>" placeholder="Ahmed">
            <?php if (isset($erreurs['nom'])): ?>
                <span class="erreur"><?= $erreurs['nom'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" placeholder="test@test.com">
            <?php if (isset($erreurs['email'])): ?>
                <span class="erreur"><?= $erreurs['email'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="motDePasse">Mot de passe (8+ caractères, 1 majuscule, 1 chiffre) :</label>
            <input type="password" id="motDePasse" name="motDePasse" placeholder="Mot12345">
            <?php if (isset($erreurs['motDePasse'])): ?>
                <span class="erreur"><?= $erreurs['motDePasse'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="confirmMotDePasse">Confirmer mot de passe :</label>
            <input type="password" id="confirmMotDePasse" name="confirmMotDePasse" placeholder="Mot12345">
            <?php if (isset($erreurs['confirmMotDePasse'])): ?>
                <span class="erreur"><?= $erreurs['confirmMotDePasse'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="role">Rôle :</label>
            <select id="role" name="role">
                <option value="">-- Choisir un rôle --</option>
                <option value="VISITEUR" <?= ($_POST['role'] ?? '') === 'VISITEUR' ? 'selected' : '' ?>>👤 Visiteur</option>
                <option value="GUIDE" <?= ($_POST['role'] ?? '') === 'GUIDE' ? 'selected' : '' ?>>🧭 Guide</option>
            </select>
            <?php if (isset($erreurs['role'])): ?>
                <span class="erreur"><?= $erreurs['role'] ?></span>
            <?php endif; ?>
        </div>

        <button type="submit">✅ S'INSCRIRE</button>
    </form>

    <div style="margin-top: 30px; padding: 15px; background: #e9ecef; border-radius: 5px; font-size: 14px;">
        <strong>🧪 Tests :</strong><br>
        • Email: <code>test@test.com</code><br>
        • Mot de passe: <code>Mot12345</code> (8+ chars, majuscule, chiffre)
    </div>
</body>
</html>
