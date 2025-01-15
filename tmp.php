<?php 
require_once 'classes/categorie.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Dashboard Professeur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js" defer></script>
    <style>
        .hidden { display: none; }
        .active-tab { background-color: red; color: red; }
        body { background-color: blue; color: green; }
        .tab-button { background-color: yellow; color:rgb(217, 37, 202); }
        .tab-button:hover { background-color:rgb(42, 112, 211); }
    </style>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

<div class="container mx-auto mt-10">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="flex justify-around bg-gray-800 text-white p-4">
            <button class="tab-button active-tab px-4 py-2 rounded-lg" onclick="showTab('mesCours')">Mes cours</button>
            <button class="tab-button px-4 py-2 rounded-lg" onclick="showTab('mesEtudiants')">Mes étudiants</button>
            <button class="tab-button px-4 py-2 rounded-lg" onclick="showTab('statistiques')">Statistiques</button>
        </div>

        <div id="mesCours" class="tab-content p-6">
            <h2 class="text-xl font-bold mb-4">Liste de mes cours</h2>
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2">Cours</th>
                        <th class="border border-gray-300 px-4 py-2">Description</th>
                        <th class="border border-gray-300 px-4 py-2">Durée</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Remplir dynamiquement avec PHP -->
                    <?php
                    // Exemple de données - Remplacez avec une requête réelle à la base de données
                    $cours = [
                        ['nom' => 'Mathématiques', 'description' => 'Cours de base en mathématiques', 'duree' => '3 mois'],
                        ['nom' => 'Physique', 'description' => 'Introduction à la physique', 'duree' => '2 mois']
                    ];
                    foreach ($cours as $c) {
                        echo "<tr>
                                <td class='border border-gray-300 px-4 py-2'>{$c['nom']}</td>
                                <td class='border border-gray-300 px-4 py-2'>{$c['description']}</td>
                                <td class='border border-gray-300 px-4 py-2'>{$c['duree']}</td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div id="mesEtudiants" class="tab-content hidden p-6">
            <h2 class="text-xl font-bold mb-4">Liste de mes étudiants</h2>
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2">Nom</th>
                        <th class="border border-gray-300 px-4 py-2">Email</th>
                        <th class="border border-gray-300 px-4 py-2">Classe</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Remplir dynamiquement avec PHP -->
                    <?php
                    // Exemple de données - Remplacez avec une requête réelle à la base de données
                    $etudiants = [
                        ['nom' => 'Jean Dupont', 'email' => 'jean.dupont@example.com', 'classe' => '3e année'],
                        ['nom' => 'Marie Curie', 'email' => 'marie.curie@example.com', 'classe' => '2e année']
                    ];
                    foreach ($etudiants as $e) {
                        echo "<tr>
                                <td class='border border-gray-300 px-4 py-2'>{$e['nom']}</td>
                                <td class='border border-gray-300 px-4 py-2'>{$e['email']}</td>
                                <td class='border border-gray-300 px-4 py-2'>{$e['classe']}</td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div id="statistiques" class="tab-content hidden p-6">
            <h2 class="text-xl font-bold mb-4">Statistiques</h2>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-200 p-4 rounded-lg shadow">
                    <h3 class="text-lg font-bold">Nombre total de cours</h3>
                    <p class="text-2xl font-semibold">5</p>
                </div>
                <div class="bg-gray-200 p-4 rounded-lg shadow">
                    <h3 class="text-lg font-bold">Nombre total d'étudiants</h3>
                    <p class="text-2xl font-semibold">20</p>
                </div>
                <div class="bg-gray-200 p-4 rounded-lg shadow">
                    <h3 class="text-lg font-bold">Taux de réussite moyen</h3>
                    <p class="text-2xl font-semibold">85%</p>
                </div>
                <div class="bg-gray-200 p-4 rounded-lg shadow">
                    <h3 class="text-lg font-bold">Cours les plus populaires</h3>
                    <p class="text-2xl font-semibold">Mathématiques</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showTab(tabId) {
        // Masquer toutes les sections
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });

        // Afficher la section sélectionnée
        document.getElementById(tabId).classList.remove('hidden');

        // Mettre à jour les boutons d'onglet
        document.querySelectorAll('.tab-button').forEach(button => {
            button.classList.remove('active-tab');
        });
        event.target.classList.add('active-tab');
    }
</script>

</body>
</html>