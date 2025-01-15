<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-800">

<div class="flex items-center justify-between mb-4 p-4 w-[100%]">
      <h1 class="text-3xl font-bold text-gray-500">Tout Les User</h1>
      <nav class="text-sm">
        <a href="?action=admin" class="text-blue-400 hover:underline">Home</a>
      </nav>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php foreach ($categorys as $category): ?>
    <div class="relative overflow-hidden rounded-lg shadow-lg group h-50">
        <img 
            src="./public/images/3.jpg" 
            alt="Category background" 
            class="absolute inset-0 w-full h-full object-cover"
        />
        <div class="absolute inset-0 bg-gradient-to-b from-black/50 to-black/80"></div>
        <div class="relative h-full p-6 flex flex-col justify-between z-10">
            <div>
                <h5 class="text-xl font-semibold mb-3">
                    <a href="course.html" class="text-white hover:text-blue-300 transition duration-300">
                        <?= htmlspecialchars($category->getName()) ?>
                    </a>
                </h5>
                <p class="text-gray-200 text-sm">
                    <?= htmlspecialchars($category->getDescription()) ?>
                </p>
            </div>
            
            <div class="flex justify-between mt-4">
                <a href="" 
                   class="flex items-center gap-2 bg-green-600 text-white px-3 py-1.5 rounded hover:bg-green-700 transition duration-300">
                    <i class="fas fa-edit"></i>
                    <span>Edit</span>
                </a>
            
                <a href="" 
                   class="flex items-center gap-2 bg-red-600 text-white px-3 py-1.5 rounded hover:bg-red-700 transition duration-300">
                    <i class="fas fa-trash"></i>
                    <span>Delete</span>
                </a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>


</body>
</html>