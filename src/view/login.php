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
        <form action="?action=login-submit" method="POST">
            <h2>Login</h2>
            <div class="input-field">
                <input type="email" name="email" id="email" required>
                <label for="email">Enter your email</label>
            </div>
            <div class="input-field">
                <input type="password" name="password" id="mode_de_passe" required>
                <label for="mode_de_passe">Enter your password</label>
            </div>
            <div class="forget">
                <label for="remember">
                    <input type="checkbox" id="remember">
                    <p>Remember me</p>
                </label>
                <a href="#">Forgot password?</a>
            </div>
            <button >Log In</button>
            <div class="register">
                <p>Don't have an account? <a href="?action=register-form">Register</a></p>
            </div>
        </form>
    </div>
    <script src="./public/js/login.js"></script>
</body>
</html>
