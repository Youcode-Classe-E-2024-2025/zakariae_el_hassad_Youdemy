<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen p-8">
<a href="?action=course" class="text-blue-400 hover:underline">return</a>
<br><br><br>
    <main class="max-w-4xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-start gap-8">
            <div class="flex-1">
                <h1 class="text-5xl font-bold mb-6">
                <?= htmlspecialchars($course->getName()) ?>
                </h1>
                
                <div class="prose prose-invert">
                <h2 class="text-xl font-semibold mb-3">Description</h2>
                    <p class="text-gray-300 mb-6">
                    <?= htmlspecialchars($course->getDescription()) ?>
                    </p>
                </div>
                <!-- Tags -->
                <div class="mb-6">
                    <h2 class="text-xl font-semibold mb-3">Tag</h2>
                    <div class="flex flex-wrap gap-2">
                    <?php foreach ($course->getCourseTags() as $tag): ?>
    <span class="px-3 py-1 bg-gray-700 rounded-full text-sm">
        <?= htmlspecialchars($tag) ?>
    </span>
<?php endforeach; ?>
                    </div>
                </div>

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
