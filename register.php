<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="static/css/index.css">
</head>
<body id=register-page>

<div class="register-container">
    <img src="static/images/INSA.png" alt="Logo INSA" class="logo">
    <h2>Register</h2>
    <form action="register_action.php" method="post">
        <div class="input-group">
            <label for="firstname">First Name</label>
            <input type="text" id="firstname" name="firstname" required>
        </div>
        <div class="input-group">
            <label for="lastname">Last Name</label>
            <input type="text" id="lastname" name="lastname" required>
        </div>
        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="button">Register</button>
    </form>
</div>

</body>
</html>
