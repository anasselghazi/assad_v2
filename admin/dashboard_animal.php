  
 <?php 
 require_once "../classes/database";
              
/*ajout*/
 
   
if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $espece = $_POST['espece'];
    $alimentation = $_POST['alimentation'];
    $pays_origine = $_POST['pays_origine'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    $habitat = $_POST['id_habitat'];

    
    $sql = "INSERT INTO animaux 
            (nom, espece, alimentation, pays_origine, description, image, id_habitat)
            VALUES ('$nom', '$espece', '$alimentation', '$pays_origine', '$description', '$image', '$habitat')";

    if (mysqli_query($conn, $sql)) {
        
        header("Location: animal.php");
        exit();
    } else {
        echo "Erreur lors de l'insertion de l'animal: " . mysqli_error($conn);
    }
}

/* affichage */
  
$sql_animaux = "
       SELECT 
        a.id_animal,
        a.nom,
        a.espece,
        a.alimentation,
        a.pays_origine,
        a.description,
        a.image,
        a.id_habitat,
        h.nom_habitat
    FROM animaux AS a
    INNER JOIN habitats AS h 
        ON a.id_habitat = h.id_habitat
    ORDER BY a.id_animal DESC
";

$result_animaux = mysqli_query($conn, $sql_animaux);


if (!$result_animaux) {
    die("Erreur SQL: " . mysqli_error($conn));
}
 /*delete*/
 if(isset($_POST['delete']) && isset($_POST['id_animal'])){
    $id = ($_POST['id_animal']);   
    $sql = "DELETE FROM animaux WHERE id_animal = $id";

    if(mysqli_query($conn, $sql)){
        header("Location: animal.php?delete=1");
        exit();
    } else {
        echo "Erreur : " . mysqli_error($conn);
    }
}
/*edit*/
if(isset($_POST['update'])) {
    $id = $_POST['edit_id_animal'];
    $nom = $_POST['edit_nom'];
    $espece = $_POST['edit_espece'];
    $alimentation = $_POST['edit_alimentation'];
    $pays = $_POST['edit_pays_origine'];
    $habitat = $_POST['edit_id_habitat'];
    $image = $_POST['edit_image'];
    $description = $_POST['edit_description'];

    $sql_update = "UPDATE animaux SET 
        nom='$nom',
        espece='$espece',
        alimentation='$alimentation',
        pays_origine='$pays',
        id_habitat='$habitat',
        image='$image',
        description='$description'
        WHERE id_animal='$id'";

    if(mysqli_query($conn, $sql_update)){
        header("Location: animal.php?updated=1");
        exit();
    } else {
        echo "Erreur: " . mysqli_error($conn);
    }
}





?>




  
  
  
  
  
  
  
  
  
  
  <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ASSAD | Animaux</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

<div class="flex min-h-screen">

    <!-- SIDEBAR (UNCHANGED) -->
    <aside class="w-64 bg-gradient-to-b from-green-900 to-green-700 text-white p-6 space-y-8 shadow-2xl">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold tracking-wide">🦁 ASSAD</h2>
            <p class="text-sm text-green-200 mt-1">Admin Panel</p>
        </div>

        <nav class="flex flex-col gap-4 text-sm font-semibold">
            <a href="dashboard.php" class="flex items-center gap-3 bg-green-600 p-3 rounded-xl">🏠 Dashboard</a>
            <a href="user.php" class="flex items-center gap-3 hover:bg-green-600 p-3 rounded-xl">👥 Utilisateurs</a>
            <a href="animal.php" class="flex items-center gap-3 hover:bg-green-600 p-3 rounded-xl">🐾 Animaux</a>
            <a href="habitat.php" class="flex items-center gap-3 hover:bg-green-600 p-3 rounded-xl">🌍 Habitats</a>
            <a href="statistique.php" class="flex items-center gap-3 hover:bg-green-600 p-3 rounded-xl">📊 Statistiques</a>
            <a href="logout.php" class="flex items-center gap-3 hover:bg-green-600 p-3 rounded-xl">🚪 Déconnexion</a>
        </nav>

        <div class="pt-10 text-center text-green-200 text-xs">
            CAN 2025 • Maroc 🇲🇦 <br> © ASSAD Zoo
        </div>
    </aside>

    <!-- MAIN -->
    <main class="flex-1 p-8">

        <header class="bg-white rounded-2xl shadow p-6 mb-8 text-center">
            <h1 class="text-3xl font-bold text-green-800">Gestion des Animaux</h1>
            <p class="text-gray-600">Ajouter, consulter et organiser les animaux</p>
        </header>

        <div class="flex justify-end mb-6">
            <button onclick="openAddModal()"
                class="bg-green-700 hover:bg-green-800 text-white px-6 py-3 rounded-xl font-semibold">
                ➕ Ajouter un animal
            </button>
        </div>
