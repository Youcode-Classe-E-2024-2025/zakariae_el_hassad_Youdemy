<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen w-full overflow-hidden relative">
    <canvas id="c" class="absolute top-0 left-0 w-full h-full -z-10"></canvas>
    
    <div class="w-full max-w-sm rounded-lg p-6 text-center bg-white/10 border border-white/50 backdrop-blur-lg z-10">
        <form action="?action=register-submit" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()" class="flex flex-col">
            <h2 class="text-3xl mb-4 text-white">Login</h2>
            
            <div class="relative border-b-2 border-gray-300 my-3">
                <input type="name" name="name" id="name" required class="w-full h-8 bg-transparent border-none outline-none text-sm text-white peer">
                <label for="name" class="absolute top-1/2 left-0 -translate-y-1/2 text-white text-sm pointer-events-none transition-all peer-focus:-translate-y-full peer-focus:text-xs peer-valid:-translate-y-full peer-valid:text-xs">Enter your name</label>
            </div>
            
            <div class="relative border-b-2 border-gray-300 my-3">
                <input type="email" name="email" id="email" required class="w-full h-8 bg-transparent border-none outline-none text-sm text-white peer">
                <label for="email" class="absolute top-1/2 left-0 -translate-y-1/2 text-white text-sm pointer-events-none transition-all peer-focus:-translate-y-full peer-focus:text-xs peer-valid:-translate-y-full peer-valid:text-xs">Enter your email</label>
            </div>
            
            <div class="relative border-b-2 border-gray-300 my-3">
                <input type="password" name="password" id="password" required class="w-full h-8 bg-transparent border-none outline-none text-sm text-white peer">
                <label for="password" class="absolute top-1/2 left-0 -translate-y-1/2 text-white text-sm pointer-events-none transition-all peer-focus:-translate-y-full peer-focus:text-xs peer-valid:-translate-y-full peer-valid:text-xs">Enter your password</label>
            </div>
            
            <div class="relative border-b-2 border-gray-300 my-3">
                <input type="password" name="confirm_password" id="confirm_password" required class="w-full h-8 bg-transparent border-none outline-none text-sm text-white peer">
                <label for="password" class="absolute top-1/2 left-0 -translate-y-1/2 text-white text-sm pointer-events-none transition-all peer-focus:-translate-y-full peer-focus:text-xs peer-valid:-translate-y-full peer-valid:text-xs">Enter your password</label>
            </div>
            
            <div class="mb-4">
                <label for="userImage" class="block text-white text-sm mb-1">Upload Image</label>
                <input type="file" name="image" id="userImage" accept="image/*" class="w-full text-white text-sm px-3 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-300">
            </div>
            
            <div class="mb-4">
                <label for="role_id" class="block text-white text-sm mb-1">Category</label>
                <select name="role_id" id="role" class="w-full px-3 py-1 text-sm border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-300">
                    <option value="2">Enseignant</option>
                    <option value="3">Étudiant</option>
                </select>
            </div>
            
            <div class="flex items-center justify-between my-4 text-white text-sm">
                <label class="flex items-center">
                    <input type="checkbox" id="remember" class="accent-white">
                    <p class="ml-2">Remember me</p>
                </label>
                <a href="#" class="text-gray-100 hover:underline">Forgot password?</a>
            </div>
            
            <button class="bg-white text-black font-semibold border-2 border-transparent py-2 px-4 cursor-pointer rounded text-sm transition-all duration-300 hover:bg-white/15 hover:text-white hover:border-white">Signup</button>
            
            <div class="text-center mt-4 text-white text-sm">
                <p>Don't have an account? <a href="?action=login-form" class="text-gray-100 hover:underline">Login</a></p>
            </div>
        </form>
    </div>
    
    <script src="./public/js/login.js"></script>
    
</body>
</html>