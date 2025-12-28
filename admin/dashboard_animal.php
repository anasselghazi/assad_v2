 <?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}

require_once '../classes/database.php';
require_once '../classes/animal.php';
require_once '../classes/habitat.php';

// ----- GESTION ACTIONS CRUD -----
$animaux = Animal::listerTous();
$habitats = (new Habitat())->listerTous();

// AJOUTER
if (isset($_POST['submit'])) {
    Animal::creer(
        $_POST['nom'], $_POST['espece'], $_POST['alimentation'],
        $_POST['image'], $_POST['pays_origine'], $_POST['description'],
        $_POST['id_habitat']
    );
    header('Location: admin_animaux.php');
    exit();
}

// MODIFIER
if (isset($_POST['update'])) {
    Animal::mettreAJour(
        $_POST['edit_id_animal'], $_POST['edit_nom'], $_POST['edit_espece'],
        $_POST['edit_alimentation'], $_POST['edit_image'], $_POST['edit_pays_origine'],
        $_POST['edit_description'], $_POST['edit_id_habitat']
    );
    header('Location: admin_animaux.php');
    exit();
}

// SUPPRIMER
if (isset($_POST['delete'])) {
    Animal::supprimer($_POST['id_animal']);
    header('Location: admin_animaux.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ASSAD | Admin Animaux</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
<div class="flex min-h-screen">

    <!-- SIDEBAR (IDENTIQUE) -->
    <aside class="w-64 bg-gradient-to-b from-green-900 to-green-700 text-white p-6 space-y-8 shadow-2xl">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold tracking-wide">🦁 ASSAD</h2>
            <p class="text-sm text-green-200 mt-1">Admin Panel</p>
        </div>
        <nav class="flex flex-col gap-4 text-sm font-semibold">
            <a href="dashboard_admin.php" class="flex items-center gap-3 bg-green-600 p-3 rounded-xl">🏠 Dashboard</a>
            <a href="admin_utilisateurs.php" class="flex items-center gap-3 hover:bg-green-600 p-3 rounded-xl">👥 Utilisateurs</a>
            <a href="admin_animaux.php" class="flex items-center gap-3 bg-green-600 p-3 rounded-xl">🐾 Animaux</a>
            <a href="admin_habitats.php" class="flex items-center gap-3 hover:bg-green-600 p-3 rounded-xl">🌍 Habitats</a>
            <a href="statistiques.php" class="flex items-center gap-3 hover:bg-green-600 p-3 rounded-xl">📊 Statistiques</a>
            <a href="logout.php" class="flex items-center gap-3 hover:bg-green-600 p-3 rounded-xl">🚪 Déconnexion</a>
        </nav>
        <div class="pt-10 text-center text-green-200 text-xs">
            CAN 2025 • Maroc 🇲🇦 <br> © ASSAD Zoo
        </div>
    </aside>

    <!-- MAIN (IDENTIQUE + POO) -->
    <main class="flex-1 p-8">
        <header class="bg-white rounded-2xl shadow p-6 mb-8 text-center">
            <h1 class="text-3xl font-bold text-green-800">Gestion des Animaux</h1>
            <p class="text-gray-600">CRUD complet avec classes POO + PDO</p>
        </header>

        <div class="flex justify-end mb-6">
            <button onclick="openAddModal()"
                    class="bg-green-700 hover:bg-green-800 text-white px-6 py-3 rounded-xl font-semibold">
                ➕ Ajouter un animal
            </button>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-xl font-bold text-green-800 mb-4">📋 Liste des Animaux (<?= count($animaux) ?>)</h2>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left border-collapse">
                    <thead>
                        <tr class="bg-green-700 text-white">
                            <th class="p-3">Image</th>
                            <th class="p-3">Nom</th>
                            <th class="p-3">Espèce</th>
                            <th class="p-3">Alimentation</th>
                            <th class="p-3">Pays</th>
                            <th class="p-3">Habitat</th>
                            <th class="p-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <?php if (!empty($animaux)): ?>
                            <?php foreach ($animaux as $animal): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3">
                                        <?php if ($animal['image']): ?>
                                            <img src="uploads/animaux/<?= htmlspecialchars($animal['image']) ?>" 
                                                 class="w-16 h-16 object-cover rounded-lg" alt="<?= htmlspecialchars($animal['nom']) ?>">
                                        <?php else: ?>
                                            <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500">🐾</div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="p-3 font-semibold"><?= htmlspecialchars($animal['nom']) ?></td>
                                    <td class="p-3"><?= htmlspecialchars($animal['espece']) ?></td>
                                    <td class="p-3"><?= htmlspecialchars($animal['alimentation']) ?></td>
                                    <td class="p-3"><?= htmlspecialchars($animal['pays_origine']) ?></td>
                                    <td class="p-3"><?= htmlspecialchars($animal['habitat_nom'] ?? 'Sans habitat') ?></td>
                                    <td class="p-3 text-center space-x-2">
                                        <!-- MODIFIER (JavaScript identique) -->
                                        <button onclick="openEditModal(
                                            <?= $animal['id_animal'] ?>,
                                            '<?= addslashes($animal['nom']) ?>',
                                            '<?= addslashes($animal['espece']) ?>',
                                            '<?= addslashes($animal['alimentation']) ?>',
                                            '<?= addslashes($animal['pays_origine']) ?>',
                                            '<?= $animal['id_habitat'] ?>',
                                            '<?= addslashes($animal['description']) ?>',
                                            '<?= addslashes($animal['image']) ?>'
                                        )"
                                        class="bg-blue-600 text-white px-3 py-1 rounded-lg text-xs hover:bg-blue-700">
                                            ✏️
                                        </button>

                                        <!-- SUPPRIMER (POO) -->
                                        <form method="POST" action="admin_animaux.php" style="display:inline;" 
                                              onsubmit="return confirm('Supprimer <?= addslashes($animal['nom']) ?> ?');">
                                            <input type="hidden" name="id_animal" value="<?= $animal['id_animal'] ?>">
                                            <button type="submit" name="delete" 
                                                    class="bg-red-600 text-white px-3 py-1 rounded-lg text-xs hover:bg-red-700">
                                                🗑️
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="p-4 text-center text-gray-500">
                                    Aucun animal. <a href="#addModal" onclick="openAddModal()" class="text-green-600 underline">Ajouter le premier!</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<!-- MODALS (IDENTIQUES mais avec POO) -->
<!-- ADD MODAL -->
<div id="addModal" class="fixed inset-0 bg-black bg-opacity-60 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-sm p-4 relative">
        <button onclick="closeAddModal()" class="absolute top-2 right-3 text-gray-500 hover:text-red-600 text-lg font-bold">✕</button>
        <h2 class="text-lg font-bold text-green-700 mb-3 text-center">➕ Ajouter un animal</h2>
        <form action="admin_animaux.php" method="POST" class="space-y-2 text-sm">
            <input type="text" name="nom" placeholder="Nom" class="w-full border rounded-lg p-2" required>
            <input type="text" name="espece" placeholder="Espèce" class="w-full border rounded-lg p-2" required>
            <select name="alimentation" class="w-full p-2 border rounded-xl" required>
                <option value="">Type alimentaire</option>
                <option value="Carnivore">Carnivore</option>
                <option value="Herbivore">Herbivore</option>
                <option value="Omnivore">Omnivore</option>
            </select>
            <input type="text" name="pays_origine" placeholder="Pays d'origine" class="w-full border rounded-lg p-2" required>
            <select name="id_habitat" class="w-full p-2 border rounded-xl" required>
                <option value="">Sélectionnez un habitat</option>
                <?php foreach ($habitats as $h): ?>
                    <option value="<?= $h['id_habitat'] ?>"><?= htmlspecialchars($h['nom']) ?></option>
                <?php endforeach; ?>
            </select>
            <input type="text" name="image" placeholder="Image (lion.jpg)" class="w-full border rounded-lg p-2">
            <textarea name="description" placeholder="Description" class="w-full border rounded-lg p-2 h-14"></textarea>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="closeAddModal()" class="px-3 py-1 border rounded-lg">Annuler</button>
                <button type="submit" name="submit" class="bg-green-700 hover:bg-green-800 text-white px-3 py-1 rounded-lg">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<!-- EDIT MODAL (IDENTIQUE) -->
<div id="editAnimalModal" class="fixed inset-0 bg-black bg-opacity-60 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-sm p-6 relative">
        <button onclick="closeEditAnimalModal()" class="absolute top-2 right-3 text-gray-500 hover:text-red-600 text-lg font-bold">✕</button>
        <h2 class="text-lg font-bold text-green-700 mb-3 text-center">✏️ Modifier un animal</h2>
        <form method="POST" action="admin_animaux.php" class="space-y-2">
            <input type="hidden" name="edit_id_animal" id="edit_id_animal">
            <input type="text" name="edit_nom" id="edit_nom" placeholder="Nom" class="w-full border rounded-lg p-2" required>
            <input type="text" name="edit_espece" id="edit_espece" placeholder="Espèce" class="w-full border rounded-lg p-2" required>
            <select name="edit_alimentation" id="edit_alimentation" class="w-full border rounded-lg p-2" required>
                <option value="Carnivore">Carnivore</option>
                <option value="Herbivore">Herbivore</option>
                <option value="Omnivore">Omnivore</option>
            </select>
            <input type="text" name="edit_pays_origine" id="edit_pays_origine" placeholder="Pays d'origine" class="w-full border rounded-lg p-2" required>
            <select name="edit_id_habitat" id="edit_id_habitat" class="w-full border rounded-lg p-2" required>
                <?php foreach ($habitats as $h): ?>
                    <option value="<?= $h['id_habitat'] ?>"><?= htmlspecialchars($h['nom']) ?></option>
                <?php endforeach; ?>
            </select>
            <input type="text" name="edit_image" id="edit_image" placeholder="Image" class="w-full border rounded-lg p-2">
            <textarea name="edit_description" id="edit_description" placeholder="Description" class="w-full border rounded-lg p-2 h-14"></textarea>
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="closeEditAnimalModal()" class="px-3 py-1 border rounded-lg">Annuler</button>
                <button type="submit" name="update" class="bg-green-700 hover:bg-green-800 text-white px-3 py-1 rounded-lg">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<!-- JAVASCRIPT (IDENTIQUE) -->
<script>
const addModal = document.getElementById("addModal");
function openAddModal() { addModal.classList.remove("hidden"); addModal.classList.add("flex"); }
function closeAddModal() { addModal.classList.add("hidden"); addModal.classList.remove("flex"); }
function openEditModal(id, nom, espece, alimentation, pays, habitat, description, image) {
    document.getElementById('edit_id_animal').value = id;
    document.getElementById('edit_nom').value = nom;
    document.getElementById('edit_espece').value = espece;
    document.getElementById('edit_alimentation').value = alimentation;
    document.getElementById('edit_pays_origine').value = pays;
    document.getElementById('edit_id_habitat').value = habitat;
    document.getElementById('edit_description').value = description;
    document.getElementById('edit_image').value = image;
    const modal = document.getElementById('editAnimalModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}
function closeEditAnimalModal() {
    const modal = document.getElementById('editAnimalModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>

</body>
</html>
