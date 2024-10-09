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
    <form action="login_action.php" method="post">
        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="button">Login</button>
    </form>
</div>

</body>
</html>
