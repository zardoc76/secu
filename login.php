<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="static/css/index.css">
</head>
<body id = login-page>

<div class="login-container">
    <img src="static/images/INSA.png" alt="Logo INSA" class="logo">
    <h2>Login</h2>
    <form action="register.php" method="post">
        <div class="input-group">
            <label for="username">Username</label>
            <input type="username" id="username" name="username" required autofocus>
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <p style="text-align: right;">
             <a href="register.php" style="color: blue; text-decoration: underline;">Don't have an account?</a>
            </p>
        </div>
        <button type="submit" class="button" name="login_btn">Login</button>
    </form>
</div>

</body>
</html>
