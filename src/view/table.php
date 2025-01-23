



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-800">

<section class="min-h-screen bg-gradient-to-b from-gray-900 to-gray-800 py-12">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
        <a href="?action=category" class="text-blue-400 hover:underline">return</a>
        <br><br><br>
            <h3 class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-600 mb-6" style="background-clip: text; -webkit-background-clip: text;">Cours de la catégorie</h3>
        </div>

        <?php if (isset($courses) && !empty($courses)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach($courses as $course): ?>
                    <div class="group bg-gray-800 rounded-xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="relative">
                            <img src="<?= $course->getImage() ?>" alt="product" class="w-full h-48 object-cover">
                            <div class="absolute top-4 right-4 bg-blue-500 text-white px-3 py-1 rounded-full text-sm">
                                Premium
                            </div>
                        </div>

                        <!-- Content Section -->
                        <div class="p-6">
                            <h5 class="text-xl font-bold text-white mb-3"><?= htmlspecialchars($course->getName()) ?></h5>

                            <!-- Category -->
                            <?php if ($course->getCategory()): ?>
                                <div class="mt-4">
                                    <span class="text-gray-400 text-sm">Category:</span>
                                    <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-full text-white text-center py-2 px-6 mt-2 w-max mx-auto transform transition-all duration-300 hover:opacity-90">
                                        <p class="text-sm font-medium"><?= htmlspecialchars($course->getCategory()->getName()) ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Action Button -->
                            <?php if ($_SESSION['user']->getRole()->getId() == 1 || $_SESSION['user']->getRole()->getId() == 2 || $_SESSION['user']->getRole()->getId() == 3): ?>
                                <div class="mt-6">
                                    <a href="?action=course_documment&id=<?= $course->getId() ?>" 
                                       class="block w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-3 rounded-lg text-center hover:opacity-90 transition-all duration-200">
                                        Détail
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-12 space-x-2">
                <?php if ($page > 1): ?>
                    <a href="?action=course&page=<?= $page - 1 ?>" 
                       class="px-4 py-2 rounded-lg bg-gray-800 text-gray-300 hover:bg-gray-700 transition-all duration-200">
                        Précédent
                    </a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?action=course&page=<?= $i ?>" 
                       class="px-4 py-2 rounded-lg transition-all duration-200 <?= $i == $page ? 'bg-blue-500 text-white' : 'bg-gray-800 text-gray-300 hover:bg-gray-700' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <a href="?action=course&page=<?= $page + 1 ?>" 
                       class="px-4 py-2 rounded-lg bg-gray-800 text-gray-300 hover:bg-gray-700 transition-all duration-200">
                        Suivant
                    </a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-12">
                <p class="text-gray-400 text-lg">Aucun cours trouvé pour votre recherche.</p>
            </div>
        <?php endif; ?>
    </div>
</section>



</body>
</html>