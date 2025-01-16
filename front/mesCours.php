<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Liste des Cours</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
</head>

<body class="bg-[#FFFBE6]">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 min-h-screen bg-white shadow-lg">
            <div class="p-4">
                <h2 class="text-xl font-bold text-gray-800">Dashboard Professeur</h2>
            </div>
            <nav class="mt-4">
                <a href="#dashboard" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Tableau de bord</a>
                <a href="#courses" class="block px-4 py-2 text-gray-700 bg-[#B6FFA1]">Mes cours</a>
                <a href="#students" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Mes étudiants</a>
                <a href="#earnings" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Mes gains</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
        
            <div class="bg-white rounded-lg shadow-md p-6">
            <select onchange="afficherChamps()" id="typeCours" name="typeCours"   class="w-full px-3 py-2 m-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#B6FFA1] focus:border-transparent">
                            <option value="">Choisir type de cours a affichee.</option>
                    <option value="vedio"> avec vedio</option>
                    <option value="document">avec documentation</option>
                        </select>
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Liste des Cours</h2>
                    <button id="bteAjoutCours" class="bg-[#B6FFA1] px-4 py-2 rounded-lg hover:bg-opacity-80">
                        Nouveau cours
                    </button>
                </div>

                <table id="videoCoursesTable"  class="session w-full">
                    <caption  class="text-2xl font-bold text-gray-800 p-2"> Vedio Cours</caption>
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-4 py-3 text-left">Image</th>
                            <th class="px-4 py-3 text-left">Titre</th>
                            <th class="px-4 py-3 text-left">Catégorie</th>
                            <th class="px-4 py-3 text-left">Type</th>
                            <th class="px-4 py-3 text-left">Étudiants</th>
                            <th class="px-4 py-3 text-left">Date</th>
                            <th class="px-4 py-3 text-left">Statut</th>
                            <th class="px-4 py-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample data - Replace with PHP loop -->
                         <?php
                             require_once '../traitement/traitementProf.php';
                           foreach($coursVedio as $cours){
                            ?>
                           
                        <tr class="border-b">
                            <td class="px-4 py-3">
                                <img src="<?=$cours->image?>" alt="Course" class="rounded-lg w-10 h-10 object-cover">
                            </td>
                            
                            <td class="px-4 py-3"><?= $cours->titre?></td>
                            <td class="px-4 py-3"><?= $cours->categorie->getCategorie()?></td>
                            <td class="px-4 py-3">Vidéo</td>
                            <td class="px-4 py-3">32</td>
                            <td class="px-4 py-3">2024-01-15</td>
                            <td class="px-4 py-3">
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Actif</span>
                            </td>
                            <td class="px-4 py-3">
                                <button class="text-blue-500 hover:text-blue-700 mr-2">Éditer</button>
                                <button class="text-red-500 hover:text-red-700">Supprimer</button>
                            </td>
                        </tr>
                        <?php 
                           }
                            ?>
                    </tbody>
                </table>


                <table id="documentCoursesTable" class="session w-full hidden ">
                    <caption  class="text-2xl font-bold text-gray-800 p-2"> cours Document</caption>
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-4 py-3 text-left">Image</th>
                            <th class="px-4 py-3 text-left">Titre</th>
                            <th class="px-4 py-3 text-left">Catégorie</th>
                            <th class="px-4 py-3 text-left">Type</th>
                            <th class="px-4 py-3 text-left">Étudiants</th>
                            <th class="px-4 py-3 text-left">Date</th>
                            <th class="px-4 py-3 text-left">Statut</th>
                            <th class="px-4 py-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample data - Replace with PHP loop -->
                        <?php
                             require_once '../traitement/traitementProf.php';
                             foreach($coursDocument as $cours){
                            ?>
                        <tr class="border-b">
                            <td class="px-4 py-3">
                                <img src="<?=$cours->image?>" alt="Course" class="rounded-lg w-10 h-10 object-cover">
                            </td>
                           
                            <td class="px-4 py-3"><?= $cours->titre?></td>
                            <td class="px-4 py-3"><?= $cours->categorie->getCategorie()?></td>
                            <td class="px-4 py-3">Vidéo</td>
                            <td class="px-4 py-3">32</td>
                            <td class="px-4 py-3">2024-01-15</td>
                            <td class="px-4 py-3">
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Actif</span>
                            </td>
                            <td class="px-4 py-3">
                                <button class="text-blue-500 hover:text-blue-700 mr-2">Éditer</button>
                                <button class="text-red-500 hover:text-red-700">Supprimer</button>
                            </td>
                        </tr>
                        <?php 
                           }
                            ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script>
         function afficherChamps() {
        const typeCours = document.getElementById("typeCours").value;
        const videoTable = document.getElementById("videoCoursesTable");
        const documentTable = document.getElementById("documentCoursesTable");

        if (typeCours === "vedio") {
            videoTable.classList.remove("hidden");
            documentTable.classList.add("hidden");
        } else if (typeCours === "document") {
            documentTable.classList.remove("hidden");
            videoTable.classList.add("hidden");
        } else {
            videoTable.classList.remove("hidden");
            documentTable.classList.add("hidden");
        }
    }
   
        // $(document).ready(function() {
        //     $('#videoCoursesTable').DataTable({
        //         language: {
        //             url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json'
        //         },
        //         pageLength: 10,
        //         responsive: true,
        //         dom: '<"flex justify-between items-center mb-4"lf>rt<"flex justify-between items-center mt-4"ip>',
        //         initComplete: function() {
        //             // Custom styling for DataTables elements
        //             $('.dataTables_length select').addClass('border rounded px-2 py-1');
        //             $('.dataTables_filter input').addClass('border rounded px-2 py-1 ml-2');
        //             $('.paginate_button').addClass('px-3 py-1 mx-1 rounded hover:bg-[#B6FFA1]');
        //         }
        //     });

        // });
    </script>
</body>
</html>