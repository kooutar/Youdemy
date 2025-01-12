<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
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
                <a href="#courses" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Cours</a>
                <a href="#teachers" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Professeurs</a>
                <a href="#students" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Étudiants</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <!-- Statistics Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="font-bold text-gray-700 mb-2">Total Cours</h3>
                    <p class="text-3xl font-bold text-gray-800">156</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="font-bold text-gray-700 mb-2">Total Étudiants</h3>
                    <p class="text-3xl font-bold text-gray-800">2,450</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="font-bold text-gray-700 mb-2">Total Professeurs</h3>
                    <p class="text-3xl font-bold text-gray-800">48</p>
                </div>
            </div>

            <!-- Chart -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                <h3 class="font-bold text-gray-700 mb-4">Inscriptions mensuelles</h3>
                <canvas id="enrollmentChart" height="100"></canvas>
            </div>

            <!-- Courses Table -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-gray-700">Liste des Cours</h3>
                    <button class="bg-[#B6FFA1] px-4 py-2 rounded-lg">Ajouter un cours</button>
                </div>
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-2">Titre</th>
                            <th class="text-left py-2">Professeur</th>
                            <th class="text-left py-2">Étudiants</th>
                            <th class="text-left py-2">Prix</th>
                            <th class="text-left py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td class="py-2">JavaScript Avancé</td>
                            <td>Jean Dupont</td>
                            <td>45</td>
                            <td>49.99€</td>
                            <td>
                                <button class="text-blue-500">Éditer</button>
                                <button class="text-red-500 ml-2">Supprimer</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script>
        // Chart initialization
        const ctx = document.getElementById('enrollmentChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
                datasets: [{
                    label: 'Inscriptions',
                    data: [65, 78, 90, 85, 95, 110],
                    borderColor: '#B6FFA1',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
</body>
</html>