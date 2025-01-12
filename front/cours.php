<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Cours</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen ">
<nav class="bg-[#B6FFA1] shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-bold">EduLearn</span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="hover:text-gray-600">Accueil</a>
                    <a href="#" class="hover:text-gray-600">Cours</a>
                    <a href="#" class="hover:text-gray-600">Catégories</a>
                    <a href="#" class="hover:text-gray-600">Enseignants</a>
                </div>

                <div class="flex items-center space-x-4">
                    <button class="px-4 py-2 rounded-lg bg-white hover:bg-gray-100">
                        <a href="front/connexion.php"></a>Connexion
                    </button>
                    <button class="px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700">
                       <a href="front/registre.php">Inscription</a> 
                    </button>
                </div>
            </div>
        </div>
    </nav>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8 text-gray-800">Nos Cours</h1>
        
        <!-- Barre de recherche et filtres -->
        <div class="flex flex-col md:flex-row gap-4 mb-8">
            <div class="relative flex-1">
                <input
                    type="text"
                    placeholder="Rechercher un cours..."
                    class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#B6FFA1] focus:border-transparent"
                >
                <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            
            <select class="p-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#B6FFA1] focus:border-transparent">
                <option value="all">Toutes les catégories</option>
                <option value="programmation">Programmation</option>
                <option value="marketing">Marketing</option>
                <option value="design">Design</option>
            </select>
        </div>

        <!-- Grille de cours -->
        <div class="grid md:grid-cols-3 gap-8">
                <!-- Course Card 1 -->
                <div class="bg-[#FFFBE6] rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <img src="../images/courses-image1.jpg" alt="course" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <span class="px-3 py-1 bg-[#B6FFA1] rounded-full text-sm">Développement</span>
                        <h3 class="text-xl font-bold mt-4">Introduction au développement web</h3>
                        <p class="text-gray-600 mt-2">Apprenez les bases du développement web moderne</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="font-bold">49.99 €</span>
                            <button class="px-4 py-2 bg-[#B6FFA1] rounded-lg hover:bg-green-200">
                                En savoir plus
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Course Card 2 -->
                <div class="bg-[#FFFBE6] rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <img src="../images/courses-image2.jpg" alt="course" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <span class="px-3 py-1 bg-[#B6FFA1] rounded-full text-sm">Design</span>
                        <h3 class="text-xl font-bold mt-4">Design UX/UI Avancé</h3>
                        <p class="text-gray-600 mt-2">Maîtrisez les principes du design moderne</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="font-bold">59.99 €</span>
                            <button class="px-4 py-2 bg-[#B6FFA1] rounded-lg hover:bg-green-200">
                                En savoir plus
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Course Card 3 -->
                <div class="bg-[#FFFBE6] rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <img src="../images/courses-image3.jpg" alt="course" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <span class="px-3 py-1 bg-[#B6FFA1] rounded-full text-sm">Marketing</span>
                        <h3 class="text-xl font-bold mt-4">Marketing Digital</h3>
                        <p class="text-gray-600 mt-2">Stratégies de marketing pour 2024</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="font-bold">39.99 €</span>
                            <button class="px-4 py-2 bg-[#B6FFA1] rounded-lg hover:bg-green-200">
                                En savoir plus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <footer class="bg-gray-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">EduLearn</h3>
                    <p class="text-gray-400">La plateforme d'apprentissage qui vous accompagne vers la réussite.</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Liens rapides</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">À propos</a></li>
                        <li><a href="#" class="hover:text-white">Cours</a></li>
                        <li><a href="#" class="hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Support</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">FAQ</a></li>
                        <li><a href="#" class="hover:text-white">Aide</a></li>
                        <li><a href="#" class="hover:text-white">Politique de confidentialité</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Contact</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>Email: contact@edulearn.com</li>
                        <li>Tél: +33 1 23 45 67 89</li>
                        <li>Adresse: Paris, France</li>
                    </ul>
                </div>
            </div>
            <div class="mt-12 pt-8 border-t border-gray-700 text-center text-gray-400">
                <p>&copy; 2024 EduLearn. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
    <script>
        // Script pour la recherche et le filtrage
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('input[type="text"]');
            const categorySelect = document.querySelector('select');
            const courseCards = document.querySelectorAll('.grid > div');

            function filterCourses() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedCategory = categorySelect.value;

                courseCards.forEach(card => {
                    const title = card.querySelector('h3').textContent.toLowerCase();
                    const category = card.getAttribute('data-category') || 'all';
                    
                    const matchesSearch = title.includes(searchTerm);
                    const matchesCategory = selectedCategory === 'all' || category === selectedCategory;

                    card.style.display = matchesSearch && matchesCategory ? 'block' : 'none';
                });
            }

            searchInput.addEventListener('input', filterCourses);
            categorySelect.addEventListener('change', filterCourses);
        });
    </script>
</body>
</html>