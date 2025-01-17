<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen p-8">
    <main class="max-w-4xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-start gap-8">
            <div class="flex-1">
                <h1 class="text-5xl font-bold mb-6">
                <?= htmlspecialchars($course->getName()) ?>
                </h1>
                
                <div class="prose prose-invert">
                    <p class="text-gray-300 mb-6">
                    <?= htmlspecialchars($course->getDescription()) ?>
                    </p>
                </div>

                <!-- Categories -->
                <div class="mb-6">
                    <h2 class="text-xl font-semibold mb-3">Catégorie</h2>
                    <span class="px-3 py-1 bg-blue-600 rounded-full text-sm">
                    
                    </span>
                </div>

                <!-- Tags -->
                <div class="mb-6">
                    <h2 class="text-xl font-semibold mb-3">Technologies</h2>
                    <div class="flex flex-wrap gap-2">
                    <?php foreach ($course->getCourseTags() as $tag): ?>
    <span class="px-3 py-1 bg-gray-700 rounded-full text-sm">
        <?= htmlspecialchars($tag) ?>
    </span>
<?php endforeach; ?>
                    </div>
                </div>

                <!-- Social Links -->
                <div class="space-y-2">
                    <a href="#" class="flex items-center gap-2 text-gray-300 hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                        </svg>
                        Follow on Twitter
                    </a>
                    <a href="#" class="flex items-center gap-2 text-gray-300 hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                        </svg>
                        Follow on GitHub
                    </a>
                </div>
            </div>

            <!-- Profile Image -->
            <div class="w-full md:w-96">
                <div class="rounded-lg overflow-hidden">
                    <img 
                        src="<?= htmlspecialchars($course->getImage()) ?>" 
                        alt="Profile" 
                        class="w-full h-auto object-cover"
                    >
                </div>
            </div>
        </div>

        <!-- Section du Fichier Vidéo / Document -->
        <div class="mt-12">
    <h2 class="text-2xl font-bold mb-6">Fichier du Cours</h2>
    <div class="bg-gray-800 rounded-lg p-6">
        <?php  
            $filePath = htmlspecialchars($course->getFile());  
            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);  

            if ($fileExtension === 'mp4'):  
        ?>
            <video controls class="rounded-lg w-full max-w-lg mx-auto h-auto">
                <source src="<?= $filePath ?>" type="video/mp4">
                Votre navigateur ne supporte pas la lecture de cette vidéo.
            </video>
        <?php else: ?>
            <!-- Lien de Téléchargement -->
            <p class="text-gray-300 mb-4">Cliquez ci-dessous pour télécharger le fichier :</p>
            <a href="<?= $filePath ?>" download class="inline-block bg-blue-600 text-white px-4 py-2 rounded">
                Télécharger
            </a>
        <?php endif; ?>
    </div>
</div>

    </main>
</body>
</html>
