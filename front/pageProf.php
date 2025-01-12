<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Dashboard Professeur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
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
                <a href="#courses" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Mes cours</a>
                <a href="#students" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Mes étudiants</a>
                <a href="#earnings" class="block px-4 py-2 text-gray-700 hover:bg-[#B6FFA1]">Mes gains</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="font-bold text-gray-700 mb-2">Mes Cours</h3>
                    <p class="text-3xl font-bold text-gray-800">12</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="font-bold text-gray-700 mb-2">Total Étudiants</h3>
                    <p class="text-3xl font-bold text-gray-800">245</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="font-bold text-gray-700 mb-2">Gains ce mois</h3>
                    <p class="text-3xl font-bold text-gray-800">1,250€</p>
                </div>
            </div>

            <!-- My Courses -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-gray-700">Mes Cours</h3>
                    <button class="bg-[#B6FFA1] px-4 py-2 rounded-lg">Nouveau cours</button>
                </div>
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-2">Titre</th>
                            <th class="text-left py-2">Étudiants</th>
                            <th class="text-left py-2">Revenus</th>
                            <th class="text-left py-2">Statut</th>
                            <th class="text-left py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td class="py-2">Python pour débutants</td>
                            <td>32</td>
                            <td>850€</td>
                            <td><span class="bg-green-100 text-green-800 px-2 py-1 rounded">Actif</span></td>
                            <td>
                                <button class="text-blue-500">Éditer</button>
                                <button class="text-red-500 ml-2">Archiver</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Students List -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="font-bold text-gray-700 mb-4">Derniers étudiants inscrits</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between border-b pb-2">
                        <div class="flex items-center">
                            <img src="/api/placeholder/40/40" class="rounded-full" alt="Student">
                            <div class="ml-4">
                                <p class="font-semibold">Marie Lambert</p>
                                <p class="text-sm text-gray-600">Python pour débutants</p>
                            </div>
                        </div>
                        <button class="text-blue-500">Contacter</button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>