<?php 
require_once '../autoload.php';
Session::ActiverSession();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Gestion de Contenu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>
<body class="bg-[#FFFBE6]">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 min-h-screen bg-white shadow-lg">
            <div class="p-4">
                <h2 class="text-xl font-bold text-gray-800">Admin Dashboard</h2>
            </div>
            <nav class="mt-4">
                <a href="#stats" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Statistiques</a>
                <a href="#content" class="block px-4 py-2 text-gray-700 bg-[#B6FFA1]">Gestion Contenu</a>
                <a href="#teachers" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Professeurs</a>
                <a href="#students" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Étudiants</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <!-- Buttons Section -->
            <div class="mb-6 flex flex-wrap gap-4">
                <button onclick="showTable('coursTable')" class="bg-[#B6FFA1] px-6 py-3 rounded-lg hover:bg-opacity-80 transition-all">
                    Cours
                </button>
                <button onclick="showTable('categorieTable')" class="bg-[#B6FFA1] px-6 py-3 rounded-lg hover:bg-opacity-80 transition-all">
                    Catégories
                </button>
                <button onclick="showTable('tagTable')" class="bg-[#B6FFA1] px-6 py-3 rounded-lg hover:bg-opacity-80 transition-all">
                    Tags
                </button>
            </div>

            <!-- Cours Table -->
            <div id="coursTable" class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="font-bold text-gray-700 mb-4">Liste des Cours en Attente</h3>
                <div class="overflow-x-auto">
                    <table id="cours" class="w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-3 px-4">Titre</th>
                                <th class="text-left py-3 px-4">Professeur</th>
                                <th class="text-left py-3 px-4">Catégorie</th>
                                <th class="text-left py-3 px-4">status</th>
                                <th class="text-left py-3 px-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                  $coures= cours::getAllCours();
                                  foreach( $coures as $cours){
                            ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-4"><?=$cours->titre?></td>
                                <td class="py-3 px-4"><?=$cours->prof->nom?></td>
                                <td class="py-3 px-4"><?=$cours->categorie->getcategorie()?></td>
                                <td class="py-3 px-4"><?=$cours->status?></td>
                                <td class="py-3 px-4">
                                    <div class="flex"> <form action="../traitement/traitementAdmin.php" method="post">
                                    <input type="hidden" name="idcours" value="<?= $cours->idcours ?>">
                                    <input type="hidden" name="titre" value="<?= $cours->titre?>">
                                    <input type="hidden" name="description" value="<?= $cours->description?>">
                                    <input type="hidden" name="titre" value="<?= $cours->titre?>">
                                    <input type="hidden" name="image" value="<?= $cours->image?>">
                                    <button name="accepterCours" class="bg-green-500 text-white px-3 py-1 rounded mr-2 hover:bg-green-600">
                                        Accepter
                                    </button>
                                </form>
                                <form action="../traitement/traitementAdmin.php" method="post">
                                    <input type="hidden" name="idcours" value="<?= $cours->idcours ?>">
                                    <input type="hidden" name="titre" value="<?= $cours->titre?>">
                                    <input type="hidden" name="description" value="<?= $cours->description?>">
                                    <input type="hidden" name="titre" value="<?= $cours->titre?>">
                                    <input type="hidden" name="image" value="<?= $cours->image?>">
                                    <button name="RefuserCours" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                        Refuser
                                    </button>
                                </form></div>
                               
                                    
                                </td>
                            </tr>
                            <?php 
                              }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Catégories Table -->
            <div id="categorieTable" class="bg-white rounded-lg shadow-md p-6 mb-6 hidden">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-gray-700">Liste des Catégories</h3>
                    <button onclick="showModal('categorieModal')" class="bg-[#B6FFA1] px-4 py-2 rounded-lg hover:bg-opacity-80">
                        + Nouvelle Catégorie
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table id="categorie" class="w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-3 px-4">Nom</th>
                                <th class="text-left py-3 px-4">Nombre de cours</th>
                                <th class="text-left py-3 px-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-4">Programmation</td>
                                <td class="py-3 px-4">25</td>
                                <td class="py-3 px-4">
                                    <button class="text-blue-500 hover:text-blue-700 mr-3">Modifier</button>
                                    <button class="text-red-500 hover:text-red-700">Supprimer</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tags Table -->
            <div id="tagTable" class="bg-white rounded-lg shadow-md p-6 mb-6 hidden">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-gray-700">Liste des Tags</h3>
                    <button onclick="showModal('tagModal')" class="bg-[#B6FFA1] px-4 py-2 rounded-lg hover:bg-opacity-80">
                        + Nouveau Tag
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table id="tag" class="w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-3 px-4">Nom</th>
                                <th class="text-left py-3 px-4">Utilisation</th>
                                <th class="text-left py-3 px-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-4">JavaScript</td>
                                <td class="py-3 px-4">15 cours</td>
                                <td class="py-3 px-4">
                                    <button class="text-blue-500 hover:text-blue-700 mr-3">Modifier</button>
                                    <button class="text-red-500 hover:text-red-700">Supprimer</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Catégorie -->
    <div id="categorieModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg w-full max-w-md mx-4">
            <div class="border-b p-4 flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-800">Nouvelle Catégorie</h3>
                <button onclick="closeModal('categorieModal')" class="text-gray-600 hover:text-gray-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nom de la catégorie</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#B6FFA1]">
                </div>
                <button type="submit" class="w-full bg-[#B6FFA1] px-4 py-2 rounded-lg hover:bg-opacity-80">
                    Ajouter
                </button>
            </form>
        </div>
    </div>

    <!-- Modal Tag -->
    <div id="tagModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg w-full max-w-md mx-4">
            <div class="border-b p-4 flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-800">Nouveau Tag</h3>
                <button onclick="closeModal('tagModal')" class="text-gray-600 hover:text-gray-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nom du tag</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#B6FFA1]">
                </div>
                <button type="submit" class="w-full bg-[#B6FFA1] px-4 py-2 rounded-lg hover:bg-opacity-80">
                    Ajouter
                </button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- JS DataTables -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        function showTable(tableId) {
            // Hide all tables
            ['coursTable', 'categorieTable', 'tagTable'].forEach(id => {
                document.getElementById(id).classList.add('hidden');
            });
            // Show selected table
            document.getElementById(tableId).classList.remove('hidden');
        }

        function showModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
        $(document).ready(function () {
    $('#cours').DataTable({
      language: {
        url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json" // Traduction française
      }
    });
  });

  $(document).ready(function () {
    $('#tag').DataTable({
      language: {
        url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json" // Traduction française
      }
    });
  });

  $(document).ready(function () {
    $('#categorie').DataTable({
      language: {
        url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json" // Traduction française
      }
    });
  });
    </script>


</body>
</html>

<?php
if (isset($_SESSION['success'])) {
    $Message = $_SESSION['success'];
    echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'success',
                text: '$Message',
                confirmButtonText: 'OK',
                timer: 5000
            });
        </script>
    ";
    unset($_SESSION['success']); 
}