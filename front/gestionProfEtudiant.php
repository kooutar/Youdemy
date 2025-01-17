<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Gestion des Utilisateurs</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
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
                <a href="#content" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Gestion Contenu</a>
                <a href="#users" class="block px-4 py-2 text-gray-700 bg-[#B6FFA1]">Gestion Utilisateurs</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <!-- Buttons Section -->
            <div class="mb-6 flex flex-wrap gap-4">
                <button onclick="showTable('professeursTable')" class="bg-[#B6FFA1] px-6 py-3 rounded-lg hover:bg-opacity-80 transition-all">
                    Professeurs
                </button>
                <button onclick="showTable('etudiantsTable')" class="bg-[#B6FFA1] px-6 py-3 rounded-lg hover:bg-opacity-80 transition-all">
                    Étudiants
                </button>
            </div>

            <!-- Professeurs Table Section -->
            <div id="professeursTable" class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="font-bold text-gray-700 mb-4">Liste des Professeurs</h3>
                <table id="tableProfesseurs" class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="p-3 text-left">Photo</th>
                            <th class="p-3 text-left">Nom</th>
                            <th class="p-3 text-left">Email</th>
                            <th class="p-3 text-left">Spécialité</th>
                            <th class="p-3 text-left">Statut</th>
                            <th class="p-3 text-left">Date d'inscription</th>
                            <th class="p-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3">
                                <img src="/api/placeholder/40/40" class="w-10 h-10 rounded-full" alt="Prof">
                            </td>
                            <td class="p-3">Jean Dupont</td>
                            <td class="p-3">jean.dupont@email.com</td>
                            <td class="p-3">Développement Web</td>
                            <td class="p-3">
                                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">En attente</span>
                            </td>
                            <td class="p-3">2024-01-17</td>
                            <td class="p-3">
                                <button class="bg-green-500 text-white px-3 py-1 rounded mr-2 hover:bg-green-600">
                                    Accepter
                                </button>
                                <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    Refuser
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Étudiants Table Section -->
            <div id="etudiantsTable" class="bg-white rounded-lg shadow-md p-6 mb-6 hidden">
                <h3 class="font-bold text-gray-700 mb-4">Liste des Étudiants</h3>
                <table id="tableEtudiants" class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="p-3 text-left">Photo</th>
                            <th class="p-3 text-left">Nom</th>
                            <th class="p-3 text-left">Email</th>
                            <th class="p-3 text-left">Cours suivis</th>
                            <th class="p-3 text-left">Statut</th>
                            <th class="p-3 text-left">Date d'inscription</th>
                            <th class="p-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3">
                                <img src="/api/placeholder/40/40" class="w-10 h-10 rounded-full" alt="Student">
                            </td>
                            <td class="p-3">Marie Martin</td>
                            <td class="p-3">marie.martin@email.com</td>
                            <td class="p-3">3</td>
                            <td class="p-3">
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Actif</span>
                            </td>
                            <td class="p-3">2024-01-15</td>
                            <td class="p-3">
                                <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600" onclick="toggleBanUser(this)">
                                    Bannir
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script>
        $(document).ready(function() {
            // Initialisation des DataTables
            $('#tableProfesseurs').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json'
                },
                responsive: true,
                dom: '<"flex flex-col md:flex-row justify-between items-center mb-4"lf>rtip',
                initComplete: function() {
                    $('.dataTables_length select').addClass('border rounded px-2 py-1');
                    $('.dataTables_filter input').addClass('border rounded px-2 py-1 ml-2');
                }
            });

            $('#tableEtudiants').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json'
                },
                responsive: true,
                dom: '<"flex flex-col md:flex-row justify-between items-center mb-4"lf>rtip',
                initComplete: function() {
                    $('.dataTables_length select').addClass('border rounded px-2 py-1');
                    $('.dataTables_filter input').addClass('border rounded px-2 py-1 ml-2');
                }
            });
        });

        function showTable(tableId) {
            // Cacher toutes les tables
            ['professeursTable', 'etudiantsTable'].forEach(id => {
                document.getElementById(id).classList.add('hidden');
            });
            // Afficher la table sélectionnée
            document.getElementById(tableId).classList.remove('hidden');
        }

        function toggleBanUser(button) {
            const isBanned = button.textContent.trim() === 'Bannir';
            button.textContent = isBanned ? 'Débannir' : 'Bannir';
            button.classList.toggle('bg-red-500');
            button.classList.toggle('bg-green-500');
        }
    </script>
</body>
</html>