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
        <br><br><br>
        <div class="flex justify-end mb-6">
            <button 
                type="button" 
                onclick="toggleModalCategory()" 
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                Add category
            </button>
        </div>
        <div class="flex justify-center mt-8">
    <?php if ($page > 1): ?>
        <a href="?action=tout-Category&page=<?= $page - 1 ?>" class="px-4 py-2 mx-1 bg-gray-300 rounded hover:bg-gray-400">Précédent</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?action=tout-Category&page=<?= $i ?>" class="px-4 py-2 mx-1 <?= $i == $page ? 'bg-blue-500 text-white' : 'bg-gray-300 hover:bg-gray-400' ?> rounded">
            <?= $i ?>
        </a>
    <?php endfor; ?>

    <?php if ($page < $totalPages): ?>
        <a href="?action=tout-Category&page=<?= $page + 1 ?>" class="px-4 py-2 mx-1 bg-gray-300 rounded hover:bg-gray-400">Suivant</a>
    <?php endif; ?>
</div>
      </nav>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php foreach ($categorys as $category): ?>
    <div class="relative overflow-hidden rounded-lg shadow-lg group h-50">
    <img 
    src="<?= $category->getImage() ?>" 
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
                <a href="?action=delet-category&category_id=<?= htmlspecialchars($category->getId()) ?>"
                   class="flex items-center gap-2 bg-red-600 text-white px-3 py-1.5 rounded hover:bg-red-700 transition duration-300">
                    <i class="fas fa-trash"></i>
                    <span>Delete</span>
                </a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>


<section id="addModalCategory" 
         class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-start justify-center pt-16">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-2xl mx-4">
        <!-- Modal Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-700">Add Category</h2>
            <button 
                type="button" 
                onclick="returnPage1()" 
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">
                Close
            </button>
        </div>

        <!-- Modal Form -->
        <form action="?action=save_category" method="POST" enctype="multipart/form-data">
            <!-- Name Field -->
            <div class="mb-6">
                <label for="categoryName" class="block text-gray-700 font-medium mb-2">
                    Name
                </label>
                <input 
                    type="text" 
                    name="name" 
                    id="categoryName" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-300"
                    placeholder="Jane Doe">
            </div>

            <!-- Description Field -->
            <div class="mb-6">
                <label for="categoryDescription" class="block text-gray-700 font-medium mb-2">
                    Description
                </label>
                <textarea 
                    name="description" 
                    id="categoryDescription" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-300"
                    rows="3" 
                    placeholder="Enter some long form content."></textarea>
            </div>

            <div class="mb-6">
                <label for="categoryImage" class="block text-gray-700 font-medium mb-2">
                    Upload Image
                </label>
                <input 
                    type="file" 
                    name="image" 
                    id="categoryImage" 
                    accept="image/*"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-300">
            </div>

            <div class="text-center">
                <button 
                    type="submit" 
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                    ADD
                </button>
            </div>
        </form>
    </div>
</section>


<script>
         function toggleModalCategory() {
    const modal = document.getElementById('addModalCategory');
    modal.classList.toggle('hidden');
}

function returnPage1() {
    const modal = document.getElementById('addModalCategory');
    modal.classList.add('hidden');
}
</script>


</body>
</html>