<div class="bg-white rounded-2xl shadow p-6">
    <h2 class="text-xl font-bold text-green-800 mb-4">📋 Liste des Animaux</h2>

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
                <?php if ($result_animaux && mysqli_num_rows($result_animaux) > 0): ?>
                    <?php while ($animal = mysqli_fetch_assoc($result_animaux)): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="p-3">
                                <img src="<?= $animal['image']; ?>" 
                                     class="w-16 h-16 object-cover rounded-lg">
                            </td>

                            <td class="p-3 font-semibold"><?= $animal['nom']; ?></td>
                            <td class="p-3"><?= $animal['espece']; ?></td>
                            <td class="p-3"><?= $animal['alimentation']; ?></td>
                            <td class="p-3"><?= $animal['pays_origine']; ?></td>
                            <td class="p-3"><?= $animal['nom_habitat']; ?></td>

                            <td class="p-3 text-center space-x-2">
                                <!--edit-->
                                <button 
                       onclick="openEditModal(
                  <?= $animal['id_animal']; ?>,
                  '<?= addslashes($animal['nom']); ?>',
                 '<?= addslashes($animal['espece']); ?>',
                  '<?= addslashes($animal['alimentation']); ?>',
                  '<?= addslashes($animal['pays_origine']); ?>',
                 '<?= $animal['id_habitat']; ?>',
                 '<?= addslashes($animal['description']); ?>',
                '<?= addslashes($animal['image']); ?>'
    )"
    class="bg-blue-600 text-white px-3 py-1 rounded-lg text-xs">
    ✏️
</button>


                                <form method="POST"  action="animal.php" style="display:inline;" 
                                onsubmit="return confirm('Voulez-vous vraiment supprimer cet animal ?');">
                               <input type="hidden" name="id_animal" value="<?= $animal['id_animal']; ?>">
                               <button type="submit" name="delete" 
                                class="bg-red-600 text-white px-3 py-1 rounded-lg text-xs">
                              🗑️
                               </button>
    </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="p-4 text-center text-gray-500">
                            Aucun animal trouvé
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

    </main>
</div>

