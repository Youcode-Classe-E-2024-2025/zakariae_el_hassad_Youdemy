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
                onclick="toggleModalTag()" 
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                Add Tag
            </button>
        </div>
      </nav>
    </div>

    <div class="tags-container flex flex-wrap gap-4">
    <?php foreach ($tags as $tag): ?>
        <div class="border border-white rounded-xl text-white text-center p-2 w-50">
            <p> <?= htmlspecialchars($tag->getName()) ?></p>
            <div class="flex justify-between mt-4">
                <a href="" 
                   class="flex items-center gap-2 bg-green-600 text-white px-3 py-1.5 rounded hover:bg-green-700 transition duration-300">
                    <i class="fas fa-edit"></i>
                    <span>Edit</span>
                </a>
            
                <a href="?action=delete_tag&tag_id=<?= htmlspecialchars($tag->getId()) ?>"
                   class="flex items-center gap-2 bg-red-600 text-white px-3 py-1.5 rounded hover:bg-red-700 transition duration-300">
                    <i class="fas fa-trash"></i>
                    <span>Delete</span>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>


<section id="addModalTag" 
         class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-start justify-center pt-16">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-2xl mx-4">
        <!-- Modal Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-700">Add Category</h2>
            <button 
                type="button" 
                onclick="returnPageTag()" 
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">
                Close
            </button>
        </div>

        <!-- Modal Form -->
        <form action="?action=save_tag" method="POST">
            <!-- Name Field -->
            <div class="mb-6">
                <label 
                    for="categoryName" 
                    class="block text-gray-700 font-medium mb-2">
                    Name
                </label>
                <input 
                    type="text" 
                    name="name" 
                    id="categoryName" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-300"
                    placeholder="Jane Doe">
            </div>
            <!-- Submit Button -->
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
        function toggleModalTag() {
    const modal = document.getElementById('addModalTag');
    modal.classList.toggle('hidden');
}

function returnPageTag() {
    const modal = document.getElementById('addModalTag');
    modal.classList.add('hidden');
}
    </script>


</body>
</html>