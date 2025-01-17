<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="./public/css/login.css">
</head>
<body>
    <canvas id="c"></canvas>
    <div class="wrapper">
        <form action="?action=register-submit" method="POST" enctype="multipart/form-data">
            <h2>Login</h2>
            <div class="input-field">
                <input type="name" name="name" id="name" required>
                <label for="name">Enter your name</label>
            </div>
            <div class="input-field">
                <input type="email" name="email" id="email" required>
                <label for="email">Enter your email</label>
            </div>
            <div class="input-field">
                <input type="password" name="password" id="password" required>
                <label for="password">Enter your password</label>
            </div>
            <div class="input-field">
                <input type="password" name="confirm_password" id="confirm_password" required>
                <label for="password">Enter your password</label>
            </div>
            <div class="mb-6">
                <label for="userImage" class="block text-gray-700 font-medium mb-2">
                    Upload Image
                </label>
                <input 
                    type="file" 
                    name="image" 
                    id="userImage" 
                    accept="image/*"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-300">
            </div>

            <div class="forget">
                <label for="remember">
                    <input type="checkbox" id="remember">
                    <p>Remember me</p>
                </label>
                <a href="#">Forgot password?</a>
            </div>
            <button >sinup</button>
            <div class="register">
                <p>Don't have an account? <a href="http://127.0.0.1:5500/login/home.html">Register</a></p>
            </div>
        </form>
    </div>
    <script src="./public/js/login.js"></script>
</body>
</html>