<!-- POPUP (SMALL & CLEAN) -->
<div id="addModal" class="fixed inset-0 bg-black bg-opacity-60 hidden items-center justify-center z-50">

    <div class="bg-white rounded-xl shadow-xl w-full max-w-sm p-4 relative">

        <button onclick="closeAddModal()"
            class="absolute top-2 right-3 text-gray-500 hover:text-red-600 text-lg font-bold">
            ✕
        </button>

        <h2 class="text-lg font-bold text-green-700 mb-3 text-center">
            ➕ Ajouter un animal
        </h2>

        <form action="animal.php" method="POST" class="space-y-2 text-sm">

            <input type="text" name="nom" placeholder="Nom"
                   class="w-full border rounded-lg p-2" required>

            <input type="text" name="espece" placeholder="Espèce"
                   class="w-full border rounded-lg p-2" required>
       

              <select name="alimentation" class="w-full p-2 border rounded-xl">
                    <option value="">Type alimentaire</option>
                    <option value="Carnivore">Carnivore</option>
                    <option value="Herbivore">Herbivore</option>
                    <option value="Omnivore">Omnivore</option>
                </select>

             

            <input type="text" name="pays_origine" placeholder="Pays d’origine"
                   class="w-full border rounded-lg p-2" required>

                 <select name="id_habitat" class="w-full p-2 border rounded-xl">
                 <option value="">Sélectionnez un habitat</option>
                 <?php
                  $habitats = mysqli_query($conn, "SELECT id_habitat, nom_habitat FROM habitats");
                 while($h = mysqli_fetch_assoc($habitats)){
                echo "<option value='{$h['id_habitat']}'>{$h['nom_habitat']}</option>";
             }
           ?>
       </select>


            <input type="text" name="image" placeholder="Image (URL)"
                   class="w-full border rounded-lg p-2" required>

            <textarea name="description" placeholder="Description"
                      class="w-full border rounded-lg p-2 h-14" required></textarea>

            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="closeAddModal()"
                        class="px-3 py-1 border rounded-lg">
                    Annuler
                </button>

                <button type="submit" name="submit"
                        class="bg-green-700 hover:bg-green-800 text-white px-3 py-1 rounded-lg">
                    Enregistrer
                </button>
            </div>

        </form>

    </div>
</div>
<div id="editAnimalModal" class="fixed inset-0 bg-black bg-opacity-60 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-sm p-6 relative">
        <button onclick="closeEditAnimalModal()" class="absolute top-2 right-3 text-gray-500 hover:text-red-600 text-lg font-bold">
            ✕
        </button>

        <h2 class="text-lg font-bold text-green-700 mb-3 text-center">✏️ Modifier un animal</h2>

        <form method="POST" action="animal.php" class="space-y-2">
            <input type="hidden" name="edit_id_animal" id="edit_id_animal">

            <input type="text" name="edit_nom" id="edit_nom" placeholder="Nom" class="w-full border rounded-lg p-2" required>
            <input type="text" name="edit_espece" id="edit_espece" placeholder="Espèce" class="w-full border rounded-lg p-2" required>
            <select name="edit_alimentation" id="edit_alimentation" class="w-full border rounded-lg p-2" required>
                <option value="Carnivore">Carnivore</option>
                <option value="Herbivore">Herbivore</option>
                <option value="Omnivore">Omnivore</option>
            </select>
            <input type="text" name="edit_pays_origine" id="edit_pays_origine" placeholder="Pays d’origine" class="w-full border rounded-lg p-2" required>
            <select name="edit_id_habitat" id="edit_id_habitat" class="w-full border rounded-lg p-2" required>
                 <?php
                $habitats = mysqli_query($conn, "SELECT id_habitat, nom_habitat FROM habitats");
                while($h = mysqli_fetch_assoc($habitats)){
                    echo "<option value='{$h['id_habitat']}'>{$h['nom_habitat']}</option>";
                }
                ?>
            </select>
            <input type="text" name="edit_image" id="edit_image" placeholder="Image (URL)" class="w-full border rounded-lg p-2" required>
            <textarea name="edit_description" id="edit_description" placeholder="Description" class="w-full border rounded-lg p-2 h-14"></textarea>

            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="closeEditAnimalModal()" class="px-3 py-1 border rounded-lg">Annuler</button>
                <button type="submit" name="update" class="bg-green-700 hover:bg-green-800 text-white px-3 py-1 rounded-lg">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<script>
const addModal = document.getElementById("addModal");

function openAddModal() {
    addModal.classList.remove("hidden");
    addModal.classList.add("flex");
}

function closeAddModal() {
    addModal.classList.add("hidden");
    addModal.classList.remove("flex");
}
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
