 <?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}

require_once '../classes/database.php';
require_once '../classes/Habitat.php';

// ----- GESTION ACTIONS CRUD -----
$habitats = (new Habitat())->listerTous();

// AJOUTER
if (isset($_POST['submit'])) {
    Habitat::creer(
        $_POST['nom_habitat'], $_POST['type_climat'], $_POST['description'], $_POST['zone_zoo']
    );
    header('Location: admin_habitats.php');
    exit();
}

// MODIFIER
if (isset($_POST['update'])) {
    Habitat::mettreAJour(
        $_POST['edit_id'], $_POST['edit_nom'], $_POST['edit_type_climat'],
        $_POST['edit_description'], $_POST['edit_zone_zoo']
    );
    header('Location: admin_habitats.php');
    exit();
}

// SUPPRIMER
if (isset($_POST['delete'])) {
    Habitat::supprimer($_POST['id_habitat']);
    header('Location: admin_habitats.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ASSAD | Admin Habitats</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
<div class="flex min-h-screen">

    <!-- SIDEBAR (adaptée admin) -->
    <aside class="w-64 bg-gradient-to-b from-green-900 to-green-700 text-white p-6 space-y-8 shadow-2xl">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold">🦁 ASSAD</h2>
            <p class="text-sm text-green-200">Admin Panel</p>
        </div>
        <nav class="flex flex-col gap-4 text-sm font-semibold">
            <a href="dashboard_admin.php" class="p-3 bg-green-600 rounded-xl">🏠 Dashboard</a>
            <a href="admin_animaux.php" class="p-3 hover:bg-green-600 rounded-xl">🐾 Animaux</a>
            <a href="admin_habitats.php" class="p-3 bg-green-600 rounded-xl">🌍 Habitats</a>
            <a href="admin_utilisateurs.php" class="p-3 hover:bg-green-600 rounded-xl">👥 Utilisateurs</a>
            <a href="logout.php" class="p-3 hover:bg-green-600 rounded-xl">🚪 Déconnexion</a>
        </nav>
    </aside>

    <!-- MAIN (TON DESIGN CARDS) -->
    <main class="flex-1 p-8">
        <header class="bg-white rounded-2xl shadow p-6 mb-8 text-center">
            <h1 class="text-3xl font-bold text-green-800">Gestion des Habitats</h1>
            <p class="text-gray-600">CRUD POO avec <?= count($habitats) ?> habitats</p>
        </header>

        <div class="flex justify-end mb-6">
            <button onclick="openAddModal()"
                    class="bg-green-700 hover:bg-green-800 text-white px-6 py-3 rounded-xl font-semibold">
                ➕ Ajouter un habitat
            </button>
        </div>

        <!-- TON DESIGN CARDS avec POO -->
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if (!empty($habitats)): ?>
                <?php foreach ($habitats as $habitat): ?>
                    <div class="bg-white rounded-2xl shadow p-6 hover:shadow-xl transition">
                        <h3 class="text-xl font-bold text-green-700 mb-2">
                            <?= htmlspecialchars($habitat['nom']) ?>
                        </h3>
                        <p class="text-gray-600 text-sm mb-3">
                            <?= htmlspecialchars(substr($habitat['description'], 0, 80)) ?>...
                        </p>
                        <span class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full">
                            <?= htmlspecialchars($habitat['zon_zoo']) ?>
                        </span>
                        <p class="text-sm text-gray-500 mt-2">
                            Climat : <?= htmlspecialchars($habitat['type_climate']) ?>
                        </p>

                        <!-- ACTIONS (POO) -->
                        <div class="flex justify-end gap-2 mt-4">
                            <button onclick="openEditModal(
                                <?= $habitat['id_habitat'] ?>,
                                '<?= addslashes($habitat['nom']) ?>',
                                '<?= addslashes($habitat['type_climate']) ?>',
                                '<?= addslashes($habitat['zon_zoo']) ?>',
                                '<?= addslashes($habitat['description']) ?>'
                            )"
                            class="px-4 py-1 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700">
                                ✏️ Edit
                            </button>

                            <form method="POST" action="admin_habitats.php" style="display:inline;" 
                                  onsubmit="return confirm('Supprimer <?= addslashes($habitat['nom']) ?> ?');">
                                <input type="hidden" name="id_habitat" value="<?= $habitat['id_habitat'] ?>">
                                <button type="submit" name="delete" 
                                        class="px-4 py-1 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700">
                                    🗑 Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-12 text-gray-500">
                    Aucun habitat. <button onclick="openAddModal()" class="text-green-600 underline font-semibold">Ajouter le premier!</button>
                </div>
            <?php endif; ?>
        </section>
    </main>
</div>

<!-- TON MODAL AJOUT (adapté POO) -->
<div id="addModal" class="fixed inset-0 bg-black bg-opacity-60 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl w-full max-w-md p-6 relative">
        <button onclick="closeAddModal()" class="absolute top-3 right-3 text-xl">✕</button>
        <form method="POST" action="admin_habitats.php" class="space-y-4">
            <input type="text" name="nom_habitat" placeholder="Nom (ex: Savane)" class="w-full border p-3 rounded-xl" required>
            <input type="text" name="type_climat" placeholder="Climat (ex: Tropical)" class="w-full border p-3 rounded-xl" required>
            <input type="text" name="zone_zoo" placeholder="Zone (ex: Zone A)" class="w-full border p-3 rounded-xl" required>
            <textarea name="description" rows="3" placeholder="Description détaillée..." class="w-full border p-3 rounded-xl" required></textarea>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeAddModal()" class="border px-4 py-2 rounded-xl">Annuler</button>
                <button type="submit" name="submit" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-xl">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<!-- TON MODAL EDIT (adapté POO) -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-60 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 relative">
        <button onclick="closeEditModal()" class="absolute top-3 right-3 text-gray-500 hover:text-red-600 text-xl font-bold">✕</button>
        <h2 class="text-2xl font-bold text-green-700 mb-5">✏️ Modifier un habitat</h2>
        <form method="POST" action="admin_habitats.php" class="space-y-4">
            <input type="hidden" name="edit_id" id="edit_id">
            <input type="text" name="edit_nom" id="edit_nom" placeholder="Nom de l'habitat" class="w-full border rounded-xl p-3" required>
            <input type="text" name="edit_type_climat" id="edit_type_climat" placeholder="Type de climat" class="w-full border rounded-xl p-3" required>
            <input type="text" name="edit_zone_zoo" id="edit_zone_zoo" placeholder="Zone du zoo" class="w-full border rounded-xl p-3" required>
            <textarea name="edit_description" id="edit_description" rows="3" placeholder="Description" class="w-full border rounded-xl p-3" required></textarea>
            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="closeEditModal()" class="px-5 py-2 rounded-xl border">Annuler</button>
                <button type="submit" name="update" class="bg-blue-700 hover:bg-blue-800 text-white px-5 py-2 rounded-xl">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<!-- TON JAVASCRIPT (identique) -->
<script>
const addModal = document.getElementById('addModal');
function openAddModal() { addModal.classList.remove("hidden"); addModal.classList.add("flex"); }
function closeAddModal() { addModal.classList.add("hidden"); addModal.classList.remove("flex"); }
function openEditModal(id, nom, climat, zone, description) {
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_nom').value = nom;
    document.getElementById('edit_type_climat').value = climat;
    document.getElementById('edit_zone_zoo').value = zone;
    document.getElementById('edit_description').value = description;
    const editModal = document.getElementById('editModal');
    editModal.classList.remove('hidden');
    editModal.classList.add('flex');
}
function closeEditModal() {
    const editModal = document.getElementById('editModal');
    editModal.classList.add('hidden');
    editModal.classList.remove('flex');
}
</script>

</body>
</html>
